<?php 
    use PHPMailer\PHPMailer\PHPMailer;

    require_once "PHPMailer.php";
    require_once "SMTP.php";
    require_once "Exception.php";

    $mail = new PHPMailer;

    $email = $emails;
    $names = "OTP VERIFICATION";

    //SMTP Settings
    $mail->SMTPDebug = 0; 

    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "agriconmart@gmail.com";
    $mail->Password = "bmyortikksyberfy";
    $mail->Port = 587; //465 for ssl and 587 for tls
    $mail->SMTPSecure = "tls";

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($email, $names);
    $mail->addAddress($emails);
    $mail->Subject = "AGRICON MART";
    $mail->Body = nl2br('Good day,'."\n".'This is your otp code:'." '". $setOTP."' ".'. Kindly submit this code and change your password.'. "\n". 'Thank you have nice day.'."\n \n" .'AgriconMart2022');


    if ($mail->send())
        echo "Mail Sent";

    else
        // echo('Error sending the email');

?>