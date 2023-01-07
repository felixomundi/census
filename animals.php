<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');

include('database.php');

if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $no = $_POST['no'];
    $spec = $_POST['spec'];
    
  

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


      foreach ($_POST['name'] as $key => $value) {

        $query3 = "INSERT INTO animal(name,no,spec,userid)VALUES ('" . $_POST['name'][$key] . "','" . $_POST['no'][$key] . "','" . $_POST['spec'][$key] . "','$userid')";
        mysqli_query($conn, $query3);
        header('location:income.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Details Page</title>

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
    <div class="container-sm">
    <div class="text-start">
   
<p class="text-danger text-small">
    Public private life is protected by the constitution of kenya.
    Kindly be honest while filling this questionnaire.
    Incase of assistance call 0741036409. Please follow all steps and fill in information from section A to E.
</p>
<p class="text-small">
    D. Domestic Animals. 
</p>
</div>
</div>

<div class="row bg-light justify-content-center">
<div class="col-lg-12 col-sm-12">
<form action="" method="post" enctype="">

<fieldset>                  
<br>
<h5 class="ml-2">Fill details of the domestic animals you possess:</h5>
<div >
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<tr >
<th>Name</th>
<th>Number</th> 
<th>Species</th>      
<th>More Fields</th>
</tr>
</thead>
<tbody id="dynamic_field3">
<tr>

 
<td> <select  class="col-sm-12" name="name[]" required="true" >
<option value=""> --Select Animal--</option>
    <option value="Pigs"> Pigs</option> 
    <option value="Birds">Birds </option> 
    <option value="Cows"> Cows</option> 
    <option value="Goats">Goats </option>   
</select>
    </td>
<td><input type="number" required="true" class="col-sm-12" name="no[]"></td> 
<td><input type="text" required="true" class="col-sm-12" name="spec[]"></td> 

<td><button type="button" name="add" id="add3" class="btn btn-success"><i class="fa fa-plus"></i></button></td>

</tr>

</tbody>
</table>
</div>

</div>
<br>
<div class="form-row "><br>

<div class="col float-start mx-4">
<a href="departed.php" class="btn btn-primary  mb-4 " value="Save">Back</a>
</div>

<div class="col float-end mx-4">
<button type="submit" id='submit' name="submit" class="btn btn-primary">Save the form data</button>
</div>

</div>
<br>
</fieldset>
</form>
</div>

</div>

</div>
</div>


<?php include('includes/footer.php')?>
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-top float-end"><i class="fa fa-arrow-up"></i></a>

<!--- scripts -->
<script src="js/jquery-3.6.1.min.js"></script>

<script>
$(document).ready(function () {
var i = 1;


$('#add3').click(function () {
i++;
$('#dynamic_field3').append('<tr id="row3' + i + '"><td> <select  class="col-sm-12" name="name[]" required="true" > <option value=""> --Select Animal--</option><option value="Pigs"> Pigs</option> <option value="Birds">Birds </option> <option value="Cows"> Cows</option> <option value="Goats">Goats </option>   </select></td><td><input type="number" required="true" class="col-sm-12" name="no[]"></td> <td><input type="text" required="true" class="col-sm-12" name="spec[]"></td> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' + i + '"><i class="fa fa fa-trash"></i></button></td></tr>');
});
$(document).on('click', '.btn_remove3', function () {
var button_id = $(this).attr("id");

$('#row3' + button_id + '').remove();
});



});
</script>

<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
}



?>