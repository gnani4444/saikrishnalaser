<?php
$to ="vanamgnaneshwar@gmail.com";
$subject="PHP mail";
$message="Testing the mail";
$result= mail($to,$subject,$message);
if($result){
echo "Email Sent";
}
else{
echo "Email doesn't sent";
}


?>