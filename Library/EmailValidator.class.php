<?php
  namespace Library;
  
  class EmailValidator 
    extends Validator 
  {        

    public function isValid($value) 
    {
      return preg_match("#^[a-zA-Z0-9_-].+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,3}$#", $value);
    }
    
  }
