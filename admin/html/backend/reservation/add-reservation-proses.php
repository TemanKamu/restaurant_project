<?php
	require "../Connection.php";
		if(isset($_POST['tambah'])){
			$id = $_POST['user'];
			$date = $_POST['date'];
			$time = $_POST['time'];
			$status = "Pending";
			$meja = $_POST['meja'];
			$event = $_POST['event'];
			$request = $_POST['special-request'];

			$query = "INSERT INTO tb_reservasi(id_pengguna,date,time,meja,event,status,request) VALUES(?, ?, ?, ?, ?, ?, ?)";
			$data = $connect->prepare($query);

			$data->bindParam(1,$id);
			$data->bindParam(2,$date);
			$data->bindParam(3,$time);
            $data->bindParam(4,$meja);
            $data->bindParam(5,$event);
            $data->bindParam(6,$status);
			$data->bindParam(7,$request);
			
			$succes = $data->execute();

			$status1 = "telah diisi";
			$query1 = "UPDATE tb_meja SET status=?";
			$data1 = $connect->prepare($query1);
			$data1->bindParam(1, $status1);
			$succes1 = $data1->execute();

			if($succes){
				header("location: reservation.php");
			}else{
				alert("Reservasi gagal");
				header ("reservation.php");
			}
		}
?>