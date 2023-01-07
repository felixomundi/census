

<nav class="navbar navbar-expand-lg bg-light sticky-top">
<div class="container-fluid">
<a class="navbar-brand" href="./index.php">
<img src="img/logo.jpg" width="30" height="24" class="d-inline-block fw-bold text-dark align-text-top">
E-CENSUS
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
<span class="fa fa-bars"></span>
</button>
<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">

<li class="nav-item d-md-none dropdown">
<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
<?php 
$email = $_SESSION['login'];
$sql2 = "SELECT users.* FROM `users` WHERE `email`=:email and status=1 ;";
$query = $dbh->prepare($sql2);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if ($query->rowCount() > 0) {
foreach ($results as $result) {
} 
?>
<img
src="photo/<?php echo $result->profilepic; ?>"
class="rounded-circle"
height="25"
alt="<?php echo $result->fname; ?>"
loading="lazy"
/><?php  echo htmlspecialchars($result->fname); }?></a>
<ul class="dropdown-menu">


<li>
<a class="dropdown-item" href="profile.php">My profile</a>
</li>
<li>
<a class="dropdown-item" href="update-profile.php">Update Profile Image</a>
</li>
<li>
<a class="dropdown-item" href="update-password.php">Update Password</a>
</li>
<li>
<a class="dropdown-item" href="logout.php">Logout</a>
</li>

</ul>
</li>

</ul>

</div>
</div>
<div class="d-flex  align-text-center">

<!-- Avatar -->
<div class="dropdown d-none d-md-inline">

<a
class="dropdown-toggle d-flex align-items-center hidden-arrow"
href="#"
id="navbarDropdownMenuAvatar"
role="button"
data-bs-toggle="dropdown"
aria-expanded="false"
>


<?php 
$email = $_SESSION['login'];
$sql2 = "SELECT users.* FROM `users` WHERE `email`=:email and status=1 ;";
$query = $dbh->prepare($sql2);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
foreach ($results as $result) {



} 
?>

<img
src="photo/<?php echo $result->profilepic; ?>"
class="rounded-circle"
height="25"
alt=""
loading="lazy"
/>

<?php  echo htmlspecialchars($result->fname); }?>
</a>
<ul
class="dropdown-menu dropdown-menu-end"
aria-labelledby="navbarDropdownMenuAvatar"
>


<li>
<a class="dropdown-item" href="profile.php">My profile</a>
</li>
<li>
<a class="dropdown-item" href="update-profile.php">Update Profile Image</a>
</li>
<li>
<a class="dropdown-item" href="update-password.php">Update Password</a>
</li>
<li>
<a class="dropdown-item" href="logout.php">Logout</a>
</li>
</ul>
</div>
</div>
<!-- Right elements -->
</nav>
