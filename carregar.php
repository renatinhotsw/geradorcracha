<?php

  $con= mysqli_connect("localhost", "root", "");
  $baseSelecionada = mysqli_select_db($con,"cracha");

  $nome = $_POST['nome'];
  $funcao = $_POST['funcao'];
  $foto = $_FILES['foto']['tmp_name'];
  $tamanho = $_FILES['foto']['size'];
  $tipo = $_FILES['foto']['type'];
  $nomeArq = $_FILES['foto']['name'];

  if ( $foto != "none" )
  {
      $fp = fopen($foto, "rb");
      $conteudo = fread($fp, $tamanho);
      $conteudo = addslashes($conteudo);
      fclose($fp);

      $fp = fopen($foto, "rb");
      $conteudo = fread($fp, $tamanho);
      $conteudo = addslashes($conteudo);
      fclose($fp);
  }

  $queryInsercao = "INSERT INTO corretores(nome, funcao, foto) VALUES ('$nome', '$funcao','$foto')";


  mysqli_query($con,$queryInsercao) or die("<br>Algo deu errado ao inserir o registro. Tente novamente.");
  mysqli_connect_error();

  include('times.php');
  define('FPDF_FONTPATH', 'fpdf/font');

  require('fpdf.php');

  $pdf = new FPDF();
  $pdf -> AddPage();

  $pdf ->  SetFont('Times','B',14,true);


  $title = '';
  $pdf -> Cell(0,10,$title='IDENTIFICAÇÃO:',0,0,'C');
  utf8_decode($title);
  $pdf -> ln();
  $pdf->Image("fotos/".$nomeArq,0,0,-300);

  $pdf -> Cell(0,20,$txt='Nome:'.$nome,0,0,'C');
  $pdf -> ln();
  $pdf -> Cell(0,0,'Função:'.$funcao,0,0,'C');
  $pdf -> Output("arquivo.pdf","D");




  ?>
