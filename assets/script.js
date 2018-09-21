jQuery(document).ready(function($){
	$('.mailerlite-form').submit(function(){
		var f = $(this);
		$.ajax({
	    	url: f.attr('action'),
	    	data: f.serialize(),
	    	type: "POST",
	    	cache: false,
	    	dataType: 'json',
	    	success: function(res){
    			if (res.error) {
    				var err = $('<div class="alert alert-danger">'+res.error+'</div>');
    				f.append(err);
					setTimeout(function(){err.fadeOut("slow", function() {
						err.remove();
					 })}, 3000);    				
    			} else {
    				f.html('<div class="alert alert-success">'+res.success+'</div>');
    			}
	    	}
	    });			
		return false;
	})
})