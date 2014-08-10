<?php
    namespace Library;
    
	/**
	* Classe permettant de s'assurer qu'un champ de formulaire est un entier.
	*/
    class IntegerValidator extends Validator {
       /** {@inheritDoc} */
	   public function isValid($value) {
			return preg_match("#^[1-9]+$#", $value);
        }
    }
