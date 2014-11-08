<?php
  namespace Library;
    
  class TextField
    extends Field
  {
  
    protected $cols;
    
    protected $rows;
        
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
      $widget .= '<textarea name="'.$this->name.'"';
            
      if (!empty($this->cols))
      {
        $widget .= ' cols="'.$this->cols.'"';
      }
            
      if (!empty($this->rows))
      {
        $widget .= ' rows="'.$this->rows.'"';
      }
			
			if (!empty($this->width))
      {
        $widget .= ' width="'.$this->width.'"';
      }
            
      $widget .= '>';
            
      if (!empty($this->value))
      {
        $widget .= htmlspecialchars($this->value);
      }
			
			$widget .= '</textarea>';
			
			if (!empty($this->errorMessage))
      {
        $widget .= '<span class="help-inline">';
				$widget .= $this->errorMessage;
				$widget .= '</span>';            
      }
			
			return $widget .= '</div></div>';
    }
        
    public function setCols($cols)
    {
      $cols = (int) $cols;
      
      if ($cols > 0)
      {
        $this->cols = $cols;
      }
    }
        
    public function setRows($rows) 
    {
      $rows = (int) $rows;
      
      if ($rows > 0)
      {
        $this->rows = $rows;
      }
    }
    
  }
  