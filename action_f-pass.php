<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if($_POST['email'])
{
include('db.php');
$email = $_POST['email'];
$result = mysqli_query($link , "SELECT `id`  FROM `users` WHERE `email` = '$email'");
$row= mysqli_fetch_assoc($result);

if($row)
{
    var_dump($row);
    $mail = new PHPMailer(true);
    $token = md5($email).rand(10,9999);
    $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);
    $update = mysqli_query($link,"INSERT INTO `reset_pass` (`email` , `token` , `exp_date`) VALUES ('{$email}' , '{$token}' ,  '{$expDate}')");
    $link = "<a href='test/reset-password.php?key=".$email."&amp;token=".$token."'>Click To Reset password</a>";
    
    // $subject = "Заголовок письма"; 
    // $message = "$link";
    // // $headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
    // // $headers .= "From: От кого письмо <from@example.com>\r\n"; 
    // // $headers .= "Reply-To: reply-to@example.com\r\n"; 
    // // mail($to, $subject, $message, $headers);   
    // // var_dump(mail($to, $subject, $message, $headers) ); 


    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'testovichmax@gmail.com';                     // SMTP username
        $mail->Password   = 'svikfjdnjrqnyhlx';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
        //Recipients
        $mail->setFrom('testovichmax@gmail.com', 'Mailer');
        $mail->addAddress("$email", '');     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        // Content
        
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Reset pass";
        $mail->Body    = "<a href='https://test/reset-password.php?key=".$email."&amp;token=".$token."'>Click To Reset password</a>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
}