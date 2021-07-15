<?php
die('called');
$to      = 'andrej.golis@gmail.com';
$subject = 'the subject';
$message = 'hello';

echo "before mail";
if(mail($to, $subject, $message)){
    echo "senfdsfd";
}

?>