<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstName"];
    $lastName = $_POST["lastName"] ;
    $mail = $_POST["mail"] ;
    $invoiceId = $_POST["invoiceId"] ;
    $payfor = $_POST["pay_for"];

    
    echo "<h3>Thông tin đã nhập:</h3>";
    echo "<p>First Name: " . htmlspecialchars($firstname) . "</p>";
    echo "<p>Last Name: " . htmlspecialchars($lastName) . "</p>";
    echo "<p>Email: " . htmlspecialchars($mail) . "</p>";
    echo "<p>Invoice ID: " . htmlspecialchars($invoiceId) . "</p>";
    echo "<p>Pay For: " . implode(', ', array_map('htmlspecialchars', $payfor)) . "</p>";
}
