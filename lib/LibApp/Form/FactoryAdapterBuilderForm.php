<?php

namespace LibApp\Form;

/**
 * Description of FactoryBuilderForm
 *
 * @author mickael
 */
class FactoryAdapterBuilderForm {
    
    public function createBuilder($builderName, $app) {
        switch ($builderName){
            case "symfony":
                return new AdapterBuilderFormSymfony($app);
        }
    }
}
