<?php echo $header;//装载header?>

<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span onclick="window.location.href='/user/address';"></span></div>
  <div class="wy-header-title">编辑地址</div>
</header>
<div class="weui-content">
  <div class="weui-cells weui-cells_form wy-address-edit">
	<form class="form-horizontal well well-sm" action="<?php echo $this->config->item('catalog').'user/address/add';?>" method="post" >

    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">收货人姓</label></div>
	  <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="姓氏" maxlength="30" id="firstname" name="firstname" value="<?php echo $address_info ? $address_info['firstname'] : '';?>">
	  </div>
    </div>
	<div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">收货人名</label></div>
	  <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="名称" maxlength="30" id="lastname" name="lastname" value="<?php echo $address_info ? $address_info['lastname'] : '';?>">
	  </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">手机号</label></div>
	  <div class="weui-cell__bd">
			<input class="weui-input" type="number" pattern="[0-9]*" min="11" max="11" placeholder="手机号" id="mobile" name="mobile" value="<?php echo $address_info ? $address_info['mobile'] : '';?>">
	  </div>
    </div>
	<div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">邮编</label></div>
	  <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="邮编" maxlength="30" id="postcode" name="postcode" value="<?php echo $address_info ? $address_info['postcode'] : '';?>">
	  </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label for="name" class="weui-label wy-lab">城市</label></div>
	  <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="城市" maxlength="30" id="city" name="city" value="<?php echo $address_info ? $address_info['city'] : '';?>">
	  </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">详细地址</label></div>
      <div class="weui-cell__bd">
			<input class="weui-input" type="text" placeholder="详细地址" maxlength="120" id="address" name="address" value="<?php echo $address_info ? $address_info['address'] : '';?>">
      </div>
    </div>
	<div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">国家</label></div>
      <div class="weui-cell__bd">
			<select class="form-control" id="country" onchange="countrye(this, '<?php echo $address_info ? $address_info['zone_id'] : '';?>');" name="country_id" class="form-control">
				<?php foreach($countrys as $country):?>
					<?php if($address_info['country_id'] == $country['country_id']):?>
						<option value="<?php echo $country['country_id']?>" selected><?php echo $country['name']?></option>
					<?php else:?>
						<option value="<?php echo $country['country_id']?>"><?php echo $country['name']?></option>
					<?php endif;?>
				<?php endforeach;?>
			</select>
      </div>
	</div>
	<div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label wy-lab">省份</label></div>
      <div class="weui-cell__bd">
			<select name="zone_id" id="zone" class="form-control">
				<option value="">--无--</option>
			</select>
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">设为默认地址</div>
      <div class="weui-cell__ft"><input class="weui-switch" type="checkbox" name="user_address_id" <?php echo ($this->input->get('address_id') == $this->user->getAddressId()) ? 'checked' : '';?> value="<?php echo $this->input->get('address_id');?>"></div>
    </div>

		<?php if($this->input->get('address_id') != NULL):?>
			<input type="hidden" name="address_id" value="<?php echo $this->input->get('address_id');?>"/>
		<?php endif;?>
	</form>
  </div> 
  <div class="weui-btn-area">
		
    <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">保存此地址</a>
  </div>

</div>


<script>

$('#showTooltips').click(function(){
	$('.form-horizontal').submit();
})

function countrye(element, zone_id=''){
			$.ajax({
					url: "<?php echo $this->config->item('catalog').'localisation/country/get_country?country_id=';?>" + element.value,
					dataType: 'json',	
					success: function(json)
					{
						if (json['postcode_required'] == '1')
						{
							$('input[name=\'postcode\']').parent().parent().find('label').prepend('<span style="color:red">*&nbsp;</span>');
						} else
						{
							$('input[name=\'postcode\']').parent().parent().find('label').find('span').remove();
						}

						html = '';
						
						if (json['zone'] && json['zone'] != '')
						{
							for (i = 0; i < json['zone'].length; i++)
							{
								html += '<option value="' + json['zone'][i]['zone_id'] + '"';

								if (json['zone'][i]['zone_id'] == zone_id)
								{
									html += ' selected="selected"';
								}

								html += '>' + json['zone'][i]['zone_name'] + '</option>';
							}
						} else
						{
							html += '<option value="0">--无--</option>';
						}

						$('select[name=\'zone_id\']').html(html);
					},
					error: function(xhr, ajaxOptions, thrownError)
					{
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
		}
		$('select[name=\'country_id\']').trigger('change');

</script>

<?php echo $footer;//装载header?>
