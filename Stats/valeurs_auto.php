<?php

	function taux_humidite()		{				return (mt_rand(390,810) / 100);				}
	function taux_compression()		{				return (mt_rand(880,1000) / 100);				}
	function TCA_prestataire()		{				return mt_rand(0,210) / 100;					}
	function TCA_interne()			{				return mt_rand(0,205) / 100;					}
	function capillarite()			{				return mt_rand(0,120) / 100;					}

	function gout()
	{
		if (mt_rand(0,100) < 90)		return 1;
		else							return 0;
	}

	function dimensions($hauteur, $nb_val)
	{
		for ($i=0; $i<$nb_val; $i++)
		{
				$array_valeurs[$i][0] = mt_rand(($hauteur * 100)-100, ($hauteur * 100)+100) / 100;
				$array_valeurs[$i][1] = mt_rand(2300, 2500) / 100;
				$array_valeurs[$i][2] = mt_rand(0,80) / 100;
		}
		return $array_valeurs;
	}

	function valeurs_arrivage($hauteur)
	{
		$valeurs[0] = dimensions($hauteur,16);
		$valeurs[1] = taux_humidite();
		$valeurs[2] = taux_compression(5);
		$valeurs[3] = TCA_prestataire(50);
		$valeurs[4] = TCA_interne();
		$valeurs[5] = gout();
		
		return $valeurs;
	}

	function valeurs_commande($hauteur)
	{
		$valeurs[0] = dimensions($hauteur,8);
		$valeurs[1] = taux_humidite();
		$valeurs[2] = taux_compression(5);
		$valeurs[3] = TCA_interne();
		$valeurs[4] = capillarite();
		$valeurs[5] = gout();
		
		return $valeurs;
	}

?>