<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 06.03.2018
 * Time: 11:28
 */

class Model
{
    private $host = 'localhost';
    private $db_name = 'siolkowa_hala';
    private $username = 'siolkowa_hala';
    private $password = 'ZagrajMiCzarnyCyganie8';

    protected $db;

    public function __construct()
    {
        try{
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            $conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password, $opt);

            //kodowanie
            $conn -> exec('SET NAMES utf8');
            $this->db = $conn;

        }catch (PDOException $e){
            print "Connection error!: ".$e->getMessage()."<br/>";
            die();
        }
    }
}