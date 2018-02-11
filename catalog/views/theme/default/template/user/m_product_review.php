<?php echo $header;//装载header?>

<header class="wy-header">
  <div class="wy-header-icon-back"><span onclick="window.history.go(-1);"></span></div>
  <div class="wy-header-title">评论</div>
</header>

<div class="weui-content clear">
  <div class="order-list-Below clear">
    <h1>商品评价</h1>
    <ul>
      <li class="on"></li>
      <li class="on"></li>
      <li class="on"></li>
      <li class="on"></li>
      <li class="on"></li>
    </ul>
  </div>
<form action="<?php echo $this->config->item('catalog').'user/orders/add_pro_review';?>" method="post" enctype="multipart/form-data" id="cart-form">
  <div class="weui-cells weui-cells_form com-txt-area">
    <div class="weui-cell">
      <div class="weui-cell__bd">
        <input type="text" class="weui-textarea txt-area" name="text" id="text" required maxlength="150" placeholder="随便说点什么把！" rows="3"></textarea>
        <div class="weui-textarea-counter font-12 num"><span id="result">0</span>/150</div>
      </div>
    </div>
  </div>
  <!--div class="weui-cells weui-cells_checkbox commg">
    <label class="weui-cell weui-check__label" for="s11">
      <div class="weui-cell__hd">
        <input type="checkbox" class="weui-check" name="checkbox1" id="s11" checked="checked">
        <i class="weui-icon-checked"></i>
      </div>
      <div class="weui-cell__bd"><p>匿名评价</p></div>
    </label>
  </div>
  <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__bd">
          <div class="weui-uploader">
            <div class="weui-uploader__hd">
              <p class="weui-uploader__title font-14">图片上传</p>
              <div class="weui-uploader__info font-12">0/2</div>
            </div>
            <div class="weui-uploader__bd">
              <ul class="weui-uploader__files" id="uploaderFiles">
                <li class="weui-uploader__file" style="background-image:url(./images/pic_160.png)"></li>
                <li class="weui-uploader__file" style="background-image:url(./images/pic_160.png)"></li>
                <li class="weui-uploader__file" style="background-image:url(./images/pic_160.png)"></li>
                <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./images/pic_160.png)">
                  <div class="weui-uploader__file-content">
                    <i class="weui-icon-warn"></i>
                  </div>
                </li>
                <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./images/pic_160.png)">
                  <div class="weui-uploader__file-content">50%</div>
                </li>
              </ul>
              <div class="weui-uploader__input-box">
                <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" multiple="">
              </div>
            </div>
          </div>
        </div>
      </div>
  </div-->
  <input type="hidden" id="rating" name="rating" value="5">
  <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_id ?>">
  <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id ?>">
  <input type="hidden" id="order_product_id" name="order_product_id" value="<?php echo $order_product_id ?>">
  <div class="com-button"><input type="submit" id="submit" value="发表评论"></div>
</form>
</div>

<script type="text/javascript">
$(".order-list-Below ul li").click(
    function(){
        var num = $(this).index()+1;
        
		$('#rating').val(num);

		if(!$(this).hasClass('on')){
			$(this).addClass('on').prevAll().addClass('on');
			$(this).nextAll().removeClass('on');
		}else{
			$(this).prevAll().addClass('on');
			$(this).nextAll().removeClass('on');
		}
    }
);

$("#text").keyup(function(){
	 var length = 150;
	 var content_len = $("#text").val().length;
	 var in_len = length-content_len;
	
	 // 当用户输入的字数大于制定的数时，让提交按钮失效
	 // 小于制定的字数，就可以提交
	 if(in_len >=0){
		$("#result").text(content_len);
		$("#submit").attr("disabled",false);
		// 可以继续执行其他操作
	 }else{
		$("#result").text(content_len);
		$("#submit").attr("disabled",true);
		return false;
	 }
	
});

</script>

<?php echo $footer;//装载header?>
