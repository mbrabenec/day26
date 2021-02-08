<?php

require 'Board.php';
require 'Piece.php';
require 'Square.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        body {
            background: lightgreen;
        }

        .board .row {
            width: 24em;
            display: flex;
            
        }

        .board .row>div {
            width: 3em;
            height: 3em;
        }

        .board .white {
            background-color: #c2c2c2;
        }

        .board .black {
            background-color: #525252;
        }
    </style>
</head>

<body>


<?php 


$black_pawn = new Piece('p');
$white_queen = new Piece('Q');
 
echo $black_pawn;
echo $white_queen;


$a2 = new Square(1, 2);
$b2 = new Square(2, 2, $white_queen);
$c2 = new Square(3, 2, $black_pawn);
$d2 = new Square(4, 2);
echo $a2;
echo $b2;
echo $c2;
echo $d2;



?>





</body>

</html>