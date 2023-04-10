<?php
require_once( __DIR__ . '/../vendor/autoload.php' );
require_once( __DIR__ . '/../ventas.inc.php' );

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

  class App 
  {

    public function whatsappEnabled() 
    {

      return date('l') != 'Sunday' && date('l') != 'Saturday' && intval(date('H')) > 9 && intval(date('H')) < 18;

    }

    public function registerEmailContactsInPerfit($api, $list, $interest, $post, $emailTo) 
    {

      $date = date("d-M-y H:i");

      $perfit = new PerfitSDK\Perfit( ['apiKey' => $api ] );
      $listId = $list;

      $response = $perfit->post('/lists/' .$listId. '/contacts', 
        [
          'firstName' => $post['name'], 
          'email' => $post['email'],
          'customFields' => 
            [
              [
                'id' => 10, 
                'value' => $post['utm_medium']
              ],
              [
                'id' => 12, 
                'value' => $post['phone']
              ],
              [
                'id' => 16, 
                'value' => $emailTo[0]
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

    public function setEmailRecipients($objectPhpMailer, $recipient, $post, $destinationSales) 
    {

      switch ($recipient) {
        
        case 'Cliente':
          //ENVIOS
          $objectPhpMailer->setFrom($post['email'], $post['name']);
          $objectPhpMailer->addAddress($destinationSales[0], $destinationSales[1] . ' - depisos.com'); //Add a recipient
          $objectPhpMailer->addReplyTo($post['email'], $post['name']);

          if (EMAIL_BCC_MARTIN != '') {
            $objectPhpMailer->addAddress(EMAIL_BCC_MARTIN, NAME_BCC_MARTIN); //Agregar copia oculta
          }

          break;
        
        case 'Usuario':
          //ENVIOS
          $objectPhpMailer->setFrom($destinationSales[0], $destinationSales[1] . ' - depisos.com');
          $objectPhpMailer->addAddress($post['email'], $post['name']); //Add a recipient
          $objectPhpMailer->addReplyTo($destinationSales[0], $destinationSales[1] . ' - depisos.com');
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

    function selectEmailTemplate($post, $to, $destinationSales) 
    {

      //configuro las variables a remplazar en el template
      $vars = array(
        '{facebook}',
        '{instagram}',
        '{name_client}',
        '{sector_client}',
        '{email_sales_client}',
        '{name_sales_client}',
        '{whatsapp_href_sales_client}',
        '{whatsapp_sales_client}',
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
        $_ENV['NAME_CLIENT'],
        $_ENV['SECTOR_CLIENT'],
        $destinationSales[0],
        $destinationSales[1],
        $destinationSales[2],
        $destinationSales[3],
        $post['origin'],
        $post['name'],
        $post['email'],
        $post['phone'],
        $post['comments'],
        date('d-m-Y'),
        BASE 
      );

      switch ($to) {

        case 'to_client':
          $template = file_get_contents( BASE . 'includes/emails/contacts/contacts-to-client.php');
          break;

        case 'to_user':
          $template = file_get_contents( BASE . 'includes/emails/contacts/contacts-to-user.php');
          break;
        
        default:
          $template = file_get_contents( BASE . 'includes/emails/contacts/contacts-to-client.php');
          break;

      }

      //Remplazamos las variables por las marcas en los templates
      $template_final = str_replace($vars, $values, $template);

      return $template_final;

    }

  }

?>