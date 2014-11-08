<?php
  namespace Library;

  class IntegerValidator 
    extends Validator 
  {

    public function isValid($value) 
    {
			return preg_match("#^[1-9]+$#", $value);
    }
    
  }
