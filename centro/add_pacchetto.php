<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,eight=auto, initial-scale=1">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel='stylesheet' href='../css/woocommerce-layout.css' type='text/css' media='all'/>
<link rel='stylesheet' href='../css/woocommerce-smallscreen.css' type='text/css' media='only screen and (max-width: 768px)'/>
<link rel='stylesheet' href='../css/woocommerce.css' type='text/css' media='all'/>
<link rel='stylesheet' href='../css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='../style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500,700%7CHerr+Von+Muellerhoff:400,500,700%7CQuattrocento+Sans:400,500,700' type='text/css' media='all'/>
<link rel='stylesheet' href='../css/easy-responsive-shortcodes.css' type='text/css' media='all'/>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="../js/hidden.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style> .note {max-width:150px;}
        .bottone {max-width:100px;text-align:center; vertical-align:middle;}
</style>
<script language="text/javascript">
function apri(url) {
var windowprops = "width= 600 ,height= 400";
popup = window.open(url,'remote',windowprops);
}
</script>
</head>
<body class="home page page-template page-template-template-portfolio page-template-template-portfolio-php" onload="mostra_nascondi()">
<header id="masthead" class="site-header">
		<div class="site-branding">
            <h1 class="site-title"><a href="../index.php" rel="home">Centro Estetico</a></h1>
			<h2 class="site-description">Gestionale pacchetti del centro estetico</h2>
		</div>
		<nav id="site-navigation" class="main-navigation">
		<div class="menu-menu-1-container">
			<ul id="menu-menu-1" class="menu nav-menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="clienti.php">Clienti</a></li>
				<li><a href="pacchetti.php">Pacchetti</a></li>
		</div>
		</nav>
		</header>
