<?php 

require 'functions.php';
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])) {
    header("Location: proses.php?success-dashboard-hapus=true");
    exit;
}

if ( isset($_POST["submit"]) ) {
    // var_dump($_POST); var_dump($_FILES);die;
    if ( !isset($_POST["bidang_ajar"]) || !isset($_POST["media_lessons"]) ) {
        echo "<script>
                alert('gagal!, belum menginputkan pilihan');
            </script>";
            
    } else if ( upload_iklan($_POST) > 0 ) {
        echo "<script>
                alert('Berhasil');
            </script>";
        header("Location: proses.php?success-dashboard=true");
            
    } else if ( upload_iklan($_POST) == 0 ) {
        echo "<script>
                alert('Gambar belum dimasukkan');
            </script>";
    } else if ( upload_iklan($_POST) == -1 ) {
        echo "<script>
                alert('Yang dimasukkan tidak gambar');
            </script>";
    } else if ( upload_iklan($_POST) == -2 ) {
         echo "<script>
                alert('Ukuran gambar melebihi batas maximum (2mb)');
            </script>";
    } else if ( upload_iklan($_POST) == -3 ) {
        echo "<script>
                alert('Iklan sudah pernah terpasang.');
            </script>";
        header("Location: dashboard.php?readMore=1");
    }
}

