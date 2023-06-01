<?php
    session_start();
    echo '<pre>';

    print_r($_POST);

    echo '</pre>';

    //Montando o texto
    $titulo = str_replace('#','-',$_POST['titulo']);
    $categoria = str_replace('#','-',$_POST['categoria']);
    $descricao = str_replace('#','-',$_POST['descricao']);

    $texto = $titulo.'#'.$categoria.'#'.$descricao.PHP_EOL.'#'.$_SESSION['id'];
    
    $arquivo = fopen('arquivo.hd','a');

    //Escrevendo texto no arquivo
    fwrite($arquivo,$texto);

    //Fechando o arquivo
    fclose($arquivo);

    //echo $texto;
    header('Location: abrir_chamado.php')
?>