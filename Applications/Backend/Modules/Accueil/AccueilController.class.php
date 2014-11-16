<?php
  namespace Applications\Backend\Modules\Accueil;
  
  class AccueilController 
    extends \Library\BackController 
  {
      
    public function executeIndex(\Library\HTTPRequest $request)
    {
      $livresList = $this->managers->getManagerOf('Livre')->getSuggestionList($this->app->user()->getAttribute('id'));
      $this->page->addVar('livresList', $livresList);
    }
  
    public function executeDelete(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Livre')->removeSuggestions($request->getData('id'), $this->app->user()->getAttribute('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre supprimé de la liste des suggestions avec succès.'));
        $this->app->httpResponse()->redirect('/');
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Une erreur est survenue.'));
        $this->app->httpResponse()->redirect('/');		
      }				
    }
    
  }
