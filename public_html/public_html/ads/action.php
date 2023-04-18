<?php
if(isset($_POST["submit"])){
// Checking For Blank Fields..
if($_POST["vname"]==""||$_POST["vemail"]==""||$_POST["msg"]==""||$_POST["area"]==""||$_POST["vmobile"]==""||$_POST["cname"]==""){
echo "Fill All Fields..";
}else{
// Check if the "Sender's Email" input field is filled out
$email=$_POST['vemail'];
// Sanitize E-mail Address
$email =filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate E-mail Address
$email= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email){
echo "Invalid Sender's Email";
}
else{
$subject = $_POST['cname'];
$message = $_POST['msg'];
$area = $_POST['area'];
$mobile = $_POST['vmobile'];
$name = $_POST['vname'];
$email = $_POST['vemail'];
$headers = 'From:'. $email2 . "rn"; // Sender's Email
$headers .= 'Cc:'. $email2 . "rn"; // Carbon copy to Sender
// Message lines should not exceed 500 characters (PHP rule), so wrap it
$message = wordwrap($message, 500);
// Send Mail By PHP Mail Function
mail("sales@herody.in", $subject, $message, $headers, $name, $mobile, $area, $email, $mobile );
echo "Your mail has been sent successfuly ! Thank you for your feedback";
}
}
}
?>