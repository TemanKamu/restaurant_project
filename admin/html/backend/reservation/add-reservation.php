
<!doctype html>
<html lang="en">
    <head>
        <title>Add Reservation</title>
        <?php 
        include "../head.php"; 
        include "../Connection.php"; 
        $query = "SELECT * FROM tb_pengguna";
        // Hubungkan query di atas ke koneksi menggunakan function prepare()
        $data = $connect->prepare($query);
        // Eksekusi Query menggunakan function execute()
        $data->execute();
        // Ubah data kedalam bentuk object
        $tampil = $data->fetchAll(PDO::FETCH_OBJ);       
         ?>
    </head>
  
  <body class="  ">
    <!-- loader Start -->
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">      
            <div class="iq-sidebar  sidebar-default ">
                <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                    <a href="../backend/index.html" class="header-logo">
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
                      <li class="active">
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
                <?php include "navbar.php"; ?>
      <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-body">
                      <div class="popup text-left">
                          <h4 class="mb-3">New Order</h4>
                          <div class="content create-workform bg-body">
                              <div class="pb-3">
                                  <label class="mb-2">Email</label>
                                  <input type="text" class="form-control" placeholder="Enter Name or Email">
                              </div>
                              <div class="col-lg-12 mt-4">
                                  <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                      <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                      <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>     <div class="content-page d-flex align-items-center">
        <div class="container-fluid add-form-list">
           <div class="row">
               <div class="col-sm-12">
                   <div class="card">
                       <div class="card-header d-flex justify-content-between">
                           <div class="header-title">
                               <h4 class="card-title">Add Boooking</h4>
                           </div>
                       </div>
                       <div class="card-body">
                       <form action="add-reservation-proses.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Daftar user</label>
                                    <select class="form-control" name="user" id="sel1" name="sellist1">
                                        <option disabled selected>User list</option>
                                        <?php
                                        foreach ($tampil as $t) {
                                            echo "<option value='$t->id'>$t->nama | $t->email</option>";
                                        }
                                        ?>
                                    </select>
                                    <a href="../user/add-user.php">Customer don't have an account?</a>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" name="date" class="form-control" id="date-input" value="date" min="<?php echo date('Y-m-d'); ?>" max="9999-12-31">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Time</label>
                                        <select class="form-control" name="time">
                                            <?php
                                            $dataJam = array("11:00-12:45", "13:00-14:45", "17:30-19:00", "19:15-20:45");

                                            foreach ($dataJam as $index => $jam) {
                                                $id = "radio" . ($index + 1);
                                                $label = $jam;
                                                echo "<option value='$label'>$label</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Nomor meja</label>
                                    <select class="form-control" id="meja" name="meja">
                                        <option disabled selected>Table list</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Choose Occasion</label>
                                        <select class="form-control" name="event">
                                            <option value="No Event">No Event</option>
                                            <option value="Lunch">Lunch</option>
                                            <option value="Dinner">Dinner</option>
                                            <option value="Birthday">Birthday</option>
                                            <option value="Anniversary">Anniversary</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Special request</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="special-request" rows="5" placeholder="Special request"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="tambah" class="btn btn-primary mr-2">Add Reservation</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>

                       </div>
                   </div>
               </div>
           </div>
           <!-- Page end  -->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {
        // Menonaktifkan input jam secara default
        $('select[name="time"]').prop('disabled', true);

        // Ketika tanggal berubah
        $('#date-input').change(function() {
            // Menghapus atribut disabled pada input jam
            $('select[name="time"]').removeAttr('disabled');

            // Menonaktifkan daftar meja
            $('#meja').prop('disabled', true).html('<option value="">Choose seat</option>');
        });

        // Ketika jam berubah
        $('select[name="time"]').change(function() {
            var jamSelect = $(this).val();
            var tanggalSelect = $('#date-input').val();

            // Ajax request untuk mendapatkan daftar meja
            $.ajax({
                url: 'validasi-ajax.php',
                type: 'GET',
                data: {
                    tanggal: tanggalSelect,
                    jam: jamSelect
                },
                success: function(response) {
                    var options = response.optionsMeja;
                    $('#meja').html(options).prop('disabled', false);
                    console.log(jamSelect);
                    console.log(tanggalSelect);
                    console.log(options);
                },
                error: function(xhr, status, error) {
                    console.log(error); // Menampilkan pesan kesalahan ke konsol
                    console.log(status);
                    console.log(xhr);
                }
            });
        });
    });
</script>
    <script src="../../assets/js/backend-bundle.min.js"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../../assets/js/table-treeview.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../../assets/js/customizer.js"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../../assets/js/chart-custom.js"></script>
    
    <!-- app JavaScript -->
    <script src="../../assets/js/app.js"></script>

    <!-- AJAX -->
    <script>
   

       


    </script>
  </body>
</html>