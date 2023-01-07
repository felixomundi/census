<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
header('location: login.php');
}

else{

if(isset($_POST['update']))
{
$profilepic=$_FILES["profilepic"]["name"];
$id=intval($_GET['userid']);
move_uploaded_file($_FILES["profilepic"]["tmp_name"],"photo/".$_FILES["profilepic"]["name"]);
$sql="update users set profilepic=:profilepic where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':profilepic',$profilepic,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

$msg="Image updated successfully";



}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="theme-color" content="#3e454c">

<title>Update User Profile image</title>

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
<h3 class="text-dark mb-4">Update profile Picture</h3>
<div class="row mb-3">
<div class="col-lg-8">

<div class="col">
<div class="card shadow mb-3">
<div class="card-header py-3">

</div>
<div class="card-body">

<form method="post" class="form-horizontal" enctype="multipart/form-data">


<div class="form-group">
<label class="col-sm-4 control-label">Current Profile Image</label>
<?php 
$id=intval($_GET['userid']);
$sql ="SELECT profilepic from users where users.id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<div class="col-sm-8">
<img src="photo/<?php echo htmlentities($result->profilepic);?>" class="img-fluid" style="border:solid 1px #000">
</div>
<?php }}?>
</div>

<div class="form-group">
<label class="col-sm-4 control-label mt-3">Upload New Profile Image<span style="color:red">*</span></label>
<div class="col-sm-8 mt-3">
<input type="file" name="profilepic" required>
</div>
</div>
<div class="hr-dashed"></div>




<div class="form-group">
<div class="col-sm-8 col-sm-offset-4 mt-3">

<button class="btn btn-primary" name="update" type="submit">Update</button>
</div>
</div>

</form>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
<!-- /.container-fluid -->

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
<?php } ?>