<?php
include '../koneksi.php';

if (isset($_GET['no_peminjaman'])) {
    $no_peminjaman = $_GET['no_peminjaman'];

    // query untuk mendapatkan data peminjam
    $query = mysqli_query($koneksi, "SELECT anggota.nama_anggota, peminjaman.* FROM  peminjaman 
    LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota
     WHERE no_peminjaman='$no_peminjaman'");

    $data  = mysqli_fetch_assoc($query);
    $id_peminjaman = $data['id'];



    // query untuk mendapatkan data detail peminjam
    $queryDetail = mysqli_query($koneksi, "SELECT * FROM detail_peminjaman    LEFT JOIN buku ON buku.id = detail_peminjaman.id_buku
    WHERE id_peminjaman='$id_peminjaman'");

    $dataDetail = [];
    while ($rowDetail = mysqli_fetch_assoc($queryDetail)) {
        $dataDetail[] = $rowDetail;
    }


    $response = [
        'data' => $data,
        'message' => 'Fetch success',
        'detail_peminjaman' => $dataDetail

    ];
    echo json_encode($response);
    // json_decode
}
