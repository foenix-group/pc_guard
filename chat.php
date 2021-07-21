<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/style_Dashboard6.css" />

  <title> پیام ها </title>
</head>

<body>

<?php 
if(!empty($_REQUEST['id'])){
  $userID = $_REQUEST['id'];
}
?>
  <nav class="navbar navbar-expand-md navbar-light">
    <button class="navbar-toggler mr-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="myNavbar">

      <div class="container-fluid">

        <div class="row">

          <div class="col-md-3 col-lg-3 col-xl-2 sidebar shadow-lg fixed-top">

          <?php
              if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
                $userID = $_REQUEST['id'];
                $Access = $_REQUEST['accessPage'];
                $select = "SELECT * FROM users WHERE userID = $userID";
                $selectResult= $pdoObj->query($select);
                foreach($selectResult as $row){
                  $profile = $row['imageProfile'];
                  echo "<br>";
                  echo "<div class=\"border-bottom pb-3\">";
                  if($profile == NULL){
                  echo "<img src=\"./img/man.svg\" class=\"rounded-circle mr-3\" width=\"80\" alt=\"profileImage\">";
                  }else{
                  echo "<img src=\"" .$profile ."\" class=\"rounded-circle mr-3\" width=\"80\" alt=\"profileImage\">";
                  }
                  echo "<br>";
              
                  echo "<a href=\"chat.php?id=$userID&accessPage=$Access\" class=\"text-white mr-3\">" .$row['fullName'] ."</a>";
                }
              }
              ?>
            </div>


            <ul class="navbar-nav flex-column mt-4 p-0">
            <?php
              echo "<li class=\"nav-item\"><a class=\"nav-link text-right text-white sidebar-link p-2 mb-2\" href=\"managment.php?id=$userID&accessPage=$Access\"><i class=\"fas fa-home text-light fa-lg ml-3\"></i> داشبورد </a></li>";
              
              if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
                $userID = $_REQUEST['id'];
                $Access = $_REQUEST['accessPage'];
                echo "<li class=\"nav-item\"><a class=\"nav-link text-right text-white sidebar-link p-2 mb-2 current action\" href=\"chat.php?id=$userID&accessPage=$Access&message=in\"><i class=\"fas fa-envelope text-light fa-lg ml-3\"></i> پیام ها </a></li>";
              }
               ?>
   
              
              <?php if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "client") : ?>
                <li class="nav-item"><a class="nav-link text-right text-white sidebar-link p-2 mb-2" href="#">
                <i class="fas fa-money-bill-wave-alt text-light fa-lg ml-3"></i> خرید تیکت </a></li>
        
              <?php endif; ?>
              <?php echo "<li class=\"nav-item\"><a class=\"nav-link text-right text-white sidebar-link p-2 mb-2\" href=\"index.php?id=$userID&accessPage=$Access\"><i class=\"fas fa-home text-light fa-lg ml-3\"></i> صفحه اصلی </a></li>"; ?>

            </ul>

          </div>

          <div class="col-md-9 col-lg-9 col-xl-10 top-navbar mr-auto bg-dark2 fixed-top py-2">

            <div class="row align-items-center">

              <div class="col-md-4">
                <a href="#"
                ><span class="text-primary logo"
                  ><img
                    src="./img/logo.png"
                    alt="Logo"
                    width="150px"
                    height="100px" /></span
              ></a>

              </div>

              <div class="col-md-5">
              </div>

              <div class="col-md-3">

                <ul class="navbar-nav">

                  <li class="navbar-item icon-parent">
                    <a href="#" class="nav-link icon-bullet text-left">
                      <i class="fas fa-comments text-muted fa-lg"></i>
                    </a>
                  </li>

                  <li class="navbar-item icon-parent">
                    <a href="#" class="nav-link icon-bullet text-left"><i class="fas fa-bell text-muted fa-lg"></i></a>
                  </li>

                  <li class="navbar-item mr-auto">
                    <a class="nav-link " href="index.php"><i class="fas fa-sign-out-alt text-danger fa-lg"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
<br>
  <section class="section">

    <div class="container-fluid">

      <div class="row">

        <div class="col-xl-10 col-lg-9 col-md-9 mr-auto">

<br><br>
<!-- HEADER -->
<header class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-6">
        <h3> پیام ها </h3>
      </div>
    </div>
  </div>
</header>
</div>
</div>
</div>
</section>

