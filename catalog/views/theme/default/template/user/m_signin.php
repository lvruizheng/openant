<?php echo $header;//装载header?>

<style>
</style>

<!--主体-->

<header class="wy-header">
  <div class="wy-header-icon-back">
	<a href="javascript:;" class="back" onclick="window.history.go(-1);"><span></span></a>
  </div>
  <div class="wy-header-title"><?php echo lang_line('login');?></div>
</header>

<div class="login-box">
    <div class="login-form">
		<form action="<?php echo $this->config->item('catalog').'user/signin/login?url='.$this->input->get('url');?>" method="post" enctype="multipart/form-data" id="signin">

        	<div class="login-user-name common-div">
            	<span class="eamil-icon common-icon">
                	<img src="/resources/public/resources/mobile/images/eamil.png" />
                </span>
                <input type="email" name="email" value="" placeholder="<?php echo lang_line('email');?>" />        
            </div>
            <div class="login-user-pasw common-div">
            	<span class="pasw-icon common-icon">
                	<img src="/resources/public/resources/mobile/images/password.png" />
                </span>
                <input type="password" name="password" value="" placeholder="<?php echo lang_line('password');?>" />        
            </div>
            <a href="javascript:;" onclick="$('#signin').submit();" class="login-btn common-div"><?php echo lang_line('login');?></a>
            <!--a href="javascript:;" class="login-oth-btn common-div">微信登陆</a>
            <a href="javascript:;" class="login-oth-btn common-div">QQ登陆</a-->
        </form>
    </div>
    <div class="forgets">
    	<!--a href="/user/forget"><?php echo lang_line('forget');?></a-->
        <a href="/user/signin/signinup">免费注册</a>
    </div>
</div>



<script>
	//第三方登陆
	function with_login(key)
	{
		window.open ('<?php echo $this->config->item('catalog');?>/user/sns/session/'+key,'newwindow','height=500,width=500,top=0,left=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no');
	}

	//登陆
	$(document).ready(function()
		{
			$("#signin").validate(
				{
					rules:
					{
						email:
						{
							required: true,
							email: true
						},
						password:
						{
							required: true,
							rangelength: [6,18],
						}
					},
					messages:
					{
						email:
						{
							required: "<?php echo lang_line('email');?>",
							email: "<?php echo lang_line('error_email');?>"
						},
						password:
						{
							required: "<?php echo lang_line('password');?>",
							rangelength: "<?php echo lang_line('error_password');?>"
						}
					}
				});
		});
</script>
