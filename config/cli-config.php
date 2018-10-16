<?php
$app = require __DIR__.'/../src/app.php';

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($app['doctrine'])
));
return $helperSet;