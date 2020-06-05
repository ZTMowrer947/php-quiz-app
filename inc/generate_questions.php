<?php

/**
 * Generates the given number of addition questions.
 *
 * @param integer $count The number of questions to generate, defaults to 10.
 * @return array The generated array of questions.
 */
function generate_questions(int $count = 10): array
{
    // If count is invalid, reset to 10
    if ($count < 1) {
        $count = 10;
    }

    // Initialize question array
    $questions = [];

    // Generate given number of questions
    foreach (range(1, $count) as $num) {
        // Generate random values for left and right addends
        $leftAddend = random_int(20, 120);
        $rightAddend = random_int(20, 120);

        // Add addends together to determine correct answer
        $correctAnswer = $leftAddend + $rightAddend;

        // Declare variables to hold incorrect answers
        $firstIncorrectAnswer = 0;
        $secondIncorrectAnswer = 0;

        // Generate first incorrect answer, ensuring it is not the same as the correct answer
        do {
            $firstIncorrectAnswer = $correctAnswer + random_int(-10, 10);
        } while ($firstIncorrectAnswer === $correctAnswer);

        // Generate another random incorrect value, ensuring it is different from the first one
        do {
            $secondIncorrectAnswer = $correctAnswer + random_int(-10, 10);
        } while ($secondIncorrectAnswer === $firstIncorrectAnswer);

        // Add question to question bank
        $questions[] = [
            "leftAdder" => $leftAddend,
            "rightAdder" => $rightAddend,
            "correctAnswer" => $correctAnswer,
            "firstIncorrectAnswer" => $firstIncorrectAnswer,
            "secondIncorrectAnswer" => $secondIncorrectAnswer,
        ];
    }

    // Return question data
    return $questions;
}