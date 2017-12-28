<?php echo $header;//装载header?>

<!--顶部搜索-->
<header class='weui-header'>
  <div class="weui-search-bar" id="searchBar">
    <form class="weui-search-bar__form" action="/product/category">
      <div class="weui-search-bar__box">
        <i class="weui-icon-search"></i>
        <input type="search" class="weui-search-bar__input" id="searchInput" name="search" placeholder="搜索您想要的商品" value="<?php echo !empty($action_search) ? $action_search : '';?>" required>
        <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
      </div>
      <!--label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
        <i class="weui-icon-search"></i>
        <span>搜索您想要的商品</span>
      </label-->
    </form>
    <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
  </div>
</header>
<!--主体-->
<div class='weui-content'>

<!--图标分类-->
<!--div class="weui-flex wy-iconlist-box">
	<div class="weui-flex__item">
		<a href="pro_list.html" class="wy-links-iconlist"><div class="img"><img src="images/icon-link1.png"></div><p>精选推荐</p></a>
	</div>
	<div class="weui-flex__item">
		<a href="pro_list.html" class="wy-links-iconlist"><div class="img"><img src="images/icon-link2.png"></div><p>酒水专场</p></a>
	</div>
	<div class="weui-flex__item">
		<a href="all_orders.html" class="wy-links-iconlist"><div class="img"><img src="images/icon-link3.png"></div><p>帮助中心</p></a>
	</div>
	<div class="weui-flex__item">
		<a href="Settled_in.html" class="wy-links-iconlist"><div class="img"><img src="images/icon-link4.png"></div><p>商家入驻</p></a>
	</div>
</div-->
  
	<?php echo $position_bottom; ?>

</div>

<!--底部导航-->
<div class="foot-black"></div>
<div class="weui-tabbar wy-foot-menu">
  <a href="/" class="weui-tabbar__item weui-bar__item--on">
    <div class="weui-tabbar__icon foot-menu-home"></div>
    <p class="weui-tabbar__label">首页</p>
  </a>
  <a href="/mobile/category" class="weui-tabbar__item">
    <div class="weui-tabbar__icon foot-menu-list"></div>
    <p class="weui-tabbar__label">分类</p>
  </a>
  <a href="shopcart.html" class="weui-tabbar__item">
    <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span>
    <div class="weui-tabbar__icon foot-menu-cart"></div>
    <p class="weui-tabbar__label">购物车</p>
  </a>
  <a href="mine.html" class="weui-tabbar__item">
    <div class="weui-tabbar__icon foot-menu-member"></div>
    <p class="weui-tabbar__label">我的</p>
  </a>
</div>



  


<?php echo $footer;//装载header?>
