<?php
class Model {
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = [];
    function __construct($array, $sanitize = true){
        $this->loadFromArray($array, $sanitize);
    }
    public function loadFromArray($array, $sanitize = true){
        if ($array) {
            foreach ($array as $key => $value) {
                $cleanValue = $value;
                if ($sanitize && isset($cleanValue)) {
                    $cleanValue = strip_tags(trim($cleanValue));
                    $cleanValue = htmlspecialchars($cleanValue, ENT_NOQUOTES);
                }
                $this->$key = $cleanValue;
            }
        }
    }
    public function __get($key){
        return $this->values[$key] ?? null;
    }
    public function __set($key, $value){
        $this->values[$key] = $value;
    }
    public function getValues(){
        return $this->values;
    }
    public static function getOne($filters = [], $columns = '*'){
        //Pegando a classe que chamou o método get
        $class = get_called_class();
        $result = static::getResultSetFromSelect($filters, $columns);
        return $result ? new $class($result->fetch(PDO::FETCH_ASSOC), false) : null;
    }
    public static function get($filters = [], $columns = '*'){
        $objects = [];
        $result = static::getResultSetFromSelect($filters, $columns);
        if($result){
            //Pegando a classe que chamou o método get
            $class = get_called_class();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }
    public static function getResultSetFromSelect($filters, $columns = '*'){
        $sql = "SELECT {$columns} FROM "
            . static::$tableName
            . static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
        if($result->rowCount() === 0){
            return null;
        } 
        else {
            return $result;
        }
    }
    public static function getCount($filters = []){
        $result = static::getResultSetFromSelect($filters, 'count(*) as count');
        return $result->fetch(PDO::FETCH_ASSOC)['count'];
    }
    public function insert(){
        // Remove 'id' from columns if it's auto-increment
        $columns = array_filter(static::$columns, function($column) {
            return $column != 'id';
        });
        $columnsString = implode(',', $columns);
        $placeholders = implode(',', array_fill(0, count($columns), '?'));
        $sql = "INSERT INTO " . static::$tableName . " ($columnsString) VALUES ($placeholders)";
        $params = [];
        foreach ($columns as $column) {
            $params[] = $this->$column;
        }
        $id = Database::executeSQL($sql, $params);
        $this->id = $id;
    }
    public function update(){
        $sql = "UPDATE " . static::$tableName . " SET "
            . implode(' = ?, ', static::$columns) . ' = ? WHERE id = ?';
        $params = [];
        foreach (static::$columns as $column) {
            $params[] = $this->$column;
        }
        $params[] = $this->id;
        Database::executeSQL($sql, $params);
    }
    public function delete(){
        static::deleteById($this->id);
    }
    public static function deleteById($id){
        $sql = "DELETE FROM " . static::$tableName . " WHERE id = ?";
        Database::executeSQL($sql, [$id]);
    }
    public static function getFilters($filters){
        $sql = '';
        if(count($filters) > 0){
            $sql .= " WHERE 1 = 1";
            foreach($filters as $column => $value){
                if($column == 'raw'){
                    $sql .= " AND {$value}";
                } 
                else {
                    $sql .= " AND {$column} = " . static::getFormatedValue($value);
                }
            }
        }
        return $sql;
    }
    public static function getFormatedValue($value){
        if(is_null($value)){
            return "null";
        } 
        elseif(gettype($value) == 'string'){
            return "'{$value}'";
        } 
        else {
            return $value;
        }
    }
}