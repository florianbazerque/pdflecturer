<?php
 
// Include Composer autoloader if not already done.
include '../vendor/autoload.php';
 
if(isset($_POST['search']) && !empty($_POST['search']))
{
	$search = $_POST['search'];
	if($folder = opendir('../pdf'))
	{
		while(false !== ($file = readdir($folder)))
		{
			if($file != '.' && $file != '..' && $file != 'index.php')
			{
				// Parse pdf file and build necessary objects.
				$parser = new \Smalot\PdfParser\Parser();
				$pdf    = $parser->parseFile('../pdf/'.$file);
				 
				$text = $pdf->getText();
				$regex = "%nom du patient :\s+".strtolower($search)."%";
				if (preg_match($regex, strtolower($text)))
				{
					$name = stristr($text, 'Date de naissance', true);
					$name = substr($name, 17);
					echo '<li><button value="'.$file.'">'.$name.'</button></li>';
				}
			}
		}
	}
}
