<? 

require("../common.php");
require("../lib/GetPais.php"); 

$id = $_GET['id'];

?>

<html>
<head>
<?php 

CheckFormParameters(array("id"));

$conn = new Connection;

$conn->Open();

$sql = " select " .
       "    id," .
       "    nome" .
       " from pais where id = '$id'";

$query = $conn->CreateQuery($sql);

SaguAssert($query && $query->MoveNext(),"Registro não encontrado!");

list ( $id,
       $nome) = $query->GetRowValues();

$query->Close();
$conn->Close();

?>
</head>
<body bgcolor="#FFFFFF" marginwidth="20" marginheight="20">
<form method="post" action="post/altera_pais.php" name="myform">
  <table border="0" width="90%" align="center" cellspacing="2" height="40" align="center">
    <tr bgcolor="#000099" align "center">
      <td height="35" colspan="2" align="center">
        <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#CCCCFF">Altera&ccedil;&atilde;o de Países</font></b></font>
      </td>
    </tr>
    <tr>
      <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;C&oacute;digo&nbsp;</font></td>
      <td> <font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#0000FF"><? echo($id); ?>
        <input type="hidden" name="id" value="<? echo($id); ?>">
        </font></td>
    </tr> 
    <tr> 
      <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Nome</font></td>
      <td> 
        <input name="nome" type=text size="50" value="<? echo($nome); ?>">
      </td>
    </tr>
    <tr> 
      <td colspan="2"> 
        <hr size="1">
      </td>
    </tr>
    <tr> 
      <td align="center" colspan="2"> 
        <input type="submit" name="Submit"  value=" Salvar ">
        <input type="button" name="Submit2" value=" Voltar " onclick="javascript:history.go(-1)">
      </td>
    </tr>
  </table>
</form>
</body>
</html>
