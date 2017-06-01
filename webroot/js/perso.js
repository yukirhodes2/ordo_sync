function emptyTime($arg){

	//$('[name="'+$arg+'[year]"').val('');
	//$('[name="'+$arg+'[month]"').val('');
	//$('[name="'+$arg+'[day]"').val('');
	$('[name="'+$arg+'[hour]"').val('');
	$('[name="'+$arg+'[minute]"').val('');
}

function currentTime($arg){
	
	var now = new Date();
	 
	$annee = now.getFullYear();
	$mois = ('0'+(now.getMonth()+1)).slice(-2);
	$jour = ('0'+now.getDate()).slice(-2);
	$heure = ('0'+now.getHours()).slice(-2);
	$minute = ('0'+now.getMinutes()).slice(-2);
	
	$('[name="'+$arg+'[year]"').val($annee);
	$('[name="'+$arg+'[month]"').val($mois);
	$('[name="'+$arg+'[day]"').val($jour);
	$('[name="'+$arg+'[hour]"').val($heure);
	$('[name="'+$arg+'[minute]"').val($minute);
}

function cTime(){
	origin = new Date();
	setTimeout( function(){
			now = new Date();
			// $("#timer").html(now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds());
			checkTime();
		}, 1000);
}

function checkTime(){
	setTimeout( function(){
			now = new Date();
			// $("#timer").html(now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds());
			if (now.getMinutes() - origin.getMinutes() >= 3){
				$("#warning").addClass("rouge");
				$("#warning").css({"font-weight":"bold", "text-shadow":"0 0 3px #FFFF00", "padding":"5px", "max-width":"46%"});
				$("#warning").html('<span class="rouge">Attention, les données sont peut-être périmées (plus de 3 minutes). Veuillez recharger la page.</span>');
			}
			checkTime();
		}, 1000);
}

$(document).ready(function()
{
	cTime();
	
	$(".even").keyup(function(event){
		var numero=parseInt($(this).val());
		console.log(numero);
			if(numero%2 != 0)
			{
				$('#erreur-numero').show();
				$('button[type="submit"]').prop('disabled', true).css('background-color', 'grey');
			}
			else
			{
				$('#erreur-numero').hide();
				$('button[type="submit"]').prop('disabled', false).css('background-color', '#6E1E78');
			}
	})
	
	$(".odd").keyup(function(event){
		var numero=parseInt($(this).val());
		console.log(numero);
			if(numero%2 == 0)
			{
				$('#erreur-numero').show();
				$('button[type="submit"]').prop('disabled', true).css('background-color', 'grey');
			}
			else
			{
				$('#erreur-numero').hide();
				$('button[type="submit"]').prop('disabled', false).css('background-color', '#6E1E78');
			}
	})
	
})



