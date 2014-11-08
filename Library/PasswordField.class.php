<?php
  namespace Library;

  class PasswordField 
    extends Field 
  {
    
    protected $maxLength;
        
    public function buildWidget() 
    {
      $widget = '<div class="control-group';
        
      if (!empty($this->errorMessage))
      {
        $widget .= ' warning';
      }
  
      $widget .= '">';            
      $widget .= '<label class="control-label" for="'.$this->name.'">'.$this->label.' :</label>';
      $widget .= '<div class="controls">';
      $widget .= '<input type="password" name="'.$this->name.'"';
        
      if (!empty($this->value)) 
      {
        $widget .= ' value="'.htmlspecialchars($this->value).'"';
      }
        
      if (!empty($this->maxLength)) 
      {
        $widget .= ' maxlength="'.$this->maxLength.'"';
      }

      $widget .= ' />';
  
      if (!empty($this->errorMessage)) 
      {
        $widget .= '<span class="help-inline">';
        $widget .= $this->errorMessage;
        $widget .= '</span>';
      }
  
      return $widget .= '</div></div>';
    }

    public function setMaxLength($maxLength)  
    {
      $maxLength = (int) $maxLength;
        
      if ($maxLength > 0) 
      {
        $this->maxLength = $maxLength;
      } 
      else
      {
        throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
      }
    }
    
  }
