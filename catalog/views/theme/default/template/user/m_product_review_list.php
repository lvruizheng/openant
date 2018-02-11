<?php echo $header;//装载header?>

<header class="wy-header" style="position:fixed; top:0; left:0; right:0; z-index:200;">
  <div class="wy-header-icon-back"><span onclick="window.history.go(-1);"></span></div>
  <div class="wy-header-title">评价</div>
</header>

<div class='weui-content'>
  <div class="user-info">
<?php if(!empty($orders)):?>
  	
  <div class="weui-tab">
		<?php if(isset($orders['products'])):?>
			  <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
				<div class="weui-panel weui-panel_access">
				  
				  <div class="weui-media-box__bd  pd-10">
						
					<?php if(!empty($orders['products'])):?>
						<?php foreach($orders['products'] as $key=>$value):?>
							<div class="weui-media-box_appmsg ord-pro-list">
							  <div class="weui-media-box__hd">
									<a href="<?php echo $this->config->item('catalog').'product?product_id='.$orders['products'][$key]['product_id'];?>">
										<img class="weui-media-box__thumb" src="<?php echo '/'.$this->image_common->resize($orders['products'][$key]['image'], $this->config->get_config('product_list_image_size_w'), $this->config->get_config('product_list_image_size_h'));?>" alt="">
									</a>
							  </div>
							  <div class="weui-media-box__bd">
								<h1 class="weui-media-box__desc">
									<a href="<?php echo $this->config->item('catalog').'product?product_id='.$orders['products'][$key]['product_id'];?>" class="ord-pro-link">
										<?php echo $orders['products'][$key]['name']; ?>
									</a>
								</h1>
								<p class="weui-media-box__desc">
									<?php echo !empty($orders['products'][$key]['value']) ? $orders['products'][$key]['value'] : '';?>
								</p>
								<div class="clear mg-t-10">
								  <div class="wy-pro-pri fl"><em class="num font-15"><?php echo $this->currency->Compute($orders['products'][$key]['price'] * $orders['currency_value']);?></em></div>
								  <div class="pro-amount fr">
									<span class="font-13">
										<?php if($orders['order_status_id'] == $this->config->get_config('state_to_be_evaluated') && $value['is_review'] == false):?>
											<a href="<?php echo $this->config->item('catalog').'user/orders/product_review?order_id='.$orders['order_id'].'&product_id='.$value['product_id'].'&order_product_id='.$value['order_product_id']; ?>" class="ords-btn-dele">去评价</a>
										<?php else:?>
											<a href="javascript:;" class="ords-btn-dele">已评价</a>
										<?php endif;?>
									</span>
								  </div>
								</div>
							  </div>
							</div>
						<?php endforeach;?>
					<?php endif;?>
					
				  </div>

				  
				  

				</div>
			  </div>
	
		<?php endif;?>
	</div>
<?php else:?>
		<dl class="ok-info">
			<dt><img src="/resources/public/resources/mobile/images/icon_nav_article.png"></dt>
			<dd>没有订单需要处理</dd>
		</dl>

<?php endif;?>


  </div>
</div>

<script>

$('#to_delivered').on('click',function(){
	var order_id = $(this).attr('order_id');
	$.confirm("您确定已收到货物?", "确认收货?", function() {
		window.location.href = '<?php echo $this->config->item('catalog').'user/orders/edit_logistic?order_id='; ?>'+order_id;
	});
});

</script>


<?php echo $footer;//装载header?>
