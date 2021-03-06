<?php
  namespace Library;
    
  class HTTPResponse 
  {
    
    protected $page;
        
    public function addHeader($header) 
    {
      header($header);
    }
        
    public function redirect($location) 
    {
      header('Location: '.$location);
      exit;
    }
        
    public function redirect404($app) 
    {
      $this->page = new Page($app);
      $this->page->setContentFile(__DIR__.'/../Errors/404.php'); 
      $this->addHeader('HTTP/1.0 404 Not Found');   
      $this->send(true);
    }

    public function send($loadTemplate)
    {
      exit($this->page->getGeneratedPage($loadTemplate));
    }
        
    public function setPage(Page $page)  
    {
      $this->page = $page;
    }

    public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true) 
    {
      setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
    
  }
