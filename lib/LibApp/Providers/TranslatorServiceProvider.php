<?php
namespace LibApp\Providers;

use Silex\ServiceProviderInterface;
use Silex\Application;
use LibApp\Translator\FactoryAdapterTranslator;

/**
 * Description of TranslatorServiceProvider
 *
 * @author mickael
 */
class TranslatorServiceProvider implements ServiceProviderInterface {
    
    public function boot(Application $app) {
        
    }

    public function register(Application $app) {
        $app['translator'] = $app->share(function ($app) {
            if(isset($app['locale'])){
                $locale = $app['locale'];
            }
            
            /** @var LibApp\Translator\ITranslator $translator */
            $translator = FactoryAdapterTranslator::createTranslator("symfony", $locale);
            
            $translator->setLocale($locale);
            
            if(isset($app['loader'])){
                if(is_array($app['loader'])){
                    $translator->addLoader($app['loader']['format'], $app['loader']['class']);
                    $translator->addRessource($app['ressource']['format'], $app['ressource']['path'], $translator->getlocale());
                }
            }
            
            return $translator;
        });
    }
}
