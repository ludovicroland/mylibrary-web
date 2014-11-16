<?php
  namespace Applications\Backend\Modules\Connexion;
  
  class ConnexionController 
    extends \Library\BackController 
  {
    
    public function executeIndex(\Library\HTTPRequest $request) 
    {
      if ($request->postExists('login')) 
      {
        $login = $request->postData('login');
        $password = sha1($request->postData('password'));
  
        if($this->managers->getManagerOf('Connexion')->connexion($login, $password, $this->app)) 
        {
          $this->app->user()->setAuthenticated(true);
          $this->app->httpResponse()->redirect('.');
        }
        else 
        {
          $this->app->user()->setFlashError('Le pseudo ou le mot de passe est incorrect.');
        }
      }
    }

    public function executeDeconnexion(\Library\HTTPRequest $request) 
    {
      $this->app->user()->setAuthenticated(false);
      $this->app->httpResponse()->redirect('/');
    }
    
  }
