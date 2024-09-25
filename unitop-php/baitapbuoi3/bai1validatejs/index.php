<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    /* Style cho form */
    form {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    /* Style cho các tiêu đề và nhãn */
    h1 {
        text-align: center;
        color: #333;
    }

    label {
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    /* Style cho các ô input */
    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
    }

    /* Style cho nút submit */
    input[type="submit"] {
        margin-top: 50px;
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Style cho thông báo lỗi */
    #error-message {
        color: red;
        font-size: 14px;
        margin-bottom: 15px;
    }
</style>

<body>

    <form id="myForm" action="control.php" method="post" onsubmit="return validateForm()">

        <label>Tên sách</label>
        <input type="text" id="name" name="name">
        <br>
        <label>Tác giả</label>
        <input type="text" id="author" name="author">
        <br>
        <label>Nhà xuất bản</label>
        <input type="text" id="xuatban" name="xuatban">
        <br>
        <label>Năm xuất bản</label>
        <input type="number" id="nam" name="nam">
        <br>
        <input type="submit" id="submit" name="submit">
        <p id="error-message" style="color:red;"></p>

    </form>
    <p>
        <a href="javascript:history.back()">
            <button>Quay về trang chủ</button>
        </a>
    </p>


    <script src="validate.js"></script>


</body>

</html>