<?php

namespace src\Classes\CardOff;

class CardOff 
{

    private $connMysql;
    private $month;
    private $year;
    private $geography;

    private $totalRepairsR1;
    private $totalRepairsR2;
    private $totalRepairs;
    private $totalRepairsPercent;

    private $totalRepeatedR1;
    private $totalRepeatedR2;
    private $totalRepeated;
    private $totalRepeatedPercent;

    private $totalOnTimeR1;
    private $totalOnTimeR2;
    private $totalOnTime;
    private $totalOnTimePercent;

    private $totalTmrR1;
    private $totalTmrR2;
    private $totalTmr;
    private $totalTmrPercent;

    private $totalMassiveFailures; 

    public function __construct($pdo,$geography) 
    {
        $this->connMysql = $pdo;
        $this->geography = $geography;
        $this->setLastDate();

        $this->setTotalRepairsR1();
        $this->setTotalRepairsR2();
        $this->setTotalRepairs();
        $this->setTotalRepairsPercent();
        
        $this->setTotalRepeatedR1();
        $this->setTotalRepeatedR2();
        $this->setTotalRepeated();
        $this->setTotalRepeatedPercent();

        $this->setTotalOnTimeR1();
        $this->setTotalOnTimeR2();
        $this->setTotalOnTime();
        $this->setTotalOnTimePercent();

        $this->setTotalTmrR1();
        $this->setTotalTmrR2();
        $this->setTotalTmr();
        $this->setTotalTmrPercent();

        $this->setTotalMassiveFailures();
    }

    //escopo de data
    public function setLastDate()
    {
        $sql = "SELECT MAX(id) as last_id FROM base_reparos_r1 WHERE geografia_2 = '$this->geography'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        $row = $sql->fetch();
        $last_id = $row['last_id'];
        
        $sql = "SELECT * FROM base_reparos_r1 WHERE id = '$last_id'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        $row = $sql->fetch();
        $this->month = $row['mes'];
        $this->year = $row['ano_fechamento'];
    }


