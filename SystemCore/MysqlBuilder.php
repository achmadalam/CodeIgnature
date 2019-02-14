<?php 
namespace SystemCore;

class MysqlBuilder extends QueryBuilder {
    public function limit($limit,$offset){
        $this->limit = " Limit ".$limit.",".$offset;
    }
}
?>