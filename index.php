<?php 
require 'functions.php';

$result = query("SELECT * FROM db");
$resultCount = count($result);

if ( $resultCount == 0 ) {
    $error = true;
}

if ( isset($_POST["cari"]) ) {

    $resultCari = Cari($_POST);
    if ( $resultCari == 0 ) {
        $error = true;
        $result = [];
    } else {
        $result = $resultCari;
    }
}


?>


<!DOCTYPE html>
<html class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- konfigurasi tailwindcss using CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- connect ionicicons  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- kit font awesome icon -->
    <script src="https://kit.fontawesome.com/c36f41c443.js" crossorigin="anonymous"></script>
    <title>JobFind</title>
</head>

<body>
    <!-------------------------------------------- NAVBAR ---------------------------------------------------->
    <nav class="text-white p-5 bg-[#124E23] shadow md:flex md:items-center md:justify-between sticky top-0">
        <div class="flex justify-between items-center">
            <span class="text-2xl cursor-pointer ml-7 font-bold"> JobFind </span>
            <span class="text-3xl cursor-pointer mx-2 md:hidden block">
					<ion-icon name="menu" onclick="Menu(this)"></ion-icon>
				</span>
        </div>
        <ul class="lg:mr-30 text-white md:flex md:items-center z-[-1] md:z-auto md:static absolute bg-[#124E23] w-full left-0 md:w-auto md:py-0 py-4 md:pl-0 pl-7 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-500">
            <li class="mx-7 my-6 md:my-0">
                <a href="index.php" class="text-md hover:opacity-70 duration-500">HOME</a>
            </li>
            <li class="mx-7 my-6 md:my-0">
                <a href="#contact" class="text-md hover:opacity-70 duration-500">CONTACT</a>
            </li>
            <li class="mx-7 my-6 md:my-0">
                <a href="#testimonials" class="text-md hover:opacity-70 duration-500">TESTIMONIALS</a>
            </li>
            <form action=""  method="post">
                <li class="mx-7 my-6 md:my-0">
                    <input class="px-2 py-1.5" type="text" name="cari" style="border-radius: 5px; color: black;" placeholder="Cari kota / ..." autocomplete="off">
                </li>
                <li class="mx-7 my-6 md:my-0">
                    <button class="hidden" name="submit"></button>
                </li>
            </form>
            <a href="login.php?login=true" target="_blank"><button class="bg-[#14AF40] text-white text-sm font-medium font-[Arial] duration-500 px-7 py-2 mx-6 hover:bg-[#138132] rounded">LOGIN</button></a>
            <h2 class=""></h2>
        </ul>
    </nav>
    <!-------------------------------------------- END NAVBAR ---------------------------------------------------->

    <!--------------------------------------------HOME SECTION ---------------------------------------------------->
    <section class="my-10 mx-10 md:my-28 md:mx-16 flex md:flex-row flex-col justify-between items-center">
        <div class="max-w-md md:max-w-xl">
            <h3 class="font-bold md:text-5xl text-4xl">Temukan layanan <span class="underline">freelance</span> yang sempurna untuk Anda!</h3>
            <!-- <span class="bg-[#124E23] w-60 md:w-96 h-1 block mt-5"></span> -->
            <br />
            <h1 class="font-bold md:text-2xl text-2xl">Ingin menjual jasa seperti guru? <span class="underline"> bisa login</span> untuk menjual jasa dan pasang iklan!</h1>
            <span class="bg-[#124E23] w-60 md:w-96 h-1 block mt-5"></span>
        </div>
        <div>
            <img src="img/pengantar.png" alt="imageone" class="md:max-w-[480px] h-auto md:mr-8 mt-8 md:mt-0" />
        </div>
    </section>

    <!------------------------------------------ END HOME SECTION -------------------------------------------------->

    <!-------------------------------------------- BODY SECTION ---------------------------------------------------->
    <div>
        <hr class="ml-8 md:ml-16" style="width: 60%; height: 5px; background-color: #124E23; position: relative; z-index: -99;">
        <?php if ( isset($_GET["id"]) ) : ?>
            <?php 
                $id = $_GET["id"]; 
                $data = query("SELECT * FROM db WHERE id = $id"); 
                $nama = $data[0]["username"];
                $client = query("SELECT * FROM order_transaction WHERE nama_penyedia = '$nama' ");
                $client = count($client);
            ?>
            <?php foreach ( $data as $row ) : ?>
            <div id="lengkap"></div><br /><br /><br /><br />
            <section class="md:my-0 my-2 mx-6 md:mx-20 bg-[#238A40] p-10 text-white rounded-2xl items-center">
                <div class="flex md:flex-row flex-col-reverse justify-between">
                    <div class="md:basis-1/2 mt-8">
                        <h2 class="font-bold text-2xl"><?= $row["username"]; ?></h2>
                        <h4 class="mb-3"><?= $row["alamat"]; ?></h4>
                        <p>
                            <?= $row["biodata"]; ?>
                        </p>
                        <h3 class="mt-3 font-bold text-lg">Skills :</h3>
                        <p><?= $row["skill"]; ?>.</p>
                        <br />
                        <p><?= $row["text_ads"]; ?>.</p>
                    </div>
                    <div class="md:basis-1/2 md:ml-40">
                        <div class="max-w-[150px] h-auto">
                            <img src="img/<?= $row["img"]; ?>" alt="" class="w-full" />
                        </div>
                        <h3 class="mt-3 font-bold text-lg">Harga yang ditawarkan :</h3>
                        <p><?= $row["biaya"]; ?> / jam</p>
                        <h3 class="mt-3 font-bold text-lg">Bidang Ajar :</h3>
                        <p><?= $row["bidang_ajar"]; ?></p>
                        <h3 class="mt-3 font-bold text-lg">Sedia :</h3>
                        <ul class="list-disc list-inside">
                            <li><?= $row["private-lessons"]; ?></li>
                        </ul>
                        <h3 class="mt-3 font-bold text-lg">Jumlah client :</h3>
                        <ul class="list-disc list-inside">
                            <li><?php echo $client; ?></li>
                        </ul>
                        <a href="order-transaction.php?id=<?php echo $id; ?>"><button class="mt-3 bg-[#124E23] hover:bg-[#14AF40] hover:text-black font-semibold hover:font-bold duration-500 px-7 py-2 rounded-md">Booking Now</button></a>
                    </div>
                </div>
            </section>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <!-- <h1 class="font-medium text-2xl text-center mt-14"></h1> -->        
       
        <h1 class="font-medium text-2xl text-center mt-14">Iklan Jasa</h1>
        <section class="my-10 mx-10 md:my-20 md:mx-16 flex md:flex-wrap flex-col grid md:grid-cols-2 gap-4 md:gap-4 justify-between items-center">
            <?php if ( isset($error) ) : ?>
                <p>Data Kosong...</p>
            <?php endif; ?>
            <?php foreach ( $result as $row ) : ?>
                <a href="?id=<?= $row["id"]; ?>#lengkap" class="hover:bg-[#f3f3f3]">
                <div class="flex md:flex-rows">
                    <div class=" ml-5 mt-5">
                        <img src="img/<?= $row["img"]; ?>" alt="imagetwo" class="md:max-w-[200px] md:max-h-[180px] ml-0 md:mr-8 mt-0 hidden md:block" />
                    </div>
                    <div class="md:max-w-m md:pb-7 md:pl-0 md:pr-8">
                        <h1 class="font-medium text-4xl my-2"><?= $row["username"]; ?></h1>
                        <p class="text-lg pb-5 md:pb-0">
                            <?= $row["alamat"] . "."; ?><br />
                            <?= $row["text_ads"]; ?>
                        </p>
                    </div>
                </div>
                </a>
            <?php endforeach; ?>
        </section>
    </div>
    <!--------------------------------------------END BODY SECTION ---------------------------------------------------->
    <!--------------------------------------------TESTIMONI SECTION ---------------------------------------------------->

    <section class="md:my-56 my-20">
        <div id="testimonials">
            <h1 class="font-medium text-2xl text-center my-20">Testimonials</h1>
        </div>
        <div class="flex lg:flex-row flex-col md:justify-around items-center space-y-5 lg:space-y-0">
            <div class="p-6 max-w-sm mx-3 bg-[#238A40] rounded-xl shadow-lg flex items-center space-x-4">
                <div class="shrink-0">
                    <img class="h-12 w-12" src="img/profile1.png" alt="ChitChat Logo" />
                </div>
                <div>
                    <div class="text-xl font-medium text-white">Kattie</div>
                    <p class="text-white">Review : Website yang sangat berguna untuk freelancer.</p>
                </div>
            </div>
            <div class="p-6 max-w-sm mx-3 bg-[#238A40] rounded-xl shadow-lg flex items-center space-x-4">
                <div class="shrink-0">
                    <img class="h-12 w-12" src="img/profile2.png" alt="ChitChat Logo" />
                </div>
                <div>
                    <div class="text-xl font-medium text-white">Alex</div>
                    <p class="text-white">Review : Saya sebagai client sangat beruntung dengan website ini.</p>
                </div>
            </div>
            <div class="p-6 max-w-sm mx-3 bg-[#238A40] rounded-xl shadow-lg flex items-center space-x-4">
                <div class="shrink-0">
                    <img class="h-12 w-12" src="img/profile3.png" alt="ChitChat Logo" />
                </div>
                <div>
                    <div class="text-xl font-medium text-white">Belle</div>
                    <p class="text-white">Review : Pelayanan sangat ramah dan bagus, website yang recomended untuk semua orang.</p>
                </div>
            </div>
            <div class="p-6 max-w-sm mx-3 bg-[#238A40] rounded-xl shadow-lg flex items-center space-x-4">
                <div class="shrink-0">
                    <img class="h-12 w-12" src="img/profile4.png" alt="ChitChat Logo" />
                </div>
                <div>
                    <div class="text-xl font-medium text-white">Alli</div>
                    <p class="text-white">Review : Website yang sangat menarik dan memiliki banyak manfaat.</p>
                </div>
            </div>
        </div>
    </section>

    <!--------------------------------------------END TESTIMONI SECTION ------------------------------------------------>

    <!--------------------------------------------CONTACT SECTION ---------------------------------------------------->
    <div id="contact">
        <h1 class="font-medium text-2xl text-center mt-14">Contact Us</h1>
    </div>
    <div class="md:ml-32 ml-0">
        <br /><br />
        <section class="flex md:flex-row flex-col justify-around items-center">
            <div class="mt-5 md:max-w-xl md:basis-1/2 w-full">
                <div class="flex flex-col items-center md:max-w-lg">
                    <h2 class="mb-5 text-2xl">Feel free to ask anything</h2>
                    <input type="text" name="" placeholder="Name" class="md:w-full w-9/12 my-4 text-white bg-[#124e23] p-3" />
                    <input type="email" name="" placeholder="Email" class="md:w-full w-9/12 my-4 text-white bg-[#124e23] p-3" />
                    <textarea name="" id="" placeholder="Message" class="md:w-full w-9/12"></textarea>
                    <a href="#" class="mt-5 hover:bg-[#1F6834] duration-500 py-3 px-8 rounded-md text-white bg-[#124e23] p-3">Send Message</a>
                </div>
            </div>
            <div class="md:basis-1/2 w-9/12 md:w-full mt-20 md:mt-0">
                <h2 class="text-2xl">Temukan kami sekarang!!!</h2>
                <br />
                <p><i class="fa fa-map-marker" aria-hidden="true"></i>120-240 Rio de Janeiro - State of Rio de Janeiro New York</p>
                <br /><br />
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30594994064!2d-74.25986652425023!3d40.69714941680757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sKota%20New%20York%2C%20New%20York%2C%20Amerika%20Serikat!5e0!3m2!1sid!2sid!4v1642218764939!5m2!1sid!2sid"
                    width="500" height="200" style="border: 0" allowfullscreen="" loading="lazy" class="w-full md:w-9/12"></iframe>
            </div>
        </section>
    </div>
    <!--------------------------------------------END CONTACT SECTION  ---------------------------------------------------->
    <!--------------------------------------------  FOOTER ---------------------------------------------------->
    <footer class="bg-[#124E23] mt-48">
        <p class="text-center text-white py-4">© copyright 2022 - website by 202151082 | 202151059</p>
    </footer>
    <!-------------------------------------------- END FOOTER ---------------------------------------------------->

    <!-- connect to js file -->
    <script src="js/script.js"></script>
</body>

</html>