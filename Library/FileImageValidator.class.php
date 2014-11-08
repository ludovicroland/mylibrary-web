<?php
  namespace Library;
  
  class FileImageValidator 
    extends Validator 
  {
    
    protected $name;

    public function __construct($errorMessage, $name) 
    {
      parent::__construct($errorMessage);
      $this->setName($name);
    }
      
    public function isValid($value) 
    {		
      if(isset($_FILES[$this->name]) AND $_FILES[$this->name]['name'] != '') 
      {				
        if($_FILES[$this->name]['error'] == 0) 
        {				
          $formats = array('image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg');
          
          if(in_array($_FILES[$this->name]['type'], $formats)) 
          {
            return true;
          }

          return false;
        }
        
        return false;
      }
      
      return true;
    }
        
    public function setName($name) 
    {
      $this->name = $name;
    }
    
  }
