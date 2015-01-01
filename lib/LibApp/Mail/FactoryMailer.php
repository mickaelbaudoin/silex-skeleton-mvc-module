<?php
namespace LibApp\Mail;

/**
 * Description of FactoryMailer
 *
 * @author mickael
 */
class FactoryMailer {
    
    /**
     * Retourne une instance IMailer
     * @param string $mailer
     * @return \IMailer
     */
    public static function createMailer($mailer){
        
        $options = \App\Config\Mail::$options;
        switch ($mailer) {
            case "swift" :
                return new AdapterSwiftMailer($options);
        }
    }
}
