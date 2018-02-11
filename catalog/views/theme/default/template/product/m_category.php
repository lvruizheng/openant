<?php echo $header;//装载header?>

<!--顶部搜索-->
<header class='weui-header fixed-top'>
  <div class="weui-search-bar" id="searchBar">
    <form class="weui-search-bar__form" action="/product/category">
      <div class="weui-search-bar__box">
        <i class="weui-icon-search"></i>
        <input type="search" class="weui-search-bar__input" id="searchInput" name="search" placeholder="搜索您想要的商品" value="<?php echo !empty($action_search) ? $action_search : '';?>" >
        <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
      </div>
      <!--label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
        <i class="weui-icon-search"></i>
        <span>搜索您想要的商品</span>
      </label-->
    </form>
    <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
  </div>
  <div class="pro-sort">
    <div class="weui-flex">
	<div class="weui-flex__item"><div class="placeholder <?php echo isset($order_by) && $order_by == 'reviews_quantity'?'NormalCss':'';?>" id="reviews_order" pid="<?php echo isset($order_by) && $order_by == 'reviews_quantity'?'on':'off';?>">按评价</div></div>
	  <div class="weui-flex__item"><div class="placeholder <?php echo isset($order_by) && $order_by == 'seal_quantity'?'NormalCss':'';?>" id="seal_order" pid="<?php echo isset($order_by) && $order_by == 'seal_quantity'?'on':'off';?>">按销量</div></div>
	  <div class="weui-flex__item"><div class="placeholder <?php if(isset($order_by)){
	if($order_by == 'price_desc'){
		echo 'SortDescCss desc';
	}else if($order_by == 'price_asc'){
		echo 'SortDescCss asc';
	}
} ?>" id="price_order" pid="<?php if(isset($order_by)){
	if($order_by == 'price_desc'){
		echo 'on_desc';
	}else if($order_by == 'price_asc'){
		echo 'on_asc';
	}
}else{
	echo 'off';
} ?>">按价格</div></div>
    </div>
  </div>
</header>
<!--主体-->
<div class="weui-content" style="padding-top:85px;">
  <!--产品列表滑动加载-->
  <div class="weui-pull-to-refresh__layer">
    <div class='weui-pull-to-refresh__arrow'></div>
    <div class='weui-pull-to-refresh__preloader'></div>
    <div class="down">下拉刷新</div>
    <div class="up">释放刷新</div>
    <div class="refresh">正在刷新</div>
  </div>
  <div id="list" class='demos-content-padded proListWrap'>


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
    

  </div>

  <div class="weui-loadmore" style="<?php if(count($products) < $this->config->get_config('config_limit_catalog')) echo 'display:none;'; ?>">
    <i class="weui-loading"></i>
    <span class="weui-loadmore__tips">下拉加载更多</span>
  </div>
 
  
</div>


<script>
      $(document.body).pullToRefresh().on("pull-to-refresh", function() {
        setTimeout(function() {
          $("#time").text(new Date);
          $(document.body).pullToRefreshDone();
		  location.reload(false);
        }, 2000);
      });

      var page = parseInt("<?php echo $page+$this->config->get_config('config_limit_catalog')+1; ?>");      //分页
	  var search = "<?php echo $search; ?>";      //搜索内容
	  var id = "<?php echo $id; ?>";            //分类id

	  var data = {};

	  if (search.length != 0) {
		  data.search = search;
	  }
	  if (id.length != 0) {
		  data.id = id;
	  }

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
				  url: '/product/category',
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

	  //按评价
	  $("#reviews_order").on('touchstart',function(){
		    var pid = $(this).attr('pid');

			if(pid == 'on'){
				return;
			}else if(pid == 'off'){
				$(this).attr('pid','on');
				$(this).addClass('NormalCss');

		        data.order_by = 'reviews_quantity';				
				window.location.href = "/product/category"+forwhere(data);
			}
	  }) 
	  
      //按销量
	  $("#seal_order").on('touchstart',function(){
		    var pid = $(this).attr('pid');

			if(pid == 'on'){
				return;
			}else if(pid == 'off'){
				$(this).attr('pid','on');
				$(this).addClass('SortAscCss');

		        data.order_by = 'seal_quantity';				
				window.location.href = "/product/category"+forwhere(data);
			}
	  })

	  //按价格
	  $("#price_order").on('touchstart',function(){
		    var pid = $(this).attr('pid');

			if(pid == 'on_desc'){
				$(this).attr('pid','on_asc');
				$(this).removeClass('desc');
				$(this).addClass('asc');

		        data.order_by = 'price_asc';	
				window.location.href = "/product/category"+forwhere(data);
			}else if(pid == 'on_asc'){
				$(this).attr('pid','on_desc');
				$(this).removeClass('asc');
				$(this).addClass('desc');

		        data.order_by = 'price_desc';	
				window.location.href = "/product/category"+forwhere(data);
			}else if(pid == 'off'){
				$(this).attr('pid','on_desc');
				$(this).addClass('SortAscCss');
				$(this).addClass('desc');	

		        data.order_by = 'price_desc';	
				window.location.href = "/product/category"+forwhere(data);
			}
	  })


	  //循环返回条件
	  function forwhere(obj){
		  var str = '';
		  if(obj.length != 0){
			  str = '?';
		  }
		  for(var key in obj){
			  str += key+'='+obj[key]+'&';
		  }
		  str = str.substring(0,str.length-1);

		  return str;
	  }

	   
</script>

<?php echo $footer;//装载header?>
