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

  <title>
  <?php 
  if(!empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "managment"){
    echo "پنل مدیریت";
  }elseif(!empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "employee"){
    echo "پنل کارمندان";
  }elseif(!empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "client"){
    echo "پنل کاربری";
  }
  ?>   
  </title>
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
              
                  echo "<a href=\"managment.php?id=$userID&accessPage=$Access\" class=\"text-white mr-3\">" .$row['fullName'] ."</a>";
                }
              }
              ?>
            </div>


            <ul class="navbar-nav flex-column mt-4 p-0">
            <?php
            echo "<li class=\"nav-item\"><a class=\"nav-link text-right text-white sidebar-link p-2 mb-2 current action\" href=\"managment.php?id=$userID&accessPage=$Access\"><i class=\"fas fa-home text-light fa-lg ml-3\"></i> داشبورد </a></li>";

              
               if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "managment") : 
                if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
                  $userID = $_REQUEST['id'];
                  $Access = $_REQUEST['accessPage'];
                  echo "<li class=\"nav-item\"><a class=\"nav-link text-right text-white sidebar-link p-2 mb-2\" href=\"chat.php?id=$userID&accessPage=$Access&message=in\"><i class=\"fas fa-envelope text-light fa-lg ml-3\"></i> پیام ها </a></li>";
                }
               ?>
                    
              <?php endif; ?>
              <?php if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "employee") :
                
                if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
                  $userID = $_REQUEST['id'];
                  $Access = $_REQUEST['accessPage'];
                  echo "<li class=\"nav-item\"><a class=\"nav-link text-right text-white sidebar-link p-2 mb-2\" href=\"chat.php?id=$userID&accessPage=$Access&message=in\"><i class=\"fas fa-envelope text-light fa-lg ml-3\"></i> پیام ها </a></li>";
                }
                
                  if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
                    $userID = $_REQUEST['id'];
                    $Access = $_REQUEST['accessPage'];
                    $select = "SELECT * FROM users WHERE userID = $userID";
                    $selectResult= $pdoObj->query($select);
                    foreach($selectResult as $row){
                      if($row['nationalCode'] == NULL || $row['email'] == NULL || $row['fullAddress'] == NULL || $row['age'] == NULL || $row['gender'] == NULL || $row['maritalStatus'] == NULL || $row['imageProfile'] == NULL){
                    echo "<li class=\"nav-item\"><a class=\"nav-link text-right text-white sidebar-link p-2 mb-2 \" href=\"#\" onclick=\"openFormEmployeeInformation()\"  ><i class=\"fas fa-file-alt text-light fa-lg ml-3\"></i> تکمیل اطلاعات </a></li>";
                      }
                    }
                  }
                     ?>
                     
              <?php endif; ?>
              <?php if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "client") : ?>
                <li class="nav-item"><a class="nav-link text-right text-white sidebar-link p-2 mb-2" href="#" onclick="openFormTiket()">
                <i class="fas fa-money-bill-wave-alt text-light fa-lg ml-3"></i> خرید تیکت </a></li>
                <?php 
                  if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
                    $userID = $_REQUEST['id'];
                    $Access = $_REQUEST['accessPage'];
                    $select = "SELECT * FROM users WHERE userID = $userID";
                    $selectResult= $pdoObj->query($select);
                    foreach($selectResult as $row){
                      if($row['email'] == NULL || $row['fullAddress'] == NULL || $row['age'] == NULL || $row['gender'] == NULL || $row['imageProfile'] == NULL){
                    echo "<li class=\"nav-item\"><a class=\"nav-link text-right text-white sidebar-link p-2 mb-2 \" href=\"#\" onclick=\"openFormClientInformation()\"  ><i class=\"fas fa-file-alt text-light fa-lg ml-3\"></i> تکمیل اطلاعات </a></li>";
                      }
                    }
                  }
                     ?>
              <?php endif; ?>
              <?php 
                  echo "<li class=\"nav-item\"><a class=\"nav-link text-right text-white sidebar-link p-2 mb-2\" href=\"index.php?id=$userID&accessPage=$Access\"><i class=\"fas fa-home text-light fa-lg ml-3\"></i> صفحه اصلی </a></li>";
                ?>

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
        <h3>
          <i class="fas fa-cog" ></i> داشبورد </h3>
      </div>

    </div>

  </div>

</header>
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

if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "managment") :

  echo "<div class=\"text-center mb-2\">";
