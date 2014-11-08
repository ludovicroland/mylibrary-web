<?php
    namespace Applications\Backend\Modules\Recherche;
    
    class RechercheController extends \Library\BackController {
		public function executeIndex(\Library\HTTPRequest $request) {
			if($request->method() == 'POST') {
				$recherche = new \Library\Entities\Recherche(array(
					'id'			=> $request->postData('id'),
					'nom' 			=> $request->postData('nom'),
					'annee' 		=> $request->postData('annee'),
					'genreId' 		=> $request->postData('genreId'),
					'auteurId' 		=> $request->postData('auteurId')
				));
				
				$resultats = $this->managers->getManagerOf('Livre')->search($recherche);
				
				$_SESSION['recherche'] = $resultats;
				
				$this->app->httpResponse()->redirect('/recherche-resultats.html');	
			}
			else {
				$recherche = new \Library\Entities\Recherche;
				
				//On construit le formulaire
				$formBuilder =  new \Library\FormBuilder\RechercheFormBuilder($recherche);
				$formBuilder->build();
				
				$form = $formBuilder->form();		
				
				$this->page->addVar('form', $form->createView());
			}
        }
		
		public function executeResult(\Library\HTTPRequest $request) {
			$resultats = $_SESSION['recherche'];
			$this->page->addVar('livresList', $resultats);
        }
    }