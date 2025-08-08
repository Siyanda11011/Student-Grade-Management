<?php
session_start();

// Initialize students array if not set
if (!isset($_SESSION["students"])) {
    $_SESSION["students"] = [];
}

// Sanitize inputs
$name = trim($_POST["studentName"] ?? '');
$surname = trim($_POST["studentSurname"] ?? '');
$studentNum = trim($_POST["studentNum"] ?? '');

// Validate name and surname
if (empty($name) || empty($surname)) {
    echo "<p>Please enter both name and surname.</p><a href='index.php'>Go back</a>";
    exit;
}

// Collect and validate grades
$grades = [];
for ($i = 1; $i <= 5; $i++) {
    $gradeKey = "grade$i";
    if (!isset($_POST[$gradeKey]) || !is_numeric($_POST[$gradeKey])) {
        echo "<p>Grade $i is missing or invalid.</p><a href='index.php'>Go back</a>";
        exit;
    }

    $grade = floatval($_POST[$gradeKey]);
    if ($grade < 0 || $grade > 100) {
        echo "<p>Grade $i must be between 0 and 100.</p><a href='index.php'>Go back</a>";
        exit;
    }
    $grades[] = $grade;
}

// Calculate average
$average = array_sum($grades) / count($grades);

// Determine letter grade
function getLetterGrade($average)
{
    if ($average >= 80) return "A";
    if ($average >= 70) return "B";
    if ($average >= 60) return "C";
    if ($average >= 50) return "D";
    return "F";
}

$letter = getLetterGrade($average);

// Store student data
$_SESSION["students"][] = [
    "studentName" => htmlspecialchars($name),
    "studentSurname" => htmlspecialchars($surname),
    "studentNumber" => htmlspecialchars($studentNum),
    "grades" => $grades,
    "average" => $average,
    "letter" => $letter,
];

// Redirect to results page after submission
header("Location: results.php");
exit;
?>
