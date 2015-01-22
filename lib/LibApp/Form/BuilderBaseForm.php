<?php

namespace LibApp\Form;

/**
 * Description of BaseForm
 *
 * @author mickael
 */
abstract class BuilderBaseForm implements \LibApp\Form\IBuilderForm {
    
    protected $_builder;

    public function __construct($app, $data = array()) {
        $this->_builder = $app['form.factory']->createBuildForm($data);
        $this->build();
    }

    public function build() {
        return $this->_builder;
    }

    public function createView() {
        return $this->_builder->getForm()->createView();
    }
    
    public function add($elementName, $elementType){
        $this->_builder->add($elementName, $elementType);
        return $this;
    }
    
    public function getForm(){
        return $this->_builder->getForm();
    }

}
