<?php
include('../connection.php');
session_start();

date_default_timezone_set("Asia/Jakarta"); //GMT +07

$employee_id = $_SESSION['employee_id'];
$work_date = date('Y-m-d');
$clock_in = date('H:i:s');


if (isset($_POST['absen'])) {
    $check_absensi = "SELECT work_date FROM attendances WHERE employee_id=$employee_id
    AND work_date='$work_date'";

    $check = $db->query($check_absensi);

    if ($check->num_rows > 0) {
        header("location:index.php?message=Sorry🙏, you have been absent today");
    } else {
        $sql = "INSERT INTO attendances (id, employee_id, work_date, clock_in, clock_out)
    VALUES (NULL, '$employee_id', '$work_date', '$clock_in', NULL)";

        $result = $db->query($sql);
        if ($result === TRUE) {
            header("location:index.php?message=Attendance Was Successful✅");
        } else {
            header("location:index.php?message=Failed Connection❗");
        }
    }
}
?>
