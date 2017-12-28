<?php echo $header;//装载header?>


<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span></span></div>
  <div class="wy-header-title"><?php echo lang_line('register');?></div>
</header>
<div class="weui-content">
  <div class="weui-cells weui-cells_form wy-address-edit">
	<form action="<?php echo $this->config->item('catalog').'user/signin/signinup';?>" method="post" enctype="multipart/form-data" id="signup">
		<div class="weui-cell">
		  <div class="weui-cell__hd"><label class="weui-label wy-lab">邮箱</label></div>
		  <div class="weui-cell__bd"><input class="weui-input" type="tel" name="email" id="email" placeholder="<?php echo lang_line('email');?>"></div>
		</div>
		<div class="weui-cell">
		  <div class="weui-cell__hd"><label class="weui-label wy-lab">验证码</label></div>
		  <div class="weui-cell__bd"><input class="weui-input" type="number" id="captcha" name="captcha" placeholder="<?php echo lang_line('captcha');?>"></div>
		  <div class="weui-cell__ft">
			<img title="<?php echo lang_line('refresh');?>"
				src="<?php echo $this->config->item('catalog').'common/captcha';?>"
				align="absbottom"
				onclick="this.src='<?php echo $this->config->item('catalog');?>common/captcha?'+Math.random();">
			</img>
		  </div>
		</div>
		<div class="weui-cell">
		  <div class="weui-cell__hd"><label class="weui-label wy-lab">密码</label></div>
		  <div class="weui-cell__bd"><input class="weui-input" type="number" name="password" id="password" pattern="[0-9]*" placeholder="<?php echo lang_line('password');?>"></div>
		</div>
		<div class="weui-cell">
		  <div class="weui-cell__hd"><label class="weui-label wy-lab">昵称</label></div>
		  <div class="weui-cell__bd"><input class="weui-input" type="number" id="nickname" name="nickname" pattern="[0-9]*" placeholder="<?php echo lang_line('nickname');?>"></div>
		</div>
	</form>
  </div>
  <label for="weuiAgree" class="weui-agree">
    <input id="weuiAgree" name="agree" type="checkbox" class="weui-agree__checkbox"><?php echo lang_line('agree');?>
	<span class="weui-agree__text">
		<a onclick="window.open('<?php echo $this->config->item('catalog').'helper/faq?id='.$this->config->get_config('registration_terms');?>');"><?php echo lang_line('registration_terms');?></a>
	</span>
  </label>
  <div class="weui-btn-area"><a href="javascript:;" class="weui-btn weui-btn_warn"><?php echo lang_line('register');?></a></div>
  
</div>



<script>

	//第三方登陆
	function with_login(key)
	{
		window.open ('<?php echo $this->config->item('catalog');?>/user/sns/session/'+key,'newwindow','height=400,width=400,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
	}
	//注册
	$(document).ready(function()
		{
			$("#signup").validate(
				{
					rules:
					{
						email:
						{
							required: true,
							email: true,
							remote: "/user/signin/check_email_web"
						},
						password:
						{
							required: true,
							rangelength: [6,18],
						},
						nickname:
						{
							required: true,
							cn_edu: true,
							rangelength: [3,18],
						},
						captcha:
						{
							required: true,
							rangelength:[4,4],
							remote: "<?php echo $this->config->item('catalog');?>/common/captcha/veri"
						},
						agree:
						{
							required: true,
						}
					},
					messages:
					{
						email:
						{
							required: "<?php echo lang_line('email');?>",
							email: "<?php echo lang_line('error_email');?>",
							remote: "<?php echo lang_line('error_registered');?>"
						},
						password:
						{
							required: "<?php echo lang_line('password');?>",
							equalTo: "<?php echo lang_line('error_password');?>"
						},
						nickname:
						{
							required: "<?php echo lang_line('nickname');?>",
							cn_edu: "<?php echo lang_line('error_nickname');?>",
							rangelength: "<?php echo lang_line('error_nickname');?>",
						},
						captcha:
						{
							required: "<?php echo lang_line('captcha');?>",
							rangelength: "<?php echo lang_line('error_captcha_lenght');?>",
							remote: "<?php echo lang_line('error_captcha');?>"
						},
						agree:
						{
							required: "<?php echo lang_line('agree');?>",
						},
					},
					errorPlacement: function(error, element)
					{
						if ( element.is(":checkbox") )
						error.appendTo ( element.parent().parent().parent() );
						else
						error.insertAfter(element);
					}
				});
		});
</script>
