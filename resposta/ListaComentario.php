<?php
require_once("dbconect.php");
$record_set = array();
$sql = "SELECT * FROM tbl_comentarios ORDER BY co_id asc";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    array_push($record_set, $row);
  }
}
echo json_encode($record_set);
?>

<!--
  a linha $sql = "SELECT * FROM tbl_comentarios ORDER BY co_id asc"; define a consulta SQL
   para selecionar todos os campos da tabela "tbl_comentarios" ordenados pelo campo "co_id"
    em ordem ascendente. O objeto $result armazena o resultado da consulta,
     e o loop while itera através de cada registro no resultado e armazena em um array $record_set.
      Por fim, a função json_encode() é usada para converter o array em um formato JSON que pode ser
       exibido no navegador usando a função echo.
 -->

<!-- 
  Este código em PHP realiza uma consulta em uma tabela chamada "tbl_comentarios" para recuperar todos
   os registros dessa tabela. Em seguida, os registros são armazenados em um array chamado $record_set.
    Finalmente, a função json_encode() é usada para converter o array em formato JSON e exibir os dados
     na tela.
-->