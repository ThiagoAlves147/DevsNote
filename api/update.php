<?php

require('../config.php');

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if($method === 'PUT'){

    parse_str(file_get_contents('php://input'), $input);

    $id = $input['id'] ?? null;
    $titulo = $input['titulo'] ?? null;
    $corpo = $input['corpo'] ?? null;

    $id = filter_var($id);
    $titulo = filter_var($titulo);
    $corpo = filter_var($corpo);

    if($id && $titulo && $corpo){

        $sql = $pdo -> prepare('SELECT * FROM notes WHERE id=:id');
        $sql -> bindValue(':id', $id);
        $sql -> execute();

        if($sql -> rowCount() > 0){

            $sql = $pdo -> prepare('UPDATE notes SET titulo=:titulo, corpo=:corpo WHERE id=:id');
            $sql -> bindValue(':id', $id);
            $sql -> bindValue(':titulo', $titulo);
            $sql -> bindValue(':corpo', $corpo);
            $sql -> execute();

            $array['resultado'] = [
                'id' => $id,
                'titulo' => $titulo,
                'corpo' => $corpo
            ];

        }else{
            $array['error'] = "ID inexistente";
        }

    }else{
        $array['error'] = "Dados nao enviados";
    }

} else {
    $array['error'] = 'Metodo nao permitido (apenasPOST)';
}

require('../return.php');