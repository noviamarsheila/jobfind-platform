<?php 

require 'functions.php';
session_start();


if ( isset($_POST["submit"]) ) {
    // echo $_POST["phoneNumber"]; die;
    // var_dump($_POST); var_dump($_FILES);die;
    if ( !isset($_POST["bidang_ajar"]) ) {
        echo "<script>
                alert('gagal!, belum menginputkan pilihan');
            </script>";
            
    } else if ( Order($_POST) > 0 ) {
        header("Location: proses.php?success-index=true");

    } 
}

$id = $_GET['id'];
$result = query("SELECT * FROM db WHERE id = '$id' ");
$nama = $result[0]["username"];

$tgl = date('d-m-Y');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- konfigurasi tailwindcss using CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pasang Iklan JobFind</title>
</head>

<body class="">
<form action="" method="post" enctype="multipart/form-data">
    <div class="flex lg:flex-row flex-col grid md:grid-cols-2 md:justify-around mt-5 md:mt-10 space-y-5 lg:space-y-0">
        <div class="bg-[#124E23] rounded-md w-[96%] md:w-[90%] mx-2 md:ml-16 p-5 md:p-10 text-white">
            <input type="text" class="hidden" name="nama_penyedia" value="<?= $nama;  ?>">
            <input type="text" class="hidden" name="tgl_order" value="<?= $tgl; ?>">
            <h1 class="font-bold text-white text-2xl md:text-3xl ">Order Transaction!!!</h1><br />
            <label for="" class="font-semibold">Username</label><br />
            <input type="text" class="md:w-full rounded-md border-2 border-black text-black p-1 pl-2" placeholder="David Beckham" name="username" autocomplete="off" required /><br /><br />
            <label for="" class="font-semibold">Bidang (Select) </label><br />
            <div class="flex-wrap text-black font-semibold">
                <?php 
                    $bidangAjar = query("SELECT * FROM db WHERE id = '$id' "); 
                    $bidangAjar = $bidangAjar[0]["bidang_ajar"];
                    $bidangAjar = explode(',', $bidangAjar);
                    $len = count($bidangAjar);
                    $i = 1; 
                ?>
                <?php foreach ( $bidangAjar as $bidang ) : ?>
                <label for="bidang<?= $i; ?>">
                    <input type="checkbox" name="bidang_ajar[]" value="<?php echo $bidang; ?>" id="bidang<?= $i; ?>" class="hidden" />
                    <?php if ( $i < $len ) : ?>
                        <div id="bidang_ajar" class="bg-[#33da33] rounded-md mr-2 py-1 px-2 mt-3" style="cursor: pointer;" onclick="if(this.innerHTML =='<?php echo $bidang; ?> (Selected)'){this.innerHTML = '<?php echo $bidang; ?>'}else{this.innerHTML = '<?php echo $bidang; ?> (Selected)'}">
                            <?php echo $bidang; ?> 
                        </div>
                    <?php $i = $i + 1; endif; ?>
                </label>
                <?php endforeach; ?>
            </div><br />
            <label for="" class="font-semibold " required>Alamat</label><br />
            <input type="text" class="md:w-full rounded-md border-2 border-black text-black p-1 pl-2" name="alamat" placeholder="Kota, Provinsi" autocomplete="off" required /><br /><br />
            <label for="" class="font-semibold">Nomor Handphone</label><br />
            <input type="text" placeholder="+6282 3983 87432" class="md:w-full rounded-md border-2 border-black text-black p-1 pl-2" name="phoneNumber" autocomplete="off" required /><br /><br />
            <button type="submit" class="bg-[#29A54B] px-20 py-3  font-bold tracking-[2px] rounded-full hover:bg-[#238A40] ease-in-out duration-500 mt-4" name="submit">SUBMIT</button>
        </div>
    </div>
</form>
    <!--------------------------------------------  FOOTER ---------------------------------------------------->
    <footer class="bg-[#124E23] mt-48 border-t">
        <p class="text-center text-white py-4">© copyright 2022 - website by 202151082 | 202151059</p>
    </footer>

</body>

</html>

