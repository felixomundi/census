<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
header('location: login.php');
} else {

if (isset($_POST['submit'])) {


$location = $_POST['location'];
$sub = $_POST['sub'];
$village = $_POST['village'];    
$code = rand(99999999,11111111);
// $userid=$_POST['userid'];
$email3 = $_SESSION['login'];

$sql3 = "SELECT `id` FROM `users` WHERE `email`=:email3";
$query3 = $dbh->prepare($sql3);
$query3->bindParam(':email3', $email3, PDO::PARAM_STR);
$query3->execute();
$results3 = $query3->fetchAll(PDO::FETCH_OBJ);
if ($query3->rowCount() > 0) {
foreach ($results3 as $result3) {
$userid = $result3->id;
}
}
$sql = "INSERT INTO location(userid,village,location,sub,code) VALUES(:userid,:village,:location,:sub,:code)";
$query = $dbh->prepare($sql);
$query->bindParam(':userid', $userid, PDO::PARAM_STR);
$query->bindParam(':location', $location, PDO::PARAM_STR);
$query->bindParam(':sub', $sub, PDO::PARAM_STR);       
$query->bindParam(':village', $village, PDO::PARAM_STR);  
$query->bindParam(':code', $code, PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if ($lastInsertId) {
echo "<script>alert('Location Details Saved successfully');document.location = 'house.php';</script>";
} else {
echo "<script>alert('Something went wrong')</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-CENSUS-KE Home Page</title>

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
<style>

body{
background-color:#f5f5f5;
}
legend
{
font-size:14px;
font-weight:bold;
margin-bottom: 0px; 
width: 35%; 
border: 1px solid #ddd;
border-radius: 4px; 
padding: 5px 5px 5px 10px; 
background-color: #ffffff;
}
</style>

</head>
<body>

<!-- Navbar -->

<?php include('includes/head.php') ?>
<!-- Navbar -->

<div class="container-sm ml-10 py-3">
<div class="text-start">
<h1>Welcome!! <?php 
$email = $_SESSION['login'];
$sql2 = "SELECT users.* FROM `users` WHERE `email`=:email and status=1 ;";
$query = $dbh->prepare($sql2);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
foreach ($results as $result) {
} 
?><?php  echo htmlspecialchars($result->fname); ?> <?php  echo htmlspecialchars($result->lname); }?> to e-census system.</h1>
<p class="text-danger text-small">
Public private life is protected by the constitution of kenya.
Kindly be honest while filling this questionnaire.
Incase of assistance call 0741036409. Please follow all steps and fill in information from section A to E.
</p>
<p class="lead text-muted">
Be honest while filling in this forms
</p>
</div>

<div class="row 
justify-content-center ">

<div class="col-lg-7">
<div class="card my-4 border-primary border-2">
<div class="card-header text-center text-primary">Section A: Enter Your Place of origin</div>
<form action="" method="post" class="p-4">

<div class="col-lg-6 col-sm-12 ">
<!-- <input name="location" type="text" class="form-control"  placeholder="Your Location*" required=""> -->
<select id="loc" name="location" class="form-control" required>
<option value=""> Select Location </option>
<?php $ret="select id, name from loc";
$query= $dbh -> prepare($ret);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?></option>
<?php }} ?>
</select>
</div>
<div class="col-lg-6 col-sm-12 mx-4 py-4">
<div class="form-group">
<select id="sub" name="sub" class="form-control" required="">
<option value="">Select Sublocation</option>
</select>
</div>
</div>
<div class="col-lg-6 col-sm-12 mx-4 py-4">
<fieldset>
<select id="village" class="form-control" name="village" required="">
<option value="">Select Village</option>
</select>

</fieldset>
</div>

<div class="col-lg-12 col-sm-12  mx-4 mb-4">
<fieldset>
<button type="submit" name="submit" class="btn btn-primary btn-lg rounded-pill">Submit</button>
</fieldset>
</div>

</form>
</div>
</div>
</div>
</div>

<!--- scripts -->
<script src="js/jquery-3.6.1.min.js"></script>

<script>
$(document).ready(function(){
$('#loc').on('change', function(){
var locID = $(this).val();
if(locID){
$.ajax({
type:'POST',
url:'get.php',
data:'loc_id='+locID,
success:function(html){
$('#sub').html(html);
$('#village').html('<option value="">Select sublocation first</option>'); 
}
}); 
}else{
$('#sub').html('<option value="">Select location first</option>');
$('#village').html('<option value="">Select sublocation first</option>'); 
}
});

$('#sub').on('change', function(){
var subID = $(this).val();
if(subID){
$.ajax({
type:'POST',
url:'get.php',
data:'sub_id='+subID,
success:function(html){
$('#village').html(html);
}
}); 
}else{
$('#village').html('<option value="">Select sublocation first</option>'); 
}
});
});
</script> 



<?php include('includes/footer.php')?>
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-top float-end"><i class="fa fa-arrow-up"></i></a>


</body>

<script src="js/bootstrap.bundle.min.js"></script>


</html>

<?php }?>