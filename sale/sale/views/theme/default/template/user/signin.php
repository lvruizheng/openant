<?php echo $header;//装载header?>
<?php echo $login_top;//装载top?>
<div class="container">
	<div class="row">
		<div id="middle" class="col-sm-12">
			<?php echo $position_top; ?>
			<div class="col-sm-9 hidden-xs hidden-sm" style="padding-left:0">
				<?php echo $position_bottom; ?>
			</div>
			<?php echo $position_left;?>
			<div class="col-sm-3 panel panel-default middle-flat-left">
				<div class="panel-body">
					<form action="<?php echo $this->config->item('catalog').'user/signin/login?url='.$this->input->get('url');?>" method="post" enctype="multipart/form-data" id="signin">
						<input type="hidden" name="group_id" value="sale">

						<p class="text-center login-title">
						<strong>登录</strong><hr style="margin: 10px 0">
						<div class="form-group error">
						</div>
						<div class="form-group">
							<input type="text" id="email" name="email" value=""
							placeholder="邮箱"
							class="form-control" />
						</div>
						<!-- /field -->
						<div class="form-group">
							<input type="password" id="password" name="password" value=""
							placeholder="密码"
							class="form-control" />
						</div>
						<!-- /password -->
						
						<div class="form-group">
							<button type="submit" class="btn btn-info btn-block">
								登录
							</button>
						</div>
						<!-- .actions -->
					</form>
				</div>
				
			</div>
			<?php echo $position_right; ?>
		</div>
	</div>
</div>

<?php
if(isset($error_times)):?>
<script type="text/javascript">
	$(document).ready(function () {$.notify({message: '<?php echo $error_times;?>' },{type: 'danger',offset: {x: 0,y: 52}});});
</script><?php endif;?>
<?php
if(isset($message)):?>
<script type="text/javascript">
	$(document).ready(function () {$.notify({message: '<?php echo $message;?>' },{type: 'message',offset: {x: 0,y: 52}});});
</script><?php endif;?>
<?php
if(isset($error_check)):?>
<script type="text/javascript">
	$(document).ready(function () {$.notify({message: '<?php echo $error_check;?>' },{type: 'warning',offset: {x: 0,y: 52}});});
</script><?php endif;?>
<?php
if(isset($_SESSION['warning'])):?>
<script type="text/javascript">
	$(document).ready(function () {$.notify({message: '<?php echo $_SESSION['warning'];?>' },{type: 'warning',offset: {x: 0,y: 52}});});
</script><?php endif;?>

<?php echo $login_footer;?>
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
							required: "邮箱不能为空",
							email: "邮箱格式不对"
						},
						password:
						{
							required: "密码不能为空",
							rangelength: "密码格式不对"
						}
					}
				});
		});
</script>
