<?php
include("../connection.php");

echo "HR ADMIN<br>";

// Menampilkan data absensi user berdasarkan tanggal hari ini
$tanggalHariIni = date('Y-m-d');
$query = "SELECT users.fullname, users.employee_id, users.role, attendances.work_date, attendances.employee_id, attendances.clock_in, attendances.clock_out 
            FROM attendances 
            JOIN users ON attendances.employee_id = users.employee_id 
            WHERE attendances.work_date = '$tanggalHariIni'";

$result = $db->query($query);

if ($result->num_rows > 0) {
    echo "<h3>Today's Attendance Data:</h3>";
    echo "<table border='1'>
            <tr>
                <th>Nama</th>
                <th>Employee ID</th>
                <th>Date</th>
                <th>Clock_in</th>
                <th>Clock_out</th>
                <th>Role</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['fullname'] . "</td>
                <td>" . $row['employee_id'] . "</td>
                <td>" . $row['work_date'] . "</td>
                <td>" . $row['clock_in'] . "</td>
                <td>" . $row['clock_out'] . "</td>
                <td>" . $row['role'] . "</td>
                </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data absensi hari ini.";
}



$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>

</body>

</html>