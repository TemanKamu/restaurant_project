<?php
    require '../Connection.php';
    if(isset($_POST['edit'])){
		//Query update
        $id = $_POST['id_menu'];
        $queryOld = "select * from tb_menu where id=$id";
        $prepareOld = $connect->prepare($queryOld);
        $prepareOld->execute();
        $fetachOld = $prepareOld->fetch(PDO::FETCH_OBJ);

        // proses kalau ada gambar
        if (!empty($_FILES) && $_FILES['foto-menu']['name'] !== '') {
            // Hapus gambar sebelumnya
            unlink($fetachOld->picture);

            // masukkan gambar terbaru
            $foto = $_FILES['foto-menu']['name'];
            $foto_tmp = $_FILES['foto-menu']['tmp_name'];
            $url_foto = "img/$foto";
            move_uploaded_file($foto_tmp, $url_foto);

            $queryUpdate1 = "UPDATE tb_menu SET nama=?,deskripsi=?,price=?,filter=?,picture=? WHERE id=?";
            $data1 = $connect->prepare($queryUpdate1);
            $data1->bindParam(1,$_POST['nama_menu']);
            $data1->bindParam(2,$_POST['deskripsi_menu']);
            $data1->bindParam(3,$_POST['harga_menu']);
            $data1->bindParam(4,$_POST['filter_menu']);
            $data1->bindParam(5,$url_foto);
            $data1->bindParam(6, $id);
            $berhasil = $data1->execute();
            if ($berhasil) {
                header("Location: menu.php");
            } else {
                echo "Gagal di edit";
            }
        } else {
            // proses tidak ada gambar
            $queryUpdate2 = "UPDATE tb_menu SET nama=?,deskripsi=?,price=?, filter=? WHERE id=?";
            $data2 = $connect->prepare($queryUpdate2);
            $data2->bindParam(1,$_POST['nama_menu']);
            $data2->bindParam(2,$_POST['deskripsi_menu']);
            $data2->bindParam(3,$_POST['harga_menu']);
            $data2->bindParam(4,$_POST['filter_menu']);
            $data2->bindParam(5, $id);
            $berhasil2 = $data2->execute();
            if ($berhasil2) {
                header("Location: menu.php");
            } else {
                echo "Gagal di edit";
            }
        }
	}	
?>