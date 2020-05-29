<?php
require "/www/classes/RunsToScore.php";

class RunsToScoreTest extends PHPUnit_Framework_Testcase
{
	
	public $RunsToScoreTestCase;
	
	public function setUp(){
		
		$this->RunsToScoreTestCase = new ScoreBoardStats();
	}
	
	public function testCaseCheck(){
		
		// Total run to score 100
		$this->RunsToScoreTestCase->setTotalRuns(100);
		
		// Virat scores 50
		$this->RunsToScoreTestCase->scoreRuns(50);
		
		// check if remaining run is 50 after Virat scores 50
		$this->assertEquals(50, $this->RunsToScoreTestCase->getRemainingRuns());	
		
	}
}
?>