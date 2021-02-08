<?php

class Board
{
    public function __construct($array)
    {
        $this->turn_pos = $array;
        $this->squares = '<div class="board">';

        for($col = 1; $col <= 8; $col++) {

            for($row = 1; $row <= 8; $row++) {

                if(array_key_exists($row, $this->turn_pos[$col])) {
                    $sq = new Square($col, $row, new Piece($this->turn_pos[$col][$row]));
                } else {
                    $sq = new Square($col, $row);
                }

                $this->squares = $this->squares . $sq;

            }

        }

    }

    


    public function __toString()
    {
        


        return $this->squares . '</div>';
    }

}

