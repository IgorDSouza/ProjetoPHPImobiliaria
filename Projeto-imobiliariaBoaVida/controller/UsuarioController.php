<?php
require_once 'model/Usuario.php';

class UsuarioController{

    public static function salvar(){

        $usuario = new Usuario();

        $usuario->setId($_POST['id']);
        $usuario->setLogin($_POST['login']);
        $usuario->setSenha($_POST['senha1']);
        $usuario->setPermissao($_POST['permissao']);

        $usuario->save();
    }

    public static function listar(){
        $usuarios = new Usuario();
        return $usuarios->listAll();
    }

    public static function editar($id){
        $usuario = new Usuario();

        $usuario = $usuario->find($id);

        return $usuario;
    }

    public static function excluir($id){
        $usuario = new Usuario();
        $usuario = $usuario->remove($id);
    }

    public static function logar(){
        $usuario = new Usuario();
        $usuario->setLogin($_POST['login']);
        $usuario->setSenha($_POST['senha']);

        $logado = $usuario->logar();
        $res = false;

        // usuario tenta logar

        if($logado == true  /* se encontrado no banco ele verifica a permissao */ ) {


            $verify = $logado->getPermissao();

            if($verify === "Administrador"){
                $res = true;
                // se for adm retorna true e vai aparecer as interações de adm(cadastro lista e etc)
            }else{
                // se for normal retorna false e vai aparecer as interações normais ( compra venda e etc)

                $res = false;

            }

        }


        

        
        return array(is_object($logado),$res);
    }

  
}

?>
