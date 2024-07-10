<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_akun";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the SQL query to select columns that exist in tb_akun table
$sql = "SELECT email, username, password FROM tb_akun";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["email"] . "</td>
                <td>" . $row["username"] . "</td>
                <td>" . $row["password"] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No results found</td></tr>";
}

$conn->close();
?>
