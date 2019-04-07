<html>
<head>
	<title>teste</title>
	<meta charset="UTF-8">
</head>
<?php
	$email="";
	$senha="";
	$Erro="";
	
	if(isset($_POST['email']))
		$email=$_POST['email'];
	else
		$Erro=$Erro."<span style='color:red'>Email não informado</span><br/>";
	if(isset($_POST['senha']))
		$senha=$_POST['senha'];
	else
		$Erro= $Erro."<span style='color:red'>Senha não informada</span><br/>";
	$mysqli = mysqli_connect("localhost","root","usbw",	"test", 3307);
	if($mysqli->connect_errno)
		$Erro= $Erro."<span style='color:red'>Houve um problema com a coexção com o banco de dados</span><br/>";
	$com="SELECT nomeCompleto, saldo, logins FROM usuarios_login WHERE email LIKE '".$email."' AND senha LIKE '".$senha."';";
	if ($result=mysqli_query($mysqli,$com)){
		While($row=mysqli_fetch_row($result)){
			$nome=$row[0];
			$saldo=$row[1];
			$logins=$row[2];
		}
		mysqli_free_result($result);
		$loginsfim=intval($logins)+1;
		$saldofim=floatval($saldo)-.05;
		$comando="UPDATE usuarios_login SET logins=".$loginsfim.", saldo=".$saldofim." WHERE email LIKE '".$email."';";
		if(mysqli_query($mysqli,$comando)){
			date_default_timezone_set("America/Sao_Paulo");
			$d=date("Y-m-d H:i:s");
			session_start();
				$_SESSION["nome"]=$nome;
				$_SESSION["email"]=$email;
				$_SESSION["senha"]=$senha;
				$_SESSION["saldo"]=$saldo;
				$_SESSION["dataAcesso"]=$d;
			session_destroy();
			echo "<span>Olá ".$nome."!<br/> Seu saldo é de ".$saldofim.", e sua conta foi acessada ".$logins." vezes até o momento. </span>";
		}
		else 
			$Erro= $Erro."<span style='color:red'>Houve um erro inesperado</span><br/>";
	}	
?>