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
    private $condition;

    public function __construct($table,$key){
        $this->table = $table;
        $this->key = $key;
        $this->condition = array();
    }

    public function select($column = '*'){
        if($column == '*')
            $this->sql = "SELECT * FROM ".$this->table;
        else
            $this->sql = "SELECT ".$column." FROM ".$this->table;
    }

    public function join($join){
        if(is_array($join))
            $this->join = $join[0]." ".$join[1];
    }

    public function where($field, $value, $opr = '='){
        $this->condition = array_merge($this->condition,array($field." ".$opr." ".$this->escape($value)));
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
        $condition = $this->condition;
        
        $temp = $sql." ";

        if(!empty($join))
            $temp .= " ".$join;
        if(!empty($condition))
            $temp .= " where ".implode(" and ",$condition);
        if(!empty($limit))
            $temp .= " ".$limit;
        if(!empty($order))
            $temp .= " ".$order;
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