<?php

require("../common.php");
require("../lib/GetField.php");
require("../lib/SQLCombo.php");


if($_POST){
	$id = $_POST['id'];
}elseif($_GET){
	$id = $_GET['id'];
}

function Lista_Complemento($id, $ref_campus)
{
	
	$conn = new Connection;
	$conn->open();
	$sql = " select A.id, " .
       	  "        A.ref_disciplina_ofer, " .
          "        get_dia_semana(A.dia_semana), " .
          "        B.ref_professor, " .
          "        pessoa_nome(B.ref_professor), " .
          "        get_turno(A.turno), " .
          "        A.desconto, " .
          "        A.num_creditos_desconto, " .
          "        A.num_sala, " .
          "        A.observacao " .
          " from disciplinas_ofer_compl A FULL OUTER JOIN disciplinas_ofer_prof B " .
          " USING(ref_disciplina_ofer) " .
    	  " WHERE  A.ref_disciplina_ofer='$id' " .
          " order by A.dia_semana; ";

	$query = $conn->CreateQuery($sql);
	
        echo("<center><table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">");

	$i=1;
	$j=0;

	// cores fundo
	$bg0 = "#000000";
	$bg1 = "#EEEEFF";
	$bg2 = "#FFFFEE";

	// cores fonte
	$fg0 = "#FFFFFF";
	$fg1 = "#000099";
	$fg2 = "#000099";

	while( $query->MoveNext() )
	{
		list ($id,
		$ref_disciplina_ofer,
		$dia_semana,
		$ref_professor,
		$professor,
		$turno,
		$desconto,
		$num_creditos_desconto,
		$num_sala,
		$observacao) = $query->GetRowValues();
	
                $professor = empty($professor) ? "<strong>sem professor</strong>" : $professor;	 

		if ($i == 1)
		{
			echo("<tr>");
			echo ("<td bgcolor=\"#000099\" colspan=\"12\"><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FFFFFF\"><center><b>Informações Complementares</b></center></font></td>");
			echo("</tr>");
			echo ("<tr bgcolor=\"#000000\">\n");
			echo ("<td width=\"5%\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>Ofer</b></font></td>");
                        echo ("<td width=\"2%\">&nbsp;</td>");
                        echo ("<td width=\"25%\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>Professor</b></font></td>");
                        echo ("<td width=\"8%\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>Op&ccedil;&otilde;es</font></td>");
			echo ("<td width=\"13%\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>Dia</b></font></td>");
			echo ("<td width=\"10%\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>Turno</b></font></td>");
			echo ("<td width=\"10%\" align=\"center\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>Desconto</b></font></td>");
			echo ("<td width=\"10%\" align=\"center\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>Sala</b></font></td>");
			echo ("<td width=\"5%\" align=\"center\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>Créditos</b></font></td>");
			echo ("<td width=\"5%\" align=\"center\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>Obs.</b></font></td>");
			echo ("  </tr>");
		}
		 
		$href1  = "<a href=\"disciplina_ofer_compl_edita.php?id=$id&ref_campus=$ref_campus&ref_professor=$ref_professor\">$ref_disciplina_ofer</a>";
		$href3  = "<a href=\"disciplina_ofer_prof.php?ref_disciplina_ofer=$ref_disciplina_ofer&id_disciplina_ofer_compl=$id\"><img src=\"../images/add.gif\" title='Adiciona mais um professor a disciplina' align='absmiddle' border=0></a>";

                $href4 = "<a href=\"javascript:Confirma_Exclui_Prof('$ref_disciplina_ofer','$ref_professor', '$professor')\"><img src=\"../images/delete.gif\" title='Exclui o professor a disciplina' align='absmiddle' border=0></a>";


		if ($aux_id == $id)
		{
			$href2  = "<center><img src=\"../images/etc.gif\" title='Disciplina ministrada por mais de um Professor' align='absmiddle' border=0></center>";
		}
		else
		{
			$href2 = "&nbsp;";
		}

                if ( $i % 2) { $bg = $bg1; } else { $bg = $bg2; }

		echo("<tr bgcolor=\"$bg\">\n");
		echo ("<td width=\"5%\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\">$href1</font></td>");
		echo ("<td width=\"2%\">$href2</td>");
                echo ("<td width=\"25%\"><Font face=\"Verdana\" size=\"2\" color=\"$fg1\">$professor&nbsp;</td>");
                echo ("<td width=\"8%\"><Font face=\"Verdana\" size=\"2\" color=\"#ffffff\"><b>$href3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$href4</b></font></td>");
		echo ("<td width=\"13%\"><Font face=\"Verdana\" size=\"2\" color=\"$fg1\">$dia_semana&nbsp;</td>");
		echo ("<td width=\"10%\"><Font face=\"Verdana\" size=\"2\" color=\"$fg1\">$turno&nbsp;</td>");
		echo ("<td width=\"10%\" align=\"center\"><Font face=\"Verdana\" size=\"2\" color=\"$fg1\">$desconto&nbsp;</td>");
		echo ("<td width=\"10%\" align=\"center\"><Font face=\"Verdana\" size=\"2\" color=\"$fg1\">$num_sala&nbsp;</td>");
		echo ("<td width=\"5%\" align=\"center\"><Font face=\"Verdana\" size=\"2\" color=\"$fg1\">$num_creditos_desconto&nbsp;</td>");
                echo ("<td width=\"5%\" align=\"center\"><Font face=\"Verdana\" size=\"2\" color=\"$fg2\">$observacao&nbsp;</td>");
		echo("  </tr>");

		$i++;
		$aux_id = $id;
	}

	echo("</table></center>");

	@$query->Close();
}


CheckFormParameters(array("id"));

$conn = new Connection;

$conn->Open();

$sql = " select " .
       "    id, " .
       "    ref_campus, " .
       "    ref_curso, " .
       "    ref_periodo, " .
       "    turma, " .
       "    ref_periodo_turma, " .
       "    ref_disciplina, " .
       "    num_alunos, " .
       "    is_cancelada, " .
       "    num_matriculados, " .
       "    turma, " .
       "    ref_periodo_turma, " .
       "    conteudo " .
       " from disciplinas_ofer where id = '$id' ";
 
$query = $conn->CreateQuery($sql);

SaguAssert($query && $query->MoveNext(),"Registro não encontrado!");

list ( $id,
$ref_campus,
$ref_curso,
$ref_periodo,
$turma,
$ref_periodo_turma,
$ref_disciplina,
$num_alunos,
$is_cancelada,
$num_matriculados,
$turma,
$ref_periodo_turma,
$conteudo) = $query->GetRowValues();

$campus		= GetField($ref_campus, "nome_campus", "campus", true);
$curso 		= GetField($ref_curso, "abreviatura", "cursos", true);
$disciplina = GetField($ref_disciplina, "descricao_disciplina", "disciplinas", true);

if($is_cancelada)
{ $cancelada = "Sim" ; }
else
{ $cancelada = "Não" ; }

@$query->Close();

@$conn->Close();


$sql = "select id||' / '||nome_campus as d,id from campus order by d";
$op_result1 = SQLArray($sql);
$sql = "select id||' / '||abreviatura as d,id from cursos order by d";
$op_result2 = SQLArray($sql);
$sql = "$sql_periodos_academico";
$op_result3 = SQLArray($sql);
$op4_opcoes = SQLArray($sql_periodos_academico);

?>
<html>
<head>
<script language="JavaScript">
var cmp;

function buscaDiscp()
{
  cmp = '1';

  var url = '../generico/post/lista_disciplinas_curso.php' + 
            '?ref_curso=' + escape(document.myform.ref_curso.value);

  var wnd = window.open(url,'busca','toolbar=no,width=550,height=350,scrollbars=yes');
}

function buscaPessoa()
{
  cmp = '2';

  var url = '../generico/post/lista_pessoas.php' +
            '?pnome=' + escape(document.myform.ref_professor_nome.value);

  var wnd = window.open(url,'busca','toolbar=no,width=550,height=350,scrollbars=yes');
}

function buscaSala()
{
  cmp = '3';

  var url = '../generico/post/lista_salas.php' +
            '?ref_campus=' + escape(document.myform.ref_campus.value);

  var wnd = window.open(url,'busca','toolbar=no,width=550,height=350,scrollbars=yes');
}

function setResult(arg1,arg2)
{
  if (cmp=='1')
  {
    document.myform.ref_disciplina.value = arg1;
    document.myform.ref_disciplina_nome.value = arg2;
  }

  else if (cmp=='2')
  {
    document.myform.ref_professor.value = arg1;
    document.myform.ref_professor_nome.value = arg2;
  }

  else if (cmp=='3')
  {
    document.myform.num_sala.value = arg1;
    document.myform.num_alunos.value = arg2;
  }
}

function ChangeOption(opt,fld)
{
  var i = opt.selectedIndex;

  if ( i != -1 )
    fld.value = opt.options[i].value;
  else
    fld.value = '';
}

function ChangeOp1()
{
  ChangeOption(document.myform.op1,document.myform.ref_campus);
}

function ChangeOp2()
{
  ChangeOption(document.myform.op2,document.myform.ref_curso);
}

function ChangeOp3()
{
  ChangeOption(document.myform.op3,document.myform.ref_periodo);
}
function ChangeOp4()
{
  ChangeOption(document.myform.op4,document.myform.ref_periodo_turma);
}

function Confirma_Exclui_Prof(arg1, arg2, arg3)
{
    url = 'post/disciplina_ofer_exclui_prof.php?ref_professor=' + arg2 + '&ref_disciplina_ofer=' + arg1;

  if (confirm("Você tem certeza que deseja EXCLUIR o Professor(a) "+arg3+" da Disciplina Ofertada (diário) "+arg1+"?"))
    location=(url)
  else
    alert("Exclusão Cancelada.");
}

</script>
</head>
<body bgcolor="#FFFFFF">
<br>
<form method="post" action="post/atualiza_disciplina_ofer.php"
	name="myform">
<table width="90%" align="center">
	<tr>
		<td bgcolor="#000099" colspan="2" height="28" align="center"><font
			size="3" face="Verdana, Arial, Helvetica, sans-serif" color="#CCCCFF"><b>&nbsp;Alteração
		da Disciplina Oferecida</b></font></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="30%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;C&oacute;digo</font></td>
		<td width="70%"><font face="Verdana, Arial, Helvetica, sans-serif"><font
			size="2"><font color="#3333FF"> <script language="PHP">
	      echo($id);
    	</script> <input type="hidden" name="id" value="<? echo($id); ?>">
		</font></font></font></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="30%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Campus&nbsp;</font></td>
		<td width="70%"><input name="ref_campus" type=text
			value="<?echo($ref_campus);?>" size="6" maxlength="6"> <font
			face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font
			color="#000000"> <script language="PHP">
    	  ComboArray("op1",$op_result1,$ref_campus,"ChangeOp1()");
	    </script> </font></font> </font></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="30%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Curso&nbsp;</font></td>
		<td width="70%"><input name="ref_curso" type=text
			value="<?echo($ref_curso);?>" size="6" maxlength="6"> <font
			face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font
			color="#000000"> <script language="PHP">
    	  ComboArray("op2",$op_result2,$ref_curso,"ChangeOp2()");
	    </script> </font></font></font></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="20%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Turma</font>
		</td>
		<td width="80%"><input name="turma" type=text size="7"
			value="<?=$turma?>"></td>
	</tr>

	<tr>
		<td bgcolor="#CCCCFF" width="20%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Início
		da turma</font></td>
		<td width="80%"><input name="ref_periodo_turma" type=text size="7"
			onChange="ChangeCode('ref_periodo_turma','op4')"
			value="<?echo($ref_periodo_turma)?>"> <font color="#000000"> <script
			language="PHP">ComboArray("op4",$op4_opcoes,$ref_periodo_turma,"ChangeOp4()");</script>
		</font></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="30%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Per&iacute;odo</font></td>
		<td width="70%"><input name="ref_periodo" type=text
			value="<?echo($ref_periodo);?>" size="6" maxlength="16"> <font
			face="Verdana, Arial, Helvetica, sans-serif"><font size="2"><font
			color="#000000"> <script language="PHP">
    	  ComboArray("op3",$op_result3,$ref_periodo,"ChangeOp3()");
    	</script> </font></font></font></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="30%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Disciplina&nbsp;</font></td>
		<td width="70%">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><font color="#000000"> <input name="ref_disciplina" type=text
					size="6" onChange="ChangeCode('ref_disciplina','op3')"
					value="<?echo($ref_disciplina);?>"> <input
					name="ref_disciplina_nome" type=text size="45"
					value="<?echo($disciplina);?>"> </font></td>
				<td><font color="#000000"> <input type="button" value="..."
					onClick="buscaDiscp()"> </font></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="30%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;N&uacute;mero&nbsp;m&aacute;ximo
		de Alunos</font></td>
		<td width="70%"><input name="num_alunos" type=text
			value="<?echo($num_alunos);?>" size="6" maxlength="6"></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="30%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Cancelada
		</font></td>
		<td width="70%"><select name="is_cancelada">
			<option value="<?echo($is_cancelada);?>" selected><?echo($cancelada);?></option>
			<option value="1">Sim</option>
			<option value="0">N&atilde;o</option>
		</select></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCFF" width="30%"><font
			face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Conteúdo&nbsp;</font></td>
		<td width="70%"><input type="text" name="conteudo" size="30"
			value="<?echo($conteudo);?>"></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>

</table>

<?php Lista_Complemento($id, $ref_campus);?>
<br />
<div align="center">
		<input type="submit" name="Submit" value=" Salvar ">
		<input type="button" name="Submit2"	value=" Voltar " onClick="history.go(-1)">
</div>
</form>
</body>
</html>
