<?php

namespace src\Classes\Plan;

class Plan
{

	private $connMysql;
	private $month;
	private $year;
	private $totalPlan;



	public function __construct($pdo,$geography) {

		$this->connMysql = $pdo;
		$this->month = date('m');
        $this->year = date('Y');
        if ($this->month < 10) {
            $this->month = $this->month[1];
        }
        $this->geography = $geography;
        $this->setTotalPlan();
	}

	private function setTotalPlan()
	{
		$sql = "SELECT SUM(valor) as valor FROM planta_mensal WHERE geografia = '$this->geography' 
        AND indicador = 'Planta-(Tudo)' AND mes = '$this->month' AND ano = '$this->year'";
        $sql = $this->connMysql->prepare($sql);
		$sql->execute() or die(print_r($sql->errorInfo(), true));
        $plan = $sql->fetch();
		$plan = $plan['valor'];
		if ($plan > 1) {
			$this->totalPlan = $plan;
		} else {
			$this->month = $this->month - 1;
			$sql = "SELECT SUM(valor) as valor FROM planta_mensal WHERE geografia = '$this->geography' 
			AND indicador = 'Planta-(Tudo)' AND mes = '$this->month' AND ano = '$this->year'";
			$sql = $this->connMysql->prepare($sql);
			$sql->execute() or die(print_r($sql->errorInfo(), true));
			$plan = $sql->fetch();
			$plan = $plan['valor'];
			$this->totalPlan = $plan;
		}

	}

	public function getTotalPlan()
	{
		return $this->totalPlan;
	}

}




?>