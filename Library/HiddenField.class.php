<?php
    namespace Library;
    
	/**
	* Classe représentant un champ text d'un formulaire.
	*/
    class HiddenField extends Field {      
		/**
		* Fonction permettant de construite le widget.
		* @return le widget
		*/
        public function buildWidget() {
            $widget = '<input type="hidden" name="'.$this->name.'"';
            
            if (!empty($this->value)) {
                $widget .= ' value="'.htmlspecialchars($this->value).'"';
            }

            return $widget .= ' />';
        }
    }
