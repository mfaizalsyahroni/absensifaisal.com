<table border="1">
    <tr>
        <th>Date</th>
        <th>Clock in</th>
        <th>Clock Out</th>
        <th>Performance</th>
    </tr>

    <?php
    include("../connection.php");

    date_default_timezone_set("Asia/Jakarta");

    $work_date = date('Y-m-d');
    $time = date('H:i:s');
    $employee_id = $_SESSION['employee_id'];


    $start_date = date('Y-m-01'); 
    $end_date = date('Y-m-d'); 

    
    $sql = "SELECT * FROM attendances WHERE employee_id=$employee_id";
    $result = $db->query($sql);

    
    $attendances = [];
    while ($row = $result->fetch_assoc()) {
        $attendances[$row['work_date']] = $row;
    }

    // Loop untuk menampilkan tanggal dari awal bulan hingga hari ini
    $current_date = $start_date;
    while (strtotime($current_date) <= strtotime($end_date)) {
        echo "<tr>";
        echo "<td>" . $current_date . "</td>";

        // Periksa apakah ada data absensi untuk tanggal ini
        if (isset($attendances[$current_date])) {
            $row = $attendances[$current_date];
            echo "<td>" . $row['clock_in'] . "</td>";

            if (empty($row['clock_out']) && !empty($row['clock_in']) && $work_date == $row['work_date']) {
                echo "<td>
                <form action='' method='POST' onsubmit='return alert(`Thank you for working very well today`)'>
                <button type='submit' name='out'>OUT</button> 
                </form>
                </td>";
                echo "<td></td>";
            } else if (empty($row['clock_out']) && $work_date != $row['work_date']) {
                echo "<td></td>";
                echo "<td>❌</td>";
            } else {
                echo "<td>" . $row['clock_out'] . "</td>";
                echo "<td>✅</td>";
            }
        } else {
            // Jika tidak ada absensi untuk tanggal ini
            echo "<td></td>";
            echo "<td></td>";
            echo "<td>❌</td>";
        }
        echo "</tr>";

        // Tambah satu hari
        $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
    }
    ?>

</table>
</br>

<form action="action.php" method="POST">
    <button type="submit" name="absen">ABSEN</button>
</form>

<?php
if (isset($_POST['out'])) {
    $update = "UPDATE attendances SET clock_out='$time' WHERE employee_id=$employee_id AND work_date='$work_date'";

    $clock_out = $db->query($update);
    if ($clock_out === TRUE) {
        session_start();
        session_destroy();
        header("location:../index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ui.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>