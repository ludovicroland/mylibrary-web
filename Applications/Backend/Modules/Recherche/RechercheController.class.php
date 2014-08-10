<?php
    namespace Applications\Backend\Modules\Recherche;
    
    class RechercheController extends \Library\BackController {
		public function executeIndex(\Library\HTTPRequest $request) {
			//Si le formulaire a été envoyé			
			$recherche =  new \Library\Entities\Recherche;
			
			//On construit le formulaire
			$formBuilder =  new \Library\FormBuilder\RechercheFormBuilder($recherche);
            $formBuilder->build();
			
			$form = $formBuilder->form();		
			
            $this->page->addVar('form', $form->createView());
        }
		
		public function executeResult(\Library\HTTPRequest $request) {
			if($request->method() == 'POST') {
				$recherche = new \Library\Entities\Recherche(array(
					'id'			=> $request->postData('id'),
					'nom' 			=> $request->postData('nom'),
					'annee' 		=> $request->postData('annee'),
					'genreId' 		=> $request->postData('genreId'),
					'auteurId' 		=> $request->postData('auteurId')
				));
			}
			else {
				$this->app->httpResponse()->redirect('/recherche.html');
			}
			
			$resultats = $this->managers->getManagerOf('Livre')->search($recherche);
			
            $this->page->addVar('livresList', $resultats);
        }
    }