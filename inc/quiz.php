<?php
// Start the session
session_start();

// Include question data
include "questions.php";

// Declare variable to hold the total number of questions to ask
$totalQuestions = count($questions);

// Declare variable to hold the toast message, initialized to an empty string
$toast = "";

// Declare variable to determine if the score will be shown or not, initialized set to false
$showScore = false;

// Declare variable to hold a random index, initialized to null
$index = null;

// Declare variable to hold the current question, initialized to null
$question = null;

// If the server request was of type POST,
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the user's answer and the index of the previous question
    $prevIndex = (int)filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $userAnswer = (int)filter_input(INPUT_POST, "answer", FILTER_SANITIZE_NUMBER_INT);

    // If the user's answer is correct,
    if ($userAnswer === $questions[$prevIndex]["correctAnswer"]) {
        // Set toast to congratulatory message
        $toast = "Correct!";

        // Increment session variable holding number of correct answers
        $_SESSION["total_correct"]++;
    } else {
        // If not,

        // Set toast to bummer message
        $toast = "Unfortunately, that answer was incorrect.";
    }
}

// If we haven't set a session variable for determining which indices of questions we have already asked,
if (!isset($_SESSION["used_indices"])) {
    // Initialize it to an empty array
    $_SESSION["used_indices"] = [];

    // Set show score variable to false
    $showScore = false;
}

// If we have displayed all the questions,
if (count($_SESSION["used_indices"]) === $totalQuestions) {
    // Reset used indices session variable to empty array
    $_SESSION["used_indices"] = [];

    // Indicate that we need to show the score page
    $showScore = true;
} else {
    // If not,

    // Indicate that we need to show a question
    $showScore = false;

    // If we are on the first question,
    if (count($_SESSION["used_indices"]) === 0) {
        // Initialize session variable for the total number of correct answers to 0
        $_SESSION["total_correct"] = 0;

        // Set toast variable to empty string
        $toast = "";
    }

    // Compute which indices have not been used yet
    $unusedIndices = array_filter(array_keys($questions), function (int $idx) {
        // Filter out indices present in used_indices session variable
        return array_search($idx, $_SESSION["used_indices"]) === false;
    });

    // Select random index from unused indices
    $index = array_rand($unusedIndices);
    
    // Add selected index to array of used indices
    $_SESSION["used_indices"][] = $index;

    // Get the question at the selected index
    $question = $questions[$index];

    // Define variable to hold answers to question
    $answers = [
        $question["correctAnswer"],
        $question["firstIncorrectAnswer"],
        $question["secondIncorrectAnswer"],
    ];

    // Shuffle answers
    shuffle($answers);
}