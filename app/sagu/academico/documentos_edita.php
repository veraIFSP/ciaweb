<?php 

require_once("../common.php"); 


$conn = new connection_factory($param_conn);

// Verifica as permissoes de acesso do usuario quanto ao arquivo
$ACL_FILE = __FILE__;
require_once($BASE_DIR .'core/login/acesso.php');
// ^ Verifica as permissoes de acesso do usuario quanto ao arquivo ^ //


?>

<html>
    <head>
<?php 

$id = $_GET['id'];

CheckFormParameters(array("id"));

$conn = new Connection;

$conn->Open();

$sql = " select " .
       "    ref_pessoa," .
       "    pessoa_nome(ref_pessoa)," .
       "    rg_num," .
       "    cpf," .
       "    hist_escolar," .
       "    hist_original," .
       "    titulo_eleitor," .
       "    quitacao_eleitoral," .
       "    doc_militar," .
       "    foto, " .
       "    atestado_medico, " .
       "    diploma_autenticado, " .
       "    solteiro_emancipado, " .
       "    obs_documentos, " .
       "    anotacoes " .
       "  from documentos where ref_pessoa = '$id'";

$query = $conn->CreateQuery($sql);

SaguAssert($query && $query->MoveNext(),"Registro não encontrado!");

list ( $ref_pessoa,
    $pessoa_nome,
    $rg_num,
    $cpf,
    $hist_escolar,
    $hist_original,
    $titulo_eleitor,
    $quitacao_eleitoral,
    $doc_militar,
    $foto,
    $atestado_medico,
    $diploma_autenticado,
    $solteiro_emancipado,
    $obs_documentos,
    $anotacoes) = $query->GetRowValues();

$query->Close();

$conn->Close();

?>
        <script language="JavaScript">
            function _init()
            {
                document.myform.ref_pessoa.focus();
            }
        </script>
    </head>
    <body bgcolor="#FFFFFF" marginwidth="20" marginheight="20" onload="_init()">
        <form method="post" action="post/documentacao_altera.php" name="myform">
            <div align="center">
                <table width="90%" align="center">
                    <tr bgcolor="#000099">
                        <td colspan="4" height="35">
                            <div align="center"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#CCCCFF">Atualização de Documentação</font></b></font></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center"><b><font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0033">
                                    <input type="hidden" name="id" value="<? echo($id); ?>">
                        <?php echo($id); ?> - <?php echo($pessoa_nome); ?></font></b></td>
                    </tr>
                    <tr>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Cópia do RG&nbsp;</font></td>
                        <td>
                            <select name="rg_num">
                                <option selected><?echo($opcoes[$rg_num]); ?></option>
                                <?if ($rg_num == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($rg_num == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Cópia do CPF</font></td>
                        <td>
                            <select name="cpf">
                                <option selected><?echo($opcoes[$cpf]); ?></option>
                                <?if ($cpf == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($cpf == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Hist&oacute;rico Original</font></td>
                        <td>
                            <select name="hist_original">
                                <option selected><?echo($opcoes[$hist_original]); ?></option>
                                <?if ($hist_original == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($hist_original == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Cópia do Histórico</font></td>
                        <td>
                            <select name="hist_escolar">
                                <option selected><?echo($opcoes[$hist_escolar]); ?></option>
                                <?if ($hist_escolar == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($hist_escolar == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;T&iacute;tulo de Eleitor</font></td>
                        <td>
                            <select name="titulo_eleitor">
                                <option selected><?echo($opcoes[$titulo_eleitor]); ?></option>
                                <?if ($titulo_eleitor == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($titulo_eleitor == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Quitação Eleitoral</font></td>
                        <td>
                            <select name="quitacao_eleitoral">
                                <option selected><?echo($opcoes[$quitacao_eleitoral]); ?></option>
                                <?if ($quitacao_eleitoral == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($quitacao_eleitoral == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Documentação Militar</font></td>
                        <td>
                            <select name="doc_militar">
                                <option selected><?echo($opcoes[$doc_militar]); ?></option>
                                <?if ($doc_militar == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($doc_militar == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Foto&nbsp;</font></td>
                        <td>
                            <select name="foto">
                                <option selected><?echo($opcoes[$foto]); ?></option>
                                <?if ($foto == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($foto == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Atestado Médico&nbsp;</font></td>
                        <td>
                            <select name="atestado_medico">
                                <option selected><?echo($opcoes[$atestado_medico]); ?></option>
                                <?if ($atestado_medico == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($atestado_medico == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Diploma Autenticado</font></td>
                        <td>
                            <select name="diploma_autenticado">
                                <option selected><?echo($opcoes[$diploma_autenticado]); ?></option>
                                <?if ($diploma_autenticado == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($diploma_autenticado == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#CCCCFF"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Solteiro Emancipado&nbsp;</font></td>
                        <td>
                            <select name="solteiro_emancipado">
                                <option selected><?echo($opcoes[$solteiro_emancipado]); ?></option>
                                <?if ($solteiro_emancipado == 'f')
                                { echo "<option value=\"t\">Sim</option>";}
                                if ($solteiro_emancipado == 't')
                                { echo "<option value=\"f\">Não</option>";};?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Observações</font>
                        </td>
                        <td colspan="3">
                            <textarea name="obs_documentos" cols="40" rows="2"><?echo($obs_documentos);?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#00009C">&nbsp;Anotações</font>
                        </td>
                        <td colspan="3">
                            <textarea name="anotacoes" cols="40" rows="2"><?echo($anotacoes);?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr size="1">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <input type="submit" name="Submit"  value=" Salvar ">
                            <input type="button" name="Submit2" value=" Voltar " onclick="javascript:history.go(-1)">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </body>
</html>
