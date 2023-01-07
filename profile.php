<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
header('location: login.php');
} else {
if(isset($_POST['updateprofile']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$contact=$_POST['contact'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$county=$_POST['county'];
$email=$_SESSION['login'];
$sql="update users set fname=:fname,lname=:lname,contact=:contact,dob=:dob,address=:address,county=:county where email=:email";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':contact',$contact,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':county',$county,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->execute();
$msg="Profile Updated Successfully";
}

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Settings Page</title>

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

<style type="text/css">
.form-style-6{
font: 95% Arial, Helvetica, sans-serif;
max-width: 400px;
margin: 10px auto;
padding: 16px;
background: #F7F7F7;
}
.form-style-6 h1{
background: #43D1AF;
padding: 20px 0;
font-size: 140%;
font-weight: 300;
text-align: center;
color: #fff;
margin: -16px -16px 16px -16px;
}
.form-style-6 input[type="text"],
.form-style-6 input[type="date"],
.form-style-6 input[type="datetime"],
.form-style-6 input[type="email"],
.form-style-6 input[type="number"],
.form-style-6 input[type="search"],
.form-style-6 input[type="time"],
.form-style-6 input[type="url"],
.form-style-6 textarea,
.form-style-6 select 
{
-webkit-transition: all 0.30s ease-in-out;
-moz-transition: all 0.30s ease-in-out;
-ms-transition: all 0.30s ease-in-out;
-o-transition: all 0.30s ease-in-out;
outline: none;
box-sizing: border-box;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
width: 100%;
background: #fff;
margin-bottom: 4%;
border: 1px solid #ccc;
padding: 3%;
color: #555;
font: 95% Arial, Helvetica, sans-serif;
}
.form-style-6 input[type="text"]:focus,
.form-style-6 textarea:focus,
.form-style-6 select:focus
{
box-shadow: 0 0 5px #43D1AF;
padding: 3%;
border: 1px solid #43D1AF;
}

.form-style-6 input[type="submit"],
.form-style-6 input[type="button"]{
box-sizing: border-box;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
width: 100%;
padding: 3%;
background: #43D1AF;
border-bottom: 2px solid #30C29E;
border-top-style: none;
border-right-style: none;
border-left-style: none;	
color: #fff;
}
.form-style-6 input[type="submit"]:hover,
.form-style-6 input[type="button"]:hover{
background: #2EBC99;
}
</style>

<?php include('includes/head.php');?>
</head>
<body>



<div class="form-style-6">
<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from users where email=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>

<h5><?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->lname);?></h5>
<p><?php echo htmlentities($result->address);?><br>
&nbsp;<?php echo htmlentities($result->county);?></p>

<h5 class="uppercase underline">Update profile Settings</h5>

<form  method="post">

<div class="form-group">
<label class="control-label">First Name</label>
<input class="form-control white_bg" name="fname" value="<?php echo htmlentities($result->fname);?>" id="fullname" type="text"  required>
</div>

<div class="form-group">
<label class="control-label">Last Name</label>
<input class="form-control white_bg" name="lname" value="<?php echo htmlentities($result->lname);?>" id="fullname" type="text"  required>
</div>

<div class="form-group">
<label class="control-label">Email Address</label>
<input class="form-control white_bg" value="<?php echo htmlentities($result->email);?>" name="email" id="email" type="email" required readonly>
</div>
<div class="form-group">
<label class="control-label">Phone Number</label>
<input class="form-control white_bg" name="contact" value="<?php echo htmlentities($result->contact);?>" id="phone-number" type="text" required>
</div>
<div class="form-group">
<label class="control-label">Date of Birth&nbsp;(dd/mm/yyyy)</label>
<input class="form-control white_bg" value="<?php echo htmlentities($result->dob);?>" name="dob" placeholder="dd/mm/yyyy" id="birth-date" type="text" >
</div>
<div class="form-group">
<label class="control-label">Your Address</label>
<textarea class="form-control white_bg" name="address" rows="4" ><?php echo htmlentities($result->address);?></textarea>
</div>
<div class="form-group">
<label class="control-label">County</label>
<input class="form-control white_bg"  id="county" name="county" value="<?php echo htmlentities($result->county);?>" type="text">
</div>

<?php }} ?>

<div class="form-group">
<button type="submit" class="btn btn-primary" name="updateprofile" class="btn">Save Changes <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
</div>
</form>
</div>


<?php include('includes/footer.php')?>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-top float-end"><i class="fa fa-arrow-up"></i></a>


<!--- scripts -->
<script src="js/jquery-3.6.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>


</body>
</html>
<?php } ?>