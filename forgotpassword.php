<?php
include('includes/config.php');
if(isset($_POST['update']))
  {
$email=$_POST['email'];
$contact=$_POST['contact'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT email FROM users WHERE email=:email and contact=:contact";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':contact', $contact, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update users set password=:newpassword where email=:email and contact=:contact";
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

?>

<!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Kilifi Weblog</title>

   
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
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
</head>
<body>


<!-- Topbar Start -->
<div class="container-fluid">
<div class="row bg-light px-lg-5">
<div class="col-12 col-md-8">
<div class="d-flex justify-content-between">
<h1 class="m-0 display-5 text-uppercase"><span class="text-primary">E-CENSUS</span>KE</h1> 
</div>
</div>
</div>
</div>
</div>
<!-- Topbar End -->


<div class="container-fluid">

        <div class="row justify-content-center">            
            <div class="col-lg-7">
              
<div class="card o-hidden border-0 shadow-lg my-2">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="card-header mb-4">Reset Password Page</h1>
                    </div>
              <form name="chngpwd" method="post" onSubmit="return valid();">
                <div class="form-group mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Your Email address*" required="">
                </div>
  <div class="form-group mb-3">
                  <input type="text" name="contact" class="form-control" placeholder="Your Reg. Mobile*" required="">
                </div>
  <div class="form-group mb-3">
                  <input type="password" name="newpassword" class="form-control" placeholder="New Password*" required="">
                </div>
  <div class="form-group mb-3">
                  <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password*" required="">
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-success" value="Reset My Password" name="update" class="btn btn-block">
                </div>
              </form>
              <div class="text-center">
                
                <p><a href="login.php"><i class="fa fa-angle-double-left" aria-hidden="true"></i> <span style="color:green">Back to Login</span></a></p>
              </div>
            
                                </div>
                               
                            </div>
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
<?php ?>