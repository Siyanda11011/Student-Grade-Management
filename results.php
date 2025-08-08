<?php
session_start();

$students = $_SESSION["students"] ?? [];

if (empty($students)) {
    echo "<p>No student records found.</p><a href='index.php'>Enter Students</a>";
    exit;
}

// Sort students by average descending
usort($students, function ($a, $b) {
    return $b['average'] <=> $a['average'];
});

// Calculate class average & grade distribution
$class_total = 0;
$grade_count = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'F' => 0];

foreach ($students as $student) {
    $class_total += $student['average'];
    $grade_count[$student['letter']]++;
}

$class_average = $class_total / count($students);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Grades Results</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <main class="container">
        <h1>Student Grades</h1>
        <table class="grades-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Student Number</th>
                    <th>Grades</th>
                    <th>Average</th>
                    <th>Letter Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['studentName']) ?></td>
                        <td><?= htmlspecialchars($student['studentSurname']) ?></td>
                        <td><?= htmlspecialchars($student['studentNumber']) ?></td>
                        <td><?= implode(", ", array_map('htmlspecialchars', $student['grades'])) ?></td>
                        <td><?= number_format($student['average'], 2) ?></td>
                        <td><?= htmlspecialchars($student['letter']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <section class="summary">
            <h2>Top Student</h2>
            <?php
            $top_student = $students[0];
            ?>
            <p><strong>Name:</strong> <?= $top_student['studentName'] ?></p>
            <p><strong>Surname:</strong> <?= $top_student['studentSurname'] ?></p>
            <p><strong>Student Number:</strong> <?= $top_student['studentNumber'] ?></p>

            <h2>Class Average</h2>
            <p><?= number_format($class_average, 2) ?></p>

            <h2>Grade Distribution</h2>
            <ul>
                <?php foreach ($grade_count as $grade => $count): ?>
                    <li><strong><?= $grade ?>:</strong> <?= $count ?></li>
                <?php endforeach; ?>
            </ul>

            <a href="index.php" class="btn btn-submit">Back to Form</a>
        </section>
    </main>
</body>
</html>
