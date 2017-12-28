<?php echo $header;//装载header?>

<!--顶部搜索-->
<!--主体-->
<div class="wy-content">
  <div class="category-top">
    <header class='weui-header'>
  <div class="weui-search-bar" id="searchBar">
   <form class="weui-search-bar__form" action="/product/category">
      <div class="weui-search-bar__box">
        <i class="weui-icon-search"></i>
        <input type="search" class="weui-search-bar__input" id="searchInput" name="search" placeholder="搜索您想要的商品" value="<?php echo !empty($action_search) ? $action_search : '';?>" required>
        <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
      </div>
      <!--label class="weui-search-bar__label" id="searchText" style="transform-origin: 0px 0px 0px; opacity: 1; transform: scale(1, 1);">
        <i class="weui-icon-search"></i>
        <span>搜索您想要的商品</span>
      </label-->
    </form> 
    <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
  </div>
</header>
  </div>
  <aside>
    <div class="menu-left scrollbar-none" id="sidebar">
      <ul>
		<?php if($munus_names):?>		
			<?php foreach($munus_names as $key=>$name):?>
				<li <?php if($key==0): echo 'class="active"'; endif; ?>> <?php echo $name; ?> </li>
			<?php endforeach; ?>
		<?php endif;?>		 
      </ul>
    </div>
  </aside>

	<?php if($menus):?>
		<?php foreach($menus as $key=>$menu):?>
		<section class="menu-right padding-all j-content" <?php if($key != 0): echo 'style="display:none"'; endif; ?>>
					<ul>
						<?php if(isset($menu['child']) && is_array($menu['child'])):?>
							<?php foreach($menu['child'] as $childs):?>
								<li class="w-3">
									<a href="<?php echo $this->config->item('catalog').'product/category?id='.$menu['category_id'].'_'.$childs['category_id'];?>"></a>
									<img src="/resources/image<?php echo $childs['image'] ?>">
									<span><?php echo $childs['name']; ?></span>
								</li>
							<?php endforeach; ?>
						<?php endif;?>
					</ul>
				  </section>
		<?php endforeach;?>
	<?php endif;?>
  
</div>


<script>
	$(function($){
		$('#sidebar ul li').click(function(){
			$(this).addClass('active').siblings('li').removeClass('active');
			var index = $(this).index();
			$('.j-content').eq(index).show().siblings('.j-content').hide();
		})
	})	
</script>

<?php echo $footer;//装载header?>
