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

$questions = []; // Initialize $questions array

if (!empty($_POST['selectedSubject'])) {
    $sub_code = $_POST['selectedSubject'];
    $questionsQuery = mysqli_query($connect, "SELECT * FROM questions WHERE sub_code='$sub_code'");
    $questions = mysqli_fetch_all($questionsQuery, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exam</title>
  <!-- Include necessary Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body style="background-color:#93c2b3;" align="center">
<!-- Your form and HTML code here... -->
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exam</title>
  <!-- Include necessary Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body style="background-color:#93c2b3;" align="center">
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <form id="examForm" action="result.php" method="post">
          <?php foreach ($questions as $index => $question) : ?>
            <div class="question" <?= ($index > 0) ? 'style="display: none;"' : '' ?>>
              <h4><?= $question['question'] ?></h4>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="q<?= $index ?>" value="A" id="q<?= $index ?>A">
                <label class="form-check-label" for="q<?= $index ?>A"><?= $question['Option_A'] ?></label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="q<?= $index ?>" value="B" id="q<?= $index ?>B">
                <label class="form-check-label" for="q<?= $index ?>B"><?= $question['Option_B'] ?></label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="q<?= $index ?>" value="C" id="q<?= $index ?>C">
                <label class="form-check-label" for="q<?= $index ?>C"><?= $question['Option_C'] ?></label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="q<?= $index ?>" value="D" id="q<?= $index ?>D">
                <label class="form-check-label" for="q<?= $index ?>D"><?= $question['Option_D'] ?></label>
              </div>
            </div>
          <?php endforeach; ?>
          <div class="row justify-content-between mt-3">
    		<div class="col-auto">
        	<button type="button" id="prevBtn" class="btn btn-outline-secondary">Previous</button>
    		</div>
   		<div class="col-auto">
        <button type="button" id="nextBtn" class="btn btn-outline-primary">Next</button>
    		</div>
   		<div class="col-auto">
        <div class="d-flex justify-content-end">
            <button type="submit" id="submitBtn" class="btn btn-success" style="display: none;">Submit</button>
        </div>
    		</div>
		</div>
		<input type="hidden" name="selectedSubject" value="<?= $sub_code ?>">
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
const examForm = document.getElementById('examForm');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');
const questions = document.querySelectorAll('.question');
let currentQuestion = 0;

// Initialize the visibility of buttons
prevBtn.style.display = 'none';
if (questions.length > 1) {
    submitBtn.style.display = 'none';
}

// Event listeners for navigation
prevBtn.addEventListener('click', () => {
    questions[currentQuestion].style.display = 'none';
    currentQuestion--;

    if (currentQuestion === 0) {
        prevBtn.style.display = 'none';
    }
    nextBtn.style.display = 'block';
    submitBtn.style.display = 'none';
    questions[currentQuestion].style.display = 'block';
});

nextBtn.addEventListener('click', () => {
    questions[currentQuestion].style.display = 'none';
    currentQuestion++;

    if (currentQuestion === questions.length - 1) {
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'block';
    }
    prevBtn.style.display = 'block';
    questions[currentQuestion].style.display = 'block';
});

// Validate form submission
function validateForm() {
    // Implement validation logic here
    const selectedRadio = document.querySelector('input[name="q' + currentQuestion + '"]:checked');
    if (!selectedRadio) {
        alert("Please select an option before proceeding.");
        return false;
    }
    return true;
}

examForm.addEventListener('submit', (event) => {
    if (!validateForm()) {
        event.preventDefault();
    }
});
</script>
<script>
const examForm = document.getElementById('examForm');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');
const questions = document.querySelectorAll('.question');
let currentQuestion = 0;

// Initialize the visibility of buttons
prevBtn.style.display = 'none';
if (questions.length > 1) {
    submitBtn.style.display = 'none';
}

// Event listeners for navigation
prevBtn.addEventListener('click', () => {
    questions[currentQuestion].style.display = 'none';
    currentQuestion--;

    if (currentQuestion === 0) {
        prevBtn.style.display = 'none';
    }
    nextBtn.style.display = 'block';
    submitBtn.style.display = 'none';
    questions[currentQuestion].style.display = 'block';
});

nextBtn.addEventListener('click', () => {
    questions[currentQuestion].style.display = 'none';
    currentQuestion++;

    if (currentQuestion === questions.length - 1) {
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'block';
    }
    prevBtn.style.display = 'block';
    questions[currentQuestion].style.display = 'block';
});

// Validate form submission (you can implement this function)
function validateForm() {
    // Implement validation logic here
    return true;
}

examForm.addEventListener('submit', (event) => {
    if (!validateForm()) {
        event.preventDefault();
    }
});
</script>


</body>
</html>

