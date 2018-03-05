!function(e,i){"use strict";"undefined"==typeof e.smg&&(e.smg={}),"undefined"==typeof e.smg.aem&&(e.smg.aem={}),"undefined"==typeof e.smg.aem.components&&(e.smg.aem.components={}),"undefined"==typeof e.smg.aem.components.flagshipPD&&(e.smg.aem.components.flagshipPD={}),"undefined"==typeof e.smg.aem.components.flagshipPD.product&&(e.smg.aem.components.flagshipPD.product={}),"undefined"==typeof e.smg.aem.components.flagshipPD.product.galaxyS9&&(e.smg.aem.components.flagshipPD.product.galaxyS9={});var t=e.smg.aem.varStatic,n=(e.smg.aem.util,e.smg.aem.customEvent),s=e.smg.aem.components.flagshipPD.product.galaxyS9.spinViewer;s=function(){var s=i("body"),a=i("html"),o=!1,r="pc",c=[],d=!1,l={init:function(e){this.setElements(e),this.resizeFunc(),this.setBindEvents()},windowHeight:function(){return window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight},setElements:function(e){this.wrap=e,this.zoomInBtn=this.wrap.find(".fp-spin-viewer__btn >.s-ico-zoom"),this.zoomOutBtn=this.wrap.find(".fp-spin-viewer__zoom >.fp-spin-viewer__zoom-btn >.s-ico-zoomout"),this.viewSizeType=o?"mo":"pc"},setBindEvents:function(){i(window).on("resize orientationchange",i.proxy(this.resizeFunc,this)),this.zoomInBtn.on("click",i.proxy(this.openZoomLayer,this)),this.zoomOutBtn.on("click",i.proxy(this.closeZoomLayer,this))},resizeFunc:function(){r!=this.viewSizeType&&(this.viewSizeType=r,this.initReset())},initReset:function(){this.zoomOutBtn.trigger("click")},closeZoomLayer:function(e){e.preventDefault();var t=i(e.currentTarget),n=t.closest(".fp-spin-viewer__zoom"),o=n.find(".fp-spin-viewer__zoom-figure-img");s.hasClass("s-fixed-layer-opened")&&s.removeClass("s-fixed-layer-opened"),a.hasClass("s-fixed-layer-opened")&&a.removeClass("s-fixed-layer-opened"),o.fadeOut(function(){n.removeClass("is-actived"),o.css({top:"0px",left:"0px"})})},openZoomLayer:function(t){t.preventDefault();var n,r,c,d,l,p,f,u,m=i(t.currentTarget),v=m.closest(".fp-spin-viewer"),g=v.find(".fp-spin-viewer__tab-contents.is-actived .images-cache:visible >img.is-view").attr("src"),h=v.find(".fp-spin-viewer__zoom"),_=h.find(".fp-spin-viewer__zoom-figure-img"),w=_.find("img"),y=v.outerHeight(!0);o&&!a.hasClass("s-fixed-layer-opened")&&a.addClass("s-fixed-layer-opened"),o&&!s.hasClass("s-fixed-layer-opened")&&s.addClass("s-fixed-layer-opened"),w.removeAttr("src").removeAttr("style").attr("src",g.replace("-low","")),h.addClass("is-actived"),w.promise().done(function(){_.hide().fadeIn(function(){_.on("mousedown touchstart",function(e){"mousedown"==e.type&&e.preventDefault();var t=i(e.currentTarget);n=e.pageX,r=e.pageY,c=t._css("translate3dX"),d=t._css("translate3dY"),"touchstart"==e.type&&(n=e.originalEvent.touches[0].pageX,r=e.originalEvent.touches[0].pageY),t.on("mousemove touchmove",function(e){"mousedown"==e.type&&e.preventDefault();var t=i(e.currentTarget),s=e.pageX,a=e.pageY;"touchmove"==e.type&&(s=e.originalEvent.touches[0].pageX,a=e.originalEvent.touches[0].pageY),l=c+s-n,p=d+a-r,f=s-n,u=a-r,t._css({translate3dX:l,translate3dY:p})})}).on("mouseup touchend",function(t){"mouseup"==t.type&&t.preventDefault();var n=parseInt("-"+(w.height()-y));o?n=parseInt(i(e).height()>w.height()?"-"+(i(e).height()-w.height()):"-"+(w.height()-i(e).height())):d>p?p-=50:p+=50,n>p&&(p=n),p>0&&(p=0),i(this)._css({translate3dX:0,translate3dY:p}),i(this).off("mousemove touchmove")})})})},destroy:function(t){i(e).off("resize orientationchange",i.proxy(this.resizeFunc,this)),this.zoomInBtn.off("click",i.proxy(this.openZoomLayer,this)),this.zoomOutBtn.off("click",i.proxy(this.closeZoomLayer,this))}},p=function(){var e=function(e,i){i.RESPONSIVE_NAME===t.RESPONSIVE.MOBILE.NAME?(o=!0,r="mo"):(o=!1,r="pc")},a=function(){s.on(n.RESPONSIVE.CHANGE,i.proxy(e,this)),s.trigger(n.RESPONSIVE.GET_STATUS)},c=function(){s.off(n.RESPONSIVE.CHANGE),s.off(n.RESPONSIVE.GET_STATUS)};return{run:a,reset:c}}(),f=function(e){e=e||!1;var t=i(".fp-spin-viewer .fp-spin-viewer__tab-list button");e?t.on("click",function(e){e.preventDefault();var t=i(e.currentTarget),n=t.closest(".fp-spin-viewer"),s=null,a=null,o=n.find(".fp-spin-viewer__cta >a"),r={},d="",l=t.parent().index();t.hasClass("is-actived")||(t.addClass("is-actived").parent().siblings().find("button").removeClass("is-actived"),n.find("div.fp-spin-viewer__tab-contents").removeClass("is-actived").eq(l).addClass("is-actived"),s=n.find("div.fp-spin-viewer__tab-contents.is-actived"),s.find("li.is-selected").length||s.find("ul.fp-spin-viewer__colorchip-list >li:eq(0)").addClass("is-selected"),a=s.find("ul.fp-spin-viewer__colorchip-list >li.is-selected >a"),d=a.data("has-cta"),n.find(".fp-spin-viewer__tab-contents").css("display","none").eq(l).css("display","block"),!o.length||"true"!=d&&1!=d?o.parent().css("display","none"):(r=a.data("cta"),r&&(o.text(r.text||"Shop now"),o.attr("href",r.url||"#"),o.attr("target",r.target||""),o.attr("data-omni",r.omni||""),o.attr("title",r.title||""),o.addClass(r.classname||"")),o.parent().css("display","inline-block")),a.trigger("click",!0),c[l]=!0)}):t.on("click",function(e){e.preventDefault()})},u=function(){return"url(//image.samsung.com/sg/smartphones/galaxy-note8/images/galaxy-note8_drag_cursor.png), auto"},m=function(e){e=e||!1;var t=i(".fp-spin-viewer").find("ul.fp-spin-viewer__colorchip-list >li >a");e?t.on("click",function(e,t){e.preventDefault();{var n=i(e.currentTarget),s=n.parent("li"),a=n.closest(".fp-spin-viewer"),o=n.closest(".fp-spin-viewer__tab-contents"),r=o.find(".fp-spin-viewer__figure-inner"),c=o.find(".images-cache:visible").find("img.is-view"),d=a.find(".fp-spin-viewer__cta >a"),l={},p=n.data("has-cta"),f=c.index(),m=s.index();a.find(".fp-spin-viewer__tab-contents.is-actived .images-cache:visible >img.is-view").attr("src")}(t||!s.hasClass("is-selected"))&&(r.find(".images-cache:eq("+m+")").css("display","block").siblings().css("display","none"),o.find(".images-cache:eq("+m+") >img:eq("+f+")").addClass("is-view").siblings().removeClass("is-view"),a.addClass("disabled").find(".s-ico-zoom").addClass("disabled"),s.addClass("is-selected").siblings().removeClass("is-selected"),v(d,p,l,n),r.spinViewer({container:a,frames:parseInt(n.attr("data-frame-count"),10),currentFrame:f,cursor:u(),imgLoaded:h,spinLoaded:_}))}):t.on("click",function(e){e.preventDefault()})},v=function(e,i,t,n){!e.length||"true"!=i&&1!=i?e.parent().css("display","none"):(t=n.data("cta"),t&&e.text(t.text||"Shop now").attr("href",t.url||"#").attr("target",t.target||"").attr("data-omni",t.omni||"").attr("title",t.title||"").addClass(t.classname||""),e.parent().css("display","inline-block"))},g=function(){var e=i(".fp-spin-viewer").find(".fp-spin-viewer__cta >a");e.on("click",function(e){e.preventDefault();var t,n,s=i(e.currentTarget),a=(s.closest(".fp-spin-viewer"),s.attr("target")),o=s.attr("href").split("?");if(2==o.length){o=s.attr("href").split("?"),t=o[0],n=o[1].split("=");var r=n[0],c=n[1],d=!1;"modelsetting_list_shop"==r?(i.cookieMode.set("nonshop_modelsetting_list",null,-1,"/"),d=!0):(i.cookieMode.set("modelsetting_list_shop",null,-1,"/"),d=!0),d&&i.cookieMode.set(r,c,1,"/")}else i.cookieMode.set("nonshop_modelsetting_list",null,-1,"/"),i.cookieMode.set("modelsetting_list_shop",null,-1,"/"),t=s.attr("href");"_blank"==a?window.open(t,"_blank"):location.href=t})},h=function(e){var i=e.closest(".fp-spin-viewer");i.addClass("is-loaded").find(".preload-image").fadeOut(),i.find(".s-ico-zoom").removeClass("disabled")},_=function(e){e.closest(".fp-spin-viewer").removeClass("disabled")},w=function(){var e=function(e){e.feature({on:function(e){var i=e.find("div.fp-spin-viewer__tab-contents.is-actived"),t=(i.find(".fp-spin-viewer__figure-inner"),i.find("ul.fp-spin-viewer__colorchip-list >li:eq(0) >a"));d||setTimeout(function(){m(!0),f(!0),t.trigger("click",!0),e.addClass("disabled"),d=!0},200)},off:function(e){if(d){e.find("div.fp-spin-viewer__tab-contents.is-actived")}}})};return{run:e}}(),y=function(){for(var e=0;e<i(".fp-spin-viewer").length;e++){var t=i(".fp-spin-viewer").eq(e),n=t.find(".fp-spin-viewer__tab-contents:eq(0)"),s=t.find(".fp-spin-viewer__cta >a"),a=n.find(".fp-spin-viewer__colorchip ul >li.is-selected >a"),o={},r=a.data("has-cta");n.addClass("is-actived").end().find(".images-cache:eq(0)").css("display","block").end().find(".images-cache:eq(0) >img:eq(0)").addClass("is-view"),v(s,r,o,a),t.find(".s-ico-zoom").addClass("disabled"),l.init(t)}},b=function(){var t=i(".fp-spin-viewer");t.length&&(p.run(),y(),g(),m(!1),f(!1),i(e).on("load",function(){for(var e=0;e<t.length;e++)!function(e,n){var s=t.eq(n);s.find(".images-cache >img").each(function(){var e=i(this),t=e.attr("data-cache-src");t&&e.attr("src",t)}),s.find(".images-cache").promise().done(function(){w.run(s)})}(this,e)}))};return{init:b}}(),i(function(){s.init()})}(window,window.jQuery);
!function(i,t){"use strict";"undefined"==typeof i.smg&&(i.smg={}),"undefined"==typeof i.smg.aem&&(i.smg.aem={}),"undefined"==typeof i.smg.aem.components&&(i.smg.aem.components={}),"undefined"==typeof i.smg.aem.components.flagshipPD&&(i.smg.aem.components.flagshipPD={}),"undefined"==typeof i.smg.aem.components.flagshipPD.product&&(i.smg.aem.components.flagshipPD.product={}),"undefined"==typeof i.smg.aem.components.flagshipPD.product.galaxyS9&&(i.smg.aem.components.flagshipPD.product.galaxyS9={});var e=i.smg.aem.components.flagshipPD.product.galaxyS9.highlightsKV,s=i.smg.aem.varStatic,o=(i.smg.aem.util,i.smg.aem.customEvent);e=function(){var e=t("body"),n=t("html,body"),a=t(".fp-highlights-kv"),l=!1,d=!1,r=function(){var i=function(i,t){l=t.RESPONSIVE_NAME===s.RESPONSIVE.MOBILE.NAME?!0:!1},n=function(){e.on(o.RESPONSIVE.CHANGE,t.proxy(i,this)),e.trigger(o.RESPONSIVE.GET_STATUS)},a=function(){e.off(o.RESPONSIVE.CHANGE),e.off(o.RESPONSIVE.GET_STATUS)};return{run:n,reset:a}}(),c=function(i){var t=i.closest(".fp-highlights-kv__contents-wrap"),e=i.find(".fp-highlights-kv__contents");e.hasClass("fp-highlights-kv--text-white")?t.addClass("fp-highlights-kv--text-white"):t.removeClass("fp-highlights-kv--text-white"),e.hasClass("s-text-shadow")?t.addClass("s-text-shadow"):t.removeClass("s-text-shadow")},h=function(){var i=function(i,e){!t.aemEditMode()&&e.hasClass("slick-initialized")&&(e.on("beforeChange",function(i,s,o,n){t(s.$slides);p.videoStop(e)}),e.on("afterChange",function(s,o,n){var a=t(o.$slides),l=a.eq(n),r=i.find(".fp-highlights-kv__control-item").filter(".play"),h=r.hasClass("is-actived");d||(h&&r.removeClass("is-actived").siblings().addClass("is-actived"),p.videoPlay(e)),c(l)}))},e=function(i,e){!t.aemEditMode()&&i.hasClass("slick-initialized")&&i.slick("slickGoTo",e)},s=function(i){!t.aemEditMode()&&i.hasClass("slick-initialized")&&i.slick("slickNext")},o=function(i){!t.aemEditMode()&&i.hasClass("slick-initialized")&&i.slick("slickPlay")},n=function(i){!t.aemEditMode()&&i.hasClass("slick-initialized")&&i.slick("slickPause")},a=function(t,e){i(t,e)};return{init:a,slickNextGo:s,slickPlay:o,slickPause:n,slickGo:e}}(),p=function(){var e=function(i){var t;return i.hasClass("slick-initialized")?(t=i.find(".slick-current video"),t.length?t[0]:!1):(t=i.find("video"),t.length?t[0]:!1)},s=function(s){var o=t(".fp-floating-nav").length?t(".fp-floating-nav").outerHeight(!0):0,n=t(".gnb").length?t(".gnb").outerHeight(!0):0,a=t(".cookie-notice").length?t(".cookie-notice").outerHeight(!0):0,l=e(s);l.readyState<4&&l.load(),t(i).scrollTop()>o+n+a+s.outerHeight(!0)?l&&4==l.readyState&&l.play():l&&l.play()},o=function(i){var t=e(i);t&&t.pause()},n=function(s){var o=t(".fp-floating-nav").length?t(".fp-floating-nav").outerHeight(!0):0,n=t(".gnb").length?t(".gnb").outerHeight(!0):0,a=t(".cookie-notice").length?t(".cookie-notice").outerHeight(!0):0,l=e(s);t(i).scrollTop()>o+n+a+s.outerHeight(!0)?l&&4==l.readyState&&(l.pause(),l.currentTime=0):l&&(l.pause(),l.currentTime=0)};return{videoPlay:s,videoPause:o,videoStop:n}}(),f=function(i){var e=i.find(".fp-highlights-kv__indicator-wrap"),s=e.find(".fp-highlights-kv__control-item"),o=e.find(".fp-highlights-kv__indicator-item"),n=o.find("button"),a=i.find(".js-fd-carousel"),l=o.length,r=function(i,e){i.preventDefault();var s=t(i.currentTarget),o=n.filter(".is-actived");s.hasClass("play")?(c(o),p.videoPlay(a),h.slickPlay(a),d=!1):(c(o,"stop"),p.videoPause(a),h.slickPause(a),d=!0),e?s.removeClass("is-actived").siblings("button").addClass("is-actived"):s.removeClass("is-actived").siblings("button").addClass("is-actived").focus()},c=function(i,s){s=s||"play";var o=i.find(".fp-highlights-kv__progress-value"),d=n.find(".fp-highlights-kv__progress-value"),r=d.next().width(),p=o.width(),f=t.aemEditMode()?5500:a.data("play-speed");"stop"==s?o.stop():(o.attr("style")&&(f-=parseInt(f/(parseInt(r,10)/parseInt(p,10)),10)),n.removeClass("is-actived"),i.addClass("is-actived"),o.animate({width:r},{duration:f,complete:function(t){var s,n=i.parent(".fp-highlights-kv__indicator-item"),d=n.index(),r=d+1;r==l&&(r=0),s=e.find(".fp-highlights-kv__indicator-item:eq("+r+") >button"),o.removeAttr("style"),c(s,"play"),a.hasClass("slick-initialized")&&h.slickNextGo(a)}}))},f=function(){s.filter(".pause").addClass("is-actived")},v=function(i){var o=t(i.currentTarget),n=e.find(".fp-highlights-kv__indicator-item >button.is-actived"),l=(s.filter(".play").hasClass("is-actived"),o.closest(".fp-highlights-kv__indicator-item").index());d=!1,c(n,"stop"),n.find(".fp-highlights-kv__progress-value").removeAttr("style"),h.slickGo(a,l),c(e.find(".fp-highlights-kv__indicator-item:eq("+l+") >button"),"play")},g=function(){s.on("click",r),n.on("click",v)},u=function(){f(),g(),c(e.find(".fp-highlights-kv__indicator-item:eq(0) >button"),"play")};u()},v={init:function(i){var t={component:".fp-highlights-kv",carousel:".js-fd-carousel",videocontainer:".s-video-container",layer:".fp-highlights-kv__video-layer",videoArea:".video-area_5",videoWrap:".s-video-wrap",videoFigure:".ma-g-c-video__figure",indicator:".fp-highlights-kv__indicator-wrap",indiControl:".fp-highlights-kv__control-item",playBtn:".js-video",YTplayBtn:".js-youtube-video",closeBtn:".js-pop-close",videoLoop:".js-loop-hidden",videoLayerType:"js-layer-type-video",bodyVideoOpen:"video-open",bodyVideoLyerOpen:"video-layer-open"};this.wrap=i,this.opts=t,this.setElements(),this.bindEvents()},setElements:function(){this.carousel=this.wrap.find(this.opts.carousel),this.playBtn=this.wrap.find(this.opts.playBtn),this.closeBtn=this.wrap.find(this.opts.closeBtn),this.YTplayBtn=this.wrap.find(this.opts.YTplayBtn),this.indicator=this.wrap.find(this.opts.indicator),this.indiControl=this.indicator.find(this.opts.indiControl)},bindEvents:function(){this.playBtn.on("click",t.proxy(this.onVideoPlay,this)),this.closeBtn.on("click",t.proxy(this.onCloseVideoLayer,this)),t(document).on("focusin",this.opts.videoLoop,t.proxy(this.onFocusLoopTempLink,this)),t(this.opts.videoArea).on("touchmove",function(i){e.hasClass(this.opts.bodyVideoOpen)&&(i.preventDefault(),i.stopPropagation())})},onVideoPlay:function(i){var e=t(i.currentTarget),s=e.closest(this.opts.component),o=s.find(this.opts.videocontainer);s.find(".fp-highlights-kv__control-item").filter(".pause.is-actived").trigger("click",!0),this.moveToVideoTop(s,o)},moveToVideoTop:function(i,t){var e=i.offset().top,s=i.find(this.opts.videoArea);l||n.stop().animate({scrollTop:e},300),i.find(this.opts.videoLoop).remove(),s.append('<a href="#" class="'+this.opts.videoLoop.substring(1)+'">&nbsp;</a>'),s.prepend('<a href="#" class="'+this.opts.videoLoop.substring(1)+'">&nbsp;</a>'),t.attr("tabIndex",0),setTimeout(function(){t.focus()},200)},onFocusLoopTempLink:function(i){i.preventDefault();var e=t(i.currentTarget),s=e.closest(this.opts.videoArea),o=s.find("."+e.attr("class")).index();if(0===o)s.find(this.opts.videocontainer).focus();else{if(3!==o)return;s.find(this.opts.videocontainer).focus()}},onCloseVideoLayer:function(i,e){i.preventDefault(),e=e||!1;var s,o=t(i.currentTarget),n=o.closest(this.opts.component),a=n.find(this.opts.carousel),l=n.find(this.opts.carousel+" .slick-current"),d=o.closest(this.opts.layer),r=d.find(this.opts.videoArea),c=r.find(this.opts.videocontainer),h=r.find(this.opts.videoLoop);c.find("video,iframe").length&&(s=a.hasClass("slick-initialized")?l.find(this.opts.playBtn):n.find(this.opts.playBtn),this.closeVideo(s,d,r,c,h,e),n.find(".fp-highlights-kv__control-item").filter(".play.is-actived").trigger("click",!0))},closeVideo:function(i,s,o,n,a,l){var d=t("#"+i.data("vid-data").divID),r=i.data("vid-type");d.length&&d.children().html("").remove(),"brightcove"==r&&o.unwrap(),a.remove(),n.removeAttr("tabIndex").removeAttr("data-vid-btn-idx"),e.hasClass(this.opts.bodyVideoOpen)&&e.removeClass(this.opts.bodyVideoOpen),e.hasClass(this.opts.bodyVideoLyerOpen)&&e.removeClass(this.opts.bodyVideoLyerOpen),s.find(this.opts.videoArea).css("display","none"),l||i.focus()}},g=function(i){var t;i.hasClass("slick-initialized")?(i.slick("slickPause").slick("slickSetOption","autoplaySpeed",parseInt(i.data("play-speed"))).slick("slickPlay"),t=i.find(".slick-current")):t=i.find(".fp-highlights-kv__contents:eq(0)"),c(t)},u=function(e){if((this.container=e).size()){var s,o,n,l;r.run();for(var d=0;d<a.length;d++){var e=a.eq(d),c=e.find(".js-fd-carousel");g(c),c.hasClass("slick-initialized")?(s=t(i).scrollTop(),o=t(i).height(),n=e.height(),l=e.offset().top,f(e),v.init(e),h.init(e,c),p.videoPlay(c)):e.feature({onVisible:function(a){s=t(i).scrollTop(),o=t(i).height(),n=e.outerHeight(!0),l=e.offset().top,f(e),v.init(e),h.init(e,c),p.videoPlay(c)},off:function(i){e.find(".js-pop-close").trigger("click",!0),p.videoStop(c),e.find(".fp-highlights-kv__progress-value").removeAttr("style")}})}}};return{init:u}}(),t(function(){e.init(t("body"))})}(window,window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /samsungp5/components/flagship-pd/product/galaxy-s9/fp-g-flagship-feature/clientlibs/devjs/fp-g-flagship-feature.js
 *
 * @version 1.0.0
 * @since 2017.12.21
 */
;(function (win, $) {
	'use strict';

	if('undefined' === typeof win.smg) {
		win.smg = {};
	}

	if('undefined' === typeof win.smg.aem) {
		win.smg.aem = {};
	}

	if('undefined' === typeof win.smg.aem.components) {
		win.smg.aem.components = {};
	}

	if('undefined' === typeof win.smg.aem.components.flagshipPD) {
		win.smg.aem.components.flagshipPD = {};
	}

	if('undefined' === typeof win.smg.aem.components.flagshipPD.product) {
		win.smg.aem.components.flagshipPD.product = {};
	}

	if('undefined' === typeof win.smg.aem.components.flagshipPD.product.galaxyS9) {
		win.smg.aem.components.flagshipPD.product.galaxyS9 = {};
	}

	// Static Values
	var V_STATIC = win.smg.aem.varStatic,
	// Utility Script
	UTIL = win.smg.aem.util,
	// Custom Events
	CST_EVENT = win.smg.aem.customEvent;

	var namespace = win.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	/**
	 * @name win.smg.aem.components.flagshipPD.product.galaxyS9.feature
	 * @namespace
	 * @requires jQuery
	 * @requires namespace.js
	 * @requires window.smg.static.js
	 * @requires window.smg.util.js
	 * @requires window.smg.event.js
	 */
	namespace = (function() {

		var $body = $('body');
		var isMobile = false;

		var reponsive = (function() {

			var onResponsiveChange = function(e, data) {
				if (data.RESPONSIVE_NAME === V_STATIC.RESPONSIVE.MOBILE.NAME) {
					isMobile = true;
				} else {
					isMobile = false;
				}
			}
			var run = function() {
				$body.on(CST_EVENT.RESPONSIVE.CHANGE, $.proxy(onResponsiveChange, this));
				$body.trigger(CST_EVENT.RESPONSIVE.GET_STATUS);
			}
			var reset = function() {
				$body.off(CST_EVENT.RESPONSIVE.CHANGE);
				$body.off(CST_EVENT.RESPONSIVE.GET_STATUS);
			}

			return {
				run : run,
				reset : reset
			}
		})();

		var animate = (function() {
			var run = function() {
				$('.fp-container').each(function(){
					$(this).feature({
						on : function($target) {
							$target.addClass('s-motion');
						},
						off : function($target) {
							$target.removeClass('s-motion');
						}
					});
				});
			}

			return {
				run : run
			}
		})();

		var init = function() {
			// responsive.run();
			animate.run();
		}

		return {
			init : init
		}

	})();


	$(function() {
		namespace.init();
	});
})(window, window.jQuery);

/*!
 * samsung.com - Flagship - Feature
 * src : /samsungp5/components/flagship-pd/product/galaxy-s9/fp-g-flagship-feature/clientlibs/devjs/fp-g-flagship-feature.js
 *
 * @version 1.0.0
 * @since 2017.12.21
 */
;(function (win, $) {
	'use strict';

	if('undefined' === typeof win.smg) {
		win.smg = {};
	}

	if('undefined' === typeof win.smg.aem) {
		win.smg.aem = {};
	}

	if('undefined' === typeof win.smg.aem.components) {
		win.smg.aem.components = {};
	}

	if('undefined' === typeof win.smg.aem.components.flagshipPD) {
		win.smg.aem.components.flagshipPD = {};
	}

	if('undefined' === typeof win.smg.aem.components.flagshipPD.product) {
		win.smg.aem.components.flagshipPD.product = {};
	}

	if('undefined' === typeof win.smg.aem.components.flagshipPD.product.galaxyS9) {
		win.smg.aem.components.flagshipPD.product.galaxyS9 = {};
	}

	// Static Values
	var V_STATIC = win.smg.aem.varStatic,
	// Utility Script
	UTIL = win.smg.aem.util,
	// Custom Events
	CST_EVENT = win.smg.aem.customEvent;

	var namespace = win.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	/**
	 * @name win.smg.aem.components.flagshipPD.product.galaxyS9.feature
	 * @namespace
	 * @requires jQuery
	 * @requires namespace.js
	 * @requires window.smg.static.js
	 * @requires window.smg.util.js
	 * @requires window.smg.event.js
	 */
	namespace = (function() {

		var $body = $('body');
		var isMobile = false;

		var reponsive = (function() {

			var onResponsiveChange = function(e, data) {
				if (data.RESPONSIVE_NAME === V_STATIC.RESPONSIVE.MOBILE.NAME) {
					isMobile = true;
				} else {
					isMobile = false;
				}
			}
			var run = function() {
				$body.on(CST_EVENT.RESPONSIVE.CHANGE, $.proxy(onResponsiveChange, this));
				$body.trigger(CST_EVENT.RESPONSIVE.GET_STATUS);
			}
			var reset = function() {
				$body.off(CST_EVENT.RESPONSIVE.CHANGE);
				$body.off(CST_EVENT.RESPONSIVE.GET_STATUS);
			}

			return {
				run : run,
				reset : reset
			}
		})();

		var animate = (function() {
			var run = function() {
				$('.fp-container').each(function(){
					$(this).feature({
						on : function($target) {
							$target.addClass('s-motion');
						},
						off : function($target) {
							$target.removeClass('s-motion');
						},
						onVisible : function($target) {
							$target.addClass('s-visible');
						},
						offVisible : function($target) {
							$target.removeClass('s-visible');
						}
					});
				});
			}

			return {
				run : run
			}
		})();

		var init = function() {
			// responsive.run();
			animate.run();
		}

		return {
			init : init
		}

	})();


	$(function() {
		namespace.init();
	});
})(window, window.jQuery);

/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-ar-cont/clientlibs/devjs/dev2.presets.ar-bixby.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
    'use strict';
    
    if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
        window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
    }

    var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;
    
    namespace.arBixby = (function () {
        
        return {
            init: function () {
                this.bindEvents();
            },
            bindEvents: function () {
                
                var $container = $('.fp-feature--ar-bixby'),
                    stepTimeout = [];
                
                $container.each(function () {
                    $(this).feature({
                        on: function ($target) {
                            $target.find('.bixby-bubble').addClass('show');
                            stepTimeout = $target.timelineMotion({
                                onMotions: [{
                                    target: '.text',
                                    addClass: 'show',
                                    runTime: 800
                                }]
                            });
                        },
                        off: function ($target) {
                            $target.find('.bixby-bubble').removeClass('show');
                            $target.timelineMotion({
                                offMotions: [{
                                    target: '.text',
                                    removeClass: 'show'
                                }],
                                timeout : stepTimeout
                            });
                        }
                    });
                });
                
            }
        }
    })();

    $(function () {
        namespace.arBixby.init();
    });
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-ar-cont/clientlibs/devjs/dev2.presets.ar-bixbyvision.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
    'use strict';

    if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
        window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
    }

    // Static Values
    var V_STATIC = win.smg.aem.varStatic,
        // Utility Script
        UTIL = win.smg.aem.util,
        // Custom Events
        CST_EVENT = win.smg.aem.customEvent;

    var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

    namespace.arBixbyVision = (function () {

        return {
            init: function () {
                this.setElements();
                this.bindEvents();
            },
            setElements: function () {
                this.body = $('body');
                this.isMobile = false;
                this.mode = '';
                this.container = $('.fp-feature--ar-bixby-vision');
                this.itemWrap = this.container.find('.s-ar-bixby-vision__item-wrap');
                this.items = this.container.find('.s-ar-bixby-vision__item');
                this.disclimer = this.container.find('.fp-feature__disclaimer');
            },
            bindEvents: function () {
                this.body.on(CST_EVENT.RESPONSIVE.CHANGE, $.proxy(this.onResponsiveChange, this));
                this.body.trigger(CST_EVENT.RESPONSIVE.GET_STATUS);
            },
            checkItemLength: function () {
                if (this.items.length % 3 == 0 && !this.isMobile) {
                    this.disclimer.css({
                        position: 'static',
                        width: '50%',
                        margin: '-70px auto 100px'
                    });
                } else {
                    this.disclimer.removeAttr('style');
                }

                if (this.isMobile) {
                    if(this.items.length == 1) {
                        this.itemWrap.addClass('item-number-1');
                    }
                    if(this.items.length == 2) {
                        this.itemWrap.addClass('item-number-2');
                    }
                    if(this.items.length == 3) {
                        this.itemWrap.addClass('item-number-3');
                    }
                    if(this.items.length == 4) {
                        this.itemWrap.addClass('item-number-4');
                    }
                    if(this.items.length == 5) {
                        this.itemWrap.addClass('item-number-5');
                    }
                } else {
                    this.itemWrap.removeClass('item-number-1 item-number-2 item-number-3 item-number-4 item-number-5');
                }
            },
            onResponsiveChange: function (e, data) {
                if (data.RESPONSIVE_NAME === V_STATIC.RESPONSIVE.MOBILE.NAME) {
                    this.isMobile = true;
                } else {
                    this.isMobile = false;
                }
                if(data.RESPONSIVE_NAME != this.mode) {
                    if(this.isMobile || (data.RESPONSIVE_NAME == V_STATIC.RESPONSIVE.TABLET.NAME && this.mode == V_STATIC.RESPONSIVE.MOBILE.NAME)) {
                        this.checkItemLength();
                    }
                }
                this.mode = data.RESPONSIVE_NAME;
            }
        }
    })();

    $(function () {
        namespace.arBixbyVision.init();
    });
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-ar-cont/clientlibs/devjs/dev2.presets.ar-emoji.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
	'use strict';
	
	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;
	
	namespace.arEmoji = (function () {
		
		return {
			init: function () {
				this.bindEvents();
			},
			bindEvents: function () {
				
				var $container = $('.fp-feature--ar-emoji'),
					$thisIconList = $container.find('.emoji-icon a'),
					$thisTabList = $container.find('.emoji-tab a'),
					$thisFigureList = $container.find('.emoji-box figure'),
					$emojiVideo =  $thisFigureList.find('video'),
					activeClass = 'is-actived';
					
				var videoToggle = function($current, idx){
					var active;
					var $video;

					if($thisFigureList.length) {
						$video = $thisFigureList.eq(1).find('video');
						if($video.length) {
							active = idx === 1 ? true : false;
							if(active) {
								$video.videoControls('play');
							} else {
								$video.videoControls('end');
							}
						}
					}
				}

				var changeTabView = function($current, activeIndex) {
					$thisFigureList.hide().eq(activeIndex).show();
					$thisIconList.hide().eq(activeIndex).show();
					$thisTabList.removeClass(activeClass).eq(activeIndex).addClass(activeClass);
					videoToggle($current, activeIndex);
				}
				$thisIconList.on('click', function (e) {
					e.preventDefault();
					var $current = $(e.currentTarget);
					var activeIndex = $current.index() ? 0 : 1;
					changeTabView($current, activeIndex);
				});

				$thisTabList.on('click', function (e) {
					e.preventDefault();
					var $current = $(e.currentTarget);
					var activeIndex = $current.index() ? 1 : 0;
					changeTabView($current, activeIndex);
				});

			}
		}
	})();


	$(function () {
		namespace.arEmoji.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-ar-cont/clientlibs/devjs/dev2.presets.ar-expressive.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
    'use strict';
    
    if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
        window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
    }

    var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;
    
    namespace.arExpressive = (function () {

        return {
            init: function () {
                this.bindEvents();
            },
            bindEvents: function () {
                
                var $container = $('.fp-feature--ar-expressive'),
                    stepTimeout = [],
                    changeTimeout = null,
                    changeItem,
                    number = 2;

                var changeJpg = function(elem){
                    var replaceImg = $(elem).attr('src').replace('.gif', '.jpg');
                    $(elem).attr('src', replaceImg);
                };
                var changeGif  = function($target){
                    var $t02 = $target.find('.message-text.text-num02 >img');
                    var $t04 = $target.find('.message-text.text-num04 >img');
                    var $t06 = $target.find('.message-text.text-num06 >img');
                    $t02.attr('src', $t02.attr('src').replace('.jpg', '.gif'));
                    $t04.attr('src', $t04.attr('src').replace('.jpg', '.gif'));
                    $t06.attr('src', $t06.attr('src').replace('.jpg', '.gif'));
                };
                
                $container.each(function () {
                    $(this).feature({
                        on: function ($target) {
                            stepTimeout = $target.timelineMotion({
                                onMotions: [{
                                        target: '.message',
                                        addClass: 'num01',
                                        runTime: 0
                                    },
                                    {
                                        target: '.message',
                                        addClass: 'num02',
                                        runTime: 300
                                    },
                                    {
                                        target: '.message',
                                        addClass: 'num03',
                                        runTime: 2000
                                    },
                                    {
                                        target: '.message',
                                        addClass: 'num04',
                                        runTime: 2500
                                    },
                                    {
                                        target: '.message',
                                        addClass: 'num05',
                                        runTime: 4000
                                    },
                                    {
                                        target: '.message',
                                        addClass: 'num06',
                                        runTime: 4300
                                    },
                                    {
                                        target: '.s-figure-sticker',
                                        addClass: 'up',
                                        runTime: 4300
                                    }
                                ]}
                            );
                            changeTimeout = setInterval(function() {
                                if(number > 6) {
                                    clearInterval(changeTimeout);
                                } else {
                                    changeJpg($target.find('.text-num0'+number).find('img'));
                                    number = number + 2;
                                }
                            }, 2000);
                        },
                        off: function ($target) {
                            $target.timelineMotion({
                                offMotions: [{
                                        target: '.message',
                                        removeClass: 'num01 num02 num03 num04 num05 num06',
                                        runTime: 0
                                    },
                                    {
                                        target: '.s-figure-sticker',
                                        removeClass: 'up',
                                        runTime: 0
                                    }
                                ],
                                timeout : stepTimeout
                            });
                            changeGif($target);
                            if(changeTimeout != null) clearInterval(changeTimeout);
                        }
                    });
                });

            }
        }
    })();

    $(function () {
        namespace.arExpressive.init();
    });
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-ar-cont/clientlibs/devjs/dev2.presets.ar-moviemoji.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
    'use strict';
    
    if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
        window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
    }

    var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;
    
    namespace.arMoviemoji = (function () {
        
        return {
            init: function () {
                this.bindEvents();
            },
            bindEvents: function () {
                
                var $container = $('.fp-feature--ar-moviemoji');

                $container.each(function () {
                    $(this).feature({
                        on: function ($target) {
                            $target.find('video').videoControls('play');
                            // $target.find('video').videoControls('play', $target.find('img.js-end-img'));
                        },
                        off: function ($target) {
                            $target.find('video').videoControls('end');
                            // $target.find('video').videoControls('end', $target.find('img.js-end-img'));
                        }
                    });
                });
                
            }
        }
    })();


    $(function () {
        namespace.arMoviemoji.init();
    });
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-ar-cont/clientlibs/devjs/dev2.presets.ar-personalized.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;
(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.arPersonalized = (function () {
		return {
			init: function () {
				this.setElements();
				this.bindEvents();
				this.setOnImg();
				setTimeout($.proxy(function () {
					for (var i = 0; i < this.$container.length; i++) {
						(function (_this, prop) {

							var $wrap = _this.$container.eq(prop);
							$wrap.find('.personalized-emoji >figure >img').each(function () {
								var img = $(this);
								var src = img.attr('data-cache-src');
								if (src) img.attr('src', src);
							});

						})(this, i);
					}
				}, this), 2000);
			},
			setElements: function () {
				this.$container = $('.fp-feature--ar-personalized');
				this.$thisTabList = this.$container.find('.tab-text');
				this.$styleLink = this.$container.find('.personalized-style a');
				this.styleHair = 0;
				this.styleAcc = 0;
				this.styleClothes = 0;
				this.activeClass = 'is-actived';
			},
			bindEvents: function () {
				this.$thisTabList.on('click', $.proxy(this.onTab, this));
				this.$styleLink.on('click', $.proxy(this.changeStyleImg, this));
			},
			setOnImg: function () {
				this.$container.find('.personalized-emoji figure:eq(0)').addClass('on');
			},
			onTab: function (e) {
				e.preventDefault();
				var $current = $(e.currentTarget),
					$container = $current.closest('.fp-feature--ar-personalized'),
					$parent = $container.find('.tab-text'),
					activeIndex = $current.index();

				$parent.removeClass(this.activeClass).eq(activeIndex).addClass(this.activeClass);
				$container.find('.style-list').removeClass(this.activeClass).eq(activeIndex).addClass(this.activeClass);
			},
			changeStyleImg: function (e) {
				e.preventDefault();
				var $current = $(e.currentTarget),
					$container = $current.closest('.fp-feature--ar-personalized');
				var parent = $current.parent().parent();

				if ($current.hasClass('on')) {
					$current.removeClass('on');
					if (parent.hasClass('style-hair')) {
						this.styleHair = 0;
					} else if (parent.hasClass('style-glasses')) {
						this.styleAcc = 0;
					} else {
						this.styleClothes = 0;
					}
				} else {
					$current.addClass('on').siblings().removeClass('on');
					if (parent.hasClass('style-hair')) {
						this.styleHair = $current.data('hair');
					} else if (parent.hasClass('style-glasses')) {
						this.styleAcc = $current.data('acc');
					} else {
						this.styleClothes = $current.data('clothes');
					}
				}
				this.emojiStyle($container);
			},
			emojiStyle: function ($container) {
				var $myEmoji = $container.find('.personalized-emoji figure');
				var styleNum = this.styleHair + '/' + this.styleAcc + '/' + this.styleClothes,
					styleArray = styleNum.split('/'),
					styleShow = styleArray[0] + styleArray[1] + styleArray[2];

				$myEmoji.each(function () {
					if ($(this).data('style') == styleShow) {
						$myEmoji.removeClass('on');
						$(this).addClass('on');
					}
				});
			}
		}
	})();

	$(function () {
		namespace.arPersonalized.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature - ar - step
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-ar-cont/clientlibs/devjs/dev2.presets.ar-step.js
 *
 * @version 1.0.0
 * @since 2018.02.12
 */
;
(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	// Static Values
	var V_STATIC = win.smg.aem.varStatic,
		// Utility Script
		UTIL = win.smg.aem.util,
		// Custom Events
		CST_EVENT = win.smg.aem.customEvent;

	namespace.arStep = (function () {

		var $body = $('body'),
			$containers = $('.fp-feature--ar-step');
		var isMobile = false;
		var isRun = false;
		var mode;

		var carouselManager = (function () {
			var intervalTime = null;
			var bindEvents = function ($container, $carousel) {
				if (!$.aemEditMode() && $carousel.hasClass('slick-initialized')) {
					$carousel.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
						if(isRun) return; 
						var $slides = $(slick.$slides),
							$currentSlide = $slides.eq(currentSlide),
							$nextSlide = $slides.eq(nextSlide),
							$progressBar =  $container.find('.fp-step-indicator__indicator-item:eq(' + nextSlide + ') button');

						if(intervalTime != null) clearInterval(intervalTime);

						$slides.find('img').eq(0).addClass('is-actived');
						$nextSlide.find('img:gt(0)').removeClass('is-actived');
						$slides.removeClass('s-ani-step1 s-ani-step2');
						changeContents($container, nextSlide);
						$progressBar.trigger('click');
					});
					$carousel.on('afterChange', function (e, slick, currentSlide) {
						if(isRun) return;
						var $slides = $(slick.$slides),
							$currentSlide = $slides.eq(currentSlide);
						var count = parseInt($currentSlide.attr('data-frame-count'), 10),
							number = 0;
						var speed = parseInt($currentSlide.closest('.js-fd-carousel').attr('data-play-speed'), 10);

						$slides.removeClass('s-ani-step1 s-ani-step2');
						if(currentSlide == 0 || currentSlide == 1) {
							$currentSlide.addClass('s-ani-step1');
							setTimeout(function() {
								$currentSlide.addClass('s-ani-step2');
							}, 1500);
						}

						if(count > 1) {
							intervalTime = setInterval(function() {
								$currentSlide.find('img').eq(number).addClass('is-actived').siblings().removeClass('is-actived');
								number++;
								if(count == number) {
									number = 0;
									clearInterval(intervalTime);
								}
							}, (speed / (count+4)));
						}
					});
					$carousel.find('.slick-slide').on('click', function() {
						if(isMobile) {
							$carousel.slick('slickSetOption', 'autoplaySpeed', parseInt($carousel.data('play-speed')));
							slickPlay($carousel);
						}
					});
				}
			}
			var changeContents = function ($container, slide) {
				var $contents = $container.find('.fp-feature__step-content >.step-text');
				$contents.removeClass('is-actived').eq(slide).addClass('is-actived');
			}
			var slickGo = function ($carousel, index) {
				if (!$.aemEditMode() && $carousel.hasClass('slick-initialized')) {
					$carousel.slick('slickGoTo', index);
				}
			}
			var slickNextGo = function ($carousel) {
				if (!$.aemEditMode() && $carousel.hasClass('slick-initialized')) {
					$carousel.slick('slickNext');
				}
			}
			var slickPlay = function ($carousel, delayTime) {
				if (!$.aemEditMode() && $carousel.hasClass('slick-initialized')) {
					// setTimeout(function () {
						$carousel.slick('slickPlay');
					// }, delayTime)
				}
			}
			var slickPause = function ($carousel) {
				if (!$.aemEditMode() && $carousel.hasClass('slick-initialized')) {
					$carousel.slick('slickPause');
				}
			}
			var init = function (container, carousel) {
				bindEvents(container, carousel);
			}
			return {
				init: init,
				slickNextGo: slickNextGo,
				slickPlay: slickPlay,
				slickPause: slickPause,
				slickGo: slickGo
			}
		})()
		var animationBar = function (container, startMotionTime) {
			var $indicator = container.find('.fp-step-indicator'),
				$indiControl = $indicator.find('.fp-step-indicator__control-item'),
				$indiBar = $indicator.find('.fp-step-indicator__indicator-item'),
				$progressBar = $indiBar.find('button'),
				$carousel = container.find('.js-fd-carousel'),
				$intro = container.find('.step-figure-intro'),
				$introText = container.find('.step-intro');
			var progressBarLength = $indiBar.length;

			var controlIndicator = function (e) {
				e.preventDefault();
				var $current = $(e.currentTarget),
					$currBar = $progressBar.filter('.is-actived');

				if ($current.hasClass('play')) {
					runAnimation($currBar);
					carouselManager.slickPlay($carousel);
				} else {
					runAnimation($currBar, 'stop');
					carouselManager.slickPause($carousel);
				}
				$current.removeClass('is-actived').siblings('button').addClass('is-actived').focus();

			}
			var runAnimation = function ($currBar, action) {
				action = action || 'play';
				var $container = $currBar.closest('.fp-feature--ar-step');
				var $carousel = $container.find('.js-fd-carousel');
				var $currVal = $currBar.find('.fp-step-indicator__progress-value'),
					$progressVal = $progressBar.find('.fp-step-indicator__progress-value');
				var progressWidth = $progressVal.next().width(),
					currWidth = $currVal.width(),
					animationTime = (!$.aemEditMode()) ? $carousel.data('play-speed') : 4000; //ms

				if (action == 'stop') { // animation stop
					$currVal.stop();
				} else { // animation play

					if ($currVal.attr('style')) {
						animationTime = animationTime - parseInt(animationTime / (parseInt(progressWidth, 10) / parseInt(currWidth, 10)), 10);
					}

					$progressBar.removeClass('is-actived');
					$currBar.addClass('is-actived');

					$currVal.stop().animate(
						{
							width: progressWidth
						}
						, 
						{
							duration: animationTime
						}
					);
				}
			}
			var setIndicator = function () {
				$indiControl.removeClass('is-actived').filter('.pause').addClass('is-actived');
			}
			var changeSlide = function (e) {
				e.stopPropagation();
				var $currentBar = $(e.currentTarget);
				var $activeBar = $indicator.find('.fp-step-indicator__indicator-item >button.is-actived');
				var isPlay = $indiControl.filter('.play').hasClass('is-actived');
				var index = $currentBar.closest('.fp-step-indicator__indicator-item').index();

				if ($intro.is(':visible')) {
					$intro.css('display', 'none').fadeOut();
					$introText.css('display', 'none').fadeOut();
				}
				runAnimation($activeBar, 'stop');
				$activeBar.find('.fp-step-indicator__progress-value').removeAttr('style');
				carouselManager.slickGo($carousel, index);
				if($indiControl.eq(1).hasClass('is-actived')) {
					carouselManager.slickPlay($carousel);
				}
				setIndicator();
				runAnimation($indicator.find('.fp-step-indicator__indicator-item:eq(' + index + ') >button'), 'play');
			}
			var bindEvents = function () {
				$indiControl.on('click', controlIndicator);
				$progressBar.on('click', changeSlide);
			}
			var init = function (startMotionTime) {
				setIndicator();
				bindEvents();
				runAnimation($indicator.find('.fp-step-indicator__indicator-item:eq(0) >button'), 'play');
			}
			init(startMotionTime);
		}
		var resetSlick = function ($carousel, run) {
			if ($carousel.hasClass('slick-initialized')) {
				isRun = run;
				carouselManager.slickGo($carousel, 0);
				$carousel.slick('slickSetOption', 'autoplaySpeed', parseInt($carousel.data('play-speed')));
				carouselManager.slickPause($carousel);
				$carousel.find('.slick-slide').removeClass('s-ani-step1 s-ani-step2');
			}
		}
		var resetProgressBar = function ($container) {
			var $progressBars = $container.find('.fp-step-indicator__indicator-item >button'),
				$progressBar;

			for(var i = 0; i < $progressBars.length; i++) {
				$progressBar = $progressBars.eq(i);
				$progressBar.find('.fp-step-indicator__progress-value').stop().removeAttr('style');
			}
		}
		var resetContents = function ($container) {
			$container.find('.fp-feature__step-content >.step-text').removeClass('is-actived');
			if (isMobile) {
				$container.find('.step-figure-list').css({
					visibility: 'hidden'
				});
			}
		}
		var resetIntro = function ($container) {
			$container.find('.step-figure-intro').fadeIn();
			$container.find('.step-intro').fadeIn();
		}
		var animationReset = function ($container, $carousel, run) {
			resetSlick($carousel, run);
			resetProgressBar($container);
			resetContents($container);
			resetIntro($container);
		}
		var setCarouselImg = function($carousel) {
			$carousel.find('.step-img').find('img:eq(0)').addClass('is-actived');
		}
		var reponsive = function () {
			var $body = $('body');
			var onResponsiveChange = function (e, data) {
				if (data.RESPONSIVE_NAME === V_STATIC.RESPONSIVE.MOBILE.NAME) {
					isMobile = true;
				} else {
					isMobile = false;
				}
				if(data.RESPONSIVE_NAME != mode) {
					if(isMobile || (data.RESPONSIVE_NAME == V_STATIC.RESPONSIVE.TABLET.NAME && mode == V_STATIC.RESPONSIVE.MOBILE.NAME)) {
						var $container;
						if ($containers.length) {
							for (var i = 0; i < $containers.length; i++) {
								var $container = $containers.eq(i),
									$carousel = $container.find('.js-fd-carousel');
								animationReset($container, $carousel, false);
							}
						}
					}
				}
				mode = data.RESPONSIVE_NAME;
			}
			var run = function () {
				$body.on(CST_EVENT.RESPONSIVE.CHANGE, $.proxy(onResponsiveChange, this));
				$body.trigger(CST_EVENT.RESPONSIVE.GET_STATUS);
			}
			run();
		}
		var timeout = null;
		var init = function () {
			reponsive();
			var $container;
			if ($containers.length) {
				for (var i = 0; i < $containers.length; i++) {
					var $container = $containers.eq(i),
						$carousel = $container.find('.js-fd-carousel'),
						$intro,
						$introText;
					var introPlayTime,
						startMotionTime;
					
					animationReset($container, $carousel, true);
					carouselManager.init($container, $carousel);
					$container.feature({
						onVisible: function ($target) {
							
							$carousel = $target.find('.js-fd-carousel'),
							$intro = $target.find('.step-figure-intro'),
							$introText = $target.find('.step-intro');

							introPlayTime = ($intro.length) ? parseInt($container.find('.fp-feature__figure').attr('data-intro-time'), 10) : 0,
							startMotionTime = Number(introPlayTime) + 350,
							isRun = false;
							
							setCarouselImg($carousel);
							timeout = setTimeout(function () {
								var $firstContent = $target.find('.fp-feature__step-content >.step-text').eq(0);
								var $firstSlide = $carousel.find('.slick-slide:not(.slick-cloned)').eq(0);
								$introText.fadeOut(introPlayTime, function(){
									if (isMobile) {
										$target.find('.step-figure-list').css({
											visibility: 'visible'
										});	
									}
									$firstContent.addClass('is-actived');
									$firstSlide.addClass('s-ani-step1');
									setTimeout(function() {
										$firstSlide.addClass('s-ani-step2');
									}, 1500);
									carouselManager.slickPlay($carousel, startMotionTime);
									animationBar($target, startMotionTime);
								});
								$intro.fadeOut(introPlayTime);

							}, introPlayTime);

						},
						off: function ($target) {
							$carousel = $target.find('.js-fd-carousel');
							clearTimeout(timeout);
							animationReset($target, $carousel, true);
						}
					});
				}
			}
		}

		return {
			init: init
		}
	})();

	$(function () {
		namespace.arStep.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-camera-cont/clientlibs/devjs/dev2.presets.camera-bixby.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.cameraBixby = (function () {
		var $container = $('.fp-feature--camera-bixby');
		var stepTimeout = [];
		return {
			init: function () {
				this.bindEvents();
			},
			bindEvents: function () {
				$container.feature({
					on: function (container) {
						stepTimeout = container.timelineMotion({
							onMotions: [{
									addClass: 'start-motion',
									runTime: 1000
								},
								{
									target: '.fp-feature--camera-bixby__text.text01',
									addClass: 'show-text',
									runTime: 1200
								},
								{
									target: '.fp-feature--camera-bixby__text.text02',
									addClass: 'show-text',
									runTime: 1400
								},
								{
									target: '.fp-feature--camera-bixby__text.text03',
									addClass: 'show-text',
									runTime: 1600
								},
								{
									target: '.fp-feature--camera-bixby__text.text04',
									addClass: 'show-text',
									runTime: 1700
								},
								{
									target: '.fp-feature--camera-bixby__text.text05',
									addClass: 'show-text',
									runTime: 1800
								},
								{
									addClass: 'step1-motion',
									runTime: 2800
								},
								{
									removeClass: 'start-motion',
									runTime: 3400
								}
							]
						});
					},
					off: function (container) {
						container.timelineMotion({
							offMotions: [{
									removeClass: 'start-motion step1-motion'
								},
								{
									target: '.fp-feature--camera-bixby__text.text01',
									removeClass: 'show-text'
								},
								{
									target: '.fp-feature--camera-bixby__text.text02',
									removeClass: 'show-text'
								},
								{
									target: '.fp-feature--camera-bixby__text.text03',
									removeClass: 'show-text'
								},
								{
									target: '.fp-feature--camera-bixby__text.text04',
									removeClass: 'show-text'
								},
								{
									target: '.fp-feature--camera-bixby__text.text05',
									removeClass: 'show-text'
								}
							],
							timeout: stepTimeout
						});
					}
				});
			}
		}
	})();

	$(function () {
		namespace.cameraBixby.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-camera-cont/clientlibs/devjs/dev2.presets.camera-dual.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.cameraDual = (function () {
		var $container = $('.fp-feature--camera-dual'),
			$tabList = $container.find('.fp-feature__tab-item'),
			$tabContent = $container.find('.fp-feature__item'),
			activeClass = 'is-actived'
		return {
			init: function () {
				this.bindEvents();
			},
			bindEvents: function () {
				$container.each(function () {
					var $thisTabList = $(this).find($tabList),
						$thisContentList = $(this).find($tabContent);
					$thisTabList.on('click', function (e) {
						e.preventDefault();
						var activeIndex = $(e.target).parent().index();
						$thisTabList.find('button').removeClass(activeClass).parent().eq(activeIndex).find('button').addClass(activeClass);
						$thisContentList.removeClass(activeClass).eq(activeIndex).addClass(activeClass);
					});
				});
			}
		}
	})();

	$(function () {
		namespace.cameraDual.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-camera-cont/clientlibs/devjs/dev2.presets.camera-liveart.js
 *
 * @version 1.0.0
 * @since 2018.02.13
 */
;(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	// Static Values
	var V_STATIC = win.smg.aem.varStatic,
	// Utility Script
	UTIL = win.smg.aem.util,
	// Custom Events
	CST_EVENT = win.smg.aem.customEvent;

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.cameraLivefocus = (function() {
		var $body = $('body'),
			$container = null,
			$inter = null,
			$img = null,
			$inner = null,
			$progressBar = null,
			$dragAnc = null,
			$fig1 = null,
			$fig2 = null,
			$tabs = null;
		var selector = {
			wrap : '.fp-feature--camera-liveart',
			interpace : '.fp-feature__drag-bar',
			progressBar : '.fp-feature__drag-progress',
			button : '.fp-feature__drag-button',
			blurVal : '.fp-feature__drag-blur-value',
			tabs : '.fp-feature__tab-item',
			img : '.img',
			dragable : '.dragable',
			inner : '.inner',
			focusImgWrap : 'figure.fp-flagship-live-focus__figure--before',
			backgroundImgWrap : '.fp-feature__blur-image'
		}
		var touch = false,
			moveY,
			plug = false,
			min = 0,
			isMobile = false,
			isRun = false,
			clickPlug = false;

		var mode;

		var reponsive = (function() {

			var onResponsiveChange = function(e, data) {
				if (data.RESPONSIVE_NAME === V_STATIC.RESPONSIVE.MOBILE.NAME) {
					isMobile = true;
				} else {
					isMobile = false;
				}
				if(data.RESPONSIVE_NAME != mode) {
					if(isMobile || (data.RESPONSIVE_NAME == V_STATIC.RESPONSIVE.TABLET.NAME && mode == V_STATIC.RESPONSIVE.MOBILE.NAME)) {
						setSlider();
					}
				}
				mode = data.RESPONSIVE_NAME;
			}
			var run = function() {
				$body.on(CST_EVENT.RESPONSIVE.CHANGE, $.proxy(onResponsiveChange, this));
				$body.trigger(CST_EVENT.RESPONSIVE.GET_STATUS);
			}
			var reset = function() {
				$body.off(CST_EVENT.RESPONSIVE.CHANGE);
				$body.off(CST_EVENT.RESPONSIVE.GET_STATUS);
			}

			return {
				run : run,
				reset : reset
			}
		})();
		var setSlider = function() {
			var $containers = $(selector.wrap);
			var $container;
			if($containers.length) {
				for(var i = 0; i < $containers.length; i++) {
					$container = $containers.eq(i);
					resetLivefocus($container);
				}
			}
		}
		var resetLivefocus = function($container) {
			var $backgroundImg = $container.find(selector.backgroundImgWrap);
			var $blurVal = $container.find(selector.blurVal);
			var $progressBar = $container.find(selector.progressBar);
			$backgroundImg.css('opacity', 0);
			$blurVal.text(0);
			$progressBar.css('width', '2.5%');
		}
		var bindTouchHandler = function(event) {
			var touch = event.changedTouches[0];

			var simulatedEvent = document.createEvent('MouseEvent');
				simulatedEvent.initMouseEvent({
				touchstart  : 'mousedown',
				touchmove   : 'mousemove',
				touchend    : 'mouseup'
			}[event.type], true, true, window, 1,
				touch.screenX, touch.screenY,
				touch.clientX, touch.clientY, false,
				false, false, false, 0, null);

			touch.target.dispatchEvent(simulatedEvent);
		}
		var dragMotion = function(progressBar, inter) {
			var per = parseInt(progressBar.width(), 10) / parseInt(inter.width(), 10) - 0.025;
			var $container = progressBar.closest(selector.wrap);
			var txt = '0';

			if(per > 0.99) {
				per = 1;
			} else if(per < 0.04) {
				per = 0;
			}
			if(per > 0 && per < 0.14) txt = '0';
			if(per >= 0.14 && per < 0.28) txt = '1';
			if(per >= 0.28 && per < 0.42) txt = '2';
			if(per >= 0.42 && per < 0.56) txt = '3';
			if(per >= 0.56 && per < 0.70) txt = '4';
			if(per >= 0.70 && per < 0.84) txt = '5';
			if(per >= 0.84 && per < 0.98) txt = '6';
			if(per >= 0.98) txt = '7';

			$container.find(selector.blurVal).text(txt);
			$fig1.css('opacity', 1);
			$fig2.css('opacity', per);
		}
		var sliderClickEvent = function($target) {
			$target.on('click', $.proxy(function(e) {
				e.preventDefault();
				return false;
			}));
		}
		var sliderMouseMoveEvent = function(event, $target) {
			var $draggable = $target.filter(selector.dragable),
				$progressBar = $target,
				$inter = $target.closest(selector.interpace),
				$inner = $inter.find(selector.inner);
			var interPos = 0,
				max = 0,
				move = 0;
			if($draggable.length > 0 && touch) {

				moveY = parseInt(event.pageX, 10),
				interPos = parseInt($inter.offset().left, 10),
				max = $inter.outerWidth() +  parseInt(($inter.find(selector.button).width() / 2), 10);
				move = (moveY - interPos);
				if(move >= max) {
					return;
				}
				if(move < parseInt(($inter.find(selector.button).width() / 2))) {
					return;
				}
				$progressBar.css('width', moveY - interPos);
				dragMotion($progressBar, $inter);
			} else {
				return;
			}
		}
		var sliderMouseUpEvent = function($target) {
			var $inter = $target.closest(selector.interpace);
			touch = false;
			min = Math.max(0, moveY);
			min = Math.min($inter.width(), moveY);
			$target.removeClass(selector.dragable.substring(1));
		}
		var sliderKeyDownEvent = function(event, $target) {
			var $inter = $target.closest(selector.interpace),
				$progressBar = $inter.find(selector.progressBar);
			var boxSize = 0,
				interPos = 0,
				interSize = 0,
				buttonHalf = 0,
				changeSize = 0;

			interPos = parseInt($inter.offset().left, 10);
			buttonHalf = parseInt(($inter.find(selector.button).width() / 2), 10);
			interSize = $inter.outerWidth() +  buttonHalf;
			boxSize = $progressBar.outerWidth();
			if (event.keyCode == 37) {
				if(boxSize > buttonHalf) {
					changeSize = boxSize - 20;
					if(changeSize < buttonHalf) {
						changeSize = buttonHalf;
					}
					$progressBar.width(changeSize);
				}
			} else if (event.keyCode == 39) {
				if(boxSize <= interSize) {
					changeSize = boxSize + 20;
					if(changeSize > interSize) {
						changeSize = interSize;
					}
					$progressBar.width(changeSize);
				}
			}

			dragMotion($progressBar, $inter);
		}
		var sliderDragEvent = function(type) {
			var $progressBar = $(selector.progressBar);
			if(type == 'run') {
				$progressBar.on('mousedown', function (e) {
					e.preventDefault();
					var $current = $(e.currentTarget);

					$current.addClass(selector.dragable.substring(1));
					touch = true;

					sliderClickEvent($current.find('a, button'));

					$(document).on('mousemove', function (e) {
						e.preventDefault();
						sliderMouseMoveEvent(e, $current);
					}).on('mouseup', function (e) {
						e.preventDefault();
						sliderMouseUpEvent($current);
					});
				});
			} else {
				$progressBar.off('mousedown');
				$(document).off('mousemove mouseup');
			}
		}
		var sliderKeyEvent = function(type) {
			var $inter = $('.fp-feature__drag-bar');
			if(type == 'run') {
				$dragAnc.on('keydown keyup', function(e) {
					e.preventDefault();
					var $current = $(e.currentTarget);
					if(e.type == "keydown") {
						sliderKeyDownEvent(e, $current);
					}
				});
			} else {
				$dragAnc.off('keydown keyup');
			}
		}
		var focusMotion = function(type) {
				sliderDragEvent(type);
				// sliderKeyEvent(type);
			if(type == 'run') {
				document.addEventListener('touchstart',     bindTouchHandler, true);
				document.addEventListener('touchmove',      bindTouchHandler, true);
				document.addEventListener('touchend',       bindTouchHandler, true);
				document.addEventListener('touchcancel',    bindTouchHandler, true);
			}
		}

		var autoMotion = function(obj, fullPer, zeroPer) {
			if(!obj.length) return;
			
			$inter = obj;
			$progressBar = $inter.find(selector.progressBar);
			var boxSize = $progressBar.outerWidth();
			var buttonHalf = parseInt(($inter.find(selector.button).width() / 2), 10);
			var fullPer = $inter.outerWidth() +  buttonHalf;
			var zeroPer = buttonHalf;

			$progressBar.stop().animate({width : fullPer},{
				duration : 800,
				complete : function() {
					$progressBar.stop().animate({width : zeroPer},{
						duration : 1300, 
						step : function() {
							dragMotion($progressBar, $inter);
						}
					});
				},
				step : function(e, ui) {
					dragMotion($progressBar, $inter);
				}
			});

		}
		var bindEvents = function() {
			$(win).on('resize orientationchange', changeProgressBarWidth);
		}
		var changeProgressBarWidth = function() {
			var $container = $(selector.wrap);
			var $inter = $container.find(selector.interpace);
			var $backgroundImg = $container.find(selector.backgroundImgWrap);
			var $progressBar = $inter.find(selector.progressBar);
			var width = $inter.outerWidth();
			var per = Math.round($backgroundImg.css('opacity') * 1000) / 1000;
			$progressBar.css('width', parseInt(width * per, 10));
		}
		var init = function() {
			setFeature();
			bindEvents();
			reponsive.run();
		}
		var setFeature = function() {
			var $wrap;
			for(var i = 0; i < $(selector.wrap).length; i++) {
				$wrap = $(selector.wrap).eq(i);
				$container = $wrap,
				$inter = $container.find(selector.interpace),
				$progressBar = $inter.find(selector.progressBar),
				$dragAnc = $inter.find('button'),
				$fig1 = $container.find(selector.focusImgWrap),
				$fig2 = $container.find(selector.backgroundImgWrap),
				$tabs = $container.find(selector.tabs);
				focusMotion('run');
				$wrap.feature({
					on : function(container) {
						if(!isRun) {
							$inter.find(selector.progressBar).css('width', '2.5%');
							isRun = true;
						}
						if($tabs.eq(0).hasClass('is-actived')) {
							autoMotion($inter);
						}
					},
					off : function(container) {
					}
				});
			}
		}
		var reset = function() {
			focusMotion('reset');
		}
		return {
			init : init,
			reset : reset
		}
	})();
	namespace.cameraBokehfilters = (function() {
		var $body = $('body');
		var selector = {
			wrap : '.fp-feature--camera-liveart',
			imgCarousel : '.js-carousel-liveart',
			filterCarousel : '.fp-feature__filter-slider',
			contents : '.fp-feature__item',
			images : '.fp-feature__item-image',
			tabs : '.fp-feature__tab-item'
		}
		var imgSlickOpts = {
			rtl : $('html').hasClass('rtl') ? true : false,
			dots : true,
			infinite : true,
			arrows : false,
			touchThreshold : 20,
			edgeFriction : 1,
			focusOnSelect : true
		}
		var isMobile = false;
		var mode;

		var reponsive = (function() {

			var onResponsiveChange = function(e, data) {
				if (data.RESPONSIVE_NAME === V_STATIC.RESPONSIVE.MOBILE.NAME) {
					isMobile = true;
				} else {
					isMobile = false;
				}
				if(data.RESPONSIVE_NAME != mode) {
					if(isMobile || (data.RESPONSIVE_NAME == V_STATIC.RESPONSIVE.TABLET.NAME && mode == V_STATIC.RESPONSIVE.MOBILE.NAME)) {
						setSlick();
					}
				}
				mode = data.RESPONSIVE_NAME;
			}
			var run = function() {
				$body.on(CST_EVENT.RESPONSIVE.CHANGE, $.proxy(onResponsiveChange, this));
				$body.trigger(CST_EVENT.RESPONSIVE.GET_STATUS);
			}
			var reset = function() {
				$body.off(CST_EVENT.RESPONSIVE.CHANGE);
				$body.off(CST_EVENT.RESPONSIVE.GET_STATUS);
			}

			return {
				run : run,
				reset : reset
			}
		})();
		var bindEvents = function() {
			$(selector.wrap).find(selector.tabs).find('button, a').on('click', onTabs);
			for(var i = 0; i < $(selector.wrap).find(selector.filterCarousel).length; i++) {
				var $carousel = $(selector.wrap).find(selector.filterCarousel).eq(i);
				setFilterSlick($carousel);
				$carousel.on('afterChange', onSlickAfterChange);
				$carousel.find('.fp-feature__filter-button').attr('tabindex', '-1');
			}
		}
		var setSlick = function() {
			var $imgCarousels = $(selector.wrap).find(selector.imgCarousel),
				$filterCarousels = $(selector.wrap).find(selector.filterCarousel);
			var $imgCarousel, $filterCarousel;

			if($imgCarousels.length) {
				for(var i = 0; i < $imgCarousels.length; i++) {
					$imgCarousel = $imgCarousels.eq(i);
					if(isMobile) {
						if(!$imgCarousel.hasClass('slick-initialized')) {
							$imgCarousel.on('init', function(e, slick) {
								var $dots = $(slick.$dots).find('li'),
									$dot;
								var indicatorNum = 0;
								for(var i = 0; i < $dots.length; i++) {
									$dot = $dots.eq(i).find('button');
									indicatorNum = (i + 1);
									$dot.attr('data-omni-type', 'microsite_contentinter');
									$dot.attr('data-omni', 'galaxy-s9:camera:Live focus with bokeh filters:' + indicatorNum);
									$dot.attr('ga-ca', 'flagship pdp');
									$dot.attr('ga-ac', 'feature');
									$dot.attr('ga-la', 'galaxy-s9:camera:Live focus with bokeh filters:' + indicatorNum);
								}
							});
							$imgCarousel.slick(imgSlickOpts);
						}
					} else {
						if($imgCarousel.hasClass('slick-initialized')) {
							$imgCarousel.slick('unslick');
							$imgCarousel.find(selector.images).removeClass('is-actived').eq(0).addClass('is-actived');
						}
					}
				}
			}
			if($filterCarousels.length) {
				for(var i = 0; i < $filterCarousels.length; i++) {
					$filterCarousel = $filterCarousels.eq(i);
					if(!isMobile) {
						if($filterCarousel.hasClass('slick-initialized')) {
							$filterCarousel.slick('slickGoTo', 0, true).slick('setPosition');
						}
					}
				}
			}
		}
		var setFilterSlick = function($carousel) {
			var $slides = $carousel.find('.slick-slide.slick-active');
			var $images = $carousel.closest(selector.wrap).find(selector.images);

			$images.removeClass('is-actived').eq(0).addClass('is-actived');
			setTimeout(function() {
				$slides.removeClass('opacity3').removeClass('opacity5');
				$slides.eq(0).addClass('opacity3');
				$slides.eq(1).addClass('opacity5');
				$slides.eq(7).addClass('opacity5');
				$slides.eq(8).addClass('opacity3');
			}, 100);

		}
		var onSlickAfterChange = function(e, slick, currentSlide) {
			var $slides = $(slick.$slides);
			var $currSlide = $(slick.$slides).eq(currentSlide);
			var $container = $currSlide.closest(selector.wrap);
			var slideIndex = $currSlide.data('slick-index');
			var $images = $currSlide.closest(selector.wrap).find(selector.images);
			
			$images.removeClass('is-actived').eq(currentSlide).addClass('is-actived');

			setTimeout(function() {
				$slides.removeClass('opacity3').removeClass('opacity5');
				$container.find('[aria-hidden=false]').eq(0).addClass('opacity3');
				$container.find('[aria-hidden=false]').eq(1).addClass('opacity5');
				$container.find('[aria-hidden=false]').eq(7).addClass('opacity5');
				$container.find('[aria-hidden=false]').eq(8).addClass('opacity3');
			}, 100);
		}
		var onTabs = function(e) {
			e.preventDefault();
			var $current = $(e.currentTarget);
			var $container = $current.closest(selector.wrap);
			var $imgCarousel = $container.find(selector.imgCarousel);
			var currentIndex = $current.parent().index();

			if($current.hasClass('is-actived')) return;

			$container.find(selector.tabs).removeClass('is-actived').eq(currentIndex).addClass('is-actived');
			$container.find(selector.contents).removeClass('is-actived').eq(currentIndex).addClass('is-actived');
			if(currentIndex == 1 && isMobile) {
				if($imgCarousel.hasClass('slick-initialized')) {
					$imgCarousel.slick('setPosition');
				}
			}
			if(currentIndex == 1) {
				$container.find('.fp-feature__drag-button').attr('tabindex', '-1');
				$container.find('.slick-active .fp-feature__filter-button').attr('tabindex', '0');
			} else {
				$container.find('.fp-feature__drag-button').removeAttr('tabindex');
				$container.find('.fp-feature__filter-button').attr('tabindex', '-1');
			}
		}
		var init = function() {
			reponsive.run();
			setSlick();
			bindEvents();
		}
		return {
			init : init
		}
	})();
	$(function() {
		namespace.cameraLivefocus.init();
		namespace.cameraBokehfilters.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-camera-cont/clientlibs/devjs/dev2.presets.camera-lockscreen.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.cameraLockscreen = (function () {
		var $container = $('.fp-feature--camera-lockscreen');
		return {
			init: function () {
				this.bindEvents();
			},
			bindEvents: function () {
				$container.each(function () {
					$(this).feature({
						on : function($target) {
							$target.find('video').videoControls('play');
						},
						off : function($target) {
							$target.find('video').videoControls('end');
						}
					});
				});
			}
		}
	})();

	$(function () {
		namespace.cameraLockscreen.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-camera-cont/clientlibs/devjs/dev2.presets.camera-noise.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.cameraNoise = (function () {
		var $container = $('.fp-feature--camera-noise');
		var stepTimeout = [];
		return {
			init: function () {
				this.bindEvents();
			},
			bindEvents: function () {
				$container.feature({
					on: function (container) {
						stepTimeout = container.timelineMotion({
							onMotions: [
								{
									addClass: 'end-motion',
									runTime: 2000
								}
							]
						});
					},
					off: function (container) {
						container.timelineMotion({
							offMotions: [{
								removeClass: 'end-motion'
							}],
							timeout : stepTimeout
						});
					}
				});
			}
		}
	})();

	$(function () {
		namespace.cameraNoise.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-camera-cont/clientlibs/devjs/dev2.presets.camera-superslow.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	// Static Values
	var V_STATIC = win.smg.aem.varStatic,
	// Utility Script
	UTIL = win.smg.aem.util,
	// Custom Events
	CST_EVENT = win.smg.aem.customEvent;

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.cameraSuperslow = (function () {
		return {
			init: function () {
				this.setElements();
				this.bindEvents();
			},
			setElements: function () {
				this.$body = $('body');
				this.$playButton = $('.fp-feature--camera-superslow .s-cta-playvideo');
				this.$videoWrap = $('.fp-feature--camera-superslow .fp-feature__figure');
				this.responsiveType;
				this.run = false;
				this.isMobile = false;
			},
			bindEvents: function () {
				this.$body.on(CST_EVENT.RESPONSIVE.CHANGE, $.proxy(this.onResponsiveChange, this));
				this.$body.trigger(CST_EVENT.RESPONSIVE.GET_STATUS);
				this.$playButton.on('click', $.proxy(this.onClickPlayBtn, this));
			},
			onClickPlayBtn: function (e) {
				var $current = $(e.currentTarget),
					$btnTxt = $current.find('span'),
					$container = $current.closest('.fp-feature--camera-superslow'),
					$videoWrap = $container.find('.fp-feature__figure'),
					$video = $container.find('video');

				if(($current.hasClass('playing') && !$current.hasClass('pause')) || ($current.hasClass('playing') && $current.hasClass('playgo'))) {
					$current.removeClass('playgo').addClass('pause');
					$btnTxt.text('Play Video');
					$video.videoControls('pause');
					// $video.pause();
				} else if($current.hasClass('pause')) {
					$current.removeClass('pause').addClass('playgo');
					$btnTxt.text('Pause Video');
					$video.videoControls('play');
					// $video.play();
				} else {
					$videoWrap.addClass('s-video-play');
					$current.addClass('playing');
					$btnTxt.text('Pause Video');
					$video.videoControls('play');
					// $video.play();
				}
				if($video[0].readyState < 4 && this.$body.hasClass('touch-device')) {
					$video.parent().find('img').css('opacity', 1);
					$videoWrap.addClass('s-none-video');
					$video.css('display', 'none');
				}
				if (!this.run && $video.length && !this.$body.hasClass('touch-device')) {
					$video.on('ended', function (e) {
						$videoWrap.removeClass('s-video-play');
						$btnTxt.text('Play Video');
						$current.removeClass('pause playgo playing');
					});
					this.run = true;
				}
			},
			onResponsiveChange: function (e, data) {
				if (data.RESPONSIVE_NAME === V_STATIC.RESPONSIVE.MOBILE.NAME) {
					this.isMobile = true;
					var viewSizeType = 'mo';
				} else {
					this.isMobile = false;
					var viewSizeType = 'pc';
				}
				if(this.responsiveType != viewSizeType) {
					this.$playButton.removeClass('pause playgo playing');
					this.$videoWrap.removeClass('s-video-play');
				}
				this.responsiveType = viewSizeType;
			}
		}
	})();

	$(function () {
		namespace.cameraSuperslow.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-camera-cont/clientlibs/devjs/dev2.presets.camera-threeways.js
 *
 * @version 1.0.0
 * @since 2018.02.09
 */
;(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	// Static Values
	var V_STATIC = win.smg.aem.varStatic,
	// Utility Script
	UTIL = win.smg.aem.util,
	// Custom Events
	CST_EVENT = win.smg.aem.customEvent;

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.threeways = (function () {
		return {
			init: function () {
				this.setElements();
				if(this.$container.length) {
					this.bindEvents();

					$(win).on('load', $.proxy(function() {
						for(var i = 0; i < this.$container.length; i++) {
							(function(_this, prop) {

								var $wrap = _this.$container.eq(prop);
								$wrap.find('.threeways-cache >img').each(function() {
									var img = $(this);
									var src = img.attr('data-cache-src');
									if(src) img.attr('src', src);
								});
								$wrap.find('.threeways-cache').promise().done($.proxy(function() {
									this.runFeature($wrap);
								}, _this));
							
							})(this, i)
						}
					}, this));
				}
			},
			setElements: function () {
				this.$body = $('body');
				this.$container = $('.fp-feature--camera-threeways');
				this.$loopImgs = this.$container.find('.fp-feature__item .flagship-pd__image img');
				this.$tabItems = this.$container.find('.fp-feature__tab-item button');
				this.isMobile = false;
				this.timeout1 = null;
				this.timeout2 = null;
				this.timeout3 = null;
				this.count1 = 0;
				this.count2 = 0;
				this.count3 = 0;
				this.isRun = false;
			},
			bindEvents: function () {
				this.$body.on(CST_EVENT.RESPONSIVE.CHANGE, $.proxy(this.onResponsiveChange, this));
				this.$body.trigger(CST_EVENT.RESPONSIVE.GET_STATUS);
				this.$tabItems.on('click', $.proxy(this.onTabsAction, this));
				this.$loopImgs.on('mouseover', $.proxy(this.onLoopImgs, this));
			},
			runFeature: function($currContainer) {
				var $currContainer;
				var _this = this;
				
				$currContainer.feature({
					
					onVisible : function($target) {

						_this.allCrearInterval($target.find('.fp-feature__item img'));

						if(!_this.isRun) {

							if(!_this.isMobile) {
								$target.find('.fp-feature__item:eq(0) img').trigger('mouseover', true);
							} else {
								$target.find('.fp-feature__tab-item button.is-actived').trigger('click');
							}
						}
						_this.isRun = true;
					}
					,
					off : function($target) {
						_this.allCrearInterval($target.find('.fp-feature__item img'));
						_this.isRun = false;
					}
				});
			},
			onTabsAction: function (e) {
				e.preventDefault();
				var $current = $(e.currentTarget);
				var currIndex = $current.parent('.fp-feature__tab-item').index();
				var $currContainer = $current.closest('.fp-feature--camera-threeways');
				var $tabs = $currContainer.find('.fp-feature__tab-item button');
				var $imgWrap = $currContainer.find('.fp-feature__item');
				var $img = $imgWrap.eq(currIndex).find('.flagship-pd__image img');
				var src = $img.attr('src');
				var srcArr = src.split('/');
				var imgName = srcArr[srcArr.length - 1];
				var imgArr = imgName.split('.');
				var count;

				$tabs.removeClass('is-actived').eq(currIndex).addClass('is-actived');
				$imgWrap.removeClass('is-actived').eq(currIndex).addClass('is-actived');
				$img.attr('src', src.replace(imgArr[0].substr(-2, 2), '00'));

				$img.trigger('mouseover', 'tab');
			},
			onLoopImgs: function (e, isTrigger) {
				e.preventDefault();
				isTrigger = isTrigger || false;
				var $current = $(e.currentTarget);
				var $currContainer = $current.closest('.fp-feature--camera-threeways');
				var $imgs = $currContainer.find('.fp-feature__item .flagship-pd__image img');

				if(!isTrigger || isTrigger == 'tab') {
					this.allCrearInterval($imgs);
				}

				this.changeSrc($current, $imgs, isTrigger);

				if(isTrigger != 'tab') {
					$current.on('mouseout', $.proxy(function(e) {
						this.allCrearInterval($imgs);
					}, this));
				}

			},
			allCrearInterval: function ($imgs) {
				clearInterval(this.timeout1);
				clearInterval(this.timeout2);
				clearInterval(this.timeout3);
				this.count1 = 0;
				this.count2 = 0;
				this.count3 = 0;

				var src = $imgs.eq(0).attr('src');
				var srcArr = src.split('/');
				var imgName = srcArr[srcArr.length - 1];
				var imgArr = imgName.split('.');

				$imgs.eq(0).attr('src', src.replace(imgArr[0].substr(-2, 2), $.addZero(this.count1)));

				src = $imgs.eq(1).attr('src');
				srcArr = src.split('/');
				imgName = srcArr[srcArr.length - 1];
				imgArr = imgName.split('.');
				$imgs.eq(1).attr('src', src.replace(imgArr[0].substr(-2, 2), $.addZero(this.count2)));

				src = $imgs.eq(2).attr('src');
				srcArr = src.split('/');
				imgName = srcArr[srcArr.length - 1];
				imgArr = imgName.split('.');
				$imgs.eq(2).attr('src', src.replace(imgArr[0].substr(-2, 2), $.addZero(this.count3)));
			},
			onTrigger: function ($current, $img, isTrigger) {
				if(isTrigger) {
					$current.trigger('mouseout');
					$img.trigger('mouseover', true);
				} else {
					$current.trigger('mouseout').trigger('mouseover');
				}
			},
			changeSrc: function ($current, $imgs, isTrigger) {
				var src = $current.attr('src');
				var srcArr = src.split('/');
				var imgName = srcArr[srcArr.length - 1];
				var imgArr = imgName.split('.');

				if(imgName.indexOf('reverse') > -1) {
					this.timeout1 = setInterval($.proxy(function() {
						$current.attr('src', src.replace(imgArr[0].substr(-2, 2), $.addZero(this.count1)));
						if(this.count1 == 95) {
							$current.attr('src', src.replace(imgArr[0].substr(-2, 2), '00'));
							this.onTrigger($current, $imgs.eq(1), isTrigger);
							this.count1 = 0;
						} else {
							this.count1++;
						}
					}, this), 80);
				} else if(imgName.indexOf('forward') > -1) {
					this.timeout2 = setInterval($.proxy(function() {
						$current.attr('src', src.replace(imgArr[0].substr(-2, 2), $.addZero(this.count2)));
						if(this.count2 == 95) {
							$current.attr('src', src.replace(imgArr[0].substr(-2, 2), '00'));
							this.onTrigger($current, $imgs.eq(2), isTrigger);
							this.count2 = 0;
						} else {
							this.count2++;
						}
					}, this), 80);
				} else if(imgName.indexOf('swing') > -1) {
					this.timeout3 = setInterval($.proxy(function() {
						$current.attr('src', src.replace(imgArr[0].substr(-2, 2), $.addZero(this.count3)));
						if(this.count3 == 95) {
							$current.attr('src', src.replace(imgArr[0].substr(-2, 2), '00'));
							if(isTrigger) {
								$current.trigger('mouseout');
							} else {
								$current.trigger('mouseout').trigger('mouseover');
							}
							this.count3 = 0;
						} else {
							this.count3++;
						}
					}, this), 80);
				}

			},
			onResponsiveChange: function (e, data) {
				if (data.RESPONSIVE_NAME === V_STATIC.RESPONSIVE.MOBILE.NAME) {
					this.allCrearInterval(this.$container.find('.fp-feature__item img'));
					this.isMobile = true;
				} else {
					this.allCrearInterval(this.$container.find('.fp-feature__item img'));
					this.isMobile = false;
				}
			}
		}
	})();

	$(function () {
		namespace.threeways.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-design-cont/clientlibs/devjs/dev2.presets.design-infinity.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
    'use strict';

    if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
        window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
    }

    var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

    namespace.designInfinity = (function () {
        var leftTimeout = null,
            rightTimeout = null;
        var siteType = {
            global : {
                step : 0.1,
                unit : '"',
                number : 'default',
                style : 'default',
                device : {
                    min : 0.0,
                    basic : {
                        desc : 'default',
                        max : [5.8]
                    },
                    plus : {
                        desc : 'default',
                        max : [6.2]
                    }
                },
                intervalTime : 25
            },
            ko : { //ko
                step : 1,
                unit : 'mm',
                style : 'style1',
                number : 'default',
                device : {
                    min : 0,
                    basic : {
                        desc : 'default',
                        max : [146.5]
                    },
                    plus : {
                        desc : 'default',
                        max : [158.0]
                    }
                },
                intervalTime : 10
            },
            cn : { //zh-CN
                step : 0.1,
                unit : '英寸',
                style : 'style2',
                number : '<em>0.0</em>/<em>0.0</em>',
                device : {
                    min : 0.0,
                    basic : {
                        desc : 'default',
                        max : [5.6,5.8]
                    },
                    plus : {
                        desc : 'default',
                        max : [6.1,6.2]
                    }
                },
                intervalTime : 25
            },
            tw : { //zh-TW
                step : 0.1,
                unit : '吋螢幕',
                style : 'style2',
                number : 'default',
                device : {
                    min : 0.0,
                    basic : {
                        desc : 'default',
                        max : [5.8]
                    },
                    plus : {
                        desc : 'default',
                        max : [6.2]
                    }
                },
                intervalTime : 25
            },
            ae : { //en-AE / ar-AE
                step : 0.1,
                unit : '"',
                style : 'default',
                number : 'default',
                device : {
                    min : 0.0,
                    basic : {
                        desc : 'default',
                        max : [5.8]
                    },
                    plus : {
                        desc : 'default',
                        max : [6.2]
                    }
                },
                intervalTime : 25
            }
        }
        return {
            init: function () {
                this.setElements();
                this.setSiteType();
                this.setLayout();
                this.runFeature();
            },
            setElements: function () {
                this.defaultInfo;
                this.$lang = $('html').attr('lang');
                this.$container = $('.fp-feature--design-infinity');
            },
            setSiteType: function () {
                var info;
                if(this.$lang == 'ko' || this.$lang == 'ko-KR' || this.$lang == 'sl-SI') {
                    info = siteType.ko;
                } else if(this.$lang == 'zh-CN') {
                    info = siteType.cn;
                } else if(this.$lang == 'zh-TW') {
                    info = siteType.tw;
                } else if(this.$lang == 'en-AE' || this.$lang == 'ar-AE') {
                    info = siteType.ae;
                } else {
                    info = siteType.global;
                }
                this.defaultInfo = info;
            },
            setLayout: function () {
                var self = this;
                this.$container.each(function () {
                    var $unit = $(this).find('' +
                        '.number >.unit');
                    var $leftDesc = $(this).find('.item-left').next();
                    var $rightDesc = $(this).find('.item-right').next();
                    $unit.text(self.defaultInfo.unit);
                    if(self.defaultInfo.number != 'default') {
                        $unit.prev().remove().end().before(self.defaultInfo.number);
                    }
                    // if(self.defaultInfo.device.basic.desc != 'default') {
                    //     $leftDesc.html(self.defaultInfo.device.basic.desc);
                    // }
                    if(self.defaultInfo.device.plus.desc != 'default') {
                        $rightDesc.html(self.defaultInfo.device.plus.desc);
                    }
                    if(self.defaultInfo.style != 'default') {
                        $unit.parent().addClass(self.defaultInfo.style);
                    }
                });
            },
            runFeature: function () {
                var self = this;
                this.$container.each(function () {
                    $(this).feature({
                        on: function ($target) {

                            $target.find('video').videoControls('play');

                            self.runInterval($target);
                            self.runAnimation($target);
                        },
                        off: function ($target) {
                            $target.find('video').videoControls('end');
                            self.resetDisplay($target);
                        }
                    });
                });

            },
            getNumber: function (max, number) {
                var returnVal;

                if(this.$lang == 'ko' || this.$lang == 'ko-KR' ||this.$lang == 'sl-SI') {
                    returnVal = number + this.defaultInfo.step;
                    if(returnVal > max) {
                        returnVal = max;
                    }
                } else {
                    returnVal = Math.ceil((number + this.defaultInfo.step) * 10) / 10;
                }

                return returnVal;
            },
            runInterval: function ($target) {
                var self = this;
                var leftMax = self.defaultInfo.device.basic.max;
                var rightMax = self.defaultInfo.device.plus.max;
                var $leftNum = $target.find('.item-left .number >em'),
                    $rightNum = $target.find('.item-right .number >em');
                var leftTxt = [0,0], rightTxt = [0,0], leftTimeout = [null,null], rightTimeout = [null,null];

                leftTimeout[0] = setInterval(function () {
                    if (leftTxt[0] < leftMax[0]) {
                        leftTxt[0] = self.getNumber(leftMax[0], leftTxt[0]);
                        $leftNum.eq(0).text(leftTxt[0]);
                    } else {
                        clearInterval(leftTimeout[0]);
                    }
                }, self.defaultInfo.intervalTime);
                rightTimeout[0] = setInterval(function () {
                    if (rightTxt[0] < rightMax[0]) {
                        rightTxt[0] = self.getNumber(rightMax[0], rightTxt[0]);
                        if((self.$lang == 'ko' || self.$lang == 'ko-KR' || self.$lang == 'sl-SI') && rightTxt[0] == '158') {
                            rightTxt[0] = ''+rightTxt[0]+'.0';
                        }
                        $rightNum.eq(0).text(rightTxt[0]);
                    } else {
                        clearInterval(rightTimeout[0]);
                    }
                }, self.defaultInfo.intervalTime);

                if(this.$lang == 'zh-CN') {
                    leftTimeout[1] = setInterval(function () {
                        if (leftTxt[1] < leftMax[1]) {
                            leftTxt[1] = self.getNumber(leftMax[1], leftTxt[1]);
                            $leftNum.eq(1).text(leftTxt[1]);
                        } else {
                            clearInterval(leftTimeout[1]);
                        }
                    }, self.defaultInfo.intervalTime);
                    rightTimeout[1] = setInterval(function () {
                        if (rightTxt[1] < rightMax[1]) {
                            rightTxt[1] = self.getNumber(rightMax[1], rightTxt[1]);
                            $rightNum.eq(1).text(rightTxt[1]);
                        } else {
                            clearInterval(rightTimeout[1]);
                        }
                    }, self.defaultInfo.intervalTime);
                }
            },
            runAnimation: function ($target) {
                var $left = $target.find('.item-left'),
                    $right = $target.find('.item-right');

                setTimeout(function () {
                    $left.find('.display-item-arr01').css('height', '0%').stop().animate({
                        height: '43.26%'
                    }, {
                        duration: 1500
                    });
                    $left.find('.display-item-arr02').css('height', '0%').stop().animate({
                        height: '49.44%'
                    }, {
                        duration: 1500
                    });
                    $right.find('.display-item-arr01').css('height', '0%').stop().animate({
                        height: '47.89%'
                    }, {
                        duration: 1500
                    });
                    $right.find('.display-item-arr02').css('height', '0%').stop().animate({
                        height: '42.11%'
                    }, {
                        duration: 1500
                    });
                }, 100);
            },
            resetDisplay: function ($target) {
                var $left = $target.find('.item-left'),
                    $leftNum = $left.find('.number >em'),
                    $right = $target.find('.item-right'),
                    $rightNum = $right.find('.number >em');

                if($leftNum.length > 0) {
                    for(var i = 0; i < $leftNum.length; i++) {
                        $leftNum.eq(i).text(0.0);
                    }
                }
                if($rightNum.length > 0) {
                    for(var i = 0; i < $rightNum.length; i++) {
                        $rightNum.eq(i).text(0.0);
                    }
                }

                $left.find('.display-item-arr01').css('height', '0%');
                $left.find('.display-item-arr02').css('height', '0%');
                $right.find('.display-item-arr01').css('height', '0%');
                $right.find('.display-item-arr02').css('height', '0%');
            }
        }
    })();

    $(function () {
        namespace.designInfinity.init();
    });
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature/clientlibs/devjs/dev2.presets.highlights-camera.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
	'use strict';

	if('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.highlightsCamera = (function(){
		var $container = $('.fp-feature--highlights-camera');
		return {
			init: function(){
				this.bindEvents();
			},
			bindEvents : function() {
				$container.each(function(){
					$(this).feature({
						onVisible : function($target) {
							$target.find('video').videoControls('play');
						},
						off : function($target) {
							$target.find('video').videoControls('end');
						}
					});
				});
			}
		}
	})();

	$(function(){
		namespace.highlightsCamera.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature/clientlibs/devjs/dev2.presets.highlights-dual.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
	'use strict';

	if('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.highlightsDual = (function(){
		var $container = $('.fp-feature--highlights-dual'),
			$tabList = $('.s-dual-tab-list > li'),
			$tabContent = $('.s-dual-img-list > li'),
			activeClass = 'is-active';
		return {
			init: function(){
				this.bindEvents();
			},
			bindEvents : function() {
				$container.each(function() {
					var $thisTabList = $(this).find($tabList),
						$thisContentList = $(this).find($tabContent);
					$thisTabList.on('click', function(e) {
						e.preventDefault();
						var activeIndex = $(e.target).parent().index();
						$thisTabList.removeClass(activeClass).eq(activeIndex).addClass(activeClass);
						$thisContentList.removeClass(activeClass).eq(activeIndex).addClass(activeClass);
					});
				});
			}
		}
	})();

	$(function(){
		namespace.highlightsDual.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature/clientlibs/devjs/dev2.presets.highlights-security.js
 *
 * @version 1.0.0
 * @since 2018.02.07
 */
;(function (win, $) {
	'use strict';

	if('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.highlightsSecurity = (function(){
		var $container = $('.fp-feature--highlights-security'),
			$content = $('.s-figure-security figure'),
			securityMotion,
			activeClass = 'is-active';
		return {
			init: function(){
				this.bindEvents();
			},
			bindEvents : function() {
				$container.each(function() {
					$(this).feature({
						onVisible : function(target) {
							var $thisContent = target.find('.s-figure-security > figure'),
								maxContent = $thisContent.length,
								activeIndex = parseInt($thisContent.filter('.'+activeClass).index()),
								activeIndex = activeIndex < 0 ? 0 : activeIndex,
								interval = 2000;
							
							setTimeout(function() {
								$thisContent.removeClass(activeClass).eq(1).addClass(activeClass);
								activeIndex = parseInt($thisContent.filter('.'+activeClass).index()),
								activeIndex = activeIndex < 0 ? 0 : activeIndex
								securityMotion = setInterval(function() {
									if(++activeIndex >= maxContent) activeIndex = 0;
									$thisContent.not(':eq('+activeIndex+')').removeClass(activeClass);
									$thisContent.eq(activeIndex).addClass(activeClass);
								}, interval);
							}, 750);
						},
						off : function(target) {
							clearInterval(securityMotion);
						}
					});
				})
			}
		}
	})();

	$(function(){
		namespace.highlightsSecurity.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature/clientlibs/devjs/dev2.presets.highlights-stickers.js
 *
 * @version 1.0.0
 * @since 2018.02.22
 */
;(function (win, $) {
	'use strict';

	if('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.highlightsStickers = (function(){
		var $container = $('.fp-feature--highlights-stickers');
		return {
			init: function(){
				setTimeout(function() {
					for(var i = 0; i < $container.length; i++) {
						(function($container, prop) {

							var $wrap = $container.eq(prop);
							$wrap.find('.s-figure-stickers img').each(function() {
								var img = $(this);
								var src = img.attr('data-cache-src');
								if(src) img.attr('src', src);
							});

						})($container, i);
					}
				}, 2000);
			}
		}
	})();

	$(function(){
		namespace.highlightsStickers.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-camera-cont/clientlibs/devjs/dev2.presets.highlights-superslow.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
	'use strict';

	if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
		window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
	}

	// Static Values
	var V_STATIC = win.smg.aem.varStatic,
	// Utility Script
	UTIL = win.smg.aem.util,
	// Custom Events
	CST_EVENT = win.smg.aem.customEvent;

	var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

	namespace.highlightsSuperslow = (function () {
		return {
			init: function () {
				this.setElements();
				this.bindEvents();
			},
			setElements: function () {
				this.$body = $('body');
				this.$playButton = $('.fp-feature--highlights-superslow .s-cta-playvideo');
				this.$videoWrap = $('.fp-feature--highlights-superslow .fp-feature__figure');
				this.responsiveType;
				this.run = false;
				this.isMobile = false;
			},
			bindEvents: function () {
				this.$body.on(CST_EVENT.RESPONSIVE.CHANGE, $.proxy(this.onResponsiveChange, this));
				this.$body.trigger(CST_EVENT.RESPONSIVE.GET_STATUS);
				this.$playButton.on('click', $.proxy(this.onClickPlayBtn, this));
			},
			onClickPlayBtn: function (e) {
				var $current = $(e.currentTarget),
					$btnTxt = $current.find('span'),
					$container = $current.closest('.fp-feature--highlights-superslow'),
					$videoWrap = $container.find('.fp-feature__figure'),
					$video = $container.find('video');

				if(($current.hasClass('playing') && !$current.hasClass('pause')) || ($current.hasClass('playing') && $current.hasClass('playgo'))) {
					$current.removeClass('playgo').addClass('pause');
					$btnTxt.text('Play Video');
					$video.videoControls('pause');
					// $video.pause();
				} else if($current.hasClass('pause')) {
					$current.removeClass('pause').addClass('playgo');
					$btnTxt.text('Pause Video');
					$video.videoControls('play');
					// $video.play();
				} else {
					$videoWrap.addClass('s-video-play');
					$current.addClass('playing');
					$btnTxt.text('Pause Video');
					$video.videoControls('play');
					// $video.play();
				}
				if($video[0].readyState < 4 && this.$body.hasClass('touch-device')) {
					$video.parent().find('img').css('opacity', 1);
					$video.css('display', 'none');
					$videoWrap.addClass('s-none-video');
				}
				if (!this.run && $video.length && !this.$body.hasClass('touch-device')) {
					$video.on('ended', function (e) {
						$videoWrap.removeClass('s-video-play');
						$btnTxt.text('Play Video');
						$current.removeClass('pause playgo playing');
					});
					this.run = true;
				}
			},
			onResponsiveChange: function (e, data) {
				if (data.RESPONSIVE_NAME === V_STATIC.RESPONSIVE.MOBILE.NAME) {
					this.isMobile = true;
					var viewSizeType = 'mo';
				} else {
					this.isMobile = false;
					var viewSizeType = 'pc';
				}
				if(this.responsiveType != viewSizeType) {
					this.$playButton.removeClass('pause playgo playing');
					this.$videoWrap.removeClass('s-video-play');
				}
				this.responsiveType = viewSizeType;
			}
		}
	})();

	$(function () {
		namespace.highlightsSuperslow.init();
	});
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-performance-cont/clientlibs/devjs/dev2.presets.performance-charging.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
    'use strict';

    if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
        window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
    }

    var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

    namespace.performanceCharging = (function () {
        return {
            init: function () {
                this.bindEvents();
            },
            bindEvents: function () {

                var $container = $('.fp-feature--performance-charging');
                
                $container.each(function () {
                    $(this).feature({
                        on: function ($target) {
                            $target.find('video').videoControls('play');
                            // $target.find('video').videoControls('play', $target.find('img.js-end-img'));
                        },
                        off: function ($target) {
                            $target.find('video').videoControls('end');
                            // $target.find('video').videoControls('end', $target.find('img.js-end-img'));
                        }
                    });
                });
                
            }
        }
    })();

    $(function () {
        namespace.performanceCharging.init();
    });
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-performance-cont/clientlibs/devjs/dev2.presets.performance-dolby.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
    'use strict';

    if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
        window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
    }

    var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

    namespace.performanceDolby = (function () {
        return {
            init: function () {
                this.bindEvents();
            },
            bindEvents: function () {

                var $container = $('.fp-feature--performance-dolby');

                $container.each(function () {
                    $(this).feature({
                        on: function ($target) {
                            $target.find('video').videoControls('play');
                            // $target.find('video').videoControls('play', $target.find('img.js-end-img'));
                        },
                        off: function ($target) {
                            $target.find('video').videoControls('end');
                            // $target.find('video').videoControls('end', $target.find('img.js-end-img'));
                        }
                    });
                });
                
            }
        }
    })();

    $(function () {
        namespace.performanceDolby.init();
    });
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-performance-cont/clientlibs/devjs/dev2.presets.performance-knox.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;
(function (win, $) {
    'use strict';

    if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
        window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
    }

    var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

    namespace.performanceKnox = (function () {

        return {
            init: function () {
                this.bindEvents();
            },
            bindEvents: function () {
                
                var $container = $('.fp-feature--performance-knox'),
                    stepTimeout = [];

                $container.each(function () {
                    $(this).feature({
                        on: function ($target) {
                            stepTimeout = $target.timelineMotion({
                                onMotions: [{
                                        target: '.knox-item01',
                                        addClass: 'on',
                                        runTime: 1000
                                    },
                                    {
                                        target: '.knox-item02',
                                        addClass: 'on',
                                        runTime: 1100
                                    },
                                    {
                                        target: '.knox-item03',
                                        addClass: 'on',
                                        runTime: 1200
                                    },
                                    {
                                        target: '.knox-item04',
                                        addClass: 'on',
                                        runTime: 1300
                                    },
                                    {
                                        target: '.knox-item05',
                                        addClass: 'on',
                                        runTime: 1400
                                    }
                                ]
                            });
                        },
                        off: function ($target) {
                            $target.timelineMotion({
                                offMotions: [{
                                    target: '.knox-item01, .knox-item02, .knox-item03, .knox-item04, .knox-item05',
                                    removeClass: 'on'
                                }],
                                timeout : stepTimeout
                            });
                        }
                    });
                });

            }
        }
    })();

    $(function () {
        namespace.performanceKnox.init();
    });
})(window, window.jQuery);
/*!
 * samsung.com - Flagship - Feature
 * src : /apps/samsungp5/components/global/content/flagship-pd/product/galaxy-s9/fp-g-feature-performance-cont/clientlibs/devjs/dev2.presets.performance-speaker.js
 *
 * @version 1.0.0
 * @since 2018.02.05
 */
;(function (win, $) {
    'use strict';

    if ('undefined' === typeof window.smg.aem.components.flagshipPD.product.galaxyS9.feature) {
        window.smg.aem.components.flagshipPD.product.galaxyS9.feature = {};
    }

    var namespace = window.smg.aem.components.flagshipPD.product.galaxyS9.feature;

    namespace.performanceSpeakers = (function () {
        return {
            init: function () {
                this.bindEvents();
            },
            bindEvents: function () {

                var $container = $('.fp-feature--performance-speakers');
                
                $container.each(function () {
                    $(this).feature({
                        on: function ($target) {
                            $target.find('video').videoControls('play');
                            // $target.find('video').videoControls('play', $target.find('img.js-end-img'));
                        },
                        off: function ($target) {
                            $target.find('video').videoControls('end');
                            // $target.find('video').videoControls('end', $target.find('img.js-end-img'));
                        }
                    });
                });
                
            }
        }
    })();

    $(function () {
        namespace.performanceSpeakers.init();
    });
})(window, window.jQuery);
!function(e,t){"use strict";"undefined"==typeof e.smg&&(e.smg={}),"undefined"==typeof e.smg.aem&&(e.smg.aem={}),"undefined"==typeof e.smg.aem.components&&(e.smg.aem.components={}),"undefined"==typeof e.smg.aem.components.flagshipPD&&(e.smg.aem.components.flagshipPD={}),"undefined"==typeof e.smg.aem.components.flagshipPD.product&&(e.smg.aem.components.flagshipPD.product={}),"undefined"==typeof e.smg.aem.components.flagshipPD.product.galaxyS9&&(e.smg.aem.components.flagshipPD.product.galaxyS9={});var s=e.smg.aem.varStatic,n=(e.smg.aem.util,e.smg.aem.customEvent),a=e.smg.aem.components.flagshipPD.product.galaxyS9.accViewer;a=function(){var e=t("body"),a=t(".fp-accessories-viewer"),i="fp-accessories-viewer--preset-clear",o=!1,r=(function(){var a=function(e,t){o=t.RESPONSIVE_NAME===s.RESPONSIVE.MOBILE.NAME?!0:!1},i=function(){e.on(n.RESPONSIVE.CHANGE,t.proxy(a,this)),e.trigger(n.RESPONSIVE.GET_STATUS)},r=function(){e.off(n.RESPONSIVE.CHANGE),e.off(n.RESPONSIVE.GET_STATUS)};return{run:i,reset:r}}(),null),c=function(e){var t=e.find(".fp-accessories-viewer__contents-item.is-actived");r=e.find(t).timelineMotion({onMotions:[{addClass:"start-motion",runTime:1e3},{addClass:"s-ani-step1",runTime:2e3},{addClass:"s-ani-step2",runTime:3e3}]})},f=function(e){var t=e.find(".fp-accessories-viewer__contents-item.is-actived");e.find(t).timelineMotion({offMotions:[{removeClass:"start-motion s-ani-step1 s-ani-step2"}],timeout:r})},d=function(){a.each(function(){t(this).feature(t(this).find("video").length<1?{on:function(e){e.hasClass(i)?c(e):_(e)},off:function(e){e.hasClass(i)?f(e):h(e)}}:{on:function(e){u(e)},off:function(e){g(e)}})})},l=function(){var e=null,t={};if(a.length)for(var s=0;s<a.length;s++)e=a.eq(s),t.deviceTabWrap=e.find(".fp-accessories-viewer__tab"),t.colorTabWrap=e.find(".fp-accessories-viewer__colorchip"),m(t,!0),v(t,!0)},p=function(){t.parallaxes.destroy(),t.parallaxes.init()},m=function(e,s){s=s||!0;var n=e.deviceTabWrap.find("button.fp-accessories-viewer__tab-text"),a="is-actived";n.length&&(s?n.on("click",function(e){e.preventDefault();var s=t(e.currentTarget),n=s.closest(".fp-accessories-viewer"),o=n.find(".fp-accessories-viewer__colorchip"),r=n.find(".fp-accessories-viewer__tab-contents"),f=n.find(".fp-accessories-viewer__contents-item"),d=s.parent("div").index();s.hasClass(a)||(p(),s.addClass(a).parent().siblings("div").find("button").removeClass(a),o.length&&o.removeClass(a).eq(d).addClass(a),r.length&&(r.removeClass(a).eq(d).addClass(a),s.parents("section").hasClass(i)&&(f.removeClass(a).eq(d).addClass(a),f.removeClass("start-motion s-ani-step1 s-ani-step2"),c(n))),u(r))}):n.off("click"))},v=function(e,s){var n=e.colorTabWrap.find("button.fp-accessories-viewer__colorchip-button"),a="is-actived";n.length&&(s?n.on("click",function(e){e.preventDefault();var s=t(e.currentTarget),n=s.closest(".fp-accessories-viewer"),i=n.find(".fp-accessories-viewer__tab-contents").filter("."+a),o=i.find(".fp-accessories-viewer__contents-item"),r=s.index();s.hasClass(a)||(p(),s.addClass(a).siblings("button").removeClass(a),o.length&&o.removeClass(a).eq(r).addClass(a))}):n.off("click"))},u=function(e){e.find("video").videoControls("play"),e.find("video").on("ended",function(t){e.find("video").fadeOut(),_(e)})},g=function(e){e.find("video").css("display","block").fadeIn(),e.find("video").videoControls("end")},_=function(e){var t=e.find(".fp-accessories-viewer__tab-contents.is-actived .fp-accessories-viewer__contents-item.is-actived");t.addClass("is-img-frame")},h=function(e){var t=e.find(".fp-accessories-viewer__contents-item");t.removeClass("is-img-frame")},b=function(){for(var e=t(".fp-accessories-viewer--preset-led"),s=0;s<e.length;s++){var n=e.eq(s),a=n.find(".fp-accessories-viewer__tab-contents-wrap");a.attr("data-top-bottom","transform:translateY(10%)").attr("data-bottom-top","transform:translateY(-20%)")}for(var i=t(".fp-accessories-viewer--preset-alcantara"),s=0;s<i.length;s++)for(var n=i.eq(s),o=n.find(".flagship-pd__image"),r=0;r<o.length;r++){var c=o.eq(r).find("img:eq(0)");c.attr("data-top-bottom","transform:translateY(4%)").attr("data-bottom-top","transform:translateY(-4%)")}for(var f=t(".fp-accessories-viewer--preset-battery"),s=0;s<f.length;s++){var n=f.eq(s),d=n.find(".flagship-pd__image >img");d.eq(0).attr("data-top-bottom","transform:translateY(5%)").attr("data-bottom-top","transform:translateY(-5%)"),d.eq(1).attr("data-top-bottom","transform:translateY(-5%)").attr("data-bottom-top","transform:translateY(5%)")}},w=function(){b(),l(),d()},C=function(){l(),d()};return{init:w,reInit:C}}(),t(function(){a.init()})}(window,window.jQuery);
