<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (!empty($_SESSION['login'])) {
header("location: login.php");
} else {
if (isset($_POST['login'])) {
$email = $_POST['email'];
$password = md5($_POST['password']);
$status = 1;        

$sql ="SELECT email,password FROM users WHERE email=:email and password=:password and status=:status";            
$query = $dbh->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->bindParam(':status', $status, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
$_SESSION['login'] = $_POST['email'];
echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
} else {
echo "<script>alert('Invalid Details');</script>";
}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Login Page</title>
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
function validate() {
let email = document.userlogin.email.value;
let pass = document.userlogin.password.value;
if (email === "" || email === null && pass === "" || pass === null) {
//alert("Please provide your email and password");
document.getElementById('emailcheck').innerHTML = 'Enter your email address';
document.getElementById('passwordcheck').innerHTML = 'Enter your password';
//document.userlogin.password.focus() ;
return false;
}
if (email === "" || email === null) {
//alert("Please provide your email");
document.getElementById('emailcheck').innerHTML = 'Enter your email address';
document.userlogin.email.focus();
return false;
} else {
var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
if (email.match(mailformat)) {
if (pass === "" || pass === null) {
//alert("Please provide your password");
document.getElementById('passwordcheck').innerHTML = 'Enter your password';
document.userlogin.password.focus();
return false;
}
return true;
// when password field is not empty
} else {
document.getElementById('emailcheck').innerHTML = 'Enter a correct email address';
document.userlogin.email.focus();
return false;
}
}
}
</script>
</head>

<body class="bg-primary">
<nav class="navbar navbar-light bg-light">
  <div>
  <a class="navbar-brand" href="#">E-CENSUS KE</a>
 <a href="./admin/index.php" class="mr-5"> 
  <button class="btn btn-primary">Admin</button></a>  
  </div>
</nav>


<!-- Contact Start -->
<div class="container-md  py-3">

<div class="row align-items-center justify-content-center ">

<div class="col-md-7">
<div class="card p-4">
  
<div id="success" class="text-center card-header"> <h1 class="fw-bold text-dark">Login Page</h1></div>
<p class="help-block text-danger"></p>
<form class="user" method="post" id="userform" name="userlogin"
onsubmit="return validate();" novalidate>
<div class="form-row">

<div class="col-md-12">
<div class="control-group">
<input type="email" class="form-control "
id="email" aria-describedby="emailHelp" name="email"
autocomplete="off"
placeholder="Enter Email Address...">
<span id="emailcheck" style="font-size: 12px; color: red;"></span>

<p class="help-block text-danger"></p>
</div>
</div>
<div class="col-md-12">
<div class="control-group">
<input type="password" class="form-control"
id="password" placeholder="Password" name="password"
autocomplete="off">
<span id="passwordcheck" class="bg-light" style="font-size: 20px; color: red;"></span>

<p class="help-block text-danger"></p>
</div>
</div>

</div>



<div class="form-row">
<div class="col-md-6">
<div class="control-group">
<button class="btn btn-success outline-none font-weight-semi-bold px-4 p-6" type="submit" name="login" style="height: 50px;"  id="sendMessageButton">Login</button>
<p class="help-block text-danger"></p>
</div>
</div>

</div>
</form>

<p class="help-block text-danger"></p>
<sub style="text-align: left;"><a class="text-lead  lead btn" href="register.php" style="text-decoration: none; color: red; padding:2%; cursor:pointer; margin-right:2%;">Don't have account,sign up</a>
<a class="text-lead lead btn" href="forgotpassword.php">Forgot password</a></sub>

</div>
</div>
</div>

</div>
<!-- Contact End -->


<!--- scripts -->
<script src="js/jquery-3.6.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>


</body>

</html>
<?php }?>