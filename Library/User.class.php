<?php
  namespace Library;
    
  session_start();
    
  class User 
    extends ApplicationComponent
  {
        
		public function getAttribute($attr)
    {
      return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
    }
        
    public function getFlash()
    {
      $flash = $_SESSION['flash'];
      unset($_SESSION['flash']);
      
      return $flash;
    }
		
    public function getFlashError()
    {
        $flash = $_SESSION['flashError'];
        unset($_SESSION['flashError']);
        
        return $flash;
    }
		
    public function getFlashCaptcha()
    {
      $flash = $_SESSION['flashCaptcha'];
      unset($_SESSION['flashCaptcha']);
      
      return $flash;
    }

    public function hasFlash()
    {
      return isset($_SESSION['flash']);
    }
		
    public function hasFlashError()
    {
      return isset($_SESSION['flashError']);
    }
		
    public function hasFlashCaptcha()
    {
      return isset($_SESSION['flashCaptcha']);
    }

    public function isAuthenticated()
    {
      return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
    }

    public function setAttribute($attr, $value)
    {
      $_SESSION[$attr] = $value;
    }
        
    public function setAuthenticated($authenticated = true)
    {
      if (!is_bool($authenticated))
      {
        throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
      }
        
      $_SESSION['auth'] = $authenticated;
  
      if(!$authenticated)
      {
        $_SESSION = array();
        session_destroy();
      }
    }
        
    public function setFlash($value)
    {
      $_SESSION['flash'] = $value;
    }

    public function setFlashError($value)
    {
      $_SESSION['flashError'] = $value;
    }

    public function setFlashCaptcha($value)
    {
        $_SESSION['flashCaptcha'] = $value;
    }
    
  }
	