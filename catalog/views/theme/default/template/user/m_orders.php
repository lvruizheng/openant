<?php echo $header;//装载header?>

<header class="wy-header" style="position:fixed; top:0; left:0; right:0; z-index:200;">
  <div class="wy-header-icon-back"><span onclick="window.location.href='/user';"></span></div>
  <div class="wy-header-title">订单管理</div>
</header>
<div class='weui-content'>
  <div class="weui-tab">
    <div class="weui-navbar" style="position:fixed; top:44px; left:0; right:0; height:44px; background:#fff;">
	  <a class="weui-navbar__item proinfo-tab-tit font-14 <?php echo empty($order_status)?'weui-bar__item--on':''; ?>" href="<?php echo $this->config->item('catalog').'user/orders'; ?>">全部</a>
	  <a class="weui-navbar__item proinfo-tab-tit font-14 <?php echo !empty($order_status) && $order_status == $this->config->get_config('default_order_status')?'weui-bar__item--on':''; ?>" href="<?php echo $this->config->item('catalog').'user/orders?page=0&order_status='.$this->config->get_config('default_order_status'); ?>">待付款</a> 
      <a class="weui-navbar__item proinfo-tab-tit font-14 <?php echo !empty($order_status) && in_array($this->config->get_config('inbound_state'),$order_status)?'weui-bar__item--on':''; ?>" href="<?php echo $this->config->item('catalog').'user/orders?page=0&order_status='.$this->config->get_config('inbound_state'); ?>">待收货</a>
	  <a class="weui-navbar__item proinfo-tab-tit font-14 <?php echo !empty($order_status) && $order_status == $this->config->get_config('state_to_be_evaluated')?'weui-bar__item--on':''; ?>" href="<?php echo $this->config->item('catalog').'user/orders?page=0&order_status='.$this->config->get_config('state_to_be_evaluated'); ?>">待评价</a>
      <a class="weui-navbar__item proinfo-tab-tit font-14 <?php echo !empty($order_status) && $order_status == $this->config->get_config('order_completion_status')?'weui-bar__item--on':''; ?>" href="<?php echo $this->config->item('catalog').'user/orders?page=0&order_status='.$this->config->get_config('order_completion_status'); ?>">已完成</a>
    </div>
    <div class="weui-tab__bd proinfo-tab-con" style="padding-top:87px;" id="list">

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

<?php else:?>
		<dl class="ok-info">
			<dt><img src="/resources/public/resources/mobile/images/icon_nav_article.png"></dt>
			<dd>没有订单需要处理</dd>
		</dl>
<?php endif;?>
	
	

    </div>
  </div>
</div>

<div class="weui-loadmore" style="<?php if(count($orders) < $this->config->get_config('config_limit_admin')) echo 'display:none;'; ?>">
		<i class="weui-loading"></i>
		<span class="weui-loadmore__tips">下拉加载更多</span>
	</div>

<script>

$('#to_delivered').on('click',function(){
	var order_id = $(this).attr('order_id');
	$.confirm("您确定已收到货物?", "确认收货?", function() {
		window.location.href = '<?php echo $this->config->item('catalog').'user/orders/edit_logistic?order_id='; ?>'+order_id;
	});
});


	var page = parseInt("<?php echo $page+$this->config->get_config('config_limit_admin')+1; ?>");      //分页
	var order_status = "<?php echo $order_status; ?>";      //类别
	var data = {};

	var switchs = 1;
    var hDpi = $(window).height();
    var loadH = $('.weui-loadmore').height() + 27;

	//加载更多
    $(window).on('scroll',function(){
		if((($(window).scrollTop() + hDpi + loadH)) >= $(document).height()){ 
		  		  
			if(switchs == 1){
			  switchs = 0;	

			  data.order_status = order_status;
			  data.page = page;

			  $.ajax({
				  url: '/user/orders',
				  data: data,
				  dataType: 'text',
				  type: 'get',
				  success:function(obj){
						if(obj == false){
							$(".weui-loadmore__tips").text('没有更多了');
							$(".weui-loading").hide();
						}else{
							page += parseInt("<?php echo $this->config->get_config('config_limit_admin'); ?>");
					 
							$("#list").append(obj);
						}

						switchs = 1;
				  }
			  });
		    }

        }
	});

</script>


<?php echo $footer;//装载header?>
