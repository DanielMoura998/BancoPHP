<?php

$nome =  $_POST[ "nome" ];
$email = $_POST[ "email" ];
$senha = $_POST[ "senha" ];

$conn = new PDO("mysql:dbname=TelaLogin;host=localhost","root","etec");

$stmt = $conn->prepare(" insert into DadosClientes(email, senha, nome) VALUES(:email,:senha,:nome);");

$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);

$stmt->execute();

header ("location: TelaLogin.hmtl");
exit;