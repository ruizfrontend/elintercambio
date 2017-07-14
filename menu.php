<?php global $projData; ?>

<div id="menu">
	<div id="menu-wrap" class="clearfix">
		<div id="menu-wrap-inn">
			<div class="menu-left">
				<?php foreach ($projData['homeData']['menu'] as $elm): ?>

					<?php if ($elm['nombre'] == 'Home'): ?>
						<a class="<?php echo $projData['isHome'] ? 'act' : ''; ?>" href="<?php echo $projData['homeUrl']; ?>">
							<img src="<?php echo $projData['homeUrl'] ?>/wp-content/uploads/2017/07/logo-white-bis.png" alt="">
						</a>
					<?php endif ?>
				<?php endforeach; ?>
			</div>
			<div class="menu-right"><div class="menu-right-wrap">
				<?php foreach ($projData['homeData']['menu'] as $elm): ?>

					<?php if ($elm['nombre'] !== 'Home'): ?>
						<?php $url = (substr($elm['url'], 0, 1) == '#' ? ($projData['isHome'] ? '' : $projData['homeUrl']) : '' ) . $elm['url']; ?>
						<a href="<?php echo $url; ?>"><?php echo $elm['nombre']; ?></a>
					<?php endif ?>
				<?php endforeach; ?>
			</div></div>
			<a class="ham" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
		</div>
		<div id="menu-wrap-inn-white">
			<div class="menu-left">
				<?php foreach ($projData['homeData']['menu'] as $elm): ?>

					<?php if ($elm['nombre'] == 'Home'): ?>
						<a class="<?php echo $projData['isHome'] ? 'act' : ''; ?>" href="<?php echo $projData['homeUrl']; ?>">
							<img src="<?php echo $projData['homeUrl'] ?>/wp-content/uploads/2017/07/logo-black-bis-bis.png" alt="">
						</a>
					<?php endif ?>
				<?php endforeach; ?>
			</div>
			<div class="menu-right"><div class="menu-right-wrap">
				<?php foreach ($projData['homeData']['menu'] as $elm): ?>

					<?php if ($elm['nombre'] !== 'Home'): ?>
						<?php $url = (substr($elm['url'], 0, 1) == '#' ? ($projData['isHome'] ? '' : $projData['homeUrl']) : '' ) . $elm['url']; ?>
						<a href="<?php echo $url; ?>"><?php echo $elm['nombre']; ?></a>
					<?php endif ?>
				<?php endforeach; ?>
			</div></div>
			<a class="ham" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
		</div>
	</div>
</div>