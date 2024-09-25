<?php 
class TableRows extends RecursiveIteratorIterator{
    function __construct($it){
        parent::__construct($it, self::LEAVES_ONLY);
    }
}


// Biến kết nối toàn cục
global $conn;
 
// Hàm kết nối database
function connect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Nếu chưa kết nối thì thực hiện kết nối
    try{

    
        $conn = new PDO("mysql:host=sql308.infinityfree.com;dbname=if0_37070080_quanlisinhvien","if0_37070080","NguyenTheManh") or die ("Can't not connect to database");
        // Thiết lập font chữ kết nối
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}
 
// Hàm ngắt kết nối
function disconnect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Nếu đã kêt nối thì thực hiện ngắt kết nối
    $conn = null;
}
 
// Hàm lấy tất cả sinh viên
function get_all_students()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy vấn lấy tất cả sinh viên
    $sql = $conn->prepare("SELECT id, hoten, gioitinh, ngaysinh FROM qlsinhvien");
    $sql->execute();

    // Lấy dữ liệu và trả về mảng kết quả
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Ngắt kết nối
    disconnect_db();

    // Trả về mảng kết quả hoặc mảng trống nếu không có dữ liệu
    return $result ? $result : [];
}
 
// Hàm lấy sinh viên theo ID
function get_student($student_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();

    // Câu truy vấn lấy sinh viên theo ID
    $sql = $conn->prepare("SELECT * FROM qlsinhvien WHERE id = :id");
    
    // Gán giá trị cho tham số :id
    $sql->bindParam(':id', $student_id, PDO::PARAM_INT);
    
    // Thực thi câu truy vấn
    $sql->execute();

    // Lấy kết quả
    $result = $sql->fetch(PDO::FETCH_ASSOC); // Trả về một mảng kết hợp nếu có dữ liệu
    
    // Ngắt kết nối
    disconnect_db();
    
    // Trả kết quả về, nếu không có kết quả thì trả về mảng rỗng
    return $result ? $result : [];
}
 
// Hàm thêm sinh viên
function add_student($student_name, $student_sex, $student_birthday)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
    $student_name = addslashes($student_name);
    $student_sex = addslashes($student_sex);
    $student_birthday = addslashes($student_birthday);
     
    // Câu truy vấn thêm
    $sql = $conn->prepare("
            INSERT INTO qlsinhvien(hoten, gioitinh, ngaysinh) VALUES
            ('$student_name','$student_sex','$student_birthday')
    ");
     
    $sql->execute();

    // Lấy kết quả
    $result = $sql->fetch(PDO::FETCH_ASSOC); // Trả về một mảng kết hợp nếu có dữ liệu
    
    // Ngắt kết nối
    disconnect_db();
    return $result;
}
 
 
// Hàm sửa sinh viên
function edit_student($student_id, $student_name, $student_sex, $student_birthday)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
    $student_name       = addslashes($student_name);
    $student_sex        = addslashes($student_sex);
    $student_birthday   = addslashes($student_birthday);
     
    // Câu truy sửa
    $sql = $conn->prepare("
            UPDATE qlsinhvien SET
            hoten = '$student_name',
            gioitinh= '$student_sex',
            ngaysinh = '$student_birthday'
            WHERE id = $student_id
    ");
     
    $sql->execute();

    // Lấy kết quả
    $result = $sql->fetch(PDO::FETCH_ASSOC); // Trả về một mảng kết hợp nếu có dữ liệu
    
    // Ngắt kết nối
    disconnect_db();
    return $result;
}
 
 
// Hàm xóa sinh viên
function delete_student($student_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy sửa
    $sql = $conn->prepare("
            DELETE FROM qlsinhvien
            WHERE id = $student_id
    ");
     
    $sql->execute();

    // Lấy kết quả
    $result = $sql->fetch(PDO::FETCH_ASSOC); // Trả về một mảng kết hợp nếu có dữ liệu
    
    // Ngắt kết nối
    disconnect_db();
    return $result;
}
