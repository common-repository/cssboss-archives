jQuery(document).ready(function($) {

	$('#cssboss_archives_step_one_tooltip').css('display','block');


	$(".ajax-click").live('click',function() {
		var post_id = $(this).parent("li").attr("id");
		var ajaxURL = MyAjax.ajaxurl;
		$('#cssboss_archives_step_two_tooltip').html('Change Anytime');
		$.ajax({
			type: 'POST',
			url: ajaxURL,
			
			data: { action: "load-content", post_id: post_id },
			success: function(response) 
			{
				$("#cssboss_archives_post_content").html(response);
				return false;
	            }
            });
            return false;
      });
      
      $(".cat_click").click(function(){
      
	     var cat_name = $(this).html();
	     var ajaxURL = MyAjax.ajaxurl;
	     $('#cssboss_archives_step_one_tooltip').html('Change Anytime');
		 $('#cssboss_archives_step_two_tooltip').css('display','block');
	     $.ajax({
		     type: 'POST',
		     url: ajaxURL,
		     data: {action:"load-posts",cat_name: cat_name },
		     success: function(response) {
		     $('#cssboss_archives_step_twp_tooltip').css('display','block');
			     $('#cssboss_posts_ajax').html(response);
			    
			     return false;
		     }
	     }); 
	     return false;
      });
      
      $(".tag_click").click(function(){
      
	     var tag_name = $(this).html();
	     var ajaxURL = MyAjax.ajaxurl;

	     $.ajax({
		     type: 'POST',
		     url: ajaxURL,
		     data: {action:"load-posts",tag_name: tag_name },
		     success: function(response) {
			     $('#cssboss_posts_ajax').html(response);
			     return false;
		     }
	     }); 
	     return false;
      });
      
});