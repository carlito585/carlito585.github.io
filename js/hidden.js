function mostra_nascondi(){
var id_packet=document.getElementById('id_packet');
var seduta=document.getElementById('seduta');
var ago=document.getElementById('tipo_ago');
var pelle=document.getElementById('tipo_pelle');
var colore=document.getElementById('colore');
var domiciliare=document.getElementById('prodotto_domiciliare');
var trattamenti=document.getElementById('num_trattamenti');
var tab_trattamenti= document.getElementById('scheda');
if(id_packet.value==1){
/*mostrare i valori CORPO come di seguito BISOGNERA' IMPLEMENTARE ANALISI CORPOREA e TABELLA TRATTAMENTI*/
     trattamenti.hidden=false;
     domiciliare.hidden=false;
     tab_trattamenti.hidden=false;
}else if(id_packet.value==2){

     /*mostrare i valori DERMOPIMENTAZIONE come di seguito*/
     seduta.hidden=false;
     ago.hidden=false;
     colore.hidden=false;
}else if(id_packet.value==3){
     /*mostrare i valori VISO come di seguito BISOGNERA' IMPLEMENTARE e TABELLA TRATTAMENTI*/
     pelle.hidden=false;
     tab_trattamenti.hidden=false;
}else if(id_packet.value==4){
     /*mostrare i valori LASER come di seguito*/
}else document.write("ERRORE NELLA SELEZIONE DEL PACCHETTO");
/*document.write("ERRORE NELLA SELEZIONE DEL PACCHETTO"); */
}

