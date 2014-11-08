<?php
  namespace Library;

  class CheckboxField 
    extends Field 
  { 

    public function buildWidget() 
    {
      $widget = '<div class="form-group';
          
      if (!empty($this->errorMessage)) 
      {
        $widget .= ' has-error';
      }
    
      $widget .= '"><div class="col-lg-2"></div>';     
      $widget .= '<div class="col-lg-3 checkbox">';			
      $widget .= '<label>';			
      $widget .= '<input type="checkbox" name="'.$this->name.'"';
    
      if (!empty($this->value)) 
      {
        $widget .= ' checked';	      
      }

      $widget .= ' />';
      $widget .= $this->label;
      $widget .= '</label>';
    
      if (!empty($this->errorMessage)) 
      {
        $widget .= '<span class="help-block">';
        $widget .= $this->errorMessage;
        $widget .= '</span>';
      }
    
      return $widget .= '</div></div>';
    }
    
  }
