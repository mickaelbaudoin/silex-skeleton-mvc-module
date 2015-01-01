<?php
namespace LibApp\Providers;

use Silex\ServiceProviderInterface;
use Silex\Application;
use LibApp\Mail\FactoryMailer;

/**
 * Description of MailerServiceProvider
 *
 * @author mickael
 */
class MailerServiceProvider implements ServiceProviderInterface {
    
    public function boot(Application $app) {
        
    }

    public function register(Application $app) {
        $app['mailer'] = $app->share(function () {
            return FactoryMailer::createMailer("swift");
        });
    }
}