$username = $_GET["nama"];
$result = query("SELECT * FROM db WHERE username = '$username' ");

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
    <div class="flex lg:flex-row flex-col grid grid-cols-1 md:grid-cols-2 md:justify-around mt-3 md:mt-10 space-y-5 space-y-3">
        <div class="bg-[#124E23] rounded-md w-[96%] md:w-[90%] mx-2 md:ml-16 p-5 md:p-10 text-white">
            <h1 class="font-bold text-white text-2xl md:text-3xl ">Tawarkan Jasa/Layanan Anda!!!</h1><br />
            <label for="" class="font-semibold">Biodata Anda</label><br />
            <textarea id="" cols="50" rows="6" class="md:w-full w-full rounded-md border-2 border-black text-black p-2 pt-1" name="biodata" style="resize: none;" required></textarea><br /><br />
            <label for="" class="font-semibold">Skills : </label><br />
            <textarea id="" cols="50" rows="3" class="md:w-full w-full rounded-md border-2 border-black text-black p-2 pt-1" name="skill" style="resize: none;" required></textarea><br /><br />
            <label for="" class="font-semibold " required>Text Iklan :</label><br />
            <textarea name="text_ads" id="" cols="50" rows="4" maxlength="120" class="md:w-full w-full rounded-md border-2 border-black text-black p-2 pt-1" style="resize: none;" required></textarea><br /><br />
            <label for="" class="font-semibold">Nomor Handphone</label><br />
            <input type="text" placeholder="+6282 3983 87432" class="md:w-full w-full rounded-md border-2 border-black text-black p-1 pl-2" name="phone_number" autocomplete="off" required /><br /><br />
            <button type="submit" class="bg-[#29A54B] px-20 py-3  font-bold tracking-[2px] rounded-full hover:bg-[#238A40] ease-in-out duration-500 mt-4 hidden md:block" name="submit">SUBMIT</button>
        </div>
        <div class="bg-[#124E23] w-[96%] md:w-[70%] mx-2 rounded-md md:ml-36 p-5 md:p-10 text-white">
            <input type="text" class="w-full rounded-sm hidden" name="username" value="<?php echo $username; ?>" /><br /><br />
            <label for="" class="font-semibold text-white">Bidang Ajar : </label><br />
            <div class="text-black font-semibold">
                <label for="bidang1">
                    <input type="checkbox" name="bidang_ajar[]" value="Bahasa Indonesia" id="bidang1" class="hidden" />
                    <div id="bidang_ajar" class="bg-[#33da33] rounded-md mr-2 py-1 px-2 mt-3" style="cursor: pointer;" onclick="if(this.innerHTML =='Bahasa Indonesia (Selected)'){this.innerHTML = 'Bahasa Indonesia'}else{this.innerHTML = 'Bahasa Indonesia (Selected)'}">
                        Bahasa Indonesia
                    </div>
                </label>
                <label for="bidang2">
                    <input type="checkbox" name="bidang_ajar[]" value="Bahasa Inggris" id="bidang2" class="hidden" />
                    <div id="bidang_ajar" class="bg-[#33da33] rounded-md mr-2 py-1 px-2 mt-3" style="cursor: pointer;" onclick="if(this.innerHTML =='Bahasa Inggris (Selected)'){this.innerHTML = 'Bahasa Inggris'}else{this.innerHTML = 'Bahasa Inggris (Selected)'}">
                        Bahasa Inggris
                    </div>
                </label>
                <label for="bidang3">
                    <input type="checkbox" name="bidang_ajar[]" value="Biologi" id="bidang3" class="hidden" />
                    <div id="bidang_ajar" class="bg-[#33da33] rounded-md mr-2 py-1 px-2 mt-3" style="cursor: pointer;" onclick="if(this.innerHTML =='Biologi (Selected)'){this.innerHTML = 'Biologi'}else{this.innerHTML = 'Biologi (Selected)'}">
                        Biologi
                    </div>
                </label>
                <label for="bidang4">
                    <input type="checkbox" name="bidang_ajar[]" value="Geografi" id="bidang4" class="hidden" />
                    <div id="bidang_ajar" class="bg-[#33da33] rounded-md mr-2 py-1 px-2 mt-3" style="cursor: pointer;" onclick="if(this.innerHTML =='Geografi (Selected)'){this.innerHTML = 'Geografi'}else{this.innerHTML = 'Geografi (Selected)'}">
                        Geografi
                    </div>
                </label>
                <label for="bidang5">
                    <input type="checkbox" name="bidang_ajar[]" value="Matematika" id="bidang5" class="hidden" />
                    <div id="bidang_ajar" class="bg-[#33da33] rounded-md mr-2 py-1 px-2 mt-3" style="cursor: pointer;" onclick="if(this.innerHTML =='Matematika (Selected)'){this.innerHTML = 'Matematika'}else{this.innerHTML = 'Matematika (Selected)'}">
                        Matematika
                    </div>
                </label>
                <label for="bidang6">
                    <input type="checkbox" name="bidang_ajar[]" value="Gitar" id="bidang6" class="hidden" />
                    <div id="bidang_ajar" class="bg-[#33da33] rounded-md mr-2 py-1 px-2 mt-3" style="cursor: pointer;" onclick="if(this.innerHTML =='Gitar (Selected)'){this.innerHTML = 'Gitar'}else{this.innerHTML = 'Gitar (Selected)'}">
                        Gitar
                    </div>
                </label>
                <label for="bidang7">
                    <input type="checkbox" name="bidang_ajar[]" value="Drum" id="bidang7" class="hidden" />
                    <div id="bidang_ajar" class="bg-[#33da33] rounded-md mr-2 py-1 px-2 mt-3" style="cursor: pointer;" onclick="if(this.innerHTML =='Drum (Selected)'){this.innerHTML = 'Drum'}else{this.innerHTML = 'Drum (Selected)'}">
                        Drum
                    </div>
                </label>
                <label for="bidang8">
                    <input type="checkbox" name="bidang_ajar[]" value="Keyboard" id="bidang8" class="hidden" />
                    <div id="bidang_ajar" class="bg-[#33da33] rounded-md mr-2 py-1 px-2 mt-3" style="cursor: pointer;" onclick="if(this.innerHTML =='Keyboard (Selected)'){this.innerHTML = 'Keyboard'}else{this.innerHTML = 'Keyboard (Selected)'}">
                        Keyboard
                    </div>
                </label>
                <!-- <ul>
                    <li class=""><input type="checkbox" name="bidang_ajar[]" id="" value="Bahasa Indonesia" /> Bahasa Indonesia</li>
                    <li class=""><input type="checkbox" name="bidang_ajar[]" id="" value="Matematika" /> Matematika</li>
                    <li class=""><input type="checkbox" name="bidang_ajar[]" id="" value="Biologi" /> Biologi</li>
                    <li class=""><input type="checkbox" name="bidang_ajar[]" id="" value="Geografi" /> Geografi</li>
                    <li class=""><input type="checkbox" name="bidang_ajar[]" id="" value="Bahasa Inggris" /> Bahasa Inggris</li>
                    <li class=""><input type="checkbox" name="bidang_ajar[]" id="" value="Gitar" /> Gitar</li>
                    <li class=""><input type="checkbox" name="bidang_ajar[]" id="" value="Drum" /> Drum</li>
                    <li class=""><input type="checkbox" name="bidang_ajar[]" id="" value="Keyboard" /> Keyboard</li>
                </ul> -->
            </div>
            <br />
            <label for="" class="font-semibold ">Sedia : </label><br />
            <ul>
                <li class=""><input type="checkbox" name="media_lessons[]" id="" value="Home Schooling" class="" /> Home Schooling</li>
                <li class=""><input type="checkbox" name="media_lessons[]" id="" value="Online" /> Onsite (Online)</li>
            </ul>
            <br />
            
            <label for="kota" class="font-semibold">Kota : </label><br />
            <input type="text" name="alamat" class="py-1 px-2 rounded-md text-black" placeholder="Kota, Provinsi"><br /><br />
            <label for="" class="font-semibold ">Biaya : </label><br />
            <p style="display: inline-block;" class="mr-2">Rp. </p><input type="text" class="pl-2 rounded-md text-black w-[50%] py-1" name="biaya" placeholder="75000" autocomplete="off" required /><br /><br /><br />
            <label for="" class="font-semibold">Upload foto profile (max: 2mb) :</label><br />
            <input type="file" name="image" class="block w-full text-sm text-white mt-2
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50 file:text-black
            hover:file:bg-violet-100
            "/>
            <button type="submit" class="bg-[#29A54B] px-20 py-3 mb-16 font-bold tracking-[2px] rounded-full hover:bg-[#238A40] ease-in-out duration-500 mt-10 block md:hidden" name="submit">SUBMIT</button>
        </div>
    </div>
</form>
    <!--------------------------------------------  FOOTER ---------------------------------------------------->
    <footer class="bg-[#124E23] mt-48 border-t">
        <p class="text-center text-white py-4">© copyright 2022 - website by 202151082 | 202151059</p>
    </footer>

</body>

</html>

