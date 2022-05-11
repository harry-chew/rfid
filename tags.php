<?php
include_once('inc/config.php');
include_once('inc/classes/db.php');

// print_r('<pre>');
// print_r($data[0]);
// print_r('</pre>');

// $d = array(
//   'name' => 'RF01',
//   'tagID' => 'D4 H3 00 4D 44 8F'
// );
//
// $db->insert($d, 'tags');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>RFID Tags</title>
  </head>
  <body>
    <div class="header">
      <h1>RFID Clock In-Out System</h1>
    </div>

    <div class="content">
      <div class="sidenav">
        <a href="index.php">Home</a>
        <a href='#' onclick="showAddTag()">Add Tag</a>
        <a href="#" onclick="showViewTags()">View Tags</a>
      </div>
      <div class="main">
        <div id="add-tag" class="">
            <label for="name">Name:</label>
            <input id='name' type="text" name="name" value=""><br>
            <label for="tagID">Tag ID:</label>
            <input id='tagID' type="text" name="tagID" value=""><br>
            <button onclick="sendAddTag()" value="Add Tag">Add Tag</button>
        </div>
        <div id="view-tags" class="">
          <?php
          $db = new db($server, $username, $password, $dbname);
          $data = $db->select("*", "tags");

          foreach($data as $d => $v) {
            echo $v['name'] . " | " . $v['tagID'] . "</br>";
          }

           ?>
        </div>
        <p id="message"></p>
      </div>
    </div>
    <script type="text/javascript">





    var addTagButton = document.getElementById('a-tag');
    var addTagForm = document.getElementById('add-tag');
    var viewTagsDiv = document.getElementById('view-tags');
    function showAddTag() {
      var displayType = addTagForm.style.display;

      if(displayType == "none") {
        addTagForm.style.display = "block";
      } else {
        addTagForm.style.display = "none";
      }
    }

    function showViewTags() {
      var displayType = viewTagsDiv.style.display;

      if(displayType == "none") {
        viewTagsDiv.style.display = "block";
      } else {
        viewTagsDiv.style.display = "none";
      }
    }

    if (document.readyState === "complete") {
        // already fired, so run logic right away
        showAddTag();
    } else {
        // not fired yet, so let's listen for the event
        window.addEventListener("DOMContentLoaded", showAddTag());
    }


        function sendAddTag() {
          const xhttp = new XMLHttpRequest();
          var name = document.querySelector('#name').value;
          var tagID = document.querySelector('#tagID').value;
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("message").innerHTML = this.responseText;
            }
          };
          xhttp.open("POST", "scripts/add-tag.php", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          console.log("name="+name+"&tagID="+tagID);
          xhttp.send("name="+name+"&tagID="+tagID);
        }

    </script>
  </body>
</html>
