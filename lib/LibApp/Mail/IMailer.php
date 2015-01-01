<?php

namespace LibApp\Mail;

/**
 *
 * @author mickael
 */
interface IMailer {
    
    /**
     * Envoi le mail selon les paramètres fournit
     * $message[from] array('adressMail@test.com' => 'alias)
     * $message[message] array('adressMail@test.com' => 'alias)
     * $message[subject] array('adressMail@test.com' => 'alias)
     * $message[to] array('adressMail@test.com' => 'alias)
     * @param array $options
     */
    public function send(array $options);
}
