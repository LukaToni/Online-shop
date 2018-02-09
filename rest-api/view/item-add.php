<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Add entry</title>

<h1>Add new item</h1>

<p>[
<a href="<?= BASE_URL . "articles" ?>">All books</a> |
<a href="<?= BASE_URL . "articles/add" ?>">Add new</a>
]</p>

<form action="<?= BASE_URL . "articles/add" ?>" method="post">
    <p><label>Title: <input type="text" name="name" value="<?= $name ?>" /></label></p>
    <p><label>Price: <input type="number" name="price" value="<?= $price ?>" /></label></p>
    <p><label>Description: <br/><textarea name="description" cols="70" rows="10"><?= $description ?></textarea></label></p>
    <p><button>Insert</button></p>
</form>