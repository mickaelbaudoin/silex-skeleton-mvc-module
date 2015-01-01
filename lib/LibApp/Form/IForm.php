<?php

namespace LibApp\Form;

/**
 *
 * @author mickael
 */
interface IForm {
   public function build();
   
   public function isValid();
   
   public function bind($request);
   
   public function createView();
}
