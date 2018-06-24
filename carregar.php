<?php
  
  $con= mysqli_connect("localhost", "root", "");
  $baseSelecionada = mysqli_select_db($con,"cracha");


  $nome = $_POST['nome'];
  $funcao = $_POST['funcao'];
  $foto = $_FILES['foto']['tmp_name'];
  $tamanho = $_FILES['foto']['size'];
  $tipo = $_FILES['foto']['type'];
  $nomeArq = $_FILES['foto']['name'];

  echo "$nome<br>";
  echo "$funcao<br>";
  echo "$foto<br>";
  echo "$tamanho<br>";
  echo "$tipo";
  echo "$nomeArq";

    
  if ( $foto != "none" )
  {
      $fp = fopen($foto, "rb");
      $conteudo = fread($fp, $tamanho);
      $conteudo = addslashes($conteudo);
      fclose($fp);
    
  $queryInsercao = "INSERT INTO cracha(nome, funcao, foto) VALUES ('$nome', '$funcao','$foto')";
    
   
  mysqli_query($con,$queryInsercao) or die("<br>Algo deu errado ao inserir o registro. Tente novamente.");
  mysqli_connect_error();

  echo 'Registro inserido com sucesso!'; 
  header('Location: index.php');
   if(mysql_affected_rows($con) > 0)
       print "Grachá salvo na base de dados.";
   else
       print "Não foi possível salvar o crachá na base de dados.";
   }
  else
      print "Não foi possível carregar a foto.";
  ?>