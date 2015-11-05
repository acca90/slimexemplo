<?php

	$retorno = "";

	function curl($dados="",$tipo="",$meta="",$GET=false) {


		if ($GET) {
			$curl = curl_init("http://localhost/rest/rest.php/exemplo/" . $dados);
		} else {
			$curl = curl_init("http://localhost/rest/rest.php/exemplo");
		}



		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		/* PARA METODOS POST, PUT e DELETE */
		if (!$GET) curl_setopt($curl, $meta, $tipo);
		if (!$GET) curl_setopt($curl, CURLOPT_POSTFIELDS, $dados);

		//curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));

		$curl_response = curl_exec($curl);
		curl_close($curl);

		return $curl_response;
	}

	$dados = "";

	if ($_POST) {

		$dados = $_POST['dados'];

		switch ($_POST['metodo']) {
			case 'GET':
				$retorno = curl($_POST['dados'],"","",true);
				break;
			case 'POST':
				$retorno = curl($_POST['dados'],"POST",CURLOPT_POST);
				break;
			case 'PUT':
				$retorno = curl($_POST['dados'],"PUT",CURLOPT_CUSTOMREQUEST);
				break;
			case 'DELETE':
				$retorno = curl($_POST['dados'],"DELETE",CURLOPT_CUSTOMREQUEST);
				break;
		
		}

	}



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<br>

<form action="client.php" method="POST">
	<center>
		<table>
			<tr>
				<td valign="TOP">
					<input type="hidden" id='met' name='metodo'>
					<input onclick="document.getElementById('met').value='GET'" style="width:80px" type="submit" value="GET"><br>
					<input onclick="document.getElementById('met').value='POST'" style="width:80px" type="submit" value="POST"><br>
					<input onclick="document.getElementById('met').value='PUT'" style="width:80px" type="submit" value="PUT"><br>
					<input onclick="document.getElementById('met').value='DELETE'" style="width:80px" type="submit" value='DELETE'>
				</td>
				<td valign="TOP">
					<textarea placeholder="Dados" name="dados" style="width:500px; height:94px;"><?php echo $dados;?></textarea><br>
					<textarea placeholder="Retorno" style="width:500px; height:200px;"><?php echo $retorno; ?></textarea>
				</td>
			</tr>
		</table>
	</center>
</form>




</body>
</html>