<?php
    $subject="Test";
    $msg="Thank you for Register. Your Name is  and Hp no. is ";
    $to="norep.notifikasi.pembayaran.dc@gmail.com";
    $header="norep.notifikasi.pembayaran.dc@gmail.com";
    $success=mail($to,$subject,$msg,$header);
    if($success==true){
        echo "Email send successfully ";
    } else{
        echo "Error sending email";
    }
?>
