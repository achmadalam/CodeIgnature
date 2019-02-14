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

    public function getInsertSql($table = '', $fields = []) {
        $fieldString = implode(',', array_keys($fields));
        $fieldValueBind = rtrim(str_repeat('?,', count($fields)), ',');
        
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$fieldValueBind})";
        return $sql;
    }
    
    public function baseInsert($table = '', $fields = []) {
        $sql = $this->getInsertSql($table, $fields);
        return $this->query($sql, array_values($fields));
    }
    
    public function getUpdateSql($table = '', $conditions = [], $fields = []) {
        $fieldString = [];
        foreach ($fields as $key => $field)
        $fieldString[] = $key . ' = ?';
        $fieldString = implode(',', $fieldString);
        $conditionString = $this->where($conditions);
        
        $sql = "UPDATE {$table} SET {$fieldString} {$conditionString}";
        return $sql;
    }
    
    public function baseUpdate($table = '', $conditions = [], $fields = []) {
        $sql = $this->getUpdateSql($table, $conditions, $fields);
        return $this->query($sql, array_values($fields));
    }
    
    public function getDeleteSql($table = '', $conditions = []) {
        $conditionString = $this->where($conditions);
        $sql = "DELETE FROM {$table} {$conditionString}";
        return $sql;
    }
    
    public function baseDelete($table = '', $conditions = []) {
        $sql = $this->getDeleteSql($table, $conditions);
        return $this->query($sql);
    }

}
?>