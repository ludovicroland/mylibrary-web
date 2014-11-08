<?php
  namespace Library;
  
  class FileMultiImageValidator 
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
      if(isset($_FILES[$this->name])) 
      {
        foreach($_FILES[$this->name]['name'] as $key => $value) 
        {
          if($_FILES[$this->name]['error'][$key] == 0) 
          {
            $formats = array('image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg');
          
            if(!in_array($_FILES[$this->name]['type'][$key], $formats)) 
            {
              return false;
            }
          }
          else 
          {
            return false;
          }
        }
        
        return true;
      }
      
      return true;
    }
      
    public function setName($name) 
    {
      $this->name = $name;
    }
    
  }
