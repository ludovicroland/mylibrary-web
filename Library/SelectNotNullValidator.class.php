<?php
    namespace Library;
    
	/**
	* Classe permettant de s'assurer qu'un champ de formulaire n'est pas null.
	*/
    class SelectNotNullValidator extends Validator {
		/** {@inheritDoc} */
		public function isValid($value) { 
            return (int)$value != 0;
        }
    }
