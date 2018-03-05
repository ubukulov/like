/***********************
 отправка формы в php BEGIN
***********************/
$(document).ready(function(){

	$(".ajax-form").on("submit", function(event) {
		var form = $(this);
		var send = true;
		event.preventDefault();
		$(this).find("[data-req='true']").each(function(){
			if ($(this).val() === "") {
				$(this).addClass('error');
				send = false;
			}
		});

		$(this).find("[data-req='true']").on('focus', function(){
			$(this).removeClass('error');
		});
		var modal_name = $(this).attr('data-modal-name');
		var val = $(this).attr('data-value');
		var user_phone = $("#user_phone").val();
		switch(modal_name){
			/* розничная */
			case "modal-retail":
				var name = $("#retail_name"+val).val();
				var phone = $("#retail_phone"+val).val();
				var flower_name = $("#colb_n"+val).text();
				var flower_desc = $("#colb_d"+val).text();
				var flower_price = $("#colb_p"+val).text();
				
				window.location.href = "https://api.whatsapp.com/send?phone="+user_phone+"&text=Здравствуйте!%20Хочу%20заказать%20розу%20'"+flower_name+"'%20по%20розничной%20цене.%20Стоимость:%20"+flower_price+";%20Описание:%20"+flower_desc+";%20Покупатель:%20"+name+",%20Телефон:%20"+phone+";%20Спасибо!";
			break;
			/* оптом */
			case "modal-bulk":
				var name = $("#bulk_name"+val).val();
				var phone = $("#bulk_phone"+val).val();
				var flower_name = $("#bulk_n"+val).text();
				var flower_desc = $("#bulk_d"+val).text();
				var flower_price = $("#bulk_p"+val).text();
				
				window.location.href = "https://api.whatsapp.com/send?phone="+user_phone+"&text=Здравствуйте!%20Хочу%20заказать%20розу%20'"+flower_name+"'%20по%20оптовой%20цене.%20Стоимость:%20"+flower_price+";%20Описание:%20"+flower_desc+";%20Покупатель:%20"+name+",%20Телефон:%20"+phone+";%20Спасибо!";
			break;
			/* главная форма */
			case "general_modal":
				var name = $("#name").val();
				var phone = $("#phone").val();
				window.location.href = "https://api.whatsapp.com/send?phone="+user_phone+"&text=Здравствуйте!%20Хочу%20заказать%20розу%20в%20колбе.%20Покупатель:%20"+name+";%20Телефон:%20"+phone+";%20Спасибо!";
			break;
			/* стат клиентом */
			case "modal_stat":
				var name = $("#st_name").val();
				var phone = $("#st_phone").val();
				window.location.href = "https://api.whatsapp.com/send?phone="+user_phone+"&text=Здравствуйте!%20Хочу%20заказать%20розу%20в%20колбе.%20Покупатель:%20"+name+";%20Телефон:%20"+phone+";%20Спасибо!";
			break;
			
			case "vr_rose":
				var name = $("#vr_name").val();
				var phone = $("#vr_phone").val();
				window.location.href = "https://api.whatsapp.com/send?phone="+user_phone+"&text=Здравствуйте!%20Хочу%20заказать%20розу%20в%20колбе.%20Покупатель:%20"+name+";%20Телефон:%20"+phone+";%20Спасибо!";
			break;
			/* задат вопрос */
			case "fq":
				var name = $("#fq_name").val();
				var phone = $("#fq_phone").val();
				var email = $("#fq_email").val();
				var fq_txt = $("#fq_txt").val();
				window.location.href = "https://api.whatsapp.com/send?phone="+user_phone+"&text=Здравствуйте!%20Меня%20зовут%20"+fq_name+";%20Мой%20вопрос:%20"+fq_txt+";%20Телефон:%20"+fq_phone+";%20Email:%20"+fq_email+";%20Спасибо!";
			break;
		}
		
		
		$("#name").val('');
		$("#phone").val('');
		/*
		var form_data = new FormData(this);

		$("[data-label]").each(function () {
			var input_name = $(this).attr('name');
			var input_label__name = input_name + '_label';
			var input_label__value = $(this).data('label');
			form_data.append(input_label__name,input_label__value)
		});
		
		if (send === true) {
			$.ajax({
				type: "POST",
				async: true,
				url: "/send.php",
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				success: (function(result) {
					yaCounter44143219.reachGoal('GEN_LEAD');
					$.fancybox.close();
					//******** Thanks Window
					 $.fancybox.open({src: '#modal-thanks'});
					// setTimeout(function() {$.fancybox.close();},5000);
					
					form[0].reset();
					Cookies.set('was_order', '1');
					/******
					//window.location.href = "/thankyou?order_id=" + result ;
					******/
				/*	setTimeout(function() {window.location.href = "http://vermont-design.ru/uslovia?utm_source=roses&utm_medium=zayavka&utm_campaign=price_roses";},10000);
					
					
				})
			});
		}
		*/
		
	});
});
/***********************
 отправка формы в php END
***********************/


