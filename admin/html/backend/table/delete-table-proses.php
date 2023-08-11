<?php
	require "../Connection.php";
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
      
        $query = "DELETE FROM tb_meja WHERE id_meja=?";
        $data = $connect->prepare($query);

        $data->bindParam(1,$id);
        $berhasil = $data->execute();

        if($berhasil){
            header("Location: table.php");
        }else{
            echo "Gagal di hapus";
        }
        }
	
?>