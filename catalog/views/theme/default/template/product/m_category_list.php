<?php if(isset($products)):?>
		<?php foreach($products as $product):?>
				<div class="pro-items">
				  <a href="<?php echo $this->config->item('catalog').'product?product_id='.$product['product_id'];?>" class="weui-media-box weui-media-box_appmsg">
					<div class="weui-media-box__hd"><img class="weui-media-box__thumb" src="/<?php echo $this->image_common->resize($product['image'], $this->config->get_config('product_list_image_size_w'), $this->config->get_config('product_list_image_size_h'), 'h');?>" alt=""></div>
					<div class="weui-media-box__bd">
					  <h1 class="weui-media-box__desc"><?php echo isset($search) ? highlight_phrase($product['name'], $search) : $product['name'];?></h1>
					  <div class="wy-pro-pri"><em class="num font-15"><?php echo $this->currency->Compute($product['price']);?></em></div>
					  <ul class="weui-media-box__info prolist-ul">
						<li class="weui-media-box__info__meta"><em class="num"></em><?php echo sprintf(lang_line('sales'), (isset($product['seal_quantity']) ? $product['seal_quantity'] : '0'));?></li>
						<li class="weui-media-box__info__meta"><em class="num"></em><?php echo sprintf(lang_line('reviews'), (isset($product['reviews_quantity']) ? $product['reviews_quantity'] : '0'));?></li>
					  </ul>
					</div>
				  </a>
				</div>
		<?php endforeach;?>
<?php endif;?>
