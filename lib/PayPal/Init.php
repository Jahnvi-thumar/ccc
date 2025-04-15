<?php
// use Composer\Autoload\PayPal_Autoloader;
// use myLoader;
use myLoader\PayPal_Autoloader;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
class PayPal_Init
{
    private static $_loader;
    public function __construct()
    {
        echo '123';
    }
    public static function getLoader()
    {
        self::$_loader = new PayPal_AutoLoader();
        self::$_loader->register(true);
    }
    public function getApiContext()
    {
        $paypal = new ApiContext(new OAuthTokenCredential(
        'AWb-4hgWXXLp1xjsC4u3DabVgR8L1IG1d6LMoUWr5mjQh3AKV8LR3rMAs6Zd0Pfd0SbV1iqnQmficTXU',
        'EGLplqLiQgKOWkt2nRYFyQIjVwiVjpqn_wO8EZGZ1BIHzeV6sfs_XPgcjLGY25nSxjKwO-uWxO051NZB'
        ));

        $paypal->setConfig([
        'mode' => 'sandbox', // Change to 'live' in production
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => 'PayPal.log',
        'log.LogLevel' => 'DEBUG'
        ]);

        return $paypal;
    }
}
?>
