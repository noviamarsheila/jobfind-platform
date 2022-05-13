<?php 
require 'functions.php';
session_start();

if ( !isset($_GET["login"]) ) {
    header("Location: index.php");
}
if (isset($_POST["submit"])) {
    if ( login($_POST) > 0 ) {
        header("Location: dashboard.php?readMore=1");
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["password"] = $_POST["password"];
    } else {
        $error = true;
    }
} 
?> 

<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- konfigurasi tailwindcss using CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body>
    <section class="md:mx-20 md:my-20">
        <div class="flex md:flex-row flex-col justify-around items-center">
            <div class="basis-1/2 max-w-lg">
                <img src="img/img.png" class="" alt="img" />
            </div>
            <div class="basis-1/2 md:ml-32 w-10/12 md:mx-20 mx-8 
                md:mt-0 mt-0 bg-white pl-8 pt-5 pb-10 absolute md:relative">
                <form action="" method="post">
                    <h1 class="text-[#124E23] font-bold text-3xl">Login Here</h1>
                    <br />
                    <?php if (isset($error)) : ?>
                        <p style="color: red">username / password is wrong!</p>
                    <?php endif; ?>

                    <label for="username" class="leading-8">Username</label><br />
                    <input type="text" class="form-control border-2 border-green-700 pl-2 w-4/5 md:w-1/2" id="username" name="username"
                        /><br />
                    <label for="password" class="leading-8">Password</label><br />
                    <input type="password" class="form-control border-2 border-green-700 pl-2 w-4/5 md:w-1/2" id="password"
                        name="password" /><br />
                    <a href="registrasi.php?registrasi=true" class=" ">
                        <p>Don't have an account?</p>
                    </a><br />
                    <div class=" ">
                        <button class="bg-[#124E23] px-7 py-2 rounded text-white hover:bg-[#1b6430]" type="submit"
                            name="submit">Login</button>
                    </div>
                </form>
            </div>
            <p text-align="center ">.</p>
        </div>
    </section>
</body>

</html>