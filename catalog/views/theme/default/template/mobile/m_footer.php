<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script> 
<!--script src="resources/public/resources/mobile/lib/fastclick.js"></script> 
<script src="resources/public/resources/mobile/js/jquery-weui.js"></script>
<script src="resources/public/resources/mobile/js/swiper.js"></script>
<script src="resources/public/resources/mobile/js/jquery.Spinner.js"></script-->
<script>
	$(".swiper-banner").swiper({
        loop: true,
        autoplay: 3000
      });
	$(".swiper-news").swiper({
		loop: true,
		direction: 'vertical',
		paginationHide :true,
        autoplay: 30000
      });
	 $(".swiper-jingxuan").swiper({
		pagination: '.swiper-pagination',
		loop: false,
		paginationType:'fraction',
        slidesPerView:3,
        paginationClickable: true,
        spaceBetween: 2
      });
	 $(".swiper-jiushui").swiper({
		pagination: '.swiper-pagination',
		paginationType:'fraction',
		loop: false,
        slidesPerView:3,
		slidesPerColumn: 2,
        paginationClickable: true,
        spaceBetween:2
      });

	//退出登陆
	function logout(){
		$.get("<?php echo $this->config->item('catalog');?>/user/signin/logout",function(){
			window.location.reload();
		});
	}
</script>
</body>
</html>


