<?php

namespace src\Classes\CardOnline;

class CardOnline 
{

    private $connMysql;
    private $totalRepairsOnline;
    private $totalRepairsFinallyR1AndR2;
    private $totalRepairsRepeated;
    private $totalRepairsOnTime;
    private $totalPercentFinally;
    private $percentRepeated;
    private $percentOnTime;
    private $plan;
    

    public function __construct($pdo, $plan)
    {
        $this->connMysql = $pdo;
        $this->plan = $plan;
        $this->setTotalRepairsOnline();
        $this->setTotalRepairsFinallyR1AndR2();
        $this->setTotalPercentFinally();
        $this->setTotalRepairsRepeated();
        $this->setTotalRepairsOnTime();
        $this->setPercentRepeated();
        $this->setPercentOnTime();
    }


    private function setTotalRepairsOnline()
    {
    	$sql = "SELECT count(*) as total FROM base_bdON";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
           $result = $sql->fetch();
           $this->totalRepairsOnline = $result['total'];
        } else {
           $this->totalRepairsOnline = 0;
        }
    }


    public function getTotalRepairsOnline()
    {
     	return $this->totalRepairsOnline;
    }


    private function setTotalRepairsFinallyR1AndR2()
    {
        $year = date('Y');
        $month = date('m');
        $date = $year."-".$month."-01";

        $sql = "SELECT count(*) as total_r2 FROM base_reparos_r2 WHERE geografia = 'GRJ' AND segmento_b2b != 'OUTROS' AND mes = '$month' AND ano_encerramento = '$year'" ;
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
           $resultR2 = $sql->fetch();
        } else {
           $resultR2 = 0;
        }
    
        $sql = "SELECT count(*) as total_r1 FROM base_bd_corr 
        WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
        AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND fechamento >= '$date'"; //verificar depois a OI TELECOM PRA REMOVER
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $result = $sql->fetch();
            $this->totalRepairsFinallyR1AndR2 = $result['total_r1'] + $resultR2['total_r2'];
        } else {
            $this->totalRepairsFinallyR1AndR2 = 0;
        }
    }


    public function getTotalRepairsFinallyR1AndR2()
    {
        return $this->totalRepairsFinallyR1AndR2;
    }


    private function setTotalRepairsRepeated() 
    {

        $year = date('Y');
        $month = date('m');
        $date = $year."-".$month."-01";

        $sql = "SELECT count(*) as total_r2 FROM base_reparos_r2 WHERE geografia = 'GRJ' AND segmento_b2b != 'OUTROS' AND mes = '$month' AND ano_encerramento = '$year' AND repetido = 'S'" ;
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $resultR2 = $sql->fetch();
        } else {
           $resultR2 = 0;
        }

        $sql = "SELECT count(*) as total_r1 FROM base_bd_corr 
        WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
        AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND fechamento >= '$date' AND _reinc_30 = 'S'"; //verificar depois a OI TELECOM PRA REMOVER
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $result = $sql->fetch();
            $this->totalRepairsRepeated = $result['total_r1'] + $resultR2['total_r2'];
        } else {
             $this->totalRepairsRepeated = 0;
        }
    }


    public function getTotalRepairsRepeated()
    {
        return $this->totalRepairsRepeated;
    }


    private function setTotalRepairsOnTime() 
    {

        $year = date('Y');
        $month = date('m');
        $date = $year."-".$month."-01";

        $sql = "SELECT count(*) as total_r2 FROM base_reparos_r2 WHERE geografia = 'GRJ' AND segmento_b2b != 'OUTROS' AND mes = '$month' AND ano_encerramento = '$year' AND no_prazo = 'S'" ;
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $resultR2 = $sql->fetch();
        } else {
           $resultR2 = 0;
        }

        $sql = "SELECT count(*) as total_r1 FROM base_bd_corr 
        WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
        AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND fechamento >= '$date' AND igq = 'Dentro'"; //verificar depois a OI TELECOM PRA REMOVER
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $result = $sql->fetch();
            $this->totalRepairsOnTime = $result['total_r1'] + $resultR2['total_r2'];
        } else {
            $this->totalRepairsOnTine = 0;
        }
    }

    public function getTotalRepairsOnTime()
    {
        return $this->totalRepairsOnTime;
    }


    private function setTotalPercentFinally() 
    {
        $totalPercentFinally = ($this->totalRepairsFinallyR1AndR2 / $this->plan)*100;
        $totalPercentFinally = substr($totalPercentFinally,0,5)."%";
        $this->totalPercentFinally = $totalPercentFinally;
    }

    public function getTotalPercentFinally()
    {
        return $this->totalPercentFinally;
    }


    private function setPercentRepeated()
    {
        $percentRepeated = ($this->totalRepairsRepeated / $this->totalRepairsFinallyR1AndR2)*100;
        $percentRepeated = substr($percentRepeated,0,6)."%";
        $this->percentRepeated = $percentRepeated;
    }

    public function getPercentRepeated()
    {
        return $this->percentRepeated;
    }


    private function setPercentOnTime()
    {
        $percentOnTime = ($this->totalRepairsOnTime / $this->totalRepairsFinallyR1AndR2)*100;
        $percentOnTime = substr($percentOnTime,0,6)."%";
        $this->percentOnTime = $percentOnTime;
    }

    public function getPercentOnTime()
    {
        return $this->percentOnTime;
    }

}



?>