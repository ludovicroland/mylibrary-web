<?php
    namespace Library;
    
	/**
	* Classe s'assurant du nombre de caractères max du champ d'un formulaire.
	*/
    class MaxLengthValidator extends Validator {
        protected $maxLength;
        
		/**
		* Constructeur.
		* @param $errorMessage message d'erreur
		* @param $maxLength longueur max
		*/
        public function __construct($errorMessage, $maxLength) {
            parent::__construct($errorMessage);
            
            $this->setMaxLength($maxLength);
        }
        
		/** {@inheritDoc} */
        public function isValid($value) {
            return strlen($value) <= $this->maxLength;
        }
        
		/**
		* Setter du nombre de caractères max.
		* @param $maxLength nombre de caractères max.
		*/
        public function setMaxLength($maxLength) {
            $maxLength = (int) $maxLength;
            
            if ($maxLength > 0) {
                $this->maxLength = $maxLength;
            }
            else {
                throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
            }
        }
    }
