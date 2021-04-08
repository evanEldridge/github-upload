<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

$movie = $_GET["film"];


$info = file($movie.'/info.txt');
for ($i = 0; $i < count($info); $i++) {
	$info[$i] = trim($info[$i]);
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
	</head>

	<body>

		<div class="center">

			<div class="banner">
				<img src="http://watzek.lclark.edu/cs/293spr2021/ex2/rancidbanner.png" alt="Rancid Tomatoes"/>
			</div>

			<h1><?= $info[0]." (".$info[1].")"; ?></h1>

			<div class="content">

				<div class="overview">

					<div>
						<img src="<?= $movie.'/overview.png'; ?>" alt="general overview" />
					</div>

					<dl>

						<?php
							$overview = file($movie.'/overview.txt');
							for ($i = 0; $i < count($overview); $i++) {
								$overview[$i] = explode(":", $overview[$i]);

								if($overview[$i][0] == "STARRING" || $overview[$i][0] == "GENRE") {
									$overview[$i][1] = explode(", ", $overview[$i][1]);
								}
							}
							for ($i = 0; $i < count($overview); $i++) {
						?>
							<dt><?= $overview[$i][0]; ?></dt>
							<dd>
							<?php
								if($overview[$i][0] == "STARRING" || $overview[$i][0] == "GENRE") {
									for ($x = 0; $x < count($overview[$i][1]); $x++) {
							?>
										<?= $overview[$i][1][$x]; ?> <br />
									<?php } ?>
								<?php } ?>
							<?= $overview[$i][1]; ?> <br />
							<?php } ?>
							</dd>

					</dl>

				</div>

				<div class="reviews">

					<div class="rating">
						<?php
							if ($info[2] > 60) {
								$tomato = "https://watzek.lclark.edu/cs/293spr2021/ex2/freshlarge.png";
							}
							else {
								$tomato = "http://watzek.lclark.edu/cs/293spr2021/ex2/rottenlarge.png";
							}
						?>
						<img src=<?= $tomato; ?> alt="Rotten" />
						<span class="percent"><?= $info[2]."%"; ?></span>
					</div>
					
					<div class="col">

						<?php
							$review_files = glob($movie."/review*.txt");
							$reviews = [];

							if (count($review_files) % 2 == 0) {
								$length_1 = count($review_files) / 2;
							}

							else {
								$length_1 = (count($review_files) + 1) / 2;
							}

							for ($i = 0; $i < count($review_files); $i++) {
								$reviews[$i] = file($review_files[$i]);
								
							}
							for ($i = 0; $i < $length_1; $i++) {
						?>
							<p class="quote">
								<?php 
									$freshness = trim($reviews[$i][1]);
									if ($freshness == "ROTTEN") { $img_source = "http://watzek.lclark.edu/cs/293spr2021/ex2/rotten.gif"; }
									else { $img_source = "http://watzek.lclark.edu/cs/293spr2021/ex2/fresh.gif"; }
								?>
								<img src=<?= $img_source; ?> alt=<?= $freshness; ?> />
								<q><?= $reviews[$i][0]; ?></q>
							</p>
							<p>
								<img src="http://watzek.lclark.edu/cs/293spr2021/ex2/critic.gif" alt="Critic" />
								<?= $reviews[$i][2]; ?> <br />
								<span class="magazine"><?= $reviews[$i][3]; ?></span>
							</p>
						<?php } ?>

					</div>

					<div class="col">

						<?php
							for ($i = $length_1; $i < count($reviews); $i++) {
						?>
							<p class="quote">
								<?php 
									$freshness = trim($reviews[$i][1]);
									if ($freshness == "ROTTEN") { $img_source = "http://watzek.lclark.edu/cs/293spr2021/ex2/rotten.gif"; }
									else { $img_source = "http://watzek.lclark.edu/cs/293spr2021/ex2/fresh.gif"; }
								?>
								<img src=<?= $img_source; ?> alt=<?= $freshness; ?> />
								<q><?= $reviews[$i][0]; ?></q>
							</p>
							<p>
								<img src="http://watzek.lclark.edu/cs/293spr2021/ex2/critic.gif" alt="Critic" />
								<?= $reviews[$i][2]; ?> <br />
								<span class="magazine"><?= $reviews[$i][3]; ?></span>
							</p>
						<?php } ?>

					</div>

				</div>

				<p><?= "(1-".count($reviews).") of ".count($reviews) ?></p>

			</div>

		</div>

		<div class="validate">
			<a href="https://validator.w3.org/"><img src="http://watzek.lclark.edu/cs/293spr2021/ex2/w3c-html.png" alt="Valid HTML5" /></a><br />
			<a href="https://jigsaw.w3.org/css-validator/"><img src="http://watzek.lclark.edu/cs/293spr2021/ex2/w3c-css.png" alt="Valid CSS" /></a>
		</div>
	</body>
</html>