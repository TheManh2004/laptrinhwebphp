<?php 
// Khởi động session
session_start();

// Kiểm tra xem dữ liệu có tồn tại trong session không
if (isset($_SESSION['name'], $_SESSION['author'], $_SESSION['xuatban'], $_SESSION['nam'])) {
    $name = $_SESSION['name'];
    $author = $_SESSION['author'];
    $xuatban = $_SESSION['xuatban'];
    $nam = $_SESSION['nam'];

    // Hiển thị dữ liệu hoặc thực hiện các hành động khác (lưu vào database, gửi email,...)
    echo "<h1>Thông tin sách</h1>";
    echo "<p><strong>Tên Sách:</strong> $name</p>";
    echo "<p><strong>Tác Giả:</strong> $author</p>";
    echo "<p><strong>Nhà Xuất Bản:</strong> $xuatban</p>";
    echo "<p><strong>Năm Xuất Bản:</strong> $nam</p>";

} else {
    echo "No data found.";
}
    
?>
<p>
    <a href="index.php">
        <button>Quay về trang chủ</button>
    </a>
</p>
