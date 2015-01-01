<?php
namespace LibApp\Mail;

/*
 * Class adapter de SwiftMailer par sensiolab
 */

/**
 * Description of AdapterSwiftmailer
 *
 * @author mickael
 */
class AdapterSwiftMailer implements IMailer{
    
    /**
     *
     * @var \Swift_Mailer $_mailer
     */
    private $_mailer;    
    
    public function __construct(array $options = array()) {
        
        $swiftTransort = new \Swift_SmtpTransport();
        $swiftTransort->setHost($options['smtp']);
        $swiftTransort->setPort($options['port']);
        
        if(isset($options['encryption'])){
            $swiftTransort->setEncryption($options['encryption']);
        }
        
        if(isset($options['username'])){
            $swiftTransort->setUsername($options['username']);
        }
        
        if(isset($options['password'])){
            $swiftTransort->setPassword($options['password']);
        }
        
        if(isset($options['auth_mode'])){
            $swiftTransort->setAuthMode($options['auth_mode']);
        }
        
        
        $this->_mailer = new \Swift_Mailer($swiftTransort);
        
    }
    
    /**
     * @param array $options
     * @throws Exception
     */
    public function send(array $options = array()) {
        
        if(!is_array($options['from'])){
            throw new Exception("l'index from du tableau d'option n'est pas un tableau");
        }
        
        if(!is_array($options['to'])){
            throw new Exception("l'index from du tableau d'option n'est pas un tableau");
        }
        
        if(!is_string($options['message'])){
            throw new Exception("l'index from du tableau d'option n'est pas une chaine de cractere");
        }
        
        // Create a message
        $message = \Swift_Message::newInstance($options['subject'])
          ->setFrom($options['from'])
          ->setTo($options['to'])
          ->setBody($options['message'])
          ;
        
        $this->_mailer->send($message);
    }

}
