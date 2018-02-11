<?php echo $header;//装载header?>

<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span onclick="window.location.href='/user';"></span></div>
  <div class="wy-header-title">地址管理</div>
</header>
<div class="weui-content">
  <div class="weui-panel address-box">

<?php if($addresss):?>
	<?php foreach($addresss as $address):?>
		<div class="weui-panel__bd">
		  <div class="weui-media-box weui-media-box_text address-list-box">
			<a href="<?php echo $this->config->item('catalog').'user/address/edit?address_id='.$address['address_id'];?>" class="address-edit"></a>
			<h4 class="weui-media-box__title">
				<span><?php echo $address['name'];?></span>
				&nbsp;&nbsp;
				<span><?php echo $address['mobile']?substr($address['mobile'],0,3).'****'.substr($address['mobile'],7,4):'';?></span>
			</h4>
			<p class="weui-media-box__desc address-txt"><?php echo $address['address'];?></p>
			
			<?php if($this->user->getAddressId() == $address['address_id']):?>
				<span class="default-add" id="default_id_<?php echo $address['address_id'] ?>">默认地址</span>
			<?php else:?>	
				<input type="checkbox" class="goodsCheck" addressid="<?php echo $address['address_id'] ?>" id="set_defu_id_<?php echo $address['address_id'] ?>">设为默认
				<div class="shop-del">
					<a href="<?php echo $this->config->item('catalog').'user/address/delete?address_id='.$address['address_id'];?>">删除</a>
				</div>
			<?php endif;?>

			
		  </div>
		</div>
   <?php endforeach;?>
<?php endif;?> 

</div>
<div class="weui-btn-area">
<a class="weui-btn weui-btn_primary" href="<?php echo $this->config->item('catalog').'user/address/edit' ?>" id="showTooltips">添加收货地址</a>
</div>
</div>

<script>

$('.goodsCheck').click(function(){
	var addressid = $(this).attr('addressid');
	set_defu(addressid);
});

function set_defu(id){
	$.ajax({
		url: '<?php echo $this->config->item('catalog').'user/address/set_def';?>',
		type: 'post',
		async: false,
		dataType: 'json',
		data: {address_id:id},
		success: function(){
			//window.location.reload();	
		}
	})
	window.location.reload();
}



</script>

<?php echo $footer;//装载header?>
