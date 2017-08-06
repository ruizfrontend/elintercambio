<div class="bl-aliados clearfix">
	<?php foreach ($projData['homeData']['textos_aliados'] as $idx => $sect): ?>
		<div class="bl-aliados-sct">

			<h4><i class="fa fa-chevron-circle-right" aria-hidden="true"></i><?php echo $sect['titulo']; ?></h4>
			<?php if($sect['descripcion']): ?><p><?php echo $sect['descripcion']; ?></p><?php endif; ?>

			<?php switch($idx): 
				case 0: // financiación ?>
					<div class="bl-financiacion clearfix">
						<?php foreach ($projData['homeData']['fundaciones'] as $idx => $fundacion): ?>
							
							<?php if (count($projData['homeData']['fundaciones']) > 6 && $idx % 6 == 0) :?>
								<div class="bl-financiacion-slide bl-financiacion-slide-<?php echo intval($idx / 6); ?> clearfix">
							<?php endif; ?>

								<?php if($fundacion['url']): ?>
									<div class="blck-logo">
										<a target="_blank" href="<?php echo $fundacion['url']; ?>" title="<?php echo $fundacion['nombre']; ?>">
											<img src="<?php echo $fundacion['logo']['url']; ?>" width="<?php echo $fundacion['logo']['width']; ?>" height="<?php echo $fundacion['logo']['height']; ?>" alt="<?php echo $fundacion['logo']['alt']; ?>" title="<?php echo $fundacion['logo']['title']; ?>">
										</a>
									</div>
								<?php else: ?>
									<div class="blck-logo">
										<img src="<?php echo $fundacion['logo']['url']; ?>" width="<?php echo $fundacion['logo']['width']; ?>" height="<?php echo $fundacion['logo']['height']; ?>" alt="<?php echo $fundacion['logo']['alt']; ?>" title="<?php echo $fundacion['logo']['title']; ?>">
									</div>
								<?php endif; ?>

							<?php if (count($projData['homeData']['fundaciones']) > 6 && ($idx % 6 == 5 || $idx == count($projData['homeData']['medios']) - 1)) :?>
								</div>
							<?php endif; ?>

						<?php endforeach; ?>
					</div>
				<?php break; ?>

				<?php case 1: // desarrollo ?>
					<img style="display: block; margin: 0 auto 1.4em auto;" src="<?php echo $projData['homeUrl']; ?>/wp-content/uploads/2017/07/logo-medio-bl.png" alt="">
				<?php break; ?>

				<?php case 2: // publicación ?>
					<div class="bl-financiacion clearfix">
						<?php foreach ($projData['homeData']['medios'] as $idx => $fundacion): ?>
							
							<?php if (count($projData['homeData']['medios']) >= 6 && $idx % 6 == 0) :?>
								<div class="bl-financiacion-slide bl-financiacion-slide-<?php echo intval($idx / 6); ?> clearfix">
							<?php endif; ?>

								<?php if($fundacion['url']): ?>
									<div class="blck-logo">
										<a target="_blank" href="<?php echo $fundacion['url']; ?>" title="<?php echo $fundacion['nombre']; ?>">
											<img style="display: block; margin: 0 auto 1em auto;" src="<?php echo $fundacion['logo']['url']; ?>" width="<?php echo $fundacion['logo']['width']; ?>" height="<?php echo $fundacion['logo']['height']; ?>" alt="<?php echo $fundacion['logo']['alt']; ?>" title="<?php echo $fundacion['logo']['title']; ?>">
										</a>
									</div>
								<?php else: ?>

									<div class="blck-logo">
										<img src="<?php echo $fundacion['logo']['url']; ?>" width="<?php echo $fundacion['logo']['width']; ?>" height="<?php echo $fundacion['logo']['height']; ?>" alt="<?php echo $fundacion['logo']['alt']; ?>" title="<?php echo $fundacion['logo']['title']; ?>">
									</div>
								<?php endif; ?>

							<?php if (count($projData['homeData']['medios']) >= 6 && ($idx % 6 == 5 || $idx == count($projData['homeData']['medios']) - 1)) :?>
								</div>
							<?php endif; ?>

						<?php endforeach; ?>
					</div>
				<?php break; ?>

			<?php endswitch; ?>
		</div>
	<?php endforeach; ?>
</div>