<?php
  namespace Library\FormBuilder;
  
  class UtilisateurFormBuilder 
    extends \Library\FormBuilder
  {
    
    public function build() 
    {
      $this->form->add(new \Library\StringField(array(
        'label'       => 'Login *',
        'name'        => 'login',
        'maxLength'   => 50,
        'validators'  => array(
          new \Library\NotNullValidator('Le login est obligatoire.'),
          new \Library\MaxLengthValidator('Le login est trop long (50 caractères maximum).', 50)
        )
      )))
      ->add(new \Library\StringField(array(
        'label'       => 'Email *',
        'name'        => 'email',
        'maxLength'   => 50,
        'validators'  => array(
          new \Library\NotNullValidator('L\'email est obligatoire.'),
          new \Library\MaxLengthValidator('L\'email est trop long (50 caractères maximum).', 50),
          new \Library\EmailValidator('L\'email n\'est pas valide.')
        )
      )))
      ->add(new \Library\HiddenField(array(
        'name' => 'id',
      )));
    }
    
  }
