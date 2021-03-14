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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script language="JavaScript">
function apri(url) {
var windowprops = "width= 600 ,height= 400";
popup = window.open(url,'remote',windowprops);

</script>
</head>

<?php 
session_start();

include('../config.php');

if(IsSet($_GET["add"])){
	
	if(IsSet($_POST["nome"])&&IsSet($_POST["cognome"])&&IsSet($_POST["cf"])&&IsSet($_POST["telefono"])&&IsSet($_POST["mail"])&&IsSet($_POST["citta_nascita"])
       &&IsSet($_POST["data_nascita"])&&IsSet($_POST["via_residenza"])&&IsSet($_POST["citta_residenza"])){
		 $db_con->query("INSERT INTO `clienti`(`cf`, `nome`, `cognome`, `telefono`,`mail`,`citta_nascita`,`data_nascita`,`via_residenza`,`citta_residenza`) VALUES
		 ('".strtoupper($_POST["cf"])."','".strtoupper($_POST["nome"])."','".strtoupper($_POST["cognome"])."','".strtoupper($_POST["telefono"])."',
         '".strtoupper($_POST["mail"])."','".strtoupper($_POST["citta_nascita"])."','".strtoupper($_POST["data_nascita"])."',
         '".strtoupper($_POST["via_residenza"])."','".strtoupper($_POST["citta_residenza"])."')")or die('errore');
                 
		header('Location: clienti.php');
		} else "ERRORE DI CONTROLLO";/*header('Location: add_cliente.php?errore');   */
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
<h2 style="text-align:center;"> Aggiungi un cliente </h2>

<div class='container'>
	<form action="add_cliente.php?add"  method="post">
    <p> Nome Cliente: <input type="text" name="nome" value="" size="30" onfocus="this.value='';"AUTOCOMPLETE="Off"></p>
		<p> Cognome Cliente: <input type="text" name="cognome" value="" size="30" onfocus="this.value='';"AUTOCOMPLETE="Off"></p>
        <p>Codice Fiscale: <input type="text" value="" name="cf" size="30"onfocus="this.value='';"AUTOCOMPLETE="Off"></p>
		<p>Telefono: <input type="text" name="telefono" value="" size="30"onfocus="this.value='';"AUTOCOMPLETE="Off"></p>
		<p>E-Mail: <input type="text" name="mail" value="" size="30"onfocus="this.value='';"AUTOCOMPLETE="Off"></p>
		<p>Citta di nascita: <input type="text" name="citta_nascita" value="" size="30"onfocus="this.value='';"AUTOCOMPLETE="Off"></p>
		<p>Data di nascita: <input type="date" name="data_nascita" value="" size="30"onfocus="this.value='';"AUTOCOMPLETE="Off"></p>
		<p>Citta di residenza: <input type="text" name="citta_residenza" value="" size="30"onfocus="this.value='';"AUTOCOMPLETE="Off"></p>
		<p>Indirizzo residenza: <input type="text" name="via_residenza" value="" size="30"onfocus="this.value='';"AUTOCOMPLETE="Off"></p>
		<p>	<input type="submit" value="Aggiungi Cliente" > </p>
	</form> 
</div>
</body>

</html>
