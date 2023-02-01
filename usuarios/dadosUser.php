<?php

    require_once('../conexao.php');

    $postjson = json_decode(file_get_contents('php://input'), true);

    $usu_id = $postjson['usu_id'];

    $query = $pdo->prepare("SELECT * from usuarios WHERE usu_id = :usu_id");
    $query_con->bindValue(":id", $id);
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){ 

        for($i=0; $i < $total_reg; $i++){
            foreach ($res[$i] as $key => $value){	}
            
            $dados[] = array(
                'usu_id' => $res[$i]['usu_id'],
                'usu_nome' => $res[$i]['usu_nome'],
                'usu_email' => $res[$i]['usu_email'],
                'usu_cpf' => $res[$i]['usu_cpf'],
                'usu_senha' => $res[$i]['usu_senha'],
                'usu_nivel' => $res[$i]['usu_nivel']
            );  
        }
        $result = json_encode(array('itens'=>$dados));
        echo $result;

    }else{
        $result = json_encode(array('itens'=> '0'));
        echo $result;
    }


?>