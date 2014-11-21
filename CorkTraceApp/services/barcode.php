<?php

	require_once('barcodegen/class/BCGFontFile.php');
	require_once('barcodegen/class/BCGColor.php');
	require_once('barcodegen/class/BCGDrawing.php');
	require_once('barcodegen/class/BCGcode39.barcode.php');
	
	$codebarre = $_GET['id'];
	$tailleScale = $_GET['taille'];
	
	// The arguments are R, G, and B for color.
	$colorFont = new BCGColor(0, 0, 0);
	$colorBack = new BCGColor(255, 255, 255);

	$font = new BCGFontFile('barcodegen/font/Arial.ttf', 16);
	

	$code = new BCGcode39(); // Or another class name from the manual
	$code->setScale($tailleScale); // Resolution
	$code->setThickness(30); // Thickness
	$code->setForegroundColor($colorFont); // Color of bars
	$code->setBackgroundColor($colorBack); // Color of spaces
	$code->setFont($font); // Font (or 0)
	$code->parse($codebarre); // Text
	
	$drawing = new BCGDrawing('', $colorBack);
	$drawing->setBarcode($code);
	$drawing->draw();

	//header('Content-Type: image/png');

	$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
		
?>