<?php namespace Zaffar\AmazonMws;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use anlutro\LaravelSettings\Facade as Setting;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*$configPath = __DIR__ . '/../../config/amazon-mws.php';
        $this->mergeConfigFrom($configPath, 'amazon-mws');*/
        $this->readyConfig ();

        $this->app->alias('AmazonOrderList', 'Zaffar\AmazonMws\AmazonOrderList');
        $this->app->alias('zeeReport', 'Zaffar\AmazonMws\zeeReport');
        $this->app->alias('AmazonOrderItemList', 'Zaffar\AmazonMws\AmazonOrderItemList');
        $this->app->alias('AmazonReportRequest', 'Zaffar\AmazonMws\AmazonReportRequest');
        $this->app->alias('AmazonReportList', 'Zaffar\AmazonMws\AmazonReportList');
        $this->app->alias('AmazonOrderItemList', 'Zaffar\AmazonMws\AmazonOrderItemList');
    }

    public function boot()
    {
        /*$configPath = __DIR__ . '/../../config/amazon-mws.php';
        $this->publishes([$configPath => config_path('amazon-mws.php')], 'config');*/
        $this->readyConfig ();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    /**
     * take array and
     */
    private function readyConfig ()
    {
        $configStore = [
            'store' => [
                Setting::get('storeName') => [
                    'merchantId' => Setting::get('merchantId'),
                    'marketplaceId' => Setting::get('marketplaceId'),
                    'keyId' => Setting::get('keyId'),
                    'secretKey' => Setting::get('secretKey'),
                    'AMAZON_SERVICE_URL'=> Setting::get('amazonServiceUrl'),
                    'authToken'=> Setting::get('authToken'),
                ]
            ],

            // Default service URL
            'AMAZON_SERVICE_URL' => 'https://mws.amazonservices.com/',

            'muteLog' => false
        ];
        $config = \App::make('config');
        $key= 'amazon-mws';
        $config ->set($key,  $configStore);
        
    }

}
