<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/phar.css" media="screen">
</head>

<body>
<?php
//define ('INCLUDE_DIR', 'Protože to osTicket chce');
//include ($_SERVER['DOCUMENT_ROOT'].'/cis-ticket/include/ost-config.php');

if($_POST){
	switch(true)
		{
			case isset($_POST['ExtractFileName']):
				echo rrmdir('ExtractedPHAR');

				$odesilatel = $_POST['ExtractFileName'];

				$phar = new Phar($odesilatel.'.phar');
				$phar->extractTo('./ExtractedPHAR'); // extract all files
				$Message="File ".$odesilatel.".phar unpacked";
			break;
			
			case isset($_POST['PackFileName']):
				$odesilatel = $_POST['PackFileName'];
				unlink($odesilatel.".phar");

				$phar = new Phar($odesilatel.'.phar');
				$phar->buildFromDirectory('./ExtractedPHAR');
				$Message="File ".$odesilatel.".phar packed";
			break;
		}
	 }
if (!empty($Message)) {echo "<div id='hideMe'><h2>".$Message."</h2></div>";}
?>
	<div id="unpack">
		<table>
			<tr>
				<td>
					<h1 class="left">Unpack PHAR</h1>
				</td>
			</tr>
			<tr>
				<td>
					<div class="left">
						Directory ExtractedPHAR will be deleted, if exist! <br><br><br> 
						PHAR file name <br>
					</div>
					
					<form method="post" action="" >
						<input class="text" type="text" name="ExtractFileName" value="../include/i18n/cs"/>.phar<br /> 
						<input class="button" type="submit" name="odeslano" value="Unpack" /> 
					</form>
				</td>
				</td>
			</tr>
		</table>
	</div>
	
	<div id="pack">

		<table>
			<tr>
				<td>
					<h1 class="left">Pack PHAR</h1>
				</td>
			</tr>
			<tr>
				<td  class="left">
					<div class="left">
						PHAR file will be deleted, if exist! <br><br><br>
						PHAR file name <br>
					</div>
					
					<form method="post" action="" > 
						<input class="text" type="text" name="PackFileName"  value="../include/i18n/cs"/>.phar<br>
						<input class="button" type="submit" name="odeslano" value="Pack" /> 
					</form>
				</td>
				</td>
			</tr>
		</table>
	</div>

</body>

<?php
function rrmdir($dir) {
					if (is_dir($dir)) { 
					$objects = scandir($dir); 
					foreach ($objects as $object) 
					{ 
						if ($object != "." && $object != "..") 
						{
							if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); 
							else unlink($dir."/".$object);
						} 
					}
					reset($objects); 
					rmdir($dir); 
					}
				} 
?>