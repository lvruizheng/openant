<?php echo $header;//装载header?>

<?php if(isset($products)):?>
		<?php foreach($products as $product):?>
			<div class="pro-items">
			  <div class="weui-media-box weui-media-box_appmsg">
				<div class="weui-media-box__hd"><a href="<?php echo $this->config->item('catalog').'product?product_id='.$product['product_id'];?>"><img class="weui-media-box__thumb" src="/<?php echo $this->image_common->resize($product['image'], $this->config->get_config('product_list_image_size_w'), $this->config->get_config('product_list_image_size_h'), 'h');?>" alt=""></a></div>
				<div class="weui-media-box__bd">
				  <h1 class="weui-media-box__desc"><a href="<?php echo $this->config->item('catalog').'product?product_id='.$product['product_id'];?>" class="ord-pro-link"><?php echo isset($search) ? highlight_phrase($product['name'], $search) : $product['name'];?></a></h1>
				  <div class="wy-pro-pri"><em class="num font-15"><?php echo $this->currency->Compute($product['price']);?></em></div>
				  <ul class="weui-media-box__info prolist-ul">
					<li class="weui-media-box__info__meta"><a href="javascript:;" class="wy-dele"></a></li>
				  </ul>
				</div>
			  </div>
			</div>
		<?php endforeach;?>
	<?php endif;?>



<?php echo $footer;//装载header?>
