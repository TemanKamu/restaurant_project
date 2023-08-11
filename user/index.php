<?php

  session_start();

  if(!(isset($_SESSION['nama'])) && !isset($_SESSION['email'])){
    echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                
                 document.getElementById('book-a-table-form').action = '';
                 document.getElementById('book-a-table-form').addEventListener('submit', function(event) {    
                    alert('Silahkan login terlebih dahulu!');
                });
                
              });
          </script>";
  }else{
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#show-login').forEach(function(link) {
          link.style.setProperty('display', 'none', 'important');
        });
     });
    </script>";

  }
  require "../Connection.php";
  // Query untuk menampilkan semua data di tb_barang
	$query = "SELECT * FROM tb_menu";
	// Hubungkan query di atas ke koneksi menggunakan function prepare()
	$data = $connect->prepare($query);
	// Eksekusi Query menggunakan function execute()
	$data->execute();
	// Ubah data kedalam bentuk object
	$tampil = $data->fetchAll(PDO::FETCH_OBJ);

  //Daftar meja
  $query4 = "SELECT * FROM tb_meja";
	// Hubungkan query di atas ke koneksi menggunakan function prepare()
	$data4 = $connect->prepare($query4);
	// Eksekusi Query menggunakan function execute()
	$data4->execute();
	// Ubah data kedalam bentuk object
	$tampil4 = $data4->fetchAll(PDO::FETCH_OBJ);
  //Modal order

  if(isset($_SESSION['id'])){ 
  $id_pengguna = $_SESSION["id"];

  $query3 = "SELECT COUNT(*) AS jumlah FROM tb_reservasi WHERE id_pengguna = $id_pengguna AND status='Pending'";
  $data3 = $connect->prepare($query3);
  // Eksekusi Query menggunakan function execute()
  $data3->execute();
  // Ubah data kedalam bentuk object
  $tampil3 = $data3->fetch(PDO::FETCH_OBJ);
    
  $query5 = "SELECT MAX(date) AS tanggal_tertinggi FROM tb_reservasi WHERE id_pengguna= $id_pengguna";
  $stmt = $connect->query($query5);
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $tanggal_tertinggi = $result['tanggal_tertinggi'];
  
  // var_dump($id_pengguna);
  // die();
  if($tanggal_tertinggi != NULL){  
  $query2 = "SELECT * FROM tb_reservasi INNER join tb_pengguna on tb_reservasi.id_pengguna= tb_pengguna.id WHERE tb_reservasi.id_pengguna =  $id_pengguna AND tb_reservasi.date= '$tanggal_tertinggi'";
  // Hubungkan query di atas ke koneksi menggunakan function prepare()
  $data2 = $connect->prepare($query2);
  // Eksekusi Query menggunakan function execute()
  $data2->execute();
  // Ubah data kedalam bentuk object
  $tampil2 = $data2->fetch(PDO::FETCH_OBJ);
  //QUery mencari data reservasi user yang status nya pending
  }
}
  // echo "<script>alert(is_null\($tampil2->date));</script>";
  
  

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Nourriture délicieuse</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.min.css" />
  <!-- Favicons -->
  <link href="assets/img/restaurant-icon.jpeg" rel="icon">
  <link href="assets/img/restaurant-icon.jpeg" rel="restaurant-icon">
  <link rel="stylesheet" href="assets/vendor/datepicker/dist/calendarify.min.css" />


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->

  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>
    input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1);
  }

    .blurred{
      filter: blur(3px) !important;
    }
    #login-message {
    display: none;
  }

  #login-message.visible {
    display: block;
    text-align: center;
    font-size: 20px;
    margin: 20px;
    color: red;
  }
  </style>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-center justify-content-md-between">

      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-phone d-flex align-items-center"><span>+62 823 4567 8974</span></i>
        <i class="bi bi-clock d-flex align-items-center ms-4"><span> Mon-Sat: 11.00 AM - 21.00 PM</span></i>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-cente">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.html">Nourriture délicieuse</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
          <li><a class="nav-link scrollto" href="#specials">Specials</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
          <li><a class="nav-link scrollto" href="#chefs">Chefs</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li> 
          <?php
          if(isset($_SESSION['id'])){
          ?>
          <li><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Order</a></li> 
          <?php
          }
          ?>  
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->  
      <?php
          if(isset($_SESSION['id'])){
            echo '<a href="#book-a-table" class="book-a-table-btn scrollto d-none d-lg-flex">Reservation</a>';
            echo '<a href="page/logout.php" class="book-a-table-btn scrollto d-none d-lg-flex">Log out</a>';
          }else{
            echo '<a href="page/login.php" class="book-a-table-btn scrollto d-lg-flex">Reservation</a>';
          }
        ?>
      <a class="book-a-table-btn scrollto d-lg-flex login-button justify-content-center" id="show-login" href="page/login.php">Login</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Welcome to <span>Nourriture délicieuse</span></h1>
          <h2>Delivering great food for more than 18 years!</h2>

          <div class="btns">
            <span class="" id="show-login"><a href="page/login.php" class="btn-menu mx-3 px-5" id="">Login</a></span>
            <a href="#menu" class="btn-menu animated fadeInUp scrollto">Our Menu</a>
            <?php 
            if(isset($_SESSION['id'])){
              echo'<a href="#book-a-table"  class="btn-book animated fadeInUp scrollto book2">Reservation</a>';
            }else{
               echo'<a href="page/login.php" id="alertSweet"  class="btn-book animated fadeInUp scrollto book2">Reservation</a>';
            }
            ?>

          </div>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Modal Notification ======= -->
    <!-- <div id="modalForm" class="modal fade"  data-bs-toggle="modal" data-bs-target="#modalSucces" aria-labelledby="modalSucces">
      <div class="modal-dialog modal-confirm">
        <div class="modal-content">
          <div class="modal-header">
            <div class="icon-box">
              <i class="material-icons">&#xE876;</i>
            </div>				
            <h4 class="modal-title w-100">Awesome!</h4>	
          </div>
          <div class="modal-body">
            <p class="text-center">Your booking has been confirmed. Check your email for detials.</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>    -->

    <!-- ======= End modal Notification ====== -->
    <!-- ======= Modal Order ======== -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">   
              <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-start text-black p-4">
                
                <?php
                  
                    // Data ditemukan, dapatkan properti yang diperlukan
                    $current_date = date("Y-m-d");
                    if (date("Y-m-d") > $tanggal_tertinggi) { 
                     
                        // Tanggal pemesanan sudah lewat
                        $status1 = "kosong";
                        $query1 = "UPDATE tb_meja SET status=?";
                        $data1 = $connect->prepare($query1);
                        $data1->bindParam(1, $status1);
                        $succes1 = $data1->execute();
                    
                        echo "<h5 class='modal-title text-uppercase mb-5 text-dark fw-bold' id='exampleModalLabel'>Tidak ada order</h5>";
                    
                        // Jika data sudah tidak luwarsa, maka data akan otomatis ditolak
                        $tanggal_reservasi = $tanggal_tertinggi;
                    
                        $query4 = "UPDATE tb_reservasi SET status='Rejected' WHERE id_pengguna=? AND date=?";
                        $data4 = $connect->prepare($query4);
                        $data4->bindParam(1, $id_pengguna);
                        $data4->bindParam(2, $tanggal_reservasi);
                        $succes4 = $data4->execute();
                      } else {
                    // Tampilkan tampilan pemesanan yang valid
                          if ($tampil2->status == "Approved") {
                            // Section meja
                            $status1 = "telah diisi";
                            $query1 = "UPDATE tb_meja SET status=? WHERE no=?";
                            $data1 = $connect->prepare($query1);
                            $data1->bindParam(1, $status1);
                            $data1->bindParam(2, $tampil2->meja);
                            $succes1 = $data1->execute();
                            
                            ?>
                            <h5 class="modal-title text-uppercase mb-5 text-dark fw-bold"  id="exampleModalLabel"><?php echo $tampil2->nama; ?></h5>
                            <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                            <p class="mb-0" style="color: #35558a;">Payment summary</p>
                            <hr class="mt-2 mb-4"
                              style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">

                            <div class="d-flex justify-content-between">
                              <p class="fw-bold mb-0 text-dark">Tanggal</p>
                              <p class="text-muted mb-0"><?php echo $tampil2->date; ?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                              <p class="small mb-0 text-dark">Jam</p>
                              <p class="small mb-0 text-dark"><?php echo $tampil2->time; ?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                              <p class="small mb-0 text-dark">Meja</p>
                              <p class="small mb-0 text-dark"><?php echo "No.".$tampil2->meja; ?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                              <p class="small text-dark">Event</p>
                              <p class="small text-dark"><?= $tampil2->event ?></p>
                            </div>

                            <div class="d-flex justify-content-between pb-1">
                              <p class="small text-dark">Status</p>
                              <p class="small  <?= ($tampil2->status == 'Approved') ? 'text-success' : (($tampil2->status== 'Pending')  ? 'text-warning' : 'text-danger') ;?>"><?php echo $tampil2->status; ?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                              <p class="text-dark fw-bold">Total</p>
                              <p class="text-dark fw-bold" style="color: #35558a;">$50.00</p>
                            </div>
                            <?php
                          }else{
                          ?>
                            <h5 class="modal-title text-uppercase mb-5 text-dark fw-bold"  id="exampleModalLabel"><?php echo $tampil2->nama; ?></h5>
                            <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                            <p class="mb-0" style="color: #35558a;">Payment summary</p>
                            <hr class="mt-2 mb-4"
                              style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">

                            <div class="d-flex justify-content-between">
                              <p class="fw-bold mb-0 text-dark">Tanggal</p>
                              <p class="text-muted mb-0"><?php echo $tampil2->date; ?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                              <p class="small mb-0 text-dark">Jam</p>
                              <p class="small mb-0 text-dark"><?php echo $tampil2->time; ?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                              <p class="small mb-0 text-dark">Meja</p>
                              <p class="small mb-0 text-dark"><?php echo "No.".$tampil2->meja; ?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                              <p class="small text-dark">Event</p>
                              <p class="small text-dark"><?= $tampil2->event ?></p>
                            </div>

                            <div class="d-flex justify-content-between pb-1">
                              <p class="small text-dark">Status</p>
                              <p class="small  <?= ($tampil2->status == 'Approved') ? 'text-success' : (($tampil2->status== 'Pending')  ? 'text-warning' : 'text-danger') ;?>"><?php echo $tampil2->status; ?></p>
                            </div>

                            <div class="d-flex justify-content-between">
                              <p class="text-dark fw-bold">Total</p>
                              <p class="text-dark fw-bold" style="color: #35558a;">$50.00</p>
                            </div>
                         <?php 
                        }
                      }
                    // Lanjutkan dengan bagian kode lainnya
              
                  // Terdapat data pemesanan yang tersedia
                 ?>
              </div>
            </div>
          </div>
        </div>
    <!-- ======= End Modal Order ======== -->

    <!-- ======= Form Section ======= -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="assets/img/about.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>About us</h3>
            <p class="fst-italic">
            Our French restaurant provides an elegant and enthralling culinary experience in the heart of the city. With a touch of elegance and authentic delicacy, we present French classics prepared with heart by our talented chefs.
            Step into our warm and romantic restaurant, with French-style décor exuding beauty and charm. An intimate and friendly atmosphere adds to your satisfaction in enjoying our dishes.
            Our menu features varied and delicious French specialties. choose mouthwatering main dishes such as Lobser Bisque, Tuscan Grilled, Caesar Selectio.
            Don't forget the crowd favorite sweet dessert, Crab cake and delicious Mozzarella burrata. Enjoy your meal while enjoying an exclusive selection of French wines, specially selected to complete your culinary experience.
            We are committed to serving the best quality dishes using the freshest and highest quality ingredients. Every dish is carefully prepared by our team of experienced chefs, who blend French culinary expertise with a touch of modern creativity.
            Come to our French restaurant and let us pamper you with mouth-watering dishes, friendly service and an alluring atmosphere. Together, we will take you on a culinary journey that will delight your taste buds and satisfy your heart.
            </p>  
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Why Us</h2>
          <p>Why Choose Our Restaurant</p>
        </div>

        <div class="row">

          <div class="col-lg-4">
            <div class="box" data-aos="zoom-in" data-aos-delay="100">
              <span>01</span>
              <h4>Food</h4>
              <p>The food is delicious, you can get delicious with affordable price</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="200">
              <span>02</span>
              <h4>Service</h4>
              <p>Friendly service restaurant with friendly and satisfying service.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="box" data-aos="zoom-in" data-aos-delay="300">
              <span>03</span>
              <h4>Nice view</h4>
              <p>You can get a good view and lots of places to take pictures</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Menu</h2>
          <p>Check Our Tasty Menu</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-starters">Starters</li>
              <li data-filter=".filter-salads">Salads</li>
              <li data-filter=".filter-specialty">Specialty</li>
            </ul>
          </div>
        </div>

        <!-- <div class="menu-popup ">
          <div class="card">
            <div class="row">
                <div class="col-5 d-flex align-items-">
                  <img src="assets/img/menu/lobster-bisque.jpg" alt="Lobster" class="img-fluid rounded-circle">
                </div> 
                <div class="col-7">
                  <div class="card-title ">
                    <h2>Losbter</h2>
                    <h2>Bisque</h2>
                  </div>
                  <div class="card-body">
                    <div class="col-12">
                      <i class=>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas rerum commodi similique nobis. Voluptas error, reiciendis adipisci commodi pariatur quis labore? Modi, consequatur quod reprehenderit voluptatibus quis autem neque iste.</i>
                    </div>
                    <div class="col-5">
                      <p class="title mt-3"><b>$5.95</b></p>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div> -->
        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
        <?php
          foreach($tampil as $t){
            echo 
            '<div class="col-lg-6 menu-item filter-'.$t->filter.'">
                <img src="../admin/html/backend/menu/'.$t->picture.'" class="menu-img" alt="">
                <div class="menu-content">
                  <a href="#">'.$t->nama.'</a><span>'.$t->price.'</span>
                </div>
                <div class="menu-ingredients">
                  '.$t->deskripsi.'
                </div>
           </div>';
          }
        ?>
 
        </div>

      </div>
    </section><!-- End Menu Section -->

    <!-- ======= Specials Section ======= -->
    <section id="specials" class="specials">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Specials</h2>
          <p>Check Our Specials</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Tangy Glazed Poultry Medley</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Sunny Orange Infusion</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Flavorful Noodle Sanctuary</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Balsamic Glazed Bruschetta Dip</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Tropical Sesame Fruit Salad</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Tangy Glazed Poultry Medley</h3>
                    <p>Tangy Glazed Poultry Medley  is a beloved Chinese dish that features crispy chicken pieces and an array of vibrant vegetables, all stir-fried to perfection in a delectable Tangy Glazed Poultry Medley</p>
                    <p>The chicken is coated in a light batter and fried until golden and crispy, while the sauce combines a harmonious blend of tanginess and sweetness. Alongside the tender chicken, an assortment of colorful vegetables like bell peppers, onions, carrots, and pineapple chunks add a fresh and delightful touch to the dish. This flavorful combination, when served with steamed rice or noodles, creates a satisfying and well-rounded meal that showcases the art of Chinese cuisine.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-1.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Sunny Orange Infusion</h3>
                    <p>Sunny Orange Infusion is a revitalizing beverage that captures the essence of fresh oranges. This refreshing drink combines the zest and juice of oranges with a hint of sweetness, creating a vibrant and invigorating flavor profile. Whether enjoyed on a hot summer day or as a thirst-quencher anytime, Sunny Orange Infusion provides a burst of citrusy goodness that is sure to refresh and rejuvenate.</p>
                    <p>Sunny Orange Infusion is a perfectly balanced beverage that highlights the natural sweetness of oranges. With its invigorating flavors and vibrant color, it brings a refreshing citrus twist to any occasion. Whether enjoyed on its own or used as a base for creative cocktails, this infusion adds a taste of sunshine to every sip. Ideal for relaxation, outdoor gatherings, or simply brightening up your day, Sunny Orange Infusion is a delightful companion that will leave you feeling refreshed and revitalized.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-2.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Flavorful Noodle Sanctuary</h3>
                    <p>Flavorful Noodle Sanctuary is a culinary haven, catering to noodle enthusiasts with a diverse range of delectable dishes bursting with flavor. From ramen to udon and soba, each dish is meticulously prepared with a harmonious blend of ingredients and seasonings, creating a satisfying dining experience.</p>
                    <p>The perfectly cooked noodles, paired with savory broths, flavorful sauces, and fresh ingredients, offer a delightful symphony of tastes and textures. This welcoming sanctuary promises to fulfill your noodle cravings and leave you longing for more, with its dedication to exceptional flavors and the art of noodle preparation.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-3.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Balsamic Glazed Bruschetta Dip</h3>
                    <p>Balsamic Glazed Bruschetta Dip is a delicious and versatile appetizer that combines the vibrant flavors of bruschetta with the richness of balsamic glaze. This irresistible dip features diced tomatoes, garlic, fresh basil, and olive oil, all marinated in a tangy balsamic glaze. The result is a delightful balance of sweet and savory flavors that is perfect for scooping up with toasted baguette slices or crispy bread. </p>
                    <p>The combination of the crunchy bread and the flavorful dip creates a satisfying and appetizing experience that is sure to please any palate. Whether served at parties, gatherings, or as a quick snack, the Balsamic Glazed Bruschetta Dip is a crowd-pleasing favorite that will leave everyone coming back for more of its irresistible taste.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-4.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Tropical Sesame Fruit Salad</h3>
                    <p>Tropical Sesame Fruit Salad is a vibrant and flavorful dish that combines sweet tropical fruits with a hint of nutty sesame. This refreshing salad features a medley of fresh mangoes, bananas, and grapes tossed in a tangy dressing. </p>
                    <p>The sprinkle of toasted sesame seeds adds a delightful crunch. Perfect for summer gatherings or as a refreshing side dish, this salad brings the taste of the tropics to your plate with its irresistible flavors and vibrant presentation.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-5.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Specials Section -->

    <!-- ======= Events Section ======= -->
    
    <!-- ======= Book A Table Section ======= -->
    <?php
     if(isset($_SESSION['id'])){ 
    ?>
    <section id="book-a-table" class="book-a-table <?= ($tampil3->jumlah > 0) ? 'd-none' : '' ?> ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Reservation</h2>
          <p>Book a Table</p>
        </div>

        <form action="reservation-proses.php" id="book-a-table-form" method="post" role="form" class="php-email-form"  onsubmit="return validateForm()" data-aos="fade-up" data-aos-delay="100">
          <div class="row">
            <div class="col-lg-4 col-md-6 form-group mt-3">
              <input type='hidden' name='id_pengguna' value="<?= $_SESSION['id'] ?>">
              <input type="date" name="date"  class="form-control" id="date-input" value="date" min="<?php echo date('Y-m-d'); ?>" max="9999-12-31">
              <div class="validate"></div>  
              <!-- onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'" -->
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3 text-white"> 
              <input type="text" name="time" class="form-control" id="timesValidasi" class="time-value" value="Times" placeholder="Time" required readonly >
              <div class="times" id="time-menu" style="display: none;">
                <h2>Available Times</h2>
                <div class="border-bottom"></div>
                <div class="row">
                <?php
                  $dataJam = array("11:00-12:45", "13:00-14:45", "17:30-19:00", "19:15-20:45");

                  foreach ($dataJam as $index => $jam) {
                    $id = "radio" . ($index + 1);
                    $label = $jam;
                  ?>
                  <div class="col-lg-6 col-6">
                      <div class="card">
                          <input type="radio" class="times time<?php echo $index + 1; ?>" id="<?php echo $id; ?>" name="radio" value="<?php echo $label; ?>" disabled>
                          <label for="<?php echo $id; ?>">
                              <h5 id="times-option<?php echo $index + 1; ?>"><?php echo $label; ?></h5>
                          </label>
                      </div>
                  </div>
                  <?php } ?>
                  <!-- <div class="col-lg-6 col-6">
                    <div class="card">
                      <input type="radio" class="times time1" id="radio1" name="radio" value="11:00-12:45">
                      <label for="radio1">
                        <h5 id="times-option1">11:00-12:45</h5>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6 col-6">
                    <div class="card">
                      <label for="radio2">
                        <input type="radio" class="times time1" id="radio2" name="radio" value="13:00-14:45" >
                        <h5 id="times-option2">13:00-14:45</h5>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6 col-6">
                    <div class="card">
                      <label for="radio3">
                        <input type="radio" class="times time1" id="radio3" name="radio" value="17:30-19:00">
                        <h5 id="times-option3">17:30-19:00</h5>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6 col-6">
                    <div class="card">
                      <label for="radio4">
                        <input type="radio" class="times time1" id="radio4" name="radio" value="19:15-20:45">
                        <h5 id="times-option4">19:15-20:45</h5>
                      </label>
                    </div>
                  </div> -->
                </div>
              </div>
              <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3">
              <select class="form-control" name="meja" id="meja" required>
                 <option>Choose seats</option>
              </select>
              <div class="validate"></div>
            </div>
            <div class="col-lg-12 col-md-6 form-group mt-3">
              <select class="form-control" name="event" id="event" required>
                <option value>Choose occasion</option>
                <option>No Event</option>
                <option>Familiy</option>
                <option>Birthday</option>
                <option>Anniversary</option>
              </select>
              <div class="validate"></div>
            </div>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="special-request" rows="5" placeholder="Special request"></textarea>
            <div class="validate"></div>
          </div>
          <div class="col-lg-12 my-4">
            <div class="card" style="background: #1b1811;">
              <div class="card-header">
                <h6 class="mt-3 mx-3">PLEASE READ THE RESERVATION TERMS AND CONDITION</h6>
              </div>
              <div class="card-body ">
                <ol class="">
                  <li>Tables are available for 90 minutes or such shorter time communicated to you in your booking confirmation, after which they will be re-booked for another customer. </li>
                  <li>Special requests are not guaranteed and are subject to availability and restaurant discretion. Notes stating an alternative timing or party-size will not be accommodated.</li> 
                  <li>Your table will be held for 15 minutes after which time it may be allocated to another customer.</li>
                  <li>Reschedule of your reservation is possible within 14 days from your reserved date. New schedule must be made D-1 at 18:00 (max) from your chosen date.</li>
                  <li>Your new reservation will be confirmed upon availability on the chosen date/hours.</li>
                  <li>Group bookings (applies to party sizes larger than 10) For reservations of 11 or more people, must be booked through our customer service (hyperlink).</li>
                  <li>All reservations made are non-refundable upon cancelation from the customer with an exception of Force Majeure.</li>
                </ol>
              </div>
            </div>
          </div>
         
          <div class="text-center"><button type="submit" data-toggle="modal" data-target="#myModal">Book a Table</button></div>
        </form>

      </div>
    </section><!-- End Book A Table Section -->
    <?php
     }
    ?>

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Testimonials</h2>
          <p>What they're saying about us</p>
        </div>

        <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  This restaurant is very nice with a beautiful view, perfect for relaxing.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  This restaurant provides delicious food and is suitable to be enjoyed with the family.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  I am very happy with this restaurant because the service is very satisfying and I have been a customer of this restaurant for a long time.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  This restaurant provides lots of places for photos, very instagramable.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  I really like the food and service here because it is very satisfying.
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">

      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Gallery</h2>
          <p>Some photos from Our Restaurant</p>
        </div>
      </div>

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-1.jpg" class="gallery-lightbox" data-gall="gallery-item">
                <img src="assets/img/gallery/gallery-1.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-2.jpg" class="gallery-lightbox" data-gall="gallery-item">
                <img src="assets/img/gallery/gallery-2.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-3.jpg" class="gallery-lightbox" data-gall="gallery-item">
                <img src="assets/img/gallery/gallery-3.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-4.jpg" class="gallery-lightbox" data-gall="gallery-item">
                <img src="assets/img/gallery/gallery-4.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-5.jpg" class="gallery-lightbox" data-gall="gallery-item">
                <img src="assets/img/gallery/gallery-5.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-6.jpg" class="gallery-lightbox" data-gall="gallery-item">
                <img src="assets/img/gallery/gallery-6.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-7.jpg" class="gallery-lightbox" data-gall="gallery-item">
                <img src="assets/img/gallery/gallery-7.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-8.jpg" class="gallery-lightbox" data-gall="gallery-item">
                <img src="assets/img/gallery/gallery-8.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Chefs Section ======= -->
    <section id="chefs" class="chefs">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Chefs</h2>
          <p>Our Proffesional Chefs</p>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="member" data-aos="zoom-in" data-aos-delay="100">
              <img src="assets/img/chefs/chefs-1.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Walter White</h4>
                  <span>Master Chef</span>
                </div>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="member" data-aos="zoom-in" data-aos-delay="200">
              <img src="assets/img/chefs/chefs-2.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Sarah Jhonson</h4>
                  <span>Patissier</span>
                </div>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="member" data-aos="zoom-in" data-aos-delay="300">
              <img src="assets/img/chefs/chefs-3.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>William Anderson</h4>
                  <span>Cook</span>
                </div>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Chefs Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>
      </div>

      <div data-aos="fade-up">
        <iframe style="border:0; width: 100%; height: 350px;" src="https://maps.google.com/maps?q=smk isfi&t=&z=10&ie=UTF8&iwloc=&output=embed" frameborder="0" allowfullscreen></iframe>
      </div>

      <div class="container" data-aos="fade-up">

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Jl. Flamboyan III No.7B, Sungai Miai, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70123, Indonesia</p>
              </div>

              <div class="open-hours">
                <i class="bi bi-clock"></i>
                <h4>Open Hours:</h4>
                <p>
                  Monday-Saturday:<br>
                  11:00 AM - 23:00 PM
                </p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>lutf8333@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+62 823 4567 8974</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="kritiksaran-proses.php" method="POST" class="php-email-form" >
              <input type="hidden" name="id_pengguna" class="form-control" value="" required>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="16" placeholder="Message" required></textarea>
              </div>
              <!-- <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div> -->
              <div class="text-center"><button type="submit" name="kirim">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <div class="col-3">
            <img src="assets/img/restaurant-icon.jpeg" class="img-fluid rounded-circle" alt="Restaurant icon">
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="footer-info ">
              <h3>Restaurantly</h3>
              <p>
                Jl. Flamboyan III No.7B, Sungai Miai, Kec. Banjarmasin Utara, Kota Banjarmasin <br>
                Kalimantan Selatan 70123, Indonesia<br><br>
                <strong>Phone:</strong> +62 819   5399 1564<br>
                <strong>Email:</strong> lutf8333@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-md-6">
            <div class="footer-info footer-links">
              <h3>Content</h3>
              <ul>
                <li><a href="#hero">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#specials">Specials</a></li>
                <li><a href="#chefs">Chefs</a></li>
                <li><a href="#gallery">Gallery</a></li>
                <li><a href="#contacts">Contacts</a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Nourriture délicieuse</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- ionicons JS Files -->
  <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons/dist/ionicons/ionicons.js"></script>

  <!--  Datepicker -->

  <script src="assets/vendor/datepicker/dist/calendarify.iife.js"></script>

  <script>
    function validateForm() {
    var seatSelection = document.getElementById("meja").value;
    var timeSelector = document.getElementById("timesValidasi").value;
    var occasionChoose = document.getElementById("event").value;

    if (seatSelection == "Choose seats") {
      alert("Anda belum memilih tempat duduk!");
      return false; // Menghentikan pengiriman form
    }elseif(timeSelector == "Time"){
      alert("Anda belum memilih waktu!");
      return false; // Menghentikan pengiriman form
    }elseif(occasionChoose == "Choose occasion"){
      alert("Anda belum memilih event!");
      return false; // Menghentikan pengiriman form
    }
    return true; // Melanjutkan pengiriman form
  }
  // Fungsi untuk menampilkan SweetAlert
  document.getElementById('alertSweet').addEventListener('click', function(event) {
    event.preventDefault(); // Menghentikan navigasi default

    Swal.fire({
      text: 'Please login first',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.isConfirmed) {
        // Jika pengguna menekan tombol "Ya", pindah ke halaman tujuan
        window.location.href = 'page/login.php';
      }
    });
  });
