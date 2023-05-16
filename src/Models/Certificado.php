<?php
namespace Rycconsulting\GestorCertificados\Models;

use PDOException;
use Rycconsulting\GestorCertificados\Libs\Database;

class Certificado{

    public function validTable($tablename)
    {
        $cnx = (new Database)->connect();
        if($cnx instanceof PDOException){
            return $cnx;
        }

        $result = $cnx->query("SHOW TABLES LIKE '$tablename'");
        $tableExists = $result !== false && $result->rowCount() > 0;
        return $tableExists;
    }

}
?>