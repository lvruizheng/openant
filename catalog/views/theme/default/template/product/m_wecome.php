<?php echo $header;//装载header?>

<style>
li .active{display:inline-block; border:1px dashed #f00;}
#show-toast.cur .promotion-foot-menu-collection{
	background: url(/resources/public/resources/mobile/images/icon-collection-sucess.png) no-repeat;
    background-size: 22px;
}
#show-toast.cur .weui-tabbar__label{
	color: #f00;
}
</style>

<div class="weui-content">
  <!--产品详情-->
  <div class="weui-tab">
    <div class="weui-navbar" style="position:fixed; top:0; left:0; right:0; height:44px;">
      <a class="weui-navbar__item proinfo-tab-tit weui-bar__item--on" href="#tab1">商品</a>
      <a class="weui-navbar__item proinfo-tab-tit" href="#tab2"><?php echo lang_line('description');?></a>
      <a class="weui-navbar__item proinfo-tab-tit" href="#tab3"><?php echo lang_line('t_review');?></a>
    </div>
    <div class="weui-tab__bd proinfo-tab-con">
      <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
        <!--主图轮播-->
        <div class="swiper-container swiper-zhutu">
		  <div class="swiper-wrapper">

			<?php if(isset($product['images'])):?>
				<?php foreach($product['images'] as $image):?>
					<div class="swiper-slide"><img src="<?php echo $this->image_common->resize($image['image'], $this->config->get_config('product_image_size_w'), $this->config->get_config('product_image_size_h'), 'h');?>" /></div>
				<?php endforeach;?>
				
			<?php endif;?>
			
          </div>
          <div class="swiper-pagination swiper-zhutu-pagination"></div>
        </div>
        <div class="wy-media-box-nomg weui-media-box_text">
			<?php
				if(isset($product['taxs'])){
					if($product['taxs']['type'] == 'F'){
						$taxes = $product['taxs']['rate'];
					}
					elseif($product['taxs']['type'] == 'P'){
						if(isset($product['discount_price'])){
							$tax_num = $tax_rate * $product['discount_price'];
						}else if(isset($product['special_price'])){
							$tax_num = $tax_rate * $product['special_price'];
						}
					}
					else{
						$taxes = '0';
					}
				}else{
					$taxes = '0';
				}
			?>
          <h4 class="wy-media-box__title"><?php echo $product['name'];?></h4>
          <div class="wy-pro-pri mg-tb-5"><em class="num font-20"><?php echo $this->currency->Compute($product['price']);?></em></div>
          <p class="weui-media-box__desc"><?php echo $product['meta_description'];?></p>
        </div>
        <!--div class="wy-media-box2 weui-media-box_text">
          <div class="weui-media-box_appmsg">
            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">优惠</span></div>
            <div class="weui-media-box__bd">
              <div class="promotion-message clear">
                <i class="yhq"><span class="label-text">优惠券</span></i>
                <span class="promotion-item-text">满197.00减40.00</span>
              </div>
              <div class="promotion-message clear">
                <i class="yhq"><span class="label-text">优惠券</span></i>
                <span class="promotion-item-text">满197.00减40.00</span>
              </div>
              <div class="yhq-btn clear"><a href="yhq_list.html">去领券</a></div>
            </div>
          </div>
        </div-->
        <div class="wy-media-box2 weui-media-box_text">

			<?php foreach($product['options'] as $key=>$val):?>
				<div class="weui-media-box_appmsg">
					<div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit"><?php echo $val['option_group_name'];?></span></div>
					<div class="weui-media-box__bd">
					  <div class="promotion-sku clear">
						<ul>
							<?php foreach($val['options'] as $k=>$v):?>
								<li class="<?php echo $k==0?'active':'' ?>" option_id="<?php echo $v['option_id']; ?>"><a href="javascript:;"><?php echo $v['name']; ?></a></li>
							<?php endforeach; ?>
						</ul>
					  </div>
					</div>
				</div>
			<?php endforeach;?> 
          
        </div>
        <div class="wy-media-box2 txtpd weui-media-box_text">
          <div class="weui-media-box_appmsg">
            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">送至</span></div>
            <div class="weui-media-box__bd">
              <!--div class="promotion-message clear">
                <span class="promotion-item-text">江苏</span>
                <span class="promotion-item-text">宿迁</span>
                <span class="promotion-item-text">洋河新区</span>
              </div-->
            </div>
          </div>
          <div class="weui-media-box_appmsg">
            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">运费</span></div>
            <div class="weui-media-box__bd">
              <div class="promotion-message clear">
                <span class="promotion-item-text">免运费<!--<div class="wy-pro-pri">¥<span class="num">11.00</span></div>--></span>
              </div>
            </div>
          </div>
          <div class="weui-media-box_appmsg">
            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">商家</span></div>
            <div class="weui-media-box__bd">
              <div class="promotion-message clear">
			  <span class="promotion-item-text"><?php echo $product['store_name'] ?></span>
              </div>
            </div>
          </div>
          <div class="weui-media-box_appmsg">
            <div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit">提示</span></div>
            <div class="weui-media-box__bd">
              <div class="promotion-message clear">
                <span class="promotion-item-text"><p class="txt-color-ml">支持7天无理由退换货</p></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="tab2" class="weui-tab__bd-item ">
        <div class="pro-detail">
			<?php echo html_entity_decode(str_ireplace('href="', 'href="'.base_url('errors/page_missing/go_to?go_to='), $product['description']));?> 
        </div>
      </div>
      <div id="tab3" class="weui-tab__bd-item">
        <!--评价-->

        <div class="weui-panel__bd">
          <div class="wy-media-box weui-media-box_text">
            <div class="weui-cell nopd weui-cell_access">
              <div class="weui-cell__hd"><img src="upload/headimg.jpg" alt="" style="width:20px;margin-right:5px;display:block"></div>
              <div class="weui-cell__bd weui-cell_primary"><p>按顺序撒</p></div>
              <span class="weui-cell__time">2017-02-06</span>
            </div>
            <div class="comment-item-star"><span class="real-star comment-stars-width5"></span></div>
            <p class="weui-media-box__desc">面料不错，码数也正常  男朋友穿的很合适。</p>
            <ul class="weui-uploader__files clear mg-com-img">
                <li class="weui-uploader__file" style="background-image:url(./upload/pro3.jpg)"></li>
                <li class="weui-uploader__file" style="background-image:url(./upload/pro3.jpg)"></li>
                <li class="weui-uploader__file" style="background-image:url(./upload/pro3.jpg)"></li>
            </ul>
          </div>
        </div>

        
        <a href="javascript:void(0);" class="weui-cell weui-cell_access weui-cell_link list-more">
            <div class="weui-cell__bd">查看更多</div>
            <span class="weui-cell__ft"></span>
          </a>
        
      </div>
    </div>
  </div>  
