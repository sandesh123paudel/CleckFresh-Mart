<?php
    $to = 'karandk536@gmail.com';
    $subject = "Test mail";
    $message = "Hi this email is sent from my local host";
    $message = wordwrap($message,70);
    $header = "FROM:cleckfreshmart@gmail.com\r\nReply-To:cleckfreshmart@gmail.com";

    $mail_sent = mail($to,$subject,$message,$header);
    
    if($mail_sent == true){
        echo "mail sent";
    }
    else{
        echo "someting error";
    }
    
?>