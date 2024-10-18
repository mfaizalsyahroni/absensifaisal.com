<?php
include("connection.php");
include("Users.php");

session_start();

$user = new Users();


if (isset($_POST['login'])) {


    if (strlen($_POST['eid']) <= 2 || strlen($_POST['password']) <= 2) {
        header("location:index.php?message=invalid data");
    } else {

        $user->set_login_data($_POST['eid'], $_POST['password']);

        $id = $user->get_employee_id();
        $password = $user->get_password();

        $sql = "SELECT * FROM users WHERE employee_id= '$id' AND password = '$password'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {

            //"data karyawan yang akan muncul di fitur dashboard"
            while ($row = $result->fetch_assoc()) {
                $_SESSION['status'] = "login";
                $_SESSION['employee_id'] = $row['employee_id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['role'] = $row['role'];
            }

            if ($_SESSION['role'] === 'Admin') {
                header("location:dashboard/index-admin.php");
            } else {
                header("location:index.php?message=incorrect Eid or Password");
            }
        }
    }
}
