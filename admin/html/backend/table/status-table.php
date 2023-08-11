<?php
	require "../Connection.php";
    if(isset($_GET['isi'])){
        $id = $_GET['isi'];
        $status = "telah diisi";
        $queryOld = "select * from tb_meja where id_meja=$id";
        $prepareOld = $connect->prepare($queryOld);
        $prepareOld->execute();
        $fetachOld = $prepareOld->fetch(PDO::FETCH_OBJ);

        
        $queryUpdate2 = "UPDATE tb_meja SET status=? WHERE id_meja=?";
        $data2 = $connect->prepare($queryUpdate2);
        $data2->bindParam(1,$status);
        $data2->bindParam(2, $id);
        $berhasil2 = $data2->execute();
        if ($berhasil2) {
            header("Location: table.php");
        } else {
            echo "Gagal di edit";
        }
    }else{
        $id = $_GET['kosong'];
        $status = "Kosong";
        $queryOld = "select * from tb_meja where id_meja=$id";
        $prepareOld = $connect->prepare($queryOld);
        $prepareOld->execute();
        $fetachOld = $prepareOld->fetch(PDO::FETCH_OBJ);

        
        $queryUpdate2 = "UPDATE tb_meja SET status=? WHERE id_meja=?";
        $data2 = $connect->prepare($queryUpdate2);
        $data2->bindParam(1,$status);
        $data2->bindParam(2, $id);
        $berhasil2 = $data2->execute();
        if ($berhasil2) {
            header("Location: table.php");
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