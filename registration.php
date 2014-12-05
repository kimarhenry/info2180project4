<?php
session_start();
// define variables and set to empty values
$usernameErr = $emailErr =$firstnameErr=$lastnameErr =$passwordErr =$hash= $password_confirmErr= "";
$email = $username = $firstname = $lastname = $password = $password_confirm= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["username"])) {
$usernameErr = "Name is required";
} else {
$username = test_input($_POST["username"]);
// check if name only contains letters and numbers
if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
$usernameErr = "Only letters and numbers";
}
}
if (empty($_POST["firstname"])) {
$firstnameErr = "First Name is required";
} else {
$firstname = test_input($_POST["firstname"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z]*$/",$firstname)) {
$firstnameErr = "Only letters";
}
}
if (empty($_POST["lastname"])) {
$lastnameErr = "Last Name is required";
} else {
$lastname = test_input($_POST["lastname"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z]*$/",$lastname)) {
$lastnameErr = "Only letters";
}
}
if (empty($_POST["email"])) {
$emailErr = "Email is required";
} else {
$email = test_input($_POST["email"]);
// check if e-mail address is well-formed
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid email format";
}
}
if (empty($_POST["password"])) {
$passwordErr = "Password is required";
} else {
$password = test_input($_POST["password"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
$passwordErr = "Only letters and numbers";
}
}
if (empty($_POST["password_confirm"])) {
$password_confirmErr = "Password is required";
} else {
$password_confirm = test_input($_POST["password_confirm"]);
// check if name only contains letters and whitespace
if (!preg_match("/^[a-zA-Z0-9]*$/",$password_confirm)) {
$password_confirmErr = "Only letters and numbers allowed";
}
if($password != $password_confirm){
$password_confirmErr="passwords don't match";
}
}
}
if (!empty($_POST["username"]) && !empty($_POST["firstname"]) &&
!empty($_POST["lastname"]) && $password==$password_confirm) {
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "Cheapo";
// Create connection
$conn = mysqli_connect($servername, $user, $pass, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO User(first_name, last_name, username, password)
VALUES ('$firstname', '$lastname', '$username','$hash')";
if (mysqli_query($conn,$sql)) {
$create="User created successfully";
Redirect('mail.html', false);
} else {
$create="Unable to create user";
}
mysqli_close($conn);
}
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}