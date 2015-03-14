<?php
/**
 * Created by PhpStorm.
 * User: Alexandr_prylipko
 * Date: 14.03.2015
 * Time: 12:08
 */

require_once 'inc/class.phpmailer.php';
require_once 'inc/class.smtp.php';

if( isset($_POST['submit']) ) {

    $response_message =
        'Name' . $_POST['your_name'] . '<br />
         Email' . $_POST['your_email'] . '<br />
         Subject' . $_POST['message_subject'] . '<br />
         Message' . $_POST['message_content'] . '';

    $cl_mail = new PHPMailer();

    $cl_mail->isSMTP();
    $cl_mail->CharSet = 'UTF-8'; // Set message charset
    $cl_mail->Host = 'smtp.gmail.com'; //Set SMTP server
    $cl_mail->SMTPDebug = 2; // Enable SMTP debug information
    $cl_mail->SMTPAuth = true; // Enable SMTP authorization
    $cl_mail->SMTPSecure = 'ssl'; // Secure connection ssl/tls
    $cl_mail->Priority = 1; //Email priority [1 = High, 3 = Normal, 5 = low]
    $cl_mail->Port = 465; // Set Connection port 465/587
    $cl_mail->Encoding = '8bit';
    $cl_mail->Subject = 'My Contact Form'; // Message Title

    // Service Authorization
    $cl_mail->Username = 'you_email@gmail.com'; // You gmail address
    $cl_mail->Password = 'you gmail password';  // You gmail password

    // Compose you message
    $cl_mail->setFrom($_POST['your_email'], $_POST['your_name']);
    $cl_mail->addReplyTo($_POST['your_email'], $_POST['your_name']);
    $cl_mail->msgHTML($response_message); // compose full message

    // Message Send
    $cl_mail->addAddress('you_recipient_email@gmail.com', 'Recipient name'); // Recipient contacts
    $result_send = $cl_mail->Send();
    $response_message = $result_send ? 'Successfully Sending!' : 'Sending Failed!';
    unset($cl_mail);
}