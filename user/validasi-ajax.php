<?php
include '../Connection.php';

if(isset($_GET['tanggal']) && isset($_GET['jam'])) {
    $tanggalInput = $_GET['tanggal'];
    $jamInput = $_GET['jam'];

    $query = "SELECT meja, status FROM tb_reservasi WHERE date = ? AND time = ?";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(1, $tanggalInput);
    $stmt->bindParam(2, $jamInput);
    $stmt->execute();

    // Mengambil data meja yang sudah dipesan pada tanggal dan jam tertentu
    $mejaTerisi = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $mejaTerisi[$row['meja']] = $row['status'];
    }

    // Mengambil semua data meja
    $query2 = "SELECT * FROM tb_meja";
    $stmt2 = $connect->prepare($query2);
    $stmt2->execute();
    $dataMeja = $stmt2->fetchAll(PDO::FETCH_OBJ);

    // Membangun opsi untuk meja
    $optionsMeja = '<option value="">Choose seats</option>';
    foreach($dataMeja as $meja) {
        if (isset($mejaTerisi[$meja->no])) {
            $status = $mejaTerisi[$meja->no];
            if ($status == "Approved") {
                $optionsMeja .= '<option value="'.$meja->no.'" disabled>'.'NO.'.$meja->no.'|'.$meja->jumlah_orang.'PEOPLE'.'</option>';
            } else {
                $optionsMeja .= '<option value="'.$meja->no.'">'.'NO.'.$meja->no.'|'.$meja->jumlah_orang.'PEOPLE'.'</option>';
            }
        } else {
            $optionsMeja .= '<option value="'.$meja->no.'">'.'NO.'.$meja->no.'|'.$meja->jumlah_orang.'PEOPLE'.'</option>';
        }
    }

    $response = [
        'optionsMeja' => $optionsMeja
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>










