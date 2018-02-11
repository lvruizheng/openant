<?php echo $header;//装载header?>

<style>
label.error{color:red;}

</style>

<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span onclick="window.location.href='/user/edit/edit_pass_type';"></span></div>
  <div class="wy-header-title">修改登陆密码</div>
</header>
<div class="weui-content">


<form action="<?php echo $this->config->item('catalog').'user/edit/edit_paswd';?>" method="post" enctype="multipart/form-data" id="edit-paswd-form">
  <div class="weui-cells weui-cells_form wy-address-edit">
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">当前密码</label></div>
      <div class="weui-cell__bd"><input class="weui-input" type="password" id="current_password" name="current_password" placeholder="请输入当前密码"></div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">新密码</label></div>
      <div class="weui-cell__bd"><input class="weui-input" type="password" id="new_password" name="new_password" placeholder="新密码"></div>
    </div>
	<div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">确认密码</label></div>
      <div class="weui-cell__bd"><input class="weui-input" type="password" id="confirm_password" name="confirm_password" placeholder="确认密码"></div>
    </div>
    <div class="weui-cell weui-cell_vcode">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">验证码</label></div>
      <div class="weui-cell__bd"><input class="weui-input" type="password" id="captcha" name="captcha" placeholder="请输入验证码"></div>
      <div class="weui-cell__ft"><img class="weui-vcode-img" src="<?php echo $this->config->item('catalog');?>/common/captcha" align="absbottom" onclick="this.src='<?php echo $this->config->item('catalog');?>/common/captcha?'+Math.random();"></div>
    </div>
  </div>
	<div class="weui-btn-area">
		<button type="submit" class="weui-btn weui-btn_primary">提交</button>
	</div>
</form>


</div>


<script>
		//验证表单
		$(document).ready(function(){
				$("#edit-paswd-form").validate({
						rules:{
							current_password: {
								required: true,
								rangelength: [6,18],
								remote: "/user/edit/verify_current_password"
							},
							new_password: {
								required: true,
								rangelength: [6,18],
							},
							confirm_password: {
								required: true,
								rangelength: [6,18],
								equalTo:"#new_password"
							},
							captcha: {
								required: true,
								rangelength:[4,4],
								remote: "/common/captcha/veri"
							}
						},
						messages:{
							current_password: {
								required: "当前密码不能为空",
								rangelength: "密码6——18位",
								remote: "当前密码不正确"
							},
							new_password: {
								required: "请输入新密码",
								rangelength: "新密码6——18位"
							},
							confirm_password: {
								required: "请输入确认密码",
								rangelength: "密码6——18位",
								equalTo:"密码输入不一至"
							},
							captcha: {
								required: "验证码不能为空",
								rangelength:"验证码4个字符",
								remote: "验证码不正确！"
							},
						}
					});
			});
	</script>


<?php echo $footer;//装载header?>
