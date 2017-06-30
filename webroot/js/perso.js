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

// function checkTime(){
	// setTimeout( function(){
			// now = new Date();
			// if (now.getMinutes() - origin.getMinutes() >= 3){
				// $("#warning").addClass("rouge");
				// $("#warning").css({"font-weight":"bold", "text-shadow":"0 0 3px #FFFF00", "padding":"5px", "max-width":"46%"});
				// $("#warning").html('<span class="rouge">Attention, les données sont peut-être périmées (plus de 3 minutes). Veuillez recharger la page.</span>');
			// }
			// checkTime();
		// }, 1000);
// }

function color(entity, col){
	$(entity).addClass(col);
}

function alert_daemon(def, entity, type){
	var duree1, duree2, ld_theorique_parts, ld_theorique_minutes;
	var now = new Date();
	now = (+now.getHours()*60) + (+now.getMinutes());
	rend = entity.theoric_departures['0'].rendition_duration/60;
	
	if(entity.alerte1 == 0){	duree1 = def;	}
	else		{	duree1 = entity.alerte1/60;}
	
	if(entity.alerte2 == 0){	duree2 = def;	}
	else		{	duree2 = entity.alerte2/60;}
	
	switch(type){
		case 1: // role geops, rlp
		// pour chaque ligne, tester : si dep reel vide, si dep theorique - heure systeme <= duree1 ou alerte rendu matériel, clignoter en orange. Si de plus dep theorique - heure systeme <= 0 ou rendu matériel en retard, clignoter en rouge
		$('tr').each(function(){
			console.log("ld_theorique_minutes - now <= 0 :" + (ld_theorique_minutes - now <= 0));
			console.log("ld_theorique_minutes - rend - now  <= 0 :" + (ld_theorique_minutes - rend - now  <= 0));
			if ( $(this).children(".ld_reel").is(':empty') ){
				ld_theorique_parts = $(this).children(".ld_theorique").text().split(":");
				ld_theorique_minutes = ((+ld_theorique_parts[0]*60) + (+ld_theorique_parts[1]));
				
				if ( ld_theorique_minutes - now <= duree1 || ($(this).children(".restit").is(':empty') && ld_theorique_minutes - rend - now  <= duree2) ){
					if( ld_theorique_minutes - now <= 0 || ld_theorique_minutes - rend - now  <= 0){
						$(this).children(".train").addClass("blink-red");						
					}
					else{
						$(this).children(".train").addClass("blink-orange");
					}
				}
			}
		});
		break;
		
		default:
			console.log("alert_daemon not set properly. no action required.");
	}
	
	setTimeout( function(){
			alert_daemon();
		}, 60000);
}

var landy_calc = function(event){
	var heure = parseInt($("[name='paris_nord_departure\[hour\]'] option:selected").text());
	var minute = parseInt($("[name='paris_nord_departure\[minute\]'] option:selected").text());
	var docktime = parseInt($("#docking-time").val());
	var dd = parseInt($("#descent-duration").val());
		$.ajax({
			url : 'http://ordo/departure-trains/landyDeparture',
			type : 'POST',
			data : {
				heure: heure,
				minute: minute,
				docktime: docktime,
				dd: dd
			},
			dataType : 'html',
			success : function(code_html, statut){
				$('#landy_calc').html(code_html);
			},
			error : function(resultat, statut, error){
				
			},
			complete: function(code_html, resultat, statut){
				
			}
		})
}

function refresh(target_url, interval){
	console.log("refresh");
	$.ajax({
		url: target_url,
		success : function(code_html, statut){
			$('.clearfix').html(code_html);
		}
	});
	setTimeout( function(){
			refresh(target_url, interval);
		}, interval);
}


$(document).ready(function()
{
	cTime();
	
	$(".even").keyup(function(event){
		var numero=parseInt($(this).val());
		var unique = true;
		
		$.ajax({
			url : 'trainNumber',
			type : 'POST',
			data : 'numero=' + numero,
			dataType : 'html',
			success : function(code_html, statut){
				$('#erreur').html(code_html);
				unique = $.isEmptyObject(code_html);
				if(numero%2 != 0){
					$('#erreur-numero').show();
				}
				else{
					$('#erreur-numero').hide();
					if (!unique){
						$('#erreur').show();
						$('button[type="submit"]').prop('disabled', true).css('background-color', 'grey');
					}
					else{
						$('#erreur').hide();
						$('button[type="submit"]').prop('disabled', false).css('background-color', '#6E1E78');
					}
				}
			},
			error : function(resultat, statut, error){
				
			},
			complete: function(code_html, resultat, statut){
				
			}
		})
	})
	
	$(".odd").keyup(function(event){
		var numero=parseInt($(this).val());
		var unique = true;
		
		$.ajax({
			url : 'trainNumber',
			type : 'POST',
			data : 'numero=' + numero,
			dataType : 'html',
			success : function(code_html, statut){
				$('#erreur').html(code_html);
				unique = $.isEmptyObject(code_html);
				if(numero%2 == 0){
					$('#erreur-numero').show();
				}
				else{
					$('#erreur-numero').hide();
					if (!unique){
						$('#erreur').show();
						$('button[type="submit"]').prop('disabled', true).css('background-color', 'grey');
					}
					else{
						$('#erreur').hide();
						$('button[type="submit"]').prop('disabled', false).css('background-color', '#6E1E78');
					}
				}
			},
			error : function(resultat, statut, error){
				
			},
			complete: function(code_html, resultat, statut){
				
			}
		})
			
	})
	
	$("button").click(landy_calc);
	$("select").change(landy_calc);
	$("#docking-time, #descent-duration").keyup(landy_calc);
	

	
	
})



