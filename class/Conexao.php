<?php
abstract class Conexao
{
  const HOST = "localhost";
  const USER = "root";
  const PASS = "root";
  const DB = "sucurihc_ctf";
  
  private static $instance = null;
  
  private static function conectar(){
      try {
        if(self::$instance == null):
            $dsn= "mysql:host=" . self::HOST . ";dbname=" . self::DB;
            self::$instance = new PDO($dsn,self::USER, self::PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        endif;
      } catch (Exception $e) {
          echo "Erro " . $e->getMessage();
      }
      return self::$instance;
  }
  
  protected static function getDB(){
      return self::conectar();
  }
}
