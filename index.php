<?php
// Include quiz data
include "inc/quiz.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Math Quiz: Addition</title>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div id="quiz-box">
            <?php if ($toast !== "") { ?>
                <p class="toast"><?= $toast ?></p>
            <?php } ?>
            <?php if ($showScore) { ?>
                <p class="quiz score">
                    Your final score is <?= $totalCorrect ?> out of <?= $totalQuestions ?>.
                    <table>
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Correct answer</th>
                                <th>Your answer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Display each question with its correct answer and what the user answered -->
                            <?php foreach ($usedIndices as $index) { ?>
                                <?php
                                // Store current question for easy use
                                $currentQuestion = $questions[$index];
                                ?>

                                <tr>
                                    <td>What is <?= $currentQuestion["leftAdder"] ?> + <?= $currentQuestion["rightAdder"] ?>?</td>
                                    <td><?= $currentQuestion["correctAnswer"] ?></td>
                                    <td class="<?= $userAnswers[$index] === $currentQuestion["correctAnswer"] ? "correct" : "incorrect" ?>">
                                        <?= $userAnswers[$index] ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </p>
                <a href="index.php" class="btn">Play Again</a>
            <?php } else { ?>
                    <p class="breadcrumbs">Question <?= count($_SESSION["used_indices"]) ?> of <?= $totalQuestions ?></p>
                    <p class="quiz">What is <?= $question["leftAdder"] ?> + <?= $question["rightAdder"] ?>?</p>
                    <form action="index.php" method="post">
                        <input type="hidden" name="id" value="<?= $index ?>" />
                        <?php foreach ($answers as $answer) { ?>
                            <input type="submit" class="btn" name="answer" value="<?= $answer ?>" />
                        <?php } ?>
                    </form>
            <?php } ?>
        </div>
    </div>
</body>
</html>