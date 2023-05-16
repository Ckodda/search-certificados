<?php
namespace Rycconsulting\GestorCertificados\Libs;

use PDO;

class Database{

    public $db;
    public $user;
    public $password;
    public $host;

    function __construct()
    {
        $this->db = 'certificados';
        $this->user = DB_USER != null ? DB_USER : 'root';
        $this->password = DB_PASSWORD != null ? DB_PASSWORD : '';
        $this->host = DB_HOST != null ? DB_HOST : 'localhost';
    }

    public function connect()
    {
        try {
            
            $cnx = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->password);

            $cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $cnx;
        } catch (\PDOException $e) {
            return $e;
        }
    }


}
?>