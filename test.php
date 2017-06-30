<?php

$bet_ini = 0.01;
$money_ini = 0.50;

$money = $money_ini;
$bet = $bet_ini;
$success = 0;
$loose = 0;
$success_row = 0;
$loose_row = 0;
$money_end = 0;
$money_endl = 0;
// 1 black 2 white
$type = 2;

for($j = 0; $j < 1000; $j++) {
	for($i = 0; $i < 240 && $money > 0; $i++) {
		$nb = rand(0, 14);
		if ($nb == 0){
			$money -= $bet;
			$bet*= 2;
		} elseif ($nb >= 1 && $nb <= 7){ //black
			if ($type == 1) {
				$money -= $bet;
				$money += $bet * 2;
				$bet = $bet_ini;
				$success_row++;
				$loose_row = 0;
			} else {
				$money = $money - $bet;
				$bet*= 2;
				$success_row = 0;
				$loose_row++;		
			}
		} elseif ($nb >= 8 && $nb <= 14){ //white
			if ($type == 2) {
				$money -= $bet;
				$money += $bet * 2;
				$bet = $bet_ini;
				$success_row++;
				$loose_row = 0;
			} else {
				$money = $money - $bet;
				$bet*= 2;
				$success_row = 0;
				$loose_row++;
			}
		}
		if ($success_row >= 4 && $type == 1) {
			$type = 2;
			$success_row = 0;
		} elseif ($success_row >= 4 && $type == 2) {
			$type = 1;
			$success_row = 0;
		}
		if ($loose_row >= 3) {
			$bet /= 2;
			$loose_row = 0;
		}
	}
if ($money >= $money_ini) {
	$success++;
	$money_end += $money;
} elseif ($money >= 0) {
	$loose++;
	$money_endl += $money;
}
$money = $money_ini;
$bet = $bet_ini;
$success_row = 0;
$type = 2;
}

echo (($success / 1000)*100)."\n";
echo ($money_end / $success)."\n";
echo (($loose / $success)*100)."\n";
echo ($money_endl / $loose)."\n";