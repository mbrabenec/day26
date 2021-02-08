
<?php 

// start the session to have the possibility
// to flash data

session_start();
require_once 'DBBlackbox.php';




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





// validation (a simple solution)
$valid = true;
$errors = [];
 
if (empty($_POST['name'])) {
    $valid = false;
    $errors[] = 'The name field is mandatory.';
}
 
if ($_POST['cuteness'] > 9) {
    $valid = false;
    $errors[] = 'NO! That is too cute!';
}

// upon failed validation, redirect back
// with flashed submitted data and flashed error messages
if (!$valid) { 
 
    // flash submitted data
    $_SESSION['flashed_data'] = $_POST;
 
    // flash error messages
    $_SESSION['flashed_messages'] = $errors;
 
    // redirect
    header('Location: display-form.php' . (
            $is_edit 
            ? '?puppy_id='.$puppy_id // display-form.php?puppy_id=1
            : ''                     // display-form.php
        )
    );
 
    exit();
}


// update the data from request
$puppy['name']      = $_POST['name']     ?? $puppy['name'];
$puppy['breed']     = $_POST['breed']    ?? $puppy['breed'];
$puppy['cuteness']  = $_POST['cuteness'] ?? $puppy['cuteness'];
$puppy['gender']    = $_POST['gender']   ?? $puppy['gender'];




// save the data
if ($is_edit) {
 
    // update an existing record 

    update($puppy_id, $puppy);
 
} else {
 
    // insert a new record

    $puppy_id = insert($puppy);
 
}




// flash success message(s)
$_SESSION['flashed_messages'] = [
    'Puppy successfully saved!'
];
 
// redirect (to the display form, with the inserted/updated puppy's id)
header('Location: display-form.php?puppy_id=' . $puppy_id);