/***********************
 Автовсплывашка BEGIN
 ***********************/
// $(window).load(function () {
// 	setTimeout(function () {
// 		try {
// 			if ($('#modal-sale').length){
// 				$.fancybox.open({src  : '#modal-sale'});
// 			}
// 		} catch(err){}
// 	}, 40000)
// });
/***********************
 Автовсплывашка END
 ***********************/


/***********************
Input mask BEGIN
***********************/
jQuery(function($){
	$("input[type='tel']").mask("+7 (999) 999-99-99");
});
/***********************
Input mask END
***********************/


/***********************
fancybox BEGIN
***********************/
$(document).ready(function(){
	$('.fancy').fancybox({
		fullScreen: false,
		slideShow: false,
		thumbs: false,
		smallBtn: 'auto',
		focus: false
	});
	$('.fancy-map').fancybox({
		fullScreen: false,
		slideShow: false,
		thumbs: false,
		closeBtn   : false,
		smallBtn: true,
		focus: false
	});

	$('.fancy-video').fancybox({
		fullScreen: false,
		thumbs: false,
		focus: false,
		youtube: {
			controls : 1,
			showinfo : 0,
			autoplay: 1
		},
		onUpdate : function( instance, current ) {
			var width,
				height,
				ratio = 16 / 9,
				video = current.$content;
			if ( video ) {
				video.hide();
				width  = current.$slide.width() - 100;
				height = current.$slide.height() - 100;
				if ( height * ratio > width ) {
					height = width / ratio;
				} else {
					width = height * ratio;
				}
				video.css({
					width  : width,
					height : height
				}).show();
			}
		}
	});
});
/***********************
fancybox END
***********************/


/***********************
 Прокрутка к секциям BEGIN
***********************/
$(document).ready(function(){
	$('.scrollto').click(function () {
		var elementClick = $(this).attr("href");
		var destination = $(elementClick).offset().top;
		$('html').velocity( "scroll", { duration: 1000, easing: "easeInOutCubic", offset: destination, mobileHA: false });
		$('body').velocity( "scroll", { duration: 1000, easing: "easeInOutCubic", offset: destination, mobileHA: false });
		return false;
	});
});
/***********************
 Прокрутка к секциям END
***********************/


/***********************
 Counter BEGIN
 ***********************/
function counter_update() {
	var today = new Date();
	var date_from_admin = $('.counter-date').text();
	var sale_date;
	if (date_from_admin == ""){
		sale_date = new Date(today.getFullYear(), today.getMonth(), today.getDate()+1, 2, 36);
	} else {
		sale_date = Date.parse(date_from_admin) - 1000*60*60*3;
	}
	var timespan = countdown(today, sale_date, countdown.HOURS | countdown.MINUTES | countdown.SECONDS);

	$('.counter__hours').text(timespan.hours);
	$('.counter__minutes').text(timespan.minutes);
	$('.counter__seconds').text(timespan.seconds);
}

$(document).ready(function() {
	setInterval(function() {
		counter_update()
	}, 1000);
});
/***********************
 Counter END
 ***********************/



/***********************
Clients counter BEGIN
 ***********************/
