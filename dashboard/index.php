<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:../index.php?message=masukan");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("location:../index.php?message=logout of the system");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ui.css">
    <title>Employee Dashboard</title>
</head>

<body id='bg'>
    <div>
        <section>
            <h3>
                hello <?php echo $_SESSION['fullname']  ?>
            </h3>
            <p>

                employee status: <?php echo  $_SESSION['role'] ?>
            </p>
            <br/>
            <?php 
                if(isset($_GET['message'])) {
                    echo $_GET['message'];
                }
            ?>
            <!-- ABSENCE TABLE -->
            <?php include("absensi.php"); ?>
            <br/>
            <form action="" method="POST">
                <button name="logout" type="submit">Logout</button>
            </form>
        </section>
    </div>
</body>

</html>