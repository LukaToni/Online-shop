<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Item detail</title>

<h1>Details of: <?= $name ?></h1>

<p>[<a href="<?= BASE_URL . "articles" ?>">All items</a>]</p>

<ul>
    <li>Title: <b><?= $name ?></b></li>
    <li>Price: <b><?= $price ?> EUR</b></li>
    <li>Description: <i><?= $description ?></i></li>
</ul>


