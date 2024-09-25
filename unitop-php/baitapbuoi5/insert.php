<?php
    $conn = new mysqli("sql308.infinityfree.com","if0_37070080","NguyenTheManh","if0_37070080_b5_mydb");

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO MyGuestsss (firstname, lastname, email) 
                VALUES  ('John', 'Doe', 'johndoe@example.com'),
                        ('Jane', 'Smith', 'jane@example.com'),
                        ('James', 'Johnson', 'james@example.com'),
                        ('Emily', 'Brown', 'emily@example.com'),
                        ('Michael', 'Davis', 'michael@example.com')";
    

    if($conn->query($sql)===true){
        echo"New record created successfully";
    }
    else{
        echo "Error: ". $sql . "<br>" .$conn->error ;
    }

?>