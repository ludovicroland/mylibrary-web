<?php
    namespace Library\FormBuilder;
    
    class LivreFormBuilder extends \Library\FormBuilder{
		public function build() {
			$this->form->add(new \Library\StringField(array(
				'label' => 'Titre *',
				'name' => 'nom',
				'maxLength' => 255,
				'validators' => array(
					new \Library\NotNullValidator('Le titre est obligatoire.'),
					new \Library\MaxLengthValidator('Le titre est trop long (255 caractères maximum).', 255)
				)
			)))
			->add(new \Library\StringField(array(
				'label' => 'Année *',
				'name' => 'annee',
				'maxLength' => 4,
				'validators' => array(
					new \Library\ExactLengthValidator('L\'année doit être composée de 4 chiffres.', 4)
				)
			)))
			->add(new \Library\FileField(array(
				'label' => 'Couverture',
				'name' => 'couverture',
				'help' => 'Extensions acceptées : *.jpg, *.jpeg, *.png',
				'validators' => array(
					new \Library\FileSizeValidator('La couverture ne doit pas avoir une taille supérieure à 2Mo.', 'couverture'),
					new \Library\FileImageValidator('La couverture doit être une image portant l\'extension *.jpg, *.jpeg ou .*png.', 'couverture'),
				)
			)))
			->add(new \Library\SelectField(array(
				'label' => 'Genre *',
				'name' => 'genreId',
				'sql' => 'SELECT GEN_ID AS value, GEN_LIBELLE AS libelle FROM GENRE ORDER BY GEN_LIBELLE',
				'validators' => array(
					new \Library\SelectNotNullValidator('Le livre doit obligatoirement être rattaché à une catégorie.')
				)
			)))
			->add(new \Library\SelectField(array(
				'label' => 'Auteur *',
				'name' => 'auteurId',
				'sql' => 'SELECT AUT_ID AS value, CONCAT(AUT_NOM, " ", AUT_PRENOM) AS libelle FROM AUTEUR ORDER BY AUT_NOM, AUT_PRENOM',
				'validators' => array(
					new \Library\SelectNotNullValidator('Le livre doit obligatoirement être rattaché à un auteur.')
				)
			)))
			->add(new \Library\CheckBoxField(array(
				'label' => 'Poche',
				'name' => 'poche'
			)))
			->add(new \Library\HiddenField(array(
				'name' => 'id',
			)));
		}
    }