</script>
  <script>
//   const calendarify = new Calendarify('.calendarify-input', {
//   onChange: (calendarify) => console.log(calendarify), // You can trigger whatever function in this property (e.g. to fetch data with passed date parameter)
//   quickActions: true, // You can enable/disable quick action (Today, Tomorrow, In 2 Days) buttons with boolean
//   isDark: true, // You can enable/disable dark mode
//   zIndex: 9999,
//   customClass: ['font-poppins'], // You can add custom class to the calendarify element
//   locale: { // You can set locale for calendar
//     format: "YYYY-MM-DD", // Set Custom Format with Moment JS
//     lang: {
//       code: 'id', // Set country code (e.g. "en", "id", etc)
//       months: ["January","February","March","April","May","June","July","August","September","October","November","December"], 
//       weekdays: ["Monday","Tuesday","Wednesday","Thusday","Friday","Saturday","Sunday"], // Or you can use locale moment.weekdays instead
//     }
//   }
// })
// calendarify.init()

// const times = document.querySelector('.times');
// const times_btn =  document.querySelector('.times-btn');

// const i = 0;

// if(i % 2 == 2 ){
//   times_btn.addEventListener('click', ()=> {
//     times.classList.remove('d-none');
//     times.classList.add('d-block');
//   })
// }
// let btn1 = document.getElementById("time-toggle");

