<?php include "db.php"; ?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./css/style_chatpage3.css"/>
    <title>chat box</title>
    <script>
        function ajax() {
            var req = new XMLHttpRequest();
            req.onreadystatechange = function(){
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }
            req.open('GET','chat.php','true');
            req.send();
        }
        setInterval(function(){ajax()},1000);
    </script>
</head>
<body onload="ajax()">
<?php
if(!empty($_REQUEST['id'])){
  $userID = $_REQUEST['id'];

    $select = "SELECT * FROM users WHERE userID = $userID";
    $selectResult= $pdoObj->query($select);
    foreach($selectResult as $row){
      $Access = $row['Access'];
    break;
    }
  }
if(!empty($_REQUEST['id']) && $Access != "management"): 
  $userID = $_REQUEST['id'];
?>
<a class="open-button2" onclick="openFormchat()"> <img src="./img/support.png" alt="support"></a>
<div class="chat-popup2" id="myForm">
  <?php echo "<form action=\"managment.php?id=$userID&accessPage=$Access&sendMessage=true\"  method=\"post\"  class=\"form-container2\" enctype=\"multipart/form-data\">"; ?>
    <h4>پشتیبانی سایت پی سی گارد</h4>
    
    <label for="msg"><b>پاسخگوی سوالات شما عزیزان هستیم</b></label>
	 <div id="chat_info2">
    <?php
    $select = "SELECT * FROM users WHERE userID = $userID";
    $selectResult= $pdoObj->query($select);
    foreach($selectResult as $row){
      $Access = $row['Access'];
    break;
    }
    if($Access == "client"){
      $query = "SELECT * FROM chat WHERE userID2 = '$userID' OR destination = '$userID' ORDER BY chatID";
    }elseif($Access == "employee"){
      $str = "employee";
      $query = "SELECT * FROM chat WHERE userID2 = '$userID' OR destination = '$str' ORDER BY chatID";
    }
    // $query = "SELECT * FROM chat WHERE userID2 = $userID OR destination = $userID ORDER BY chatID";
    $run = $pdoObj->query($query);
    foreach($run as $row){
      $userName = $row['userName'];
      $userID2 = $row['userID2'];
      $select = "SELECT * FROM users WHERE userID = '$userID2' AND fullName = '$userName'";
      $selectResult= $pdoObj->query($select);
      foreach($selectResult as $row2){
        $Access2 = $row2['Access'];
      }
    if($Access2 != "employee"){

      echo "<div id=\"box_chat\">";
      echo "<div id=\"chat_img\" class=\"box-1\">";
      echo "<img src=\"./img/man.svg\" alt=\"img\">";
      echo "</div>";
      echo "<div id=\"chat_data\" class=\"box-2\">";
      echo "<span style=\"float:left;\">" .$row['chatDate'] ."</span>";
      echo "<span style=\"color:green;\">"  .$row['userName'] .$row['userID2'] ." : </span>";
      echo "<br>";
      echo "<span style=\"color:brown;\">" .$row['chatMessage'] ."</span>";
      echo "</div>";
      echo "</div>";
  }
  
    else{
       
              echo "<div id=\"box_chat\" style=\"display: grid; grid-template-areas: 'box-1 box-2' ; grid-gap: 1rem;\">";
              echo "<div id=\"chat_data\" class=\"box-2\" style=\"border-top-left-radius: 1px; border-top-right-radius: 50px;\">";
              echo "<span style=\"float:left;\">" .$row['chatDate'] ."</span>";
              echo "<span style=\"color:green;\">" .$row['userName'] .": </span>";
              echo "<br>";
              echo "<span style=\"color:brown;\">" .$row['chatMessage'] ."</span>";
              echo "</div>";
              echo "<div id=\"chat_img\" class=\"box-1\">";
              echo "<img src=\"./img/man-1.svg\" alt=\"img\">";
              echo "</div>";
              echo "</div>";
       }
    }
    ?>
	</div>
    <div class="mes">
    
    <textarea placeholder="نوشتن پیام ..." name="msg" required></textarea>

    <button type="submit" name="send" class="btnsend"></button>
    <div class="custom-file">
       <input type="file" name="image" class="custom-file-input inputFile" id="image">
        <!-- <label for="image" class="custom-file-label text-left"></label> -->
        </div>
        <?php 
    if($Access == "employee"){
      echo "<input type=\"number\" name=\"destinationID\" class=\"mb-2\" placeholder=\"آی دی مقصد\">";
    }
    ?>
    <button type="button" class="btn cancel" onclick="closeFormchat()"> بستن </button>
        </div>
    
  </form>

</div>
<?php endif; ?>
</body>
</html>