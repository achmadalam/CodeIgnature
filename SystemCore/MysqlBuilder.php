<?php 
namespace SystemCore;

class MysqlBuilder extends QueryBuilder {
    public function escape($str) {
            return "'" . $str . "'";
    }

    public function limit($limit,$offset){
        $this->limit = " Limit ".$limit.",".$offset;
    }
}
?>