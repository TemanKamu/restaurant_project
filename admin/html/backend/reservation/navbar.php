<?php
  
    require "../Connection.php";
    
  
    

    $query = "SELECT COUNT(*) as total FROM tb_kritik";
    $data = $connect->query($query);
    $result = $data->fetch(PDO::FETCH_ASSOC);
    
    $totalData = $result['total'];
    
    $query2 = "SELECT * FROM tb_kritik ORDER BY date DESC LIMIT 1";
    $stmt = $connect->prepare($query2);
    $stmt->execute();
    $data2 = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $query3 = "SELECT * FROM tb_admin WHERE id=?";
    $stmt2 = $connect->prepare($query3);
    $stmt2->bindParam(1, $id_admin);
    $stmt2->execute();
    $data3 = $stmt2->fetch(PDO::FETCH_ASSOC);
    ?>
    


<div class="iq-top-navbar">
          <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        <a href="../index.html" class="header-logo">
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
                                <li class="nav-item nav-icon search-content">
                                    <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-search-line"></i>
                                    </a>
                                    <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                        <form action="#" class="searchbox p-2">
                                            <div class="form-group mb-0 position-relative">
                                                <input type="text" class="text search-input font-size-12"
                                                    placeholder="type here to search...">
                                                <a href="#" class="search-link"><i class="las la-search"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </li>
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
                                                        <a class="badge badge-primary badge-card" href="#"><?= $totalData; ?></a>
                                                    </div>
                                                </div>
                                                <div class="px-3 pt-0 pb-0 sub-card">
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3 border-bottom">
                                                            <div class="">
                                                                <img class="avatar-50 rounded-small"
                                                                    src="../../assets/images/user/01.jpg" alt="01">
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">Annonymous</h6>
                                                                    <?php
                                                                        if ($data2) {
                                                                            // Tampilkan data
                                                                            echo '<small class="text-dark"><b>'.$data2['time'].'</b></small>';
                                                                            
                                                                        } else {
                                                                           echo '<small class="text-dark"><b>tidak ada</b></small>';
                                                                        }
                                                                    ?>
                                                                    
                                                                </div>
                                                                <small class="mb-0">xx xxx xxx xxx xxx</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                 
                                                <a class="right-ic btn btn-block btn-primary position-relative p-2" href="../kritik/index.php"
                                                    role="button">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                              
                                <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="../../assets/images/user/1.png" class="img-fluid rounded" alt="user">
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 text-center">
                                                <div class="media-body profile-detail text-center">
                                                    <img src="../../assets/images/page-img/profile-bg.jpg" alt="profile-bg"
                                                        class="rounded-top img-fluid mb-4">
                                                    <img src="../../assets/images/user/1.png" alt="profile-img"
                                                        class="rounded profile-img img-fluid avatar-70">
                                                </div>
                                                <div class="p-3">
                                                <h5 class="mb-1">Admin</h5>
                                                    <div class="d-flex align-items-center justify-content-center mt-3">
                                                    
                                                        <a href="../auth-proses/logout.php" class="btn border">Sign Out</a>
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
        