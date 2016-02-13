//очистка кеша
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

var currentMainCategory = 0;

//подгрузка выбранных категорий в список для главной
function load_categories()
{
    if(currentMainCategory == 0)
        currentMainCategory = $('#product-main_category').val();
	$('#product-main_category option').remove();
	$('#product-category_ids input:checked').each(function(){
		var value = $(this).val();
		var name = $(this).parent().text();
        if(value ==currentMainCategory) {
            var option = $('<option/>',{
                value:value,
                text:name,
                selected:1
            });
        }
        else{
            var option = $('<option/>',{
                value:value,
                text:name
            });
        }

        if(value == currentMainCategory)
            option.selected = true;
		$('#product-main_category').append(option);
		option = null;
	});
}

$('#product-category_ids label input').change(function(){
	load_categories();
});
$(document).ready(function(){
	load_categories();
});
