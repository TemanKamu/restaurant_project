<?php
   session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sign-up</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/images/logoRes.jpg" />
      <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
      <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
      <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">  </head>
  <body class=" ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="login-content">
         <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
               <div class="col-lg-8">
                  <div class="card auth-card">
                     <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                           <div class="col-lg-7 align-self-center">
                              <div class="p-3">
                                 <h2 class="mb-2">Sign Up</h2>
                                 <p>Create your Nourriture délicieuse admin account.</p>
                                 <form action="auth-proses/signup-proses.php" method="post">
                                    <div class="row">
                                       <?php
                                            if(isset($_SESSION['akun']) && $_SESSION['akun'] == "ada"){
                                             echo '<div class="alert alert-danger" role="alert">
                                             Email atau Nomor telepon yang anda masukkan sudah terdaftar, Silahkan masukkan data yang lain.
                                             </div>';
                                              // Hapus nilai $_SESSION['status']
                                              unset($_SESSION['akun']);
                                             }
                                       ?>
                                       <div class="col-lg-6">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="email" name="email" placeholder=" ">
                                             <label>Email</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="text" name="no_hp" placeholder=" ">
                                             <label>Phone No.</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="password" name="password" placeholder=" ">
                                             <label>Password</label>
                                          </div>
                                       </div>
                                       <!-- <div class="col-lg-6">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="password" id="confirm-password" placeholder=" ">
                                             <label>Confirm Password</label>
                                          </div>
                                       </div> -->
                                       
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="register">Sign Up</button>
                                    <p class="mt-3">
                                       Already have an Account <a href="login.php" class="text-primary">Sign In</a>
                                    </p>
                                 </form>
                              </div>
                           </div>
                           <div class="col-lg-5 content-right">
                              <img src="../assets/images/login/01.png" class="img-fluid image-right" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      </div>
    
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js"></script>
  </body>
</html>