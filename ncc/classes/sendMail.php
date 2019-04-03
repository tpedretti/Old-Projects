<?php

require_once 'database.php';
require_once 'PHPMailer/PHPMailerAutoload.php';

class sendMail {
    function insertMail($location, $priority, $reason) {
        $mail = new PHPMailer;
                
        $mail->isSMTP();
        $mail->Host = 'lnxcloud.atlasnetworks.us';
        $mail->SMTPDebug = 2;        
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "ssl";        
        $mail->Port = 465;
        $mail->Username = 'dontreply@nexservers.net';
        $mail->Password = 'Ihateyou4';
        
        $mail->From = 'dontreply@nexservers.net';
        $mail->FromName = 'DON\'T REPLY';
        $mail->addAddress('lockoutlockon@gmail.com'); 
        
        $mail->WordWrap = 70; 
        $mail->isHTML(true);
        
        $mail->Subject = 'New Report Added';
        $mail->Body    = 'Priority: ' . $priority . '</br>'
                       . 'Location: ' . $location . '</br>'
                       . 'Reason: '   . $reason;
        $mail->AltBody = 'Priority: ' . $priority . '   '
                       . 'Location: ' . $location . '   '
                       . 'Reason: '   . $reason;
        
        $mail->send();        
    }
    function completeMail() {
        
    }
}
