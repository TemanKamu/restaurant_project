
<!doctype html>
<html lang="en">
    <head>
        <title>Add table</title>
        <?php include "../head.php" ?>
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
                     <li class="active">
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
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add table</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="add-table-proses.php" method="POST" data-toggle="validator">
                            <div class="row"> 
                                <div class="col-md-6">                      
                                    <div class="form-group">
                                        <label>Nomor Meja</label>
                                        <input type="text" class="form-control" placeholder="Enter nomor meja" name="meja_no" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="form-group">
                                            <select class="form-control" name="status">
                                                <option value="telah diisi">telah diisi</option>
                                                <option value="Kosong">Kosong</option>
                                            </select>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Jumlah orang</label>
                                        <input type="number" class="form-control" placeholder="Enter pax" name="pax" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                
                            </div>                            
                            <button type="submit" name="add_table" class="btn btn-primary mr-2">Add Table</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    </div>
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
  </body>
</html>