<?php if ($items = get_field('items')): ?>
<div class="wp-block-slider-gallery">
	<div class="slider-gallery" data-swiper-gallery>
		<button class="slider-gallery__close" data-swiper-gallery-close></button>
		<div class="slider-gallery-main">
			<div class="swiper-container" data-swiper-gallery-main>
				<div class="swiper-wrapper">
					<?php foreach ($items as $item): ?>
					<div class="swiper-slide">
						<img src="<?php echo $item['url'] ?>" alt="" />
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="slider-gallery-thumbs">
			<button class="slider-gallery-thumbs__prev"></button>
			<div class="swiper-container" data-swiper-gallery-thumbs>
				<div class="swiper-wrapper">
					<?php foreach ($items as $item): ?>
					<div class="swiper-slide">
						<img src="<?php echo $item['sizes']['thumbnail'] ?>" alt="" />
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<button class="slider-gallery-thumbs__next"></button>
			<div class="slider-gallery-thumbs__hr">
				<div class="ui-hr ui-hr_small"></div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
