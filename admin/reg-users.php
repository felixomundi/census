<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from users  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="User data successfully";

}

if (isset($_REQUEST['uaid'])) {
$uaid = intval($_GET['uaid']);
$sql = "UPDATE `users` SET `status`= 0 WHERE id=:uaid";
$query = $dbh->prepare($sql);
$query->bindParam(':uaid', $uaid, PDO::PARAM_STR);
$query->execute();
echo "<script>alert('User Appended successfully');document.location = 'reg-users.php';</script>";
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

<title>Reg Users</title>

<!-- Custom fonts for this template -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<?php include "includes/sidebar.php"; ?>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<?php include "includes/header.php"; ?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<a  class="btn btn-flat btn-primary">Active users</a>
<!-- DataTales Example -->
<div class="card shadow my-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Active users</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>#</th>
<th> Name</th>
<th>Email </th>
<th>Contact no</th>
<th>Address</th>
<th>Sub County</th>
<th>Reg Date</th>
<th>Append</th>
<th>Delete</th>

</tr>
</thead>
<tfoot>
<tr>
<th>#</th>
<th> Name</th>
<th>Email </th>
<th>Contact no</th>
<th>Address</th>
<th>Sub County</th>
<th>Reg Date</th>
<th>Append</th>
<th>Delete</th>
</tr>
</tr>
</tfoot>
<tbody>

<?php $sql = "SELECT * from  users where status=1";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
<tr>
<td><?php echo htmlentities($cnt);?></td>
<td> <?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->lname);?></td>
<td><?php echo htmlentities($result->email);?></td>
<td><?php echo htmlentities($result->contact);?></td>											
<td><?php echo htmlentities($result->address);?></td>
<td><?php echo htmlentities($result->county);?></td>
<td><?php echo htmlentities($result->creationdate);?></td>
<td><a href="reg-users.php?uaid=<?php echo $result->id; ?>"
onclick="return confirm('Do you want to disapprove this user?');">Disapprove</a>
</td>
<td><a href="reg-users.php?del=<?php echo $result->id; ?>"
onclick="return confirm('Do you want to delete?');">Delete</a>
</td>
</tr>

<?php $cnt=$cnt+1; }} else {?>
<tr>
<th style="text-align:center; color:red;" colspan="6">No User Found</th>
</tr>
<?php } ?>                 

</tbody>
</table>
</div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php include "includes/footer.php"; ?>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<a class="btn btn-primary" href="logout.php">Logout</a>
</div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
<?php } ?>