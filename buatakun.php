<?php
// Connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "data_akun";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirm_password"];

    // Validate that passwords match
    if ($password !== $confirmpassword) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match!']);
        exit;
    }

    // Check if email already exists
    $checkEmailQuery = "SELECT email FROM tb_akun WHERE email='$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already registered!']);
        exit;
    }

    // Query to insert data into the database
    $sql = "INSERT INTO tb_akun (username, email, password) VALUES ('$username', '$email', '$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
}

// Close connection
$conn->close();
?>
