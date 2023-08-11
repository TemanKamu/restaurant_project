<?php
	require "../Connection.php";
    if(isset($_GET['remove'])){
        $id = $_GET['remove'];
      
        $query = "DELETE FROM tb_reservasi WHERE no=?";
        $data = $connect->prepare($query);

        $data->bindParam(1,$id);
        $berhasil = $data->execute();

        if($berhasil){
            header("Location: reservation.php");
        }else{
            echo "Gagal di hapus";
        }
        }
	
?>