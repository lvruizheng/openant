<!--顶部轮播-->
<div class="swiper-container swiper-banner">
    <div class="swiper-wrapper">	
		<?php foreach($banners as $k=>$v):?>
			<div class="swiper-slide"><a href="$banners[$k]['link']"><img src="<?php echo $banners[$k]['image'];?>" /></a></div>
		<?php endforeach;?>
    </div>
    <div class="swiper-pagination"></div>
</div>
