<?php echo $header;//装载header?>

<!--头部开始-->
<div class="header">
	<h1>购物车</h1>
	<a href="javascript:;" class="back" onclick="window.history.go(-1);"><span></span></a>
</div>
<!--头部结束-->
<div class="shopping">
<form action="<?php echo $this->config->item('catalog').'user/confirm';?>" method="get" enctype="multipart/form-data" id="cart-form">
	<?php foreach($carts_product as $key=>$value):?>	
					<div class="shop-group-item">
						<div class="shop-name">
							<input type="checkbox" class="check goods-check shopCheck">
							<h4><a href="javascript:;"><?php echo $carts_product[$key]['store_name'];?></a></h4>
							<span class="shop-total-amount ShopTotal" style="display:none;"></span>
						</div>
						<ul>
						<?php if(isset($value['products'])):?>
						<?php foreach($value['products'] as $k=>$v):?>
							<li id="cart_info_li_<?php echo $key.$k;?>" >
								<div class="shop-info">
									<input type="checkbox" class="check goods-check goodsCheck" name="selected[]" value="<?php echo $v['rowid']; ?>">
									<div class="shop-info-img">
										<a href="<?php echo $this->config->item('catalog').'product?product_id='.$value['products'][$b]['id'];?>">
											<img src="<?php echo '/'.$this->image_common->resize($v['image'], $this->config->get_config('product_list_image_size_w'), $this->config->get_config('product_list_image_size_h'));?>" />
										</a>
									</div>
									<div class="shop-info-text">
										<a href="<?php echo $this->config->item('catalog').'product?product_id='.$value['products'][$b]['id'];?>">
											<h4><?php echo $v['name']; ?></h4>
										</a>
										<div class="shop-brief"><?php echo isset($v['options']) ? $v['options'] : '';?></div>
										<div class="shop-price">
											<div class="shop-pices"><b class="price"><?php echo $this->currency->Compute($v['price']); ?></b></div>
											<div class="shop-arithmetic">
												<a href="javascript:;" class="minus">-</a>
												<span class="num" rowid="<?php echo $v['rowid']; ?>" price="<?php echo $v['price']; ?>" keyb="<?php echo $key.$k;?>" id="this_num_<?php echo $key.$k;?>"><?php echo $v['qty']; ?></span>
												<a href="javascript:;" class="plus">+</a>

												<input type="hidden" value="<?php echo $this->currency->Compute($v['subtotal']);?>" id="count_price_<?php echo $key.$k;?>">
											</div>
											<div class="shop-del">
												<a href="javascript:;"></a>
											</div>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach;?>
						<?php endif;?>	
						</ul>
					</div>
	<?php endforeach;?>
</form>
</div>

<div class="payment-bar">
	<div class="all-checkbox"><input type="checkbox" class="check goods-check" id="AllCheck">全选</div>
	<div class="shop-total">
		<strong>总价：<i class="total" id="AllTotal">0.00</i></strong>
	</div>
	<input type="button" class="settlement" value="结算" disabled="disabled">
</div>

<?php echo $footer_nav; ?>

