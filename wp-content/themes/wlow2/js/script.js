(function ($) {

	/* Animate link to the top */
	$("a[href='#top']").click(function() {
	  $("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});

	/* Activate gallery */
	$('.gallery').magnificPopup({
        gallery:{enabled:true},
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        // other options
    });

	/* Side Menu */
	var sideslider = $('[data-toggle=collapse-side]');
  var sel = sideslider.attr('data-target');
  var sel2 = sideslider.attr('data-target-2');
  sideslider.click(function(event){
      $(sel).toggleClass('in');
      $(sel2).toggleClass('out');
  });
  
	/* Menu x animation */
	$(".navbar-toggle").on("click", function () {
	  $(this).toggleClass("navbar-toggle--active");
	});

  /* Menu Animation on scroll */
	var wlow_scroll_pos = 0;
	 $(document).scroll(function() {
			 wlow_scroll_pos = $(this).scrollTop();
			 if(wlow_scroll_pos > 180) {
				   $("body").addClass( "navbar-scroll-down" );
					 $(".top-bar").css({'margin-top': '-30px'});
					 $(".navbar-brand").css({'height': '50px', 'line-height': '50px'});
					 $("body.admin-bar .navbar-fixed-top").css({'height': '50px'});
			 } else {
				  $("body").removeClass( "navbar-scroll-down" );
					$(".top-bar").css({'margin-top': '0px'});
					$(".navbar-brand").css({'height': '80px', 'line-height': '80px'});
					$("body.admin-bar .navbar-fixed-top").css({'height': '80px'});
			 }
	 });

	/* Parallax Effect */
  $.fn.parallax = function(options) {
      var windowHeight = $(window).height();
      // Establish default settings
      var settings = $.extend({
          speed        : 0.15,
          margin : false,
      }, options);
      // Iterate over each object in collection
      return this.each( function() {
      	// Save a reference to the element
      	var $this = $(this);
      	// Set up Scroll Handler
      	$(document).scroll(function(){
	        var scrollTop = $(window).scrollTop();
      	  var offset = $this.offset().top;
      	  var height = $this.outerHeight();
		  		// Check if above or below viewport
					if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
						return;
					}
					var yBgPosition = Math.round((offset - scrollTop ) * settings.speed);
		      // Apply the Y Background Position to Set the Parallax Effect
		      if (settings.margin == true){
			      //margin top animation
			      $this.css( 'top', yBgPosition );
		      } else {
			      //background animation
			      $this.css('background-position', 'center ' + yBgPosition + 'px');
		      }
      	});
      });
  }

  $('.parallax-background').parallax({ speed :	0.15, });
  
  
  $('.parallax-image').parallax({ speed :	0.30, margin : true });


	/* Scrollspy */
	if ($(".home")[0]){

		/* Scrollspy Home */
		$('body').scrollspy({ target: '#mainmenu' });
    $(".navbar-collapse ul li a[href^='#'], .scroll-to[href*='#']").not(".dropdown > a").on('click', function(e) {
	  	
    	// prevent default anchor click behavior
			e.preventDefault();
			
	  	target = this.hash;
			
			// animate
			$('html, body').animate({
				scrollTop: $(this.hash).offset().top
			}, 1000, 'swing',function(){
				// when done, add hash to url
				// (default click behaviour)
				window.location.hash = target;
			});

			// if is cover button
			if ($(this).hasClass('scroll-to')){
			   // do nothing
		 	} else {
			 	// close menu on mobile
			 	$(sel).toggleClass('in');
			 	$(sel2).toggleClass('out');	// and here
			 	$(".navbar-toggle").toggleClass("navbar-toggle--active");
		 	}

    });

	} else {

		/* Scrollspy in internal page */
	  var path_wp = php_vars.path_wp;
    $(".navbar-collapse ul li a[href^='#']").not(".dropdown > a").on('click', function(e) {
	  	 target = this.hash;
       // prevent default anchor click behavior
       e.preventDefault();
       window.location.href = path_wp + target;
    });

	}

}(jQuery));
