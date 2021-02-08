<?php

// start the session to have the possibility
// to flash data

session_start();
require_once 'DBBlackbox.php';
require 'functions.php';

$flashed_messages = [];
$flashed_data = [];

if (isset($_SESSION['flashed_messages'])) {
    $flashed_messages = $_SESSION['flashed_messages'];
    unset($_SESSION['flashed_messages']);
}

if (isset($_SESSION['flashed_data'])) {
    $flashed_data = $_SESSION['flashed_data'];
    unset($_SESSION['flashed_data']);
}


// find the puppy's id in the URL's query string
$puppy_id = $_GET['puppy_id'] ?? null;


// determine whether this request is create or edit
// from the (non)presence of the puppy's id to be
// edited
$is_edit = !empty($puppy_id);



// prepare edited or empty data
if ($is_edit) {

    // find the correct puppy in the database
    $puppy = find($puppy_id);
} else {

    // prepare empty default data
    $puppy = [
        'name' => null,
        'breed' => null,
        'cuteness' => 9,
        'gender' => 'male'
    ];
}


// update the data from flashed data (if any data was flashed)
$puppy['name']      = $flashed_data['name']     ?? $puppy['name'];
$puppy['breed']     = $flashed_data['breed']    ?? $puppy['breed'];
$puppy['cuteness']  = $flashed_data['cuteness'] ?? $puppy['cuteness'];
$puppy['gender']    = $flashed_data['gender']   ?? $puppy['gender'];


// if preset, retrieve flashed information from the session
// and delete it from the session, thus completing the process
// of "flashing"



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_edit ? 'Edit puppy' : 'Create a new puppy' ?></title>

    <link rel="stylesheet" href="style.css">
</head>

<body>


    <?php foreach ($flashed_messages as $message) : ?>
        <div class="message"><?= $message ?></div>
    <?php endforeach; ?>








    <form action="handle-form.php<?= $is_edit ? '?puppy_id=' . $puppy_id : '' ?>" method="post">

        <label for="">
            Puppy name:<br>
            <input type="text" name="name" value="<?= htmlspecialchars($puppy['name']) ?>">
        </label>
        <br><br>

        <label for="">
            Breed:<br>
            <input type="text" name="breed" value="<?= $puppy['breed'] ?>">
        </label>
        <br><br>

        <label for="">
            Cuteness level:<br>
            <select name="cuteness" id="">
                <option value="8" <?= $puppy['cuteness'] == 8 ? 'selected' : '' ?>>8</option>
                <option value="9" <?= $puppy['cuteness'] == 9 ? 'selected' : '' ?>>9</option>
                <option value="10" <?= $puppy['cuteness'] == 10 ? 'selected' : '' ?>>10</option>
            </select>
        </label>
        <br><br>

        <label for="">
            Gender:<br>
            <input type="radio" name="gender" value="male" <?= $puppy['gender'] == 'male' ? 'checked' : '' ?>>
            <input type="radio" name="gender" value="female" <?= $puppy['gender'] == 'female' ? 'checked' : '' ?>>
        </label>
        <br><br>

        <button>Save</button>

    </form>







</body>

</html>