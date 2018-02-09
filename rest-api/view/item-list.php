<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>All items</title>

<p>[ <a href="<?= BASE_URL . "articles" ?>">All items</a> ]</p>

<ul>

    <?php foreach ($articles as $art): ?>
        <li><a href="<?= BASE_URL . "articles/" . $art["id"] ?>"> 
        	<?= $art["name"] ?> </a></li>
    <?php endforeach; ?>

</ul>
