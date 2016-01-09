$('.clear-cache').click(function(e){
	e.preventDefault();
	if($('.b-flush-cache-responce').length == 0)
		var responce = document.createElement('div');
	$(responce).addClass('b-flush-cache-responce');
	var widthElem = $(responce).outerWidth();
	var screenWidth = $(document).width();
	var leftPosition = Math.round((screenWidth-widthElem)/2);
	$(responce).css('left',leftPosition)
	$('body').prepend(responce);
	$.get("/backend/flush-cache",
    function(data, textStatus){
    	$('.b-flush-cache-responce').html(data).show().fadeOut(2000);

      },
    "text"
);
});