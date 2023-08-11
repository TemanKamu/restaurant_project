<?php 
    require "../Connection.php";
    if(isset($_POST["login"])){
        $dataValue =  $_POST["data"];
        $password = $_POST["password"];

        // Cek email terdaftar ada di database
		$query = "SELECT * FROM tb_admin WHERE email = ? OR no_hp = ?";
		$data = $connect->prepare($query);  
		$data->bindValue(1, $dataValue);
        $data->bindValue(2, $dataValue);

		$data->execute();
		$user = $data->fetch(PDO::FETCH_OBJ);
        
        //Jika akun tidak terdaftar
        if(empty($user)){
            session_start();
            $_SESSION['status'] = "Kosong";
            header("location: ../login.php");
            exit(); // Menghentikan eksekusi kode setelah pengalihan halaman
        }else{
            //Jika status akun masih pending
            if((string)$user->status == "Pending"){
                session_start();
                $_SESSION['status'] = "Pending";
                header("location: ../login.php");
                exit(); // Menghentikan eksekusi kode setelah pengalihan halaman    
             //Jika status akun ditolak
            }elseif((string)$user->status == "Rejected"){
                session_start();
                $_SESSION['status'] = "Rejected";
                header("location: ../login.php");
                exit(); // Menghentikan eksekusi kode setelah pengalihan halaman
             //Jika status akun Disetujui
            }else{
                if(password_verify($password, $user->password)){
                    //Panggil session
                    session_start();
                    // Simpan nama dan email ke dalam session
                    $_SESSION['email'] = $user->email;
                    $_SESSION['no_hp'] = $user->no_hp;
                    $_SESSION['id'] = $user->id;

                    header("location: ../index.php");
                    exit();
                }else{
                    session_start();
                    $_SESSION['password'] = "salah";
                    header("location: ../login.php");
                    exit(); // Menghentikan eksekusi kode setelah pengalihan halaman
                }
            }
        }
        
    }
?>