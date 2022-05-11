<?php
include_once('inc/config.php');
include_once('inc/autoload.php');
$db = new db($server, $username, $password, $dbname);

$data = $db->select('*', 'employee');

// print_r('<pre>');
// print_r($data[0]);
// print_r('</pre>');

// $d = array(
//   'name' => 'RF01',
//   'tagID' => 'D4 H3 00 4D 44 8F'
// );
//
// $db->insert($d, 'tags');
// $d = array('name' => 'Katie Brennan');
// $db->insertEmployee($d);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>RFID Dashboard</title>
  </head>
  <body>
    <div class="header">
      <h1>RFID Clock In-Out System</h1>
    </div>

    <div class="content">
      <div class="sidenav">
        <a href="tags.php">Tag Management</a>
      </div>
    </div>
  </body>
</html>
