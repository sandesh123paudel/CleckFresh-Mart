<?php
    $to = 'mmukesh21@tbc.edu.np';
    $subject = "Test mail";
    $message = "Hi Mukesh, This message remind you to prepare about your work in progress presentation So be prepare it. And we our demo is in Monday 10 am.";
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