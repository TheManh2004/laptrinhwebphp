<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
    // Khởi tạo các biến để lưu giá trị nhập vào và lỗi
    $name = $author = $xuatban = $nam = "";
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy giá trị từ form
        $name = trim($_POST['name']);
        $author = trim($_POST['author']);
        $xuatban = trim($_POST['xuatban']);
        $nam = trim($_POST['nam']);

        // Kiểm tra dữ liệu nhập vào
        if (empty($name)) {
            $errors[] = "Tên sách không được để trống.";
        }

        if (empty($author)) {
            $errors[] = "Tên tác giả không được để trống.";
        }

        if (empty($xuatban)) {
            $errors[] = "Nhà xuất bản không được để trống.";
        }

        if (empty($nam)) {
            $errors[] = "Năm xuất bản không được để trống.";
        } elseif (!is_numeric($nam)) {
            $errors[] = "Năm xuất bản phải là số.";
        }

        // Nếu không có lỗi, chuyển hướng sang file control.php
        if (empty($errors)) {
            // Sử dụng session để truyền dữ liệu giữa các trang nếu cần
            session_start();
            $_SESSION['name'] = $name;
            $_SESSION['author'] = $author;
            $_SESSION['xuatban'] = $xuatban;
            $_SESSION['nam'] = $nam;

            // Chuyển hướng sang control.php
            header("Location: control.php");
            exit();
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Tên Sách:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"><br>
        <label for="author">Tác Giả:</label><br>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($author); ?>"><br>
        <label for="xuatban">Nhà Xuất Bản:</label><br>
        <input type="text" id="xuatban" name="xuatban" value="<?php echo htmlspecialchars($xuatban); ?>"><br>
        <label for="nam">Năm Xuất Bản:</label><br>
        <input type="text" id="nam" name="nam" value="<?php echo htmlspecialchars($nam); ?>"><br><br>
        <input type="submit" value="Submit">

        <!-- Hiển thị lỗi dưới nút Submit -->
        <div id="error-message">
            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p style='color:red;'>$error</p>";
                }
            }
            ?>
        </div>
    </form>
    <p>
        <a href="javascript:history.back()">
            <button>Quay về trang chủ</button>
        </a>
    </p>
</body>
</html>