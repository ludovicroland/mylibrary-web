<?php
    namespace Library;
    
	/**
	* Classe s'assurant du nombre de caractères du champ d'un formulaire.
	*/
    class ExactOrNullLengthValidator extends Validator {
        protected $length;
        
		/**
		* Constructeur.
		* @param $errorMessage message d'erreur
		* @param $length longueur
		*/
        public function __construct($errorMessage, $length) {
            parent::__construct($errorMessage);
            
            $this->setLength($length);
        }
        
		/** {@inheritDoc} */
        public function isValid($value) {
            return (strlen($value) == $this->length || strlen($value) == 0);
        }
        
		/**
		* Setter du nombre de caractères.
		* @param $length nombre de caractères.
		*/
        public function setLength($length) {
            $length = (int) $length;
            
            if ($length > 0) {
                $this->length = $length;
            }
            else {
                throw new \RuntimeException('La longueur doit être un nombre supérieur à 0');
            }
        }
    }
