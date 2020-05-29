<?php 
class ScoreBoardStats{
	
	private $remainingRunstoScore;
	
	//Get remaining runs to score
	public function getRemainingRuns(){
		
		return $this->remainingRunstoScore;
	}
	
	// Set the total run to score 
	public function setTotalRuns($runs){
		
		$this->remainingRunstoScore = $runs;
	}
	
	// Virat scores 50, remainig runs 
	public function scoreRuns($runsScoreByVirat){
		
		$this->setTotalRuns($this->remainingRunstoScore - $runsScoreByVirat);
	}
}
?>