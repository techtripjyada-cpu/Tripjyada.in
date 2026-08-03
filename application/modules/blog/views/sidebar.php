<div class="widget-items mb-40">
	<?php
	$city = "India";
	$keyw = array(
		"Movers near me $city", "Packers and movers in $city", "Moving companies near me $city", "Movers $city", "Packers and movers near me $city",
		"Removal companies in $city", "Moving services in $city", "Cheap movers in $city", "Local movers in $city", "Local moving companies in $city",
		"$city best moving companies", "House movers $city", "Packers movers $city", "Moving services near $city", "House removals $city", "Cheap moving companies in $city",
		"Professional movers in $city", "House movers near $city", "Cheap movers $city", "Best packers and movers in $city", "Affordable movers $city", "International movers from $city", "International moving companies in $city"
	);
	?>
	<h6>Relevant Keywords in <?= $city ?></h6>
	<ul class="inline">
		<?php
		shuffle($keyw);
		foreach ($keyw as $k) { ?>
			<li class="badge badge-secondary"><?= $k ?></li>
		<?php } ?>
	</ul>
</div>