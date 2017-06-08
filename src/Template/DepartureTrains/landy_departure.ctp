<?php
	$minContainer = 0; // conteneur de minutes
	$heure = intval($heure);
	$minute = intval($minute);
	$docktime = intval($docktime);
	$dd = intval($dd);
	
	if( $heure !==0 || $minute !==0 ){
		if( $docktime !== 0 ){
			$minContainer= $heure*60+$minute - $docktime;
			$heure = intval($minContainer/60);
			$minute = $minContainer%60;
		}
		if( $dd !== 0 ){
			$minContainer= $heure*60+$minute - $dd;
			$heure = intval($minContainer/60);
			$minute = $minContainer%60;
		}
		echo $this->Time->format($heure*3600+$minute*60, "HH:mm");
	}
	else{
		echo "--:--";
	}
?>