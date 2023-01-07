<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (!empty($_SESSION['login'])) {
header("location: index.php");
} else {
if (isset($_POST['signup'])) {
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = md5($_POST['password']);
$status = 1;

$sql = "INSERT INTO users(`fname`,`lname`,`email`,`contact`,`password`,`status`) VALUES(:fname,:lname,:email,:phone,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname', $fname, PDO::PARAM_STR);
$query->bindParam(':lname', $lname, PDO::PARAM_STR);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':phone', $phone, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->bindParam(':status', $status, PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if ($lastInsertId) {
echo "<script>alert('Registration successful you can now login with your provided credentials');document.location = 'login.php'</script>";
} else {
echo "<script>alert('Something went wrong');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Register</title>

<!--  font awesome -->
<script src="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"></script>
<script src="https://kit.fontawesome.com/d663acac4f.js" crossorigin="anonymous"></script>
<!--  font awesome -->

<!--  google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,900&display=swap" rel="stylesheet">
<!--  google fonts -->


<!--  css-->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap5.min.css">
<!--  css -->

<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check-availability.php",
data: 'email=' + $("#email").val(),
type: "POST",
success: function (data) {
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error: function () {
}
});
}
</script>

<script type="text/javascript">
function valid() {
if (document.signup.password.value !== document.signup.passwordrepeat.value) {
alert("Password and Repeat Password field didn\'t match!!");
document.signup.passwordrepeat.focus();
return false;
}
return true;
}
</script>

<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check-availability.php",
data: 'email=' + $("#email").val(),
type: "POST",
success: function (data) {
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error: function () {
}
});
}
</script>

<script type="text/javascript">
$(document).ready(function () {
function disablePrev() {
window.history.forward();
}

window.onload = disablePrev();
window.onpageshow = function (evt) {
if (evt.persisted) disableBack()
}
});
</script>

<script type="text/javascript">
var checkPass = function () {
var password = document.getElementById('password').value;
var repassword = document.getElementById('confirm_password').value;
var regexpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,12}$/;
if (password !== "" || password !== null) {
if (password.match(regexpass)) {
document.getElementById('checkpass').innerHTML = '';
document.getElementById('submit').disabled = false;
if (password === repassword) {
document.getElementById('message').style.color = 'green';
document.getElementById('message').innerHTML = 'password matched';
document.getElementById('submit').disabled = false;
} else {
document.getElementById('message').style.color = 'red';
document.getElementById('message').innerHTML = 'password not matching';
document.getElementById('submit').disabled = true;
}
} else {
document.getElementById('checkpass').innerHTML = 'Password Minimum lenght 8 & maximum length len 12 where 1 letter Uppercase, 1 letter Lowercase & 1 digit mandatory';
document.getElementById('submit').disabled = true;
}
} else {
document.getElementById('checkpass').innerHTML = 'Empty password';
document.getElementById('submit').disabled = true;
}
};

var checkfname = function () {
var fname = document.getElementById('fname').value;
var fnamevalidation = /^[a-zA-Z ]{2,30}$/;

if (fname === "" || fname === null || !fname.match(fnamevalidation) || fname.length < 2 || fname.length > 30) {
document.getElementById('checkfname').style.color = 'red';
document.getElementById('checkfname').innerHTML = 'invalid first name';
document.getElementById('submit').disabled = true;
} else {
//var fnamevalidation = /^[a-zA-Z ]{2,15}$/;
if (fname.match(fnamevalidation)) {
//document.getElementById('checkfname').style.color = 'green';
document.getElementById('checkfname').innerHTML = '';
document.getElementById('submit').disabled = false;
}
}
};

var checklname = function () {
var lname = document.getElementById('lname').value;
var lnamevalidation = /^[a-zA-Z]{2,15}$/;

if (lname === "" || lname === null || !lname.match(lnamevalidation) || lname.length < 2 || lname.length > 15) {
document.getElementById('checklname').style.color = 'red';
document.getElementById('checklname').innerHTML = 'invalid last name';
document.getElementById('submit').disabled = true;
} else {
//var fnamevalidation = /^[a-zA-Z ]{2,15}$/;
if (lname.match(lnamevalidation)) {
//document.getElementById('checklname').style.color = 'green';
document.getElementById('checklname').innerHTML = '';
document.getElementById('submit').disabled = false;
}
}
};

