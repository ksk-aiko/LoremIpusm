<?php

// set the default file extension for autoloadinG
spl_autoload_extensions('.php');
// load classes without specifying the file extension
spl_autoload_register(function($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) include($file);
});

// use Composer's autoloader, so we can load third-party libraries
require_once 'vendor/autoload.php';

use Helpers\RandomGenerator;

// set min and max via query parameters 
$min = $_GET['min'] ?? 5;
$max = $_GET['max'] ?? 20;

$users = RandomGenerator::users($min, $max);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>

    </style>
</head>
<body>
    <h1>User Profiles</h1>

    <?php foreach ($users as $user): ?>
        <?= $user->toHTML(); ?>
    <?php endforeach; ?>

</body>
</html>