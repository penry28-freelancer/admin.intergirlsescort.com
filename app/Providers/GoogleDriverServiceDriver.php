<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleDriverServiceDriver extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // try {
        //     \Storage::extend('google', function($app, $config) {
        //         $client = new \Google\Client();

        //         $client->setClientId($config['clientId']);
        //         $client->setClientSecret($config['clientSecret']);
        //         $client->refreshToken($config['refreshToken']);

        //         $service = new \Google\Service\Drive($client);
        //         $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folderId'] ?? '/');
        //         $driver  = new \League\Flysystem\Filesystem($adapter);

        //         return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
        //     });
        // } catch (\Exception $e) {
        //     report($e);
        // }
    }
}
