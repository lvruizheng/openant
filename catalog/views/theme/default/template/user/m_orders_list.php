
<?php if(!empty($orders)):?>

	<?php foreach($orders as $order):?>
		<?php if(isset($order['products']) && $order['products'] && !empty($order['products'])):?>
			  <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
				<div class="weui-panel weui-panel_access">
				  <div class="weui-panel__hd"><span>订单号：<?php echo date('YmdHis',strtotime($order['date_added'])).'-'.$order['order_id'];?></span><span class="ord-status-txt-ts fr"><?php echo $order['status_name']; ?></span><a style="float:right; margin-right:10px;" href="<?php echo $this->config->item('catalog').'user/orders/order_info?order_id='.$order['order_id'];?>">详情</a></div>

				  <div class="weui-media-box__bd  pd-10">
						
					<?php if(!empty($order['products'])):?>
						<?php foreach($order['products'] as $key=>$value):?>
							<div class="weui-media-box_appmsg ord-pro-list">
							  <div class="weui-media-box__hd">
									<a href="<?php echo $this->config->item('catalog').'product?product_id='.$order['products'][$key]['product_id'];?>">
										<img class="weui-media-box__thumb" src="<?php echo '/'.$this->image_common->resize($order['products'][$key]['image'], $this->config->get_config('product_list_image_size_w'), $this->config->get_config('product_list_image_size_h'));?>" alt="">
									</a>
							  </div>
							  <div class="weui-media-box__bd">
								<h1 class="weui-media-box__desc">
									<a href="<?php echo $this->config->item('catalog').'product?product_id='.$order['products'][$key]['product_id'];?>" class="ord-pro-link">
										<?php echo $order['products'][$key]['name']; ?>
									</a>
								</h1>
								<p class="weui-media-box__desc">
									<?php echo !empty($order['products'][$key]['value']) ? $order['products'][$key]['value'] : '';?>
								</p>
								<div class="clear mg-t-10">
								  <div class="wy-pro-pri fl"><em class="num font-15"><?php echo $this->currency->Compute($order['products'][$key]['price'] * $order['currency_value']);?></em></div>
								  <div class="pro-amount fr"><span class="font-13">数量×<em class="name"><?php echo $order['products'][$key]['quantity']; ?></em></span></div>
								</div>
							  </div>
							</div>
						<?php endforeach;?>
					<?php endif;?>
					
				  </div>

				  <div class="ord-statistics">
					<span><a href="javascript:;" style="float:left;" class="ords-btn-dele"><?php echo $order['store_name']; ?></a></span>
					<span class="wy-pro-pri">总金额：<em class="num font-15"><?php echo $this->currency->Compute($order['total'] * $order['currency_value']); ?></em></span>
					<!--span>(含运费<b>￥0.00</b>)</span-->
				  </div>
				  <div class="weui-panel__ft">
					<div class="weui-cell weui-cell_access weui-cell_link oder-opt-btnbox">
						
						<?php if($order['order_status_id'] == $this->config->get_config('default_order_status')):?>
							<a href="<?php echo $this->config->item('catalog').'user/confirm/payment?order_ids='.$_SESSION['token'].','.$order['order_id'];?>" class="ords-btn-dele">去付款</a>
						<?php elseif($order['order_status_id'] == $this->config->get_config('to_be_delivered')):?>
							<a href="javascript:;" class="ords-btn-dele">等待发货</a>
						<?php elseif($order['order_status_id'] == $this->config->get_config('inbound_state')):?>
							<a href="javascript:;" class="ords-btn-dele" order_id="<?php echo $order['order_id'];?>" id="to_delivered">确认收货</a>
						<?php elseif($order['order_status_id'] == $this->config->get_config('state_to_be_evaluated')):?>
							<a href="<?php echo $this->config->item('catalog').'user/orders/product_review_list?order_id='.$order['order_id']; ?>" class="ords-btn-dele">去评价</a>
						<?php elseif($order['order_status_id'] == $this->config->get_config('refund_order')):?>
							<a href="javascript:;" class="ords-btn-dele">退款中</a>
						<?php elseif($order['order_status_id'] == $this->config->get_config('order_completion_status')):?>
							<a href="javascript:;" class="ords-btn-dele">已完成</a>
						<?php endif;?>
					</div>    
				  </div>
				</div>
				
			  </div>
	
		<?php endif;?>
	<?php endforeach;?>

<?php endif;?>

