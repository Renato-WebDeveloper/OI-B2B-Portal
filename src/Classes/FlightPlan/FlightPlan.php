<?php

namespace src\Classes\FlightPlan;

use Datetime;

class FlightPlan {

    private $connMysql;
    private $date;
    private $month;
    private $year;


    public function __construct($pdo)
    {
        $this->connMysql = $pdo;
        $this->month = date('m');
        $this->year = date('Y');
        $this->date = $this->year.'-'.$this->month.'-01';
    }

    public function arraySupervision()
    {
        $array = [];
        $sql = "SELECT * FROM planta_analitica_sup_count WHERE supervisao IS NOT NULL ORDER BY supervisor";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $array = $sql->fetchAll();
            return $array;
        } else {
            return $array;
        }
    }

    public function totalEntry($supervision) 
    {
        
        $sql = "SELECT count(*) as total FROM base_bdCorr_sup WHERE supervisao = '$supervision' AND uf != 'MA' 
        AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
        AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND _cliente != 'OI MOVEL SA EM RECUPERACAO JUDICIAL' 
        AND fechamento >= '$this->date'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $row = $sql->fetch();
        } else{
            $row['total'] = 0;
        }

        if ($this->month < 10) {
            $month = $this->month[1];
        }


        $sql = "SELECT count(*) as total FROM base_reparos_r1_sup WHERE geografia_2 = 'GRJ'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'PROJETO ESCOLA', 'EMPRESARIAL') AND u_f = 'RJ' AND uf != 'RJ' 
        AND supervisao = '$supervision' AND mes = '$month' AND ano_fechamento = '$this->year' ";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $row2 = $sql->fetch();
        } else{
            $row2['total'] = 0;
        }

        $sql = "SELECT count(*) as total FROM base_reparos_r2_sup WHERE geografia = 'GRJ'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'PROJETO ESCOLA', 'EMPRESARIAL')
        AND supervisao = '$supervision' AND mes = '$month' AND ano_encerramento = '$this->year' ";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $row3 = $sql->fetch();
        } else{
            $row3['total'] = 0;
        }
        
        
        $total = $row['total'] + $row2['total'] + $row3['total'];
        return $total;
        
    }

    public function planSupervisionTotal()
    {
        $sql = "SELECT SUM(total) as total FROM planta_analitica_sup_count";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $planSupervisionTotal = $sql->fetch();
        } else {
            $planSupervisionTotal['total'] = 0;
        }
        return $planSupervisionTotal['total'];
    }


    public function projectionSupervision($totalEntrySupervision, $planSupervisionTotal)
    {
        $month = date('m');
        $year = date('Y');
        $day = date('d');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $wheithMonth = 0;
        for ($days=1; $days<=$daysInMonth; $days++) {
            $date = new DateTime();
            $date->setDate($year, $month, $days);
            //$day = $date->format('d');
            $dayWeek = $date->format('N');
            if ($dayWeek > 6) {
                //echo $dayWeek."domingo<br/>";
                $wheithMonth = $wheithMonth + 0.25;
            } elseif($dayWeek == 6) {
                //echo $dayWeek."é sábado<br/>";
                $wheithMonth = $wheithMonth + 0.5;
            } elseif($dayWeek < 6) {
                //echo $dayWeek."é dia de semana<br/>;
                $wheithMonth = $wheithMonth + 1;
            }
        }
        //echo $wheithMonth;
        $weigthOnline =0;
        for ($days=1; $days <= $day ; $days++) { 
            $date = new DateTime();
            $date->setDate($year, $month, $days);
            $dayWeek = $date->format('N');
            if ($dayWeek > 6) {
                //echo $dayWeek."domingo<br/>";
                $weigthOnline = $weigthOnline + 0.25;
            } elseif($dayWeek == 6) {
                //echo $dayWeek."é sábado<br/>";
                $weigthOnline = $weigthOnline + 0.5;
            } elseif($dayWeek < 6) {
                //echo $dayWeek."é dia de semana<br/>;
                $weigthOnline = $weigthOnline + 1;
            }
        }
        //echo $weigthOnline;

        $media = $totalEntrySupervision / $weigthOnline;
        $total = ceil($media * $wheithMonth);
        $projectionSupervision = ($total / $planSupervisionTotal) * 100;
        $projectionSupervision = substr($projectionSupervision, 0,4);
        $array = array($projectionSupervision, $total);
        return $array;
        
    }


    public function repeatedRepairs($supervision)
    {

        if ($this->month < 10) {
            $month = $this->month[1];
        }


        $sql = "SELECT count(*) as total_vult_repeated FROM base_reparos_r1_sup WHERE repetido = 'S' AND geografia_2 = 'GRJ'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND u_f = 'RJ' AND uf != 'RJ' AND mes = '$month'
        AND ano_fechamento = '$this->year' AND supervisao = '$supervision'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $repeated = $sql->fetch();           
        } else {
            $repeated['total_vult_repeated'] = 0;
        }

        $repeatedVult = $repeated['total_vult_repeated'];


        $sql = "SELECT count(*) as total_vult_repeated FROM base_reparos_r2_sup WHERE repetido = 'S' AND geografia = 'GRJ'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$month'
        AND ano_encerramento = '$this->year' AND supervisao = '$supervision'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $repeatedR2 = $sql->fetch();           
        } else {
            $repeatedR2['total_vult_repeated'] = 0;
        }

        $repeatedVultR2 = $repeatedR2['total_vult_repeated'];
        


        $sql = "SELECT count(*) as total FROM base_bdCorr_sup
        WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
        AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND _cliente != 'OI MOVEL SA EM RECUPERACAO JUDICIAL'
        AND _reinc_30 = 'S' AND supervisao = '$supervision' AND fechamento >= '$this->date'"; 
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        $repeatedCorr = $sql->fetch();
          if ($sql->rowCount()>0) {
        } else {
            $repeatedCorr['total'] = 0;
        }

        $totalRepeated = $repeatedCorr['total'] + $repeatedVult + $repeatedVultR2;

        return $totalRepeated;
    }


    public function onTimeRepairs($supervision)
    {

        if ($this->month < 10) {
            $month = $this->month[1];
        }                           


        $sql = "SELECT count(*) as ontime_repairs FROM base_reparos_r1_sup WHERE prazo = '1' AND geografia_2 = 'GRJ'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND u_f = 'RJ' AND uf != 'RJ' AND mes = '$month'
        AND ano_fechamento = '$this->year' AND supervisao = '$supervision'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $onTime = $sql->fetch();           
        } else {
            $onTime['ontime_repairs'] = 0;
        }

        $onTimeVult = $onTime['ontime_repairs'];


        $sql = "SELECT count(*) as ontime_repairs FROM base_reparos_r2_sup WHERE no_prazo = 'S' AND geografia = 'GRJ'
        AND segmento_b2b IN ('CORPORATIVO', 'ATACADO', 'EMPRESARIAL', 'PROJETO ESCOLA') AND mes = '$month'
        AND ano_encerramento = '$this->year' AND supervisao = '$supervision'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()>0) {
            $onTimeR2 = $sql->fetch();           
        } else {
            $onTimeR2['ontime_repairs'] = 0;
        }

        $onTimeVultR2 = $onTimeR2['ontime_repairs'];


        $sql = "SELECT count(*) as total FROM base_bdCorr_sup
        WHERE uf != 'MA' AND _cliente != 'BRASIL TELECOM COMUNICACAO MULTIMIDIA LTDA' 
        AND _cliente != 'TELEMAR NORTE LESTE SA EM RECUPERACAO JUDICIAL' AND _cliente != 'OI MOVEL SA EM RECUPERACAO JUDICIAL'
        AND igq = 'Dentro' AND supervisao = '$supervision' AND fechamento >= '$this->date'"; 
        $sql = $this->connMysql->prepare($sql);
        $sql->execute();
        $onTimeCorr = $sql->fetch();
          if ($sql->rowCount()>0) {
        } else {
            $onTimeCorr['total'] = 0;
        }

        $totalOnTime = $onTimeCorr['total'] + $onTimeVult + $onTimeVultR2;

        return $totalOnTime;
    }





} 