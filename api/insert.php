<?php

require('../config.php');

$method = strtoupper($_SERVER['REQUEST_METHOD']);

if($method === 'POST'){

    $titulo = filter_input(INPUT_POST, 'titulo');
    $corpo = filter_input(INPUT_POST, 'corpo');

    if($titulo && $corpo){

        $sql = $pdo -> prepare('INSERT INTO notes(titulo, corpo) VALUES(:titulo, :corpo)');
        $sql -> bindValue(':titulo', $titulo);
        $sql -> bindValue(':corpo', $corpo);
        $sql -> execute();

        $id = $pdo -> lastInsertId();

        $array['resultado'] = [
            'id' => $id,
            'titulo' => $titulo,
            'corpo' => $corpo
        ];

    }else{
        $array['error'] = "Preencha os campos corretamente";
    }

} else {
    $array['error'] = 'Metodo nao permitido (apenasPOST)';
}

require('../return.php');