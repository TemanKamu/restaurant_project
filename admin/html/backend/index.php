<?php
    require "Connection.php";
    session_start();
    if(!isset($_SESSION['email']) && !isset($_SESSION['no_hp'])){
        header("location: login.php");
    }
    $id_user = $_SESSION['id'];
    $email = $_SESSION['email'];
    $no_hp = $_SESSION['no_hp'];
    
    $query3 = "SELECT * FROM tb_kritik ORDER BY date DESC LIMIT 1";
    $stmt3 = $connect->prepare($query3);
    $stmt3->execute();
    $data3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    
    $query = "SELECT COUNT(*) as total FROM tb_kritik";
    $data = $connect->query($query);
    $result = $data->fetch(PDO::FETCH_ASSOC);
    
    $totalData = $result['total'];

    //Mengambil 3 data terakhir yang ada di database
   
    $query2 = "SELECT * FROM tb_kritik";
    $data2 = $connect->query($query2);
    $tampil = $data2->fetchAll(PDO::FETCH_ASSOC);
    
                $queryPengguna = "SELECT COUNT(*) AS jumlah_pengguna FROM tb_pengguna";
                $stmtPengguna = $connect->query($queryPengguna);
                $resultPengguna = $stmtPengguna->fetch(PDO::FETCH_ASSOC);
                $jumlahPengguna = $resultPengguna['jumlah_pengguna'];
                
                // Query untuk mengambil jumlah reservasi
                $queryReservasi = "SELECT COUNT(*) AS jumlah_reservasi FROM tb_reservasi";
                $stmtReservasi = $connect->query($queryReservasi);
                $resultReservasi = $stmtReservasi->fetch(PDO::FETCH_ASSOC);
                $jumlahReservasi = $resultReservasi['jumlah_reservasi'];
                ?>
