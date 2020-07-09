<?php

namespace src\Classes\Meta;

class Meta 
{
    private $connMysql;
    private $month;
    private $year;
    private $geography;


    public function __construct($pdo, $geography) 
    {
        $this->connMysql = $pdo;
        $this->month = date('m');
        $this->year = date('Y');
        if ($this->month < 10) {
            $this->month = $this->month[1];
        }
        $this->geography = $geography;
    }

    public function getEntryMeta() 
    {
        $sql = "SELECT * FROM meta WHERE regiao = '$this->geography' AND mes = '$this->month' AND ano = '$this->year' AND tp_meta = 'entrada'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        if ($sql->rowCount() > 0) {
            $meta = $sql->fetch();
            $meta = $meta['meta'];
            $meta = str_replace(',','.',$meta);
            return $meta;    
        } else {
            return false;
        }
    }   

    public function getRepeatedMeta() 
    {
        $sql = "SELECT * FROM meta WHERE regiao = '$this->geography' AND mes = '$this->month' AND ano = '$this->year' AND tp_meta = 'repetida'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        if ($sql->rowCount() > 0) {
            $meta = $sql->fetch();
            $meta = $meta['meta'];
            $meta = str_replace(',','.',$meta);  
            return $meta;  
        } else {
            return false;
        }
    }

    public function getOnTimeMeta() 
    {
        global $pdo;
        $sql = "SELECT * FROM meta WHERE regiao = '$this->geography' AND mes = '$this->month' AND ano = '$this->year' AND tp_meta = 'prazo'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        if ($sql->rowCount() > 0) {
            $meta = $sql->fetch();
            $meta = $meta['meta'];
            $meta = str_replace(',','.',$meta);  
            return $meta;  ;    
        } else {
            return false;
        }
    }

    public function getTmrMeta() 
    {
        $sql = "SELECT * FROM meta WHERE regiao = '$this->geography' AND mes = '$this->month' AND ano = '$this->year' AND tp_meta = 'tmr'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        if ($sql->rowCount() > 0) {
            $meta = $sql->fetch();
            $meta = $meta['meta'];
            $meta = str_replace(',','.',$meta);  
            return $meta;     
        } else {
            return false;
        }
    }

    public function getVolMeta() 
    {
        $sql = "SELECT * FROM meta WHERE regiao = '$this->geography' AND mes = '$this->month' AND ano = '$this->year' AND tp_meta = 'vol_entrada'";
        $sql = $this->connMysql->prepare($sql);
        $sql->execute() or die(print_r($sql->errorInfo(), true));
        if ($sql->rowCount() > 0) {
            $meta = $sql->fetch();
            $meta = $meta['meta'];
            $meta = str_replace(',','.',$meta);  
            return $meta;   
        } else {
            return false;
        }
    }


}






?>