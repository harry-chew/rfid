<?php
include_once('../inc/config.php');
include_once('../inc/db.php');



  if(isset($_POST['name']) && isset($_POST['tagID'])) {
    $name = $_POST['name'];
    $tagID = $_POST['tagID'];
    $db = new DB($server, $username, $password, $dbname);

    if($db->addTag($name, $tagID)) {
      echo 'Added';
    }
  } else {
    echo 'FUCKED';
  }


 ?>
