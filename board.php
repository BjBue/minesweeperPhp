<?php
require_once("./mine.php");
    class board{
        private $aFields;
        private $aMines;
        private $iNumberOfMines = 0;
        private $iY = 0;
        private $iX = 0;
        private $checkedForMines = 0;
        /**
         * set the dimensions
         * create the randomized minefield
         * initialize the field board
         * @param int $mines the amount of mines
         * @param int $Y the columns ofg the board
         * @param int $X the rows of the board
         */
        public function __construct(int $mines, int $Y, int $X){
            //dimensions
            $this->iNumberOfMines = $mines;
            $this->iY = $Y;
            $this->iX = $X;
            //build the mines
            for ( $i=0; $i < $this->iNumberOfMines; $i++ ){
                $y = random_int(0, $this->iY);
                $x = random_int(0, $this->iX);
                $this->aMines[$y.$x]['y'] = $y;
                $this->aMines[$y.$x]['x'] = $x;
            }
            //init the board
            for ( $column=0; $column<$this->iY; $column++ ){
                for ( $row=0; $row<$this->iX; $row++){
                    if ( isset($this->aMines[$column.$row]) ){
                        $this->aFields[$column][$row] = new mine(true, $row, $column);
                    } else {
                        $this->aFields[$column][$row] = new mine(false, $row, $column);
                        $this->aFields[$column][$row]->countNeighbourMines($this->aMines);
                    }
                }
            }
        }
        /**
         * show the board on Console
         * @param bool $winOrLoose only smuggle through to the mineclass
         */
        public function showBoard(bool $winOrLoose){
            echo "   ";
            for ( $column=0; $column<$this->iX; $column++ ){ printf("%02d ", $column+1); }
            echo "\n";
            for ( $column=0; $column<$this->iY; $column++ ){
                printf("%02d ", $column+1);
                for ( $row=0; $row<$this->iX; $row++){
                    echo $this->aFields[$column][$row]->show($winOrLoose) . "  ";
                }
                echo "\n";
            }
        }
        /**
         * checks if the mine is a mine
         * @param int $x the x-position that should be checked
         * @param int $y the y-position that should be checked
         */
        public function checkMine(int $x, int $y){
            $this->checkedForMines++;
            return $this->aFields[($y-1)][($x-1)]->isMine();
        }
        /**
         * returns the field mine at the given position
         * @param int $x the x-position that should be checked
         * @param int $y the y-position that should be checked
         */
        public function getField(int $x, int $y){
            return $this->aFields[($y-1)][($x-1)];
        }
        /**
         * checks if there are only mines left
         * @return bool true if all fields are checked and only mines left
         */
        public function checkWin(){
            if ( (($this->iX * $this->iY) - ($this->checkedForMines + $this->iNumberOfMines)) == 0 ){ return true;  }
            else                                                                                    { return false; }
        }
    }
?>
