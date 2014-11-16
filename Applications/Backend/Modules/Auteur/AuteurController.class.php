<?php
  namespace Applications\Backend\Modules\Auteur;
  
  class AuteurController 
    extends \Library\BackController 
  {
  
    public function executeIndex(\Library\HTTPRequest $request) 
    {
      $auteursList = $this->managers->getManagerOf('Auteur')->getAuteursList();
      $this->page->addVar('auteursList', $auteursList);
    }

    public function executeNew(\Library\HTTPRequest $request) 
    {
      //Si le formulaire a été envoyé			
      if($request->method() == 'POST') 
      {			
        $auteur = new \Library\Entities\Auteur(array(
          'id'				=> $request->postData('id'),
          'nom' 			=> $request->postData('nom'),
          'prenom' 			=> $request->postData('prenom')
        ));
      }
      else
      {
        $auteur =  new \Library\Entities\Auteur;
      }
      
      //On construit le formulaire
      $formBuilder =  new \Library\FormBuilder\AuteurFormBuilder($auteur);
      $formBuilder->build();
      $form = $formBuilder->form();
      
      // On récupère le gestionnaire de formulaire pour la sauvegarde
      $formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('Auteur'), $request);			
            
      if ($formHandler->process()) 
      {
        $this->app->user()->setFlash(utf8_encode('Auteur enregistré avec succès.'));
        $this->app->httpResponse()->redirect('/auteurs.html');
      }
      
      $this->page->addVar('form', $form->createView());
    }

    public function executeDelete(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Auteur')->delete($request->getData('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Auteur supprimé avec succès.'));
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Cet auteur est référencé, vous ne pouvez pas le supprimer.'));
      }	
      
      $this->app->httpResponse()->redirect('/auteurs.html');
    }	
  
    public function executeEdit(\Library\HTTPRequest $request) 
    {
      //Si le formulaire a été envoyé
      if($request->method() == 'POST') 
      {				
        $auteur = new \Library\Entities\Auteur(array(
          'id'				=> $request->postData('id'),
          'nom' 			=> $request->postData('nom'),
          'prenom' 			=> $request->postData('prenom')
        ));
      }
      else
      {
        $auteur = $this->managers->getManagerOf('Auteur')->getAuteurById($request->getData('id'));
      
        if(empty($auteur)) 
        {
          $this->app->httpResponse()->redirect('erreur.html');
        }
      }	
      
      //On construit le formulaire
      $formBuilder =  new \Library\FormBuilder\AuteurFormBuilder($auteur);
      $formBuilder->build();
      $form = $formBuilder->form();
      
      // On récupère le gestionnaire de formulaire pour la sauvegarde
      $formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('Auteur'), $request);			
            
      if ($formHandler->process()) 
      {
        $this->app->user()->setFlash(utf8_encode('Auteur enregistré avec succès.'));
        $this->app->httpResponse()->redirect('/auteurs.html');
      }
      
      $this->page->addVar('auteur', $auteur);
      $this->page->addVar('form', $form->createView());
    }
  }	
