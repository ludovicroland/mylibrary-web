<?php
  namespace Library;

  class Route 
  {
  
    protected $action;
    
    protected $module;
      
    protected $url;
    
    protected $loadTemplate;
      
    protected $varsNames;
      
    protected $vars = array();
      
    public function __construct($url, $module, $action, array $varsNames, $loadTemplate) 
    {
      $this->setUrl($url);
      $this->setModule($module);
      $this->setAction($action);
      $this->setVarsNames($varsNames);
      $this->setLoadTemplate($loadTemplate);
    }

    public function hasVars() 
    {
      return !empty($this->varsNames);
    }

    public function match($url) 
    {
      if (preg_match('`^'.$this->url.'$`', $url, $matches)) 
      {
        return $matches;
      } 

      return false;
    }
      
    public function setAction($action) 
    {
      if (is_string($action)) 
      {
        $this->action = $action;
      }
    }
      
    public function setModule($module) 
    {
      if (is_string($module)) 
      {
        $this->module = $module;
      }
    }

    public function setUrl($url) 
    {
      if (is_string($url)) 
      {
        $this->url = $url;
      }
    }
    
    public function setLoadTemplate($loadTemplate) 
    {
      if (is_bool($loadTemplate)) 
      {
        $this->loadTemplate = $loadTemplate;
      }
    }

    public function setVarsNames(array $varsNames) 
    {
      $this->varsNames = $varsNames;
    }

    public function setVars(array $vars) 
    {
      $this->vars = $vars;
    }

    public function action() 
    {
      return $this->action;
    }

    public function module() 
    {
      return $this->module;
    }
    
    public function loadTemplate() 
    {
      return $this->loadTemplate;
    }
      
    public function vars() 
    {
      return $this->vars;
    }
      
    public function varsNames() 
    {
      return $this->varsNames;
    }
    
  }
