<?php 

$conn = mysqli_connect("sql103.epizy.com", "epiz_31509289", "cyDi2V2K3FaHr0X", "epiz_31509289_jobfind");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    foreach( $result as $row ) {
        $rows[] = $row;
    }
    return $rows;
}

function Cari($data) {
    global $conn;

    $keyword = $data["cari"];

    $result = query("SELECT * FROM db WHERE username LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR bidang_ajar LIKE '%$keyword%' ");
    if ( !$result ) {
        return 0;
    }
    return $result;
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($_POST["username"]));
    $password= mysqli_real_escape_string($conn, $_POST["password"]);
    $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);

    // cek apakah ada username yang sama
    $result = mysqli_query($conn, "SELECT username FROM account WHERE  username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        return 0;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        return -1;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // input data
    mysqli_query($conn, "INSERT INTO account VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

function login($data) {
    global $conn;

    $username = strtolower(stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // cek username
    if ( $username == "" ) {
        return 0;
    } else {
        $result = mysqli_query($conn, "SELECT * FROM account WHERE username = '$username'");
    }

    if ( mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["passwd"]) ) {
            return 1;
        }
    } return 0;
}

function upload_iklan($data) {
    global $conn;

    $username = addslashes($_POST["username"]);
    $phoneNumber = addslashes($data["phone_number"]);
    $biodata = addslashes($data["biodata"]);
    $skill = addslashes($data["skill"]);
    $bidang_ajar = $_POST["bidang_ajar"];
    $media_lessons = $_POST["media_lessons"];
    $textAds = addslashes($_POST["text_ads"]);
    $alamat = addslashes($_POST["alamat"]);
    $biaya = addslashes($_POST["biaya"]);

    // cek apakah sudah pernah pasang iklan atau belum
    $query_nama = query("SELECT username FROM db WHERE username = '$username' ");
    if ( isset($query_nama) ) {
        return -3;
    }

    $i = 1;
    foreach ( $bidang_ajar as $bidang ) {
        $totalElement = $i;
        $i++;
    }
    $bidangAjar = "";
    for ( $j = 0; $j < $totalElement; $j++ ) {
        $bidangAjar .= $bidang_ajar[$j].", ";
    }

    $i = 1;
    foreach ( $media_lessons as $media ) {
        $totalElement = $i;
        $i++;
    }
    $mediaLessons = "";
    for ( $j = 0; $j < $totalElement; $j++ ) {
        $mediaLessons .= $media_lessons[$j].", ";
    }

    $img = upload_image();


    if ( $img == 0 ) {
        return 0;
    } else if ( $img == -1 ) {
        return -1;
    } else if ( $img == -2 ) {
        return -2;
    }

    mysqli_query($conn, "INSERT INTO db VALUES ('', '$username', '$alamat', '$phoneNumber', '$biaya', '$bidangAjar', '$mediaLessons', '$biodata', '$skill', '$textAds', '$img')");
    return mysqli_affected_rows($conn);
    
}

function upload_image() {
    $namaFile = $_FILES["image"]["name"];
    $sizeFile = $_FILES["image"]["size"];
    $error = $_FILES["image"]["error"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // cek apakah sudah memasukkan gambar atau belum
    if ( $error === 4 ) {
        return 0;
    }

    // cek apakah yang diupload memang gambar
    $eksteniValid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if ( !in_array($ekstensiGambar, $eksteniValid) ) {
        return -1;
    }

    // batasi size file
    if ( $sizeFile > 2200000 ) {
        return -2;
    }

    // generate nama file
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;

    // pindah upload tmp_name
    move_uploaded_file($tmpName, "img/" . $namaFileBaru);
    return $namaFileBaru;
}

function Order($data) {
    global $conn;

    $nama_pemesan = addslashes(stripslashes($data["username"]));
    $nama_penyedia = $data["nama_penyedia"];
    $bidang_ajar = $data["bidang_ajar"];
    $tgl_order = $data["tgl_order"];
    $alamat = addslashes(stripslashes($data["alamat"]));
    $phone_number = addslashes(strtolower(stripslashes($data["phoneNumber"])));

    $i = 1;
    foreach ( $bidang_ajar as $bidang ) {
        $totalElement = $i;
        $i++;
    }

    $bidangAjar = "";
    for ( $j = 0; $j < $totalElement; $j++ ) {
        $bidangAjar .= $bidang_ajar[$j].", ";
    }

    $query = "INSERT INTO order_transaction VALUES (
        '', '$nama_pemesan', '$nama_penyedia', '$bidangAjar', '$alamat', '$tgl_order', '$phone_number'
    )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

    
}

?>