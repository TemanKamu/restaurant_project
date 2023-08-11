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
    $optionsMeja = '<option value="">Choose seat</option>';
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











// if(isset($_GET['tanggal'])) {
//     $tanggalInput = $_GET['tanggal'];
//     $tanggal = $tanggalInput;
    
//     $query = "SELECT * FROM tb_reservasi WHERE date = ?";
//     $stmt = $connect->prepare($query);
//     $stmt->bindParam(1, $tanggal);
//     $stmt->execute();

//     // Mengambil data meja yang sudah dipesan pada tanggal tertentu
//     $mejaTerisi = array();
//     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//         $mejaTerisi[] = $row['meja'];
//     }

//     // Mengambil semua data meja
//     $query2 = "SELECT * FROM tb_meja";
//     $stmt2 = $connect->prepare($query2);
//     $stmt2->execute();
//     $dataMeja = $stmt2->fetchAll(PDO::FETCH_OBJ);

//     // Membangun opsi untuk meja
//     $optionsMeja = '<option value="">Choose seats</option>';
//     foreach($dataMeja as $meja) {
//         if (in_array($meja->no, $mejaTerisi)) {
//             $optionsMeja .= '<option value="'.$meja->no.'" disabled>'.'NO.'.$meja->no.'|'.$meja->jumlah_orang.'PEOPLE'.'</option>';
            
//         } else {
//             $optionsMeja .= '<option value="'.$meja->no.'">'.'NO.'.$meja->no.'|'.$meja->jumlah_orang.'PEOPLE'.'</option>';
//         }
//     }

//     $response = [
//         'meja' => $optionsMeja
//     ];

//     header('Content-Type: application/json');
//     echo json_encode($response);
//     exit;
// }


// include '../Connection.php';

// if (isset($_GET['tanggal'])) {
//     $tanggalInput = $_GET['tanggal'];
//     $tanggal = $tanggalInput;

//     $query = "SELECT * FROM tb_reservasi WHERE date = ?";
//     $stmt = $connect->prepare($query);
//     $stmt->bindParam(1, $tanggal);
//     $stmt->execute();

//     // Mengambil data meja yang sudah dipesan pada tanggal tertentu
//     $mejaTerisi = array();
//     $waktuTerisi = array();

//     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//         $mejaTerisi[] = $row['meja'];
//         $waktuTerisi[] = $row['time']; // Menggunakan field time
//     }

//     // Mengambil semua data meja
//     $query2 = "SELECT * FROM tb_meja";
//     $stmt2 = $connect->prepare($query2);
//     $stmt2->execute();
//     $dataMeja = $stmt2->fetchAll(PDO::FETCH_OBJ);

//     // Membangun opsi untuk meja
//     $optionsMeja = '<option value="">Choose seat</option>';
//     foreach ($dataMeja as $meja) {
//         $mejaTerisiText = implode(',', $mejaTerisi);
//         if (strpos($mejaTerisiText, (string) $meja->no) !== false) {
//             $optionsMeja .= '<option value="' . $meja->no . '" disabled>' . 'NO.' . $meja->no . ' | ' . $meja->jumlah_orang . ' PEOPLE</option>';
//         } else {
//             $optionsMeja .= '<option value="' . $meja->no . '">' . 'NO.' . $meja->no . ' | ' . $meja->jumlah_orang . ' PEOPLE</option>';
//         }
//     }

//     // Mengambil semua data waktu
//     $query3 = "SELECT time FROM tb_reservasi WHERE date = ? GROUP BY time"; // Menggunakan field time
//     $stmt3 = $connect->prepare($query3);
//     $stmt3->bindParam(1, $tanggal);
//     $stmt3->execute();
//     $dataWaktu = $stmt3->fetchAll(PDO::FETCH_OBJ);

//     // Membangun opsi untuk waktu
//     $optionsWaktu = '<option value="">Choose time</option>';
//     foreach ($dataWaktu as $waktu) {
//         $jumlahOrangWaktu = 0;
//         foreach ($waktuTerisi as $index => $waktuTerisi) {
//             if ($waktuTerisi == $waktu->time) {
//                 $mejaTerisiWaktu = $mejaTerisi[$index];
//                 $queryMejaWaktu = "SELECT jumlah_orang FROM tb_meja WHERE no = ?";
//                 $stmtMejaWaktu = $connect->prepare($queryMejaWaktu);
//                 $stmtMejaWaktu->bindParam(1, $mejaTerisiWaktu);
//                 $stmtMejaWaktu->execute();
                
//                 // Periksa apakah ada hasil yang ditemukan
//                 if ($stmtMejaWaktu->rowCount() > 0) {
//                     $jumlahOrangWaktu += $stmtMejaWaktu->fetchColumn();
//                 }
//             }
//         }
//         $optionsWaktu .= '<option value="' . $waktu->time . '">' . $waktu->time . ' (' . $jumlahOrangWaktu . ' PEOPLE)</option>'; // Menggunakan field time
//     }

//     $response = array(
//         'meja' => $optionsMeja,
//         'waktu' => $optionsWaktu
//     );

//     echo json_encode($response);
// }
?>
