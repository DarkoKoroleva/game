<?php

namespace App;

class Room
{
    public int $num;
    public Content $content;
    public int $power;
    public int $sale;

    public function __construct($number, $content)
    {
        $this->num = $number;
        switch ($content){
            case "Wazowski":
                $this->setContent(Content::Monster);
                $this->power = 5;
                $this->sale = 2;
                break;
            case "Sulley":
                $this->setContent(Content::Monster);
                $this->power = 10;
                $this->sale = 4;
                break;
            case "Smitty":
                $this->setContent(Content::Monster);
                $this->power = 7;
                $this->sale = 3;
                break;
            case "Treasure1":
                $this->setContent(Content::Treasure);
                $this->power = 5;
                $this->sale = 0;
                break;
            case "Treasure2":
                $this->setContent(Content::Treasure);
                $this->power = 10;
                $this->sale = 0;
                break;
            case "Treasure3":
                $this->setContent(Content::Treasure);
                $this->power = 15;
                $this->sale = 0;
                break;
            default:
                $this->setContent(Content::Empty);
                $this->power = 0;
                $this->sale = 0;
                break;
        }
    }


    public function fight():int
    {
        echo "In this room you met a monster with a strength of $this->power!\n";
        $hit = ceil(rand(0, 20));;
        while ($hit <= $this->power) {
            $this->power -= $this->sale;
            echo "You struck with a force of $hit. The monster has $this->power strength left. Try again! \n";
            $hit = ceil(rand(0, 20));
        }
        echo "You struck with a force of $hit. You have defeated the monster! You get $this->power points\n";

        $this->setContent(Content::Empty);
        $this->power = 0;
        $this->sale = 0;

        return $this->power;
    }

    public function loot(): int{
        $loot = ceil(rand (1, $this->power));
        echo "You have entered the treasure room! You get $loot points\n";

        $this->setContent(Content::Empty);
        $this->power = 0;
        $this->sale = 0;

        return $loot;
    }


    public function visit() : int{
        switch ($this->content){
            case Content::Monster:
                return $this->fight();
            case Content::Treasure:
                return $this->loot();
            default:
                echo "You visited an empty room\n";
                return 0;
        }
    }

    public function place($graph)
    {
        echo "You are in the room $this->num\n";
        echo "Choose the next room to visit: ";
        $sep = '';
        if (!empty($graph[$this->num])) {
            foreach ($graph[$this->num] as $vertex) {
                echo $sep, $vertex ;
                $sep = ', ';
            }
            echo "\n";
        }

    }

    function setContent($content): void {
        $this->content = $content;
    }
}