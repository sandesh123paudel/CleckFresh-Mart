<?php

    $to      = $femail; 
    $subject = $sub;
    $message = $message;
    $headers = 'From: cleckfreshmart@gmail.com' . "\r\n" .'Reply-To: cleckfreshmart@gmail.com';
    
    $mail_sent = mail($to, $subject, $message, $headers);
 
    if(!$mail_sent){
        echo "mail send failed";
    }  
?>