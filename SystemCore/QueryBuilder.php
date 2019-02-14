<?php 
namespace SystemCore;

class QueryBuilder {
    private $sql;
    private $table;
    private $limit;
    private $error;
    private $key;
    private $order;
    private $join;

    public function __construct($table,$key){
        $this->table = $table;
        $this->key = $key;
    }

    public function select($column = '*'){
        if($column == '*')
            $this->sql = "SELECT * FROM ".$this->table;
        else
            $this->sql = "SELECT ".$column." FROM ".$this->table;
    }

    public function join($join){
        if(is_array($join))
            $this->join[] = $join[0]." ".$join[1];
    }

    public function where($condition){
        if(is_array($condition))
            $this->condition[] = $condition[0]."".$condition[1];
    }

    public function limit($limit){
        $this->limit = " Limit ".$limit;
    }

    public function order($order){
        $this->order = " Order by".$order;
    }

    public function build(){
        $sql = $this->sql;
        $join = $this->join;
        $limit = $this->limit;
        $order = $this->order;

        $temp = $sql."<br/>".$join."<br/>".$limit."<br/>".$order;
        if(!empty($join))
            $temp .= "<br/>".$join;
        if(!empty($limit))
            $temp .= "<br/>".$limit;
        if(!empty($order))
            $temp .= "<br/>".$order;
        $this->sql = $temp;
    }

    public function getSQl(){
        return $this->sql;
    }

}
?>