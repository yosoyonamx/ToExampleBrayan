<?php
    require_once "../config/conexion.php";
    class categoria extends Conexion{
        public function listar_categorias(){
            return Conexion::get('categoria','id');
        }
        public function verificar_categoria($titulo){
            $sql = "SELECT titulo FROM categoria where titulo=:titulo";
            $query = Conexion::conectar()->prepare($sql);
            $query->bindParam(':titulo',$titulo,PDO::PARAM_STR);
            $query->execute();
            return $query->fetchColumn();
        }
        public function ingresar_categoria($array){
            $sql = "INSERT into categoria(titulo,url) values(?,?)";
            $query = Conexion::conectar()->prepare($sql);
            // return $query->execute([$array['titulo'],$array['url'],$array['img']]);
            return $query->execute([$array['titulo'],$array['url']]);
        }
        public function editar_categoria($array){
            $sql = "UPDATE categoria set titulo=?, url=? where id=?";
            $query = Conexion::conectar()->prepare($sql);
            return $query->execute([$array['titulo'],$array['url'],$array['id']]);
        }
        public function borrar_categoria($id){
            return Conexion::delete('categoria','id',$id);
        }
    }
?>