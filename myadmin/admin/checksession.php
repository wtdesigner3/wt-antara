<?php
session_start();
if($_SESSION['admin_ses']!="hvrs@#p9w84r".session_id())
{
  header("location:login.php");
}
?>