<?php
        if(isset($_POST['send'])){
                if(!empty($_REQUEST['sendMessage']) && $_REQUEST['sendMessage'] == "true" && !empty($_REQUEST['id'])){
                  $userID = $_REQUEST['id'];
                  $select = "SELECT * FROM users WHERE userID = $userID";
                  $selectResult= $pdoObj->query($select); 
                  foreach($selectResult as $row){
                      $fullName = $row['fullName'];
                      $imageProfile = $row['imageProfile'];
                      $Access = $row['Access'];
                  }
                  try{
                      $chatMessage = $_POST['msg'];
                      $today = date("Y-m-d H:m:s");
                      if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
                        $validMimeTypes = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/PNG');
                        $validFileExt = array('.gif','.jpeg','.jpg','.JPG', '.png','.PNG');
                        $file_info = new finfo(FILEINFO_MIME_TYPE);
                        $binaryFileStr = file_get_contents($_FILES['image']['tmp_name']);
                        $mime_type = $file_info->buffer($binaryFileStr);
                        $fileExtIndex = array_search(strtolower($mime_type),$validMimeTypes);
                        if($fileExtIndex != false){
                        $ext = $validFileExt[$fileExtIndex];
                        }else{
                        echo " فرمت تصویر وارد شده درست نیست ";
                        exit();
                        }
                
                    $ImageDir = "img/";
                    $imageName = explode('.',$_FILES['image']['name']);
                    $tmpImageUrl = $ImageDir.$imageName[0].$ext;
                    $moveOperation = move_uploaded_file($_FILES['image']['tmp_name'], $tmpImageUrl);
                    if($Access == "client"){
                      $destination = "employee";
                    }elseif($Access == "employee"){
                      $destination = $_POST['destinationID'];
                    }
                    if($moveOperation == true){  
                      $insert = "INSERT INTO chat
                      (userName, chatMessage, chatDate, imageName, imageProfile, userID2, destination)
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
                      $insertStmnt = $pdoObj->prepare($insert);
                      $insertStmnt->execute([$fullName,$chatMessage,$today,$imageName,$imageProfile,$userID,$destination]);


                      $chatID = $pdoObj->lastInsertId();
                      $randomName = bin2hex(random_bytes(10));
                      $uniqueFileName = $randomName.$picId.$ext;
                      $imageUrl = "img/" . $uniqueFileName;
                      $renameOp = rename($tmpImageUrl, $imageUrl);
  
                      if($renameOp == true){
                      $update = "UPDATE chat SET imageName = '$imageUrl' WHERE chatID = $chatID AND userID2 = $userID";
                      $pdoObj->query($update);    
          } else{
          echo "<br> تغییر نام فایل به درستی انجام نشده است<br>";
          exit();
          }
                  }else{
                    echo "<br>File Submission Error1!<br>";
                    exit();
                    }
                  
                  }else{
                    if($Access == "client"){
                      $destination = "employee";
                    }elseif($Access == "employee"){
                      $destination = $_POST['destinationID'];
                    }
                    $insert = "INSERT INTO chat
                      (userName, chatMessage, chatDate, imageProfile, userID2, destination)
                      VALUES (?, ?, ?, ?, ?, ?)";
                      $insertStmnt = $pdoObj->prepare($insert);
                      $insertStmnt->execute([$fullName,$chatMessage,$today,$imageProfile,$userID,$destination]);
                    }
                  }catch(PDOException $e){
                      echo "Error: " . $e->getMessage();
                      exit();
                      }
              
                  }
              }
?>
<section class="section">
<div class="container-fluid">
  <div class="row">

    <div class="col-xl-12 col-lg-9 col-md-9 mr-auto">
<section class="section">
<div class="container-fluid">
<?php
$select = "SELECT * FROM emailMessage";
$selectResult= $pdoObj->query($select);
foreach($selectResult as $row){
	$messageID = $row['messageID'];
  echo "<div class=\"row mt-3 mb-2\">";
    echo "<i class=\"far fa-comment text-info fa-4x mr-auto mt-1 text-right\"></i>";
    echo "<div class=\"col-xl-9 col-lg-9 col-md-9 \">";
         echo "<div class=\"comment-context media-body text-white bg-dark p-2\">";
                echo "<p>" .$row['messageDate'] ."</p>";
                echo "<h5 class=\"text-right\"><u>" .$row['fullName'] ."</u></h5>";
                echo "<p> آدرس ایمیل :" .$row['email'] ."</p>";
                echo "<hr>";
                echo "<div class=\"mt-2\">";
                    echo "<b> متن پیام : </b>";
                    echo "<p class=\"mt-1\">" .$row['messageText'] ."</p>";
                echo "</div>";
        echo "</div>";
        echo "<a class=\"btn btn-outline-info mt-2\" href=\"chat.php?id=$userID&accessPage=$Access&messageID=$messageID\"> ارسال ایمیل </a>";
    echo "</div>";
  echo "</div>";
}
?>
</div>
</section>

<?php include "chat_page.php"; ?>

<script>
function openFormchat() {
  document.getElementById("myForm").style.display = "block";
}

function closeFormchat() {
  document.getElementById("myForm").style.display = "none";
}
</script>

  <script src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
    integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
  <script>
    CKEDITOR.replace('body');
  </script>
  <script src="./js/script.js"></script>
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
</body>

</html>