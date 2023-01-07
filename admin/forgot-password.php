<?php
include('includes/config.php');
if(isset($_POST['update']))
{
$email=$_POST['email'];
$contact=$_POST['contact'];
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT email FROM admin WHERE email=:email and contact=:contact";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':contact', $contact, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update admin set password=:newpassword where email=:email and contact=:contact";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':contact', $contact, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}

?><!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Forgot Password</title>

<!-- Custom fonts for this template-->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body class="bg-primary">
<div id="layoutAuthentication">
<div id="layoutAuthentication_content">
<main>
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card shadow-lg border-0 rounded-lg mt-5">
<div class="card-header"><h3 class="text-center font-weight-light my-4">Forgot Password?</h3></div>
<div class="card-body">
<form name="chngpwd" method="post" onSubmit="return valid();">
<div class="form-floating mb-3">
<label for="inputEmail">Email address</label>
<input type="email" name="email" class="form-control" required="">

</div>
<div class="form-floating mb-3"> 
<label for="inputEmail">Contact</label>
<input type="text" name="contact" class="form-control"  required="">

</div> <div class="form-floating mb-3">
<label for="inputEmail">New Password</label>
<input type="password" name="newpassword" class="form-control"  required="">

</div> <div class="form-floating mb-3">
<label for="inputEmail">Confirm Password</label>
<input type="password" name="confirmpassword" class="form-control"  required="">                                               
</div>
<div class="d-flex align-items-center justify-content-between mt-4 mb-0">
<a class="large" href="index.php">Login</a>

<input type="submit" class="btn btn-primary" value="Reset My Password" name="update" class="btn btn-block">

</div>
</form>
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
