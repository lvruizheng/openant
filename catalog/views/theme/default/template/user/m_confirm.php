<?php echo $header;//装载header?>

<style>
.weui-content{padding-bottom:40px;}
</style>
<!--主体-->
<header class="wy-header">
  <div class="wy-header-icon-back"><span onclick="window.history.go(-1);"></span></div>
  <div class="wy-header-title">订单详情</div>
</header>
<div class="weui-content">

<form action="<?php echo $this->config->item('catalog').'user/confirm/checkout';?>" method="post" enctype="multipart/form-data" id="forget-form">
  <div class="wy-media-box weui-media-box_text address-select">
		<?php $is_defau = false; ?>
		<?php if($addresss):?>
			<?php foreach($addresss as $key=>$address):?>
				<?php if($address['address_id'] == $this->user->getAddressId()):?>
					<input type="hidden" value="<?php echo $addresss[$key]['address_id'];?>" name="order[address_id]">
					<input type="hidden" value="<?php echo $addresss[$key]['address_id'];?>" name="order[payment_id]">
					<div class="weui-media-box_appmsg">
						<div class="weui-media-box__hd proinfo-txt-l" style="width:20px;">
						</div>
						<div class="weui-media-box__bd">
							<a href="<?php echo $this->config->item('catalog').'user/address';?>" class="weui-cell_access">
							<h4 class="address-name"><span><?php echo $address['name'] ?></span><span><?php echo $address['mobile']?substr($address['mobile'],0,3).'****'.substr($address['mobile'],7,4):'';?></span></h4>
								<div class="address-txt"><?php echo $address['address'] ?></div>
							</a>
						</div>
						<div class="weui-media-box__hd proinfo-txt-l" style="width:16px;">
							<div class="weui-cell_access">
								<span class="weui-cell__ft"></span>
							</div>
						</div>
					</div>
					<div>
						默认地址	
					</div>
					<?php unset($addresss[$key]);?>
					<?php $is_defau = true; ?>
				<?php endif;?>
			<?php endforeach;?>

			<?php if($is_defau == false): ?>
					<input type="hidden" value="<?php echo $addresss[0]['address_id'];?>" name="order[address_id]">
					<input type="hidden" value="<?php echo $addresss[$key]['address_id'];?>" name="order[payment_id]">
					<div class="weui-media-box_appmsg">
						<div class="weui-media-box__hd proinfo-txt-l" style="width:20px;">
						</div>
						<div class="weui-media-box__bd">
							<a href="<?php echo $this->config->item('catalog').'user/address';?>" class="weui-cell_access">
							<h4 class="address-name"><span><?php echo $addresss[0]['name'] ?></span><span><?php echo $addresss[0]['mobile']?substr($addresss[0]['mobile'],0,3).'****'.substr($addresss[0]['mobile'],7,4):'';?></span></h4>
								<div class="address-txt"><?php echo $addresss[0]['address'] ?></div>
							</a>
						</div>
						<div class="weui-media-box__hd proinfo-txt-l" style="width:16px;">
							<div class="weui-cell_access">
								<span class="weui-cell__ft"></span>
							</div>
						</div>
					</div>
					
					<div>
						未设置默认地址	
					</div>
			<?php endif; ?>
		<?php endif;?>

  </div>

<?php foreach($carts_product as $key=>$value):?>
	<div class="wy-media-box weui-media-box_text">
		<tr class="" style="background-color: #d9edf7;">
			<td colspan="3">店铺：<?php echo $carts_product[$key]['store_name'];?></td>
			<td colspan="2"></td>
		</tr>

		<div class="weui-media-box__bd">
			<?php if(isset($value['products'])):?>
			<?php foreach($value['products'] as $k=>$v):?>
				<input type="hidden" value="<?php echo $v['rowid'];?>" name="rowid[]"/>
				<div class="weui-media-box_appmsg ord-pro-list">
					<div class="weui-media-box__hd">
						<a href="<?php echo $this->config->item('catalog').'product?product_id='.$v['id'];?>">
							<img class="weui-media-box__thumb" src="<?php echo '/'.$this->image_common->resize($v['image'], $this->config->get_config('product_list_image_size_w'), $this->config->get_config('product_list_image_size_h'));?>" alt="<?php echo $v['name']; ?>">
						</a>
					</div>
					<div class="weui-media-box__bd">
						<h1 class="weui-media-box__desc">
							<a href="<?php echo $this->config->item('catalog').'product?product_id='.$v['id'];?>" class="ord-pro-link"><?php echo $v['name']; ?></a>
						</h1>
						<p class="weui-media-box__desc">
							<?php echo isset($v['options']) ? $v['options'] : '';?>
						</p>
						<div class="clear mg-t-10">
						<div class="wy-pro-pri fl">¥<em class="num font-15"><?php echo $v['price'] ?></em></div>
						<div class="pro-amount fr"><span class="font-13">数量×<em class="name"><?php echo $v['qty'] ?></em></span></div>
						</div>
					</div>
				</div>
			<?php endforeach;?>	
			<?php endif;?>
		</div>

		<tr>
			<td colspan="5">
				<div class="form-group">
					<label for="store-number-<?php echo $value['store_id'];?>" style="line-height: 34px;magin: 0;font-weight: 200">给商家留言</label>
					<div class="">
						<input type="text" name="order[<?php echo $value['store_id'];?>][message]" class="form-control" id="store-number-<?php echo $value['store_id'];?>" placeholder="给商家留言">
					</div>
				</div></td>
		</tr>
	</div>
<?php endforeach;?>

  <div class="weui-panel">
    <div class="weui-panel__bd">
      <div class="weui-media-box weui-media-box_small-appmsg">
        <div class="weui-cells">
          <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd weui-cell_primary">
              <p class="font-14"><span class="mg-r-10">配送方式</span><span class="fr">快递</span></p>
            </div>
          </div>
          <div class="weui-cell weui-cell_access" href="javascript:;">
            <div class="weui-cell__bd weui-cell_primary">
              <p class="font-14"><span class="mg-r-10">运费</span><span class="fr txt-color-red">￥<em class="num">10.00</em></span></p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>

		<div class="payment-bar">
			<div class="shop-total">
				<strong>总价：<i class="total" id="AllTotal"><?php echo $total;?></i></strong>
			</div>
			<input type="submit" class="settlement" value="提交订单" >
		</div>

  

	</form>
</div>



<?php echo $footer;//装载header?>
