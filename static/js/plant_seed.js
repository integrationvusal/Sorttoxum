$(document).ready(function() {

	$('[formaction$="seed_result.php"]').attr('formaction', 'http://sorttoxumagro.gov.az/seed_result.php');

	$('.mcTooltipWrapper').css('display','none'); 
		
		
	$("#owl-demo-foto").owlCarousel({
 
      autoPlay: 3000, //Set AutoPlay to 3 seconds
 
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
 
  });
		
	$("#owl-demo-video").owlCarousel({
 
      autoPlay: 3000, //Set AutoPlay to 3 seconds
 
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
 
  });
	

	$(".plants_seeds_content_block_left ul li").click(function(){
		var index = $(this).index() + 1;
		$(".plants_seeds_content_block_left ul li:nth-child(" + (index + 1) + ") ul").slideToggle("slow");
	});
 
 
	$(window).resize(function() {
		if (window.innerWidth < 900) {

		$('.plants_seeds_content_block_right:parent').each(function () {
			$(this).insertBefore($(this).prev('.plants_seeds_content_block_left'));
		});
		
		$('.plants_seeds_content_block_right:parent').each(function () {
			$(this).insertBefore($(this).prev('.plants_seeds_news_block_left'));
		});

		} else if (window.innerWidth > 900) {

			// Change back to original .LatestNews

		}
	}).resize();

	var i = 0;
	$("ul.column").each(function(index){
		if($.trim($(this).html()) == '') {
			$(this).remove();
			//console.log((i++) + " = " + $(this).html());
		}
	});

	$('.roster-field[name="Plant"]').change(function(){

		$.post('/roster_result.php', {ajax_plant: $(this).val()}, function(res){
			console.log(res)
			$('.roster-field[name="Sort"]').html(res);
		});

	});	


});