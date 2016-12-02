/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    var cont = 0;
   $('#clicarCadastrarParcel').click(function(){
       var payer_cost = '';
       var minparcels = '';
       var maxparcels = '';
       if(($('#juros').is(':checked'))==true){
           payer_cost = (document.getElementById('payer_cost').value);
       }else{
           payer_cost = 0;
       }
       minparcels = (document.getElementById('minparcels').value);
       maxparcels = (document.getElementById('maxparcels').value);
         
         
           $.ajax({
            type: "POST",
             url: "MasterConfigsParcels/AddParcels",
             data: {
                  'minparcels' : minparcels, 
                  'maxparcels' : maxparcels, 
                  'payer_cost' : payer_cost
             }
         }).done(function( msg ) {
             console.log(msg);
             if(payer_cost == 0){
                 payer_cost = 'Sem tarifa';
             }else{
                 payer_cost = payer_cost + "%";
             }
            $("#body").append('<tr id="new'+cont+'"><td><span class="table-icon" style="color:#2597AC" data-toggle="modal" data-target="#modalInfoIndication">'+minparcels+'</span></td><td><span class="table-icon" style="color:#2597AC" data-toggle="modal" data-target="#modalInfoIndication">'+maxparcels+'</span></td><td><span class="table-icon" style="color:#2597AC" data-toggle="modal" data-target="#modalInfoIndication">Antecipado</span></td><td><span class="table-icon" style="color:#2597AC" data-toggle="modal" data-target="#modalInfoIndication">'+payer_cost+'</span></td><td><a id="remover" onclick="Removetr(\'new'+cont+'\', '+msg+')">remover</a></td></tr>');
            cont++;
            document.getElementById('minparcels').value = '';
            document.getElementById('maxparcels').value = '';
            document.getElementById('payer_cost').value = '';
        });
});

         
         
   });
   
function Removetr(id, idtable){
  
     $.ajax({
            type: "POST",
             url: "MasterConfigsParcels/removeParcels",
             data: {
                  'id' : idtable
             }
         }).done(function( msg ) {
              $("#"+id).remove();
              $("#trid"+idtable).remove();
         });
    
}

