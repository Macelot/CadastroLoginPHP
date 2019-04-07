<html>
<head>
	<title>teste</title>
	<meta charset="UTF-8">
</head>
<?php
	$nome="";
	$email="";
	$senha="";
	$confSenha="";
	$saldo="";
	$Erro="";
	if(isset($_POST['nome']))
		$nome=$_POST['nome'];
	else
		$Erro= $Erro."<span style='color:red'>Nome não informado</span><br/>";
	if(isset($_POST['email']))
		$email=$_POST['email'];
	else
		$Erro=$Erro."<span style='color:red'>Email não informado</span><br/>";
	if(isset($_POST['senha']))
		$senha=$_POST['senha'];
	else
		$Erro= $Erro."<span style='color:red'>Senha não informada</span><br/>";
	if(isset($_POST['confSenha']))
		$confSenha=$_POST['confSenha'];
	else
		$Erro= $Erro."<span style='color:red'>Confirmação de senha necessária</span><br/>";
	if(isset($_POST['saldo']))
		$saldo=$_POST['saldo'];
	else
		$Erro= $Erro."<span style='color:red'>Saldo não informado</span><br/>";
	$mysqli = mysqli_connect("localhost","root","usbw",	"test", 3307);
	if($mysqli->connect_errno)
		$Erro+= "<span style='color:red'>Houve um problema com a coexção com o banco de dados</span><br/>";
	$com="SELECT COUNT(*) FROM usuarios_login WHERE email LIKE '".$email."';";
	if ($result=mysqli_query($mysqli,$com)){
		$row=mysqli_fetch_row($result);
		$has=$row[0];
		if(intval($has)>0){
			$Erro= $Erro."<span style='color:red'>E-mail já cadastrado na base de dados</span><br/>";
		}
	}
	mysqli_free_result($result);
	
	if($senha!=$confSenha)
		$Erro=$Erro."<span style='color:red'>As senhas não conferem</span><br/>";
	$saldofim=str_replace(",",".",$saldo);
	if($Erro!="")
		echo $Erro;
	else
	{
		$comando="INSERT INTO usuarios_login (nomeCompleto, email, senha, saldo, logins) VALUES ('".$nome."','".$email."','".$senha."',".$saldofim.", 0);";
		if(mysqli_query($mysqli,$comando)){
			echo "Cadastro realizado com sucesso! :-)</br>";
		}else{
			echo "Erro".$mysqli->error;	
		} 
	}
?>