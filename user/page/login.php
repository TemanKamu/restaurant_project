<?php
  require "../../Connection.php";
  session_start();
 
  
?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">
  <head>
    <title>Login & Register</title>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->

    <link href="../assets/img/restaurant-icon.jpeg" rel="icon">
  <link href="../assets/img/restaurant-icon.jpeg" rel="restaurant-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
      <div class="back-button">
        <a href="../index.php" class=""><i class="ri-arrow-left-fill"></i>Back</a>
      </div>
      <?php
    
      if(isset($_SESSION['status']) && $_SESSION['status'] == "Kosong"){
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">';
          echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
          echo '
          <script>
            Swal.fire({
              text: "Mohon maaf, Akun anda tidak di database kami, Silahkan melakukan registerasi akun",
              icon: "question",
              confirmButtonText: "OK"
            });
          </script>
        ';
         // Hapus nilai $_SESSION['status']
         unset($_SESSION['status']);
        }elseif(isset($_SESSION['password']) && $_SESSION['password'] == "salah"){
          echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">';
          echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
          echo '
          <script>
            Swal.fire({
              text: "Email atau password yang anda masukkan SALAH",
              icon: "error",
              confirmButtonText: "OK"
            });
          </script>
        ';
           // Hapus nilai $_SESSION['status']
           unset($_SESSION['password']);
          }
  
         if(isset($_SESSION['status']) && $_SESSION['status'] == "ada"){
          echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">';
          echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
          echo '
          <script>
            Swal.fire({
              text: "Mohon maaf, Akun anda sudah terdaftar di database kami, Silahkan maukkan Email atau nomor telepon yang lain",
              icon: "error",
              confirmButtonText: "OK"
            });
          </script>
        ';
          // Hapus nilai $_SESSION['status']
          unset($_SESSION['status']);
          }

      ?>
  <div class="container">
    
    <input type="checkbox" id="flip">

    <div class="cover">
      <div class="front">
        <img src="../assets/img/hero-bg.jpg" alt="">
        <div class="text">
          <span class="text-1">Every new friend is a <br> new adventure</span>
          <span class="text-2">Let's get connected</span>
        </div>
      </div>
      <div class="back">
        <!--<img class="backImg" src="images/backImg.jpg" alt="">-->
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          
          <div class="login-form">
            <div class="title">Login</div>
          
          <form action="login-proses.php" method="post">
        
            <div class="input-boxes">
              <div class="input-box">
              <i class="fas fa-user"></i>

                <input type="text" placeholder="Enter your email or phonenumber" name="dataUser" required>
              </div>
             
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="password" required>
              </div>              
              <div class="button input-box">
                <input type="submit" value="Sumbit" name="login">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Sigup now</label></div>
              
            </div>
        </form>
      </div>
        <div class="signup-form" id="signup">
          <div class="title">Signup</div>
        <form action="register-proses.php" method="POST" id="myForm">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your name" name="nama" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" placeholder="Enter your email" name="email" required>
              </div>
              <div class="input-box">
                <i class="ri-phone-fill"></i>
                <input type="text" id="inputNumber" placeholder="Enter your number" name="nomor" required>
              </div>
              <span id = "message1" style="color:red; font-size: 14px; position: relative;"> </span>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Enter your password" id="pswd1" required>
              </div>
            
              <span id = "message2" style="color:red; font-size: 14px; position: absolute;"> </span>
               
              <div class="button input-box">
                <input type="submit" value="Sumbit" name="register">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>
  <script>
    function validateForm(){
      
      var pw1 = document.getElementById("pswd1").value;
      var pw2 = document.getElementById("pswd2").value;
      var nomor = document.getElementById("inputNumber").value;
      var message1 = document.getElementById("message1");
      var 
      //Validasi input nomor apakah sebuah number atau tidak
      if(isNaN(nomor)) {
        // Jika input bukan angka, tampilkan pesan error dan kembalikan false
        document.getElementById("message1").innerHTML = "Your number phone are not a number";
        return false;
      }else{
        message1.style.display = "none";
      }
      //Validasi apakah digit input nomor kurang dari 5 digit
      if(nomor.length < 5) {
        message1.style.display = "inline";
        document.getElementById("message1").innerHTML = "Number length must be atleast 5 characters";
        return false;
      }else{
        message1.style.display = "none";
      }
      
      //Validasi konfirmasi password
      if(pw1 != pw2) {
      document.getElementById("message2").innerHTML = "Passwords are not same";
      return false;
      }
      return true;
  
    }
    
    // style="color: red;"
  </script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
