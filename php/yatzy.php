<?php

class Yatzy
{   

    public function __construct($d1, $d2, $d3, $d4, $d5)
    {
        $this->dice = array_fill(0, 6, 0);
        $this->dice[0] = $d1;
        $this->dice[1] = $d2;
        $this->dice[2] = $d3;
        $this->dice[3] = $d4;
        $this->dice[4] = $d5;
    }

    public static function chance($d1, $d2, $d3, $d4, $d5)
    {
        $arguments = func_get_args();
        $total = array_sum ($arguments);
        return $total;
    }

    public static function yatzyScore(array $dice)
    {
        foreach ($dice as $die) {
            if ($die != $dice[0]) {
                return 0;
            }
        }
        return 50;
    }

    public static function ones($d1, $d2, $d3, $d4, $d5)
    {
        $arguments = func_get_args();
        $sum = 0;

        foreach ($arguments as $argument) {
            if ($argument == 1) {
                $sum += 1;
            }
        }
        return $sum;
    }

    public static function twos($d1, $d2, $d3, $d4, $d5)
    {
        $arguments = func_get_args();
        $sum = 0;

        foreach ($arguments as $argument) {
            if ($argument == 2) {
                $sum += 2;
            }
        }
        return $sum;
    }

    public static function threes($d1, $d2, $d3, $d4, $d5)
    {
        $arguments = func_get_args();
        $sum = 0;

        foreach ($arguments as $argument) {
            if ($argument == 3) {
                $sum += 3;
            }
        }
        return $sum;
       
    }

    public function fours()
    {   
        $sum = 0;
        foreach($this->dice as $num){
            if($num == 4){
                $sum += 4;
            }
        }
        return $sum;
    }

          

    public function Fives()
    {
        $sum = 0;
        foreach($this->dice as $num){
            if($num == 5){
                $sum += 5;
            }
        }
        return $sum;
    }

    public function sixes()
    {
        $sum = 0;
        foreach($this->dice as $num){
            if($num == 6){
                $sum += 6;
            }
        }
        return $sum;
    }

    public static function score_pair($d1, $d2, $d3, $d4, $d5)
    {   
        $arguments = func_get_args();
        $values = array_count_values($arguments);
        $highestPair = 0;
        foreach ($values as $dice=>$reps){
            if($reps == 2){
                 if($dice > $highestPair){
                     $highestPair = $dice;
                 }
            }
        }
        return $highestPair * 2;
        
    }

    public static function two_pair($d1, $d2, $d3, $d4, $d5)
    {
        $counts = array_fill(0, 6, 0);
        $counts[$d1 - 1] += 1;
        $counts[$d2 - 1] += 1;
        $counts[$d3 - 1] += 1;
        $counts[$d4 - 1] += 1;
        $counts[$d5 - 1] += 1;
        $n = 0;
        $score = 0;
        for ($i = 0; $i != 6; $i++)
            if ($counts[6 - $i - 1] >= 2) {
                $n = $n + 1;
                $score += (6 - $i);
            }

        if ($n == 2)
            return $score * 2;
        else
            return 0;
    }

    public static function three_of_a_kind($d1, $d2, $d3, $d4, $d5)
    {
        $t = array_fill(0, 6, 0);
        $t[$d1 - 1] += 1;
        $t[$d2 - 1] += 1;
        $t[$d3 - 1] += 1;
        $t[$d4 - 1] += 1;
        $t[$d5 - 1] += 1;
        for ($i = 0; $i != 6; $i++)
            if ($t[$i] >= 3)
                return ($i + 1) * 3;
        return 0;
    }

    public static function smallStraight($d1, $d2, $d3, $d4, $d5)
    {
        $tallies = array_fill(0, 6, 0);
        $tallies[$d1 - 1] += 1;
        $tallies[$d2 - 1] += 1;
        $tallies[$d3 - 1] += 1;
        $tallies[$d4 - 1] += 1;
        $tallies[$d5 - 1] += 1;
        if ($tallies[0] == 1 &&
            $tallies[1] == 1 &&
            $tallies[2] == 1 &&
            $tallies[3] == 1 &&
            $tallies[4] == 1)
            return 15;
        return 0;
    }

    public static function largeStraight($d1, $d2, $d3, $d4, $d5)
    {
        $tallies = array_fill(0, 6, 0);
        $tallies[$d1 - 1] += 1;
        $tallies[$d2 - 1] += 1;
        $tallies[$d3 - 1] += 1;
        $tallies[$d4 - 1] += 1;
        $tallies[$d5 - 1] += 1;
        if ($tallies[1] == 1 &&
            $tallies[2] == 1 &&
            $tallies[3] == 1 &&
            $tallies[4] == 1 &&
            $tallies[5] == 1)
            return 20;
        return 0;
    }

    public static function fullHouse($d1, $d2, $d3, $d4, $d5)
    {
        $tallies = [];
        $_2 = false;
        $i = 0;
        $_2_at = 0;
        $_3 = False;
        $_3_at = 0;

        $tallies = array_fill(0, 6, 0);
        $tallies[$d1 - 1] += 1;
        $tallies[$d2 - 1] += 1;
        $tallies[$d3 - 1] += 1;
        $tallies[$d4 - 1] += 1;
        $tallies[$d5 - 1] += 1;

        foreach (range(0, 5) as $i) {
            if ($tallies[$i] == 2) {
                $_2 = True;
                $_2_at = $i + 1;
            }
        }

        foreach (range(0, 5) as $i) {
            if ($tallies[$i] == 3) {
                $_3 = True;
                $_3_at = $i + 1;
            }
        }

        if ($_2 && $_3)
            return $_2_at * 2 + $_3_at * 3;
        else
            return 0;
    }
}
