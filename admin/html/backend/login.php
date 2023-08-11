<?php
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Login</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/images/logoRes.jpg" />
      <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
      <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
      <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">  
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   </head>
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
                                 <h2 class="mb-2">Sign In</h2>
                                 <p>Login to stay connected.</p>
                                 <form action="auth-proses/login-proses.php" method="post">
                                    <div class="row">
                                    <?php
                                     
                                       if(isset($_SESSION['status']) && $_SESSION['status'] == "Pending"){
                                       echo '<div class="alert alert-warning" role="alert">
                                       Mohon menunggu, Pembuatan akun anda belum disetujui oleh server.
                                       </div>';
                                        // Hapus nilai $_SESSION['status']
                                        unset($_SESSION['status']);
                                       }elseif(isset($_SESSION['status']) && $_SESSION['status'] == "Rejected"){
                                          echo '<div class="alert alert-danger" role="alert">
                                          Mohon maaf, Pembuatan akun anda tidak disetujui admin.
                                          </div>';
                                           // Hapus nilai $_SESSION['status']
                                           unset($_SESSION['status']);
                                       }elseif(isset($_SESSION['status']) && $_SESSION['status'] == "Kosong"){
                                          echo '<div class="alert alert-info" role="alert">
                                          Mohon maaf, Akun anda ditemukan di dalam database kami.Silahkan melakukan pembuatan akun.
                                          </div>';
                                           // Hapus nilai $_SESSION['status']
                                           unset($_SESSION['status']);
                                       }elseif(isset($_SESSION['password']) && $_SESSION['password'] == "salah"){
                                          echo '<div class="alert alert-info" role="alert">
                                          Password yang anda masukkan salah.
                                          </div>';
                                           // Hapus nilai $_SESSION['status']
                                           unset($_SESSION['password']);
                                       }
                                    ?>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="text" name="data">
                                             <label>Email or phonenumber</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="password" name="password" placeholder="">
                                             <label>Password</label>
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                                    <p class="mt-3">
                                       Create an Account <a href="sign-up.php" class="text-primary">Sign Up</a>
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
    
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Backend Bundle JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      
    </script>
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