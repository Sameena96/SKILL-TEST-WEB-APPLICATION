<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$server = 'localhost';
$user = 'root';
$pwd = '';
$database = 'Question'; // Change this to your desired database name

$connect = mysqli_connect($server, $user, $pwd, $database);
$error = mysqli_connect_error();
if (!$connect) {
    die("Failed to connect: " . $error);
}

$create_table = "CREATE TABLE IF NOT EXISTS questions (
    sub_code VARCHAR(7),
    question VARCHAR(100),
    Option_A VARCHAR(100),
    Option_B VARCHAR(100),
    Option_C VARCHAR(100),
    Option_D VARCHAR(100),
    Correct VARCHAR(20)
);";
$table_result = mysqli_query($connect, $create_table);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sub_code = $_POST['sub_code'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    $insert_query = "INSERT INTO questions (sub_code, question, Option_A, Option_B, Option_C, Option_D, Correct) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $insert_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $sub_code, $question, $option_a, $option_b, $option_c, $option_d ,$correct_option);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
			echo '<script>alert("Added successfully!!.");</script>';
        // Redirect back to the questions page after adding the question
        echo '<script>window.location.href = "questions.php?sub_code=' . $sub_code . '";</script>';
http://localhost:81/mysite/PRO/questions.php?sub_code=202021
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}

mysqli_close($connect);
?>

