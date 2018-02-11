<!--底部导航-->
<div class="foot-black"></div>
<div class="weui-tabbar wy-foot-menu">
  <a href="/" class="weui-tabbar__item <?php echo $fetch_class=='index'?'weui-bar__item--on':''; ?>">
    <div class="weui-tabbar__icon foot-menu-home"></div>
    <p class="weui-tabbar__label">首页</p>
  </a>
  <a href="/mobile/category" class="weui-tabbar__item <?php echo $fetch_class=='category'?'weui-bar__item--on':''; ?>">
    <div class="weui-tabbar__icon foot-menu-list"></div>
    <p class="weui-tabbar__label">分类</p>
  </a>
  <a href="/user/cart" class="weui-tabbar__item <?php echo $fetch_class=='cart'?'weui-bar__item--on':''; ?>">
  <?php echo ($carts !== FALSE && is_array($carts)) ? '<span class="weui-badge" style="position: absolute;top: -.4em;right: 2em;">'.$carts['total_items'].'</span>' :'';?>
    <div class="weui-tabbar__icon foot-menu-cart"></div>
    <p class="weui-tabbar__label"><?php echo lang_line('cart');?></p>
  </a>
  <a href="/user" class="weui-tabbar__item <?php echo $fetch_class=='user'?'weui-bar__item--on':''; ?>">
    <div class="weui-tabbar__icon foot-menu-member"></div>
    <p class="weui-tabbar__label">我的</p>
  </a>
</div>
