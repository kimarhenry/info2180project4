
<?php
function Redirect($url, $permanent = false)
{
if (headers_sent() === false)
{
header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
}
exit();
}
session_start();
$status=$st="";
$_SESSION['username']=$_REQUEST['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$_SESSION['username']=$_REQUEST['username'];
$_SESSION['register']="";
mysql_connect("localhost", "root", "") or die (mysql_error ());
mysql_select_db("Cheapo") or die(mysql_error());
$strSQL = "SELECT * FROM User";
$rs = mysql_query($strSQL);
while($row = mysql_fetch_array($rs)) {
if($_POST['username']==$row['username'] && password_verify($_POST['password'],$row['password'])){
Redirect('mail.html', false);
}else{
$status="Login Failed";
}
if($_REQUEST['username']=='admin'){
$_SESSION['register']="Registration";
}
}
// Close the database connection
mysql_close();
}