<?php

class Square
{

    public $x_coord = null;
    public $y_coord = null;
    public $piece = null;

    public function __construct($x, $y, $piece = null)
    {
        $this->x_coord = $x;
        $this->y_coord = $y;
        $this->piece = $piece;
    }

    


    public function isDark()
    {
        if (($this->x_coord % 2 === 0) && ($this->y_coord % 2 === 0) || 
            ($this->x_coord % 2 !== 0) && ($this->y_coord % 2 !== 0)) return true;
    }

    public function __toString()
    {
        
        return '<div class="square '. ($this->isDark() ? 'black' : 'white') . '">' . $this->piece . '</div>';
        
    }

}