</script>

<script>
function validate() {
var fname = document.signup.fname.value;
var lname = document.signup.lname.value;
var email = document.signup.email.value;
var pass = document.signup.password.value;
var repass = document.signup.passwordrepeat.value;

if (fname === "" || fname === null) {
document.getElementById('checkfname').innerHTML = 'First name is empty';
return false;
}
if (lname === "" || lname === null) {
document.getElementById('checklname').innerHTML = 'Last name is empty';
return false;
}
if (email === "" || email === null) {
//document.getElementById('checkemail').innerHTML = 'Enter your email address';
return false;
}
if (pass === "" || pass === null) {
document.getElementById('checkpass').innerHTML = 'Invalid password';
return false;
}
}
</script>

</head>

<body class="bg-primary ">
<nav class="navbar navbar-light bg-light">
<div>
<a class="navbar-brand" href="#">E-CENSUS KE</a>
<a href="./admin/index.php" class="mr-5"> 
<button class="btn btn-primary">Admin</button></a>  
</div>
</nav>
<div class="container-fluid border-primary border-1">

<div class="row justify-content-around">                        
<div class="col-lg-7">
<div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
<!-- Nested Row within Card Body -->
<div class="p-5">
<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
</div>
<form class="user" method="post" name="signup" onsubmit="return validate();"
novalidate>
<div class="form-group row">
<div class="col-sm-6 mb-3 mb-sm-0">
<input class="form-control form-control-user" type="text" id="fname"
placeholder="First Name" name="fname" autocomplete="off"
onkeyup="checkfname();">
<span id="checkfname" style="font-size:12px; color: red;"></span>
</div>
<div class="col-sm-6">
<input class="form-control form-control-user" type="text" id="lname"
placeholder="Last Name" name="lname" autocomplete="off"
onkeyup="checklname();">
<span id="checklname" style="font-size:12px; color: red;"></span>
</div>
</div>

<div class="form-group my-4 row">
<div class="col-sm-6 mb-4">
<input class="form-control form-control-user" type="email" id="email"
aria-describedby="emailHelp" autocomplete="off"
placeholder="Email Address" name="email" onBlur="checkAvailability();">
<span id="user-availability-status" style="font-size:12px;"></span>
<span id="checkemail" style="font-size:12px; color: red;"></span>
</div>
<div class="col-sm-6">
<input class="form-control form-control-user" type="tel" id="phone" required=""
placeholder="Enter Phone Number"
 name="phone" 
 oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
 maxlength="10">                                       

</div>
</div>
<div class="form-group row">
<div class="col-sm-6 mb-3 mb-sm-0">
<input class="form-control form-control-user" type="password" id="password"
placeholder="Password" autocomplete="off" name="password"
onkeyup="checkPass();">
<span id="checkpass" style="font-size:12px; color: red;"></span>
</div>
<div class="col-sm-6">
<input class="form-control form-control-user" type="password"
id="confirm_password" autocomplete="off" onkeyup='checkPass();'
placeholder="Repeat Password" name="passwordrepeat">
<span id='message'></span>
<span id="checkrepass" style="font-size:12px; color: red;"></span>
</div>
</div>
<p class="mt-2"></p>
<button class="btn btn-danger btn-block text-white btn-user" type="submit"
name="signup" id="submit">Register Account
</button>
<hr>
</form>



<p class="help-block text-danger"></p>
<sub style="text-align: left;"><a class="text-lead  lead" href="login.php" style="text-decoration: none; color: green; padding:2%; cursor:pointer; margin-right:2%;">Already have account,Login</a>
<a class="text-lead lead text-danger" href="forgotpassword.php">Forgot password</a></sub>

</div>

</div>
</div>
</div>
</div>
</div>

</div>


<!--- scripts -->
<script src="js/jquery-3.6.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php } ?>