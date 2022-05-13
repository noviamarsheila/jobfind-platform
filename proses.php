<?php require 'functions.php'; ?>
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
    <style>
        .box {
            padding: 100px;
            background: green;
            color: white;
            /* code di bawah ini akan membuat div berada di tengah-tengah */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            }

        .box-gagal {
            padding: 100px;
            background: red;
            color: white;
            /* code di bawah ini akan membuat div berada di tengah-tengah */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            }
    </style>
</head>

<body>

<!-------------------------------- SUCCESS INDEX ----------------------------------->
    <?php if ( isset($_GET["success-index"]) ) : ?>
        <div class="box w-[90%] md:w-[50%]">
            <p class="font-bold text-3xl md:text-6xl text-center">SUCCESS</p>
            <p class="font-bold text-2xl md:text-2xl text-center">Nanti akan segera dihubungi!!</p>
        </div>
        <script>
            setInterval( () => {
                window.location.href = 'index.php';
            }, 1000);
        </script>
    <?php endif; ?>
<!----------------------------- END OF SUCCESS INDEX ----------------------------------->

<!-------------------------------- SUCCESS DASHBOARD ----------------------------------->
    <?php if ( isset($_GET["success-dashboard"]) ) : ?>
        <div class="box w-[90%] md:w-[50%]">
            <p class="font-bold text-2xl md:text-6xl text-center">SUCCESS</p>
        </div>
        <script>
            setInterval( () => {
                window.location.href = 'dashboard.php?readMore=2';
            }, 1000);
        </script>
    <?php endif; ?>
<!----------------------- END OF SUCCESS DASHBOARD SUCCESS INDEX ------------------------>

<!-------------------------------- SUCCESS HAPUS CLIENT --------------------------------->

    <?php if ( isset($_GET["success-dashboard-hapus"]) ) : ?>
        <?php $id = $_GET["id"];
            $query = "DELETE FROM order_transaction WHERE id = '$id' ";
            mysqli_query($conn, $query);
        ?>
        <?php if ( mysqli_affected_rows($conn) > 0 ) : ?>
            <div class="box w-[90%] md:w-[50%]">
                <p class="font-bold text-2xl md:text-6xl text-center">SUCCESS</p>
            </div>
            <script>
                setInterval( () => {
                    window.location.href = 'dashboard.php?readMore=2#client';
                }, 1000);
            </script>
        <?php else : ?>
            <div class="box-gagal w-[90%] md:w-[50%]">
                <p class="font-bold text-2xl md:text-6xl text-center">GAGAL</p>
            </div>
            <script>
                setInterval( () => {
                    window.location.href = 'dashboard.php?readMore=2#client';
                }, 1000);
            </script>
        <?php endif; ?>
    <?php endif; ?>
<!-------------------------------- END OF HAPUS CLIENT ----------------------------------->

<!----------------------------------------- LOGOUT ---------------------------------------->

    <?php if ( isset($_GET["logout"]) ) : ?>
        <?php 
            session_start();

            session_destroy();

            header("Location: index.php");
        ?>
    <?php endif; ?>
<!--------------------------------------- END OF LOGOUT ----------------------------------->
 
</body>

</html>