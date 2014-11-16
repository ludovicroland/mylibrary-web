<?php
  namespace Applications\Backend;
  
  class BackendApplication 
    extends \Library\Application 
  {
  
    public function __construct() 
    {
      parent::__construct();
      $this->name = 'Backend';
    }
      
    public function run() 
    {
      if ($this->user->isAuthenticated()) 
      {
        $controller = $this->getController();
      }
      else 
      {
        $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index', true);
      }
      
      $controller->execute();     
      $this->httpResponse->setPage($controller->page());
      $this->httpResponse->send($controller->loadTemplate());
    }
    
  }
