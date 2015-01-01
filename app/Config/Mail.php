<?php

namespace App\Config;

/**
 * Description of mail
 *
 * @author mickael
 */
class Mail {
    
    /**
     * Options for mailer
     * smtp
     * port
     * encryption
     * username
     * password
     * @var array $options 
     */
    static public $options = array(
        "smtp"  => "smtp.gmail.com",
        "port"  =>  465,
        "encryption" => "ssl",
        "username" => "myadress@gmail.com",
        "password" => "password",
        "auth_mode" => "login"
    );
}
