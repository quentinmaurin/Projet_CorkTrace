<?php

	function isLongueurConforme($echantillon,$lgMax,$lgMin,$nbTolerance){
		$nbRebus=0;
		foreach ($echantillon as $value) {
			if($value>$lgMax || $value<$lgMin){
				$nbRebus++;
			}
		}
		return ($nbRebus<=$nbTolerance);
	}
	
	function isDiametreConforme($echantillon,$dmMax,$dmMin,$nbTolerance){
		$nbRebus=0;
		foreach ($echantillon as $value) {
			if($value>$dmMax || $value<$dmMin){
				$nbRebus++;
			}
		}
		return ($nbRebus<=$nbTolerance);
	}
	
	function isOvalisationConforme($echantillon,$ovMax,$nbTolerance){
		$nbRebus=0;
		foreach ($echantillon as $value) {
			if($value>$ovMax){
				$nbRebus++;
			}
		}
		return ($nbRebus<=$nbTolerance);
	}
	
	function sourcesNonConformite($echantillonLg,$lgMax,$lgMin,$nbToleranceLg,
								   $echantillonDm,$dmMax,$dmMin,$nbToleranceDm,
								   $echantillonOv,$ovMax,$nbToleranceOv,
								   $gout,$goutAcceptation,
								   $tcaFou, $toleranceTcaFou,
								   $tcaInt, $toleranceTcaInt,
								   $capilarite,
								   $humidite,$hmMax,$hmMin,
								   $diamCompr, $toleranceDiamCompr){

		$tabConfo['Longueur']=isLongueurConforme($echantillonLg,$lgMax,$lgMin,$nbToleranceLg);
		$tabConfo['Diametre']=isDiametreConforme($echantillonDm,$dmMax,$dmMin,$nbToleranceDm);
		$tabConfo['Ovalisation']=isOvalisationConforme($echantillonOv,$ovMax,$nbToleranceOv);
		$tabConfo['Gout']=($gout==$goutAcceptation);
		$tabConfo['TCAFournisseur']=($tcaFou<$toleranceTcaFou);
		$tabConfo['TCAInterne']=($tcaInt<$toleranceTcaInt);
		$tabConfo['Capilarite']=($capilarite==1);
		$tabConfo['Humidite']=($humidite<$hmMax && $humidite>$hmMin);
		$tabConfo['DiametreCompression']=($diamCompr>$toleranceDiamCompr);
						   
		return $tabConfo;
	}

	function isEchantillonConforme($echantillonLg,$lgMax,$lgMin,$nbToleranceLg,
								   $echantillonDm,$dmMax,$dmMin,$nbToleranceDm,
								   $echantillonOv,$ovMax,$nbToleranceOv,
								   $gout,$goutAcceptation,
								   $tcaFou, $toleranceTcaFou,
								   $tcaInt, $toleranceTcaInt,
								   $capilarite,
								   $humidite,$hmMax,$hmMin,
								   $diamCompr, $toleranceDiamCompr){
			
		$tabSourcesNonConformite=sourcesNonConformite($echantillonLg,$lgMax,$lgMin,$nbToleranceLg,
								   $echantillonDm,$dmMax,$dmMin,$nbToleranceDm,
								   $echantillonOv,$ovMax,$nbToleranceOv,
								   $gout,$goutAcceptation,
								   $tcaFou,$toleranceTcaFou,
								   $tcaInt,$toleranceTcaInt,
								   $capilarite,
								   $humidite,$hmMax,$hmMin,
								   $diamCompr,$toleranceDiamCompr);
		$conforme=1;					   
		foreach($tabSourcesNonConformite as $value){
			if(!$value){
				$conforme=0;
			}
		}
		return conforme;
	}
?>