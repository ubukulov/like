$(document).ready(function(){
	var user_phone = $("#user_phone").val();
	$("#myBtn").click(function(e){
		e.preventDefault();
		$("#btn").val(1);
	});
	$("#myBtn1").click(function(e){
		e.preventDefault();
		$("#btn").val(2);
	});
	$("#s91").click(function(e){
		e.preventDefault();
		var val = '316 000'+' &#8376;';
		$("#price").html(val);
	});
	$("#s92").click(function(e){
		e.preventDefault();
		var val = '353 100'+' &#8376;';
		$("#price").html(val);
	});
	$("#s93").click(function(e){
		e.preventDefault();
		var val = '306 300'+' &#8376;';
		$("#price").html(val);
	});
	$("#s94").click(function(e){
		e.preventDefault();
		var val = '343 100'+' &#8376;';
		$("#price").html(val);
	});

	$("#type_color1").on('click', function(e){
		e.preventDefault();
		$("#type_color").val(1);
	});
	$("#type_color2").on('click', function(e){
		e.preventDefault();
		$("#type_color").val(2);
	});
	$("#type_color3").on('click', function(e){
		e.preventDefault();
		$("#type_color").val(3);
	});
	$("#order_btn1").on('click', function(e){
		var name = $("#name").val();
		var phone = $("#phone").val();
		var type_color = $("#type_color").val();
		var price = $("#price").html();
		var btn = $("#btn").val();
		if(name.length > 0 && phone.length > 0){
			e.preventDefault();
			if(btn == 1){
				var title = '';
				var color = '';
				var val = parseInt(price);

				if(val == 316){
					title = 'Galaxy S9';
				}
				if(val == 353){
					title = 'Galaxy S9+';
				}
				if(val == 306){
					title = 'Galaxy S9 оптом от 3-х штук';
				}
				if(val == 343){
					title = 'Galaxy S9+ оптом от 3-х штук';
				}
				if(type_color == 1){
					color = 'черный бриллиант';
				}
				if(type_color == 2){
					color = 'титан';
				}
				if(type_color == 3){
					color = 'ультрафиолет';
				}
				window.location.href = 'https://api.whatsapp.com/send?phone='+user_phone+'&text=Здравствуйте!%20Я%20хотел%20бы%20заказать%20'+title+'.%20 Цена:%20'+price+';%20Цвет:%20'+color+';%20Заказчик:%20'+name+';%20Телефон:%20'+phone+';';
			}
			if(btn == 2){
				window.location.href = 'https://api.whatsapp.com/send?phone='+user_phone+'&text=Здравствуйте!%20Я%20хотел%20бы%20заказать%20смартфон.%20Заказчик:%20'+name+';%20Телефон:%20'+phone+';%20Спасибо!';
			}
		}
	});
});