$(document).ready(function() {
	var peoples_counter = $('.peoples__num');
	var counter_flag = false;
	var counter_to = parseInt(peoples_counter.data('peoples-num'));

	$(window).scroll(function () {
		if(peoples_counter.length){
			var sectionOffsetTop = peoples_counter.position().top,
				viewportOffsetTop = $(window).scrollTop(),
				viewportHeight = $(window).height();

			if ( (viewportOffsetTop > sectionOffsetTop - viewportHeight + 100) && !counter_flag){
				number_to(peoples_counter,0,counter_to,2000);
				counter_flag = true;
			}
		}
	});

	function number_to(element,from,to,duration){
		var start = new Date().getTime();
		setTimeout(function() {
			var now = (new Date().getTime()) - start;
			var progress = now / duration;
			var result = Math.floor((to - from) * progress + from);
			var text_to_show = progress < 1 ? result : to;
			element.text(text_to_show.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
			if (progress < 1) setTimeout(arguments.callee, 10);
		}, 10);
	}
});
/***********************
 Clients counter END
 ***********************/


/***********************
Serts BEGIN
***********************/
$(document).ready(function() {
	$('.sert-slider').flickity({
		imagesLoaded: true,
		pageDots: false,
		cellAlign: 'left',
		contain: true,
		arrowShape: {
			x0: 10,
			x1: 60, y1: 50,
			x2: 65, y2: 50,
			x3: 15
		},
		groupCells: true
	});
});
/***********************
Serts END
***********************/


/***********************
 faq BEGIN
 ***********************/
$(document).ready(function() {
	$('.faq-item__q').on('click',function () {
		var this_faq = $(this).parent('.faq-item');
		$('.faq-item').not(this_faq).removeClass('visible');
		$('.faq-item__a').not(this_faq.find('.faq-item__a')).slideUp(300);
		this_faq.toggleClass('visible');
		this_faq.find('.faq-item__a').slideToggle(300);
	})
});
/***********************
 faq END
 ***********************/


/***********************
Promo BEGIN
 ***********************/
$(document).ready(function() {
	$('.promo-stage').waypoint(function (direction) {
		$('.promo-stage').toggleClass('ready');
	}, {
		offset: '40%'
	});

	$(".promo--2").hover(
		function() {
			$('.promo-stage__flower').addClass('hid');
			$('.promo-stage__bottom').addClass('hid');
		}, function() {
			$('.promo-stage__flower').removeClass('hid');
			$('.promo-stage__bottom').removeClass('hid');
		}
	);
	$(".promo--3").hover(
		function() {
			$('.promo-stage__flower').addClass('hid');
			$('.promo-stage__glass').addClass('hid');
		}, function() {
			$('.promo-stage__flower').removeClass('hid');
			$('.promo-stage__glass').removeClass('hid');
		}
	);
	$(".promo--4").hover(
		function() {
			$('.promo-stage__bottom').addClass('hid');
			$('.promo-stage__glass').addClass('hid');
		}, function() {
			$('.promo-stage__bottom').removeClass('hid');
			$('.promo-stage__glass').removeClass('hid');
		}
	);
});
/***********************
 Promo END
 ***********************/


/***********************
 waypoints BEGIN
***********************/
$(document).ready(function() {
	$('.wp').waypoint(function (direction) {
		$(this.element).toggleClass('animated');
	}, {
		offset: 'bottom-in-view'
	});
});
/***********************
 waypoints END
***********************/


/***********************
Podbor BEGIN
***********************/
$(document).ready(function() {
	$('.step-link').on('click',function () {
		var index = $(this).index();
		choose_step(index);
	});

	function choose_step(index) {
		var current_step = $('.step-link').eq(index);
		$('.step-link').removeClass('active').removeClass('prev');
		current_step.addClass('active');
		current_step.nextAll('.step-link').removeClass('prev');
		current_step.prevAll('.step-link').addClass('prev');

		$('.step').removeClass('active').eq(index).addClass('active');

		$('.podbor').height($('.step.active').outerHeight());
		var destination = $('.podbor').offset().top;
		$('html').velocity( "scroll", { duration: 300, easing: "easeInOutCubic", offset: destination, mobileHA: false, delay: 600});
	}

	$(window).on('resize',function () {
		$('.podbor').height($('.step.active').outerHeight());
	});

	$('[name=flower]').on('change',function () {
		setTimeout(function () {
			choose_step(1);
		},300)
	});
	$('[name=colb]').on('change',function () {
		setTimeout(function () {
			choose_step(2);
		},300)
	})
});
/***********************
Podbor END
***********************/


/**************************************************
 UTM to forms
 ***************************************************/
$(document).ready(function(){

	if ('localStorage' in window) {
		if (urlParams('utm_source') != null ||
			urlParams('utm_medium') != null ||
			urlParams('utm_content') != null ||
			urlParams('utm_campaign') != null ||
			urlParams('utm_term') != null)
		{
			localStorage.setItem('utm_source', urlParams('utm_source'));
			localStorage.setItem('utm_medium', urlParams('utm_medium'));
			localStorage.setItem('utm_content', urlParams('utm_content'));
			localStorage.setItem('utm_term', urlParams('utm_term'));
			localStorage.setItem('utm_campaign', urlParams('utm_campaign'));
		}
	} else {
		console.error('No localStorage in window');
	}

	$('form').each(function() {
		var form = $(this),
			utm = [
				'source',
				'medium',
				'content',
				'term',
				'campaign'
			];

		for (var i = 0; i < utm.length; i++) {
			var name = utm[i];
			var input = $('<input/>');
			if ('localStorage' in window) {
				form.append(
					input
						.attr('type', 'hidden')
						.attr('name', 'utm_' + name)
						.attr('value', localStorage.getItem('utm_' + name))
				)
			} else {
				form.append(
					input
						.attr('type', 'hidden')
						.attr('name', 'utm_' + name)
						.attr('value', urlParams('utm_' + name))
				)
			}
		}
	});
});

function urlParams(utm_name) {
	var results = new RegExp('[\?&]' + utm_name + '=([^&#]*)').exec(window.location.href);
	if (results !== null) {
		return results[1] || 0;
	} else {
		return "";
	}
}
/**************************************************
 UTM to forms
 ***************************************************/
