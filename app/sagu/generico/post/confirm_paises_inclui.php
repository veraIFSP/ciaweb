<?php

require("../../common.php");

$nome = $_POST['nome'];

CheckFormParameters(array("nome"));
?>
<html>
<head>
</head>
<body bgcolor="#FFFFFF" marginwidth="20" marginheight="20">
<form method="post" action="paises_inclui.php" name="myform">
<table width="90%" align="center">
	<tr bgcolor="#000099">
		<td height="35" colspan="2">
		<div align="center"><font size="3"
			face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#CCCCFF">Confirme
		a Opera&ccedil;&atilde;o</font></b></font><font size="4"
			face="Verdana,
Arial, Helvetica, sans-serif"><b></b></font></div>
		</td>
	</tr>
	<tr valign="middle">
		<td colspan="2" height="34">
		<div align="right"><font color="#FF0000"
			face="Verdana, Arial, Helvetica, sans-serif" size="3"><b>Inclus&atilde;o
		de Países</b></font></div>
		<hr size="1">
		</td>
	</tr>
	<tr valign="middle">
		<td colspan="2" height="24"><font color="#FF0000" size="2"
			face="Verdana,
Arial, Helvetica, sans-serif">&nbsp;Verifique se os dados est&atilde;o
		corretos.</font></td>
	</tr>
	<tr valign="middle">
		<td colspan="2" height="15">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="42%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">Nome
		do País</font></td>
		<td bgcolor="#FFFFFF" width="58%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C"><b>
			<?php echo($nome); ?> </b></font></td>
	</tr>
	<tr>
		<td colspan="2">
		<hr size="1">
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="hidden" name="nome"
			value="<?echo($nome);?>"></td>
	</tr>
	<tr>
		<td align="center" colspan="2" align="center"><input type="submit"
			name="Submit" value=" Salvar "> <input type="reset" name="Submit2"
			value=" Alterar " onClick="history.go(-1)"></td>
	</tr>
</table>
</form>
</body>
</html>
