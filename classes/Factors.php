<?php

class TrueSkillCalc{
	private $norm = new Normal();
	private $mu_naught;
	private $sigma_naught;
	private $beta_squared;
	private $tau_squared;
	private $p1;
	private $p2
	public function __construct($p1, $p2, $mu_naught = 25){
		$this->p1 = $p1;
		$this->p2 = $p2;
		$this->mu_naught = $mu_naught;
		$this->sigma_naught = $mu_naught/3;
		$this->beta_squared = pow(($sigma_naught/2),2);
		$this->tau_squared = pow(($sigma_naught/100),2);
	}
	public function tau2($sig){
		return pow($sig/100,2);
	}
	public function Beta2($sig){
		return pow(/2,2);
	}
	private function drawFactor($P, $sig, $n1 = 1, $n2 = 2){
		return $norm->icdf(($P+1)/2)*sqrt($n1 + $n2)*sqrt(Beta2($sig));
	}
	private function v($t,$e){
		return normal($t-$e)/pdf($t-$e);
	}
	private function w($t,$e){
		return v($t,$e) * (v($t,$e) + $t - $e);
	}
	private function c2($sig1, $sig2){
		return 2*
	}

}