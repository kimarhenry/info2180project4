<?php
//session_start();
// define variables and set to empty values
$subjectErr = $bodyErr = "";
$subject = $body= $create="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["subject"])) {
$subjectErr = "Name is required";
}else{
$subject = test_input($_POST["subject"]);
}
if (empty($_POST["message"])) {
$subjectErr = "Name is required";
}else{
$body = test_input($_POST["message"]);
}
}
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
if (!empty($_POST["subject"]) && !empty($_POST["message"])) {
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
$sql = "INSERT INTO Message(body,subject)
VALUES ('$body', '$subject')";
if (mysqli_query($conn,$sql)) {
echo "Saved";
Redirect('mail.html', false);
} else {
echo "Unable to create user";
}
//close connection
mysqli_close($conn);
}