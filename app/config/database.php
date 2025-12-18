<?php
define ('DB_HOST', 'localhost');
define ('DB_NAME', 'lista_tarefas');
define ('DB_USER', 'root');
define ('DB_PASS', '');

$conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('Não foi possível conectar ao banco de dados.');