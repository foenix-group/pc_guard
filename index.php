<?php 
include 'db.php'; 
function redirect($url)
{
    if (!headers_sent()){
        header("Location: $url");
    }else{
        echo "<script type='text/javascript'>window.location.href='$url'</script>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=$url'/></noscript>";
    }
    exit;
}
?>
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

  <link rel="stylesheet" href="./css/style9.css" />
  <title> پی سی گارد </title>
</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">

    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="#home"> <img src="./img/logo.png" alt="Foenix.ir" style="width: 150px; height: 100px;"> </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        منو
        <i class="fas fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav mr-auto">

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#home"> خانه </a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about"> درباره ما </a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact"> ارتباط با ما </a>
          </li>

        </ul>

      </div>

    </div>
  </nav>


  <header id="home" class="text-center">

  
      <section id="showcase" class="py-5">

        <div class="primary-overlay text-white">
    
          <div class="container">
    
            <div id="showcase-height" class="row justify-content-center align-items-center">
    
              <div class="col-lg-6 text-center ">
    
                <h1 id="banner-heading" class="text-white-50 mx-auto my-4 font-weight-bold"><span>PC-GUARD</span>.IR</h1>
                <h4 id="banner-par" class="text-white-50 mx-auto mt-2  lead"> راهنمای حل مشکلات نرم افزاری </h4>
                <h4 id="banner-par" class="text-white-50 mx-auto mt-1  lead"> مشکلات نرم افزاری خود را از ما بپرسید </h4>
    
              </div>
              <div class="col-lg-6 text-center">
    <!-- Signin Section -->

    <div id="signin" class="container">

      <div class="row">

        <div class="col-md-10 col-lg-8 mx-auto text-center">

          <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
          <h2 class="text-white mb-3"> ورود به حساب </h2>

          <form method="post" action="index.php">

            <div class="form-group">
              <input type="text" maxlength="11" name="phoneNumber" class="form-control border-rad" id="exampleInputEmail"
                placeholder="شماره تلفن به صورت 09123456789">
            </div>

            <div class="form-group">
              <input type="password" name="password" class="form-control border-rad" id="exampleInputPassword"
                placeholder="رمز ورود">
            </div>

            <div class="form-group">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label mr-3 text-white" for="exampleCheck1"> مرا بخاطر بسپار </label>
              </div>
            </div>
            <button type="submit" name="login" class="btn btn-outline-success btn-block border-rad">
              ورود
            </button>

          </form>

          <hr>

          <div class="text-center">
            <a class="small" href="#"> فراموشی رمز عبور؟</a>
          </div>
          <div class="text-center">
            <a class="small" href="#" data-toggle="modal" data-target="#signup" onclick="openFormsignup()"> ساخت حساب جدید </a>
          </div>
          <div class="text-center mt-2">
          <?php
          try{
            if(isset($_POST['login'])){
              if(!empty($_POST['phoneNumber']) && !empty($_POST['password'])){
                $phoneNumber = $_POST['phoneNumber'];
                $password = $_POST['password'];
                $select = "SELECT * FROM users WHERE phoneNumber = '$phoneNumber' AND pass = '$password'";
                $selectResult= $pdoObj->query($select);
                foreach($selectResult as $row){
					$pass = $row['pass'];
                  if($phoneNumber == $row['phoneNumber'] && $password == $row['pass']){
                    if($row['Access'] == "employee"){
                      $text1 = "employee"; 
                      $userID = $row['userID'];
            redirect("managment.php?id=$userID&accessPage=employee");
                    }if($row['Access'] == "management"){
                      $text1 = "managment";
                      $userID = $row['userID']; 
            redirect("managment.php?id=$userID&accessPage=managment");
                    }if($row['Access'] == "client"){
                      $text1 = "client";
                      $userID = $row['userID']; 
            redirect("managment.php?id=$userID&accessPage=client");
                    }
                  }else{
                    echo "<b> <font color=\"red\">  !!!اطلاعات وارد شده درست نمیباشد!!!</font> </b>";
                  }
                }
              }else{
                echo "<b> <font color=\"red\">  !!!لطفا اطلاعات را به درستی وارد کنید!!!</font> </b>";
              }
            }
  
          }catch(PDOException $e){
            echo "<b> <font color=\"red\">  !!!اطلاعات وارد شده درست نمیباشد!!!</font> </b>";
            }
            try{
              $select = "SELECT * FROM users";
                    $selectResult= $pdoObj->query($select);
                    $count = $selectResult->rowCount();
    
                    if($count == 0){
                      $mFullName = "مدیریت";
                      $mPhoneNumber = "09170022767";
                      $mPassword = "0022767";
                      $mAge = 21;
                      $mGender = "مرد";
                      $mEmail = "raeyatsajjad@gmail.com";
                      $mFullAddress = "مرودشت - خیابان فردوسی - کوچه شهید جباره";
                      $mAccess = "management";
                      $insert = "INSERT INTO users
                      (fullName, phoneNumber, pass, Access, age, gender, email, fullAddress)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                      $insertStmnt = $pdoObj->prepare($insert);
                      $insertStmnt->execute([$mFullName,$mPhoneNumber,$mPassword,$mAccess,$mAge,$mGender,$mEmail,$mFullAddress]);
                    }
    
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
                    // foreach($selectResult as $row){
                      // if($phoneNumber == $row['phoneNumber']){
                        // echo "ok";
                      if($count2 >0 ){
                        echo "<b> <font color=\"red\">  !!! شماره تلفن وارد شده قبلا ثبت نام شده است !!!</font> </b>";
                      exit;
                      // break;
                      }else{
                        $Access = "client";
                        $insert = "INSERT INTO users
                        (fullName, phoneNumber, pass, Access)
                        VALUES (?, ?, ?, ?)";
                        $insertStmnt = $pdoObj->prepare($insert);
                        $insertStmnt->execute([$fullName,$phoneNumber,$password,$Access]);
                        if($insertStmnt == true){
                          echo "<b><font color=\"green\"> اطلاعات به درستی ذخیره شده </font></b>";
                        exit;
                        // break;
                        }else{
                          echo "<b> <font color=\"red\">  !!!اطلاعات به درستی ذخیره نشده است!!!</font> </b>";
                        exit;
                        // break;
                        }
                      }
                    // }
                    
    
                  }else{
                    echo "<b> <font color=\"red\"> !!!پسوورد ها با هم برابر نیستند!!!</font></b>";
                  }
                }else{
                  echo "<b> <font color=\"red\">  !!!لطفا تمامی اطلاعات را به درستی وارد کنید!!!</font> </b>";
                }
    
              }
    
            }catch(PDOException $e){
              echo "Error: " . $e->getMessage();
              exit();
              }

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

	if(!empty($_REQUEST['messageSend']) && $_REQUEST['messageSend'] == "true"){
		if(isset($_POST['send'])){
			if(!empty($_POST['fullName']) && !empty($_POST['email'])){
				$fullName = $_POST['fullName'];
			    $email = $_POST['email'];
			    $comment = $_POST['messageText'];
			    $commentDate = date("Y-m-d H:m:s");
				try{
       			$insert = "INSERT INTO emailMessage
     		    (fullName, email, messageText, messageDate)
   			    VALUES (?, ?, ?, ?)";
     		    $insertStmnt = $pdoObj->prepare($insert);
      			$insertStmnt->execute([$fullName,$email,$comment,$commentDate]);
				echo "<div class=\"text-center text-success\">";
				echo "پیام به پشتیبانی با موفقیت ارسال شد";
				echo "</div>";
				}catch(PDOException $e){
					echo "<div class=\"text-center text-danger\">";
      				echo "Error: " . $e->getMessage();
					echo "</div>";
      			}
			}else{
				echo "<div class=\"text-center text-danger\">";
				echo "نام کاربری و ایمیل وارد نشده است";
				echo "</div>";
			}
		}
	}
	
          ?>
          </div>
        </div>
      </div>
    </div>
              </div>
            </div>
          </div>
        </div>
        <a href="#projects" class="js-scroll-trigger"> 
          <i id="arrowDown" class="fas fa-arrow-circle-down fa-2x text-white-50"></i>
        </a>
      </section>

  </header>

  <!-- About Section -->
  <section id="about" class="text-center">

    <div class="container">

      <div class="row">

        <div class="col-lg-8 mx-auto">

          <h2 class="text-white mb-4"> گروه فونیکس </h2>

          <div class="underline mb-4"></div>

          <p class="text-white-50">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
            گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
            مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
           </p>

        </div>

      </div>

      <div class="row my-5">

        <div class="col-md-4 text-center">

          <i class="fas fa-cogs fa-5x text-white-50 mb-4"></i>

          <h3 class="text-white mb-3"> حل مشکل </h3>
          <p class="text-white-50">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
            گرافیک است. </p>

        </div>

        <div class="col-md-4 text-center">

          <i class="fas fa-thumbs-up fa-5x text-white-50 mb-4"></i>
          <h3 class="text-white mb-3"> پشتیبانی </h3>
          <p class="text-white-50">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
            گرافیک است. </p>

        </div>

        <div class="col-md-4 text-center">

          <i class="fas fa-handshake fa-5x text-white-50 mb-4"></i>
          <h3 class="text-white mb-3"> رضایت مشتری </h3>
          <p class="text-white-50">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
            گرافیک است. </p>

        </div>

      </div>

    </div>

  </section>


  <!-- Projects Section -->
  <section id="projects" class="bg-light">
    
    <div class="container">

      <!-- Featured Project Row -->
      <div class="row align-items-center no-gutters mb-4 mb-lg-5">

        <div class="col-xl-6 col-lg-5">

          <section id="video">
            <div class="container text-center text-white py-5">


            <a href="#" class="video text-white" data-video="./video/foenix.mp4" data-toggle="modal"
            data-target="#videoModal" onclick="openVideo()">
            <i class="fas fa-play fa-3x"></i></a>
  
          <h4 class=" mt-3">نمایش ویدو ما</h4>
          </div>
        </section>
        </div>

        <div class="col-xl-4 col-lg-5">

          <div class="featured-text text-center text-lg-right">

            <h4> لورم ایپسوم </h4>
            <p class="text-black-50 mb-0">
              لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
              گرافیک است.
              لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
              گرافیک است.
            </p>

          </div>

        </div>

      </div>


      <!-- Project One Row -->
      <div class="row justify-content-center no-gutters mb-5 mb-lg-0">

        <div class="col-lg-6">

          <img class="img-fluid" src="img/demo1.jpg" alt="">

        </div>

        <div class="col-lg-6">

          <div class="bg-black text-center h-100">

            <div class="d-flex h-100">

              <div class="project-text my-auto text-center text-lg-right">

                <h4 class="text-white">لورم</h4>
                <p class="mb-0 text-white-50">
                  لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                  گرافیک است.</p>
                <hr class="d-none d-lg-block mb-0 mr-0">

              </div>

            </div>

          </div>

        </div>

      </div>



      <!-- Project Two Row -->
      <div class="row justify-content-center no-gutters">
        
        <div class="col-lg-6">

          <img class="img-fluid" src="img/demo2.jpg" alt="">

        </div>

        <div class="col-lg-6 order-lg-first">

          <div class="bg-black text-center h-100 project">

            <div class="d-flex h-100">

              <div class="project-text w-100 my-auto text-center text-lg-right">

                <h4 class="text-white"> لورم ایپسوم </h4>
                <p class="mb-0 text-white-50">
                  لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                  گرافیک است.</p>
                <hr class="d-none d-lg-block mb-0 mr-0">
              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

  


  <section id="contact" class="bg-black">

       <!-- CONTACT -->
    <div class="container">

      <div class="row">

        <div class="col-md-10 col-lg-8 mx-auto text-center">
          <h4 id="banner-par" class="text-white-50 mx-5"> ارسال پیام به صورت مستقیم </h4>
          <br>
    <?php echo "<form action=\"index.php?messageSend=true\" method=\"post\">"; ?>
      <div class="form-group">
        <div class="input-group input-group-lg">
          <input type="text" class="form-control bg-dark text-white order-2" name="fullName" placeholder="نام">
          <div class="input-group-append">
            <span class="input-group-text bg-danger text-white">
              <i class="fas fa-user"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group input-group-lg">
          <input type="email" name="email" class="form-control bg-dark text-white order-2" placeholder="ایمیل">
          <div class="input-group-append">
            <span class="input-group-text bg-danger text-white">
              <i class="fas fa-envelope"></i>
            </span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group input-group-lg">
          <textarea class="form-control bg-dark text-white order-2" name="messageText" placeholder="متن پیام"></textarea>
          <div class="input-group-append">
            <span class="input-group-text bg-danger text-white">
              <i class="fas fa-pencil-alt"></i>
            </span>
          </div>
        </div>
      </div>
      <button class="btn btn-danger btn-block btn-lg" type="submit" name="send"> ارسال </button>
    </form>
    </div>
    </div>
    </div>

      <div class="social d-flex justify-content-center py-5">
        <h4 id="banner-par" class="text-white-50 mx-5">ارتباط با ما از طریق :</h4>
        <!-- <a href="#" class="mx-2">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#" class="mx-2">
          <i class="fab fa-facebook-f"></i>
        </a> -->
        <a href="https://github.com/fonix-group/pc-guard" target="_blank" class="mx-2"><i class="fab fa-github"></i></a>
        <a href="https://t.me/joinchat/2E0MU7qYMcw3NzFk" target="_blank" class="mx-2"><i class="fab fa-telegram-plane"></i></a>
        <a href="https://instagram.com/pc.guard?utm_medium=copy_link" target="_blank" class="mx-2"><i class="fab fa-instagram"></i></a>
        <a href="fonix.group992@gmail.com" target="_blank" class="mx-2"><i class="fas fa-envelope"></i></a>
        
      </div>

    </div>

  </section>



  <!-- Footer -->
  <footer class="bg-black text-center text-white-50 py-4">

    <div class="container">

      <div class="row">

        <div class="col">
          کليه حقوق محصولات و محتوای اين سایت متعلق به سایت پی سی گارد می باشد
        </div>
        <div>
          <p>
            pc-guard.ir &copy; 2021
          </p>
        </div>
      </div>

    </div>

  </footer>

  <!-- Video Modal -->
  <div id="videoModal" class="modal fade">

    <div class="modal-dialog">

      <div class="modal-content">

        <div class="modal-body">

          <button class="close cancel" onclick="closeVideo()" data-dismiss="modal">
            <span> &times; </span>
          </button>

          <iframe src="./video/foenix.mp4" frameborder="1" height="350" width="100%" allowfullscreen></iframe>

        </div>

      </div>

    </div>

  </div>


  <!-- ADD POST MODAL -->
 <div class="modal signup2" id="signup" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"> تکمیل اطلاعات </h5>
         
      </div>
      <div class="modal-body">
        
        <form action="index.php" method="post">

          <div class="form-group">
              <input type="text" class="form-control border-rad"  placeholder=" نام و نام خانوادگی " name="fullName">
          </div>

          <div class="form-group">
            <input type="text" maxlength="11" class="form-control border-rad"  placeholder=" شماره تلفن " name="phoneNumber">
			<small class="form-text text-black"> به صورت 09123456789 وارد شود </small>
          </div>
          <div class="form-group row">

            <div class="col-sm-6 mb-3 mb-sm-0">
              <input type="password" class="form-control border-rad" 
                placeholder="رمز ورود" name="password">
            </div>

            <div class="col-sm-6">
              <input type="password" class="form-control border-rad" 
                placeholder=" تکرار رمز ورود " name="re_password">
            </div>

          </div>

          <div class="form-group">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label mr-3 text-black" for="exampleCheck1"> مرا بخاطر بسپار </label>
              </div>
            </div>

            <div class = "modal-footer">
            
            <input type="submit" name="signup" value="ساخت اکانت" class="btn btn-success border-rad btn-block">
            

         </div>
		 <button type="button" class="cancel btn btn-danger border-rad btn-block" onclick="closeFormsignup()"> خروج </button>          


