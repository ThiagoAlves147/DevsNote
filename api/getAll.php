<?php

require('../config.php');

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if($method === 'GET'){

    $sql = $pdo -> query('SELECT * FROM notes');
    if($sql -> rowCount() > 0){
        $data = $sql -> fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $item){
            $array['resultado'][] = [
                'id' => $item['id'],
                'titulo' => $item['titulo']
            ];
        }
    }   

} else {
    $array['error'] = 'Metodo nao permitido (apenasGET)';
}

require('../return.php');