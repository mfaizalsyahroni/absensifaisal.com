<?php
session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("location:dashboard/index.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>ABSENSI</title>
</head>

<body>
    <div class="container">
        <section class="wrapper">
            <H3 class="tittle">LOGIN SYSTEM</H3>
            <?php
            if (isset($_GET['message'])) {
                $msg = $_GET['message'];
                echo "<div class='notif-login'>$msg</div>";
            } ?>
            <div>
                <form action="login.php" method="POST" class="form-login">
                    <label>Employee ID</label>
                    <input placeholder="eid" name="eid" type="number" class="input-login" required />
                    <label>Password</label>
                    <input placeholder="******" name="password" type="password" class="input-login" required />
                    <br>
                    <br>
                    <button type="submit" class="button-login" name="login">Login</button>
                </form>
            </div>
        </section>
    </div>
</body>

</html>