<?php
    namespace Library;
    
	/**
	* Classe s'assurant dubon formattage d'une adresse e-mail.
	*/
    class EmailValidator extends Validator {        
        
		/** {@inheritDoc} */
        public function isValid($value) {
            return preg_match("#^[a-zA-Z0-9_-].+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,3}$#", $value);
        }
    }
