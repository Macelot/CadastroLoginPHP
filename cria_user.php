<meta charset="UTF-8">
<?php
$mysqli = new mysqli("localhost","root","usbw","test",3307);
if($mysqli->connect_errno){
	echo "<br>Erro na conexão";
}else{
	echo "<br>Deu certo a conexão";
}
$comando="DROP table usuarios_login";
$mysqli->query($comando);

$comando="CREATE TABLE IF NOT EXISTS `usuarios_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCompleto` varchar(100),
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `dataCadastro` timestamp DEFAULT CURRENT_TIMESTAMP,
  `logins` int(11) NOT NULL,
  `saldo` decimal(7,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  AUTO_INCREMENT=1 ;";
$mysqli->query($comando);



$comando="INSERT into usuarios_login ".
		" (nomeCompleto,email,senha,saldo) VALUES (
		'Marcelo','mar@server.com','123','5.00');";
if($mysqli->query($comando)){
	echo "<br>Deu certo a inserção";
}else{
	echo "<br>Erro na inserção".$mysqli->error;
}
echo "<br>".$comando;



?>
