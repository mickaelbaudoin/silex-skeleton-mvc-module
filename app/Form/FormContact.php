<?php

namespace App\Form;

/**
 * Description of FormContact
 *
 * @author mickael
 */
class FormContact extends \LibApp\Form\BuilderBaseForm {

    public function build() {
        $this->add('subject', 'text');
        $this->add('message', 'textarea');
    }

}
