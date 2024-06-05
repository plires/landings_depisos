<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once("repositorioApp.php");
require_once("repositorioSellers.php");
// require_once( __DIR__ . '/../ventas.inc.php' );

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class RepositorioAppSQL extends repositorioApp
{

  protected $conexion;

  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }

  public function validEmail($email)
  {
    $mail_valid = 0;
    //compruebo unas cosas primeras 
    if ((strlen($email) >= 6) && (substr_count($email, "@") == 1) && (substr($email, 0, 1) != "@") && (substr($email, strlen($email) - 1, 1) != "@")) {
      if ((!strstr($email, "'")) && (!strstr($email, "\"")) && (!strstr($email, "\\")) && (!strstr($email, "\$")) && (!strstr($email, " "))) {
        //miro si tiene caracter . 
        if (substr_count($email, ".") >= 1) {
          //obtengo la terminacion del dominio 
          $term_dom = substr(strrchr($email, '.'), 1);
          //compruebo que la terminaci&oacute;n del dominio sea correcta 
          if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, "@"))) {
            //compruebo que lo de antes del dominio sea correcto 
            $before_dom = substr($email, 0, strlen($email) - strlen($term_dom) - 1);
            $caracter_ult = substr($before_dom, strlen($before_dom) - 1, 1);
            if ($caracter_ult != "@" && $caracter_ult != ".") {
              $mail_valid = 1;
            }
          }
        }
      }
    }
    if ($mail_valid)
      return 1;
    else
      return 0;
  }

  public function emptyField($data)
  {
    if ($data == '') {
      return true;
    } else {
      return false;
    }
  }

  public function validateForm($recaptcha, $require)
  {

    $errors = [];

    // Verificamos si hay errores en el formulario
    if (!$recaptcha['success']) {
      array_push($errors, 'Error Recaptcha, volvé a intentar el envio por favor.');
    }

    if ($this->emptyField($require->name)) {
      array_push($errors, 'Ingresá tu nombre.');
    }

    if (!$this->validEmail($require->email)) {
      array_push($errors, 'Ingresá un email válido.');
    }

    if ($this->emptyField($require->phone)) {
      array_push($errors, 'Ingresá un teléfono de contacto.');
    }

    if ($this->emptyField($require->comments)) {
      array_push($errors, 'Ingresá tus comentarios.');
    }

    return $errors;
  }

  public function verifyRecaptcha($token)
  {

    $cu = curl_init();
    curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($cu, CURLOPT_POST, 1);
    curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $_ENV['RECAPTCHA_SECRET_KEY_V3'], 'response' => $token)));
    curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($cu);
    curl_close($cu);

    return $data = json_decode($response, true);
  }

  public function whatsappEnabled()
  {

    return date('l') != 'Sunday' && date('l') != 'Saturday' && intval(date('H')) > 8 && intval(date('H')) < 19;
  }

  public function registerEmailContactsInPerfit($api, $list, $interest, $post, $emailTo)
  {

    if (is_object($post)) {
      $post = (array) $post;
    }

    $date = date("d-M-y H:i");

    $perfit = new PerfitSDK\Perfit(['apiKey' => $api]);
    $listId = $list;

    $response = $perfit->post(
      '/lists/' . $listId . '/contacts',
      [
        'firstName' => $post['name'],
        'email' => $post['email'],
        'customFields' =>
        [
          [
            'id' => 10,
            'value' => $post['utm_source']
          ],
          [
            'id' => 12,
            'value' => $post['phone']
          ],
          [
            'id' => 16,
            'value' => $emailTo['email']
          ],
          [
            'id' => 14,
            'value' => $post['origin'] . ' - ' . $date
          ],
          [
            'id' => 17,
            'value' => $_ENV['PERFIT_ACCOUNT']
          ]
        ],
        'interests' =>
        [
          [
            'id' => $interest,
            'value' => $post['rubro']
          ]
        ]
      ]
    );

    return $response;
  }

  public function getHiddenEmailsToForward()
  {

    try {
      $sql = "SELECT * FROM hidden_emails_to_forward";
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute();
      $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (!$emails) {
        return null;
      }

      return $emails;
    } catch (\Throwable $th) {
      // var_dump($th->getMessage());
      return null;
    }
  }

  public function setEmailRecipients($objectPhpMailer, $recipient, $post, $destinationSales)
  {

    $emails_to_forward = $this->getHiddenEmailsToForward();

    switch ($recipient) {

      case 'Cliente':
        //ENVIOS
        $objectPhpMailer->setFrom($post['email'], $post['name']);
        $objectPhpMailer->addAddress($destinationSales['email'], $destinationSales['name'] . ' - depisos.com'); //Add a recipient
        $objectPhpMailer->addReplyTo($post['email'], $post['name']);

        if ($emails_to_forward) {

          foreach ($emails_to_forward as $admin) {
            $objectPhpMailer->addBCC($admin['email'], $admin['name']); //Agregar copia oculta
          }
        }

        break;

      case 'Usuario':
        //ENVIOS
        $objectPhpMailer->setFrom($destinationSales['email'], $destinationSales['name'] . ' - depisos.com');
        $objectPhpMailer->addAddress($post['email'], $post['name']); //Add a recipient
        $objectPhpMailer->addReplyTo($destinationSales['email'], $destinationSales['name'] . ' - depisos.com');
        break;
    }

    return $objectPhpMailer;
  }

  public function setTemplateAndEmailSubject($template, $post, $destinationSales)
  {

    switch ($template) {

      case 'Contacto Cliente':
        $email['template'] = $this->selectEmailTemplate($post, 'to_client', $destinationSales);
        $email['subject'] = 'Nueva consulta desde ' . $post['origin'];
        break;

      case 'Contacto Usuario':
        $email['template'] = $this->selectEmailTemplate($post, 'to_user', $destinationSales);
        $email['subject'] = $_ENV['EMAIL_SUBJECT_USUARIO'];
        break;
    }

    return $email;
  }

  public function setServerValuesToSendEmails($objectPhpMailer)
  {

    // $objectPhpMailer->SMTPDebug  = 3;                    
    $objectPhpMailer->Host       = $_ENV['SMTP'];
    $objectPhpMailer->SMTPAuth   = true;
    $objectPhpMailer->Username   = $_ENV['EMAIL_CLIENT'];
    $objectPhpMailer->Password   = $_ENV['PASSWORD'];
    $objectPhpMailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $objectPhpMailer->CharSet    = $_ENV['EMAIL_CHARSET'];
    $objectPhpMailer->Port       = $_ENV['EMAIL_PORT'];

    return $objectPhpMailer;
  }

  public function sendEmail($destinatario, $template, $post, $destinationSales)
  {

    if (is_object($post)) {
      $post = (array) $post;
    }

    $objectPhpMailer = new PHPMailer();

    // Setear destinatarios
    $mail = $this->setEmailRecipients($objectPhpMailer, $destinatario, $post, $destinationSales);

    // Setear Template y asunto de los mails
    $email_content = $this->setTemplateAndEmailSubject($template, $post, $destinationSales);

    if ($_ENV['ENVIRONMENT'] === 'local') {
      $mail->isSendmail();
    } else {
      $mail->isSMTP();
    }

    //SERVER SETTINGS
    $mail = $this->setServerValuesToSendEmails($objectPhpMailer);

    //CONTENIDO
    $mail->isHTML(true);
    $mail->Subject = $email_content['subject'];
    $mail->Body    = $email_content['template'];

    //send the message, check for errors
    $send = $mail->send();

    return $send;
  }

  public function selectEmailTemplate($post, $to, $destinationSales)
  {

    $db = new RepositorioSQL();
    $store = $db->getRepositorioSellers()->getStoreById($post['store']);
    $rubro = $db->getRepositorioSellers()->getRubroByName($post['rubro']);

    if (!defined('BASE')) {
      define('BASE', $_ENV['BASE'] . $post['path'] . '/');
    }

    $img_to_header_email = BASE . $rubro['img_to_header_email'];

    //configuro las variables a remplazar en el template
    $vars = array(
      '{facebook}',
      '{instagram}',
      '{img_header}',
      '{name_client}',
      '{sector_client}',
      '{email_sales_client}',
      '{name_sales_client}',
      '{whatsapp_href_sales_client}',
      '{whatsapp_sales_client}',
      '{store}',
      '{origin}',
      '{name_user}',
      '{email_user}',
      '{phone_user}',
      '{comments_user}',
      '{date}',
      '{base}'
    );

    $values = array(
      $_ENV['RRSS_FACEBOOK'],
      $_ENV['RRSS_INSTAGRAM'],
      $img_to_header_email,
      $_ENV['NAME_CLIENT'],
      $_ENV['SECTOR_CLIENT'],
      $destinationSales['email'],
      $destinationSales['name'],
      $destinationSales['link_to_whatsapp'],
      $destinationSales['number_whatsapp'],
      $store['name'],
      $post['origin'],
      $post['name'],
      $post['email'],
      $post['phone'],
      $post['comments'],
      date('d-m-Y'),
      BASE
    );

    if ($_ENV['ENVIRONMENT'] === 'local') {
      $arrContextOptions = array(
        "ssl" => array(
          "verify_peer" => false,
          "verify_peer_name" => false,
        ),
      );
    } else {
      $arrContextOptions = array();
    }

    switch ($to) {

      case 'to_client':
        $template = file_get_contents(BASE . '../includes/emails/contacts/contacts-to-client.php', false, stream_context_create($arrContextOptions));
        break;

      case 'to_user':
        $template = file_get_contents(BASE . '../includes/emails/contacts/contacts-to-user.php', false, stream_context_create($arrContextOptions));
        break;

      default:
        $template = file_get_contents(BASE . '../includes/emails/contacts/contacts-to-client.php', false, stream_context_create($arrContextOptions));
        break;
    }

    //Remplazamos las variables por las marcas en los templates
    $template_final = str_replace($vars, $values, $template);

    return $template_final;
  }
}