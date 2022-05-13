<?php 
require 'functions.php';

if ( !isset($_GET["registrasi"]) ) {
    header("Location: index.php");
}
if (isset($_POST["submit"])) {
    if (registrasi($_POST) > 0) { 
        header("Location: login.php?login=true"); 
    } else if (registrasi($_POST) == 0) { 
        $error1 = true; 
    } else if (registrasi($_POST) == -1) { 
        $error2 = true; 
    } 
} 
?> 

<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- konfigurasi tailwindcss using CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Registrasi</title>
</head>

<body>
    <section class="d:mx-20 md:my-20">
        <div class="flex md:flex-row flex-col justify-around items-center">
            <div class="basis-1/2 max-w-lg">
                <img src="img/img.png" alt="..." />
            </div>
            <div class="basis-1/2 md:ml-2 md:max-w-md w-10/12 md:mx-20 md:mt-0
                        pl-8 pt-5 pb-10 bg-white absolute md:relative">
                <form action="" method="post">
                    <h1 class="text-[#124E23] font-bold text-3xl">Registrasi</h1>
                    <br />
                    <?php if (isset($error1)) : ?>
                        <p style="color: red">username sudah terdaftar!</p>
                    <?php elseif (isset($error2)) : ?>
                        <p style="color: red">konfirmasi password salah!</p>
                    <?php endif; ?> 

                    <label for="username" class="leading-8">Username</label><br />
                    <input type="text" class="form-control border-2 border-green-700 pl-2 w-4/5 md:w-3/5" id="username" name="username" /><br />
                    <label for="password" class="leading-8">Password</label><br />
                    <input type="password" class="form-control border-2 border-green-700 pl-2 w-4/5 md:w-3/5" id="password" name="password" /><br />
                    <label for="password2" class="leading-8">Konfirmasi Password</label><br />
                    <input type="password" class="form-control border-2 border-green-700 pl-2 w-4/5 md:w-3/5" id="password2" name="password2" /><br /><br />
                    <div class="">
                        <button class="bg-[#124E23] px-7 py-2 rounded text-white" type="submit" name="submit">Regristrasi</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>