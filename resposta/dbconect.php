<?php
$conn = mysqli_connect("localhost", "root", "", "comentarios_db");
$conn->set_charset('utf8_spanish2_ci');


?>

<!--
  mysqli_connect() é usada para conectar ao banco de dados MySQL especificado.
   Os parâmetros passados ​​para a função são os seguintes:

    "localhost" indica que o banco de dados está hospedado no mesmo servidor que o script PHP.

    "root" é o nome do usuário usado para acessar o banco de dados.

    "" é a senha usada para acessar o banco de dados. Neste caso, a senha está em branco,
     o que significa que não há senha definida.

    "comentarios_db" é o nome do banco de dados.

Depois que a conexão é estabelecida, o método set_charset() é usado para definir
 a codificação de caracteres da conexão. Neste caso é "utf8_spanish2_ci".
 -->