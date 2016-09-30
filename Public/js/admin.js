(function($){
	$.fn.extend({
		//nav 部分
 		navToggle:function(target){ 
 			$target = $(target) || $(this);
  			this.on("click touchmove",function(){
    			if($target.is(':hidden')){
      				$("body").animate({"scrollTop":0}, 0.5,function(){
        				$target.slideDown(500);
      				})
    			}else{
      				$target.slideUp(500);
   				}
 			 });

  			$(window).on("resize",function(){
  				if($target.is(':hidden') && $(document).width() >= 768){
  					$target.show();
  				}
  			});

  			$("#main").on("click touchstart touchmove wheel",function(){
          if($(document).width() < 768){
            $target.slideUp(500);
          }
  			});

  			$target.on("touchmove",function(event){
  				event.preventDefault();
  			})

  			return this;
 		},

 		//class navchild show and hidden trigger event
 		arrowToggle: function(){
 			$(this).on("click", $.proxy(function(event){
 				event.preventDefault();
 				var target =  event.target;
 				if( $(target).next().is(":hidden")){
 					$(this).next().slideUp();
 					$("span", this).css({ "-webkit-transform": "rotate(0deg)" });
 					$(target).next().slideDown(500);
 					$("span", target).css({ "-webkit-transform": "rotate(90deg)" });
 				}else{
 					$(target).next().slideUp(500);
 					$("span", target).css({ "-webkit-transform": "rotate(0deg)" });
 				}
 			},this));
 		}
	});
})(jQuery);