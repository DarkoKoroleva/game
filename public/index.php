<?php

require_once ('../vendor/autoload.php');
ini_set("auto_detect_line_endings", true);

$num = 1;
$rooms = [];
$score = 0;

$content = explode(" ", file_get_contents('rooms.txt'));
$cost = 0;
foreach($content as $string){
    $rooms[]  = new \App\Room($num, $string);
    $num++;
}
$count = count($rooms);

$graph = [];
$f = fopen("adj.txt", "r");

for($i = 1; $i <= $count; $i++) {
    if ($i != $count) {
        $graph[$i] = explode(" ", fgets($f));
        $j = count($graph[$i]);
        $c = strlen($graph[$i][$j - 1]) - 2;
        $graph[$i][$j - 1] = substr($graph[$i][$j - 1], 0, $c);
    }
    else
        $graph[$i] = explode(" ", fgets($f));
}
fclose($f);
$g = new \App\Graph($graph);

$current_room = 0;

$adjacency = [];
for ($i = 0; $i<$count; $i++){
    for ($j = 0; $j<$count; $j++){
        $adjacency[$i][$j] = 0;
    }
}

for ($i = 0; $i<$count; $i++){
    if (!empty($graph[$i+1])) {
        foreach ($graph[$i+1] as $vertex) {
            $adjacency[$i][$vertex-1] = 1;
        }
    }
}

$next_room = 0;
while ($current_room != $count-1){
    $score += $rooms[$current_room]->visit();
    $rooms[$current_room]->place($graph);
    $next_room = intval(fgets(STDIN)) - 1;
    while ($next_room > $count){
        echo "There is no such room, choose another room to move around\n";
        $rooms[$current_room]->place($graph);
        $next_room = intval(fgets(STDIN)) - 1;
    }

    while ($adjacency[$current_room][$next_room]!=1){
        if ($next_room == $current_room){
            $rooms[$current_room]->place($graph);
            $next_room = intval(fgets(STDIN)) - 1;
            while ($next_room > $count){
                echo "There is no such room, choose another room to move around\n";
                $rooms[$current_room]->place($graph);
                $next_room = intval(fgets(STDIN)) - 1;
            }
        }
        else {
            echo "You cannot go from room ". $current_room+1 . " to ". $next_room+1 . ". Choose another way\n";
            $rooms[$current_room]->place($graph);
            $next_room = intval(fgets(STDIN)) - 1;
            while ($next_room > $count){
                echo "There is no such room, choose another room to move around\n";
                $rooms[$current_room]->place($graph);
                $next_room = intval(fgets(STDIN)) - 1;
            }
        }
    }
    $current_room = $next_room;
}

echo "You have reached the finish line, congratulations! Your account is $score\n";
$g->BFS(1, $count);
