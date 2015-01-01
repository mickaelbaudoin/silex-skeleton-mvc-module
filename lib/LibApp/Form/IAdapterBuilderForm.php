<?php

namespace LibApp\Form;

/**
 *
 * @author mickael
 */
interface IAdapterBuilderForm {
    public function createBuilder();
    
    public function add();
}
