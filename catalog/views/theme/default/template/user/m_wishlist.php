<?php echo $header;//装载header?>

<!--顶部搜索-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span onclick="window.location.href='/user';"></span></div>
  <div class="wy-header-title">我的收藏</div>
</header>
<!--主体-->
<div class="weui-content">
  <div class='proListWrap' id="list">

	<?php if(isset($products)):?>
		<?php foreach($products as $product):?>
			<div class="pro-items">
			  <div class="weui-media-box weui-media-box_appmsg">
				<div class="weui-media-box__hd"><a href="<?php echo $this->config->item('catalog').'product?product_id='.$product['product_id'];?>"><img class="weui-media-box__thumb" src="/<?php echo $this->image_common->resize($product['image'], $this->config->get_config('product_list_image_size_w'), $this->config->get_config('product_list_image_size_h'), 'h');?>" alt=""></a></div>
				<div class="weui-media-box__bd">
				  <h1 class="weui-media-box__desc"><a href="<?php echo $this->config->item('catalog').'product?product_id='.$product['product_id'];?>" class="ord-pro-link"><?php echo isset($search) ? highlight_phrase($product['name'], $search) : $product['name'];?></a></h1>
				  <div class="wy-pro-pri"><em class="num font-15"><?php echo $this->currency->Compute($product['price']);?></em></div>
				  <ul class="weui-media-box__info prolist-ul">
				  <li class="weui-media-box__info__meta"><a href="javascript:;" class="wy-dele remove_button_<?php echo $product['product_id']; ?>" product_id="<?php echo $product['product_id']; ?>"></a></li>
				  </ul>
				</div>
			  </div>
			</div>
		<?php endforeach;?>
	<?php endif;?>

  </div>
</div>

<div class="weui-loadmore" style="<?php if(count($products) < $this->config->get_config('config_limit_catalog')) echo 'display:none;'; ?>">
    <i class="weui-loading"></i>
    <span class="weui-loadmore__tips">下拉加载更多</span>
</div>

<script>

	var page = parseInt("<?php echo $page+$this->config->get_config('config_limit_catalog')+1; ?>");      //分页
	var data = {};
	
	var switchs = 1;
    var hDpi = $(window).height();
    var loadH = $('.weui-loadmore').height() + 27;

	//加载更多
    $(window).on('scroll',function(){
        if((($(window).scrollTop() + hDpi + loadH)) >= $(document).height()){ 
		  		  
			if(switchs == 1){
			  switchs = 0;	

			  data.comefrom = 'scroll';
			  data.page = page;

			  $.ajax({
				  url: '/user/product',
				  data: data,
				  dataType: 'text',
				  type: 'get',
				  success:function(obj){
						if(obj == false){
							$(".weui-loadmore__tips").text('没有更多了');
							$(".weui-loading").hide();
						}else{
							page += parseInt("<?php echo $this->config->get_config('config_limit_catalog'); ?>");
					 
							$("#list").append(obj);
						}

						switchs = 1;
				  }
			  });
		    }

        }
	});

	$(document).on("click", ".wy-dele", function() {
		var product_id = $(this).attr('product_id');
    	$.confirm("您确定要把此商品从收藏夹移除吗?", "确认移除?", function() {	
			//取消操作
			$.ajax({
				url: '<?php echo $this->config->item('catalog').'user/wishlist/remove';?>',
				type: 'post',
				dataType: 'json',
				data: {product_id:product_id},	
				success: function(data){
					if(data.success){	
						$('.remove_button_'+product_id).parents('.pro-items').remove();
						$.toast("商品已经移除!");

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

</script>

<?php echo $footer;//装载header?>

