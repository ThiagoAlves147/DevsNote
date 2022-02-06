<?php

require('../config.php');

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if($method === 'DELETE'){

    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'] ?? null;

    $id = filter_var($id);

    if($id){

        $sql = $pdo -> prepare('DELETE FROM notes WHERE id=:id');
        $sql -> bindValue(':id', $id);
        $sql -> execute();

    }else{
        $array['error'] = "ID nao enviado";
    }

} else {
    $array['error'] = 'Metodo nao permitido (apenas DELETE)';
}

require('../return.php');