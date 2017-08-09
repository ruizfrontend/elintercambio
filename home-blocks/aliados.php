<div class="bl-aliados clearfix">
	<?php foreach ($projData['homeData']['textos_aliados'] as $idx => $sect): ?>
		<div class="bl-aliados-sct">

			<h4><i class="fa fa-chevron-circle-right" aria-hidden="true"></i><?php echo $sect['titulo']; ?></h4>
			<?php if($sect['descripcion']): ?><p><?php echo $sect['descripcion']; ?></p><?php endif; ?>

			<?php switch($idx): 
				case 0: // financiación ?>
					<div class="bl-financiacion swiper-container clearfix">
						
						<?php if (count($projData['homeData']['fundaciones']) > 4): ?>
						    <div class="swiper-button-prev" title="anterior"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></div>
						    <div class="swiper-button-next" title="siguiente"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></div>
						<?php endif; ?>

						<div class="swiper-wrapper">

							<?php foreach ($projData['homeData']['fundaciones'] as $idx => $fundacion): ?>
								
								<?php if (count($projData['homeData']['fundaciones']) > 4 && $idx % 4 == 0) :?>
									<div class="bl-financiacion-slide swiper-slide bl-financiacion-slide-<?php echo intval($idx / 4); ?> clearfix"><div class="swiper-slide-inn">
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

								<?php if (count($projData['homeData']['fundaciones']) > 4 && ($idx % 4 == 3 || $idx == count($projData['homeData']['medios']) - 1)) :?>
									</div></div>
								<?php endif; ?>

							<?php endforeach; ?>
						</div>
					</div>
				<?php break; ?>


				<?php case 1: // desarrollo ?>
					<img style="display: block; margin: 0 auto 1.4em auto;" src="<?php echo $projData['homeUrl']; ?>/wp-content/uploads/2017/07/logo-medio-bl.png" alt="">
				<?php break; ?>


				<?php case 2: // publicación ?>
					<div class="bl-publish swiper-container clearfix">
						
						<?php if (count($projData['homeData']['medios']) > 4): ?>
						    <div class="swiper-button-prev" title="anterior"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></div>
						    <div class="swiper-button-next" title="siguiente"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></div>
						<?php endif; ?>

						<div class="swiper-wrapper">

							<?php foreach ($projData['homeData']['medios'] as $idx => $fundacion): ?>
								
								<?php if (count($projData['homeData']['medios']) >= 4 && $idx % 4 == 0) :?>
									<div class="bl-publish-slide swiper-slide bl-publish-slide-<?php echo intval($idx / 4); ?> clearfix"><div class="swiper-slide-inn">
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

								<?php if (count($projData['homeData']['medios']) >= 4 && ($idx % 4 == 3 || $idx == count($projData['homeData']['medios']) - 1)) :?>
									</div></div>
								<?php endif; ?>

							<?php endforeach; ?>
						</div>
					</div>
				<?php break; ?>


			<?php endswitch; ?>
		</div>
	<?php endforeach; ?>
</div>