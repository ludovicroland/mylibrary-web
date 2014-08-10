<?php
    namespace Library\FormBuilder;
    
    class RechercheFormBuilder extends \Library\FormBuilder{
		public function build() {
			$this->form->add(new \Library\StringField(array(
				'label' => 'Titre',
				'name' => 'nom',
				'maxLength' => 255,
				'validators' => array(
					new \Library\MaxLengthValidator('Le titre est trop long (255 caractères maximum).', 255)
				)
			)))
			->add(new \Library\StringField(array(
				'label' => 'Année',
				'name' => 'annee',
				'maxLength' => 4,
			)))
			->add(new \Library\SelectField(array(
				'label' => 'Genre',
				'name' => 'genreId',
				'sql' => 'SELECT \'\' AS value, \'\' AS libelle UNION SELECT GEN_ID AS value, GEN_LIBELLE AS libelle FROM GENRE ORDER BY libelle'
			)))
			->add(new \Library\SelectField(array(
				'label' => 'Auteur',
				'name' => 'auteurId',
				'sql' => 'SELECT \'\' AS value, \'\' AS libelle UNION SELECT AUT_ID AS value, CONCAT(AUT_NOM, " ", AUT_PRENOM) AS libelle FROM AUTEUR ORDER BY libelle'
			)));
		}
    }
