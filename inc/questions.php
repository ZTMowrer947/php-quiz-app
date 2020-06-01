<?php

// Include question generation function
include "generate_questions.php";

// If question data is not currently set on session,
if (!isset($_SESSION["questions"])) {
    // Generate 10 questions and attach to session
    $_SESSION["questions"] = generate_questions(10);
}

// Retrieve questions from session data
$questions = $_SESSION["questions"];
