<?php echo $header;//装载header?>

<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span onclick="window.location.href='/user';"></span></div>
  <div class="wy-header-title">密码修改</div>
</header>
<div class="weui-content">
  <div class="weui-cells cardlist">
    <a class="weui-cell weui-cell_access" href="<?php echo $this->config->item('catalog').'user/edit/edit_paswd'; ?>">
      <div class="weui-cell__bd"><p>登陆密码修改</p></div>
      <div class="weui-cell__ft"></div>
    </a>
    <a class="weui-cell weui-cell_access" href="<?php echo $this->config->item('catalog').'user/edit/edit_pay_password'; ?>">
      <div class="weui-cell__bd"><p>交易密码修改</p></div>
      <div class="weui-cell__ft"></div>
    </a>
  </div>
</div>


<?php echo $footer;//装载header?>
