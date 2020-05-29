<?php 
require "/classes/RunsToScore.php";

$runInstance =  new ScoreBoardStats();

$runInstance->setTotalRuns(100);

// Virat scores 50
$runInstance->RunsToScoreTestCase->scoreRuns(50);

echo $runInstance->getRemainingRuns();

?>