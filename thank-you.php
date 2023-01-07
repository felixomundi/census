<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');

include('database.php');

if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You Page</title>

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
<!-- 
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" /> -->
   
</head>
<body>
   
<!-- Navbar -->

<?php include('includes/head.php') ?>
<!-- Navbar -->

<div class="container-fluid">
<div class="row bg-light justify-content-center">
<div class="col-lg-12 col-sm-12">
                
<br>
 <div class="card">
  <div class="card-header">
    Thank you Page
  </div>
  <div class="card-body">
    <h5 class="card-title">Thank you for carrying out your census exercise</h5>
    <p class="card-text">Your code is:
    
    <?php
    $email1 = $_SESSION['login'];
    $sql1 = "SELECT `id` FROM `users` WHERE `email`=:email1";
    $query1 = $dbh->prepare($sql1);
    $query1->bindParam(':email1', $email1, PDO::PARAM_STR);
    $query1->execute();
    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
    if ($query1->rowCount() > 0) {
        foreach ($results1 as $result1) {
            $uid = $result1->id;
        }
    }
    
    $sql = "SELECT (code) FROM location where location.userid=:uid ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results as $result) { ?>       
            <?php echo htmlentities($result->code); ?>           
            <?php $cnt = $cnt + 1;
        }
    } ?>
    
    .</p>
<p class="text-success fw-bold ">Mount these code on your doorstep for safety purposes</p>
    
 <p class="text-danger">Tell your esteemed members who have not conducted the exercise to do so today.</p>
    <a href="logout.php" class="btn btn-primary"> <i class="fa fa-power-off"></i> Logout</a>
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

<?php
}
?>