<?php if(isset($products)):?>
<?php $id=rand(1, 999)?>


<!--猜你喜欢-->
  <div class="wy-Module">
    <div class="wy-Module-tit-line"><span><?php echo $view_name;?></span></div>
    <div class="wy-Module-con">
      <ul class="wy-pro-list clear product-new-list-<?php echo $id;?>">

		<?php foreach($products as $product):?>
			<li> 
			  <a href="<?php echo $this->config->item('catalog');?>product?product_id=<?php echo $product['product_id'];?>">
				<div class="proimg"><img src="<?php echo $this->image_common->resize($product['image'], $this->config->get_config('product_list_image_size_w'), $this->config->get_config('product_list_image_size_h'), 'h');?>" alt="<?php echo $product['name'];?>"></div>
				<div class="protxt">
				  <div class="name"><?php echo mb_substr($product['name'],0,6,'utf-8').'...';?></div>
				  <div class="wy-pro-pri"><span><?php echo $this->currency->Compute($product['price']);?></span></div>
				</div>
			  </a>
			</li>
		<?php endforeach;?>
        
      </ul>
      <!--div class="morelinks"><a href="pro_list.html">查看更多 >></a></div-->
    </div>
  </div>

<?php endif;?>
