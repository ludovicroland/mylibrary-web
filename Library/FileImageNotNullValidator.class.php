<?php
    namespace Library;
    
	/**
	* Classe s'assurant du nombre de caractères max du champ d'un formulaire.
	*/
    class FileImageNotNullValidator extends Validator {
        protected $name;
        
		/**
		* Constructeur.
		* @param $errorMessage message d'erreur
		* @param $name nom du champ
		*/
        public function __construct($errorMessage, $name) {
            parent::__construct($errorMessage);
            
            $this->setName($name);
        }
        
		/** {@inheritDoc} */
        public function isValid($value) {
			if(isset($_FILES[$this->name]) AND $_FILES[$this->name]['error'] == 0) {
				$formats = array('image/jpeg', 'image/jpg', 'image/png', 'image/pjpeg');
				
				if(in_array($_FILES[$this->name]['type'], $formats)) {
					return true;
				}

				return false;				
			}
			
            return false;
        }
        
        public function setName($name) {
			$this->name = $name;
        }
    }
