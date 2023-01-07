<?php
session_start();
include('includes/config.php');
if (!empty($_SESSION['alogin'])) {
header("location: dashboard.php");
} else {
if (isset($_POST['login'])) {
$email = $_POST['email'];
$password = md5($_POST['password']);
$sql = "SELECT email,password FROM admin WHERE email=:email and password=:password";
$query = $dbh->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':password', $password, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
$_SESSION['alogin'] = $_POST['email'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else {
echo "<script>alert('Invalid Details');</script>";
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

<title>Admin Login</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

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
<body class="bg-dark">
<nav class="navbar navbar-light bg-light">
  <div>
  <a class="navbar-brand" href="../index.php">E-CENSUS KE</a>
 <a href="../index.php" class="mr-5"> 
  <button class="btn btn-primary">User Dashboard</button></a>  
</div>
</nav>
<div id="layoutAuthentication">
<div id="layoutAuthentication_content">
<main>
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card shadow-lg border-0 rounded-lg mt-5">
<div class="card-header"><h3 class="text-center font-weight-light my-4">Admin Login</h3></div>
<div class="card-body">
<form class="user" method="post" name="userlogin" onsubmit="return validate();" novalidate>
<div class="form-group">
<input type="email" class="form-control form-control-user"
id="email" aria-describedby="emailHelp"
placeholder="Enter Email Address..." name="email">
<span id="emailcheck" style="font-size: 12px; color: red;"></span>
</div>
<div class="form-group">
<input type="password" class="form-control form-control-user"
id="password" placeholder="Password" name="password">
<span id="passwordcheck" style="font-size: 12px; color: red;"></span>
</div>

<button class="btn btn-primary btn-block text-white btn-user" type="submit"
name="login">
Login
</button>
<hr>

</form>
<hr>
<div class="text-center">
<a class="large" href="forgot-password.php">Forgot Password?</a>
</div>

</div>
</div>
</div>
</div>
</div>
</main>
</div>
<div id="layoutAuthentication_footer">

</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php } ?>