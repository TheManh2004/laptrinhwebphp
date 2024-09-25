<?php
    $conn = new mysqli("sql308.infinityfree.com","if0_37070080","NguyenTheManh","if0_37070080_b5_mydb");

    if($conn -> connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "CREATE TABLE MyGuestsss (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    if($conn->query($sql))
{
    echo"Table Myguest created successfully";
}
else{
    echo"Error creating table" .$conn->error ;
}

$conn->close();

?>