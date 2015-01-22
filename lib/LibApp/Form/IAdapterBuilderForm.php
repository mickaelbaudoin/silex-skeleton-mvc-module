<?php

namespace LibApp\Form;

/**
 *
 * @author mickael
 */
interface IAdapterBuilderForm {
    public function createBuildForm($data);
    
    public function add($input, $type, $options = array());
    
    public function getForm();
}
