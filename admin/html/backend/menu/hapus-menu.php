<?php
	require "../Connection.php";
    if(isset($_GET['remove'])){
        $id = $_GET['remove'];
        $queryOld = "select * from tb_menu where id=$id";
        $prepareOld = $connect->prepare($queryOld);
        $prepareOld->execute();
        $fetachOld = $prepareOld->fetch(PDO::FETCH_OBJ);

        // $delete = $con->query("DELETE FROM tb_siswa WHERE id='$id'");
        // if ($delete) {
        // 	unlink('../'.$old['foto']);
        // 	header('Location:../index.php');
        // }else{
        // 	echo"<script>alert('Gagal menghapus data')</script>";
        // }

        $query = "DELETE FROM tb_menu WHERE id=?";
        $data = $connect->prepare($query);

        $data->bindParam(1,$id);
        $berhasil = $data->execute();

        if($berhasil){
            unlink($fetachOld->picture);
            header("Location: menu.php");
        }else{
            echo "Gagal di hapus";
        }
        }
	
?>