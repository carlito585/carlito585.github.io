<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel='stylesheet' href='../css/woocommerce-layout.css' type='text/css' media='all'/>
<link rel='stylesheet' href='../css/woocommerce-smallscreen.css' type='text/css' media='only screen and (max-width: 768px)'/>
<link rel='stylesheet' href='../css/woocommerce.css' type='text/css' media='all'/>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500,700%7CHerr+Von+Muellerhoff:400,500,700%7CQuattrocento+Sans:400,500,700' type='text/css' media='all'/>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/start/jquery-ui.css" />
<link rel = "stylesheet" href = "../style.css" type = "text/css" />
<style> .note {max-width:150px;}
        .bottone {max-width:100px;text-align:center; vertical-align:middle;}
          </style>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../js/toggle.js"></script>
<script src="../js/bootstrap.js"></script>
<script type="text/javascript">
function apri(url) {
var windowprops = "width= 1200 ,height= 600";
popup = window.open(url);
}


function elimina_analisi(id,istanza){
var r=confirm("Sicuro di eliminare l'analisi corporea selezionata?");
if (r==true)
  {
  window.location.assign("analisi_corporea.php?del="+id+"&istanza="+istanza);
  }
}
</script>

</head>

<?php 
session_start();
?>

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
include('../config.php');
 if(isSet($_GET["codice"])){
       if(isSet($_GET["eliminato"])){
        echo"<script type='text/javascript'> alert('ELIMINAZIONE AVVENUTA CON SUCCESSO!');</script>  ";
        }
       $id_istanza = $_GET["codice"];
       $id_pacchetto = $_GET["pacchetto"];
       $sql="SELECT * FROM analisi_corporea WHERE id_istanza ='".$id_istanza."' ";
       $query=$db_con->query($sql)
                              or die('error');
        $i=0;
         $sql="SELECT COUNT(*) AS `count` FROM analisi_corporea WHERE id_istanza ='".$id_istanza."' ";
         $num=$db_con->query($sql);
         $num=$num->fetch_array()["count"];
      if($num==0){
        echo" <script type='text/javascript'>var r=confirm('Non ci sono tabelle trattamenti collegate al pacchetto. Vuoi aggiungerne una?');
        if(r==true)window.location.assign('analisi_corporea.php?add_analisi=$id_istanza');
        </script>";
        }else{
      $sql="SELECT nome_pacchetto FROM pacchetti WHERE id_pacchetto=".$id_pacchetto."";
       $query1=$db_con->query($sql)
                              or die('error');
       $pacchetto=$query1->fetch_array()["nome_pacchetto"];
        echo"
        <div class='modal-header'>
        <h3 id='myModalLabel'> Analisi corporea</h3>
      </div>";
      while($q=$query->fetch_array()){
       $i=$i+1;
       echo"
      <div class=container>
	        <table border=\"2\" stlyle=\"text-align:center;\" >
            <tr>";
      echo"
                <th>Numero</th>
                <th>Data</th>
			    <th>Peso</th>
		      	<th>Altezza</th>
		      	<th>Fianchi</th>
		      	<th>Braccio destro</th>
		      	<th>Braccio sinistro</th>
		      	<th>Ginocchio destro</th>
		      	<th>Ginocchio sinistro</th>
		      	<th>Coscia destra</th>
		      	<th>Coscia sinistra</th>
	        </tr>
            <tr>
              <td>". $i ."</td>
			    <td style=\"min-width: 100px;\">". date("d-m-Y",strtotime($q["data"]))."</td>
			    <td>". $q["peso"] ."</td>
			    <td>". $q["altezza"] ."</td>
			    <td>". $q["fianchi"] ."</td>
			    <td>". $q["braccio_dx"] ."</td>
			    <td>". $q["braccio_sx"] ."</td>
			    <td>". $q["ginocchio_dx"] ."</td>
			    <td>". $q["ginocchio_sx"] ."</td>
			    <td>". $q["coscia_dx"] ."</td>
			    <td>". $q["coscia_sx"] ."</td>

		        <td class='button'> <a href='JavaScript:elimina_analisi(".$q['id'].",\"$id_istanza\");'><button> Elimina </button></a> </td>
		</tr>
		</table>";
    }
    }
     echo"   </div>
    ";
 }elseif(isSet($_GET["del"])){
 $sql="DELETE from analisi_corporea WHERE `id` =".$_GET['del']."";
   if($query=$db_con->query($sql)){
     header("location:analisi_corporea.php?codice=".$_GET['istanza']."&pacchetto=1&eliminato");
   }else  echo "NON E' STATO POSSIBILE PORTARE A TERMINE L'OPERAZIONE";
 }elseif(isSet($_GET["add_analisi"])){
 $id_istanza= $_GET["add_analisi"];
 echo $id_istanza;
echo "
<h2> Aggiungi scheda trattamento </h2>
<div class='container' id=\"insert\">
        <form id=\"prova\" action=\"analisi_corporea.php?add&id_istanza=$id_istanza\" method=\"post\">
        <h3 style=\"text-align:center;\">Dati relativi alla tabella trattamenti</h3>
        <p>Data: <input type=\"date\" name=\"data\" value=\"\" size=\"30\"></p>
           Peso: <input type=\"number\" name=\"peso\" value=\"\" size=\"10\"> kg&nbsp&nbsp
           Altezza: <input type=\"number\" name=\"altezza\" value=\"\" size=\"10\"> cm&nbsp&nbsp
           Fianchi: <input type=\"number\" name=\"fianchi\" value=\"\" size=\"10\"> cm </p>
        <p>Braccio destro: <input type=\"number\" name=\"braccio_dx\" value=\"\" size=\"10\"> cm&nbsp&nbsp
           Braccio sinistro: <input type=\"number\" name=\"braccio_sx\" value=\"\" size=\"10\"> cm </p>
        <p>Ginocchio destro: <input type=\"number\" name=\"ginocchio_dx\" value=\"\" size=\"10\"> cm&nbsp&nbsp
           Ginocchio sinistro: <input type=\"number\" name=\"ginocchio_sx\" value=\"\" size=\"10\"> cm</p>
        <p>Coscia destra: <input type=\"number\" name=\"coscia_dx\" value=\"\" size=\"10\"> cm&nbsp&nbsp
           Coscia sinistra: <input type=\"number\" name=\"coscia_sx\" value=\"\" size=\"10\"> cm</p>
        <p>	<input type=\"submit\" value=\"Aggiungi nota trattamento\" > <input type=\"reset\"  value=\"Reset\"></p>
	</form>
    </div>";
}elseif(isSet($_GET["add"])&&isSet($_GET["id_istanza"])){
  $id_istanza=$_GET["id_istanza"];
    if(IsSet($_POST["data"])&&IsSet($_POST["peso"])&&IsSet($_POST["altezza"])&&IsSet($_POST["fianchi"])&&IsSet($_POST["braccio_dx"])&&IsSet($_POST["braccio_sx"])
    &&IsSet($_POST["ginocchio_dx"])&&IsSet($_POST["ginocchio_sx"])&&IsSet($_POST["coscia_dx"])&&IsSet($_POST["coscia_sx"])){
    $sql="INSERT INTO analisi_corporea (`id_istanza`, `data`, `peso`, `altezza`, `fianchi`, `braccio_sx`, `braccio_dx`, `ginocchio_sx`, `ginocchio_dx`, `coscia_sx`, `coscia_dx`)
    VALUES (".$id_istanza.",'".$_POST["data"]."','".$_POST["peso"]."','".$_POST["altezza"]."','".$_POST["fianchi"]."','".$_POST["braccio_dx"]."',
    '".$_POST["braccio_sx"]."','".$_POST["ginocchio_dx"]."','".$_POST["ginocchio_sx"]."','".$_POST["coscia_dx"]."','".$_POST["coscia_sx"]."'
)";
    $query=$db_con->query($sql)or die('error');
     if($query )echo"<h2>ANALISI CORPOREA AGGIUNTA CON SUCCESSO!!!</h2>";
     else echo "ERRORE NELL' AGGIUNTA TAB TRATTAMENTI";
    } else echo "ERRORE CONTROLLO INIZIALE TABELLA";
}else"ERRORE PASSAGGIO DATI";


?>

    <div class="modal-footer">
           <!-- <a class="btn btn-primary" onclick="$('.modal-body > form').submit();">Save Changes</a>  -->

            <a class="btn" href="analisi_corporea.php?add_analisi=<?php echo $id_istanza;?>" metodo="get">aggiungi analisi corporea</a>
            <a class="btn" onclick="window.close();" data-dismiss="modal">Close</a>
        </div>
</body>
</html>
