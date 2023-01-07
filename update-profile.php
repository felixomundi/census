<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
header('location: login.php');
}
if(isset($_POST['updateprofile']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$contact=$_POST['contact'];
$dob=$_POST['dob'];

$address=$_POST['address'];                    
$email=$_SESSION['login'];
$sql="update users set fname=:fname,lname=:lname,contact=:contact,dob=:dob,address=:address where email=:email";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':contact',$contact,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);

$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->execute();
$msg="Profile Updated Successfully";
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

<title>Update User Profile Image</title>

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
</head>


<body class="sb-nav-fixed">
<div id="layoutSidenav">

<?php include('includes/head.php');?>


<div id="layoutSidenav_content" id="content-wrapper">
<main>
<!-- Begin Page Content -->
<div class="container-fluid">
<h3 class="text-dark mb-4">Update profile</h3>
<div class="row mb-3">
<div class="col-lg-8">


<?php
$email = $_SESSION['login'];
$sql2 = "SELECT *  FROM `users` WHERE `email`=:email;";
$query = $dbh->prepare($sql2);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
foreach ($results as $result) {

?> 
<div class="card shadow mb-3">
<div class="card-header py-3">
<p class="text-primary m-0 font-weight-bold"><?php echo $result->fname;?> <?php echo $result->lname;?>'s&nbsp;Profile </p>
</div>
<div class="card-body">

<form  method="post">


<div class="form-row">
<div class="col-md-8 col-lg-6 col-xl-6">



<div class="form-group">
<label for="insertimage1"><strong>Change Profile
image</strong></label>
<img
src="photo/<?php echo $result->profilepic; ?>"
width="100%" height="200px" style="border:solid 1px #000"><br><br>
<a href="change-profile.php?userid=<?php echo $result->id ?>">Click to Change
profile Image</a>
</div>



</div>
</div>


</form>
</div>
</div>
</div>


</div>
</div>
<!-- /.container-fluid -->


<?php }}?>


</div>
</div>
</div>
</main>


</div>
</div> 


<script src="js/bootstrap.bundle.min.js"></script>
<!--- scripts -->
<script src="js/jquery-3.6.1.min.js"></script>


</body>

</html>