<?php
$server = 'localhost';
$user = 'root';
$pwd = '';
$database = 'ADDSUB'; // Change this to your desired database name

$connect = mysqli_connect($server, $user, $pwd, $database);
$error = mysqli_connect_error();
if (!$connect) {
    die("Failed to connect: " . $error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['sub_code'])) {
    $sub_code = $_GET['sub_code'];

    // Prepare and execute the DELETE query
    $delete_query = "DELETE FROM ADDSUB WHERE sub_code = ?";
    $stmt = mysqli_prepare($connect, $delete_query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $sub_code);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Redirect back to the subjects page after deleting
        header("Location: subjects.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

// Close the database connection
mysqli_close($connect);
?>

