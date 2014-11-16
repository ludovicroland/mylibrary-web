<?php
  namespace Library\FormBuilder;
  
  class AuteurFormBuilder 
    extends \Library\FormBuilder
  {
  
    public function build() 
    {
      $this->form->add(new \Library\StringField(array(
        'label'       => 'Nom *',
        'name'        => 'nom',
        'id'          => 'nom',
        'validators'  => array(
          new \Library\NotNullValidator('Le nom est obligatoire'),
          new \Library\MaxLengthValidator('Le nom est trop long', 255),
        )
      )))
      ->add(new \Library\StringField(array(
        'label'       => 'Prénom *',
        'name'        => 'prenom',
        'id'          => 'prenom',
        'validators'  => array(
          new \Library\NotNullValidator('Le prenom est obligatoire'),
          new \Library\MaxLengthValidator('Le prenom est trop long', 255),
        )
      )))
      ->add(new \Library\HiddenField(array(
        'name' => 'id',
      )));
    }
    
  }
