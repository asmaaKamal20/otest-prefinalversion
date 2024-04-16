<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['submit'])){

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  require 'PHPMailer/language/phpmailer.lang-ar.php';
  
    // Send mail

    $mail = new PHPMailer();

    // Data received from POST request
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->isHTML(true);   
    $name = stripcslashes($_POST['name']);
    $emailAddr = stripcslashes($_POST["from"]);
    $company = stripcslashes($_POST['tel']);
    $comment = stripcslashes($_POST['message']);
    $subject = stripcslashes($_POST['subject']);  
    $mail->setLanguage('ar');

    /* Or use your own translation set
      (in this case you need to specify the translation file path). */
    
    // SMTP Configuration

    $mail->SMTPAuth = true; 
    $mail->IsSMTP();
    $mail->Host = "mail.utest.uk"; // SMTP server
    $mail->Username = "support@utest.uk";
    $mail->Password = "support@utest";
    $mail->SMTPSecure = 'tls';   
    $mail->Port = 587; 

    $mail->AddAddress('support@utest.uk');
    $mail->From = $emailAddr;
    $mail->FromName = "utest.uk Contact Form - " . $name;
    $mail->Subject = $subject;

    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';    
    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $mail->MsgHTML("Name:" . $name . "<br /><br />Email:" . $emailAddr. "<br /><br />Subject:" . $subject. "<br /><br />Phone:" . $company."<br /><br />" . $comment);

    $message = NULL;
    if(!$mail->Send()) {
        $message = "Mailer Error: " . $mail->ErrorInfo;
    } else {
		$message = "Message sent!";
		header("Location:https://utest.uk/ar");
    }

}
?>