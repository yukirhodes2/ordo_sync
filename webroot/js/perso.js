function emptyTime($arg){

	$('[name="'+$arg+'[year]"').val('');
	$('[name="'+$arg+'[month]"').val('');
	$('[name="'+$arg+'[day]"').val('');
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

// function cTime(){
	// origin = new Date();
	// setTimeout( function(){
			// now = new Date();
			// checkTime();
		// }, 1000);
// }

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

function alert_daemon(def, entity, type, controller){
	console.log("alert_daemon");
	var duree1, duree2, theorique_parts, theorique_minutes;
	var now = new Date();
	now = (+now.getHours()*60) + (+now.getMinutes());
	
	if(entity.alerte1 == 0 || entity.alerte1 == null){	duree1 = def[0];	}
	else		{	duree1 = entity.alerte1/60;}
	
	if(entity.alerte2 == 0 || entity.alerte1 == null){	duree2 = def[1];	}
	else		{	duree2 = entity.alerte2/60;}
	
	if (controller === "departures") {
		rend = entity.theoric_departures['0'].rendition_duration/60;
		switch(type){
			case 1: // role geops, rlp
			// pour chaque ligne, tester : si dep reel vide, si dep theorique - heure systeme <= duree1 ou alerte rendu matériel, clignoter en orange. Si de plus dep theorique - heure systeme <= 0 ou rendu matériel en retard, clignoter en rouge
			$('tr').each(function(){
				
				if ( $(this).children(".ld_reel").is(':empty') ){
					
					theorique_parts = $(this).children(".ld_theorique").text().split(":");
					theorique_minutes = ((+theorique_parts[0]*60) + (+theorique_parts[1]));
					
					// console.log("theorique_minutes - now <= 0 :" + (theorique_minutes - now <= 0));
					// console.log("theorique_minutes - rend - now  <= 0 :" + (theorique_minutes - rend - now  <= 0));
					// console.log("duree1 :" + duree1);
					// console.log("duree2 :" + duree2);
					// console.log("theorique_minutes :" + theorique_minutes);
					// console.log("now :" + now);
					// console.log("rend :" + rend);
					// console.log($(this).children(".restit").hasClass('red'));
					
					if ( theorique_minutes - now <= duree1 || ($(this).children(".restit").hasClass('red') && 
					theorique_minutes - rend - now  <= duree2) ){
						if( theorique_minutes - now <= 0 || theorique_minutes - rend - now  <= 0){
							$(this).children(".train").addClass("blink-red");
							$('#delays span').text('La préparation de ces trains est en retard :');
							$('#delays ul').append($('<li>N°'+$(this).children(".train").text()+' départ Landy prévu à '+ $(this).children(".ld_theorique").text() + '</li>'));
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
				console.log(type);
		}
	}
	else if (controller === "arrivals") {
		switch(type){
			case 1:
			$('tr').each(function(){
				
				if ( $(this).children(".la_reel").is(':empty') ){
					
					theorique_parts = $(this).children(".la_theorique").text().split(":");
					theorique_minutes = ((+theorique_parts[0]*60) + (+theorique_parts[1]));
					
					// console.log(theorique_minutes);
					// console.log(now);
					// console.log(duree1);
					
					if ( theorique_minutes - now <= duree1 ){
						if( theorique_minutes - now <= 0 ){
							$(this).children(".train").addClass("blink-red");
							$('#delays span').text('La remontée de ces trains est en retard :');
							$('#delays ul').append($('<li>N°'+$(this).children(".train").text()+' arrivée Landy prévue à '+ $(this).children(".la_theorique").text() + '</li>'));
						}
						else{
							$(this).children(".train").addClass("blink-orange");
						}
					}
				}
			});
		}
	}
	
	// setTimeout( function(){
			// alert_daemon();
		// }, 60000);
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
	// cTime();
	
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
	
	val = $("#brake-id option:selected").val();
	// console.log(val);
	if (val == 3){
		$("#present-id select").val("4");
		$("#present-id").prop('disabled', true);
	}
	else{
		$("#present-id").prop('disabled', false);
	}
		
	$("#brake-id").change(function(event){
		
		val = $("#brake-id option:selected").val();
		// console.log(val);
		if (val == 3){
			$('#present-id option[value="4"]').prop("selected", true);
			$("#present-id").prop('disabled', true);
			currentTime("realisation_time");
		}
		else{
			$("#present-id").prop('disabled', false);
			emptyTime("realisation_time");
		}
	});

})



