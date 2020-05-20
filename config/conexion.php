<?php
class Conexion
{
    public function conectar()
    {
        $baseUrl = "mysql:host=localhost;dbname=crud";
        $user = "root";
        $password = "";
        $conexion = new PDO($baseUrl, $user, $password);
        $conexion->exec('SET CHARACTER SET UTF8');
        return $conexion;
    }

    public function get($table, $id = null)
    {
        $sql = "SELECT * FROM $table ";
        if ($id) {
            $sql .= "ORDER by $id desc";
        }
        $query = Conexion::conectar()->prepare($sql);
        $query->execute();
        $array = [];
        while ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $fila);
        }
        return $array;
        $query->closeCursor();
    }
    public function delete($table, $atributo, $id)
    {
        $sql = "DELETE FROM $table where $atributo=?";
        $query = Conexion::conectar()->prepare($sql);
        $query->execute([$id]);
        $sql_auto_increment = "ALTER table $table AUTO_INCREMENT = 0";
        $query =  Conexion::conectar()->prepare($sql_auto_increment);
        return $query->execute();
    }
}
