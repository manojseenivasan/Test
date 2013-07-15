var $jQ = jQuery.noConflict();

$jQ(document).ready(function(){	

	//Homepage
	$jQ('#mycarousel').jcarousel({
        vertical: true,
        scroll: 1,
		wrap: 'circular'
    });
	
	$jQ('.categories-slide .products-slide').jcarousel({
        scroll: 1,
		wrap: 'circular'
    });
	
	$jQ('#brands').jcarousel({
        horizontal: true,
        scroll: 1,
		wrap: 'circular'
    });
	
	$jQ('#tabs').tabs();
	
	$jQ('#brands li a').click(function(){
		var url = $jQ(this).attr('href');
		window.location = url;
	});
	
	//Category List
	$jQ('.products-grid li').hover(function(e){
		e.preventDefault();
		$jQ(this).find('.catalog-image a').toggleClass('hover');
		$jQ(this).toggleClass('hover');
		$jQ(this).find('.product-info').fadeToggle(100);
	});

	$jQ('.products-grid li').each(function() {
		var view = $jQ(this).find('.product-actions');
		$jQ('.catalog-image', this).hover(function() {
			view.stop().css('display','block').animate({
				opacity: 1
			}, 200);
		}, function() {
			view.stop().animate({
				opacity: 0
			}, 200, function() {
				$jQ(this).css('display','none');
			});
		});
		view.hide();
	});
	
	//Top Cart
	$jQ('.topCart span.content').click(function(){
		$jQ('.mini-cart').slideToggle('medium');
	});
	
	//Mini Login
	$jQ('#linkLogin').click(function(){
		$jQ('.top-login .mini-login').slideToggle('medium');
	});
	
	//My Account
	$jQ('.account-create .fieldset:last').css('margin-right','0');
	
	//Vertical Navigation
	$jQ(".category span").click(function() {
		var open = this.getAttributeNode('lang').value;
		$jQ(".subcategory_" + open).slideToggle('medium');
		$jQ(".subcategory_" + open).parent().prev().toggleClass('openn');
	}); 
	
	$jQ("#left-nav li.category, #left-nav li.cate").mouseenter(function() {
		$jQ(this).addClass('over');
	}).mouseleave(function() {
		$jQ(this).removeClass('over');
	}); 
	
	$jQ('.block-account a:contains("My Wishlist")').addClass('wishlist-link');
	$jQ('.block-account a:contains("My Orders")').addClass('orders-link');
	
	
	$jQ('#left-nav .cate.active').parents('#left-nav').find('.category.active a').css({'background': 'none repeat scroll 0 -2px transparent', 'color': '#999999'});
	$jQ('#left-nav .cat.active').parents('#left-nav').find('.category.active a').css({'background': 'none repeat scroll 0 -2px transparent', 'color': '#999999'})
	$jQ('#left-nav .cat.active').parents('#left-nav').find('.cate.active a').css({'background': 'none repeat scroll 0 -2px transparent', 'color': '#666666'})
	
	//$jQ('.more-views  a').lightBox();
	
	var select = $jQ('.store-switch li.selected').html();
	$jQ('.selectSwitch').append(select);
	$jQ(".selectSwitch").click(function() {
		$jQ('.selectSwitch').html('');
		var select = $jQ('.store-switch li.selected').html();
		$jQ('.selectSwitch').append(select);
		$jQ('.ulSelect').slideToggle('medium');
	});  


	var wt = $jQ(window).width();
	if(wt < 480) {
		$jQ('.cms-home .col-main.span9').remove();
		$jQ('.vertical-carousel, .categories-slide').remove();
		$jQ('#search_mini_form').insertAfter('.quick-access');
		$jQ('#left-nav').appendTo('.cms-home .main');
		$jQ('.wishlist-link').insertBefore('.dashboard');
		$jQ('.orders-link').insertBefore('.dashboard');
		$jQ('.topbarMenu').click(function(){
			$jQ('.site-links ul.links').slideToggle('medium');
		});
	} return false;

	$jQ("ul#nav li").find('ul').append('<span class="arrow"></span>');

	function switcher () {	
		$jQ('.switcher a.switch').click(function(){
			$jQ(this).toggleClass("hover");
			$jQ(this).next('.options').slideToggle(100);
		});
	}

	function layered_nav () {
		$jQ('.block-layered-nav dt').each(function(){
			$jQ(this).addClass('hover');
			$jQ(this).toggle(function(){
				$jQ(this).removeClass('hover').next().slideUp(200);
			},function(){
				$jQ(this).addClass('hover').next().slideDown(200);
			})
		});                        		
		$jQ('.block-layered-nav dt').append('<span class="toggle"></span>');
	}

	layered_nav ();			
	switcher();
		
});