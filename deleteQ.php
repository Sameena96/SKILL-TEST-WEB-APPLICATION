<?php
$server = 'localhost';
$user = 'root';
$pwd = '';
$database = 'Question'; // Change this to your desired database name

$connect = mysqli_connect($server, $user, $pwd, $database);
$error = mysqli_connect_error();
if (!$connect) {
    die("Failed to connect: " . $error);
}

if (isset($_GET['sub_code'])) {
    $sub_code = $_GET['sub_code'];

    $delete_query = "DELETE FROM questions WHERE sub_code = ?";
    $stmt = mysqli_prepare($connect, $delete_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $sub_code);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Redirect back to the questions page after deleting the question
        header("Location: questions.php?sub_code=$sub_code");
        exit();
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>