    //Entradas
    private function setTotalRepairsR1() 
    {
        $sql = "SELECT count(*) as total_repairs_r1 FROM base_reparos_r1 WHERE geografia_2 = '$this->geography'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'PROJETO ESCOLA', 'EMPRESARIAL') AND mes = '$this->month'
        AND ano_fechamento = '$this->year' ";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        
        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
            $this->totalRepairsR1 = $row['total_repairs_r1'];
        } else {
            $this->totalRepairsR1 = 0;
        }
    }

    private function setTotalRepairsR2() 
    {
        $sql = "SELECT count(*) as total_repairs_r2 FROM base_reparos_r2 WHERE geografia = '$this->geography'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'PROJETO ESCOLA', 'EMPRESARIAL') AND mes = '$this->month'
        AND ano_encerramento = '$this->year' ";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
            $this->totalRepairsR2 = $row['total_repairs_r2'];
        } else {
            $this->totalRepairsR2 = 0;
        }


    }

    private function setTotalRepairs() 
    {
        $this->totalRepairs = $this->totalRepairsR1 + $this->totalRepairsR2;;
    }

    private function setTotalRepairsPercent() 
    {
        $sql = "SELECT SUM(valor) as valor FROM planta_mensal WHERE geografia = '$this->geography' 
        AND indicador = 'Planta-(Tudo)' AND mes = '$this->month' AND ano = '$this->year'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        if ($sql->rowCount()>0) {
            $plan = $sql->fetch();
            $plan = $plan['valor'];
            $total = $this->totalRepairs / $plan;
            $total = $total * 100;
            $total = substr($total, 0, 5)."%";
            $this->totalRepairsPercent = $total;
        } else {
            $this->totalRepeatedPercent = 0;
        }

    }

    public function getTotalRepairs()
    {
        return $this->totalRepairs;
    }

    public function getTotalRepairsPercent()
    {
        return $this->totalRepairsPercent;
    }


    //Repetidos
    private function setTotalRepeatedR1() 
    {
        $sql = "SELECT count(*) as total_repeated_r1 FROM base_reparos_r1 WHERE geografia_2 = '$this->geography'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month' 
        AND ano_fechamento = '$this->year' AND repetido = 'S'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount()>0 ) {
            $row = $sql->fetch();
            $this->totalRepeatedR1 = $row['total_repeated_r1'];
        } else {
            $this->totalRepeatedR1 = 0;
        }


    }

    private function setTotalRepeatedR2() 
    {
        $sql = "SELECT count(*) as total_repeated_r2 FROM base_reparos_r2 WHERE geografia = '$this->geography'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month' 
        AND ano_encerramento = '$this->year' AND repetido = 'S'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCOunt()>0) {
            $row = $sql->fetch();
            $this->totalRepeatedR2 = $row['total_repeated_r2'];
        } else {
            $this->totalRepeatedR2 = 0;
        }


    }

    private function setTotalRepeated() 
    {
        $this->totalRepeated = $this->totalRepeatedR1 + $this->totalRepeatedR2;
    }

    private function setTotalRepeatedPercent() 
    {
        $total = ($this->totalRepeated / $this->totalRepairs)*100;
        $total = substr($total, 0, 6)."%";
        $this->totalRepeatedPercent = $total;
    }

    public function getTotalRepeated()
    {
        return $this->totalRepeated;
    }

    public function getTotalRepeatedPercent()
    {
        return $this->totalRepeatedPercent;
    }


    //No prazo
    public function setTotalOnTimeR1() 
    {
        $sql = "SELECT count(*) as total_on_time_r1 FROM base_reparos_r1 WHERE geografia_2 = '$this->geography'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month' 
        AND ano_fechamento = '$this->year' AND prazo = '1'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        
        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $this->totalOnTimeR1 = $row['total_on_time_r1'];
        } else {
            $this->totalOnTimeR1 = 0;
        }


    }

    public function setTotalOnTimeR2() 
    {
        $sql = "SELECT count(*) as total_on_time_r2 FROM base_reparos_r2 WHERE geografia = '$this->geography'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month' 
        AND ano_encerramento = '$this->year' AND no_prazo = 'S'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
            $this->totalOnTimeR2 = $row['total_on_time_r2'];
        } else {
            $this->totalOnTimeR2 = 0;
        }



    }

    public function setTotalOnTime() 
    {
        $this->totalOnTime = $this->totalOnTimeR1 + $this->totalOnTimeR2;
    }

    public function setTotalOnTimePercent() 
    {
        $total = ($this->totalOnTime / $this->totalRepairs)*100;
        $total = substr($total, 0, 6)."%";
        $this->totalOnTimePercent = $total;
    }

    public function getTotalOnTime()
    {
        return $this->totalOnTime;
    }

    public function getTotalOnTimePercent()
    {
        return $this->totalOnTimePercent;
    }


    //TMR
    private function setTotalTmrR1() 
    {
        $sql = "SELECT SUM(tempo_bd_hs_2) as total_tmr_r1 FROM base_reparos_r1 WHERE geografia_2 = '$this->geography'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month' AND ano_fechamento = '$this->year'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount() > 0) {
            $row = $sql->fetch();
            $this->totalTmrR1 = $row['total_tmr_r1'];
        } else {
            $this->totalTmrR1 = 0;
        }


    }

    private function setTotalTmrR2() 
    {
        $sql = "SELECT SUM(tempo_bd_hs) as total_tmr_r2 FROM base_reparos_r2 WHERE geografia = '$this->geography'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month' AND ano_encerramento = '$this->year'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
            $this->totalTmrR2 = $row['total_tmr_r2'];
        } else {
            $this->totalTmrR2 = 0;
        }


    }

    private function setTotalTmr() 
    {
        $this->totalTmr = $this->totalTmrR1 + $this->totalTmrR2;
    }

    private function setTotalTmrPercent() 
    {
        $total = $this->totalTmr / $this->totalRepairs;
        $total = substr($total, 0, 5);
        $this->totalTmrPercent = $total;
    }

    public function getTotalTmr()
    {
        return $this->totalTmr;
    }

    public function getTotalTmrPercent()
    {
        return $this->totalTmrPercent;
    }
    

    //Falhas massivas
    public function setTotalMassiveFailures() 
    {
        $sql = "SELECT count(*) as total_found_ok_r1 FROM base_reparos_r1
        WHERE geografia_2 = '$this->geography' AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month'
        AND ano_fechamento = '$this->year' AND grupo_causa_raiz = 'ENCONTRADO OK'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
            $resultR1 = $row['total_found_ok_r1'];
        } else {
            $resultR1 = 0;
        }



        $sql = "SELECT count(*) as total_found_ok_r2 FROM base_reparos_r2
        WHERE geografia = '$this->geography' AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month'
        AND ano_encerramento = '$this->year' AND grupo_causa_raiz = 'ENCONTRADO OK'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
            $resultR2 = $row['total_found_ok_r2'];
        } else {
            $resultR2 = 0;
        }



        $foundOk = $resultR1 + $resultR2;

        $sql = "SELECT count(*) as total_vulto_event_r1 FROM base_reparos_r1
        WHERE geografia_2 = '$this->geography' AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month'
        AND ano_fechamento = '$this->year' AND grupo_causa_raiz = 'EVENTO DE VULTO'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount()> 0) {
            $row = $sql->fetch();
            $resultR1 = $row['total_vulto_event_r1'];
        } else {
            $resultR1 = 0;
        }



        $sql = "SELECT count(*) as total_vulto_event_r2 FROM base_reparos_r2
        WHERE geografia = '$this->geography' AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month'
        AND ano_encerramento = '$this->year' AND grupo_causa_raiz = 'EVENTO DE VULTO'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
            $resultR2 = $row['total_vulto_event_r2'];
        } else {
            $resultR2 = 0;
        }



        $vultoEvent = $resultR1 + $resultR2;

        $sql = "SELECT count(*) as total_optical_network_r1 FROM base_reparos_r1
        WHERE geografia_2 = '$this->geography' AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month'
        AND ano_fechamento = '$this->year' AND grupo_causa_raiz = 'REDE OPTICA'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount() >0) {
            $row = $sql->fetch();
            $resultR1 = $row['total_optical_network_r1'];
        } else {
            $resultR1 = 0;
        }



        $sql = "SELECT count(*) as total_optical_network_r2 FROM base_reparos_r2
        WHERE geografia = '$this->geography' AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$this->month'
        AND ano_encerramento = '$this->year' AND grupo_causa_raiz = 'REDE OPTICA'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));

        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
            $resultR2 = $row['total_optical_network_r2'];
        } else {
            $resultR2 = 0;
        }


        $opticalNetwork = $resultR1 + $resultR2;

        $number = 0.667;

        $this->totalMassiveFailures = ceil(($number * $foundOk) + $vultoEvent + $opticalNetwork);
    }    

    public function getTotalMassiveFailures()
    {
        return $this->totalMassiveFailures;
    }


}


?>
























