<?php 
require "classes/RunsToScore.php";

$runInstance =  new ScoreBoardStats();

$runInstance->setTotalRuns(100);

// Virat scores 50
$runInstance->scoreRuns(86);  

echo "Runs Remaining ".$runInstance->getRemainingRuns();
?>