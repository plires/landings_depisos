<?php
abstract class repositorioApp
{
  public abstract function validEmail($email);
  public abstract function emptyField($data);
  public abstract function validateForm($recaptcha, $require);
  public abstract function verifyRecaptcha($token);
  public abstract function whatsappEnabled();
  public abstract function registerEmailContactsInPerfit($api, $list, $interest, $post, $emailTo);
  public abstract function setEmailRecipients($objectPhpMailer, $recipient, $post, $destinationSales);
  public abstract function setTemplateAndEmailSubject($template, $post, $destinationSales);
  public abstract function setServerValuesToSendEmails($objectPhpMailer);
  public abstract function sendEmail($destinatario, $template, $post, $destinationSales);
  public abstract function selectEmailTemplate($post, $to, $destinationSales);
  public abstract function getHiddenEmailsToForward();
  public abstract function notificationsToEmail($content, $function, $file, $line);
}