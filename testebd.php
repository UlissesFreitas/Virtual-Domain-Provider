<?php
Session_start();
if (!($_SESSION["autenticado"]))
        header("Location: index.php");
?>
<HTML>
<HEAD>
<TITLE> TESTE PHP </TITLE>
</HEAD>
<BODY>
<H1>TESTE DO PHP</H1>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$bd = new mysqli("192.168.102.100", "usuariodeteste", "senhadeteste", "TESTE");
if ($bd->connect_errno)
{
	die("Falha ao conectar ao MySQL: (" . $bd->connect_errno . ") " . $bd->connect_error);
}

$result = $bd->query("SELECT * FROM Bolao ORDER BY idBolao ASC");

echo "<P>N&uacute;mero de linhas retornado pelo SGBD para a consulta: " . $result->num_rows . "<HR>\n";

echo("
	
	<TABLE BORDER=1>
	<TR><TH>idBolao</TH><TH>Nome</TH><TH>Pontos</TH><TH>Atualizar</TH></TR>
");

while($line =  $result->fetch_assoc())
{
	echo "<FORM ACTION=\"atualizar.php\" METHOD=\"GET\">" .
	"<TR><TD>" . 
	$line['idBolao']. 
	"<INPUT TYPE=\"HIDDEN\" VALUE=\"". $line['idBolao'] . "\" name=\"idBolao\">" . 
	"</TD><TD>" . 
	"<INPUT TYPE=\"TEXT\" VALUE=\"" . $line['Nome'] . "\" name=\"Nome\">" .
	"</TD><TD>" . 
	"<INPUT TYPE=\"TEXT\" VALUE=\"" . $line['Pontos'] . "\" name=\"Pontos\">" . 
	"</TD><TD>" .
	"<INPUT TYPE=\"SUBMIT\" VALUE=\"ATUALIZAR\">" . 
	"</TD></TR>" .
	"</FORM>" ;
}

?>
<TR><TD COLSPAN="4" ALIGN="CENTER">
<button type="button" onclick="window.location.href='sair.php'">SAIR</button>
</TD></TR>
</TABLE>
</BODY>
</HTML>
