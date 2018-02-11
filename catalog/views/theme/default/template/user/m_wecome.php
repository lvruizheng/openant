<?php echo $header;//装载header?>

<!--主体-->
<div class='weui-content'>
  <div class="wy-center-top">
    <div class="weui-media-box weui-media-box_appmsg">
      <div class="weui-media-box__hd"><img class="weui-media-box__thumb radius" src="resources/public/resources/mobile/upload/headimg.jpg" alt=""></div>
      <div class="weui-media-box__bd">
        <h4 class="weui-media-box__title user-name"><?php echo $user['nickname'];?></h4>
        <p class="user-grade">等级：普通会员</p>
        <!--p class="user-integral">待返还金额：<em class="num">500.0</em>元</p-->
      </div>
    </div>
<!--    <div class="xx-menu weui-flex">
      <div class="weui-flex__item"><div class="xx-menu-list"><em>987</em><p>账户余额</p></div></div>
      <div class="weui-flex__item"><div class="xx-menu-list"><em>459</em><p>我的蓝豆</p></div></div>
      <div class="weui-flex__item"><div class="xx-menu-list"><em>4</em><p>收藏商品</p></div></div>
    </div>-->
  </div>
  <div class="weui-panel weui-panel_access">
    <div class="weui-panel__hd">
	  <a href="<?php echo $this->config->item('catalog').'user/orders'; ?>" class="weui-cell weui-cell_access center-alloder">
        <div class="weui-cell__bd wy-cell">
          <div class="weui-cell__hd"><img src="resources/public/resources/mobile/images/center-icon-order-all.png" alt="" class="center-list-icon"></div>
          <div class="weui-cell__bd weui-cell_primary"><p class="center-list-txt">全部订单</p></div>
        </div>
        <span class="weui-cell__ft"></span>
      </a>   
    </div>
    <div class="weui-panel__bd">
      <div class="weui-flex">
        <div class="weui-flex__item">
          <a href="user/orders?page=0&order_status=<?php echo $this->config->get_config('default_order_status');?>" class="center-ordersModule">
            <?php echo isset($count_default_order) ? '<span class="weui-badge" style="position: absolute;top:5px;right:10px; font-size:10px;">'.$count_default_order.'</span>' : '';?>
            <div class="imgicon"><img src="resources/public/resources/mobile/images/center-icon-order-dfk.png" /></div>
            <div class="name">待付款</div>
          </a>
        </div>
        <div class="weui-flex__item">
          <a href="user/orders?page=0&order_status=<?php echo $this->config->get_config('order_completion_status');?>" class="center-ordersModule">
            <?php echo isset($count_to_be_delivered) ? '<span class="weui-badge" style="position: absolute;top:5px;right:10px; font-size:10px;">'.$count_to_be_delivered.'</span>' : '';?>
            <div class="imgicon"><img src="resources/public/resources/mobile/images/center-icon-order-dfh.png" /></div>
            <div class="name">已完成</div>
          </a>
        </div>
        <div class="weui-flex__item">
          <a href="user/orders?page=0&order_status=<?php echo $this->config->get_config('inbound_state');?>" class="center-ordersModule">
			<?php echo isset($count_inbound_state) ? '<span class="weui-badge" style="position: absolute;top:5px;right:10px; font-size:10px;">'.$count_inbound_state.'</span>' : '';?>
            <div class="imgicon"><img src="resources/public/resources/mobile/images/center-icon-order-dsh.png" /></div>
            <div class="name">待收货</div>
          </a>
        </div>
        <div class="weui-flex__item">
          <a href="user/orders?page=0&order_status=<?php echo $this->config->get_config('state_to_be_evaluated');?>" class="center-ordersModule">
            <?php echo isset($count_to_be_evaluated) ? '<span class="weui-badge" style="position: absolute;top:5px;right:10px; font-size:10px;">'.$count_to_be_evaluated.'</span>' : '';?>
            <div class="imgicon"><img src="resources/public/resources/mobile/images/center-icon-order-dpj.png" /></div>
            <div class="name">待评价</div>
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="weui-panel weui-panel_access">
    <div class="weui-panel__hd">
      <a href="javascript:;" class="weui-cell weui-cell_access center-alloder">
        <div class="weui-cell__bd wy-cell">
          <div class="weui-cell__hd"><img src="resources/public/resources/mobile/images/center-icon-jk.png" alt="" class="center-list-icon"></div>
          <div class="weui-cell__bd weui-cell_primary"><p class="center-list-txt">我的小金库</p></div>
        </div>
        <span class="weui-cell__ft"></span>
      </a>   
    </div>
    <div class="weui-panel__bd">
      <div class="weui-flex">
        <div class="weui-flex__item">
          <a href="myburse.html" class="center-ordersModule">
            <div class="center-money"><em><?php echo $this->currency->Compute($balances);?></em></div>
            <div class="name">账户总额</div>
          </a>
        </div>
        <div class="weui-flex__item">
          <a href="myburse.html" class="center-ordersModule">
				<div class="center-money"><em><?php echo $integral; ?></em></div>
				<div class="name">积分</div>
          </a>
        </div>
        <div class="weui-flex__item">
          <a href="myburse.html" class="center-ordersModule">
            <div class="center-money"><em>无</em></div>
            <div class="name">优惠券</div>
          </a>
        </div>
        
      </div>
    </div>
  </div>
  
  
  <div class="weui-panel">
        <div class="weui-panel__bd">
          <div class="weui-media-box weui-media-box_small-appmsg">
            <div class="weui-cells">
              <a class="weui-cell weui-cell_access" href="<?php echo $this->config->item('catalog').'user/edit/edit_user_info'; ?>">
                <div class="weui-cell__hd"><img src="resources/public/resources/mobile/images/center-icon-jyjl.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">个人资料</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
			  <a class="weui-cell weui-cell_access" href="<?php echo $this->config->item('catalog').'user/wishlist'; ?>">
                <div class="weui-cell__hd"><img src="resources/public/resources/mobile/images/center-icon-sc.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">我的收藏</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="<?php echo $this->config->item('catalog').'user/address'; ?>">
                <div class="weui-cell__hd"><img src="resources/public/resources/mobile/images/center-icon-dz.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">收货地址管理</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="javascript:;">
                <div class="weui-cell__hd"><img src="resources/public/resources/mobile/images/center-icon-yhk.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">我的交易记录</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="<?php echo $this->config->item('catalog').'user/edit/edit_pass_type'; ?>">
                <div class="weui-cell__hd"><img src="resources/public/resources/mobile/images/center-icon-dlmm.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">密码修改</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
              <a class="weui-cell weui-cell_access" href="javascript:;" onclick="logout();">
                <div class="weui-cell__hd"><img src="resources/public/resources/mobile/images/center-icon-out.png" alt="" class="center-list-icon"></div>
                <div class="weui-cell__bd weui-cell_primary">
                  <p class="center-list-txt">退出账号</p>
                </div>
                <span class="weui-cell__ft"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
  
  
  
</div>

<?php echo $footer_nav; ?>




<?php echo $footer;//装载header?>