if(isset($_POST['signup'])){
  if(!empty($_POST['fullName']) && !empty($_POST['phoneNumber']) && !empty($_POST['password']) && !empty($_POST['re_password'])){
    $password = $_POST['password'];
    $REpassword = $_POST['re_password'];
    if($REpassword == $password){
      $fullName = $_POST['fullName'];
      $phoneNumber = $_POST['phoneNumber'];
      $select2 = "SELECT * FROM users WHERE phoneNumber = $phoneNumber";
      $selectResult2= $pdoObj->query($select2);
      $count2 = $selectResult2->rowCount();
        if($count2 >0 ){
          echo "<b> <font color=\"red\">  !!! شماره تلفن وارد شده قبلا ثبت نام شده است !!!</font> </b>";
          echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
        exit;
        }else{
          $Access = "employee";
          $insert = "INSERT INTO users
          (fullName, phoneNumber, pass, Access)
          VALUES (?, ?, ?, ?)";
          $insertStmnt = $pdoObj->prepare($insert);
          $insertStmnt->execute([$fullName,$phoneNumber,$password,$Access]);
          if($insertStmnt == true){
            echo "<b><font color=\"green\"> اطلاعات به درستی ذخیره شده </font></b>";
            echo "<br><a class=\"btn btn-outline-success text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> ادامه </a>";
          exit;
          }else{
            echo "<b> <font color=\"red\">  !!!اطلاعات به درستی ذخیره نشده است!!!</font> </b>";
            echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
          exit;
          }
        }
    }else{
      echo "<b> <font color=\"red\"> !!!پسوورد ها با هم برابر نیستند!!!</font></b>";
      echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
      exit;
    }
  }else{
    echo "<b> <font color=\"red\">  !!!لطفا تمامی اطلاعات را به درستی وارد کنید!!!</font> </b>";
    echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
    exit;
  }

}
echo "</div>";
?>
              <section id="actions" class="mb-4">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="card border-right-success shadow py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <h5 class="font-weight-bold text-success mb-3"><i class="fas fa-pencil-alt text-muted"> </i> پست ها
                              </h5>
                              <h2 class="count mb-0 font-weight-bold text-muted"> 2 </h2>
                            </div>
                            <div class="col-auto">
                              <a href="#" data-toggle="modal" data-target="#addPostModal" onclick="openFormAddPost()">
                                <i class="fas fa-plus-circle fa-3x text-success"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="card border-right-info shadow py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <h5 class="font-weight-bold text-info mb-3"><i class="fas fa-users text-muted"></i> کارمندان
                              </h5>
                              <h2 class="count mb-0 font-weight-bold text-muted">
                                <?php 
                                $employee_str = "employee";
                                $select = "SELECT * FROM users WHERE Access = '$employee_str'";
                                $selectResult= $pdoObj->query($select);
                                $numberEmployee=0;
                                foreach($selectResult as $row){
                                  $numberEmployee++;
                                }
                                echo $numberEmployee;
                                ?>
                                </h2>
                            </div>
                            <div class="col-auto">
                              <a href="#"  onclick="openFormAddEmployee()">
                                <i class="fas fa-plus-circle fa-3x text-info"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
                </section>

              <!-- POSTS -->
              <section id="posts">
                <div class="container">
                  <div class="row">
                    <div class="col-md-9">
                      <!-- <div class="card"> -->
                        <!-- <div class="card-header">
                          <h4> آمار کار های انجام شده </h4>
                        </div> -->
                        <?php
              $select = "SELECT * FROM users";
              $selectResult= $pdoObj->query($select);

                    echo "<h4 class=\"text-center text-muted font-weight-bold mb-3\"> کاربران و کارمندان </h4>";
                    echo "<table class=\"table bg-light text-center\">";
                    echo "<thead class=\"thead-dark\">";
                    echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th> نام و نام خانوادگی </th>";
                    echo "<th> شماره تلفن </th>";
                    echo "<th> ایمیل </th>";
                    echo "<th> آدرس </th>";
                    echo "<th> نوع دسترسی </th>";
                    echo "<th> مشاهده پروفایل </th>";
                    echo "</tr>";
                        echo "</thead>";
                        
                      
                       echo "<tbody>";
                       foreach($selectResult as $row){
                         echo "<tr>";
                         echo "<td>" .$row['userID'] ."</td>";
                         echo "<td>" .$row['fullName'] ."</td>";
                         echo "<td>" .$row['phoneNumber'] ."</td>";
                         echo "<td>" .$row['email'] ."</td>";
                         echo "<td>" .$row['fullAddress'] ."</td>";
                         echo "<td>" .$row['Access'] ."</td>";
                         echo "<td><a href=\"#\" class=\"btn btn-outline-info\"> مشاهده </a></td>";
                           echo "</tr>";
                       }
                       echo "</tbody>";
                       echo "</table>";
                       ?>

                      <!-- </div> -->
                    </div>
                    <div class="col-md-3">
                      <div class="card border-bottom-danger shadow mb-3 py-2">          
                        <div class="card-body">            
                          <div class="row no-gutters align-items-center">            
                            <div class="col text-center mr-2">            
                              <h5 class="font-weight-bold text-muted mb-3"><i class="fas fa-dollar-sign text-muted"> </i> فروش در
                                ماه
                              </h5>
                              <h5 class="mb-0 font-weight-bold text-muted"> 1200000 میلیون </h5>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card border-bottom-danger shadow mb-3 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col text-center mr-2">
                              <h5 class="font-weight-bold text-muted mb-3"><i class="fas fa-calendar text-muted"> </i> آمار فروش
                              </h5>
                              <h5 class="mb-0 font-weight-bold text-muted"> 1 ماه اخیر </h5>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card border-bottom-danger shadow mb-3 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col text-center mr-2">
                              <h5 class="font-weight-bold text-muted mb-3"><i class="fas fa-comments  text-muted"> </i> پیام
                              </h5>
                              <h5 class="mb-0 font-weight-bold text-muted"> 123 </h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
             
              <?php endif; ?>
