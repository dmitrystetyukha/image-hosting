<?php
require_once __DIR__ . '/app/config.php';
?>

<html lang="ru">
<?php require_once __DIR__ . '/app/templates/head.php' ?>

<body>
    <?php require_once __DIR__ . "/app/templates/navbar.php" ?>

    <h3>Card header</h3>

    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="200" aria-label="Placeholder: Image cap"
        focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180"
        style="font-size:1.125rem;text-anchor:middle">
        <rect width="100%" height="100%" fill="#868e96"></rect>
        <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
    </svg>
    <div>
        <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
    <ul>
        <li>Cras justo odio</li>
        <li>Dapibus ac facilisis in</li>
        <li>Vestibulum at eros</li>
    </ul>
    <div>
        <a href="#">Card link</a>
        <a href="#">Another link</a>
    </div>
    <div>
        2 days ago
    </div>

</body>

</html>