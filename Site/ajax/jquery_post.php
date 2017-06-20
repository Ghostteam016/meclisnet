<?php
if($_POST["name"])
{
$name = $_POST["name"];
$email = $_POST["email"];
// Here, you can also perform some database query operations with above values.
echo "Welcome ". $email ."!"; // Success Message
//echo "deneme";
}
?>