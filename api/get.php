<?php

require('../config.php');

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if($method === 'GET'){

    $id = filter_input(INPUT_GET, 'id');

    if($id){
        $sql = $pdo -> prepare('SELECT * FROM notes WHERE id=:id');
        $sql -> bindValue(':id', $id);
        $sql -> execute();

        if($sql -> rowCount() > 0){

            $data = $sql -> fetch(PDO::FETCH_ASSOC);
            $array['resultado'] = [
                'id' => $data['id'],
                'titulo' => $data['titulo'],
                'corpo' => $data['corpo']
            ];

        }else{
            $array['error'] = 'ID inexistente';
        }
    }else{
        $array['error'] = 'ID nao enviado';
    }

} else {
    $array['error'] = 'Metodo nao permitido (apenasGET)';
}

require('../return.php');