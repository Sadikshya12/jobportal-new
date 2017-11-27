<?php $this->render('includes/header') ?>
<?php
//if (!isset($_SESSION['username'])){
  //header('Location: index.php?action=login');
//}
?>


<?php
//$id = $_SESSION['id'];
//$user = new User();
//$udetail = $user->edit($id);

?>




<h1>My Account</h1>


<h2>Details

<?php //echo $udetail[0]['username']; ?></h2>
<?php $this->render('includes/footer') ?>