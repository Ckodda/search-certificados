<?php
namespace Rycconsulting\GestorCertificados\Controllers;

use PDO;
use PDOException;
use Rycconsulting\GestorCertificados\Libs\Database;

class CertificadoController{

    public function findByDni($dni)
    {
        try {
            $cnx = (new Database)->connect();
            if($cnx instanceof PDOException){
                return $cnx->getMessage();
            }
            $results = $cnx->query("SELECT *,alumno.nombre,certificado.nombre as CursoDiplomado FROM alumno INNER JOIN certificado ON certificado.id_alumno = alumno.id WHERE alumno.dni = '$dni' AND certificado.publicado = true AND alumno.publicado = true");
            $results = $results->fetchAll(PDO::FETCH_OBJ);
            return $results;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }

}
?>