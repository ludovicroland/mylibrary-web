<?php
    namespace Library;
    
	/**
	* Classe abstraite dont vont hériter les validateurs des différents champs des formulaires.
	*/
    abstract class Validator {
        protected $errorMessage;
        
		/**
		* Constructeur.
		* @param $errorMessage message d'erreur
		*/
        public function __construct($errorMessage) {
            $this->setErrorMessage($errorMessage);
        }
        
		/**
		* Fonction abstraite qui gère la validation.
		* @param $value valeur à valider
		*/
        abstract public function isValid($value);
        
		/**
		* Setter du message d'erreur.
		* @param $errorMessage message d'erreur
		*/
        public function setErrorMessage($errorMessage) {
            if (is_string($errorMessage)) {
                $this->errorMessage = $errorMessage;
            }
        }
        
		/**
		* Getter du message d'erreur.
		* @return message d'erreur
		*/
        public function errorMessage() {
            return $this->errorMessage;
        }
    }
