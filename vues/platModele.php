<?php
require_once '../persistance/dialogueBD.php';
$undlg = new DialogueBD();

$id = isset($_GET['id']) ? $_GET['id'] : null;
$info = $undlg->getPlatById($id);
$allergene = $undlg->getAllergene();
$mesAllergenes = $undlg->getAllergenesByPlat($id);
$monPays = $undlg->getPays();
foreach ($info as $plat) {
	$intitule = $plat['LIBPLAT'];
	$pays = $plat['IDPAYS'];
	$imgPlat = $plat['IMGPLAT'];
	$description = $plat['DESCPLAT'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>
		<?php echo $intitule; ?> - Fujin
	</title>
	<link rel="stylesheet" href="../lib/css/plat.css">
</head>

<body>
	<?php require_once("menu.php"); ?>
	<div class="parent-container">
		<div class="info-container">
			<div class="img-container">
				<?php echo "<img id='imgPlat' src=\"../images/{$imgPlat}\" alt=\"{$imgPlat}\">"; ?>
				<div class="descImg">
					<?php foreach ($monPays as $ligne) {
						$id = $ligne['idpays'];
						$lib = $ligne['libpays'];
						if ($id == $pays) {
							echo '<svg fill="#05445E" width="123px" height="123px" viewBox="0 -1.73 51.467 51.467" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="_7" data-name="7" transform="translate(-289.267 -251.5)"> <path id="Path_211" data-name="Path 211" d="M311.593,254.752a30.771,30.771,0,0,1,5.363-.091,1.778,1.778,0,0,0,.109-1.579,3.029,3.029,0,0,0-2.331-1.549,3.417,3.417,0,0,0-3.547,1.507,1.913,1.913,0,0,0,.173,1.742C311.446,254.812,311.515,254.83,311.593,254.752Z"></path> <path id="Path_212" data-name="Path 212" d="M336.39,265.913c-5.174-7.442-13.544-10.629-22.336-10.494a26.3,26.3,0,0,0-17.418,6.884,17.894,17.894,0,0,0-5.886,13.572h48.541A17.056,17.056,0,0,0,336.39,265.913Z"></path> <path id="Path_213" data-name="Path 213" d="M340.722,277.678a1.51,1.51,0,0,0-.982-1.009H290.609c-.28.088-.551,0-.812.169-.83.488-.448,1.666-.4,2.441a1.371,1.371,0,0,0,1.116.857h48.8a1.5,1.5,0,0,0,1-.249c.1-.1.221-.3.28-.3A5.56,5.56,0,0,0,340.722,277.678Z"></path> <path id="Path_214" data-name="Path 214" d="M300.158,282.365a.7.7,0,0,0-.132.63c.469.86,1.446.643,2.327.706a.671.671,0,0,0,.071.533c.409.743,1.261.6,2,.65a.556.556,0,0,0-.036.416,1.276,1.276,0,0,0,.951.6h11.251l.022-3.932H301.23A1.561,1.561,0,0,0,300.158,282.365Z"></path> <path id="Path_215" data-name="Path 215" d="M332.139,281.963h-6.623V297.59h6.614Z"></path> <path id="Path_216" data-name="Path 216" d="M317.421,289.628H322.5v-7.665h-5.078Zm1-1.747a.761.761,0,0,1,1.094-.025.812.812,0,0,1,.167.7.844.844,0,0,1-.414.467.785.785,0,0,1-.677-.046.893.893,0,0,1-.332-.531A.76.76,0,0,1,318.425,287.881Z"></path> <path id="Path_217" data-name="Path 217" d="M332.972,298.488H329.44V299.5h9.573V281.963h-6.042Z"></path> </g> </g></svg>';
							echo "<span id='libPlat'>$intitule,<br>";
							echo "$lib</span>";
						}
					} ?>
				</div>
			</div>
			<div class="desc-container">
				<div class="descPlat">
					<?php echo "<p>$description</p>"; ?>
				</div>
				<div class="allergene-container">
					<h3>Allergènes</h3>
					<?php
					$libelles = array();
					foreach ($allergene as $ligne) {
						$id = $ligne['IDALLERGENE'];
						$isAllergeneFound = false;
						foreach ($mesAllergenes as $lignes) {
							$idAllergene = $lignes['IDALLERGENE'];
							if ($id == $idAllergene) {
								$isAllergeneFound = true;
								$libelles[] = "<span class='red'>" . $ligne['LIBALLERGENE'] . "</span>";
								break;
							}
						}
						if (!$isAllergeneFound) {
							$libelles[] = $ligne['LIBALLERGENE'];
						}
					}
					$first_line = implode(' - ', array_slice($libelles, 0, 5));
					$second_line = implode(' - ', array_slice($libelles, 5));
					echo "<p>" . $first_line . "<br>" . $second_line . "</p>";
					?>
				</div>

			</div>
		</div>
	</div>

</body>

</html>