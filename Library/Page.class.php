<?php
    namespace Library;
    
	/**
	* Classe représentant une page du site web.
	*/
    class Page extends ApplicationComponent {
        protected $contentFile;
        protected $vars = array();
        
		/**
		* Permet d'ajouter des variables.
		* @param $var nom de la variable
		* @param $value valeur de la variable
		*/
        public function addVar($var, $value) {
            if (!is_string($var) || is_numeric($var) || empty($var)) {
                throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractère non nulle');
            }
            
            $this->vars[$var] = $value;
        }
        
		/**
		* Getter de la page générée.
		* @return page générée
		*/
        public function getGeneratedPage() {
            if (!file_exists($this->contentFile)) {
                throw new \RuntimeException('La vue spécifiée n\'existe pas');
            }
			
			$user = $this->app->user();
            
            extract($this->vars);
            
			//Contenu
            ob_start();
                require $this->contentFile;
            $content = ob_get_clean();
            
			//Layout
            ob_start();
                require __DIR__.'/../Applications/'.$this->app->name().'/Templates/layout.php';
            return ob_get_clean();
        }
        
		/**
		* Setter du contenu de la page.
		* @param $contentFile contenu de la page
		*/
        public function setContentFile($contentFile) {
            if (!is_string($contentFile) || empty($contentFile)) {
                throw new \InvalidArgumentException('La vue spécifiée est invalide');
            }
            
            $this->contentFile = $contentFile;
        }
    }
