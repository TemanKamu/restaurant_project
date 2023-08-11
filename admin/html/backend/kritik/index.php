<?php
    require "../Connection.php";
    session_start();
    if(!isset($_SESSION['email']) && !isset($_SESSION['no_hp'])){
        header("location: ../login.php");
    }
    $id_user = $_SESSION['id'];
    $email = $_SESSION['email'];
    $no_hp = $_SESSION['no_hp'];

    $query = "SELECT * FROM tb_kritik";
    // Hubungkan query di atas ke koneksi menggunakan function prepare()
	$data = $connect->prepare($query);
	// Eksekusi Query menggunakan function execute()
	$data->execute();
	// Ubah data kedalam bentuk object
	$tampil = $data->fetchAll(PDO::FETCH_OBJ);

    
?>
<!doctype html>
<html lang="en">
<head>
    <title>Kritik</title>
    <?php include "../head.php"; ?>
  </head>
  <body class="  ">
    <!-- loader Start -->
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      
      <div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
              <a href="../index.php" class="header-logo">
                <h5 class="logo-title light-logo ml-3">Nourriture délicieuse</h5>
              </a>
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="las la-bars wrapper-menu"></i>
              </div>
          </div>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                  <li class="">
                          <a href="../index.php" class="svg-icon">                        
                            <i class="fa-sharp fa-solid fa-house"></i>
                              <span class="ml-4">Dashboards</span>
                          </a>
                      </li>
                      <li class="">
                         <a href="../reservation/reservation.php" class="svg-icon">                        
                            <i class="fa-solid fa-cart-shopping"></i>
                              <span class="ml-4">Reservation</span>
                          </a>
                      </li>
                      <li class="">
                        <a href="../menu/menu.php" class="svg-icon">                        
                            <i class="fa-solid fa-utensils"></i>
                             <span class="ml-4">Menu</span>
                         </a>
                     </li>
                     <li class="">
                        <a href="../table/table.php" class="svg-icon">                        
                            <i class="fa-sharp fa-solid fa-chair"></i>
                             <span class="ml-4">Table</span>
                         </a>
                     </li>
                     <li class="">
                        <a href="../user/user.php" class="svg-icon">                        
                            <i class="fa-sharp fa-solid fa-users"></i>
                             <span class="ml-4">People</span>
                         </a>
                     </li>
                          </ul>
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
          <?php include "../reservation/navbar.php"; ?>
        
      <div class="content-page">
        <div class="container-fluid">
            <h1 class="title">Kritik dan saran</h1><br>
            <div class="row">
                <?php foreach($tampil as $t){ ?>
                <div class="col-12 ">
                        <div class="alert text-white bg-secondary border" role="alert">
                                <div class="iq-alert-icon">
                                <i class="ri-account-circle-line"></i>
                                </div>
                                <div class="iq-alert-text"><?= "<b> Tanggal: $t->date</b> | <b> Jam: $t->time</b>" ?></div>
                                <div class="iq-alert-text" style="text-align: right !important; margin-right: 27px;"><b><a href="kritik-detail.php?id=<?= $t->time ?>" class="text-white">Anonymous</a></b></div>
                                <a  class="close my-2" href="delete.php?remove=<?= $t->id_kritik ?>">
                                    <i class="ri-close-line"></i>                   
                                </a>
                        </div>
                </div>
                    <?php } ?>
            </div>
        </div>
      </div>
        <!-- Page end  -->
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="edit-note" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <div class="media align-items-top justify-content-between">                            
                            <h3 class="mb-3">Product</h3>
                            <div class="btn-cancel p-0" data-dismiss="modal"><i class="las la-times"></i></div>
                        </div>
                        <div class="content edit-notes">
                            <div class="card card-transparent card-block card-stretch event-note mb-0">
                                <div class="card-body px-0 bukmark">
                                    <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">                                                    
                                        <div class="quill-tool">
                                        </div>
                                    </div>
                                    <div id="quill-toolbar1">
                                        <p>Virtual Digital Marketing Course every week on Monday, Wednesday and Saturday.Virtual Digital Marketing Course every week on Monday</p>
                                    </div>
                                </div>
                                <div class="card-footer border-0">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                        <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                        <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <!-- Backend Bundle JavaScript -->
    <script src="../../assets/js/backend-bundle.min.js"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../../assets/js/table-treeview.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../../assets/js/customizer.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../../assets/js/chart-custom.js"></script>
    
    <!-- app JavaScript -->
    <script src="../../assets/js/app.js"></script>

    <script></script>
  </body>
</html>