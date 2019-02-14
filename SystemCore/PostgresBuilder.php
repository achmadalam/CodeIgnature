<?php 
namespace SystemCore;

class PostgresBuilder extends QueryBuilder {
    public function escape($str, $int = false) {
        if ($int) {
            $str = (int) $str;
        } else {
            $str = (String) $str;
        }
        if (function_exists('pg_escape_literal'))
            return pg_escape_literal($str);
        else
            return "'" . pg_escape_string($str) . "'";
    }
}
?>