<script>
$(function(){
	$(".settlement").click(function(){
		$('#cart-form').submit();
	});
	TotalPrice();

	// 数量减
	$(".minus").click(function() {
		var t = $(this).parent().find('.num');
		var qty = parseInt(t.text()) - 1;
		
		rowid = t.attr('rowid');
		price = t.attr('price');
		key = t.attr('keyb');

		if (qty < 1) {
			return;
		}else{
			var data = qty_change(qty, price, rowid, key);
			t.text(qty);
		}
	});
	// 数量加
	$(".plus").click(function() {
		var t = $(this).parent().find('.num');
		var qty = parseInt(t.text()) + 1;

		rowid = t.attr('rowid');
		price = t.attr('price');
		key = t.attr('keyb');

		if (qty <= 1) {
			return;
		}else{
			var data = qty_change(qty, price, rowid, key);
			t.text(qty);
		}
	});


	/******------------分割线-----------------******/
	  // 点击商品按钮
	$(".goodsCheck").click(function() {
		var goods = $(this).closest(".shop-group-item").find(".goodsCheck"); //获取本店铺的所有商品
		var goodsC = $(this).closest(".shop-group-item").find(".goodsCheck:checked"); //获取本店铺所有被选中的商品
		var	Shops = $(this).closest(".shop-group-item").find(".shopCheck"); //获取本店铺的全选按钮
		if (goods.length == goodsC.length) { //如果选中的商品等于所有商品
			Shops.prop('checked', true); //店铺全选按钮被选中
			if ($(".shopCheck").length == $(".shopCheck:checked").length) { //如果店铺被选中的数量等于所有店铺的数量
				$("#AllCheck").prop('checked', true); //全选按钮被选中
				TotalPrice();
			} else {
				$("#AllCheck").prop('checked', false); //else全选按钮不被选中 
				TotalPrice();
			}
		} else { //如果选中的商品不等于所有商品
			Shops.prop('checked', false); //店铺全选按钮不被选中
			$("#AllCheck").prop('checked', false); //全选按钮也不被选中
			// 计算
			TotalPrice();
			// 计算
		}
	});
	// 点击店铺按钮
	$(".shopCheck").click(function() {
		if ($(this).prop("checked") == true) { //如果店铺按钮被选中
			$(this).parents(".shop-group-item").find(".goods-check").prop('checked', true); //店铺内的所有商品按钮也被选中
			if ($(".shopCheck").length == $(".shopCheck:checked").length) { //如果店铺被选中的数量等于所有店铺的数量
				$("#AllCheck").prop('checked', true); //全选按钮被选中
				TotalPrice();
			} else {
				$("#AllCheck").prop('checked', false); //else全选按钮不被选中
				TotalPrice();
			}
		} else { //如果店铺按钮不被选中
			$(this).parents(".shop-group-item").find(".goods-check").prop('checked', false); //店铺内的所有商品也不被全选
			$("#AllCheck").prop('checked', false); //全选按钮也不被选中
			TotalPrice();
		}
	});
	// 点击全选按钮
	$("#AllCheck").click(function() {
		if ($(this).prop("checked") == true) { //如果全选按钮被选中
			$(".goods-check").prop('checked', true); //所有按钮都被选中
			TotalPrice();
		} else {
			$(".goods-check").prop('checked', false); //else所有按钮不全选
			TotalPrice();
		}
		$(".shopCheck").change(); //执行店铺全选的操作
	});
	//计算
	function TotalPrice() {
		var allprice = 0; //总价
		$(".shop-group-item").each(function() { //循环每个店铺
			var oprice = 0; //店铺总价
			$(this).find(".goodsCheck").each(function() { //循环店铺里面的商品
				if ($(this).is(":checked")) { //如果该商品被选中
					var num = parseInt($(this).parents(".shop-info").find(".num").text()); //得到商品的数量
					var price = parseFloat($(this).parents(".shop-info").find(".price").text().substr(1)); //得到商品的单价
					var total = price * num; //计算单个商品的总价
					oprice += total; //计算该店铺的总价
				}
				$(this).closest(".shop-group-item").find(".ShopTotal").text(oprice.toFixed(2)); //显示被选中商品的店铺总价
			});
			var oneprice = parseFloat($(this).find(".ShopTotal").text()); //得到每个店铺的总价
			allprice += oneprice; //计算所有店铺的总价
		});
		$("#AllTotal").text(allprice.toFixed(2)); //输出全部总价

		if(allprice > 0){
			$('.settlement').removeAttr('disabled');
		}else{
			$('.settlement').attr('disabled','disabled');
		}
	}

	
    $(".shop-del").on("click", function() {
		var rowid = $(this).parent().find('.num').attr('rowid');
		var key = $(this).parent().find('.num').attr('keyb');
    	$.confirm("您确定要把此商品从购物车删除吗?", "确认删除?", function() {	
			//取消操作
			$.ajax({
				url: '<?php echo $this->config->item('catalog').'product/option/remove_cart';?>',
				type: 'post',
				dataType: 'json',
				data: {rowid:rowid},	
				success: function(data){
					if(data.success){	
						$("#cart_info_li_"+key).remove();
						$.toast("文件已经删除!");

						TotalPrice();
					}else{
						$.notify({message: data.error },{type: 'warning',offset: {x: 0,y: 52}});
					}
				},
				error: function(xhr, ajaxOptions, thrownError)
				{
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
        }, function() {
         
        });
    });

	//动态变更数量
	function qty_change(qty, price, rowid, key){
		$.ajax({
			url: '<?php echo $this->config->item('catalog').'user/cart/update';?>',
			type: 'post',
			dataType: 'json',
			data: {qty:qty, price:price, rowid:rowid},	
			success: function(data){
				if(data.success){
					return data.subtotal;
					$('#count_price_'+key).val(data.subtotal);
				}else{
					$.notify({message: data.error },{type: 'warning',offset: {x: 0,y: 52}});
				}
		
			},
			error: function(xhr, ajaxOptions, thrownError)
			{
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
    
});

</script>

<?php echo $footer;//装载header?>
