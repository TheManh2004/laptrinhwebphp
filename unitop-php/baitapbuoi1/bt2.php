<?php
$books = [];
for ($i = 1; $i <= 100; $i++) {
    $books[] = [
        'Tensach' => "Tensach$i",
        'Noidung' => "Noidung$i"
    ];
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; 
$offset = ($page - 1) * $limit; 

$currentBooks = array_slice($books, $offset, $limit);

$totalPages = ceil(count($books) / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pagination Example</title>
</head>
<body>

<table border="1">
    <tr>
        <th>STT</th>
        <th>Tên sách</th>
        <th>Nội dung sách</th>
    </tr>
    <?php foreach ($currentBooks as $index => $book): ?>
        <tr>
            <td><?php echo $offset + $index + 1; ?></td>
            <td><?php echo $book['Tensach']; ?></td>
            <td><?php echo $book['Noidung']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<div>
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>">Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?php echo $page + 1; ?>">Next</a>
    <?php endif; ?>
</div>


</body>
</html>