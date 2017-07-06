<?php
	$minContainer = 0; // conteneur de minutes
	$heure = intval($heure);
	$minute = intval($minute);
	$at = intval($at);
	
	if( $heure !==0 || $minute !==0 ){
		if( $at !== 0 ){
			$minContainer= $heure*60+$minute + $at;
			$heure = intval($minContainer/60);
			$minute = $minContainer%60;
		}
		echo $this->Time->format($heure*3600+$minute*60, "HH:mm");
	}
	else{
		echo "--:--";
	}
?>