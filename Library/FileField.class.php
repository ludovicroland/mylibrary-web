<?php
  namespace Library;
    
  class FileField 
    extends Field 
  {
		
    protected $help;

    public function buildWidget() 
    {
      $widget = '<div class="form-group';
        
      if (!empty($this->errorMessage)) 
      {
        $widget .= ' has-error';
      }
        
      $widget .= '">';            
      $widget .= '<label class="col-lg-2 control-label" for="'.$this->name.'">'.$this->label.'</label>';
      $widget .= '<div class="col-lg-3">';
      $widget .= '<input type="file" name="'.$this->name.'"';
      $widget .= ' />';
  
      if(!empty($this->help)) 
      {
        $widget .= '<span class="help-block">';
        $widget .= $this->help;
        $widget .= '</span>';
      }
  
      if (!empty($this->errorMessage)) 
      {
        $widget .= '<span class="help-block">';
        $widget .= $this->errorMessage;
        $widget .= '</span>';
      }
  
      return $widget .= '</div></div>';
    }

    public function setHelp($help)  
    {
      $this->help = $help;
    }
    
  }
