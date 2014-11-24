<?php

	function taux_humidite($conforme)		
	{	
		if ($conforme == true)		return mt_rand(400,800) / 100;
		else 						return mt_rand(390,810) / 100;		
	}
	
	function taux_compression($conforme)		
	{	
		if ($conforme == true)		return mt_rand(900,1000) / 100;		
		else						return mt_rand(880,1000) / 100;			
	}
	
	function TCA_prestataire($conforme)		
	{				
		if ($conforme == true)		return mt_rand(0,200) / 100;
		else 						return mt_rand(200,300) / 100;			
	}
	
	function TCA_interne($conforme)			
	{		
		if ($conforme == true)		return mt_rand(0,200) / 100;
		else						return mt_rand(200,300) / 100;			
	}
	
	function capillarite($conforme)			
	{		
		if ($conforme == true)		return mt_rand(0,100) / 100;	
		else 						return mt_rand(100,500) / 100;
	}

	function gout()
	{
		if ($conforme == true)		return 1;
		else						return 0;
	}

	function dimensions($hauteur, $nb_val, $conforme)
	{
		if ($conforme == true)
		{
			for ($i=0; $i<$nb_val; $i++)
			{
				$array_valeurs[$i][0] = mt_rand($hauteur*100,$hauteur*100) / 100;
				$array_valeurs[$i][1] = mt_rand(2350,2450) / 100;
				$array_valeurs[$i][2] = mt_rand(0,70) / 100;
			}
		}
		else
		{
			for ($i=0; $i<$nb_val; $i++)
			{
				$array_valeurs[$i][0] = mt_rand($hauteur*100-100,$hauteur*100+100) / 100;
				$array_valeurs[$i][1] = mt_rand(2300,2500) / 100;
				$array_valeurs[$i][2] = mt_rand(70,100) / 100;
			}
		}

		return $array_valeurs;
	}

	function valeurs_arrivage($hauteur)
	{
		if (mt_rand(0,10) < 10)			$bool = true;
		else 							$bool = false;

		$valeurs[0] = dimensions($hauteur, 16, $bool);
		$valeurs[1] = taux_humidite($bool);
		$valeurs[2] = taux_compression($bool);
		$valeurs[3] = TCA_prestataire($bool);
		$valeurs[4] = TCA_interne($bool);
		$valeurs[5] = gout($bool);			
		
		return $valeurs;
	}

	function valeurs_commande($hauteur)
	{
		if (mt_rand(0,10) < 10)			$bool = true;
		else 							$bool = false;

		$valeurs[0] = dimensions($hauteur, 8, $bool);
		$valeurs[1] = taux_humidite($bool);
		$valeurs[2] = taux_compression($bool);
		$valeurs[3] = TCA_interne($bool);
		$valeurs[4] = capillarite($bool);
		$valeurs[5] = gout($bool);
		
		return $valeurs;
	}

?>