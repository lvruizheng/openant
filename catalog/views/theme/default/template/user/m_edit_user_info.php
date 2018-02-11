<?php echo $header;//装载header?>
<style>
	.weui-cells_form .weui-cell__ft{
		font-size: 16px;
	}
	.telNum{
		position: relative;
	}
	.telNum #telephone{
		position: absolute;
		font-size: 16px;
	}
	.telNum .telNumBtn{
		padding: 2px 10px;
	}
</style>
<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span onclick="window.location.href='/user';"></span></div>
  <div class="wy-header-title">编辑个人信息</div>
</header>
<div class="weui-content">
  <div class="weui-cells weui-cells_form wy-address-edit">
	<form class="form-horizontal well well-sm" action="<?php echo $this->config->item('catalog').'user/edit/edit_user_info';?>" method="post" >
	
	<div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">昵称</label></div>
	  <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="昵称" maxlength="30" id="nickname" name="nickname" value="<?php echo $user_info ? $user_info['nickname'] : '';?>">
	  </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">姓氏</label></div>
	  <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="姓氏" maxlength="30" id="firstname" name="firstname" value="<?php echo $user_info ? $user_info['firstname'] : '';?>">
	  </div>
    </div>
	<div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">名字</label></div>
	  <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="名称" maxlength="30" id="lastname" name="lastname" value="<?php echo $user_info ? $user_info['lastname'] : '';?>">
	  </div>
    </div>

	<div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">性别</label></div>
	  <div class="weui-cell__bd">
			<input type="radio" name="gender" id="gender" value="男" <?php echo ($user_info && $user_info['gender'] == '男') ? 'checked' : '';?>>男
			<input type="radio" name="gender" id="gender" value="女" <?php echo ($user_info && $user_info['gender'] == '女') ? 'checked' : '';?>>女
	  </div>
    </div>

    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">手机号</label></div>
	  <div class="weui-cell__bd telNum">
			<input class="weui-input" type="number" pattern="[0-9]*" min="11" max="11" placeholder="手机号" id="telephone" name="telephone" value="<?php echo $user_info ? $user_info['telephone'] : '';?>">
			<div class="weui-cell__ft">
				<button class="btn btn-default telNumBtn" type="button" onclick="sender_mobile();">获取验证码</button>
			</div>
	  </div>
    </div>
	
    <div class="weui-cell">
      <div class="weui-cell__hd"><label for="name" class="weui-label wy-lab">验证码</label></div>
	  <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="验证码" id="email_captcha" name="email_captcha" value="">
	  </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">邮箱</label></div>
      <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="邮箱" maxlength="120" id="email" name="email" value="<?php echo $user_info ? $user_info['email'] : '';?>">
      </div>
    </div>
	
    

		<?php if($this->input->get('address_id') != NULL):?>
			<input type="hidden" name="address_id" value="<?php echo $this->input->get('address_id');?>"/>
		<?php endif;?>
	</form>
  </div> 

  <div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">保存</a>
  </div>

</div>


<script>
$('#showTooltips').click(function(){
	$('.form-horizontal').submit();
})

	function sender_mobile(){
			
	}
</script>



<?php echo $footer;//装载header?>

