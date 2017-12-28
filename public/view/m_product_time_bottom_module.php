<?php if(isset($products)):?>
<?php $id=rand(1, 999)?>

<!--酒水专场-->
  <div class="wy-Module">
    <div class="wy-Module-tit"><span><?php echo $view_name;?></span></div>
    <div class="wy-Module-con">
      <div class="swiper-container swiper-jiushui" style="padding-top:34px;">
        <div class="swiper-wrapper swiper-con product-new-list-<?php echo $id;?>">


		<?php foreach($products as $product):?>
          <div class="swiper-slide">
          	<a href="<?php echo $this->config->item('catalog');?>product?product_id=<?php echo $product['product_id'];?>">
          	  <dl>
          	  	<dt><?php echo mb_substr($product['name'],0,8,'utf-8').'...';?></dt>
          	  	<dd><?php echo $this->currency->Compute($product['price']);?></dd>
          	  	<dd><img src="<?php echo $this->image_common->resize($product['image'], $this->config->get_config('product_list_image_size_w'), $this->config->get_config('product_list_image_size_h'), 'h');?>" alt="<?php echo $product['name'];?>"></dd>
          	  </dl>
          	</a>
          </div>
		<?php endforeach;?>
          

        </div>
        <div class="swiper-pagination jingxuan-pagination"></div>
      </div>
    </div>
  </div>

<?php endif;?>
