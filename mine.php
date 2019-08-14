<?php
    class mine{
        private $bMine = false;
        private $iNeighbours = 0;
        private $bClicked = false;
        private $positionX;
        private $positionY;
        /**
         * set if the field is a mine or not and the position in the board
         */
        public function __construct( bool $mine, int $posX, int $posY ){
            $this->bMine = $mine;
            $this->positionX = $posX;
            $this->positionY = $posY;
        }
        /**
         * count the mines around the field
         * @param array $mines the array with the position of the mines
         */
        public function countNeighbourMines(array $mines){
            //row over the field
            if ( isset($mines[ ($this->positionY-1).($this->positionX-1) ] )) $this->iNeighbours+=1;
            if ( isset($mines[ ($this->positionY-1).($this->positionX)   ] )) $this->iNeighbours+=1;
            if ( isset($mines[ ($this->positionY-1).($this->positionX+1) ] )) $this->iNeighbours+=1;
            //row byond the field
            if ( isset($mines[ ($this->positionY+1).($this->positionX-1) ] )) $this->iNeighbours+=1;
            if ( isset($mines[ ($this->positionY+1).($this->positionX)   ] )) $this->iNeighbours+=1;
            if ( isset($mines[ ($this->positionY+1).($this->positionX+1) ] )) $this->iNeighbours+=1;
            //field on the left/right
            if ( isset($mines[ ($this->positionY).($this->positionX-1)   ] )) $this->iNeighbours+=1;
            if ( isset($mines[ ($this->positionY).($this->positionX+1)   ] )) $this->iNeighbours+=1;
        }
        /**
         * checks if i am a mine
         * @return true if $bMine is a mine
         */
        public function isMine(){
            return $this->bMine;
        }
        /**
         * sh0ws all 0r n0thing
         * @return string
         */
        public function show(bool $winOrLoose){
            if ( $winOrLoose ){
                if ( $this->bClicked ){
                    return $this->iNeighbours;
                } else {
                    return "-";
                }
            } else {
                if ( $this->bMine ){
                    return "X";
                } else {
                    return $this->iNeighbours;
                } 
            }
        }
        /**
         * set the is checked to show the fields content
         * @param bool $click true if the field is proof
         */
        public function setChecked(bool $click){
            $this->bClicked = $click;
        }
    }
?>
