<?php
/**
 *  A custom doctrine service provider
 *  Not using the silex's doctrine provider because it doesn't include Doctrine\ORM
 */

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Silex\Api\BootableProviderInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DoctrineProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
    

        $conn = array(
            'dbname' => 'wunder_db',
            'user' => 'root',
            'password' => '',
            'host' => '127.0.0.1',
            'driver' => 'pdo_mysql'
        );


        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(dirname(dirname(__FILE__)).'/Models/Entity'), $isDevMode);

        try{
            $entityManager = EntityManager::create($conn, $config);
            $app['doctrine'] = $entityManager;
        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function boot(Application $app)
    {

    }

}