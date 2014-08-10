<?php
    namespace Library\FormBuilder;
    
    class GenreFormBuilder extends \Library\FormBuilder{
		public function build() {
			$this->form->add(new \Library\StringField(array(
				'label' => 'Libellé *',
				'name' => 'libelle',
				'id' => 'libelle',
				'validators' => array(
					new \Library\NotNullValidator('Le libellé est obligatoire'),
					new \Library\MaxLengthValidator('Le libellé est trop long', 255),
				)
			)))
			->add(new \Library\HiddenField(array(
				'name' => 'id',
			)));
		}
    }
