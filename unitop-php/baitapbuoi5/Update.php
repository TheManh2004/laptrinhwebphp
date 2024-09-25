<?php
// Tạo kết nối
$conn = new mysqli("sql308.infinityfree.com","if0_37070080","NguyenTheManh","if0_37070080_b5_mydb");

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
} else {
    echo "Kết nối thành công.<br>";
}

// Cập nhật firstname từ 'James' thành 'Jane'
$sql_update = "UPDATE MyGuestsss SET firstname = 'Jane' WHERE firstname = 'James'";

if (mysqli_query($conn, $sql_update)) {
    echo "Cập nhật thành công.<br>";
} else {
    echo "Lỗi cập nhật: " . mysqli_error($conn);
}

// Hiển thị lại danh sách
$sql_select = "SELECT id, firstname, lastname, reg_date FROM MyGuestsss";
$result = $conn->query($sql_select);

echo "<h2>Danh sách nhân viên</h2>";
echo "<table border='1'>
<tr>
<th>Id</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Reg_Date</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id"]. "</td>
        <td>" . $row["firstname"]. "</td>
        <td>" . $row["lastname"]. "</td>
        <td>" . $row["reg_date"]. "</td>
        </tr>";
    }
} else {
    echo "0 kết quả";
}

echo "</table>";

mysqli_close($conn);
?>