<!doctype html>
<html lang="en">
    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/images/logoRes.jpg" />
      <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
      <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
      <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">  

      <!-- Font awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <style>
        #chart-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
    </head>
  <body class="  ">
    <!-- loader Start -->
    <!-- <div id="loading">
          <div id="loading-center">
          </div> -->
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->  
    <div class="wrapper">
      
      <div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
              <a href="index.php" class="header-logo">
                 <h5 class="logo-title light-logo ml-3">Nourriture délicieuse</h5>
              </a>
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="las la-bars wrapper-menu"></i>
              </div>
          </div>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                      <li class="active">
                          <a href="../backend/index.php" class="svg-icon">                        
                            <i class="fa-sharp fa-solid fa-house"></i>
                              <span class="ml-4">Dashboards</span>
                          </a>
                      </li>
                      <li class="">
                         <a href="reservation/reservation.php" class="svg-icon">                        
                            <i class="fa-solid fa-cart-shopping"></i>
                              <span class="ml-4">Reservation</span>
                          </a>
                      </li>
                      <li class="">
                        <a href="menu/menu.php" class="svg-icon">                        
                            <i class="fa-solid fa-utensils"></i>
                             <span class="ml-4">Menu</span>
                         </a>
                     </li>
                     <li class="">
                        <a href="table/table.php" class="svg-icon">                        
                            <i class="fa-sharp fa-solid fa-chair"></i>
                             <span class="ml-4">Table</span>
                         </a>
                     </li>
                     <li class="">
                        <a href="../backend/user/user.php" class="svg-icon">                        
                            <i class="fa-sharp fa-solid fa-users"></i>
                             <span class="ml-4">People</span>
                         </a>
                     </li>
                  </ul>
              </nav>
              <!-- <div id="sidebar-bottom" class="position-relative sidebar-bottom">
                  <div class="card border-none">
                      <div class="card-body p-0">
                          <div class="sidebarbottom-content">
                              <div class="image"><img src="../assets/images/layouts/side-bkg.png" class="img-fluid" alt="side-bkg"></div>
                              <h6 class="mt-4 px-4 body-title">Get More Feature by Upgrading</h6>
                              <button type="button" class="btn sidebar-bottom-btn mt-4">Go Premium</button>
                          </div>
                      </div>
                  </div>
              </div> -->
              <div class="p-3"></div>
          </div>
          </div> 
          <!--navbar  -->    
          <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        <a href="../backend/index.html" class="header-logo">
                            <img src="../assets/images/logo.png" class="img-fluid rounded-normal" alt="logo">
                            <h5 class="logo-title ml-3">Nourriture délicieuse</h5>
                        </a>
                    </div>
                    <div class="iq-search-bar device-search">
                        <form action="#" class="searchbox">
                            
                            <input type="hidden" class="text search-input" placeholder="Search here...">
                        </form>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                               
                                <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-mail">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                            </path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span class="bg-primary"></span>
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 ">
                                                <div class="cust-title p-3">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h5 class="mb-0">All Messages</h5>
                                                        <a class="badge badge-primary badge-card" href="#"><?= $totalData ?></a>
                                                    </div>
                                                </div>
                                                <div class="px-3 pt-0 pb-0 sub-card">
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3 border-bottom">
                                                            <div class="">
                                                                <img class="avatar-50 rounded-small"
                                                                    src="../assets/images/user/01.jpg" alt="01">
                                                            </div>
                                            
                                                            <div class="media-body ml-3">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">Annonymous</h6>
                                                                    <small class="text-dark"><b><?= $data3['time'] ?></b></small>
                                                                </div>
                                                                <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                            </div>
                                                        </div>
                                                    </a>                 
                                                </div>
                                                <a class="right-ic btn btn-primary btn-block position-relative p-2" href="kritik/index.php"
                                                    role="button">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                               <!-- <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-bell">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg>
                                        <span class="bg-primary "></span>
                                    </a>
                                     <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 ">
                                                <div class="cust-title p-3">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h5 class="mb-0">Notifications</h5>
                                                        <a class="badge badge-primary badge-card" href="#">3</a>
                                                    </div>
                                                </div>
                                                <div class="px-3 pt-0 pb-0 sub-card">
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3 border-bottom">
                                                            <div class="">
                                                                <img class="avatar-50 rounded-small"
                                                                    src="../assets/images/user/01.jpg" alt="01">
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">Emma Watson</h6>
                                                                    <small class="text-dark"><b>12 : 47 pm</b></small>
                                                                </div>
                                                                <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3 border-bottom">
                                                            <div class="">
                                                                <img class="avatar-50 rounded-small"
                                                                    src="../assets/images/user/02.jpg" alt="02">
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">Ashlynn Franci</h6>
                                                                    <small class="text-dark"><b>11 : 30 pm</b></small>
                                                                </div>
                                                                <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3">
                                                            <div class="">
                                                                <img class="avatar-50 rounded-small"
                                                                    src="../assets/images/user/03.jpg" alt="03">
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">Kianna Carder</h6>
                                                                    <small class="text-dark"><b>11 : 21 pm</b></small>
                                                                </div>
                                                                <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#"
                                                    role="button">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                    </div> 
                                </li>-->
                                <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="../assets/images/user/1.png" class="img-fluid rounded" alt="user">
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 text-center">
                                                <div class="media-body profile-detail text-center">
                                                    <img src="../assets/images/page-img/profile-bg.jpg" alt="profile-bg"
                                                        class="rounded-top img-fluid mb-4">
                                                    <img src="../assets/images/user/1.png" alt="profile-img"
                                                        class="rounded profile-img img-fluid avatar-70">
                                                </div>
                                                <div class="p-3">
                                                    <h5 class="mb-1">Admin</h5>
                                                    <div class="d-flex align-items-center justify-content-center mt-3">
                                                        
                                                        <a href="auth-proses/logout.php  " class="btn border">Sign Out</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            
        </div>
    <div class="content-page">
     <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-transparent card-block card-stretch card-height border-none">
                    <div class="card-body p-0 mt-lg-2 mt-0">
                        <h3 class="mb-3">Hi <?= $email ?>, Good Morning</h3>
                        <p class="mb-0 mr-4">Your dashboard gives you views of key performance or business process.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <img src="../assets/images/product/1.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Total User</p>
                                        <h4><?= $jumlahPengguna ?></h4>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <img src="../assets/images/product/2.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Total Reservation</p>
                                        <h4><?= $jumlahReservasi ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>             
            
            <div class="col-lg-12">  
            <div id="chart-container">
                <canvas id="chart"></canvas>
            </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
      </div>
    </div>
    <!-- Wrapper End-->
    <footer class="iq-footer">
            <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="../backend/privacy-policy.html">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="../backend/terms-of-service.html">Terms of Use</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">Nourriture délicieuse</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pengguna', 'Reservasi'],
                datasets: [{
                    label: 'Jumlah',
                    data: [<?php echo $jumlahPengguna; ?>, <?php echo $jumlahReservasi; ?>],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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