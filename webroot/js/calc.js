var landy_dep_calc = function(event){
	var heure = parseInt($("[name='paris_nord_departure\[hour\]'] option:selected").text());
	var minute = parseInt($("[name='paris_nord_departure\[minute\]'] option:selected").text());
	var docktime = parseInt($("#docking-time").val());
	var dd = parseInt($("#descent-duration").val());
		$.ajax({
			url : 'landyDeparture',
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
				$.ajax({
					url : '../landyDeparture',
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
			},
			complete: function(code_html, resultat, statut){
				
			}
		})
		
}

var landy_ari_calc = function(event){
	console.log('landy ari');
	var heure = parseInt($("[name='paris_nord_arrival\[hour\]'] option:selected").text());
	var minute = parseInt($("[name='paris_nord_arrival\[minute\]'] option:selected").text());
	var at = parseInt($("#ascent-time").val());
		$.ajax({
			url : 'landyArrival',
			type : 'POST',
			data : {
				heure: heure,
				minute: minute,
				at: at
			},
			dataType : 'html',
			success : function(code_html, statut){
				$('#landy_calc').html(code_html);
			},
			error : function(resultat, statut, error){
				$.ajax({
					url : '../landyArrival',
					type : 'POST',
					data : {
						heure: heure,
						minute: minute,
						at: at
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
			},
			complete: function(code_html, resultat, statut){
				
			}
		})
		
}

$(document).ready(function()
{
	if ($(location).attr('href').match('departure-trains') != null){
		$("button").click(landy_dep_calc);
		$("select").change(landy_dep_calc);
		$("#docking-time, #descent-duration").keyup(landy_dep_calc);
	}
	else if ($(location).attr('href').match('arrival-trains') != null){
		$("button").click(landy_ari_calc);
		$("select").change(landy_ari_calc);
		$("#docking-time, #ascent-time").keyup(landy_ari_calc);
	}
	
	

	
	
})
