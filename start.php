<?php
require_once("./board.php");
class start{
    private $oBoard;
    /**
     * the game
     */
    public function __construct(){
        $this->oBoard = new board(25,20,30);
        $running = true;
        $message = "";
        while($running == true){
            $this->oBoard->showBoard(true);
            echo "Abort with \"q\" or insert coordinates x,y: \n";
            $handle = fopen ("php://stdin","r");
            $line = fgets($handle);
            if(trim($line) == 'q' ){
                echo "ABORTING!\n";
                $running = false;
            } else {
                $tmpXY = explode(",",$line);
                if ( $this->oBoard->checkMine( (int)$tmpXY[0], (int)$tmpXY[1]) ){
                    $running = false;
                    $message = "You loose";
                } else {
                    $this->oBoard->getField( (int)$tmpXY[0], (int)$tmpXY[1] )->setChecked(true);
                    if ( $this->oBoard->checkWin() ){
                        $running = false;
                        $message = "You win";
                    }
                }
            }
        }
        $this->oBoard->showBoard(false);
        echo $message;
    }
}
//the game
new start();
?>
