<?php

require 'control.php';

$numbers = [];
$results = null;
$searchResult = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $numbers = array_map('intval', explode(',', $_POST['numbers']));

    $results = [
        'sum' => sumArray($numbers),
        'max' => maxArray($numbers),
        'min' => minArray($numbers),
        'sortedAscending' => sortArrayAscending($numbers),
        'sortedDescending' => sortArrayDescending($numbers),
    ];

    $searchNumber = intval($_POST['searchNumber']);
    $searchResult = in_array($searchNumber, $numbers) ? "Số $searchNumber có trong mảng." : "Số $searchNumber không có trong mảng.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hàm xử lí mảng</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <h1>Hàm xử lí mảng</h1>

    <form method="post" action="">
        <label for="numbers">Nhập mảng</label>
        <input type="text" id="numbers" name="numbers" placeholder="e.g., 3,5,2,8,1" required>
        <br><br>
        <label for="searchNumber">Nhập số cần tìm</label>
        <input type="text" id="searchNumber" name="searchNumber" placeholder="" required>
        <br><br>
        <input type="submit" value="Process Array">
    </form>

    <?php if ($results !== null): ?>
        <table>
            <tr>
                <td>Mảng gốc:</td>
                <td><?php echo implode(', ', $numbers); ?></td>
            </tr>
            <tr>
                <td>Tổng mảng:</td>
                <td><?php echo $results['sum']; ?></td>
            </tr>
            <tr>
                <td>Giá trị lớn nhất mảng</td>
                <td><?php echo $results['max']; ?></td>
            </tr>
            <tr>
                <td>Giá trị nhỏ nhất mảng</td>
                <td><?php echo $results['min']; ?></td>
            </tr>
            <tr>
                <td>Sắp xếp tăng dần</td>
                <td><?php echo implode(', ', $results['sortedAscending']); ?></td>
            </tr>
            <tr>
                <td>Sắp xếp nhỏ dần</td>
                <td><?php echo implode(', ', $results['sortedDescending']); ?></td>
            </tr>
            <tr>
                <td>Giá trị tìm</td>
                <td><?php echo $searchResult; ?></td>
            </tr>
        </table>
    <?php endif; ?>
    <p>
        <a href="javascript:history.back()">
            <button>Quay về trang chủ</button>
        </a>
    </p>
</body>

</html>