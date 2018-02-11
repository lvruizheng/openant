<?php echo $header;//装载header?>

<header class="wy-header" style="position:fixed; top:0; left:0; right:0; z-index:200;">
  <div class="wy-header-icon-back"><span onclick="window.history.go(-1);"></span></div>
  <div class="wy-header-title">订单详情</div>
</header>

<div class='weui-content'>
  <div class="user-info">
<?php if(!empty($orders)):?>
  	<dl>
  		<dt>物流信息</dt>
  		<dd>
  			<strong>快递单号：</strong>
  			<em><?php echo $orders['logistic'];?></em>
  		</dd>
  	</dl>
  	<dl>
  		<dt>商家信息</dt>
  		<dd>
  			<strong>商家昵称：</strong>
  			<em><?php echo $orders['u_nickname'];?></em>
  		</dd>
  		<dd>
  			<strong>真实姓名：</strong>
  			<em><?php echo $orders['u_firstname'].$orders['u_lastname'];?></em>
  		</dd>
  		<dd>
  			<strong>邮箱：</strong>
  			<em><?php echo $orders['u_email'];?></em>
  		</dd>
  		<dd>
  			<strong>手机号：</strong>
  			<em><?php echo $orders['u_telephone'];?></em>
  		</dd>
  	</dl>
  	<dl>
  		<dt>订单信息</dt>
  		<dd>
  			<strong>下单时间：</strong>
  			<em><?php echo $orders['date_added'];?></em>
  		</dd>
  		<dd>
  			<strong>发票号码：</strong>
  			<em><?php echo !empty($orders['invoice_no']) ? $orders['invoice_no'] : '无发票';?></em>
  		</dd>
  		<dd>
  			<strong>账单地址：</strong>
  			<em><?php echo $orders['payment_address'];?></em>
  		</dd>
  		<dd>
  			<strong>收货地址：</strong>
  			<em><?php echo $orders['shipping_address'];?></em>
  		</dd>
  		<dd>
  			<strong>买家留言：</strong>
  			<em><?php echo $orders['comment'];?></em>
  		</dd>
  	</dl>
  </div>
  <div class="weui-tab">
      

		<?php if(isset($orders['products'])):?>
			  <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
				<div class="weui-panel weui-panel_access">
				  <div class="weui-panel__hd"><span>订单号：<?php echo date('YmdHis',strtotime($orders['date_added'])).'-'.$orders['order_id'];?></span><span class="ord-status-txt-ts fr"><?php echo $orders['status_name']; ?></span></div>

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
								  <div class="pro-amount fr"><span class="font-13">数量×<em class="name"><?php echo $orders['products'][$key]['quantity']; ?></em></span></div>
								</div>
							  </div>
							</div>
						<?php endforeach;?>
					<?php endif;?>
					
				  </div>

				  <div class="ord-statistics">
					<span><a href="javascript:;" style="float:left;" class="ords-btn-dele"><?php echo $orders['store_name']; ?></a></span>
					<span class="wy-pro-pri">总金额：<em class="num font-15"><?php echo $this->currency->Compute($orders['total'] * $orders['currency_value']); ?></em></span>
					<!--span>(含运费<b>￥0.00</b>)</span-->
				  </div>
				  <div class="weui-panel__ft">
					<div class="weui-cell weui-cell_access weui-cell_link oder-opt-btnbox">
						
						<?php if($orders['order_status_id'] == $this->config->get_config('default_order_status')):?>
							<a href="<?php echo $this->config->item('catalog').'user/confirm/payment?order_ids='.$_SESSION['token'].','.$orders['order_id'];?>" class="ords-btn-dele">去付款</a>
						<?php elseif($orders['order_status_id'] == $this->config->get_config('to_be_delivered')):?>
							<a href="javascript:;" class="ords-btn-dele">等待发货</a>
						<?php elseif($orders['order_status_id'] == $this->config->get_config('inbound_state')):?>
							<a href="javascript:;" class="ords-btn-dele" order_id="<?php echo $orders['order_id'];?>" id="to_delivered">确认收货</a>
						<?php elseif($orders['order_status_id'] == $this->config->get_config('state_to_be_evaluated')):?>
							<a href="<?php echo $this->config->item('catalog').'user/orders/product_review_list?order_id='.$orders['order_id']; ?>" class="ords-btn-dele">去评价</a>
						<?php elseif($orders['order_status_id'] == $this->config->get_config('refund_order')):?>
							<a href="javascript:;" class="ords-btn-dele">退款中</a>
						<?php endif;?>
					</div>    
				  </div>
				</div>
				
			  </div>
	
		<?php endif;?>

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
