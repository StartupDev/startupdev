
// global url var
var URL = window.location.protocol + '//'+ window.location.host,
// global jquery object document
$doc = $(document);

$doc.ready(function(){
 
 	// contact form
	$('#contact-form').validate({
    	rules:{
                name:{
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true
                },
               message:{
                    required: true,
                    minlength: 3
				}
               
        },
        submitHandler: function( form ){
        	
        	var info = $(form).serialize(),
				$feedback = $('#feedback');

			// show loading;
			$feedback.text('Loading...').removeClass('hide');

            $.ajax({
                type: 'POST',
                url: URL + '/send',
                data: info,
                dataType: 'json',
                success: function( data )
                {
                	$feedback.text(data.msg);
                	if(data.success===true){
                		$(':input','#contact-form')
						 .not(':button, :submit, :reset, :hidden')
						 .val('')
						 .removeAttr('checked')
						 .removeAttr('selected');
                	}
                },
                error: function (request, status, error) {
                	$feedback.text('Try again later.');
                }
            });

            return false;
        }
	});

	// skill charts
	$doc.scroll(function(){

		var $skills = $('#skills'),
			paddingTop = 200,
			//collors
			dark = '#FB8200',
			light = '#3c3c3c';

	
		if( ($skills.offset().top - paddingTop) <  $doc.scrollTop() ){

			// prevent from multiple renders
			if($skills.hasClass('chart-enabled'))
				return;
			$skills.addClass('chart-enabled');

			$('.chart').each(function(){
		
				var doughnutData = [
					{
						value: $(this).data('dark'),
						color: dark
					},
					{
						value : $(this).data('light'),
						color : light
					}
				];
				var doughnutChart = new Chart($(this)[0].getContext("2d")).Doughnut(doughnutData);
					
			});
		}
	});
});