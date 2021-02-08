<?php

require_once 'DBBlackboxV2.php';
require_once 'Article.php';

// get article_id from URL ($_GET)
$article_id = $_GET['article_id'] ?? null;

// this is EDIT if article_id is not empty
$is_edit = !empty($article_id);

if ($is_edit) {

    // find article by id, return object of class Article
    $article = find($article_id, 'Article');
    $article->id = $article_id; // tweak for DBBlackbox

} else {

    $article = new Article;

}

// get flashed messages

// get flashed data

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article form</title>
</head>
<body>

    <form action="handle.php<?= $is_edit ? '?article_id=' . $article_id : '' ?>" method="post">

        <p>
            <label for="">Title</label>:<br>
            <input type="text" name="title" value="<?= htmlspecialchars($article->title) ?>">
        </p>

        <p>
            <label for="">Body</label>:<br>
            <textarea name="body" cols="30" rows="10"><?= htmlspecialchars($article->body) ?></textarea>
        </p>

        <p>
            <label for="">Language</label>:<br>
            <select name="language">
                <option value="" <?= !$article->language ? 'selected' : '' ?>>-- no language selected --</option>
                <option value="en" <?= $article->language == 'en' ? 'selected' : '' ?>>English</option>
                <option value="cs" <?= $article->language == 'cs' ? 'selected' : '' ?>>Czech</option>
                <option value="de" <?= $article->language == 'de' ? 'selected' : '' ?>>German</option>
            </select>
        </p>

        <p>
            <button>Save article</button>
        </p>



    </form>


</body>
</html>