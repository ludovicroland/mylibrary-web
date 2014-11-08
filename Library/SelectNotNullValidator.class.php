<?php
  namespace Library;

  class SelectNotNullValidator 
    extends Validator
  {

		public function isValid($value)
    { 
      return (int)$value != 0;
    }
    
  }
