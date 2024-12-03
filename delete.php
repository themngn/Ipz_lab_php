<?php
$servername = "localhost";
$username = "php";  // or your MySQL username
$password = "ipz";      // or your MySQL password
$dbname = "people_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM people WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Person deleted successfully.";
    } else {
        echo "Error deleting person: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();

// Redirect back to the main page
header("Location: index.php");
exit();
?>

