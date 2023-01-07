<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
header('location: login.php');
} else {
if (isset($_POST['submit'])) {
$password = md5($_POST['password']);
$newpassword = md5($_POST['newpassword']);

$email = $_SESSION['login'];

$sql = "SELECT `password` FROM `users` WHERE email=:email AND password=:password";
$query = $dbh->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
$con = "UPDATE `users` SET password=:newpassword WHERE email=:email";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your password has been successfully updated')</script>";
} else {
echo "<script>alert('Your current password is not correct')</script>";
}
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head><meta charset="utf-8">
<title>Update password</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="Free HTML Templates" name="keywords">
<meta content="Free HTML Templates" name="description">

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



<script type="text/javascript">
function valid() {
if (document.chngpwd.newpassword.value !== document.chngpwd.confirmpassword.value) {
alert("New password and Confirm password field didn\'t match!!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

<script>
var checkPass = function () {
var password = document.getElementById('newpass').value;
var repassword = document.getElementById('confirmpass').value;
var regexpass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,12}$/;
if (password !== "" || password !== null) {
if (password.match(regexpass)) {
document.getElementById('newpassmsg').innerHTML = '';
document.getElementById('submit').disabled = false;
if (password === repassword) {
document.getElementById('confirmpassmsg').style.color = 'green';
document.getElementById('confirmpassmsg').innerHTML = 'password matched';
document.getElementById('submit').disabled = false;
} else {
document.getElementById('confirmpassmsg').style.color = 'red';
document.getElementById('confirmpassmsg').innerHTML = 'password not matching';
document.getElementById('submit').disabled = true;
}
} else {
document.getElementById('newpassmsg').innerHTML = 'Minimum len 8 & max len 12 where 1 uppercase & 1 digit mandatory';
document.getElementById('submit').disabled = true;
}
} else {
document.getElementById('newpassmsg').innerHTML = 'Empty password';
document.getElementById('submit').disabled = true;
}
};
</script>

<script>
function validate() {
var currentpass = document.chngpwd.password.value;
var newpass = document.chngpwd.newpassword.value;
var confirmpass = document.chngpwd.confirmpassword.value;

if (currentpass === "" || currentpass === null) {
document.getElementById('passmsg').style.color = 'red';
document.getElementById('passmsg').innerHTML = 'Invalid current password';
return false;
}
if (newpass === "" || newpass === null) {
document.getElementById('newpassmsg').innerHTML = 'Invalid new password';
return false;
}
if (confirmpass === "" || confirmpass === null) {
document.getElementById('confirmpassmsg').innerHTML = 'Invalid confirm password';
return false;
}
}
</script>
</head>

<body> 
<?php include('includes/head.php');?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
<div class="row">
<div class="col-12">
<nav class="breadcrumb bg-light mb-30">
<a class="breadcrumb-item text-dark" href="#">Home</a>
<span class="breadcrumb-item  disabled">Update Password</span>
</nav>
</div>
</div>
</div>
<!-- Breadcrumb End -->


<!-- Contact Start -->
<div class="container-fluid">
<div class="text-center">
<h1>Update Password</h1>        
</div>

<div class="row justify-content-around">
<div class="col-12 col-lg-4">

<div class="card  border-primary border-2">

<div class="card-body text-center py-4">

<div class="contact-form bg-light p-30">
<div id="success"></div>
<form class="form-horizontal form-material" method="post" name="chngpwd" onSubmit="return validate();"
novalidate>

<div class="form-group mb-4">
<label for="example-email" class="col-md-12 p-0">Current Password</label>
<div class="col-md-12 border-bottom p-0">
<input class="form-control" id="pass" type="password"
name="password" autocomplete="off" required>
<span id="passmsg" style="font-size: 12px;"></span>
</div>
</div>
<div class="form-group mb-4">
<label class="col-md-12 p-0">New Password</label>
<div class="col-md-12 border-bottom p-0">
<input class="form-control" id="newpass" type="password"
name="newpassword" autocomplete="off"
onkeyup="checkPass();" required>
<span id="newpassmsg" style="font-size: 12px;"></span>
</div>
</div>


<div class="form-group mb-4">
<label class="col-md-12 p-0">Confirm New Password</label>
<div class="col-md-12 border-bottom p-0">
<input class="form-control" id="confirmpass" type="password"
name="confirmpassword" autocomplete="off"
onkeyup="checkPass();" required>
<span id="confirmpassmsg"
style="font-size: 12px;"></span>
</div>
</div>

<div class="form-group mb-4">
<div class="col-sm-12">
<button class="btn btn-primary" type="submit"
name="submit">Update
</button>
</div>
</div>
</form>
</div>
</div>

</div></div>
</div>

</div>
</div>
<!-- Contact End -->

<?php include('includes/footer.php')?>
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-top float-end"><i class="fa fa-arrow-up"></i></a>

<!--- scripts -->
<script src="js/jquery-3.6.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>


</body>

</html>
<?php }?>