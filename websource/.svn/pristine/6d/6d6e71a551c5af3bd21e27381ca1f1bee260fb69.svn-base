		(function($){
			$(window).load(function(){
				/* custom scrollbar fn call */
				
				$(".dashboard").mCustomScrollbar({
					horizontalScroll:true,
					advanced:{
						autoExpandHorizontalScroll:true
					}
				});
				
				/* 
				demo fn 
				functions below are for demo and examples
				*/
				$(".demo_functions a[rel='append-new']").click(function(e){
					e.preventDefault();
					$(".dashboard .images_container").append("<img src='demo_files/mcsThumb1.jpg' class='new' />");
					$(".dashboard .images_container img").load(function(){
						$(".dashboard").mCustomScrollbar("update");
					});
				});
				$(".demo_functions a[rel='prepend-new']").click(function(e){
					e.preventDefault();
					$(".dashboard .images_container").prepend("<img src='demo_files/mcsThumb8.jpg' class='new' />");
					$(".dashboard .images_container img").load(function(){
						$(".dashboard").mCustomScrollbar("update");
					});
				});
				$(".demo_functions a[rel='append-new-scrollto']").click(function(e){
					e.preventDefault();
					$(".dashboard .images_container").append("<img src='demo_files/mcsThumb1.jpg' class='new' />");
					$(".dashboard .images_container img").load(function(){
						$(".dashboard").mCustomScrollbar("update");
						$(".dashboard").mCustomScrollbar("scrollTo","right");
					});
				});
				$(".demo_functions a[rel='scrollto']").click(function(e){
					e.preventDefault();
					$(".dashboard").mCustomScrollbar("scrollTo","#mcs_t_5");
				});
				$(".demo_functions a[rel='remove-last']").click(function(e){
					e.preventDefault();
					$(".dashboard .images_container img:last").remove();
					$(".dashboard").mCustomScrollbar("update");
				});
				$(".demo_functions a[rel='toggle-width']").click(function(e){
					e.preventDefault();
					$(".dashboard").toggleClass("toggle_width");
					$(".dashboard").mCustomScrollbar("update");
				});
				
				
			});
		})(jQuery);
