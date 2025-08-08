<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Grade Manager</title>
    <link rel="stylesheet" href="styles.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
</head>
<body>
    <main class="container">
        <h1>Student Grade Manager</h1>

        <form action="grades.php" method="POST" class="grade-form">
            <div class="form-group">
                <label for="studentName"><i class="fas fa-user-graduate"></i> Name:</label>
                <input type="text" id="studentName" name="studentName" placeholder="Enter your name" required />
            </div>

            <div class="form-group">
                <label for="studentSurname"><i class="fas fa-user-graduate"></i> Surname:</label>
                <input type="text" id="studentSurname" name="studentSurname" placeholder="Enter your surname" required />
            </div>

            <div class="form-group">
                <label for="studentNum"><i class="fas fa-id-card"></i> Student Number:</label>
                <input type="text" id="studentNum" name="studentNum" placeholder="Enter your student number" required />
            </div>

            <h2>Grades</h2>

            <?php
            // Dynamically generate 5 grade inputs
            for ($i = 1; $i <= 5; $i++) {
                echo '
                <div class="form-group">
                    <label for="grade' . $i . '">Grade ' . $i . ':</label>
                    <input type="number" id="grade' . $i . '" name="grade' . $i . '" min="0" max="100" required />
                </div>';
            }
            ?>

            <div class="form-actions">
                <button type="submit" class="btn btn-submit">Submit Grades</button>
                <button type="reset" class="btn btn-reset">Reset</button>
                <a href="results.php" class="btn btn-results">View Results</a>
            </div>
        </form>
    </main>
</body>
</html>