//Toggle times
var tombol = document.querySelector("#timesValidasi");
var elemen = document.getElementById("time-menu");

tombol.addEventListener('click', () => {
  if (elemen.style.display === "none") {
        elemen.style.display = "block";
    } else {
        elemen.style.display = "none";
    }
})

// tombol.onclick = function() {
//     if (elemen.style.display === "none") {
//         elemen.style.display = "block";
//     } else {
//         elemen.style.display = "none";
//     }
// };
// const times = document.querySelector('.times');
// function validasi() {
//     let input = document.getElementById('timesValidasi')
//     var value =  parseInt(input.value);
//     value += 1;
//    input.value = value.toString();
//     if(value %  2 == 1){
//       times.classList.remove('d-none');
//       times.classList.add('d-block');
//     }else{
//       times.classList.remove('d-block');
//       times.classList.add('d-none')
//     }
// }

//Option


const radio1 = document.getElementById('radio1');
const radio2 = document.getElementById('radio2');
const radio3 = document.getElementById('radio3');
const radio4 = document.getElementById('radio4');

radio1.addEventListener('click', () => {
  tombol.value = radio1.value;
});

radio2.addEventListener('click', () => {
  tombol.value = radio2.value;
});

radio3.addEventListener('click', () => {
  tombol.value = radio3.value;
});

radio4.addEventListener('click', () => {
  tombol.value = radio4.value;
});

// times.forEach((value, index) => {
//   times[index].addEventListener('click', () => {
//     console.log(value);
//     document.querySelector(".time-value").value = times[index].value;
//   });
// })

function showOption(radio){
  document.querySelector(".time-value").value = radio.value;
}
 </script>

<script>
   $(document).ready(function() {
    // Menonaktifkan input jam secara default
    $('input[name="radio"]').prop('disabled', true);

    // Ketika tanggal berubah
    $('#date-input').change(function() {
      // Menghapus atribut disabled pada input jam
      $('input[name="radio"]').removeAttr('disabled');

      // Menonaktifkan daftar meja
      $('#meja').prop('disabled', true).html('<option value="">Choose seats</option>');
    });

    // Ketika jam berubah
    $('input[name="radio"]').change(function() {
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
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/login.js"></script>

</body>

</html>