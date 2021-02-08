<?php

require_once 'DBBlackboxV2.php';
require_once 'Article.php';

session_start();

// get article_id from URL ($_GET)
$article_id = $_GET['article_id'] ?? null;

// this is EDIT if article_id is not empty
$is_edit = !empty($article_id);

if ($is_edit) {

    // find article by id, return object of class Article
    $article = find($article_id, 'Article');
    $article->id = $article_id;

} else {

    $article = new Article;

}

// validation
$valid = true;
$errors = [];

if (empty($_POST['title'])) {
    $valid = false;
    $errors[] = 'The title field is mandatory.';
}

// if validation failed
if (!$valid) {

    $_SESSION['flashed_messages'] = $errors;

    $_SESSION['flashed_data'] = $_POST;

    // produces either
    //          form.php?article_id=1
    // or       form.php
    header('Location: form.php' . ($is_edit ? '?article_id=' . $article_id : ''));

    exit();
}

$article->updateFromRequest();

$article->save();

header('Location: ' . $article->getEditUrl());