<?php
session_start();


$host = "localhost"; 
$username = "root";  
$password = "Bassel2003$";      
$dbname = "sports_club"; 


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$user = $_POST['users'];
$pass = $_POST['password'];


$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    

    if (password_verify($pass, $row['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php"); 
        exit(); 
    } else {
        echo "Invalid username or password";
    }
} else {
    echo "Invalid username or password";
}

$stmt->close();
$conn->close();
?>
