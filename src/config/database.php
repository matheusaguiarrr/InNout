<?php
class Database {
    public static function getConnect(){
        //Caminho completo do arquivo env.ini contendo as variáveis de ambiente do banco de dados
        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        //Carregando as variáveis de ambiente
        $env = parse_ini_file($envPath);
        try{
            $connection = new \PDO
                (
                    "mysql:
                    host={$env['host']};
                    dbname={$env['database']}", 
                    $env['username'], 
                    $env['password']
                );
            return $connection;
        }
        catch(\PDOException $exception){
            die("Erro: " . $exception->getMessage());
        }
    }
    public static function getResultFromQuery($sql){
        $connection = self::getConnect();
        $result = $connection->prepare($sql);
        $result->execute();
        $connection = null;
        return $result;
    }
    public static function executeSQL($sql, $params = []){
        $connection = self::getConnect();
        $stmt = $connection->prepare($sql);
        if(!$stmt->execute($params)){
            throw new \Exception($stmt->errorInfo()[2]);
        }
        $id = $connection->lastInsertId();
        $connection = null;
        return $id;
    }
}