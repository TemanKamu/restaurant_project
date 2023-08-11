<?php
	require "../Connection.php";
    if(isset($_GET['terima'])){
        $id = $_GET['terima'];
        $status = "Approved";
        $queryOld = "select * from tb_reservasi WHERE no=$id";
        $prepareOld = $connect->prepare($queryOld);
        $prepareOld->execute();
        $fetachOld = $prepareOld->fetch(PDO::FETCH_OBJ);

        
        $queryUpdate2 = "UPDATE tb_reservasi SET status=? WHERE no=?";
        $data2 = $connect->prepare($queryUpdate2);
        $data2->bindParam(1,$status);
        $data2->bindParam(2, $id);
        $berhasil2 = $data2->execute();
        if ($berhasil2) {
            header("Location: reservation.php");
        } else {
            echo "Gagal di edit";
        }
    }else{
        $id = $_GET['tolak'];
        $status = "Rejected";
        $queryOld = "select * from tb_reservasi where no=$id";
        $prepareOld = $connect->prepare($queryOld);
        $prepareOld->execute();
        $fetachOld = $prepareOld->fetch(PDO::FETCH_OBJ);

        
        $queryUpdate2 = "UPDATE tb_reservasi SET status=? WHERE no=?";
        $data2 = $connect->prepare($queryUpdate2);
        $data2->bindParam(1,$status);
        $data2->bindParam(2, $id);
        $berhasil2 = $data2->execute();
        if ($berhasil2) {
            header("Location: reservation.php");
        } else {
            echo "Gagal di edit";
        }
    }

        // $query = "DELETE FROM tb_menu WHERE id=?";
        // $data = $connect->prepare($query);

        // $data->bindParam(1,$id);
        // $berhasil = $data->execute();

        // if($berhasil){
        //     unlink($fetachOld->picture);
        //     header("Location: menu.php");
        // }else{
        //     echo "Gagal di hapus";
        // }
    
	
?>