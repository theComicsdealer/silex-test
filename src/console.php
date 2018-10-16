<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;

$console = new Application('My Silex Application', 'n/a');
$console->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', 'dev'));
$console->setDispatcher($app['dispatcher']);
$console
    ->register('my-command')
    ->setDefinition(array(
        // new InputOption('some-option', null, InputOption::VALUE_NONE, 'Some help'),
    ))
    ->setDescription('My command description')
    ->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
        // do something
    })
;

// Register the cache:clear command !
$console
->register('cache:clear')
->setDescription('Clears the cache')
->setCode(function (InputInterface $input, OutputInterface $output) use ($app) {
    if (!isset($app['cache.path']))
    {
         $output->writeln(sprintf("<error>ERROR:</error> could not clear the cache: <info>\$app['cache.path']</info> is not set.", 'cache:clear'));
         return false;
    }
    $cacheDir = $app['cache.path'];
    $finder = new Finder();
    $finder
        ->in($cacheDir)
        ->notName('.gitkeep')
    ;
    
    //--- from Filesystem::remove()
    $remove = function ($files, $recurse) {
        $files = iterator_to_array($files);
        $files = array_reverse($files);
        foreach ($files as $file) {
            if (!file_exists($file) && !is_link($file)) {
                continue;
            }
            if (is_dir($file) && !is_link($file)) {
                $recurse(new \FilesystemIterator($file), $recurse);
                if (true !== @rmdir($file)) {
                    throw new \Exception(sprintf('Failed to remove directory %s', $file));
                }
            } else {
                // https://bugs.php.net/bug.php?id=52176
                if (defined('PHP_WINDOWS_VERSION_MAJOR') && is_dir($file)) {
                    if (true !== @rmdir($file)) {
                        throw new \Exception(sprintf('Failed to remove file %s', $file));
                    }
                } else {
                    if (true !== @unlink($file)) {
                        throw new \Exception(sprintf('Failed to remove file %s', $file));
                    }
                }
            }
        }
    };
    
    $remove($finder, $remove);
    $output->writeln("Cache succesfully cleared!");
    return true;
});

return $console;