<?php 
/*IN QUESTA PRIMA FASE SI PRENDONO I PACCHETTI DISPONIBILI NEL DB E SUCCESSIVAMENTE SI OFFRE LA POSSIBILITA'
  DI AGGIUNTA DEL PACCHETTO.
*/
session_start();
include('../config.php');
if(IsSet($_GET["cf"])){
          $cf=$_GET["cf"];
          echo $cf;
          $sql="SELECT `nome_pacchetto` FROM `pacchetti`";
           $query=$db_con->query($sql);
           $array=[];
          while($q=$query->fetch_array()){
             $array[]=$q["nome_pacchetto"];
           }
 echo "
                        <p>
                        <form name=\"selezione\" action=\"add_pacchetto.php?insert&id_cliente=$cf\"  method=\"post\">
		                Pacchetto: <select name=\"pacchetto\" onchange=\"document.selezione.submit()\">
                        <option value=\"\">seleziona pacchetto</option>
                        <option value=1>$array[0]</option>
                        <option value=2>$array[1]</option>
                        <option value=3>$array[2]</option>
                        <option value=4>$array[3]</option>
                        </select>
                        </form>
                        </p>";
 /*
 UNA VOLTA SCELTO IL PACCHETTO DA AGGIUNGERE AL CLIENTE LA SCELTA VIENE PASSATA TRAMITE LA VARIABILE GLOBALE.
 A QUESTO PUNTO IN FUNZIONE DEL PACCHETTO SELEZIONATO SI INSERISCONO TUTTI I DATI NECESSARI AL PACCHETTO.
 */
  } elseif(IsSet($_GET["insert"])){
  $sql="SELECT `nome_pacchetto` FROM `pacchetti`";
           $query=$db_con->query($sql);
           $array=[];
          while($q=$query->fetch_array()){
             $array[]=$q["nome_pacchetto"];
             }
$id_pacchetto=$_POST["pacchetto"];
$id_cliente=$_GET["id_cliente"];
echo "
<h2> Aggiungi pacchetto: ".strtolower($array[$id_pacchetto-1]) ." </h2>
<div class='container' id=\"insert\" style=\"text-align:left;\">
         <form id=\"prova\" action=\"add_pacchetto.php?add&id_pacchetto=$id_pacchetto&cliente=$id_cliente\" method=\"post\">";
echo"
    <p id='id_cliente' hidden>id istanza: <input type=\"text\" name=\"id_cliente\" value=\"".$id_cliente."\" size=\"30\"></p>
    <p id='id_pacchetto' hidden>id pacchetto: <input type=\"number\" id='id_packet' name=\"id_pacchetto\" value=\"".$_POST["pacchetto"]."\" size=\"30\"></p>
    <p id='data'>data di inizio: <input type=\"date\" name=\"data_inizio\" value=\"\" size=\"30\"></p>
		<p id='seduta' hidden>tipo di seduta: <select name=\"seduta\">
                        <option value='seduta'>seduta</option>
                        <option value='ripresa'>ripresa</option>
                        </select></p>
		<p id='tipo_ago' hidden>Tipo di ago: <input type=\"text\" name=\"tipo_ago\" value=\"\" size=\"30\"></p>
        <p id='tipo_pelle' hidden>TIpo di pelle: <input type=\"text\" value=\"\" name=\"tipo_pelle\" size=\"20\"></p>
		<p id='colore' hidden>Colore: <input type=\"text\" name=\"colore_pelle\" value=\"\" size=\"10\"></p>
		<p id='prodotto_domiciliare' hidden>Prodotto domiciliare: <input type=\"text\" name=\"prodotto_domiciliare\" value=\"\" size=\"10\"></p>
		<p id='num_trattamenti' hidden>Numero trattamenti: <input type=\"text\" name=\"num_trattamenti\" value=\"\" size=\"10\"></p>
		<p id='note'>Note:<textarea  name=\"note\" rows=\"4\" cols=\"50\" style=\"width:50%;\"></textarea></p>
		<p id='costo'>Costo: <input type=\"number\" step=\"0.01\" name=\"costo\" value=0 size=\"10\">&euro;</p>";
        /*if(($id_pacchetto==1) or($id_pacchetto==3)){
        echo"
        <h3 style=\"text-align:center;\">Dati relativi alla tabella trattamenti</h3>
        <p>Data: <input type=\"date\" name=\"data\" value=\"\" size=\"30\"></p>
        <p>TIpo di trattamento: <input type=\"text\" value=\"\" name=\"tipo_trattamento\" size=\"20\"></p>
        <p id='note'>Note:<textarea  name=\"note\" rows=\"4\" cols=\"50\" style=\"width:50%;\"></textarea></p>
        <p>Acconto: <input type=\"number\" step=\"0.01\" name=\"acconto\" value=0 size=\"10\">&euro;</p>
        <p>Saldo: <input type=\"number\" step=\"0.01\" name=\"saldo\" value=0 size=\"10\">&euro;</p>
        ";}*/
		
        echo "
        <p>	<input type=\"submit\" value=\"Aggiungi Pacchetto\" > <input type=\"reset\"  value=\"Reset\"></p>
	</form>


    </div>

    </body>";
}elseif(IsSet($_GET["add"])){
if(IsSet($_GET["id_pacchetto"])&&IsSet($_GET["cliente"])&&IsSet($_POST["data_inizio"])&&IsSet($_POST["tipo_ago"])&&IsSet($_POST["colore_pelle"])&&IsSet($_POST["seduta"])&&
    IsSet($_POST["note"])&&IsSet($_POST["costo"])&&IsSet($_POST["tipo_pelle"])&&IsSet($_POST["prodotto_domiciliare"])&&IsSet($_POST["num_trattamenti"])){
    /*OCCHIO SE IL COSTO E' VUOTO DA ERRORE*/
$sql="INSERT INTO `istanze_clienti`(`id_pacchetto`, `cliente`, `data_inizio`, `tipo_ago`,`tipo_pelle`, `colore`,`num_trattamenti`, `prodotto_domiciliare`, `tipo_seduta`, `note`, `costo`)
      VALUES (".$_GET["id_pacchetto"].",'".strtoupper($_GET["cliente"])."','".$_POST["data_inizio"]."'
,'".strtoupper($_POST["tipo_ago"])."','".strtoupper($_POST["tipo_pelle"])."','".strtoupper($_POST["colore_pelle"])."','".$_POST["num_trattamenti"]."','".strtoupper($_POST["prodotto_domiciliare"])."',
'".strtoupper($_POST["seduta"])."','".strtoupper($_POST["note"])."',".$_POST["costo"].")";
           if($query=$db_con->query($sql)){
           /*$id_cliente=$_GET["cliente"];
           header('Location: scheda_cliente.php?codice='.$id_cliente); */
           $sql="SELECT id FROM istanze_clienti WHERE cliente='".strtoupper($_GET["cliente"])."' AND data_inizio= '".$_POST["data_inizio"]."'AND id_pacchetto=".$_GET["id_pacchetto"]."  ";
           if($query=$db_con->query($sql)){
           Echo"<h2>PACCHETTO AGGIUNTO CON SUCCESSO!!!</h2>";
           $id_istanza= $query->fetch_array()['id'];
           }else echo "ERROR";
}
/*if(IsSet($_POST["tipo_trattamento"])&&IsSet($_POST["acconto"])&&IsSet($_POST["data"])&&IsSet($_POST["saldo"])&&IsSet($_POST["note"])){
   $sql="INSERT INTO scheda_trattamenti (`id_istanza`, `data`, `tipo_trattamento`, `note`, `acconto`, `saldo`) VALUES
       (".$id_istanza.",'".$_POST["data"]."','".$_POST["tipo_trattamento"]."','".$_POST["note"]."',".$_POST["acconto"].",".$_POST["saldo"]." )";
     if($query=$db_con->query($sql))Echo"<h2>PACCHETTO AGGIUNTO CON SUCCESSO!!!</h2>";
     else "ERRORE NELL' AGGIUNTA TAB TRATTAMENTI";
    } else "ERRORE CONTROLLO INIZIALE TABELLA"; */
    }else echo "ERRORE DI AGGIUNTA PACCHETTO";
}else echo "ERRORE CONTROLLO INIZIALE";

?>
<div class="modal-footer" >
           <!-- <a class="btn btn-primary" onclick="$('.modal-body > form').submit();">Save Changes</a>  -->
        <a class="btn" onclick="window.close();" data-dismiss="modal">Close</a></div>
</html>