<?php if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "employee") : 

echo "<div class=\"text-center mb-2\">";
if(isset($_POST['sendEmplyeeInfo'])){
  if(!empty($_REQUEST['information']) && $_REQUEST['information'] == "true" && !empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
    $userID = $_REQUEST['id'];
    $Access = $_REQUEST['accessPage'];
    // $select = "SELECT * FROM users WHERE userID = $userID";
    // $selectResult= $pdoObj->query($select); 
    // foreach($selectResult as $row){
    //     $fullName = $row['fullName'];
    //     $imageProfile = $row['imageProfile'];
    //     $Access = $row['Access'];
    // }
    if(!empty($_POST['nationalCode']) && !empty($_POST['email']) && !empty($_POST['fullAddress']) && !empty($_POST['age'])){
      $nationalCode = $_POST['nationalCode'];
      $email = $_POST['email'];
      $fullAddress = $_POST['fullAddress'];
      $gender = $_POST['gender'];
      $status = $_POST['status'];
      $age = $_POST['age'];
    try{
        // $chatMessage = $_POST['msg'];
        // $today = date("Y-m-d H:m:s");
        if(isset($_FILES['profileImage']) && $_FILES['profileImage']['size'] > 0 ){
          $validMimeTypes = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/PNG');
          $validFileExt = array('.gif','.jpeg','.jpg','.JPG', '.png','.PNG');
          $file_info = new finfo(FILEINFO_MIME_TYPE);
          $binaryFileStr = file_get_contents($_FILES['profileImage']['tmp_name']);
          $mime_type = $file_info->buffer($binaryFileStr);
          $fileExtIndex = array_search(strtolower($mime_type),$validMimeTypes);
          if($fileExtIndex != false){
          $ext = $validFileExt[$fileExtIndex];
          }else{
          echo " فرمت تصویر وارد شده درست نیست ";
          echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
          exit();
          }

          // $validMimeTypes2 = array('image/PDF','image/pdf');
          // $validFileExt2 = array('.PDF','.pdf');
          // $file_info2 = new finfo(FILEINFO_MIME_TYPE);
          // $binaryFileStr2 = file_get_contents($_FILES['resome']['tmp_name']);
          // $mime_type2 = $file_info2->buffer($binaryFileStr2);
          // $fileExtIndex2 = array_search(strtolower($mime_type2),$validMimeTypes2);
          // if($fileExtIndex2 != false){
          // $ext2 = $validFileExt2[$fileExtIndex2];
          // }else{
          // echo " فرمت رزومه وارد شده درست نیست ";
          // echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
          // exit();
          // }
  
      $ImageDir = "img/";
      $imageName = explode('.',$_FILES['profileImage']['name']);
      $tmpImageUrl = $ImageDir.$imageName[0].$ext;
      $moveOperation = move_uploaded_file($_FILES['profileImage']['tmp_name'], $tmpImageUrl);
      
      // $FileDir2 = "resome/";
      // $FileName2 = explode('.',$_FILES['resome']['name']);
      // $tmpFileUrl2 = $FileDir.$FileName2[0].$ext2;
      // $moveOperation2 = move_uploaded_file($_FILES['resome']['tmp_name'], $tmpFileUrl2);
      
      if($moveOperation == true){  
        // $insert = "INSERT INTO users
        // (nationalCode, email, fullAddress, gender, maritalStatus, imageProfile)
        // VALUES (?, ?, ?, ?, ?, ?)";
        // $insertStmnt = $pdoObj->prepare($insert);
        // $insertStmnt->execute([$fullName,$chatMessage,$today,$imageName,$imageProfile,$userID]);


        $chatID = $pdoObj->lastInsertId();
        $randomName = bin2hex(random_bytes(10));
        $uniqueFileName = $randomName.$userID.$ext;
        $imageUrl = "img/" . $uniqueFileName;
        $renameOp = rename($tmpImageUrl, $imageUrl);

        // $randomName2 = bin2hex(random_bytes(10));
        // $uniqueFileName2 = $randomName2.$picId.$ext2;
        // $FileUrl2 = "resome/" . $uniqueFileName2;
        // $renameOp2 = rename($tmpFileUrl2, $FileUrl2);

        if($renameOp == true){
        $update = "UPDATE users SET nationalCode = '$nationalCode' , age = '$age' , email = '$email' , fullAddress = '$fullAddress' , gender = '$gender' , maritalStatus = '$status' , imageProfile = '$imageUrl' WHERE userID = $userID";
        $pdoObj->query($update);    
} else{
echo "<br> تغییر نام فایل به درستی انجام نشده است<br>";
echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
exit();
}
    }else{
      echo "<br>File Submission Error1!<br>";
      echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
      exit();
      }
    
    }else{
      echo "<br> عکس پرسنلی وارد نشده است <br>";
      // echo "<br> رزومه ارسال نشده است <br>";
      echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
      exit;
      }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
        exit();
        }
      }else{
        echo "<br> لطفا تمامی فیلد ها را پر کنید <br>";
        echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
        exit();
      }

    }
}
echo "</div>";
?>
              <section class="section">
              <div class="container-fluid">
              <div class="row ">
              <div class="col-xl-12 col-lg-9 col-md-9 ">
                <div class="row pt-md-5 mb-md-5">
                  <div class="col-sm-6 col-lg-3 p-2">
                    <div class="card shadow">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div class="text-muted">
                            <h5>درخواست</h5>
                            <h5>20 </h5>
                          </div>
                          <i class="fas fa-users fa-3x text-info"></i>
                        </div>
                      </div>
                      <div class="card-footer">
                        <i class="fas fa-sync"></i>
                        <span>آپدیت</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3 p-2">
                    <div class="card shadow">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div class="text-muted">
                            <h5>نظرات</h5>
                            <h5> 120 </h5>
                          </div>
                          <i class="fas fa-clipboard-list fa-3x text-danger"></i>
                        </div>
                      </div>
                      <div class="card-footer">
                        <i class="fas fa-sync"></i>
                        <span> آپدیت </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3 p-2">
                    <div class="card shadow">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div class="text-muted">
                            <h5> پست </h5>
                            <h5> 50 </h5>
                          </div>
                          <i class="fas fa-pencil-alt fa-3x text-success"></i>
                        </div>
                      </div>
                      <div class="card-footer">
                        <i class="fas fa-sync"></i>
                        <span>آپدیت</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-3 p-2">
                    <div class="card shadow">
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <div class="text-muted">
                            <h5> امتیاز </h5>
                            <h5> 50 </h5>
                          </div>
                          <i class="fas fa-star fa-3x text-warning"></i>
                        </div>
                      </div>
                      <div class="card-footer">
                        <i class="fas fa-sync"></i>
                        <span>آپدیت</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              </div>
              </section>
              
              
              <?php endif; ?>
              <?php if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] != "client") : ?>

              <h4 class="text-center text-muted font-weight-bold mb-3"> جدول فروش </h4>
              <table class="table bg-light text-center">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th> نام کاربر </th>
                    <th> نوع مشکل </th>
                    <th> تعداد تیکت </th>
                    <th> هزینه پرداخت شده </th>
                  </tr>
                </thead>

                <?php 
                $select = "SELECT * FROM buyingTicket";
                $selectResult= $pdoObj->query($select);
                ?>
            
                <tbody>
                  <?php
                  $i =0;
                  function hazineTicket($num){
                    return $num*=1000;
                  }
                  foreach($selectResult as $row){
                    $i++;
                    $userId = $row['userID'];
                    $select2 = "SELECT * FROM users WHERE userID=$userId";
                    $selectResult2= $pdoObj->query($select2);
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    foreach($selectResult2 as $row2){
                    echo "<td>" .$row2['fullName'] ."</td>";
                    break; 
                    }
                    echo "<td>" .$row['title'] ."</td>";
                    echo "<td>" .$row['num'] ."</td>";

                    echo "<td>" .hazineTicket($row['num']) ."</td>";
                  echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section class="section">
    <div class="container-fluid">
      <div class="row my-5">
        <div class="col-xl-10 col-lg-9 col-md-9 mr-auto">
          <div class="row align-items-center">
            <div class="col-lg-12 mb-4">
              <div class="bg-dark text-white rounded p-4">
                <h4 class="text-muted font-weight-bold mb-4"> درصدها </h4>
                <h6 class="my-3"> رضایتمندی مشتریان </h6>
                <div class="progress" style="height: 20px">
                  <div class="progress-bar progress-bar-striped bg-danger font-weight-bold" style="width: 80%">80%</div>
                </div>
                <h6 class="my-3"> پروژه </h6>
                <div class="progress" style="height: 20px">
                  <div class="progress-bar progress-bar-striped bg-info font-weight-bold" style="width: 46%">46%</div>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="section">

    <div class="container-fluid">

      <div class="row my-5 ">
        <div class="col-xl-10 col-lg-9 col-md-9 mr-auto">
          <div class="row align-items-center">
            <div class="col-lg-12 mb-4">
              <h4 class="text-muted font-weight-bold mb-4 text-center"> کامنت های اخیر کارمندان </h4>
                <div class="card">
                  <div class="card-header">
                    <button data-toggle="collapse" data-target="#collapseOne" class="btn btn-secondary btn-block"><img
                        class="ml-2" width="50" src="./img/man.svg" alt="">
                      کامنت جدید توسط سجاد رعیت </button>
                  </div>
                  <div class="collapse show" id="collapseOne">
                    <div class="card-body">
                      لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.لورم
                      ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <button data-toggle="collapse" data-target="#collapseTwo" class="btn btn-secondary btn-block"><img
                        class="ml-2" width="50" src="./img/woman.svg" alt="">
                      کامنت جدید توسط زهرا دشت پیما </button>
                  </div>
                  <div class="collapse show" id="collapseTwo">
                    <div class="card-body">
                      لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.لورم
                      ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <button data-toggle="collapse " data-target="#collapseThree" class="btn btn-secondary btn-block"><img
                        class="ml-2" width="50" src="./img/man-1.svg" alt="">
                        کامنت جدید توسط بهرام دشتی </button>
                      </div>
                  <div class="collapse show" id="collapseThree">
                    <div class="card-body">
                      لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.لورم
                      ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <button data-toggle="collapse" data-target="#collapseFour" class="btn btn-secondary btn-block"><img
                        class="ml-2" width="50" src="./img/woman-1.svg" alt="">
                        کامنت جدید توسط لیلا گنبدی </button>
                      </div>
                  <div class="collapse show" id="collapseFour">
                    <div class="card-body">
                      لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.لورم
                      ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    </div>
                  </div>
                </div>
                
                <div class="card">
                  <div class="card-header">
                    <button data-toggle="collapse" data-target="#collapseFour" class="btn btn-secondary btn-block"><img
                        class="ml-2" width="50" src="./img/woman-1.svg" alt="">
                        کامنت جدید توسط مریم ظرافت طاش </button>
                      </div>
                  <div class="collapse show" id="collapseFour">
                    <div class="card-body">
                      لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.لورم
                      ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage']) && $_REQUEST['accessPage'] == "client") :
   
   echo "<div class=\"text-center mb-2\">";
if(isset($_POST['sendClientInformation'])){
  if(!empty($_REQUEST['information']) && $_REQUEST['information'] == "true" && !empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
    $userID = $_REQUEST['id'];
    $Access = $_REQUEST['accessPage'];
    if(!empty($_POST['email']) && !empty($_POST['fullAddress']) && !empty($_POST['age'])){
      $email = $_POST['email'];
      $fullAddress = $_POST['fullAddress'];
      $gender = $_POST['gender'];
      $age = $_POST['age'];
    try{
        if(isset($_FILES['profileImage']) && $_FILES['profileImage']['size'] > 0 ){
          $validMimeTypes = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/PNG');
          $validFileExt = array('.gif','.jpeg','.jpg','.JPG', '.png','.PNG');
          $file_info = new finfo(FILEINFO_MIME_TYPE);
          $binaryFileStr = file_get_contents($_FILES['profileImage']['tmp_name']);
          $mime_type = $file_info->buffer($binaryFileStr);
          $fileExtIndex = array_search(strtolower($mime_type),$validMimeTypes);
          if($fileExtIndex != false){
          $ext = $validFileExt[$fileExtIndex];
          }else{
          echo " فرمت تصویر وارد شده درست نیست ";
          echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
          exit();
          }

      $ImageDir = "img/";
      $imageName = explode('.',$_FILES['profileImage']['name']);
      $tmpImageUrl = $ImageDir.$imageName[0].$ext;
      $moveOperation = move_uploaded_file($_FILES['profileImage']['tmp_name'], $tmpImageUrl);
      
      if($moveOperation == true){  

        $chatID = $pdoObj->lastInsertId();
        $randomName = bin2hex(random_bytes(10));
        $uniqueFileName = $randomName.$userID.$ext;
        $imageUrl = "img/" . $uniqueFileName;
        $renameOp = rename($tmpImageUrl, $imageUrl);

        if($renameOp == true){
        $update = "UPDATE users SET age = '$age' , email = '$email' , fullAddress = '$fullAddress' , gender = '$gender' , imageProfile = '$imageUrl' WHERE userID = $userID";
        $pdoObj->query($update);    
} else{
echo "<br> تغییر نام فایل به درستی انجام نشده است<br>";
echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
exit();
}
    }else{
      echo "<br>File Submission Error1!<br>";
      echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
      exit();
      }
    
    }else{
      echo "<br> عکس پرسنلی وارد نشده است <br>";
      // echo "<br> رزومه ارسال نشده است <br>";
      echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
      exit;
      }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
        exit();
        }
      }else{
        echo "<br> لطفا تمامی فیلد ها را پر کنید <br>";
        echo "<br><a class=\"btn btn-outline-info text-center mt-2\" href=\"managment.php?id=$userID&accessPage=$Access\"> تلاش مجدد </a>";
        exit();
      }

    }
}
if(!empty($_REQUEST['ticketInformation']) && $_REQUEST['ticketInformation'] == "true" && !empty($_REQUEST['id']) && !empty($_REQUEST['accessPage']) ){
  if(isset($_POST['sendTicketInformation'])){
      if(!empty($_POST['numOfTickets'])){
          $numTick = $_POST['numOfTickets'];
          $titlePro = $_POST['titleOfProblem'];
          $userID = $_REQUEST['id'];
          try{
             $insert = "INSERT INTO buyingTicket
           (userID, num, title)
             VALUES (?, ?, ?)";
           $insertStmnt = $pdoObj->prepare($insert);
           $insertStmnt->execute([$userID,$numTick,$titlePro]);
          echo "<div class=\"text-center text-success\">";
          echo "خرید تیکت ها با موفقیت انجام شد.";
          echo "</div>";
          }catch(PDOException $e){
              echo "<div class=\"text-center text-danger\">";
                echo "Error: " . $e->getMessage();
              echo "</div>";
            }
      }else{
          echo "<div class=\"text-center text-danger\">";
          echo "!!!تعداد تیکت مورد نظر را وارد کنید!!!";
          echo "</div>";
      }
  }
}
echo "</div>";
   ?>

<h4 class="mb-4"><b> تیکت های خریداری شده </b></h4>

  <div class="container text-center">
  <div class="row">
  <?php
   $select = "SELECT * FROM buyingTicket WHERE userID = $userID";
   $selectResult= $pdoObj->query($select);
    function hazineTicket($num){
      return $num*=1000;
    }
    foreach($selectResult as $row){
    echo "<div class=\"col-md-4 mb-3\">";
    echo "<div class=\"card shadow py-2\">";
    echo "<div class=\"card-body\">";
    echo "<div class=\"row no-gutters align-items-center\">";
    echo "<div class=\"col mr-2\">";
    echo "<i class=\"fas fa-money-bill-wave-alt text-success fa-lg ml-3 fa-6x mb-3\"></i>";
    echo "<p> عنوان :" .$row['title'] ."</p>";
    echo "<p> تعداد تیکت :" .$row['num'] ."</p>";
    echo "<p> هزینه تیکت :" .hazineTicket($row['num']) ."</p>";
    
    echo "</div></div></div></div></div>";
    }
  ?>
  </div>
  </div>
  <?php endif; ?>
              <!-- ADD POST MODAL -->
              <div class="modal" id="addPostModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                      <h5 class="modal-title"> ایجاد پست جدید </h5>
                      <button class="close ml-0" onclick="closeFormAddPost()" data-dismiss="modal">
                        <span>&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group">
                          <label for="title"> نام </label>
                          <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="image"> آپلود تصویر </label>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image">
                            <label for="image" class="custom-file-label text-left"> انتخاب فایل </label>
                          </div>
                          <small class="form-text text-muted"> حداکثر سایز 3 مگابایت </small>
                        </div>
                        <div class="form-group">
                          <label for="body"> توضیحات </label>
                          <textarea name="body" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer justify-content-start">
                          <button class="btn btn-success border-rad btn-block" data-dismiss="modal"> ثبت پست </button>
                        </div>
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>
              
              
              <!-- ADD USER MODAL -->
              <div class="modal" id="addUserModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                      <h5 class="modal-title"> ثبت کارمند جدید</h5>
                      <button class="close cancel ml-0" onclick="closeFormAddEmployee()">
                        <span>&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <?php echo "<form action=\"managment.php?id=$userID&accessPage=$Access&information=true\"  method=\"post\"  class=\"form-container\">"; ?>
                        <div class="form-group">
                          <label for="name"> نام و نام خانوادگی </label>
                          <input type="text" name="fullName" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="phoneNumber"> شماره تلفن به صورت 09123456789 </label>
                          <input type="text" maxlength="11" name="phoneNumber" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="password"> پسورد </label>
                          <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="password2"> تکرار پسورد </label>
                          <input type="password" name="re_password" class="form-control">
                        </div>
                        <div class="modal-footer justify-content-start">
                          <button type="submit" name="signup" class="btn btn-info border-rad btn-block" data-dismiss="modal"> ثبت کاربر جدید </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

<!-- ADD POST MODAL -->
<div class="modal" id="employeeInfo">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"> تکمیل اطلاعات </h5>
        <p class="modal-title text-warning"> لطفا تمامی اطلاعات را به درستی وارد کنید </p>
        <button class="close ml-0" data-dismiss="modal" onclick="closeFormEmployeeInformation()">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <?php 
      if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
        $userID = $_REQUEST['id'];
        $Access = $_REQUEST['accessPage'];
      echo "<form action=\"managment.php?id=$userID&accessPage=$Access&information=true\"  method=\"post\"  class=\"form-container\" enctype=\"multipart/form-data\">"; 
      }
      ?>          <div class="form-group">
            <label for="title"> کد ملی  </label>
            <input type="text" maxlength="10" name="nationalCode" class="form-control">
          </div>
          <div class="form-group">
            <label for="email"> ایمیل   </label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="age"> سن </label>
            <input type="number" name="age" class="form-control">
          </div>
          <div class="form-group">
            <label for="text"> آدرس   </label>
            <input type="text" name="fullAddress" class="form-control">
          </div>
          <div class="form-group">
            <label for="gender"> جنسیت  </label>
            <select name="gender" class="form-control">
              <option value="male"> مرد </option>
              <option value="female"> زن </option>
            </select>
          </div>
          <div class="form-group">
            <label for="status"> وضعیت تاهل  </label>
            <select name="status" class="form-control">
              <option value="single"> مجرد </option>
              <option value="married"> متاهل </option>
            </select>
          </div>
          <div class="form-group">
            <label for="image"> آپلود تصویر </label>
            <div class="custom-file">
              <input type="file" name="profileImage" class="custom-file-input" id="image">
              <label for="image"  class="custom-file-label text-left"> انتخاب فایل </label>
            </div>
            <small class="form-text text-muted"> حداکثر سایز 3 مگابایت </small>
            <small class="form-text text-muted"> فقط فایل های زیر قابل قبول است </small>
            <small class="form-text text-muted"> jpg,png,gif </small>
          </div>
          <!-- <div class="form-group">
            <label for="file"> آپلود رزومه کاری    </label>
            <div class="custom-file">
              <input type="file" name="resome" class="custom-file-input" id="image">
              <label for="file"  class="custom-file-label text-left"> انتخاب فایل </label>
            </div>
            <small class="form-text text-muted"> حداکثر سایز 3 مگابایت </small>
            <small class="form-text text-muted"> فقط فایل های زیر قابل قبول است </small>
            <small class="form-text text-muted"> pdf </small>
          </div> -->
          <div class="modal-footer justify-content-start">
            <button type="submit" name="sendEmplyeeInfo" class="btn btn-primary border-rad btn-block" data-dismiss="modal"> ثبت اطلاعات </button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<div class="modal" id="clientInfo">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"> تکمیل اطلاعات </h5>
        <p class="modal-title text-warning"> لطفا تمامی اطلاعات را به درستی وارد کنید </p>
        <button class="close cancel ml-0" data-dismiss="modal" onclick="closeFormClientInformation()">
        <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <?php 
      if(!empty($_REQUEST['id']) && !empty($_REQUEST['accessPage'])){
        $userID = $_REQUEST['id'];
        $Access = $_REQUEST['accessPage'];
      echo "<form action=\"managment.php?id=$userID&accessPage=$Access&information=true\"  method=\"post\"  class=\"form-container\" enctype=\"multipart/form-data\">"; 
      }
      ?>
     
          <div class="form-group">
            <label for="email"> ایمیل   </label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="text"> آدرس   </label>
            <input type="text" name="fullAddress" class="form-control">
          </div>
          <div class="form-group">
            <label for="age"> سن </label>
            <input type="number" name="age" class="form-control">
          </div>
          <div class="form-group">
            <label for="category"> جنسیت  </label>
            <select name="gender" class="form-control">
              <option value="male"> مرد </option>
              <option value="female"> زن </option>
            </select>
          </div>
          <div class="form-group">
            <label for="image"> آپلود تصویر </label>
            <div class="custom-file">
              <input name="profileImage" type="file" class="custom-file-input" id="image">
              <label for="image" class="custom-file-label text-left"> انتخاب فایل </label>
            </div>
            <small class="form-text text-muted"> حداکثر سایز 3 مگابایت </small>
            <small class="form-text text-muted"> فقط فایل های زیر قابل قبول است </small>
            <small class="form-text text-muted"> jpg,png,gif </small>
          </div>
          <div class="modal-footer">
            <input type="submit" name="sendClientInformation" value="ثبت اطلاعات" class="btn btn-primary border-rad btn-block">  
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<div class="modal" id="buyingTicket">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">  خرید تیکت </h5>
        <button class="close cancel ml-0" data-dismiss="modal" onclick="closeFormTiket()">
        <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <?php echo "<form action=\"managment.php?id=$userID&accessPage=$Access&ticketInformation=true\"  method=\"post\"  class=\"form-container\" enctype=\"multipart/form-data\">"; ?>
           <div class="form-group">
            <label for="category"> نوع مشکل خود را انتخاب کنید  </label>
            <select name="titleOfProblem" class="form-control">
              <option value="installation"> نصب یک برنامه </option>
              <option value="liecence">  لایسنس </option>
              <option value="brokenApp"> تنظیم نبودن عملکرد یک برنامه </option>
              <option value="etc"> سایر </option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="numOfTicket"> تعداد تیکت </label>
            <input type="number" name="numOfTickets" class="form-control">
            <small class="form-text text-muted"> قیمت هر تیکت 1000 تومان میباشد </small>
          </div>

          <div class="modal-footer">
            <input type="submit" name="sendTicketInformation" value="خرید تیکت " class="btn btn-success border-rad btn-block">  
          </div>
        </form>
      </div>  
    </div>
  </div>
</div>

<?php include "chat_page.php"; ?>


  <script>

function openFormchat() {
  document.getElementById("myForm").style.display = "block";
}

function closeFormchat() {
  document.getElementById("myForm").style.display = "none";
}
function openFormEmployeeInformation() {
  document.getElementById("employeeInfo").style.display = "block";
}

function closeFormEmployeeInformation() {
  document.getElementById("employeeInfo").style.display = "none";
}
function openFormClientInformation() {
  document.getElementById("clientInfo").style.display = "block";
}

function closeFormClientInformation() {
  document.getElementById("clientInfo").style.display = "none";
}
function openFormAddPost() {
  document.getElementById("addPostModal").style.display = "block";
}

function closeFormAddPost() {
  document.getElementById("addPostModal").style.display = "none";
}
function openFormTiket() {
  document.getElementById("buyingTicket").style.display = "block";
}

function closeFormTiket() {
  document.getElementById("buyingTicket").style.display = "none";
}
function openFormAddEmployee() {
  document.getElementById("addUserModal").style.display = "block";
}

function closeFormAddEmployee() {
  document.getElementById("addUserModal").style.display = "none";
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

</body>

</html>