<?php
  namespace Library;

  class HiddenField 
    extends Field 
  {      

    public function buildWidget() 
    {
      $widget = '<input type="hidden" name="'.$this->name.'"';
        
      if (!empty($this->value)) 
      {
        $widget .= ' value="'.htmlspecialchars($this->value).'"';
      }

      return $widget .= ' />';
    }
    
  }
