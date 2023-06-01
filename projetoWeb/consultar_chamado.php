<?php 
require_once "validador_acesso.php";
class Chamado{
  function __construct($titulo, $categoria, $conteudo, $user_id)
  {
    $this->titulo = $titulo;
    $this->categoria = $categoria;
    $this->conteudo = $conteudo;
    $this->user_id = $user_id;
  }
  public string $titulo;
  public string $categoria;
  public string $conteudo;
  public int $user_id;
}?>

<?php
  //array de chamados

  $chamados = array();
  //http://php.net/manual/pt_BR/function.fopen.php
  //abrir arquivo.hd
  $arquivo = fopen('arquivo.hd','r');

  //enquato houverem registros (linhas) a serem recuperados
  while(!feof($arquivo)){ //testa pelo fim do arquivo
    //linhas
    $registro = fgets($arquivo);//recupera a linha
    $chamados[] = $registro;

  }

  foreach($chamados as $chamado)
  {
    //print_r($chamados);
    //print_r($chamado);
    $registroFiltrado = explode('#', $chamado);
    if(count($registroFiltrado) < 3)
      continue;
    $chamadoFinal = new Chamado(
      $registroFiltrado[0],
      $registroFiltrado[1],
      $registroFiltrado[2],
      $registroFiltrado[3]
    );
    if($_SESSION['cargo'] == "user")
    {
      if($chamadoFinal->user_id != $_SESSION['id'])
      {
        continue;
      }
    }
    $display[] = $chamadoFinal;
  }

  //fechando o arquivo.hd
  fclose($arquivo);

?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Help Desk
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="logoff.php" class="nav-link">
          SAIR
          </a>
        </li>
      </ul>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">
              
              <?php foreach($display as $chamado){ ?>
              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?= $chamado->titulo?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?= $chamado->categoria?></h6>
                  <p class="card-text"><?= $chamado->conteudo?></p>

                </div>
              </div>

              <?php } ?>

              <div class="row mt-5">
                <div class="col-6">
                  <a href="home.php" class="btn btn-lg btn-warning btn-block">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>