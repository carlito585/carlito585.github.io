<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,eight=auto, initial-scale=1">
<title>Centro estetico</title>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel='stylesheet' href='../css/woocommerce-layout.css' type='text/css' media='all'/>
<link rel='stylesheet' href='../css/woocommerce-smallscreen.css' type='text/css' media='only screen and (max-width: 768px)'/>
<link rel='stylesheet' href='../css/woocommerce.css' type='text/css' media='all'/>
<link rel='stylesheet' href='../css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='../style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500,700%7CHerr+Von+Muellerhoff:400,500,700%7CQuattrocento+Sans:400,500,700' type='text/css' media='all'/>
<link rel='stylesheet' href='../css/easy-responsive-shortcodes.css' type='text/css' media='all'/>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
function apri(url) {
var windowprops = "width= 1200 ,height= 600";
popup = window.open(url);
}
function elimina(cf){
var r=confirm("Sicuro di eliminare il cliente ?");
if (r==true)
  {
  window.location.assign("clienti.php?del="+cf);
  }
} 

function abilita_disabilita(rd){
var cf=document.getElementById('cf');
var nome=document.getElementById('nome');
var cognome=document.getElementById('cognome');
var el;
el=document.getElementById(rd.value);
cf.disabled=true;
nome.disabled=true;
cognome.disabled=true;
el.disabled=false;
}
</script>
</head>
<?php 
session_start();
include('../config.php');
if(IsSet($_GET['del'])){
	$query=$db_con->query("DELETE from clienti WHERE  `cf` ='".$_GET['del']."'")or die('error');
	}
?>
<body class="home page page-template page-template-template-portfolio page-template-template-portfolio-php">
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
<div class=container>
 <table class="table">
		<form name="cerca" action="search.php?search"  method="post">
          <label style="text-align:center;">
         <input type="radio" name="search_type" value="cf" checked onclick="abilita_disabilita(this)"/> cerca per codice fiscale
         <input type="radio" name="search_type" value="cognome" onclick="abilita_disabilita(this)"/> cerca per cognome
         <input type="radio" name="search_type" value="nome" onclick="abilita_disabilita(this)"/> cerca per nome
         </label>
		<p style="text-align:center;">
         Codice Fiscale: <input id='cf' type="text" name="cf" value='' AUTOCOMPLETE="Off" >
         Cognome: <input type="text" id='cognome' name="cognome" value='' disabled AUTOCOMPLETE="Off">
         Nome: <input type="text" id='nome' name="nome" value='' disabled AUTOCOMPLETE="Off">
    	<input type="submit" value="Cerca" > </a>
                </p>
	</form>
	</table>
	<p style="text-align:center;">
	<a href="add_cliente.php"> <button>Aggiungi un cliente </button>  </a>
	<button onclick="window.print();"> Stampa pagina </button>
</p>
<div>
	<table border="2" >
		<tr> 
			<th>Nome</th>
			<th>Cognome</th>
			<th>Telefono</th>
		</tr>
		<?php

		if($query = $db_con->query("SELECT * from clienti")){
		while($q = $query->fetch_array()){
		$cf=$q["cf"];
		$id=$q["nome"]." ".$q["cognome"];
		echo"<tr>
 	        <td>". $q["nome"] ."</td>
			<td>". $q["cognome"] ."</td>
			<td>". $q["telefono"] ."</td>
			<td> <a href='JavaScript:apri(\"scheda_cliente.php?codice=$cf\");'> <button>Scheda cliente</button></a> </td>
			<td> <a href='JavaScript:apri(\"modifica_cliente.php?id=$cf\");'> <button> Modifica </button> </a> </td>
			<td> <a href='JavaScript:elimina(\"$cf\");'> <button> Elimina </button> </a> </td>
		</tr>";
		}
		}else echo "ERRORE DI CONNESSIONE AL SERVER";
         ?>
	</table>
</div>
</div>
</body>
</html>
