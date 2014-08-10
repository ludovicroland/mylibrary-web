<?php
    namespace Library;
    
	/**
	* Classe permettant de s'assurer qu'un champ de formulaire n'est pas null.
	*/
    class NotNullValidator extends Validator {
		/** {@inheritDoc} */
		public function isValid($value) {	   
            return trim($value) != '';
        }
    }
