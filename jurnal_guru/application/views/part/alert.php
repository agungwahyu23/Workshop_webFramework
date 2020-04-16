<?php 
if(isset($_SESSION['msg'])) {
  echo "<div class='alert alert-".$_SESSION['msg'][0]."'>".$_SESSION['msg'][1]."</div>";
  unset($_SESSION['msg']); }
 ?>