</form>
      </div>
      
    </div>
  </div>
</div>
</div>

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
<a class="open-button" onclick="openFormchat()"> <img src="./img/support.png" alt="support"></a>
<div class="chat-popup" id="myForm">
  <?php echo "<form action=\"index.php?id=$userID&sendMessage=true\"  method=\"post\"  class=\"form-container\" enctype=\"multipart/form-data\">"; ?>
    <h4>پشتیبانی سایت پی سی گارد</h4>
    
    <label for="msg"><b>پاسخگوی سوالات شما عزیزان هستیم</b></label>
	 <div id="chat_info">
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

<script>
function openFormchat() {
  document.getElementById("myForm").style.display = "block";
}

function closeFormchat() {
  document.getElementById("myForm").style.display = "none";
}
function openFormsignup() {
  document.getElementById("signup").style.display = "block";
}

function closeFormsignup() {
  document.getElementById("signup").style.display = "none";
}
function openVideo() {
  document.getElementById("videoModal").style.display = "block";
}

function closeVideo() {
  document.getElementById("videoModal").style.display = "none";
}
</script>
  <!-- NO Use Jquery Slim -->
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>


  <script src="./js/script.js"></script>
 <script>
    // Video Play
    $(function () {

      // Auto play modal video
      $(".video").click(function () {
        var theModal = $(this).data("target"),
          videoSRC = $(this).attr("data-video"),
          videoSRCauto =
            videoSRC +
            "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1";

        $(theModal + " iframe").attr("src", videoSRCauto);
        $(theModal + " button.close").click(function () {
          $(theModal + " iframe").attr("src", "");
        });
      });

    });


    // Lightbox Init
    $(document).on("click", '[data-toggle="lightbox"]', function (event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        // showArrows : false
      });
    });


  </script>
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