</div>

<!--底部导航-->
<div class="foot-black"></div>
<div class="weui-tabbar wy-foot-menu">
  <a href="javascript:;" class="promotion-foot-menu-items">
    <div class="weui-tabbar__icon promotion-foot-menu-kefu"></div>
    <p class="weui-tabbar__label">店铺</p>
  </a>
  <a href="javascript:;" id='show-toast' class="promotion-foot-menu-items">
    <div class="weui-tabbar__icon promotion-foot-menu-collection"></div>
    <p class="weui-tabbar__label">收藏</p>
  </a>
  <a href="shopcart.html" class="promotion-foot-menu-items">
    <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span>
    <div class="weui-tabbar__icon promotion-foot-menu-cart"></div>
    <p class="weui-tabbar__label">购物车</p>
  </a>
  <a href="javascript:;" class="weui-tabbar__item yellow-color open-popup" data-target="#selcet_sku">
    <p class="promotion-foot-menu-label">加入购物车</p>
  </a>
  
</div>

<div id="selcet_sku" class='weui-popup__container popup-bottom' style="z-index:600;">
  <div class="weui-popup__overlay" style="opacity:1;"></div>
  <div class="weui-popup__modal">
    <div class="toolbar">
      <div class="toolbar-inner">
        <a href="javascript:;" class="picker-button close-popup">关闭</a>
        <h1 class="title"><?php echo lang_line('option');?></h1>
      </div>
    </div>
    <div class="modal-content">
      <div class="weui-msg" style="padding-top:0;">	
		<div class="wy-media-box2 weui-media-box_text" id="product-options" style="margin:0;">
		   	
			<?php foreach($product['options'] as $key=>$val):?>
				<div class="weui-media-box_appmsg">
					<div class="weui-media-box__hd proinfo-txt-l"><span class="promotion-label-tit"><?php echo $val['option_group_name'];?></span></div>
					<div class="weui-media-box__bd">
					  <div class="promotion-sku clear">
						<ul>
							<?php foreach($val['options'] as $k=>$v):?>
								<li class="<?php echo $k==0?'active':'' ?>" option_id="<?php echo $v['option_id']; ?>"><a href="javascript:;"><?php echo $v['name']; ?></a></li>
							<?php endforeach; ?>
						</ul>
					  </div>
					</div>
				</div>
			<?php endforeach;?>
	
		<div class="pro-amount fr"><div class="Spinner"></div></div> 
		</div>

		<div class="weui-msg__opr-area">
          <p class="weui-btn-area">
            <a href="javascript:;" class="weui-btn weui-btn_primary" id="add_cart_confirm">确认</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
	$(function(){
		$(".Spinner").Spinner({value:1, len:3, max:999});
	});
	$(".swiper-zhutu").swiper({
		loop: true,
		paginationType:'fraction',
        autoplay:5000
	});

	$(document).on("click", "#show-toast", function() {
		<?php if($this->user->isLogged()):?>
			if($('#show-toast').hasClass('cur')){
				return;
			}else{
				//添加到收藏夹
				$.ajax({
					url: '<?php echo $this->config->item('catalog').'user/wishlist/add';?>',
					type: 'post',
					dataType: 'json',
					data: {product_id:<?php echo $product_id;?>},	
					success: function(data){
						if(data.success){
							$('#show-toast').addClass('cur').find('p').text('已收藏');

							$.toast("收藏成功", function() {

							});
						}	
					},
					error: function(xhr, ajaxOptions, thrownError)
					{
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		<?php else:?>
			window.location.href="<?php echo $this->config->item('catalog').'user/signin/login?url=';?>"+window.location.href;
		<?php endif;?>	
	})
	
	$(document).on("open", ".weui-popup-modal", function() {
        console.log("open popup");
	}).on("close", ".weui-popup-modal", function() {
        console.log("close popup");
    });

	$(function (){initTopHoverTree("tophov"+"ertree",30,10,10); })
	
	function initTopHoverTree(hvtid, times, right, bottom) {
		$("#" + hvtid).css("right", right).css("bottmo", bottom);
		$("#" + hvtid).on("click", function () { goTopHovetree(times); })
		$(window).scroll(function () {
			if ($(window).scrollTop() > 268) {
				$("#" + hvtid).fadeIn(100);
			}
			else {
				$("#" + hvtid).fadeOut(100);
			}
		});
	}

	//添加到购物车
	$("#add_cart_confirm").on("touchstart",function(){	
		var options=new Array();
		$("#product-options .active").each(function(index, element){
			options[index]=$(this).attr('option_id');
		});

		var qty = $('.Spinner input').val();
		var product_id='<?php echo $product_id;?>';
		var name='<?php echo $product['name'];?>';
		
		<?php if($this->user->isLogged()):?>
			ajax_add_cart(options, qty, product_id, name);
		<?php else:?>
			window.location.href="<?php echo $this->config->item('catalog').'user/signin/login?url=';?>"+window.location.href;
		<?php endif;?>
	});

	function ajax_add_cart(options, qty, productid, name){
		$.ajax({
			url: '<?php echo $this->config->item('catalog').'user/cart/add';?>',
			type: 'post',
			dataType: 'json',
			data: {option_id:options, qtys:qty, product_ids:productid, names:name},	
			success: function(data){
				if(data.success){
					console.log(data);
				}else{
					//$.notify({message: data.error },{type: 'warning',offset: {x: 0,y: 52}});
				}
		
			},
			error: function(xhr, ajaxOptions, thrownError)
			{
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}

</script>


<?php echo $footer;//装载header?>