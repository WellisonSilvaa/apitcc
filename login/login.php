<?php

    require_once('../conexao.php');

    $postjson = json_decode(file_get_contents('php://input'), true);
    
    
   
    $usuario = $postjson['usuario'];
    $senha = $postjson['senha'];
    
    if($usuario == ""){
        echo json_encode(array('mensagem'=>'Preencha o campo Usuario'));
        exit();
    }    
    
    if($senha == ""){
        echo json_encode(array('mensagem'=>'Preencha o campo Senha'));
        exit();
    }
    
        $query_con = $pdo->prepare("SELECT * from usuarios WHERE usu_email = :usuario AND usu_senha = :senha");
        $query_con->bindValue(":usuario", $usuario);
        $query_con->bindValue(":senha", $senha);
        $query_con->execute();
        $res = $query_con->fetchAll(PDO::FETCH_ASSOC);
        if(@count($res) > 0){

            $dados = array(
                'usu_id' => $res[0]['usu_id'],
                'usu_nome' => $res[0]['usu_nome'],
                'usu_email' => $res[0]['usu_email'],
                'usu_assinante' => $res[0]['usu_assinante'],
                'usu_senha' => $res[0]['usu_senha'],
                'usu_nivel' => $res[0]['usu_nivel']
            );  

            $result = json_encode(array('mensagem'=>'Logado com Sucesso', 'ok'=> true, 'usu' => $dados));
            echo $result;
        }else{
            $result = json_encode(array('mensagem'=>'Dados Inválidos', 'ok'=> false));
            echo $result;
        }
  
    
    


   
        

?>