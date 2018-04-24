; (function ($) {

    var sectionLength = $(document).find(".sh-g-shop-covers_covers_wrap").length,
        sectionIdx = 0,
        sucessCheck = false;

    window.jsonpCallback_cover = function(data) {
    };
        
    var EMC_COMPONENT = {

        elem : {
            site_cd : $("#shopSiteCode").val(),
            is_global : true,
            is_currency: "dollar",
            is_dollar : true,
            api_check : false,
            api_domain : 'https://shop.samsung.com/',
            _this : "",
            rtl_check : $("html").is(".rtl") === true ? true : false,
            choice_product : [],
            data_array : [],
            api_url : ""
        },

        productInfo : [],

        common : {

            addComma: function (num, currency) {
                num = String(num);

                switch (currency) {
                    case "dollar":

                        if (EMC_COMPONENT.elem.site_cd === "ca_fr") {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                                returnValue = returnValue.replace(".", ",");
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ",00";
                            }

                            return returnValue + " $";

                        } else {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                            }

                            return "$" + returnValue;

                        }

                        break;

                    case "euro":

                        var tempSepNum;

                        if (EMC_COMPONENT.elem.site_cd === "de" || EMC_COMPONENT.elem.site_cd === "es" || EMC_COMPONENT.elem.site_cd === "be_fr") {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(".", ",");
                                returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ",00";
                            }

                            return returnValue + " €";

                        } else if (EMC_COMPONENT.elem.site_cd === "fi" || EMC_COMPONENT.elem.site_cd === "fr") {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(".", ",");
                                returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ",00";
                            }

                            return returnValue + " €";

                        } else {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(".", ",");
                                returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ",00";
                            }

                            return "€ " + returnValue;

                        }

                        break;

                    case "gbp":

                        if (num.indexOf(".") > -1) {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        } else {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                        }

                        return "£" + returnValue
                        break;

                    case "sek":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

                        return returnValue + " kr";
                        break;

                    case "dkk":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                        return returnValue + " kr.";
                        break;

                    case "nok":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

                        return returnValue + " kr";
                        break;

                    case "brl":

                        if (num.indexOf(".") > -1) {
                            returnValue = num.replace(".", ",");
                            returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        } else {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ",00";
                        }

                        return "R$ " + returnValue;
                        break;

                    case "inr":

                        if (num.indexOf(".") > -1) {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        } else {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                        }

                        return "Rs." + returnValue;
                        break;

                    case "krw":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                        return returnValue + "원";
                        break;

                    case "ae":

                        if (EMC_COMPONENT.elem.site_cd === "ae_ar") {
                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                            }

                            return returnValue + " د.إ";

                        } else {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                            }

                            return returnValue + " AED";
                        }

                        break;

                    case "rub":

                        if (num.indexOf(".") > -1) {
                            returnValue = num.replace(".", ",");
                            returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                        } else {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + "";
                        }

                        return returnValue + "  ₸";
                        break;

                    case "twd":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                        return "NT$" + returnValue;
                        break;

                    default:
                        break;
                }
            },

            imgResizeSrc : function (){
                var $image = $(".sh-g-shop-covers_covers_wrap").find("img"),
                    img_array = [],
                    img_sources = [];

                for (var i = 0; i < $(".sh-g-shop-covers_covers_wrap img").length; i++) {
                    $image[i] = $($image[i]);
                    img_sources[i] = EMC_COMPONENT.common.getImageSources($image[i]);

                    if (window.innerWidth > 768) {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[2]);
                    } else {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[1]);
                    }
                }
            },

            getImageSources: function ($image){
                var s2 = $image.attr('data-src-pc') || $image.attr('src'),
                    s3 = s2,
                    s1 = $image.attr('data-src-mobile') || s2;

                return [null, s1, s2, s3]
            },

            layerOpen : function(idx, thisIdx){
                var _layerHtml = "<div class='sh-g-shop-covers_notification'><div class='sh-g-shop-covers_modal sh-g-shop-covers_fade' role='dialog' tabindex='-1'><div class='sh-g-shop-covers_modal-backdrop sh-g-shop-covers_fade'></div><div class='sh-g-shop-covers_modal-dialog' role='document'><div class='sh-g-shop-covers_modal-content'><div class='sh-g-shop-covers_modal-body sh-g-shop-covers_text-center'><div class='sh-g-shop-covers_icon-tick-96-px' data-grunticon-embed><svg width='96px' height='96px' viewBox='0 0 96 96' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns: xlink='http://www.w3.org/1999/xlink'><desc>Created with sketchtool.</desc><defs><circle id='path-1' cx='32' cy='32' r='32'></circle><mask id='mask-2' maskContentUnits='userSpaceOnUse' maskUnits='objectBoundingBox' x='0' y='0' width='64' height='64' fill='white'><use xlink: href='#path-1'></use></mask></defs><g id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><g id='Icons' transform='translate(-535.000000, -1272.000000)'><g id='64px' transform='translate(535.000000, 272.000000)' stroke-linecap='square' stroke='#008378'><g id='Icon/96/tick-96px' transform='translate(0.000000, 1000.000000)'><g id='tick' transform='translate(16.000000, 16.000000)'><polyline id='Line' stroke-width='2' points='20.8 35.36 28.8 42.4 42.4 22.4'></polyline></g></g></g><g id='16px' transform='translate(135.000000, 224.000000)'></g></g></g></svg></div><p>Item added</p><a href='/au/cart/' class='sh-g-shop-covers_btn sh-g-shop-covers_btn-default sh-g-shop-covers_btn-block sh-g-shop-covers_mini-cart-checkout-button sh-g-shop-covers_js-chekcout-popup-notif' data-omni-type='microsite_scView' data-omni=';" + EMC_COMPONENT.elem.choice_product[idx][thisIdx][0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[idx][thisIdx][0].toUpperCase() + "' title=''>Checkout</a><a href='#' data-dismiss='modal' class='sh-g-shop-covers_btn sh-g-shop-covers_btn-link sh-g-shop-covers_addtocart-continue-shopping sh-g-shop-covers_js-continue-modal' data-omni-type='microsite_basketAdd' data-omni='basket:continue shopping' title=''>Continue Shopping</a></div></div></div></div></div>";
				
            	var popupInfo = $(".sh-g-shop-covers_covers_wrap.section_" + (idx+1)).find(".sh-g-shop-covers-popupInfo").val(),
            		popupContent, _layerHtml;
            	
                $(document).find(".sh-g-shop-covers_covers_wrap.section_" + (idx + 1)).append(_layerHtml);
                $(document).find(".sh-g-shop-covers_covers_wrap.section_" + (idx + 1)).find(".sh-g-shop-covers_notification > .sh-g-shop-covers_modal").css("display", "block");
                setTimeout(function () {
                    $(document).find(".sh-g-shop-covers_covers_wrap.section_" + (idx + 1)).find(".sh-g-shop-covers_notification > .sh-g-shop-covers_modal").addClass("sh-g-shop-covers_in");
                    $(document).find(".sh-g-shop-covers_covers_wrap.section_" + (idx + 1)).find(".sh-g-shop-covers_notification .sh-g-shop-covers_modal-backdrop").addClass("sh-g-shop-covers_in");
                    $(document).find(".sh-g-shop-covers_covers_wrap.section_" + (idx + 1)).find(".sh-g-shop-covers_notification a").filter(":first").focus();
                }, 100);
            },

            clickPreorder : function(idx,thisIdx){
                var selectIdx = $(".model-choose .color li.active").index();
                var checkCookieAPI = '',
                    buyNowAPI = '',
                    //change /nc/cartAndCheckout -> /cart
                    cartAndCheckAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/cart';

                if (!EMC_COMPONENT.elem.is_global) {
                    checkCookieAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/makeBuyNowCookie';
                    addCartAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';

                    $.ajax({
                        url: checkCookieAPI,
                        dataType: 'jsonp',
                        success: function (data) {
                            if (data.resultCode == '0000') {
                                buyNow(addCartAPI, cartAndCheckAPI, idx, thisIdx);
                            } else {
                                alert(data.resultMessage);
                            }
                        }
                    });

                } else {
                    //change /ng/p4v1/buyNow -> /ng/p4v1/addCart
                    buyNowAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';
                    EMC_COMPONENT.common.buyNow(buyNowAPI, cartAndCheckAPI, idx, thisIdx);
                }
            },

            buyNow: function (urlApi, checkApi, idx, thisIdx){
                // ajax API
                var count = 0,
                    paramater = 'quantity=1&productCode=',
                    accParamater = '',
                    quantity = [];

                //tagging      
                var resultName = [],
                    resultPid = [],
                    tagModelCode = '',
                    tagPid = '';

                $.each(EMC_COMPONENT.elem.choice_product, function (index, ele) {
                    if ($.inArray(ele, resultName) == -1) {
                        resultName.push(ele);
                    }
                });

                if (EMC_COMPONENT.elem.choice_product.length != 0) {

                    for (var i = 0; i < EMC_COMPONENT.elem.choice_product.length; i++) {
                        var keyPid = EMC_COMPONENT.elem.choice_product[i];
                        if (!quantity[keyPid]) {
                            quantity[keyPid] = 1;
                        } else {
                            quantity[keyPid] = quantity[keyPid] + 1;
                        }
                    }

                    
                    var choice_result = thisIdx;
                    var accParamater = "";
                    function checkout() {
                        accParamater = "quantity=" + quantity[keyPid] + "&productCode=" + EMC_COMPONENT.elem.choice_product[idx][choice_result][0];
                        
                        $.ajax({
                            url: urlApi + accParamater,
                            dataType: 'jsonp',
                            async: false,
                            success: function (data) {
                                if (data.resultCode == '0000') {
                                    $(".js-empty-cart").hide();
                                    $(".s-btn-utility.js-cart").show();
                                    $("#globalCartCount").show();
                                    updateTotalCartCount(data.cartCount);
                                    EMC_COMPONENT.common.layerOpen(idx, thisIdx);
                                    EMC_COMPONENT.elem.api_url = checkApi;
                                } else {
                                    alert(data.resultMessage);
                                }
                            }
                        });
                    }
                    checkout();
                }
            }
        },

        resize : function(){

            $(window).resize(function(){
                EMC_COMPONENT.common.imgResizeSrc();
                EMC_COMPONENT.slide.resize();
                EMC_COMPONENT.tagging.slide();
            });

        },

        numberConvert: function (num) {

            var resultCurrency = 0;

            if (typeof num != "number" && num != undefined) {
                var exceptCode = ["kr.", "Rs."];

                $.each(exceptCode, function (i, v) {
                    num = $.trim(num.replace(v, ""));
                });

                num = num.replace(/[^0-9^.^,]/g, "");

                if (num.indexOf(",") > -1 || num.indexOf(".") > -1) {
                    var comma = num.split(",").pop();
                    var close = num.split(".").pop();

                    if (comma.length == 2) {
                        return resultCurrency = Number((num.slice(0, -2).replace(/[^0-9]/g, "") + "." + comma));
                    }

                    else if (close.length == 2) {
                        return resultCurrency = Number((num.slice(0, -2).replace(/[^0-9]/g, "") + "." + close));
                    }

                    else {
                        return resultCurrency = Number(num.replace(/[^0-9]/g, ""));
                    }

                } else {
                    return resultCurrency = Number(num);
                }
            } else if (num === undefined || num === "") {
                return resultCurrency = "";
            } else {
                return resultCurrency = Number(num);
            }

        },

        dataSet : function(idx){

            var thisPrice,
                price = 0,
                promotionPrice = 0;
            
            EMC_COMPONENT.elem._this.find("[data-role]").each(function(){
                EMC_COMPONENT.elem.data_array[idx].push($(this).data("role").split("|"));
            });

            for(var i = 0; i < EMC_COMPONENT.elem.data_array[idx].length; i++ ){
                for (var v = 0; v < EMC_COMPONENT.elem.data_array[idx][i].length; v++ ){
                    EMC_COMPONENT.elem.data_array[idx][i][v] = EMC_COMPONENT.elem.data_array[idx][i][v].split("^");
                }
            }

            for( var a = 0; a < EMC_COMPONENT.elem.data_array[idx].length; a++ ){
                EMC_COMPONENT.productInfo[idx].push([]);
            }

            
            for( var l = 0; l < EMC_COMPONENT.productInfo[idx].length; l++ ){
                for( var d = 0; d < EMC_COMPONENT.elem.data_array[idx][l].length; d++ ){

                    if (EMC_COMPONENT.elem.data_array[idx][l][d][4] === undefined || EMC_COMPONENT.elem.data_array[idx][l][d][4] === ""){
                        promotionPrice = "";
                    }else{
                        promotionPrice = EMC_COMPONENT.numberConvert(EMC_COMPONENT.elem.data_array[idx][l][d][4]);
                    }

                    EMC_COMPONENT.productInfo[idx][l].push({
                        code: EMC_COMPONENT.elem.data_array[idx][l][d][0],
                        imgPathPc: EMC_COMPONENT.elem.data_array[idx][l][d][1],
                        imgPathMo: EMC_COMPONENT.elem.data_array[idx][l][d][2],
                        price: EMC_COMPONENT.numberConvert(EMC_COMPONENT.elem.data_array[idx][l][d][3]),
                        promotionPrice: promotionPrice,
                        stock: "" 
                    });
                }
            }
            
            for (var m = 0; m < EMC_COMPONENT.productInfo[idx].length; m++) {
                thisPrice = $(document).find(".sh-g-shop-covers_covers_wrap.section_" + (idx + 1)).find(".sh-g-shop-covers_cover_list"),
                price = EMC_COMPONENT.common.addComma(EMC_COMPONENT.productInfo[idx][m][0].price, $(document).find(".sh-g-shop-covers-currency").val());
                
                if (EMC_COMPONENT.productInfo[idx][m][0].promotionPrice === "" || EMC_COMPONENT.productInfo[idx][m][0].promotionPrice === undefined) {
                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").text(price);
                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").next(".sh-g-shop-covers_price_was").removeClass("sh-g-shop-covers_in");
                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").next(".sh-g-shop-covers_price_was").find(".sh-g-shop-covers_price").text("");
                } else {
                    promotionPrice = EMC_COMPONENT.common.addComma(EMC_COMPONENT.productInfo[idx][m][0].promotionPrice, $(document).find(".sh-g-shop-covers-currency").val());

                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").text(promotionPrice);
                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").next(".sh-g-shop-covers_price_was").addClass("sh-g-shop-covers_in");
                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").next(".sh-g-shop-covers_price_was").find(".sh-g-shop-covers_price").text(price);
                }
            }
        },

        taggingSet: function(idx){

            EMC_COMPONENT.elem._this.find(".sh-g-shop-covers_cover_list").each(function(i){
                $(this).find(">a").attr("data-omni", "accessories_view product detail|;" + EMC_COMPONENT.productInfo[idx][i][0].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[idx][i][0].code.toUpperCase());

                $(this).find(".sh-g-shop-covers_btn_cart >a").attr("data-omni", ";" + EMC_COMPONENT.productInfo[idx][i][0].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[idx][i][0].code.toUpperCase());

                $(this).find(".sh-g-shop-covers_color_chip li").each(function(c){
                    $(this).find(".sh-g-shop-covers_color_item").attr("data-omni", "accessories_color|;" + EMC_COMPONENT.productInfo[idx][i][c].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[idx][i][c].code.toUpperCase());
                });
            });

        },

        apiPriceSet : {
            
            elem : {
                _dataLength : 0,
                _dataIndex : 1,
                _successCheck : false
            },

            getPrice: function (modelCode, obj){

                $.ajax({
                    url: EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/getRealTimeProductSimpleInfo?productCode=' + modelCode,
                    dataType: 'jsonp',
                    jsonp: "callback",
                    jsonpCallback: "jsonpCallback_cover",
                    cache: true,
                    success: function (data) {
                        if (data && data.resultCode == '0000') {
                            obj.price = EMC_COMPONENT.numberConvert(data.price);
                            
                            if (data.promotionPrice === "") {
                                obj.price = EMC_COMPONENT.numberConvert(data.price);
                                obj.promotionPrice = "";
                            } else {
                                obj.price = EMC_COMPONENT.numberConvert(data.price);
                                obj.promotionPrice = EMC_COMPONENT.numberConvert(data.promotionPrice);
                            }
                            obj.stock = data.stockLevelStatus;
                        }
                    },
                    complete: function () {
                        if (EMC_COMPONENT.apiPriceSet.elem._dataLength != EMC_COMPONENT.apiPriceSet.elem._dataIndex) {
                            EMC_COMPONENT.apiPriceSet.elem._dataIndex = EMC_COMPONENT.apiPriceSet.elem._dataIndex + 1;
                        } else {
                            EMC_COMPONENT.apiPriceSet.elem._successCheck = true;
                        }
                    }
                });
            },

            setPrice : function(idx){
                sucessCheck = false;
                EMC_COMPONENT.apiPriceSet.elem._successCheck = false;
                EMC_COMPONENT.apiPriceSet.elem._dataLength = 0;
                EMC_COMPONENT.apiPriceSet.elem._dataIndex = 1;

                for( var i = 0; i < EMC_COMPONENT.productInfo[idx].length; i++ ){
                    EMC_COMPONENT.apiPriceSet.elem._dataLength += EMC_COMPONENT.productInfo[idx][i].length;
                }

                if (EMC_COMPONENT.elem._this.find(".sh-g-shop-covers-apiUse").val() === "Y") {
                    for( var x = 0; x < EMC_COMPONENT.productInfo[idx].length; x++ ){
                        $.each(EMC_COMPONENT.productInfo[idx][x],function(i,v){
                            EMC_COMPONENT.apiPriceSet.getPrice(v.code.toUpperCase(), v);
                        });
                    }
                }else{
                    EMC_COMPONENT.apiPriceSet.elem._successCheck = true;
                }
                
                var apiSuccessCheckInterval = setInterval(function(){
                    if (EMC_COMPONENT.apiPriceSet.elem._successCheck === true){
                        clearInterval(apiSuccessCheckInterval);
                        (function(){

                            var thisPrice,
                                price,
                                promotionPrice;

                            for (var m = 0; m < EMC_COMPONENT.productInfo[idx].length; m++) {
                                thisPrice = $(document).find(".sh-g-shop-covers_covers_wrap.section_" + (idx + 1)).find(".sh-g-shop-covers_cover_list"),
                                price = EMC_COMPONENT.common.addComma(EMC_COMPONENT.productInfo[idx][m][0].price, $(document).find(".sh-g-shop-covers-currency").val());

                                if (EMC_COMPONENT.productInfo[idx][m][0].promotionPrice === "" || EMC_COMPONENT.productInfo[idx][m][0].promotionPrice === undefined) {
                                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").text(price);
                                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").next(".sh-g-shop-covers_price_was").removeClass("sh-g-shop-covers_in");
                                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").next(".sh-g-shop-covers_price_was").find(".sh-g-shop-covers_price").text("");
                                } else {
                                    promotionPrice = EMC_COMPONENT.common.addComma(EMC_COMPONENT.productInfo[idx][m][0].promotionPrice, $(document).find(".sh-g-shop-covers-currency").val());

                                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").text(promotionPrice);
                                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").next(".sh-g-shop-covers_price_was").addClass("sh-g-shop-covers_in");
                                    thisPrice.eq(m).find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").next(".sh-g-shop-covers_price_was").find(".sh-g-shop-covers_price").text(price);
                                }
                            }
                        }());
                        sucessCheck = true;   
                    }
                },10);
                
            }
        },

        stockSet : function(idx){

            var coverWrap = EMC_COMPONENT.elem._this.find(".sh-g-shop-covers_cover_list_wrap"),
                coverList = coverWrap.find(".sh-g-shop-covers_cover_list");

            var apiSuccessCheckInterval = setInterval(function () {
                if (EMC_COMPONENT.apiPriceSet.elem._successCheck === true) {
                    clearInterval(apiSuccessCheckInterval);
                    $.each(EMC_COMPONENT.productInfo[idx], function (i, v) {

                        for (var x = 0; x < EMC_COMPONENT.productInfo[idx][i].length; x++) {
                            if (EMC_COMPONENT.productInfo[idx][i][x].stock === "outOfStock") {
                                var thisWarp = coverList.eq(i);
                                thisWarp.find(".sh-g-shop-covers_color_chip li").eq(x).find("button").addClass("sh-g-shop-covers_btn_stock");
                            }
                        }
                    });
                    
                    coverList.each(function (i) {
                        if ($(this).find(".sh-g-shop-covers_color_chip li:first-child button").is(".sh-g-shop-covers_btn_stock") === true) {
                            $(this).find(".sh-g-shop-covers_btn_cart").css("display","none");
                            $(this).find(".sh-g-shop-covers_stock").addClass("sh-g-shop-covers_in");
                        }

                        var titName = $(this).find(".sh-g-shop-covers_title").text(),
                            colorName = $(this).find(".sh-g-shop-covers_color_item.sh-g-shop-covers_active").text();
                        
                        $(this).find(">a img").attr("alt",titName + " " + colorName + " placeholder image");

                        for (var a = 0; a < $(this).find(".sh-g-shop-covers_color_chip li").length; a++) {
                            if ($(this).find(".sh-g-shop-covers_color_chip li").eq(a).find(".sh-g-shop-covers_color_item").is(".sh-g-shop-covers_btn_stock") === false) {
                                if ($(this).find(".sh-g-shop-covers_color_chip li").eq(a).find(".sh-g-shop-covers_color_item").is(".sh-g-shop-covers_active") === true){
                                    $(this).find(".sh-g-shop-covers_color_chip li").eq(a).find(".sh-g-shop-covers_color_item em").text(" Selected");
                                }else{
                                    $(this).find(".sh-g-shop-covers_color_chip li").eq(a).find(".sh-g-shop-covers_color_item em").text(" Unselected");
                                }
                            } else {
                                if ($(this).find(".sh-g-shop-covers_color_chip li").eq(a).find(".sh-g-shop-covers_color_item").is(".sh-g-shop-covers_active") === true) {
                                    $(this).find(".sh-g-shop-covers_color_chip li").eq(a).find(".sh-g-shop-covers_color_item em").text(" Selected(out of stock)");
                                }else{
                                    $(this).find(".sh-g-shop-covers_color_chip li").eq(a).find(".sh-g-shop-covers_color_item em").text(" Unselected(out of stock)");
                                }
                            }
                        }
                    });
                }
            },10);

        },

        slide: {

            action: function () {
                var _this = $(".sh-g-shop-covers_cover_list_wrap"),
                    setting = {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: false,
                        dots: true,
                        arrows: false,
                        speed: 500,
                        rtl: EMC_COMPONENT.elem.rtl_check
                    },
                    name,
                    colorName;

                function indiAccess(_this) {
                    _this.find(".slick-dots button").each(function (i) {

                        name = $(this).parents(".sh-g-shop-covers_cover_list_wrap").find(".sh-g-shop-covers_cover_list").eq(i).find(".sh-g-shop-covers_title").text();
                        colorName = $(this).parents(".sh-g-shop-covers_cover_list_wrap").find(".sh-g-shop-covers_cover_list").eq(i).find(".sh-g-shop-covers_color_item.sh-g-shop-covers_active span").text();

                        if ($(this).parent().is(".slick-active") === true) {
                            $(this).html("Slide" + (i + 1) + " - " + name + " " + colorName + "<em class='blind'>selected</em>");
                        } else {
                            $(this).html("Slide" + (i + 1) + " - " + name + " " + colorName + "<em class='blind'>unselected</em>");
                        }
                    });
                }

                if (window.innerWidth <= 768) {
                    if (_this.is(".slick-initialized") === false) {
                        _this.slick(setting);
                    }

                    indiAccess($(document).find(".sh-g-shop-covers_cover_list_wrap"));

                    $(".sh-g-shop-covers_cover_list_wrap").on("afterChange", function () {
                        indiAccess($(this));
                    });
                } else {
                    if (_this.is(".slick-initialized") === true) {
                        _this.slick("unslick");
                    }
                }
            },

            resize: function () {
                this.action();
            }

        },

        clickEvent : function(idx){

            var btnIdx = 0;

            $(document).find(".sh-g-shop-covers_color_item").on("click",function(e){
                e.preventDefault();

                var idx = $(this).parents(".sh-g-shop-covers_covers_wrap").data("role-index"),
                    thisIdx = $(this).parents(".sh-g-shop-covers_cover_list").index(),
                    sIdx = $(this).parent("li").index(),
                    titName = "",
                    colorName = "";

                titName = $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_title").text();
                colorName = $(this).find(">span").text();

                $(this).parent().siblings().find("button").removeClass("sh-g-shop-covers_active");
                $(this).addClass("sh-g-shop-covers_active");

                $(this).parents(".sh-g-shop-covers_cover_list").find("figure > img").attr("data-src-pc", EMC_COMPONENT.productInfo[idx][thisIdx][sIdx].imgPathPc);
                $(this).parents(".sh-g-shop-covers_cover_list").find("figure > img").attr("data-src-mobile", EMC_COMPONENT.productInfo[idx][thisIdx][sIdx].imgPathMo);

                $(this).parents(".sh-g-shop-covers_cover_list").find(">a img").attr("alt", titName + " " + colorName + " placeholder image");
                $(this).parents(".sh-g-shop-covers_cover_list").find(">a").attr("data-omni", "accessories_view product detail|;" + EMC_COMPONENT.productInfo[idx][thisIdx][sIdx].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[idx][thisIdx][sIdx].code.toUpperCase());
                $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_btn_cart >a").attr("data-omni", ";" + EMC_COMPONENT.productInfo[idx][thisIdx][sIdx].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[idx][thisIdx][sIdx].code.toUpperCase());

                if (EMC_COMPONENT.productInfo[idx][thisIdx][0].promotionPrice === "" || EMC_COMPONENT.productInfo[idx][thisIdx][0].promotionPrice === undefined){
                    $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_price_was").removeClass("sh-g-shop-covers_in");
                    $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_price").text(EMC_COMPONENT.common.addComma(EMC_COMPONENT.productInfo[idx][thisIdx][0].price,$(document).find(".sh-g-shop-covers-currency").val())
                    );
                }else{
                    $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_price_was").addClass("sh-g-shop-covers_in");
                    $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_price_wrap > .sh-g-shop-covers_price").text();
                    $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_price_was sh-g-shop-covers_price").text(EMC_COMPONENT.common.addComma(EMC_COMPONENT.productInfo[idx][thisIdx][0].price, $(document).find(".sh-g-shop-covers-currency").val()));
                }

                if (EMC_COMPONENT.productInfo[idx][thisIdx][sIdx].stock === "outOfStock"){
                    $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_stock").addClass("sh-g-shop-covers_in");
                    $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_btn_cart").css("display","none");
                }else{
                    $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_stock").removeClass("sh-g-shop-covers_in");
                    $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_btn_cart").removeAttr("style");
                }

                if ($(this).is(".sh-g-shop-covers_btn_stock") === false) {
                    $(this).find("em.blind").text("Selected");
                } else {
                    $(this).find("em.blind").text("Selected(out of stock)");
                }

                if ($(this).parent().siblings().find(".sh-g-shop-covers_color_item").is(".sh-g-shop-covers_btn_stock") === false) {
                    $(this).parent().siblings().find(".sh-g-shop-covers_color_item em.blind").text("Unselected");
                } else {
                    $(this).parent().siblings().find(".sh-g-shop-covers_color_item em.blind").text("Unselected(out of stock)");
                }

                EMC_COMPONENT.common.imgResizeSrc();

                if (window.innerWidth < 769) {
                    var dotIdx = $(this).parents(".sh-g-shop-covers_cover_list_wrap").find(".slick-dots li.slick-active").index();
                    $(this).parents(".sh-g-shop-covers_cover_list_wrap").find(".slick-dots li.slick-active button").html("Slide" + (dotIdx + 1) + " - " + titName + " " + colorName + "<em class='blind'>selected</em>");
                }

            });

            $(document).find(".sh-g-shop-covers_btn_cart a").on("click",function(e){
                e.preventDefault();

                var idx = $(this).parents(".sh-g-shop-covers_covers_wrap").data("role-index"),
                    thisIdx = $(this).parents(".sh-g-shop-covers_cover_list").index(),
                    sIdx = $(this).parents(".sh-g-shop-covers_cover_list").find(".sh-g-shop-covers_color_chip .sh-g-shop-covers_active").parent().index();

                EMC_COMPONENT.elem.choice_product[idx] = [];
                EMC_COMPONENT.elem.choice_product[idx][thisIdx] = [];
                EMC_COMPONENT.elem.choice_product[idx][thisIdx].push(EMC_COMPONENT.productInfo[idx][thisIdx][sIdx].code.toUpperCase());
                EMC_COMPONENT.common.clickPreorder(idx,thisIdx);

                btnIdx = thisIdx;
            });

            $(document).on("click", ".sh-g-shop-covers_mini-cart-checkout-button", function (e) {
                e.preventDefault();
                location.href = EMC_COMPONENT.elem.api_url;
            });

            $(document).on("click",".sh-g-shop-covers_addtocart-continue-shopping",function(e){
                e.preventDefault();
                $(document).find(".sh-g-shop-covers_notification > .sh-g-shop-covers_modal").removeClass("sh-g-shop-covers_in");
                setTimeout(function () {
                    $(document).find(".sh-g-shop-covers_notification .sh-g-shop-covers_modal-backdrop").removeClass("sh-g-shop-covers_in");
                    $(document).find(".sh-g-shop-covers_notification").remove();
                }, 300);

                $(this).parents(".sh-g-shop-covers_covers_wrap").find(".sh-g-shop-covers_cover_list").eq(btnIdx).find(".sh-g-shop-covers_btn_cart > a").focus();
            });

        },

        keyboradEvent: function () {
            $(document).on("keydown", ".sh-g-shop-covers_addtocart-continue-shopping", function (e) {
                if(e.keyCode === 9){
                    e.preventDefault();
                    $(document).find(".sh-g-shop-covers_mini-cart-checkout-button").focus();
                }
            });
        },

        tagging:{

            slide: function(){
                if(window.innerWidth < 769) {
                    $(".sh-g-shop-covers_cover_list_wrap .slick-dots").each(function (i) {
                        $(this).find("li button").each(function(n){
                            $(this).attr("data-omni-type", "microsite_pcontentinter");
                            $(this).attr("data-omni", "gallery rolling:index_" + (n + 1));
                        });
                    });
                }
            }

        },

        init : function(){
            EMC_COMPONENT.elem._this = $(document).find(".sh-g-shop-covers_covers_wrap.section_" + (sectionIdx + 1));
            EMC_COMPONENT.productInfo[sectionIdx] = [];
            EMC_COMPONENT.elem.data_array[sectionIdx] = [];
            this.dataSet(sectionIdx);
            this.taggingSet(sectionIdx);
            this.apiPriceSet.setPrice(sectionIdx);
            this.stockSet(sectionIdx);
            this.resize();
            this.common.imgResizeSrc();
            this.clickEvent();
            this.keyboradEvent();
            this.tagging.slide();
            EMC_COMPONENT.slide.action();

            var apiSuccessInterval = setInterval(function () {
                if (sucessCheck === true) {
                    clearInterval(apiSuccessInterval);
                    if (sectionLength > sectionIdx) {
                        sectionIdx = sectionIdx + 1;
                        EMC_COMPONENT.elem._this = $(document).find(".sh-g-shop-covers_covers_wrap.section_" + (sectionIdx + 1));
                        EMC_COMPONENT.productInfo[sectionIdx] = [];
                        EMC_COMPONENT.elem.data_array[sectionIdx] = [];
                        EMC_COMPONENT.dataSet(sectionIdx);
                        EMC_COMPONENT.taggingSet(sectionIdx);
                        EMC_COMPONENT.apiPriceSet.setPrice(sectionIdx);
                        EMC_COMPONENT.stockSet(sectionIdx);
                        EMC_COMPONENT.tagging.slide();
                    }
                }
            }, 10);
        }


    }

    $(document).find(".sh-g-shop-covers_covers_wrap").each(function (i) {
        $(this).addClass("section_" + (i + 1));
        $(this).attr("data-role-index",i);
    });

    if (window.addEventListener) {
        window.addEventListener('DOMContentLoaded', EMC_COMPONENT.init(), false);
    } else if (window.attachEvent) {
        window.attachEvent('onload', function () {
            EMC_COMPONENT.init();
        });
    }


})(jQuery);
; (function (win,$) {
    /*! iScroll v5.1.3 ~ (c) 2008-2014 Matteo Spinelli ~ http://cubiq.org/license */
    (function (f, a, e) { var h = f.requestAnimationFrame || f.webkitRequestAnimationFrame || f.mozRequestAnimationFrame || f.oRequestAnimationFrame || f.msRequestAnimationFrame || function (i) { f.setTimeout(i, 1000 / 60) }; var c = (function () { var m = {}; var n = a.createElement("div").style; var k = (function () { var r = ["t", "webkitT", "MozT", "msT", "OT"], p, q = 0, o = r.length; for (; q < o; q++) { p = r[q] + "ransform"; if (p in n) { return r[q].substr(0, r[q].length - 1) } } return false })(); function l(o) { if (k === false) { return false } if (k === "") { return o } return k + o.charAt(0).toUpperCase() + o.substr(1) } m.getTime = Date.now || function i() { return new Date().getTime() }; m.extend = function (q, p) { for (var o in p) { q[o] = p[o] } }; m.addEvent = function (r, q, p, o) { r.addEventListener(q, p, !!o) }; m.removeEvent = function (r, q, p, o) { r.removeEventListener(q, p, !!o) }; m.prefixPointerEvent = function (o) { return f.MSPointerEvent ? "MSPointer" + o.charAt(9).toUpperCase() + o.substr(10) : o }; m.momentum = function (u, q, r, o, v, w) { var p = u - q, s = e.abs(p) / r, x, t; w = w === undefined ? 0.0006 : w; x = u + (s * s) / (2 * w) * (p < 0 ? -1 : 1); t = s / w; if (x < o) { x = v ? o - (v / 2.5 * (s / 8)) : o; p = e.abs(x - u); t = p / s } else { if (x > 0) { x = v ? v / 2.5 * (s / 8) : 0; p = e.abs(u) + x; t = p / s } } return { destination: e.round(x), duration: t } }; var j = l("transform"); m.extend(m, { hasTransform: j !== false, hasPerspective: l("perspective") in n, hasTouch: "ontouchstart" in f, hasPointer: f.PointerEvent || f.MSPointerEvent, hasTransition: l("transition") in n }); m.isBadAndroid = /Android /.test(f.navigator.appVersion) && !(/Chrome\/\d/.test(f.navigator.appVersion)); m.extend(m.style = {}, { transform: j, transitionTimingFunction: l("transitionTimingFunction"), transitionDuration: l("transitionDuration"), transitionDelay: l("transitionDelay"), transformOrigin: l("transformOrigin") }); m.hasClass = function (p, q) { var o = new RegExp("(^|\\s)" + q + "(\\s|$)"); return o.test(p.className) }; m.addClass = function (p, q) { if (m.hasClass(p, q)) { return } var o = p.className.split(" "); o.push(q); p.className = o.join(" ") }; m.removeClass = function (p, q) { if (!m.hasClass(p, q)) { return } var o = new RegExp("(^|\\s)" + q + "(\\s|$)", "g"); p.className = p.className.replace(o, " ") }; m.offset = function (o) { var q = -o.offsetLeft, p = -o.offsetTop; while (o = o.offsetParent) { q -= o.offsetLeft; p -= o.offsetTop } return { left: q, top: p } }; m.preventDefaultException = function (q, p) { for (var o in p) { if (p[o].test(q[o])) { return true } } return false }; m.extend(m.eventType = {}, { touchstart: 1, touchmove: 1, touchend: 1, mousedown: 2, mousemove: 2, mouseup: 2, pointerdown: 3, pointermove: 3, pointerup: 3, MSPointerDown: 3, MSPointerMove: 3, MSPointerUp: 3 }); m.extend(m.ease = {}, { quadratic: { style: "cubic-bezier(0.25, 0.46, 0.45, 0.94)", fn: function (o) { return o * (2 - o) } }, circular: { style: "cubic-bezier(0.1, 0.57, 0.1, 1)", fn: function (o) { return e.sqrt(1 - (--o * o)) } }, back: { style: "cubic-bezier(0.175, 0.885, 0.32, 1.275)", fn: function (p) { var o = 4; return (p = p - 1) * p * ((o + 1) * p + o) + 1 } }, bounce: { style: "", fn: function (o) { if ((o /= 1) < (1 / 2.75)) { return 7.5625 * o * o } else { if (o < (2 / 2.75)) { return 7.5625 * (o -= (1.5 / 2.75)) * o + 0.75 } else { if (o < (2.5 / 2.75)) { return 7.5625 * (o -= (2.25 / 2.75)) * o + 0.9375 } else { return 7.5625 * (o -= (2.625 / 2.75)) * o + 0.984375 } } } } }, elastic: { style: "", fn: function (o) { var p = 0.22, q = 0.4; if (o === 0) { return 0 } if (o == 1) { return 1 } return (q * e.pow(2, -10 * o) * e.sin((o - p / 4) * (2 * e.PI) / p) + 1) } } }); m.tap = function (q, o) { var p = a.createEvent("Event"); p.initEvent(o, true, true); p.pageX = q.pageX; p.pageY = q.pageY; q.target.dispatchEvent(p) }; m.click = function (q) { var p = q.target, o; if (!(/(SELECT|INPUT|TEXTAREA)/i).test(p.tagName)) { o = a.createEvent("MouseEvents"); o.initMouseEvent("click", true, true, q.view, 1, p.screenX, p.screenY, p.clientX, p.clientY, q.ctrlKey, q.altKey, q.shiftKey, q.metaKey, 0, null); o._constructed = true; p.dispatchEvent(o) } }; return m })(); function g(l, j) { this.wrapper = typeof l == "string" ? a.querySelector(l) : l; this.scroller = this.wrapper.children[0]; this.scrollerStyle = this.scroller.style; this.options = { resizeScrollbars: true, mouseWheelSpeed: 20, snapThreshold: 0.334, startX: 0, startY: 0, scrollY: true, directionLockThreshold: 5, momentum: true, bounce: true, bounceTime: 600, bounceEasing: "", preventDefault: true, preventDefaultException: { tagName: /^(INPUT|TEXTAREA|BUTTON|SELECT)$/ }, HWCompositing: true, useTransition: true, useTransform: true }; for (var k in j) { this.options[k] = j[k] } this.translateZ = this.options.HWCompositing && c.hasPerspective ? " translateZ(0)" : ""; this.options.useTransition = c.hasTransition && this.options.useTransition; this.options.useTransform = c.hasTransform && this.options.useTransform; this.options.eventPassthrough = this.options.eventPassthrough === true ? "vertical" : this.options.eventPassthrough; this.options.preventDefault = !this.options.eventPassthrough && this.options.preventDefault; this.options.scrollY = this.options.eventPassthrough == "vertical" ? false : this.options.scrollY; this.options.scrollX = this.options.eventPassthrough == "horizontal" ? false : this.options.scrollX; this.options.freeScroll = this.options.freeScroll && !this.options.eventPassthrough; this.options.directionLockThreshold = this.options.eventPassthrough ? 0 : this.options.directionLockThreshold; this.options.bounceEasing = typeof this.options.bounceEasing == "string" ? c.ease[this.options.bounceEasing] || c.ease.circular : this.options.bounceEasing; this.options.resizePolling = this.options.resizePolling === undefined ? 60 : this.options.resizePolling; if (this.options.tap === true) { this.options.tap = "tap" } if (this.options.shrinkScrollbars == "scale") { this.options.useTransition = false } this.options.invertWheelDirection = this.options.invertWheelDirection ? -1 : 1; this.x = 0; this.y = 0; this.directionX = 0; this.directionY = 0; this._events = {}; this._init(); this.refresh(); this.scrollTo(this.options.startX, this.options.startY); this.enable() } g.prototype = { version: "5.1.3", _init: function () { this._initEvents(); if (this.options.scrollbars || this.options.indicators) { this._initIndicators() } if (this.options.mouseWheel) { this._initWheel() } if (this.options.snap) { this._initSnap() } if (this.options.keyBindings) { this._initKeys() } }, destroy: function () { this._initEvents(true); this._execEvent("destroy") }, _transitionEnd: function (i) { if (i.target != this.scroller || !this.isInTransition) { return } this._transitionTime(); if (!this.resetPosition(this.options.bounceTime)) { this.isInTransition = false; this._execEvent("scrollEnd") } }, _start: function (j) { if (c.eventType[j.type] != 1) { if (j.button !== 0) { return } } if (!this.enabled || (this.initiated && c.eventType[j.type] !== this.initiated)) { return } if (this.options.preventDefault && !c.isBadAndroid && !c.preventDefaultException(j.target, this.options.preventDefaultException)) { j.preventDefault() } var i = j.touches ? j.touches[0] : j, k; this.initiated = c.eventType[j.type]; this.moved = false; this.distX = 0; this.distY = 0; this.directionX = 0; this.directionY = 0; this.directionLocked = 0; this._transitionTime(); this.startTime = c.getTime(); if (this.options.useTransition && this.isInTransition) { this.isInTransition = false; k = this.getComputedPosition(); this._translate(e.round(k.x), e.round(k.y)); this._execEvent("scrollEnd") } else { if (!this.options.useTransition && this.isAnimating) { this.isAnimating = false; this._execEvent("scrollEnd") } } this.startX = this.x; this.startY = this.y; this.absStartX = this.x; this.absStartY = this.y; this.pointX = i.pageX; this.pointY = i.pageY; this._execEvent("beforeScrollStart") }, _move: function (n) { if (!this.enabled || c.eventType[n.type] !== this.initiated) { return } if (this.options.preventDefault) { n.preventDefault() } var p = n.touches ? n.touches[0] : n, k = p.pageX - this.pointX, j = p.pageY - this.pointY, o = c.getTime(), i, q, m, l; this.pointX = p.pageX; this.pointY = p.pageY; this.distX += k; this.distY += j; m = e.abs(this.distX); l = e.abs(this.distY); if (o - this.endTime > 300 && (m < 10 && l < 10)) { return } if (!this.directionLocked && !this.options.freeScroll) { if (m > l + this.options.directionLockThreshold) { this.directionLocked = "h" } else { if (l >= m + this.options.directionLockThreshold) { this.directionLocked = "v" } else { this.directionLocked = "n" } } } if (this.directionLocked == "h") { if (this.options.eventPassthrough == "vertical") { n.preventDefault() } else { if (this.options.eventPassthrough == "horizontal") { this.initiated = false; return } } j = 0 } else { if (this.directionLocked == "v") { if (this.options.eventPassthrough == "horizontal") { n.preventDefault() } else { if (this.options.eventPassthrough == "vertical") { this.initiated = false; return } } k = 0 } } k = this.hasHorizontalScroll ? k : 0; j = this.hasVerticalScroll ? j : 0; i = this.x + k; q = this.y + j; if (i > 0 || i < this.maxScrollX) { i = this.options.bounce ? this.x + k / 3 : i > 0 ? 0 : this.maxScrollX } if (q > 0 || q < this.maxScrollY) { q = this.options.bounce ? this.y + j / 3 : q > 0 ? 0 : this.maxScrollY } this.directionX = k > 0 ? -1 : k < 0 ? 1 : 0; this.directionY = j > 0 ? -1 : j < 0 ? 1 : 0; if (!this.moved) { this._execEvent("scrollStart") } this.moved = true; this._translate(i, q); if (o - this.startTime > 300) { this.startTime = o; this.startX = this.x; this.startY = this.y } }, _end: function (o) { if (!this.enabled || c.eventType[o.type] !== this.initiated) { return } if (this.options.preventDefault && !c.preventDefaultException(o.target, this.options.preventDefaultException)) { o.preventDefault() } var q = o.changedTouches ? o.changedTouches[0] : o, k, j, n = c.getTime() - this.startTime, i = e.round(this.x), t = e.round(this.y), s = e.abs(i - this.startX), r = e.abs(t - this.startY), l = 0, p = ""; this.isInTransition = 0; this.initiated = 0; this.endTime = c.getTime(); if (this.resetPosition(this.options.bounceTime)) { return } this.scrollTo(i, t); if (!this.moved) { if (this.options.tap) { c.tap(o, this.options.tap) } if (this.options.click) { c.click(o) } this._execEvent("scrollCancel"); return } if (this._events.flick && n < 200 && s < 100 && r < 100) { this._execEvent("flick"); return } if (this.options.momentum && n < 300) { k = this.hasHorizontalScroll ? c.momentum(this.x, this.startX, n, this.maxScrollX, this.options.bounce ? this.wrapperWidth : 0, this.options.deceleration) : { destination: i, duration: 0 }; j = this.hasVerticalScroll ? c.momentum(this.y, this.startY, n, this.maxScrollY, this.options.bounce ? this.wrapperHeight : 0, this.options.deceleration) : { destination: t, duration: 0 }; i = k.destination; t = j.destination; l = e.max(k.duration, j.duration); this.isInTransition = 1 } if (this.options.snap) { var m = this._nearestSnap(i, t); this.currentPage = m; l = this.options.snapSpeed || e.max(e.max(e.min(e.abs(i - m.x), 1000), e.min(e.abs(t - m.y), 1000)), 300); i = m.x; t = m.y; this.directionX = 0; this.directionY = 0; p = this.options.bounceEasing } if (i != this.x || t != this.y) { if (i > 0 || i < this.maxScrollX || t > 0 || t < this.maxScrollY) { p = c.ease.quadratic } this.scrollTo(i, t, l, p); return } this._execEvent("scrollEnd") }, _resize: function () { var i = this; clearTimeout(this.resizeTimeout); this.resizeTimeout = setTimeout(function () { i.refresh() }, this.options.resizePolling) }, resetPosition: function (j) { var i = this.x, k = this.y; j = j || 0; if (!this.hasHorizontalScroll || this.x > 0) { i = 0 } else { if (this.x < this.maxScrollX) { i = this.maxScrollX } } if (!this.hasVerticalScroll || this.y > 0) { k = 0 } else { if (this.y < this.maxScrollY) { k = this.maxScrollY } } if (i == this.x && k == this.y) { return false } this.scrollTo(i, k, j, this.options.bounceEasing); return true }, disable: function () { this.enabled = false }, enable: function () { this.enabled = true }, refresh: function () { var i = this.wrapper.offsetHeight; this.wrapperWidth = this.wrapper.clientWidth; this.wrapperHeight = this.wrapper.clientHeight; this.scrollerWidth = this.scroller.offsetWidth; this.scrollerHeight = this.scroller.offsetHeight; this.maxScrollX = this.wrapperWidth - this.scrollerWidth; this.maxScrollY = this.wrapperHeight - this.scrollerHeight; this.hasHorizontalScroll = this.options.scrollX && this.maxScrollX < 0; this.hasVerticalScroll = this.options.scrollY && this.maxScrollY < 0; if (!this.hasHorizontalScroll) { this.maxScrollX = 0; this.scrollerWidth = this.wrapperWidth } if (!this.hasVerticalScroll) { this.maxScrollY = 0; this.scrollerHeight = this.wrapperHeight } this.endTime = 0; this.directionX = 0; this.directionY = 0; this.wrapperOffset = c.offset(this.wrapper); this._execEvent("refresh"); this.resetPosition() }, on: function (j, i) { if (!this._events[j]) { this._events[j] = [] } this._events[j].push(i) }, off: function (k, j) { if (!this._events[k]) { return } var i = this._events[k].indexOf(j); if (i > -1) { this._events[k].splice(i, 1) } }, _execEvent: function (m) { if (!this._events[m]) { return } var k = 0, j = this._events[m].length; if (!j) { return } for (; k < j; k++) { this._events[m][k].apply(this, [].slice.call(arguments, 1)) } }, scrollBy: function (i, l, j, k) { i = this.x + i; l = this.y + l; j = j || 0; this.scrollTo(i, l, j, k) }, scrollTo: function (i, l, j, k) { k = k || c.ease.circular; this.isInTransition = this.options.useTransition && j > 0; if (!j || (this.options.useTransition && k.style)) { this._transitionTimingFunction(k.style); this._transitionTime(j); this._translate(i, l) } else { this._animate(i, l, j, k.fn) } }, scrollToElement: function (j, k, i, n, m) { j = j.nodeType ? j : this.scroller.querySelector(j); if (!j) { return } var l = c.offset(j); l.left -= this.wrapperOffset.left; l.top -= this.wrapperOffset.top; if (i === true) { i = e.round(j.offsetWidth / 2 - this.wrapper.offsetWidth / 2) } if (n === true) { n = e.round(j.offsetHeight / 2 - this.wrapper.offsetHeight / 2) } l.left -= i || 0; l.top -= n || 0; l.left = l.left > 0 ? 0 : l.left < this.maxScrollX ? this.maxScrollX : l.left; l.top = l.top > 0 ? 0 : l.top < this.maxScrollY ? this.maxScrollY : l.top; k = k === undefined || k === null || k === "auto" ? e.max(e.abs(this.x - l.left), e.abs(this.y - l.top)) : k; this.scrollTo(l.left, l.top, k, m) }, _transitionTime: function (k) { k = k || 0; this.scrollerStyle[c.style.transitionDuration] = k + "ms"; if (!k && c.isBadAndroid) { this.scrollerStyle[c.style.transitionDuration] = "0.001s" } if (this.indicators) { for (var j = this.indicators.length; j--;) { this.indicators[j].transitionTime(k) } } }, _transitionTimingFunction: function (k) { this.scrollerStyle[c.style.transitionTimingFunction] = k; if (this.indicators) { for (var j = this.indicators.length; j--;) { this.indicators[j].transitionTimingFunction(k) } } }, _translate: function (j, l) { if (this.options.useTransform) { this.scrollerStyle[c.style.transform] = "translate(" + j + "px," + l + "px)" + this.translateZ } else { j = e.round(j); l = e.round(l); this.scrollerStyle.left = j + "px"; this.scrollerStyle.top = l + "px" } this.x = j; this.y = l; if (this.indicators) { for (var k = this.indicators.length; k--;) { this.indicators[k].updatePosition() } } }, _initEvents: function (i) { var j = i ? c.removeEvent : c.addEvent, k = this.options.bindToWrapper ? this.wrapper : f; j(f, "orientationchange", this); j(f, "resize", this); if (this.options.click) { j(this.wrapper, "click", this, true) } if (!this.options.disableMouse) { j(this.wrapper, "mousedown", this); j(k, "mousemove", this); j(k, "mousecancel", this); j(k, "mouseup", this) } if (c.hasPointer && !this.options.disablePointer) { j(this.wrapper, c.prefixPointerEvent("pointerdown"), this); j(k, c.prefixPointerEvent("pointermove"), this); j(k, c.prefixPointerEvent("pointercancel"), this); j(k, c.prefixPointerEvent("pointerup"), this) } if (c.hasTouch && !this.options.disableTouch) { j(this.wrapper, "touchstart", this); j(k, "touchmove", this); j(k, "touchcancel", this); j(k, "touchend", this) } j(this.scroller, "transitionend", this); j(this.scroller, "webkitTransitionEnd", this); j(this.scroller, "oTransitionEnd", this); j(this.scroller, "MSTransitionEnd", this) }, getComputedPosition: function () { var j = f.getComputedStyle(this.scroller, null), i, k; if (this.options.useTransform) { j = j[c.style.transform].split(")")[0].split(", "); i = +(j[12] || j[4]); k = +(j[13] || j[5]) } else { i = +j.left.replace(/[^-\d.]/g, ""); k = +j.top.replace(/[^-\d.]/g, "") } return { x: i, y: k } }, _initIndicators: function () { var l = this.options.interactiveScrollbars, n = typeof this.options.scrollbars != "string", p = [], k; var o = this; this.indicators = []; if (this.options.scrollbars) { if (this.options.scrollY) { k = { el: d("v", l, this.options.scrollbars), interactive: l, defaultScrollbars: true, customStyle: n, resize: this.options.resizeScrollbars, shrink: this.options.shrinkScrollbars, fade: this.options.fadeScrollbars, listenX: false }; this.wrapper.appendChild(k.el); p.push(k) } if (this.options.scrollX) { k = { el: d("h", l, this.options.scrollbars), interactive: l, defaultScrollbars: true, customStyle: n, resize: this.options.resizeScrollbars, shrink: this.options.shrinkScrollbars, fade: this.options.fadeScrollbars, listenY: false }; this.wrapper.appendChild(k.el); p.push(k) } } if (this.options.indicators) { p = p.concat(this.options.indicators) } for (var m = p.length; m--;) { this.indicators.push(new b(this, p[m])) } function j(r) { for (var q = o.indicators.length; q--;) { r.call(o.indicators[q]) } } if (this.options.fadeScrollbars) { this.on("scrollEnd", function () { j(function () { this.fade() }) }); this.on("scrollCancel", function () { j(function () { this.fade() }) }); this.on("scrollStart", function () { j(function () { this.fade(1) }) }); this.on("beforeScrollStart", function () { j(function () { this.fade(1, true) }) }) } this.on("refresh", function () { j(function () { this.refresh() }) }); this.on("destroy", function () { j(function () { this.destroy() }); delete this.indicators }) }, _initWheel: function () { c.addEvent(this.wrapper, "wheel", this); c.addEvent(this.wrapper, "mousewheel", this); c.addEvent(this.wrapper, "DOMMouseScroll", this); this.on("destroy", function () { c.removeEvent(this.wrapper, "wheel", this); c.removeEvent(this.wrapper, "mousewheel", this); c.removeEvent(this.wrapper, "DOMMouseScroll", this) }) }, _wheel: function (m) { if (!this.enabled) { return } m.preventDefault(); m.stopPropagation(); var k, j, n, l, i = this; if (this.wheelTimeout === undefined) { i._execEvent("scrollStart") } clearTimeout(this.wheelTimeout); this.wheelTimeout = setTimeout(function () { i._execEvent("scrollEnd"); i.wheelTimeout = undefined }, 400); if ("deltaX" in m) { if (m.deltaMode === 1) { k = -m.deltaX * this.options.mouseWheelSpeed; j = -m.deltaY * this.options.mouseWheelSpeed } else { k = -m.deltaX; j = -m.deltaY } } else { if ("wheelDeltaX" in m) { k = m.wheelDeltaX / 120 * this.options.mouseWheelSpeed; j = m.wheelDeltaY / 120 * this.options.mouseWheelSpeed } else { if ("wheelDelta" in m) { k = j = m.wheelDelta / 120 * this.options.mouseWheelSpeed } else { if ("detail" in m) { k = j = -m.detail / 3 * this.options.mouseWheelSpeed } else { return } } } } k *= this.options.invertWheelDirection; j *= this.options.invertWheelDirection; if (!this.hasVerticalScroll) { k = j; j = 0 } if (this.options.snap) { n = this.currentPage.pageX; l = this.currentPage.pageY; if (k > 0) { n-- } else { if (k < 0) { n++ } } if (j > 0) { l-- } else { if (j < 0) { l++ } } this.goToPage(n, l); return } n = this.x + e.round(this.hasHorizontalScroll ? k : 0); l = this.y + e.round(this.hasVerticalScroll ? j : 0); if (n > 0) { n = 0 } else { if (n < this.maxScrollX) { n = this.maxScrollX } } if (l > 0) { l = 0 } else { if (l < this.maxScrollY) { l = this.maxScrollY } } this.scrollTo(n, l, 0) }, _initSnap: function () { this.currentPage = {}; if (typeof this.options.snap == "string") { this.options.snap = this.scroller.querySelectorAll(this.options.snap) } this.on("refresh", function () { var s = 0, q, o = 0, k, r, p, u = 0, t, w = this.options.snapStepX || this.wrapperWidth, v = this.options.snapStepY || this.wrapperHeight, j; this.pages = []; if (!this.wrapperWidth || !this.wrapperHeight || !this.scrollerWidth || !this.scrollerHeight) { return } if (this.options.snap === true) { r = e.round(w / 2); p = e.round(v / 2); while (u > -this.scrollerWidth) { this.pages[s] = []; q = 0; t = 0; while (t > -this.scrollerHeight) { this.pages[s][q] = { x: e.max(u, this.maxScrollX), y: e.max(t, this.maxScrollY), width: w, height: v, cx: u - r, cy: t - p }; t -= v; q++ } u -= w; s++ } } else { j = this.options.snap; q = j.length; k = -1; for (; s < q; s++) { if (s === 0 || j[s].offsetLeft <= j[s - 1].offsetLeft) { o = 0; k++ } if (!this.pages[o]) { this.pages[o] = [] } u = e.max(-j[s].offsetLeft, this.maxScrollX); t = e.max(-j[s].offsetTop, this.maxScrollY); r = u - e.round(j[s].offsetWidth / 2); p = t - e.round(j[s].offsetHeight / 2); this.pages[o][k] = { x: u, y: t, width: j[s].offsetWidth, height: j[s].offsetHeight, cx: r, cy: p }; if (u > this.maxScrollX) { o++ } } } this.goToPage(this.currentPage.pageX || 0, this.currentPage.pageY || 0, 0); if (this.options.snapThreshold % 1 === 0) { this.snapThresholdX = this.options.snapThreshold; this.snapThresholdY = this.options.snapThreshold } else { this.snapThresholdX = e.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].width * this.options.snapThreshold); this.snapThresholdY = e.round(this.pages[this.currentPage.pageX][this.currentPage.pageY].height * this.options.snapThreshold) } }); this.on("flick", function () { var i = this.options.snapSpeed || e.max(e.max(e.min(e.abs(this.x - this.startX), 1000), e.min(e.abs(this.y - this.startY), 1000)), 300); this.goToPage(this.currentPage.pageX + this.directionX, this.currentPage.pageY + this.directionY, i) }) }, _nearestSnap: function (k, p) { if (!this.pages.length) { return { x: 0, y: 0, pageX: 0, pageY: 0 } } var o = 0, n = this.pages.length, j = 0; if (e.abs(k - this.absStartX) < this.snapThresholdX && e.abs(p - this.absStartY) < this.snapThresholdY) { return this.currentPage } if (k > 0) { k = 0 } else { if (k < this.maxScrollX) { k = this.maxScrollX } } if (p > 0) { p = 0 } else { if (p < this.maxScrollY) { p = this.maxScrollY } } for (; o < n; o++) { if (k >= this.pages[o][0].cx) { k = this.pages[o][0].x; break } } n = this.pages[o].length; for (; j < n; j++) { if (p >= this.pages[0][j].cy) { p = this.pages[0][j].y; break } } if (o == this.currentPage.pageX) { o += this.directionX; if (o < 0) { o = 0 } else { if (o >= this.pages.length) { o = this.pages.length - 1 } } k = this.pages[o][0].x } if (j == this.currentPage.pageY) { j += this.directionY; if (j < 0) { j = 0 } else { if (j >= this.pages[0].length) { j = this.pages[0].length - 1 } } p = this.pages[0][j].y } return { x: k, y: p, pageX: o, pageY: j } }, goToPage: function (i, n, j, m) { m = m || this.options.bounceEasing; if (i >= this.pages.length) { i = this.pages.length - 1 } else { if (i < 0) { i = 0 } } if (n >= this.pages[i].length) { n = this.pages[i].length - 1 } else { if (n < 0) { n = 0 } } var l = this.pages[i][n].x, k = this.pages[i][n].y; j = j === undefined ? this.options.snapSpeed || e.max(e.max(e.min(e.abs(l - this.x), 1000), e.min(e.abs(k - this.y), 1000)), 300) : j; this.currentPage = { x: l, y: k, pageX: i, pageY: n }; this.scrollTo(l, k, j, m) }, next: function (j, l) { var i = this.currentPage.pageX, k = this.currentPage.pageY; i++; if (i >= this.pages.length && this.hasVerticalScroll) { i = 0; k++ } this.goToPage(i, k, j, l) }, prev: function (j, l) { var i = this.currentPage.pageX, k = this.currentPage.pageY; i--; if (i < 0 && this.hasVerticalScroll) { i = 0; k-- } this.goToPage(i, k, j, l) }, _initKeys: function (l) { var k = { pageUp: 33, pageDown: 34, end: 35, home: 36, left: 37, up: 38, right: 39, down: 40 }; var j; if (typeof this.options.keyBindings == "object") { for (j in this.options.keyBindings) { if (typeof this.options.keyBindings[j] == "string") { this.options.keyBindings[j] = this.options.keyBindings[j].toUpperCase().charCodeAt(0) } } } else { this.options.keyBindings = {} } for (j in k) { this.options.keyBindings[j] = this.options.keyBindings[j] || k[j] } c.addEvent(f, "keydown", this); this.on("destroy", function () { c.removeEvent(f, "keydown", this) }) }, _key: function (n) { if (!this.enabled) { return } var i = this.options.snap, o = i ? this.currentPage.pageX : this.x, m = i ? this.currentPage.pageY : this.y, k = c.getTime(), j = this.keyTime || 0, l = 0.25, p; if (this.options.useTransition && this.isInTransition) { p = this.getComputedPosition(); this._translate(e.round(p.x), e.round(p.y)); this.isInTransition = false } this.keyAcceleration = k - j < 200 ? e.min(this.keyAcceleration + l, 50) : 0; switch (n.keyCode) { case this.options.keyBindings.pageUp: if (this.hasHorizontalScroll && !this.hasVerticalScroll) { o += i ? 1 : this.wrapperWidth } else { m += i ? 1 : this.wrapperHeight } break; case this.options.keyBindings.pageDown: if (this.hasHorizontalScroll && !this.hasVerticalScroll) { o -= i ? 1 : this.wrapperWidth } else { m -= i ? 1 : this.wrapperHeight } break; case this.options.keyBindings.end: o = i ? this.pages.length - 1 : this.maxScrollX; m = i ? this.pages[0].length - 1 : this.maxScrollY; break; case this.options.keyBindings.home: o = 0; m = 0; break; case this.options.keyBindings.left: o += i ? -1 : 5 + this.keyAcceleration >> 0; break; case this.options.keyBindings.up: m += i ? 1 : 5 + this.keyAcceleration >> 0; break; case this.options.keyBindings.right: o -= i ? -1 : 5 + this.keyAcceleration >> 0; break; case this.options.keyBindings.down: m -= i ? 1 : 5 + this.keyAcceleration >> 0; break; default: return }if (i) { this.goToPage(o, m); return } if (o > 0) { o = 0; this.keyAcceleration = 0 } else { if (o < this.maxScrollX) { o = this.maxScrollX; this.keyAcceleration = 0 } } if (m > 0) { m = 0; this.keyAcceleration = 0 } else { if (m < this.maxScrollY) { m = this.maxScrollY; this.keyAcceleration = 0 } } this.scrollTo(o, m, 0); this.keyTime = k }, _animate: function (r, q, l, i) { var o = this, n = this.x, m = this.y, j = c.getTime(), p = j + l; function k() { var s = c.getTime(), u, t, v; if (s >= p) { o.isAnimating = false; o._translate(r, q); if (!o.resetPosition(o.options.bounceTime)) { o._execEvent("scrollEnd") } return } s = (s - j) / l; v = i(s); u = (r - n) * v + n; t = (q - m) * v + m; o._translate(u, t); if (o.isAnimating) { h(k) } } this.isAnimating = true; k() }, handleEvent: function (i) { switch (i.type) { case "touchstart": case "pointerdown": case "MSPointerDown": case "mousedown": this._start(i); break; case "touchmove": case "pointermove": case "MSPointerMove": case "mousemove": this._move(i); break; case "touchend": case "pointerup": case "MSPointerUp": case "mouseup": case "touchcancel": case "pointercancel": case "MSPointerCancel": case "mousecancel": this._end(i); break; case "orientationchange": case "resize": this._resize(); break; case "transitionend": case "webkitTransitionEnd": case "oTransitionEnd": case "MSTransitionEnd": this._transitionEnd(i); break; case "wheel": case "DOMMouseScroll": case "mousewheel": this._wheel(i); break; case "keydown": this._key(i); break; case "click": if (!i._constructed) { i.preventDefault(); i.stopPropagation() } break } } }; function d(l, j, k) { var m = a.createElement("div"), i = a.createElement("div"); if (k === true) { m.style.cssText = "position:absolute;z-index:9999"; i.style.cssText = "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;background:rgba(0,0,0,0.5);border:1px solid rgba(255,255,255,0.9);border-radius:3px" } i.className = "iScrollIndicator"; if (l == "h") { if (k === true) { m.style.cssText += ";height:7px;left:2px;right:2px;bottom:0"; i.style.height = "100%" } m.className = "iScrollHorizontalScrollbar" } else { if (k === true) { m.style.cssText += ";width:7px;bottom:2px;top:2px;right:1px"; i.style.width = "100%" } m.className = "iScrollVerticalScrollbar" } m.style.cssText += ";overflow:hidden"; if (!j) { m.style.pointerEvents = "none" } m.appendChild(i); return m } function b(j, k) { this.wrapper = typeof k.el == "string" ? a.querySelector(k.el) : k.el; this.wrapperStyle = this.wrapper.style; this.indicator = this.wrapper.children[0]; this.indicatorStyle = this.indicator.style; this.scroller = j; this.options = { listenX: true, listenY: true, interactive: false, resize: true, defaultScrollbars: false, shrink: false, fade: false, speedRatioX: 0, speedRatioY: 0 }; for (var l in k) { this.options[l] = k[l] } this.sizeRatioX = 1; this.sizeRatioY = 1; this.maxPosX = 0; this.maxPosY = 0; if (this.options.interactive) { if (!this.options.disableTouch) { c.addEvent(this.indicator, "touchstart", this); c.addEvent(f, "touchend", this) } if (!this.options.disablePointer) { c.addEvent(this.indicator, c.prefixPointerEvent("pointerdown"), this); c.addEvent(f, c.prefixPointerEvent("pointerup"), this) } if (!this.options.disableMouse) { c.addEvent(this.indicator, "mousedown", this); c.addEvent(f, "mouseup", this) } } if (this.options.fade) { this.wrapperStyle[c.style.transform] = this.scroller.translateZ; this.wrapperStyle[c.style.transitionDuration] = c.isBadAndroid ? "0.001s" : "0ms"; this.wrapperStyle.opacity = "0" } } b.prototype = { handleEvent: function (i) { switch (i.type) { case "touchstart": case "pointerdown": case "MSPointerDown": case "mousedown": this._start(i); break; case "touchmove": case "pointermove": case "MSPointerMove": case "mousemove": this._move(i); break; case "touchend": case "pointerup": case "MSPointerUp": case "mouseup": case "touchcancel": case "pointercancel": case "MSPointerCancel": case "mousecancel": this._end(i); break } }, destroy: function () { if (this.options.interactive) { c.removeEvent(this.indicator, "touchstart", this); c.removeEvent(this.indicator, c.prefixPointerEvent("pointerdown"), this); c.removeEvent(this.indicator, "mousedown", this); c.removeEvent(f, "touchmove", this); c.removeEvent(f, c.prefixPointerEvent("pointermove"), this); c.removeEvent(f, "mousemove", this); c.removeEvent(f, "touchend", this); c.removeEvent(f, c.prefixPointerEvent("pointerup"), this); c.removeEvent(f, "mouseup", this) } if (this.options.defaultScrollbars) { this.wrapper.parentNode.removeChild(this.wrapper) } }, _start: function (j) { var i = j.touches ? j.touches[0] : j; j.preventDefault(); j.stopPropagation(); this.transitionTime(); this.initiated = true; this.moved = false; this.lastPointX = i.pageX; this.lastPointY = i.pageY; this.startTime = c.getTime(); if (!this.options.disableTouch) { c.addEvent(f, "touchmove", this) } if (!this.options.disablePointer) { c.addEvent(f, c.prefixPointerEvent("pointermove"), this) } if (!this.options.disableMouse) { c.addEvent(f, "mousemove", this) } this.scroller._execEvent("beforeScrollStart") }, _move: function (n) { var j = n.touches ? n.touches[0] : n, k, i, o, m, l = c.getTime(); if (!this.moved) { this.scroller._execEvent("scrollStart") } this.moved = true; k = j.pageX - this.lastPointX; this.lastPointX = j.pageX; i = j.pageY - this.lastPointY; this.lastPointY = j.pageY; o = this.x + k; m = this.y + i; this._pos(o, m); n.preventDefault(); n.stopPropagation() }, _end: function (k) { if (!this.initiated) { return } this.initiated = false; k.preventDefault(); k.stopPropagation(); c.removeEvent(f, "touchmove", this); c.removeEvent(f, c.prefixPointerEvent("pointermove"), this); c.removeEvent(f, "mousemove", this); if (this.scroller.options.snap) { var i = this.scroller._nearestSnap(this.scroller.x, this.scroller.y); var j = this.options.snapSpeed || e.max(e.max(e.min(e.abs(this.scroller.x - i.x), 1000), e.min(e.abs(this.scroller.y - i.y), 1000)), 300); if (this.scroller.x != i.x || this.scroller.y != i.y) { this.scroller.directionX = 0; this.scroller.directionY = 0; this.scroller.currentPage = i; this.scroller.scrollTo(i.x, i.y, j, this.scroller.options.bounceEasing) } } if (this.moved) { this.scroller._execEvent("scrollEnd") } }, transitionTime: function (i) { i = i || 0; this.indicatorStyle[c.style.transitionDuration] = i + "ms"; if (!i && c.isBadAndroid) { this.indicatorStyle[c.style.transitionDuration] = "0.001s" } }, transitionTimingFunction: function (i) { this.indicatorStyle[c.style.transitionTimingFunction] = i }, refresh: function () { this.transitionTime(); if (this.options.listenX && !this.options.listenY) { this.indicatorStyle.display = this.scroller.hasHorizontalScroll ? "block" : "none" } else { if (this.options.listenY && !this.options.listenX) { this.indicatorStyle.display = this.scroller.hasVerticalScroll ? "block" : "none" } else { this.indicatorStyle.display = this.scroller.hasHorizontalScroll || this.scroller.hasVerticalScroll ? "block" : "none" } } if (this.scroller.hasHorizontalScroll && this.scroller.hasVerticalScroll) { c.addClass(this.wrapper, "iScrollBothScrollbars"); c.removeClass(this.wrapper, "iScrollLoneScrollbar"); if (this.options.defaultScrollbars && this.options.customStyle) { if (this.options.listenX) { this.wrapper.style.right = "8px" } else { this.wrapper.style.bottom = "8px" } } } else { c.removeClass(this.wrapper, "iScrollBothScrollbars"); c.addClass(this.wrapper, "iScrollLoneScrollbar"); if (this.options.defaultScrollbars && this.options.customStyle) { if (this.options.listenX) { this.wrapper.style.right = "2px" } else { this.wrapper.style.bottom = "2px" } } } var i = this.wrapper.offsetHeight; if (this.options.listenX) { this.wrapperWidth = this.wrapper.clientWidth; if (this.options.resize) { this.indicatorWidth = e.max(e.round(this.wrapperWidth * this.wrapperWidth / (this.scroller.scrollerWidth || this.wrapperWidth || 1)), 8); this.indicatorStyle.width = this.indicatorWidth + "px" } else { this.indicatorWidth = this.indicator.clientWidth } this.maxPosX = this.wrapperWidth - this.indicatorWidth; if (this.options.shrink == "clip") { this.minBoundaryX = -this.indicatorWidth + 8; this.maxBoundaryX = this.wrapperWidth - 8 } else { this.minBoundaryX = 0; this.maxBoundaryX = this.maxPosX } this.sizeRatioX = this.options.speedRatioX || (this.scroller.maxScrollX && (this.maxPosX / this.scroller.maxScrollX)) } if (this.options.listenY) { this.wrapperHeight = this.wrapper.clientHeight; if (this.options.resize) { this.indicatorHeight = e.max(e.round(this.wrapperHeight * this.wrapperHeight / (this.scroller.scrollerHeight || this.wrapperHeight || 1)), 8); this.indicatorStyle.height = this.indicatorHeight + "px" } else { this.indicatorHeight = this.indicator.clientHeight } this.maxPosY = this.wrapperHeight - this.indicatorHeight; if (this.options.shrink == "clip") { this.minBoundaryY = -this.indicatorHeight + 8; this.maxBoundaryY = this.wrapperHeight - 8 } else { this.minBoundaryY = 0; this.maxBoundaryY = this.maxPosY } this.maxPosY = this.wrapperHeight - this.indicatorHeight; this.sizeRatioY = this.options.speedRatioY || (this.scroller.maxScrollY && (this.maxPosY / this.scroller.maxScrollY)) } this.updatePosition() }, updatePosition: function () { var i = this.options.listenX && e.round(this.sizeRatioX * this.scroller.x) || 0, j = this.options.listenY && e.round(this.sizeRatioY * this.scroller.y) || 0; if (!this.options.ignoreBoundaries) { if (i < this.minBoundaryX) { if (this.options.shrink == "scale") { this.width = e.max(this.indicatorWidth + i, 8); this.indicatorStyle.width = this.width + "px" } i = this.minBoundaryX } else { if (i > this.maxBoundaryX) { if (this.options.shrink == "scale") { this.width = e.max(this.indicatorWidth - (i - this.maxPosX), 8); this.indicatorStyle.width = this.width + "px"; i = this.maxPosX + this.indicatorWidth - this.width } else { i = this.maxBoundaryX } } else { if (this.options.shrink == "scale" && this.width != this.indicatorWidth) { this.width = this.indicatorWidth; this.indicatorStyle.width = this.width + "px" } } } if (j < this.minBoundaryY) { if (this.options.shrink == "scale") { this.height = e.max(this.indicatorHeight + j * 3, 8); this.indicatorStyle.height = this.height + "px" } j = this.minBoundaryY } else { if (j > this.maxBoundaryY) { if (this.options.shrink == "scale") { this.height = e.max(this.indicatorHeight - (j - this.maxPosY) * 3, 8); this.indicatorStyle.height = this.height + "px"; j = this.maxPosY + this.indicatorHeight - this.height } else { j = this.maxBoundaryY } } else { if (this.options.shrink == "scale" && this.height != this.indicatorHeight) { this.height = this.indicatorHeight; this.indicatorStyle.height = this.height + "px" } } } } this.x = i; this.y = j; if (this.scroller.options.useTransform) { this.indicatorStyle[c.style.transform] = "translate(" + i + "px," + j + "px)" + this.scroller.translateZ } else { this.indicatorStyle.left = i + "px"; this.indicatorStyle.top = j + "px" } }, _pos: function (i, j) { if (i < 0) { i = 0 } else { if (i > this.maxPosX) { i = this.maxPosX } } if (j < 0) { j = 0 } else { if (j > this.maxPosY) { j = this.maxPosY } } i = this.options.listenX ? e.round(i / this.sizeRatioX) : this.scroller.x; j = this.options.listenY ? e.round(j / this.sizeRatioY) : this.scroller.y; this.scroller.scrollTo(i, j) }, fade: function (l, k) { if (k && !this.visible) { return } clearTimeout(this.fadeTimeout); this.fadeTimeout = null; var j = l ? 250 : 500, i = l ? 0 : 300; l = l ? "1" : "0"; this.wrapperStyle[c.style.transitionDuration] = j + "ms"; this.fadeTimeout = setTimeout((function (m) { this.wrapperStyle.opacity = m; this.visible = +m }).bind(this, l), i) } }; g.utils = c; if (typeof module != "undefined" && module.exports) { module.exports = g } else { f.IScroll = g } })(window, document, Math);

    window.jsonpCallback_buying = function (data) {
    };

    var EMC_COMPONENT = {

        elem: {
            currency_character: '$',
            site_cd: $("#shopSiteCode").val(),
            is_currency: "dkk",
            is_global: true,
            is_dollar: true,
            api_check: true,
            api_domain: 'https://shop.samsung.com/',
            _data: {},
            _this: $(".sh-g-shop-buying-tool_product_warp"),
            _txtFree: $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_free").val(),
            _txtSave: $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_save").val(),
            _buyingProduct: $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_visual"),
            _buyingTotal: $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_total_wrap"),
            _buyingOption: $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_detail"),
            _buyingOptionLen: $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_select").length,
            _buyingOptionIdx: 0,
            _iscroll: null,
            _tradeBrandIdx: 0,
            _tradeProductIdx: 0,
            _imeiCode: "",
            _optionSelectData: {},
            rtl_check: $("html").is(".rtl") === true ? true : false,
            default_option_check: true,
            required_check: true,
            click_sucess_check: true,
            click_more_check: true,
            choice_product: [],
            choice_product_obj: {},
            choice_promotion: [],
            choice_accessory: [],
            choice_tradeIn: [],
            choice_care: [],
            choice_array: [],
            choice_obj: {},
            data_array: [],
            promotion_data_array: [],
            accessory_data_array: [],
            common_text_array: [],
            api_url: "",
            skipText: $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool-choose").val(),
            un_skipText: $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool-unavailable").val()
        },

        productInfo: [],
        promotionInfo: [],
        accessoryInfo: [],
        tradeInData: {},

        common: {
            numberFormat: function (num) {
                num = num.toString();
                var returnValue = "";
                var dotSepNum = num.toString().indexOf(".");
                var commaSepNum = num.toString().indexOf(",");

                num = num.replace(',', '.');
                var sepNum = num.toString().split(".");
                var arrSize = sepNum.length;
                var returnValue = "";
                if (arrSize >= 3) {
                    for (var i = 0; i < arrSize - 1; i++) {
                        returnValue += sepNum[i];
                    }
                    return returnValue + '.' + sepNum[arrSize - 1];
                } else {
                    if (typeof (sepNum[1]) == 'undefined') {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.00';
                    } else {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + sepNum[1];
                    }
                }
            },

            addComma: function (num, currency) {
                num = String(num);

                switch (currency) {
                    case "dollar":

                        if (EMC_COMPONENT.elem.site_cd === "ca_fr") {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                                returnValue = returnValue.replace(".", ",");
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ",00";
                            }

                            return returnValue + " $";

                        } else {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                            }

                            return "$" + returnValue;

                        }

                        break;

                    case "euro":

                        var tempSepNum;

                        if (EMC_COMPONENT.elem.site_cd === "de" || EMC_COMPONENT.elem.site_cd === "es" || EMC_COMPONENT.elem.site_cd === "be_fr") {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(".", ",");
                                returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ",00";
                            }

                            return returnValue + " €";

                        } else if (EMC_COMPONENT.elem.site_cd === "fi" || EMC_COMPONENT.elem.site_cd === "fr") {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(".", ",");
                                returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + ",00";
                            }

                            return returnValue + " €";

                        } else {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(".", ",");
                                returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ",00";
                            }

                            return "€ " + returnValue;

                        }

                        break;

                    case "gbp":

                        if (num.indexOf(".") > -1) {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        } else {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                        }

                        return "£" + returnValue
                        break;

                    case "sek":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

                        return returnValue + " kr";
                        break;

                    case "dkk":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                        return returnValue + " kr.";
                        break;

                    case "nok":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

                        return returnValue + " kr";
                        break;

                    case "brl":

                        if (num.indexOf(".") > -1) {
                            returnValue = num.replace(".", ",");
                            returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        } else {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ",00";
                        }

                        return "R$ " + returnValue;
                        break;

                    case "inr":

                        if (num.indexOf(".") > -1) {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        } else {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                        }

                        return "Rs." + returnValue;
                        break;

                    case "krw":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                        return returnValue + "원";
                        break;

                    case "ae":

                        if (EMC_COMPONENT.elem.site_cd === "ae_ar") {
                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                            }

                            return returnValue + " د.إ";

                        } else {

                            if (num.indexOf(".") > -1) {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            } else {
                                returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ".00";
                            }

                            return returnValue + " AED";
                        }

                        break;

                    case "rub":

                        if (num.indexOf(".") > -1) {
                            returnValue = num.replace(".", ",");
                            returnValue = returnValue.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
                        } else {
                            returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + "";
                        }

                        return returnValue + " ₸";
                        break;

                    case "twd":

                        returnValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                        return "NT$" + returnValue;
                        break;

                    default:
                        break;
                }
            },

            imgResizeSrc: function () {
                var $image = $(".sh-g-shop-buying-tool_product_warp").find("img"),
                    img_array = [],
                    img_sources = [];

                for (var i = 0; i < $(".sh-g-shop-buying-tool_product_warp img").length; i++) {
                    $image[i] = $($image[i]);
                    img_sources[i] = EMC_COMPONENT.common.getImageSources($image[i]);

                    if (window.innerWidth > 768) {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[2]);
                    } else {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[1]);
                    }
                }
            },

            getImageSources: function ($image) {
                var s2 = $image.attr('data-src-pc') || $image.attr('src'),
                    s3 = s2,
                    s1 = $image.attr('data-src-mobile') || s2;

                return [null, s1, s2, s3]
            },

            layerOpen: function () {

                var popupInfo = $("").val(),
                    popupContent, _layerHtml;
                if (typeof popupInfo != "undefined") {
                    popupContent = popupInfo.split(",");

                    _layerHtml = "<div class='sh-g-shop-buying-tool_notification'><div class='sh-g-shop-buying-tool_modal sh-g-shop-buying-tool_fade' role='dialog' tabindex='-1'><div class='sh-g-shop-buying-tool_modal-backdrop sh-g-shop-buying-tool_fade'></div><div class='sh-g-shop-buying-tool_modal-dialog' role='document'><div class='sh-g-shop-buying-tool_modal-content'><div class='sh-g-shop-buying-tool_modal-body sh-g-shop-buying-tool_text-center'><div class='sh-g-shop-buying-tool_icon-tick-96-px' data-grunticon-embed><svg width='96px' height='96px' viewBox='0 0 96 96' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns: xlink='http://www.w3.org/1999/xlink'><desc>Created with sketchtool.</desc><defs><circle id='path-1' cx='32' cy='32' r='32'></circle><mask id='mask-2' maskContentUnits='userSpaceOnUse' maskUnits='objectBoundingBox' x='0' y='0' width='64' height='64' fill='white'><use xlink: href='#path-1'></use></mask></defs><g id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><g id='Icons' transform='translate(-535.000000, -1272.000000)'><g id='64px' transform='translate(535.000000, 272.000000)' stroke-linecap='square' stroke='#008378'><g id='Icon/96/tick-96px' transform='translate(0.000000, 1000.000000)'><g id='tick' transform='translate(16.000000, 16.000000)'><polyline id='Line' stroke-width='2' points='20.8 35.36 28.8 42.4 42.4 22.4'></polyline></g></g></g><g id='16px' transform='translate(135.000000, 224.000000)'></g></g></g></svg></div><p>" + popupContent[0] + "</p><a href='#' class='sh-g-shop-buying-tool_btn sh-g-shop-buying-tool_btn-default sh-g-shop-buying-tool_btn-block sh-g-shop-buying-tool_mini-cart-checkout-button sh-g-shop-buying-tool_js-chekcout-popup-notif' data-omni-type='microsite_scView' data-omni=';" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase() + "'>" + popupContent[1] + "</a><a href='#' data-dismiss='modal' class='sh-g-shop-buying-tool_btn sh-g-shop-buying-tool_btn-link sh-g-shop-buying-tool_addtocart-continue-shopping sh-g-shop-buying-tool_js-continue-modal' data-omni-type='microsite_basketAdd' data-omni='basket:continue shopping'>" + popupContent[2] + "</a></div></div></div></div></div>";

                }else{
                    _layerHtml = "<div class='sh-g-shop-buying-tool_notification'><div class='sh-g-shop-buying-tool_modal sh-g-shop-buying-tool_fade' role='dialog' tabindex='-1'><div class='sh-g-shop-buying-tool_modal-backdrop sh-g-shop-buying-tool_fade'></div><div class='sh-g-shop-buying-tool_modal-dialog' role='document'><div class='sh-g-shop-buying-tool_modal-content'><div class='sh-g-shop-buying-tool_modal-body sh-g-shop-buying-tool_text-center'><div class='sh-g-shop-buying-tool_icon-tick-96-px' data-grunticon-embed><svg width='96px' height='96px' viewBox='0 0 96 96' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns: xlink='http://www.w3.org/1999/xlink'><desc>Created with sketchtool.</desc><defs><circle id='path-1' cx='32' cy='32' r='32'></circle><mask id='mask-2' maskContentUnits='userSpaceOnUse' maskUnits='objectBoundingBox' x='0' y='0' width='64' height='64' fill='white'><use xlink: href='#path-1'></use></mask></defs><g id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><g id='Icons' transform='translate(-535.000000, -1272.000000)'><g id='64px' transform='translate(535.000000, 272.000000)' stroke-linecap='square' stroke='#008378'><g id='Icon/96/tick-96px' transform='translate(0.000000, 1000.000000)'><g id='tick' transform='translate(16.000000, 16.000000)'><polyline id='Line' stroke-width='2' points='20.8 35.36 28.8 42.4 42.4 22.4'></polyline></g></g></g><g id='16px' transform='translate(135.000000, 224.000000)'></g></g></g></svg></div><p>Item added</p><a href='#' class='sh-g-shop-buying-tool_btn sh-g-shop-buying-tool_btn-default sh-g-shop-buying-tool_btn-block sh-g-shop-buying-tool_mini-cart-checkout-button sh-g-shop-buying-tool_js-chekcout-popup-notif' data-omni-type='microsite_scView' data-omni=';" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase() + "'>Checkout</a><a href='#' data-dismiss='modal' class='sh-g-shop-buying-tool_btn sh-g-shop-buying-tool_btn-link sh-g-shop-buying-tool_addtocart-continue-shopping sh-g-shop-buying-tool_js-continue-modal' data-omni-type='microsite_basketAdd' data-omni='basket:continue shopping'>Continue Shopping</a></div></div></div></div></div>";
                }

                EMC_COMPONENT.elem._this.append(_layerHtml);
                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_notification > .sh-g-shop-buying-tool_modal").css("display", "block");
                setTimeout(function () {
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_notification > .sh-g-shop-buying-tool_modal").addClass("sh-g-shop-buying-tool_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_notification .sh-g-shop-buying-tool_modal-backdrop").addClass("sh-g-shop-buying-tool_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_notification a").filter(":first").focus();
                }, 100);
            },

            clickPreorder: function () {
                var selectIdx = $(".model-choose .color li.active").index();
                var checkCookieAPI = '',
                    buyNowAPI = '',
                    //change /nc/cartAndCheckout -> /cart
                    cartAndCheckAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/cart';

                if (!EMC_COMPONENT.elem.is_global) {
                    checkCookieAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/makeBuyNowCookie';
                    addCartAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';

                    $.ajax({
                        url: checkCookieAPI,
                        dataType: 'jsonp',
                        success: function (data) {
                            if (data.resultCode == '0000') {
                                if (EMC_COMPONENT.elem.choice_tradeIn.length > 0 || EMC_COMPONENT.elem.choice_care.length > 0){
                                    EMC_COMPONENT.elem.api_url = cartAndCheckAPI;
                                    EMC_COMPONENT.common.layerOpen();
                                }else{
                                    buyNow(addCartAPI, cartAndCheckAPI);
                                }
                            } else {
                                alert(data.resultMessage);
                            }
                        }
                    });

                } else {
                    //change /ng/p4v1/buyNow -> /ng/p4v1/addCart
                    buyNowAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';
                    if (EMC_COMPONENT.elem.choice_tradeIn.length > 0 || EMC_COMPONENT.elem.choice_care.length > 0) {
                        EMC_COMPONENT.elem.api_url = cartAndCheckAPI;
                        EMC_COMPONENT.common.layerOpen();
                    } else {
                        EMC_COMPONENT.common.buyNow(buyNowAPI, cartAndCheckAPI);
                    }
                }
            },

            buyNow: function (urlApi, checkApi) {
                // ajax API
                var count = 0,
                    paramater = 'quantity=1&productCode=',
                    accParamater = '',
                    quantity = [];

                //tagging      
                var resultName = [],
                    resultPid = [],
                    tagModelCode = '',
                    tagPid = '';

                $.each(EMC_COMPONENT.elem.choice_array, function (index, ele) {
                    if ($.inArray(ele, resultName) == -1) {
                        resultName.push(ele);
                    }
                });

                if (EMC_COMPONENT.elem.choice_array.length != 0) {

                    for (var i = 0; i < EMC_COMPONENT.elem.choice_array.length; i++) {
                        var keyPid = EMC_COMPONENT.elem.choice_array[i];
                        if (!quantity[keyPid]) {
                            quantity[keyPid] = 1;
                        } else {
                            quantity[keyPid] = quantity[keyPid] + 1;
                        }
                    }

                    var choice_result = 0;
                    var accParamater = "";

                    function checkout() {
                        accParamater = "quantity=" + quantity[keyPid] + "&productCode=" + EMC_COMPONENT.elem.choice_array[choice_result];
                        $.ajax({
                            url: urlApi + accParamater,
                            dataType: 'jsonp',
                            async: false,
                            success: function (data) {
                                if (data.resultCode == '0000') {
                                    $(".js-empty-cart").hide();
                                    $(".s-btn-utility.js-cart").show();
                                    $("#globalCartCount").show();
                                    updateTotalCartCount(data.cartCount);
                                    if (EMC_COMPONENT.elem.choice_array.length - 1 === choice_result) {
                                        EMC_COMPONENT.common.layerOpen();
                                    } else {
                                        choice_result = choice_result + 1;
                                        checkout();
                                    }
                                    EMC_COMPONENT.elem.api_url = checkApi;
                                } else {
                                	if('undefined' !== typeof win.smg.aem.components.shop) {
                                		win.smg.aem.components.shop.setBuyingTools.cookiereset();
                                	}
                                    alert(data.resultMessage);
                                }
                            }
                        });
                    }
                    checkout();
                }
            }

        },

        resize: function () {

            $(window).resize(function () {
                EMC_COMPONENT.common.imgResizeSrc();
                EMC_COMPONENT.scrollMotion.resize();
                EMC_COMPONENT.slider();
                EMC_COMPONENT.accessibility.default();
                EMC_COMPONENT.totalBar.resize();

                $(document).find(".sh-g-shop-buying-tool_product_select.sh-g-shop-buying-tool_active").each(function () {
                    $(this).find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                        "min-height": 70,
                        "height": "auto",
                        "opacity": 1
                    });
                });

                $(document).find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list.sh-g-shop-buying-tool_active").each(function (i) {
                    if ((i % 3) === 1) {
                        if (window.innerWidth > 768) {
                            EMC_COMPONENT.elem._this.find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list.sh-g-shop-buying-tool_active").eq(i).css({
                                "margin-left": "2%",
                                "margin-right": "2%"
                            });
                        } else {
                            $(document).find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list.sh-g-shop-buying-tool_active").eq(i).css({
                                "margin-left": "3%",
                                "margin-right": "3%"
                            });
                        }
                    }
                });
                
            });

        },

        scroll: function () {

            $(window).scroll(function () {
                EMC_COMPONENT.scrollMotion.scroll();
                EMC_COMPONENT.scrollMotion.scrollStatic();
            });

        },

        dataSet: {
            productData: function () {
                var firstSelect = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_product_select_list .sh-g-shop-buying-tool_product_select:first-child"),
                    dataLi = firstSelect.find(".sh-g-shop-buying-tool_btn_list_wrap > li");

                dataLi.each(function () {
                    EMC_COMPONENT.elem.data_array.push($(this).data("role").split("|"));
                });

                for (var i = 0; i < EMC_COMPONENT.elem.data_array.length; i++) {
                    for (var v = 0; v < EMC_COMPONENT.elem.data_array[i].length; v++) {
                        EMC_COMPONENT.elem.data_array[i][v] = EMC_COMPONENT.elem.data_array[i][v].split("^");
                    }
                }

                for (var a = 0; a < EMC_COMPONENT.elem.data_array.length; a++) {
                    EMC_COMPONENT.productInfo.push([]);
                }

                for (var l = 0; l < EMC_COMPONENT.productInfo.length; l++) {
                    for (var d = 0; d < EMC_COMPONENT.elem.data_array[l].length; d++) {

                        EMC_COMPONENT.elem.data_array[l][d][6] = EMC_COMPONENT.elem.data_array[l][d][6] === "" ? "" : EMC_COMPONENT.calc.numberConvert(EMC_COMPONENT.elem.data_array[l][d][6]);
                        EMC_COMPONENT.elem.data_array[l][d][7] = EMC_COMPONENT.elem.data_array[l][d][7] === "" ? "" : EMC_COMPONENT.calc.numberConvert(EMC_COMPONENT.elem.data_array[l][d][7]);
                        if (EMC_COMPONENT.elem._this.find("[data-role-type='carrier']").length > 0) {
                            EMC_COMPONENT.productInfo[l].push({
                                model: EMC_COMPONENT.elem.data_array[l][d][0],
                                code: EMC_COMPONENT.elem.data_array[l][d][1],
                                carrier: EMC_COMPONENT.elem.data_array[l][d][2],
                                storage: EMC_COMPONENT.elem.data_array[l][d][3],
                                color: EMC_COMPONENT.elem.data_array[l][d][4],
                                colorCode: EMC_COMPONENT.elem.data_array[l][d][5],
                                price: EMC_COMPONENT.elem.data_array[l][d][6],
                                promotionPrice: EMC_COMPONENT.elem.data_array[l][d][7],
                                stock: ""
                            });
                        } else {
                            EMC_COMPONENT.productInfo[l].push({
                                model: EMC_COMPONENT.elem.data_array[l][d][0],
                                code: EMC_COMPONENT.elem.data_array[l][d][1],
                                carrier: undefined,
                                storage: EMC_COMPONENT.elem.data_array[l][d][3],
                                color: EMC_COMPONENT.elem.data_array[l][d][4],
                                colorCode: EMC_COMPONENT.elem.data_array[l][d][5],
                                price: EMC_COMPONENT.elem.data_array[l][d][6],
                                promotionPrice: EMC_COMPONENT.elem.data_array[l][d][7],
                                stock: ""
                            });
                        }
                    }
                }

                var price = 0,
                    promotionPrice = 0,
                    totalPrice;

                EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_list").each(function (i) {
                    if (EMC_COMPONENT.productInfo[i][0].promotionPrice != "" && EMC_COMPONENT.productInfo[i][0].promotionPrice != undefined) {
                        promotionPrice = EMC_COMPONENT.productInfo[i][0].promotionPrice;
                        EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_list").eq(i).find(".sh-g-shop-buying-tool_price_wrap .sh-g-shop-buying-tool_price").text(EMC_COMPONENT.common.addComma(promotionPrice, EMC_COMPONENT.elem.is_currency));
                    } else {
                        price = EMC_COMPONENT.productInfo[i][0].price;
                        EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_list").eq(i).find(".sh-g-shop-buying-tool_price_wrap .sh-g-shop-buying-tool_price").text(EMC_COMPONENT.common.addComma(price, EMC_COMPONENT.elem.is_currency));
                    }
                });

                if (EMC_COMPONENT.productInfo[0][0].promotionPrice != "" && EMC_COMPONENT.productInfo[0][0].promotionPrice != undefined) {
                    totalPrice = EMC_COMPONENT.productInfo[0][0].promotionPrice;
                } else {
                    totalPrice = EMC_COMPONENT.productInfo[0][0].price;
                }

                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap .sh-g-shop-buying-tool_price").text(EMC_COMPONENT.common.addComma(totalPrice, EMC_COMPONENT.elem.is_currency));
            },

            promotionData: function () {

                var promotionPrice = "",
                    productPrice = "";

                EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] .sh-g-shop-buying-tool_btn_list").each(function () {
                    if ($(this).is(".sh-g-shop-buying-tool_no_data") === false) {
                        EMC_COMPONENT.elem.promotion_data_array.push($(this).data("role").split("|"));
                    }
                });

                for (var i = 0; i < EMC_COMPONENT.elem.promotion_data_array.length; i++) {
                    for (var v = 0; v < EMC_COMPONENT.elem.promotion_data_array[i].length; v++) {
                        EMC_COMPONENT.elem.promotion_data_array[i][v] = EMC_COMPONENT.elem.promotion_data_array[i][v].split("^");
                    }
                }

                for (var a = 0; a < EMC_COMPONENT.elem.promotion_data_array.length; a++) {
                    EMC_COMPONENT.promotionInfo.push([]);
                }

                for (var l = 0; l < EMC_COMPONENT.promotionInfo.length; l++) {
                    for (var d = 0; d < EMC_COMPONENT.elem.promotion_data_array[l].length; d++) {

                        if (EMC_COMPONENT.elem.promotion_data_array[l][d][7] === undefined) {
                            productPrice = "";
                        } else {
                            productPrice = EMC_COMPONENT.calc.numberConvert(EMC_COMPONENT.elem.promotion_data_array[l][d][7]);
                        }

                        if (EMC_COMPONENT.elem.promotion_data_array[l][d][8] === undefined) {
                            promotionPrice = "";
                        } else {
                            promotionPrice = EMC_COMPONENT.calc.numberConvert(EMC_COMPONENT.elem.promotion_data_array[l][d][8]);
                        }


                        EMC_COMPONENT.promotionInfo[l].push({
                            matchCode: EMC_COMPONENT.elem.promotion_data_array[l][d][0],
                            name: EMC_COMPONENT.elem.promotion_data_array[l][d][1],
                            promotionCode: EMC_COMPONENT.elem.promotion_data_array[l][d][2],
                            color: EMC_COMPONENT.elem.promotion_data_array[l][d][3],
                            colorCode: EMC_COMPONENT.elem.promotion_data_array[l][d][4],
                            imgPath: EMC_COMPONENT.elem.promotion_data_array[l][d][5],
                            mobileImgPath: EMC_COMPONENT.elem.promotion_data_array[l][d][6],
                            productPrice: productPrice,
                            promotionPrice: promotionPrice,
                            stock: ""
                        });
                    }
                }

            }

        },

        dataUniq: function (a) {
            var prims = {
                "boolean": {},
                "number": {},
                "string": {}
            },
                obj = [];

            return a.filter(function (item) {
                var type = typeof item;
                if (type in prims) {
                    return prims[type].hasOwnProperty(item) ? false : (prims[type][item] = true);
                } else {
                    return obj.indexOf(item) >= 0 ? false : obj.push(item);
                }
            });
        },

        apiPriceSet: {

            elem: {
                _dataLength: 0,
                _promotionDataLength: 0,
                _dataIndex: 0,
                _promotionDataIndex: 0,
                _successCheck: false,
                _successPromotionCheck: false
            },

            getPrice: function (modelCode, obj, type) {
                function jsonpCallback_buying() { }
                
                $.ajax({
                    url: EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/getRealTimeProductSimpleInfo?productCode=' + modelCode,
                    dataType: 'jsonp',
                    cache: true,
                    jsonp: "callback",
                    jsonpCallback: 'jsonpCallback_buying',
                    success: function (data) {
                        if (data && data.resultCode == '0000') {

                            if (type === "product") {
                                if (data.promotionPrice != "") {
                                    obj.price = EMC_COMPONENT.calc.numberConvert(data.price);
                                    obj.promotionPrice = EMC_COMPONENT.calc.numberConvert(data.promotionPrice);
                                } else {
                                    obj.price = EMC_COMPONENT.calc.numberConvert(data.price);
                                    obj.promotionPrice = "";
                                }

                                obj.stock = data.stockLevelStatus;
                            }

                            if (type === "promotion") {
                                obj.promotionPrice = EMC_COMPONENT.calc.numberConvert(data.price);

                                obj.stock = data.stockLevelStatus;
                            }

                        }
                    },
                    complete: function () {

                        if (type === "product") {
                            if (EMC_COMPONENT.apiPriceSet.elem._dataLength - 1 != EMC_COMPONENT.apiPriceSet.elem._dataIndex) {
                                EMC_COMPONENT.apiPriceSet.elem._dataIndex = EMC_COMPONENT.apiPriceSet.elem._dataIndex + 1;
                            } else {
                                EMC_COMPONENT.apiPriceSet.elem._successCheck = true;
                            }
                        }

                        if (type === "promotion") {
                            var promotionLen,
                                promotionIdx;

                            promotionLen = EMC_COMPONENT.apiPriceSet.elem._promotionDataLength;
                            promotionIdx = EMC_COMPONENT.apiPriceSet.elem._promotionDataIndex;
                            if (promotionLen - 1 != promotionIdx) {
                                EMC_COMPONENT.apiPriceSet.elem._promotionDataIndex = promotionIdx + 1;
                            } else {
                                EMC_COMPONENT.apiPriceSet.elem._successPromotionCheck = true;
                            }
                        }
                    }
                });
            },

            setPrice: {

                setProductPrice: function () {
                    for (var i = 0; i < EMC_COMPONENT.productInfo.length; i++) {
                        EMC_COMPONENT.apiPriceSet.elem._dataLength += EMC_COMPONENT.productInfo[i].length;
                    }

                    if (EMC_COMPONENT.elem.api_check === true) {
                        for (var x = 0; x < EMC_COMPONENT.productInfo.length; x++) {
                            $.each(EMC_COMPONENT.productInfo[x], function (i, v) {
                                EMC_COMPONENT.apiPriceSet.getPrice(v.code.toUpperCase(), v, "product");
                            });
                        }
                    }

                    var apiSuccessCheckInterval = setInterval(function () {
                        if (EMC_COMPONENT.apiPriceSet.elem._successCheck && EMC_COMPONENT.apiPriceSet.elem._successPromotionCheck) {
                            clearInterval(apiSuccessCheckInterval);

                            var price,
                                promotionPrice,
                                totalPrice;

                            EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_list").each(function (i) {
                                if (EMC_COMPONENT.productInfo[i][0].promotionPrice != "" && EMC_COMPONENT.productInfo[i][0].promotionPrice != undefined) {
                                    promotionPrice = EMC_COMPONENT.productInfo[i][0].promotionPrice;
                                    EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_list").eq(i).find(".sh-g-shop-buying-tool_price_wrap .sh-g-shop-buying-tool_price").text(EMC_COMPONENT.common.addComma(promotionPrice, EMC_COMPONENT.elem.is_currency));
                                } else {
                                    price = EMC_COMPONENT.productInfo[i][0].price;
                                    EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_list").eq(i).find(".sh-g-shop-buying-tool_price_wrap .sh-g-shop-buying-tool_price").text(EMC_COMPONENT.common.addComma(price, EMC_COMPONENT.elem.is_currency));
                                }
                            });

                            if (EMC_COMPONENT.productInfo[0][0].promotionPrice != "" && EMC_COMPONENT.productInfo[0][0].promotionPrice != undefined) {
                                totalPrice = EMC_COMPONENT.productInfo[0][0].promotionPrice;
                            } else {
                                totalPrice = EMC_COMPONENT.productInfo[0][0].price;
                            }

                            EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap .sh-g-shop-buying-tool_price").text(EMC_COMPONENT.common.addComma(totalPrice, EMC_COMPONENT.elem.is_currency));
                        }
                    }, 10);

                    for (var i = 0; i < EMC_COMPONENT.promotionInfo.length; i++) {
                        EMC_COMPONENT.apiPriceSet.elem._promotionDataLength += EMC_COMPONENT.promotionInfo[i].length;
                    }

                    if (EMC_COMPONENT.elem.api_check === true) {
                        for (var x = 0; x < EMC_COMPONENT.promotionInfo.length; x++) {
                            $.each(EMC_COMPONENT.promotionInfo[x], function (i, v) {
                                EMC_COMPONENT.apiPriceSet.getPrice(v.promotionCode.toUpperCase(), v, "promotion");
                            });
                        }
                    }
                }
            }
        },

        defaultOption: function (idx) {

            var type = "",
                modelIdx = idx != undefined ? idx : 0,
                requiredLen = EMC_COMPONENT.elem._this.find("[data-required='true']").length;
            if (EMC_COMPONENT.elem.default_option_check === true && EMC_COMPONENT.elem.required_check === true) {
                for (var r = 0; r < requiredLen; r++) {
                    if (EMC_COMPONENT.elem._this.find("[data-required='true']").eq(r).is(".sh-g-shop-buying-tool_required") === false) {
                        type = EMC_COMPONENT.elem._this.find("[data-required='true']").eq(r).data("role-type");
                        EMC_COMPONENT.click.draw.typeOption(type, modelIdx);
                    }
                }
            }

        },

        slider: function () {

            var thumSlider = $(".sh-g-shop-buying-tool_visual_thumb"),
                productSlider = $(".sh-g-shop-buying-tool_visual_view"),
                thumIdx = 0,
                thumOpt = {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    vertical: true,
                    infinite: false,
                    useTransform: !0,
                    verticalSwiping: !0,
                    prevArrow: "<button type='button' class='slick-prev slick-arrow'>Previous image</button>",
                    nextArrow: "<button type='button' class='slick-next slick-arrow'>Next image</button>",
                    responsive: [
                        {
                            breakpoint: 769,
                            settings: "unslick"
                        }
                    ]
                },
                visualOpt = {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: false,
                    arrows: false,
                    accessibility: true,
                    responsive: [
                        {
                            breakpoint: 769,
                            settings: {
                                infinite: false,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                arrows: false,
                                accessibility: true,
                                dots: true
                            }
                        }
                    ]
                };

            if (thumSlider.is(".slick-initialized") === false) {
                thumSlider.slick(thumOpt);
            }

            if (productSlider.is(".slick-initialized") === false) {
                productSlider.slick(visualOpt);
            }

            productSlider.on("beforeChange", function (event, slick, current, next) {
                thumSlider.find(".sh-g-shop-buying-tool_visual_thumb_item").removeClass("sh-g-shop-buying-tool_active");
                thumSlider.find(".sh-g-shop-buying-tool_visual_thumb_item").eq(next).addClass("sh-g-shop-buying-tool_active");

                if (thumSlider.is(".slick-initialized") === true) {
                    if (next >= 4) {
                        thumSlider.slick("slickNext", next);
                    } else if (next <= 2) {
                        thumSlider.slick("slickPrev", next);
                    }
                }
            });

            thumSlider.find(".sh-g-shop-buying-tool_visual_thumb_item a").on("click", function (e) {
                e.preventDefault();

                var idx = $(this).parent().index();
                $(this).parent().siblings().removeClass("sh-g-shop-buying-tool_active");
                $(this).parent().siblings().find("em.blind").text("unselected");
                $(this).parent().addClass("sh-g-shop-buying-tool_active");
                $(this).find("em.blind").text("selected");
                thumIdx = idx;
                productSlider.slick("slickGoTo", idx);
            });

            if (window.innerWidth < 769) {
                //productSlider.slick(visualOpt_mobile);

                productSlider.on("afterChange", function () {
                    var modelThis = EMC_COMPONENT.elem._this.find("[data-role-type='model']"),
                        colorThis = EMC_COMPONENT.elem._this.find("[data-role-type='color']"),
                        altArray = ["front and rear", "rear", "left side", "right side", "front side with left rotation", "front side with right rotation"],
                        modelName = "",
                        colorName = "";

                    modelName = modelThis.find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active .sh-g-shop-buying-tool_tit").text() || modelThis.find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default .sh-g-shop-buying-tool_tit").text();
                    colorName = colorThis.find(".sh-g-shop-buying-tool_btn_option").is(".sh-g-shop-buying-tool_active") === true ? colorThis.find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name") : colorThis.find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").data("role-name");

                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_view .slick-dots li").each(function (i) {
                        if ($(this).is(".slick-active") === true) {
                            $(this).find("button").html("Slide" + (i + 1) + " - " + modelName + " " + colorName + " " + altArray[i] + " <em class='blind'>selected</em>");
                        } else {
                            $(this).find("button").html("Slide" + (i + 1) + " - " + modelName + " " + colorName + " " + altArray[i] + " <em class='blind'>unselected</em>");
                        }
                    });
                });

                EMC_COMPONENT.tagging.slider();
            }

            if (EMC_COMPONENT.elem.rtl_check) {
                productSlider.slick("slickSetOption", "rtl", true);
            } else {
                productSlider.slick("slickSetOption", "rtl", false);
            }

        },

        designScroll: function () {
            EMC_COMPONENT.elem._iscroll = new IScroll(".sh-g-shop-buying-tool_trade_list_wrap", {
                hScroll: true,
                useTransform: true,
                mouseWheel: true,
                scrollbars: true,
                disableMouse: true,
                disablePointer: true,
                keyBindings: true
            });

        },

        scrollMotion: {

            elem: {
                _contentTop: 0,
                _thisScroll: 0,
                _productWrapTop: 0,
                _contHeight: 0,
                _contTop: 0,
                _visualHeight: 0,
                _visualTop: 0,
                _subNavHeight: 0,
                _optionTop: 0,
                _optionBot: 0,
                _optionHeight: 0,
                _totalTop: 0,
                _totalHeight: 0,
                _cookieHeight: 0,
                _topCheck: true
            },

            scroll: function (option, clickEvent) {

                var visualCrit;

                this.elem._thisScroll = $(window).scrollTop();
                this.elem._subNavHeight = $(".fp-floating-nav__wrap").height();
                this.elem._contentTop = $("#content").offset().top;
                this.elem._productWrapTop = $(".sh-g-shop-buying-tool_product_warp").offset().top;
                this.elem._contHeight = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_cont").outerHeight(true);
                this.elem._contTop = $(".sh-g-shop-buying-tool_product_warp").offset().top;
                this.elem._visualHeight = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_visual").outerHeight(true);
                this.elem._optionTop = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_detail").offset().top;
                this.elem._optionHeight = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_detail").height();
                this.elem._totalTop = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_total_wrap").offset().top;
                this.elem._totalHeight = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_total_wrap").outerHeight(true);

                if (option === "open") {
                    this.elem._contHeight = this.elem._contHeight + (EMC_COMPONENT.click.elem._optionHeight - EMC_COMPONENT.click.elem._prevOptionHeight);
                } else if (option === "close") {
                    this.elem._contHeight = this.elem._contHeight - EMC_COMPONENT.click.elem._optionHeight;
                }

                this.elem._optionBot = (this.elem._contHeight + this.elem._productWrapTop) - ($(window).height() - this.elem._totalHeight);
                visualCrit = (this.elem._contHeight + this.elem._contTop) - (this.elem._visualHeight + (this.elem._totalHeight) + this.elem._subNavHeight);
                var topHeight = (this.elem._contHeight) - (this.elem._visualHeight + (this.elem._totalHeight) + this.elem._subNavHeight),
                    multiplication = 0;

                if (window.innerWidth >= 1440) {
                    multiplication = 2.3;
                } else if (window.innerWidth < 1440 && window.innerWidth > 768) {
                    multiplication = 2.7;
                }

                if ($(".cookie-notice").length > 0) {
                    var cookieStyleCheck = $(".cookie-notice").attr("style") != undefined ? $(".cookie-notice").attr("style") : "block";

                    if (cookieStyleCheck.indexOf("none") != -1) {
                        this.elem._cookieHeight = 0;
                    } else {
                        this.elem._cookieHeight = $(".cookie-notice").outerHeight();
                    }
                }

                if (this.elem._topCheck === true) {
                    this.elem._topCheck = false;
                    this.elem._visualTop = $(".sh-g-shop-buying-tool_product_visual").position().top;
                }

                if (window.innerWidth > 768) {

                    if (this.elem._thisScroll + this.elem._subNavHeight >= this.elem._optionTop && this.elem._thisScroll + this.elem._subNavHeight < visualCrit) {
                        EMC_COMPONENT.elem._buyingProduct.css({
                            "position": "fixed",
                            "top": (this.elem._optionTop - this.elem._contTop) * multiplication
                        });
                    } else if (this.elem._thisScroll + this.elem._subNavHeight >= visualCrit) {

                        if (topHeight - 12 < 0) {
                            setTimeout(function () {
                                EMC_COMPONENT.scrollMotion.elem._optionHeight = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_detail").height();
                                EMC_COMPONENT.scrollMotion.scrollStatic();
                            }, 500);
                        } else {
                            EMC_COMPONENT.elem._buyingProduct.css({
                                "position": "absolute",
                                "top": topHeight - 12
                            });
                        }

                    } else if (this.elem._thisScroll + this.elem._subNavHeight <= this.elem._optionTop) {
                        this.elem._topCheck = true;
                        EMC_COMPONENT.elem._buyingProduct.removeAttr("style");
                    }

                    if (this.elem._thisScroll <= this.elem._optionBot) {
                        if (!EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap").is(".sh-g-shop-buying-tool_fixed")) {
                            EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap").addClass("sh-g-shop-buying-tool_fixed");
                            if (clickEvent) {
                                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap").css("opacity", 0);
                                setTimeout(function () {
                                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap").fadeIn(300);
                                }, 100);
                            }
                        }
                    } else {
                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap").removeClass("sh-g-shop-buying-tool_fixed");
                    }

                } else {
                    EMC_COMPONENT.elem._buyingProduct.removeClass("sh-g-shop-buying-tool_fixed");
                    EMC_COMPONENT.elem._buyingProduct.removeAttr("style");
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap").removeClass("sh-g-shop-buying-tool_fixed");
                }
            },

            scrollStatic: function (option) {

                if (option === "open") {
                    this.elem._optionHeight = this.elem._optionHeight + EMC_COMPONENT.click.elem._optionHeight - EMC_COMPONENT.click.elem._prevOptionHeight;
                } else if (option === "close") {
                    this.elem._optionHeight = this.elem._optionHeight - EMC_COMPONENT.click.elem._optionHeight;
                }

                if (this.elem._visualHeight + 100 > this.elem._optionHeight) {
                    $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_visual").removeAttr("style");
                    $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_visual").addClass("sh-g-shop-buying-tool_static");
                } else {
                    $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_visual").removeClass("sh-g-shop-buying-tool_static");
                }

            },

            resize: function () {
                this.scroll();
                this.scrollStatic();
            }
        },

        calc: {

            elem: {
                _modelElem: $(".sh-g-shop-buying-tool_product_warp").find("[data-role-type='model']"),
                _carrierElem: $(".sh-g-shop-buying-tool_product_warp").find("[data-role-type='carrier']"),
                _colorElem: $(".sh-g-shop-buying-tool_product_warp").find("[data-role-type='color']"),
                _storageElem: $(".sh-g-shop-buying-tool_product_warp").find("[data-role-type='storage']"),
                _optionObj: {},
                _selPrice: {},
                _storageObj: {},
                _totalPrice: 0
            },

            numberConvert: function (num) {

                var resultCurrency = 0;

                if (typeof num != "number" && num != undefined) {
                    var exceptCode = ["kr.", "Rs."];

                    $.each(exceptCode, function (i, v) {
                        num = $.trim(num.replace(v, ""));
                    });

                    num = num.replace(/[^0-9^.^,]/g, "");

                    if (num.indexOf(",") > -1 || num.indexOf(".") > -1) {
                        var comma = num.split(",").pop();
                        var close = num.split(".").pop();

                        if (comma.length == 2) {
                            return resultCurrency = Number((num.slice(0, -2).replace(/[^0-9]/g, "") + "." + comma));
                        }

                        else if (close.length == 2) {
                            return resultCurrency = Number((num.slice(0, -2).replace(/[^0-9]/g, "") + "." + close));
                        }

                        else {
                            return resultCurrency = Number(num.replace(/[^0-9]/g, ""));
                        }

                    } else {
                        return resultCurrency = Number(num);
                    }
                } else if (num === undefined || num === "") {
                    return resultCurrency = "";
                } else {
                    return resultCurrency = Number(num);
                }

            },

            storagePriceSet: function (modelIdx) {

                var defaultStorageKey = "",
                    defaultStoragePrice = 0,
                    calcStoragePrice = 0,
                    resultStoragePrice = 0,
                    modelKey,
                    modelTarget,
                    carrierKey,
                    carrierTarget,
                    colorKey,
                    colorTarget,
                    storageKey,
                    storageTarget;

                modelKey = this.elem._modelElem.find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").data("role-name") || this.elem._modelElem.find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name");

                carrierKey = this.elem._carrierElem.find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").data("role-name") || this.elem._carrierElem.find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name");

                colorKey = this.elem._colorElem.find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").data("role-name") || this.elem._colorElem.find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name");

                storageKey = this.elem._storageElem.find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").data("role-name") || this.elem._storageElem.find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name");

                storageTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[modelKey].carrier[carrierKey].color[colorKey].storage.data.sort();

                EMC_COMPONENT.calc.elem._storageObj = {};
                $.each(EMC_COMPONENT.productInfo[modelIdx], function (i, obj) {
                    if (obj.model === modelKey) {
                        if (obj.carrier === carrierKey) {
                            if (obj.color === colorKey) {
                                EMC_COMPONENT.calc.elem._storageObj[obj.storage] = obj.price;
                            }
                        }
                    }
                });

                function sortObj(obj) {
                    var sorted = {},
                        key,
                        a = [];

                    for (key in obj) {
                        if (obj.hasOwnProperty(key)) a.push(key);
                    }

                    a.sort();

                    for (key = 0; key < a.length; key++) {
                        sorted[a[key]] = obj[a[key]];
                    }

                    return sorted;
                }

                this.elem._storageObj = sortObj(this.elem._storageObj);
                defaultStoragePrice = sortObj(this.elem._storageObj)[storageKey];

                for (var key in this.elem._storageObj) {
                    calcStoragePrice = this.elem._storageObj[key];
                    resultStoragePrice = calcStoragePrice - defaultStoragePrice;
                    resultStoragePrice = Number(resultStoragePrice.toFixed(2));
                    this.elem._storageElem.find(".sh-g-shop-buying-tool_btn_list [data-role-name='" + key + "'] .sh-g-shop-buying-tool_price").text("+" + EMC_COMPONENT.common.addComma(resultStoragePrice, EMC_COMPONENT.elem.is_currency));
                }
            },

            selectProduct: function () {

                var typeThis = EMC_COMPONENT.elem._this.find("[data-required='true']"),
                    typeLen = typeThis.length,
                    nameArray = [],
                    selData = "",
                    selObj = {},
                    selArray = [],
                    selLen = 0,
                    selProductObj,
                    selProductPrice = 0,
                    selData,
                    modelIdx = 0;

                if (EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_option").is(".sh-g-shop-buying-tool_active")) {
                    modelIdx = EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").parent().index();
                } else {
                    modelIdx = EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").parent().index();
                }

                typeThis.each(function () {
                    nameArray.push($(this).data("role-type"));

                    selData = $(this).find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name") || $(this).find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").data("role-name");
                    selArray.push(selData);
                });

                for (var n = 0; n < nameArray.length; n++) {
                    selObj[nameArray[n]] = selArray[n];
                }

                selProductObj = new Object();

                $.each(EMC_COMPONENT.productInfo[modelIdx], function (i, obj) {
                    selLen = 0;
                    for (var key in selObj) {

                        if (selObj[key] === obj[key]) {
                            if (selArray.length - 1 != selLen) {
                                selLen = selLen + 1;
                            } else {
                                if (obj.promotionPrice === "" || obj.promotionPrice === undefined) {
                                    selProductPrice = obj.price;
                                } else {
                                    selProductPrice = obj.promotionPrice;
                                }
                                EMC_COMPONENT.calc.elem._selPrice.productPrice = EMC_COMPONENT.calc.numberConvert(selProductPrice);
                                EMC_COMPONENT.calc.result();
                                selLen = 0;
                            }
                        }
                    }
                });

            },

            selectPromotion: function (_this) {

                var promotionPrice = 0,
                    selectIdx,
                    colorIdx;
                colorIdx = _this.next(".sh-g-shop-buying-tool_color_wrap").find("input:checked").data("role-idx");

                $.each(EMC_COMPONENT.click.draw.elem._promotionCheckArray, function (i, arr) {
                    if (arr[0].name === _this.data("role-name")) {
                        selectIdx = i;
                    }
                });

                promotionPrice = EMC_COMPONENT.click.draw.elem._promotionCheckArray[selectIdx][colorIdx].addPrice;
                this.elem._selPrice.promotion = promotionPrice;

                var apiPromotionCheck = setInterval(function () {
                    if (EMC_COMPONENT.apiPriceSet.elem._successCheck && EMC_COMPONENT.apiPriceSet.elem._successPromotionCheck) {
                        clearInterval(apiPromotionCheck);
                        if (EMC_COMPONENT.click.draw.elem._promotionCheckArray[selectIdx][colorIdx].stock === "inStock") {
                            setTimeout(function () {
                                promotionPrice = EMC_COMPONENT.click.draw.elem._promotionCheckArray[selectIdx][colorIdx].addPrice;
                                EMC_COMPONENT.calc.elem._selPrice.promotion = promotionPrice;
                                EMC_COMPONENT.calc.result();
                            }, 0);
                        }
                    }
                }, 10);

            },

            result: function () {

                var floatCheck = /^([0-9]*)[\.]?([0-9])?$/;

                this.elem._totalPrice = 0;
                for (var key in this.elem._selPrice) {
                    if (key === "tradeIn") {
                        this.elem._totalPrice -= EMC_COMPONENT.calc.numberConvert(this.elem._selPrice.tradeIn);
                    } else {
                        this.elem._totalPrice += EMC_COMPONENT.calc.numberConvert(this.elem._selPrice[key]);
                    }
                }

                this.elem._totalPrice = EMC_COMPONENT.calc.numberConvert(this.elem._totalPrice);

                if (!floatCheck.test(this.elem._totalPrice)) {
                    this.elem._totalPrice = this.elem._totalPrice.toFixed(2);
                }

                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap .sh-g-shop-buying-tool_price").text(EMC_COMPONENT.common.addComma(this.elem._totalPrice, EMC_COMPONENT.elem.is_currency));

            },

            reset: function (_this, type) {
                var thisType = _this.parents(".sh-g-shop-buying-tool_product_select").data("role-type");

                if (type === "trade-in") {
                    type = "tradeIn";
                }

                if (thisType === "model" || thisType === "carrier" || thisType === "color" || thisType === "storage") {
                    delete this.elem._selPrice["promotion"];
                    delete this.elem._selPrice["tradeIn"];
                    delete this.elem._selPrice["care"];
                    delete this.elem._selPrice["accessory"];
                }

                delete this.elem._selPrice[type];
                this.result();
            },

            priceChange: function (_this, type, selectIdx, colorIdx) {

                var modelPrice,
                    setPromotionPrice,
                    setProductPrice,
                    savePrice,
                    addPrice,
                    accessoryPrice;

                if (type === "promotion") {

                    $.each(EMC_COMPONENT.click.draw.elem._promotionCheckArray, function (i, arr) {
                        if (arr[0].name === _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().data("role-name")) {
                            selectIdx = i;
                        }
                    });

                    if (EMC_COMPONENT.click.draw.elem._promotionCheckArray[selectIdx][colorIdx].addPrice === 0) {
                        _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().find(".sh-g-shop-buying-tool_price_was .sh-g-shop-buying-tool_save_price").text(EMC_COMPONENT.elem._txtFree + " ");
                    } else {
                        _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().find(".sh-g-shop-buying-tool_price_was .sh-g-shop-buying-tool_save_price").text("+" + EMC_COMPONENT.common.addComma(EMC_COMPONENT.click.draw.elem._promotionCheckArray[selectIdx][colorIdx].addPrice, EMC_COMPONENT.elem.is_currency) + " ");
                    }

                    if (EMC_COMPONENT.click.draw.elem._promotionCheckArray[selectIdx][colorIdx].stock === "outOfStock"){
                        _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().find(".sh-g-shop-buying-tool_stock_txt").addClass("sh-g-shop-buying-tool_active");
                    }else{
                        _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().find(".sh-g-shop-buying-tool_stock_txt").removeClass("sh-g-shop-buying-tool_active");
                    }

                    _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().find(".sh-g-shop-buying-tool_price_was .sh-g-shop-buying-tool_price em").html(" &rlm;(<span>" + EMC_COMPONENT.elem._txtSave + " </span>" + EMC_COMPONENT.common.addComma(EMC_COMPONENT.click.draw.elem._promotionCheckArray[selectIdx][colorIdx].savePrice, EMC_COMPONENT.elem.is_currency) +")&rlm;");

                    if (_this.parents(".sh-g-shop-buying-tool_color_wrap").prev().is(".sh-g-shop-buying-tool_active") === true) {
                        EMC_COMPONENT.elem.choice_promotion = [];
                        EMC_COMPONENT.elem.choice_promotion.push(EMC_COMPONENT.click.draw.elem._promotionCheckArray[selectIdx][colorIdx].promotionCode);
                        this.selectPromotion(_this.parents(".sh-g-shop-buying-tool_color_wrap").prev());
                    }

                }
            },

        },

        cart: {

            event: function () {

                if (EMC_COMPONENT.elem.choice_tradeIn.length > 0 || EMC_COMPONENT.elem.choice_care.length > 0) {
                    var url = "https://shop.samsung.com/" + EMC_COMPONENT.elem.site_cd + "/ng/p4v1/addToCart",
                        productCode = "",
                        tradeInCode = "",
                        imeiCode = EMC_COMPONENT.elem._imeiCode,
                        careCode = "",
                        param = {};

                    if (EMC_COMPONENT.elem.choice_promotion.length > 0) {
                        productCode = EMC_COMPONENT.elem.choice_promotion[0].toUpperCase();
                    } else {
                        productCode = EMC_COMPONENT.elem.choice_product[0].toUpperCase();
                    }

                    if (EMC_COMPONENT.elem.choice_tradeIn.length > 0 && EMC_COMPONENT.elem.choice_care.length > 0) {
                        param = "products[0].productCode=" + productCode + "&products[0].quantity=1&products[0].services[0].serviceCode=" + EMC_COMPONENT.elem.choice_tradeIn[0].toUpperCase() + "&products[0].services[0].additionalInfos[0].key=IMEI&products[0].services[0].additionalInfos[0].value=" + imeiCode + "&products[0].services[1].serviceCode=" + EMC_COMPONENT.elem.choice_care[0].toUpperCase();
                    } else if (EMC_COMPONENT.elem.choice_tradeIn.length > 0 && EMC_COMPONENT.elem.choice_care.length === 0) {
                        param = "products[0].productCode=" + productCode + "&products[0].quantity=1&products[0].services[0].serviceCode=" + EMC_COMPONENT.elem.choice_tradeIn[0].toUpperCase() + "&products[0].services[0].additionalInfos[0].key=IMEI&products[0].services[0].additionalInfos[0].value=" + "351234567890123";
                    } else if (EMC_COMPONENT.elem.choice_tradeIn.length === 0 && EMC_COMPONENT.elem.choice_care.length > 0) {
                        param = "products[0].productCode=" + productCode + "&products[0].quantity=1&products[0].services[0].serviceCode=" + EMC_COMPONENT.elem.choice_care[0].toUpperCase();
                    }

                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "jsonp",
                        data: param,
                        success: function (data, textStatus, jqXHR) {
                            if (data.resultCode === "0000") {
                                $(".js-empty-cart").hide();
                                $(".s-btn-utility.js-cart").show();
                                $("#globalCartCount").show();
                                updateTotalCartCount(data.cartCount);
                                EMC_COMPONENT.common.clickPreorder();
                                
                            } else {
								if('undefined' !== typeof win.smg.aem.components.shop) {
									win.smg.aem.components.shop.setBuyingTools.cookiereset();
                                }
                                alert(data.resultMessage);
                            }
                        }
                    });

                } else {
                    EMC_COMPONENT.elem.choice_array = [];

                    if (EMC_COMPONENT.elem.choice_promotion.length > 0) {
                        productCode = EMC_COMPONENT.elem.choice_promotion[0].toUpperCase();
                    } else {
                        productCode = EMC_COMPONENT.elem.choice_product[0].toUpperCase();
                    }

                    EMC_COMPONENT.elem.choice_array[0] = productCode;
                    EMC_COMPONENT.common.clickPreorder();
                }
            }

        },

        click: {

            elem: {

                _optionHeight: 0,
                _prevOptionHeight: 0

            },

            open: function (_this) {

                var sectionActive = _this.parents(".sh-g-shop-buying-tool_product_select").siblings().find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active");

                if (EMC_COMPONENT.elem.default_option_check === false) {

                    _this.parents(".sh-g-shop-buying-tool_product_select").siblings().find(".sh-g-shop-buying-tool_btn_wrap_desc").removeClass("sh-g-shop-buying-tool_active");

                    this.elem._prevOptionHeight = _this.parents(".sh-g-shop-buying-tool_product_select").siblings().find(".sh-g-shop-buying-tool_btn_wrap.sh-g-shop-buying-tool_active").outerHeight();

                    _this.parents(".sh-g-shop-buying-tool_product_select").siblings().removeClass("sh-g-shop-buying-tool_active");
                    _this.parents(".sh-g-shop-buying-tool_product_select").siblings().find(".sh-g-shop-buying-tool_btn_wrap").removeClass("sh-g-shop-buying-tool_active");
                    _this.parents(".sh-g-shop-buying-tool_product_select").siblings().find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                        "min-height": 0,
                        "height": 0,
                        "opacity": 0
                    });
                    _this.parents(".sh-g-shop-buying-tool_product_select").siblings().find(".sh-g-shop-buying-tool_btn_choose").addClass("sh-g-shop-buying-tool_active");

                    if (_this.parents(".sh-g-shop-buying-tool_product_select").siblings().find(".sh-g-shop-buying-tool_btn_skip").length > 0) {
                        _this.parents(".sh-g-shop-buying-tool_product_select").siblings().find(".sh-g-shop-buying-tool_btn_skip").removeClass("sh-g-shop-buying-tool_active");
                    }
                } else {

                    sectionActive.parents(".sh-g-shop-buying-tool_btn_list_wrap").css({
                        "min-height": 0,
                        "height": 0,
                        "opacity": 0
                    });
                    sectionActive.parents(".sh-g-shop-buying-tool_product_select").removeClass("sh-g-shop-buying-tool_active");
                    sectionActive.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_choose").addClass("sh-g-shop-buying-tool_active");

                }

                _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list_wrap").removeAttr("style");
                _this.parent().next(".sh-g-shop-buying-tool_btn_wrap").css({
                    "display": "block",
                    "position": "absolute",
                    "top": -9999,
                    "visibility": "hidden",
                    "width": _this.parents(".sh-g-shop-buying-tool_product_select").width(),
                    "height": "auto"
                });
                
                setTimeout(function () {
                    EMC_COMPONENT.click.elem._optionHeight = _this.parent().next(".sh-g-shop-buying-tool_btn_wrap").outerHeight();
                    _this.parent().next(".sh-g-shop-buying-tool_btn_wrap").removeAttr("style");
                    _this.parent().next(".sh-g-shop-buying-tool_btn_wrap").find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                        "height": 0
                    });

                    setTimeout(function(){
                        _this.parent().next(".sh-g-shop-buying-tool_btn_wrap").find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                            "opacity": 1,
                            "height": EMC_COMPONENT.click.elem._optionHeight
                        });
                    },0);
                },0);

                setTimeout(function () {
                    EMC_COMPONENT.scrollMotion.scroll(null, true);
                    EMC_COMPONENT.scrollMotion.scrollStatic();
                }, 500);

                _this.parent().next(".sh-g-shop-buying-tool_btn_wrap").addClass("sh-g-shop-buying-tool_active");
                
                _this.parents(".sh-g-shop-buying-tool_product_select").addClass("sh-g-shop-buying-tool_active");
                _this.removeClass("sh-g-shop-buying-tool_active");

                if (_this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_skip").length > 0) {
                    _this.next(".sh-g-shop-buying-tool_btn_skip").addClass("sh-g-shop-buying-tool_active");
                }

                if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "trade-in" || _this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "care") {
                    _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list_wrap .sh-g-shop-buying-tool_btn_list").addClass("sh-g-shop-buying-tool_active");
                }

            },

            skip: function (_this, idx) {
                _this.removeClass("sh-g-shop-buying-tool_active");
                _this.parent().next(".sh-g-shop-buying-tool_btn_wrap").removeClass("sh-g-shop-buying-tool_active");
                _this.parent().next(".sh-g-shop-buying-tool_btn_wrap").find(".sh-g-shop-buying-tool_btn_option").removeClass("sh-g-shop-buying-tool_active");
                _this.parents(".sh-g-shop-buying-tool_product_select").removeClass("sh-g-shop-buying-tool_active");
                _this.siblings(".sh-g-shop-buying-tool_btn_choose").addClass("sh-g-shop-buying-tool_active");

                if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "promotion") {
                    if (EMC_COMPONENT.click.draw.elem._promotionCheckArray.length > 0) {
                        _this.siblings(".sh-g-shop-buying-tool_btn_choose").text(EMC_COMPONENT.elem.skipText);
                    } else {
                        _this.siblings(".sh-g-shop-buying-tool_btn_choose").text(EMC_COMPONENT.elem.un_skipText);
                    }
                } else {
                    _this.siblings(".sh-g-shop-buying-tool_btn_choose").text(EMC_COMPONENT.elem.skipText);
                }

                if (EMC_COMPONENT.elem._buyingOptionLen != idx) {
                    _this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_choose").removeClass("sh-g-shop-buying-tool_active");
                    _this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_wrap").addClass("sh-g-shop-buying-tool_active");

                    if (_this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_skip").length > 0) {
                        _this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_skip").addClass("sh-g-shop-buying-tool_active");
                    }
                }

                if (_this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list_wrap").is(".sh-g-shop-buying-tool_trade_type") === true) {
                    _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_trade_list_btn").removeClass("sh-g-shop-buying-tool_active");
                }

                this.elem._optionHeight = _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list_wrap").outerHeight();
                _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                    "height": _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list_wrap").outerHeight()
                });

                EMC_COMPONENT.scrollMotion.scroll("close", true);
                EMC_COMPONENT.scrollMotion.scrollStatic("close");

                setTimeout(function(){
                    _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                        "min-height": 0,
                        "height": 0,
                        "opacity": 0
                    });

                    _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list").removeClass("sh-g-shop-buying-tool_active");
                    
                },0);

                setTimeout(function () {
                    _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_wrap").css('display', 'none');
                    _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list_wrap").removeAttr("style");
                }, 500);

                if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "promotion") {
                    EMC_COMPONENT.elem.choice_promotion = [];
                }

                if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "trade-in") {
                    EMC_COMPONENT.elem.choice_tradeIn = [];
                }

                if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "care") {
                    EMC_COMPONENT.elem.choice_care = [];
                    if ($(document).find("[data-role='insurance-type'] .chk_box input").length > 0) {
                        $(document).find("[data-role='insurance-type'] .chk_box input").prop("checked", false);
                    }

                    if ($(document).find("[data-role='insurance-type'] .ipt_box input").length > 0) {
                        $(document).find("[data-role='insurance-type'] .choose_box:first-child").addClass("active").siblings().removeClass("active");
                        $(document).find("[data-role='insurance-type'] .choose_box:first-child input").prop("checked", true);
                    }
                }

                _this.prev().focus();

            },

            option: function (_this) {
                var depthCheck = _this.is(".sh-g-shop-buying-tool_btn_depth") === true ? false : true,
                    name = "",
                    nameArray = [],
                    type = _this.parents(".sh-g-shop-buying-tool_product_select").data("role-type");

                if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "model") {
                    name = _this.find(".sh-g-shop-buying-tool_tit").text();
                } else if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "carrier") {
                    name = _this.find("img").attr("alt");
                } else if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "storage") {
                    name = _this.find(".sh-g-shop-buying-tool_tit").text().substr(0, _this.find(".sh-g-shop-buying-tool_tit").text().search(/\s/));
                } else if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "color") {
                    name = _this.find(".sh-g-shop-buying-tool_tit").text().trim();
                } else {
                    name = _this.data("role-name");
                }

                if (depthCheck && type != "care") {
                    _this.addClass("sh-g-shop-buying-tool_active");
                    _this.parent().siblings().find(">a").removeClass("sh-g-shop-buying-tool_active");
                    _this.parents(".sh-g-shop-buying-tool_product_select").removeClass("sh-g-shop-buying-tool_active");
                    _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_product_tit_wrap .sh-g-shop-buying-tool_btn_choose").addClass("sh-g-shop-buying-tool_active");
                    _this.parents(".sh-g-shop-buying-tool_product_select").nextAll("[data-required='true']").find(".sh-g-shop-buying-tool_btn_wrap_desc").removeClass("sh-g-shop-buying-tool_active");

                    this.elem._optionHeight = _this.parents(".sh-g-shop-buying-tool_btn_list_wrap").outerHeight();
                    EMC_COMPONENT.scrollMotion.scroll("close", true);
                    EMC_COMPONENT.scrollMotion.scrollStatic();

                    _this.parents(".sh-g-shop-buying-tool_btn_wrap").removeClass("sh-g-shop-buying-tool_active");
                    _this.parents(".sh-g-shop-buying-tool_btn_list_wrap").css({
                        "min-height": 0,
                        "height": 0,
                        "opacity": 0
                    });
                    setTimeout(function () {
                        _this.parents(".sh-g-shop-buying-tool_btn_wrap").css('display', 'none');
                        _this.parents(".sh-g-shop-buying-tool_btn_list_wrap").removeAttr("style");
                    }, 500);
                    _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_product_tit_wrap .sh-g-shop-buying-tool_btn_choose").text(name);

                    if (_this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_skip").length > 0) {
                        _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_skip").removeClass("sh-g-shop-buying-tool_active");
                    }

                } else if (!depthCheck && _this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "trade-in") {
                    _this.find(".sh-g-shop-buying-tool_info_wrap").toggleClass("sh-g-shop-buying-tool_active");
                    _this.next(".sh-g-shop-buying-tool_trade_list_wrap").toggleClass("sh-g-shop-buying-tool_active");

                    if (EMC_COMPONENT.elem._iscroll != null) {
                        EMC_COMPONENT.elem._iscroll.destroy();
                        EMC_COMPONENT.elem._iscroll = null;
                    }

                    if (_this.next(".sh-g-shop-buying-tool_trade_list_wrap").is(".sh-g-shop-buying-tool_active") === true) {
                        _this.find(".sh-g-shop-buying-tool_info_wrap .sh-g-shop-buying-tool_tit em").text("close");
                        _this.find(".sh-g-shop-buying-tool_info_wrap .sh-g-shop-buying-tool_tit").addClass("sh-g-shop-buying-tool_up");
                        _this.parent().siblings().find(".sh-g-shop-buying-tool_info_wrap").removeClass("sh-g-shop-buying-tool_active");
                        _this.parent().siblings().find(".sh-g-shop-buying-tool_trade_list_wrap").removeClass("sh-g-shop-buying-tool_active");
                        _this.parent().siblings().find(".sh-g-shop-buying-tool_info_wrap .sh-g-shop-buying-tool_tit").removeClass("sh-g-shop-buying-tool_up");

                        EMC_COMPONENT.elem._iscroll = new IScroll(".sh-g-shop-buying-tool_trade_list_wrap.sh-g-shop-buying-tool_active", {
                            hScroll: true,
                            useTransform: true,
                            mouseWheel: true,
                            scrollbars: true,
                            disableMouse: true,
                            disablePointer: true,
                            keyBindings: true
                        });

                    } else {
                        _this.find(".sh-g-shop-buying-tool_info_wrap .sh-g-shop-buying-tool_tit em").text("open");
                        _this.find(".sh-g-shop-buying-tool_info_wrap .sh-g-shop-buying-tool_tit").removeClass("sh-g-shop-buying-tool_up");
                        if (EMC_COMPONENT.elem._iscroll != null) {
                            EMC_COMPONENT.elem._iscroll.destroy();
                            EMC_COMPONENT.elem._iscroll = null;
                        }
                    }

                    this.elem._optionHeight = _this.parents(".sh-g-shop-buying-tool_btn_list_wrap").outerHeight();
                    EMC_COMPONENT.scrollMotion.scroll();
                    EMC_COMPONENT.scrollMotion.scrollStatic();

                } else if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "care") {
                    setTimeout(function () {
                        if ($(document).find(".layer_popup_wrap[data-role='insurance-type'] input:checked").length > 0) {
                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] input:checked").focus();
                        } else {
                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] a").filter(":first").focus();
                        }
                    }, 0);

                    this.elem._optionHeight = _this.parents(".sh-g-shop-buying-tool_btn_list_wrap").outerHeight();
                    setTimeout(function () {
                        EMC_COMPONENT.scrollMotion.scroll(null, true);
                        EMC_COMPONENT.scrollMotion.scrollStatic();
                    }, 500);
                }
            },

            draw: {

                elem: {
                    _optionObj: {},
                    _optionArray: [],
                    _matchObj: {},
                    _matchArray: [],
                    _modelTarget: "",
                    _carrierTarget: "",
                    _colorTarget: "",
                    _storageTarget: "",
                    _promotionCheckArray: [],
                    _checkArray: [true, true, true, true]
                },

                drawObj: function () {

                    this.elem._optionObj.model = {};
                    this.elem._optionObj.model.data = [];
                    $.each(EMC_COMPONENT.productInfo, function (i, obj) {

                        EMC_COMPONENT.productInfo[i].filter(function (item) {

                            if ($.inArray(item.model, EMC_COMPONENT.click.draw.elem._optionObj.model.data) === -1) {
                                EMC_COMPONENT.click.draw.elem._optionObj.model.data.push(item.model);
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model] = {};
                            }

                            if (!EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier) {
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier = {};
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier.data = [];
                            }

                            if ($.inArray(item.carrier, EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier.data) === -1) {
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier.data.push(item.carrier);
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier] = {};
                            }

                            if (!EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color) {
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color = {};
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color.data = [];
                            }

                            if ($.inArray(item.color, EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color.data) === -1) {
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color.data.push(item.color);
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color[item.color] = {};
                            }

                            if (!EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color[item.color].storage) {
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color[item.color].storage = {};
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color[item.color].storage.data = [];
                            }

                            if ($.inArray(item.storage, EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color[item.color].storage.data) === -1) {
                                EMC_COMPONENT.click.draw.elem._optionObj.model[item.model].carrier[item.carrier].color[item.color].storage.data.push(item.storage);
                            }

                        });
                    });

                    var optionArray = [];
                    var modelTarget = EMC_COMPONENT.click.draw.elem._optionObj.model.data[0];
                    var carrierTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[modelTarget].carrier.data[0];
                    var colorTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[modelTarget].carrier[carrierTarget].color.data[0];
                    var storageTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[modelTarget].carrier[carrierTarget].color[colorTarget].storage.data[0];

                    optionArray[0] = modelTarget;
                    optionArray[1] = carrierTarget;
                    optionArray[2] = colorTarget;
                    optionArray[3] = storageTarget;
                    this.typeEvent(optionArray, 0);

                },

                typeOption: function (_this, modelIdx, sectionIdx) {

                    if (_this != null) {
                        var type = _this.parents(".sh-g-shop-buying-tool_product_select").data("role-type");

                        if (EMC_COMPONENT.elem.default_option_check === false) {
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll().removeClass("sh-g-shop-buying-tool_required");
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll().find(".sh-g-shop-buying-tool_btn_list").removeClass("sh-g-shop-buying-tool_active");
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll().find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option").removeClass("sh-g-shop-buying-tool_active");
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll().find(".sh-g-shop-buying-tool_btn_choose").text("");
                            EMC_COMPONENT.calc.reset(_this);
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll().find(".sh-g-shop-buying-tool_trade_list_wrap button").removeClass("sh-g-shop-buying-tool_active");
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll().find(".sh-g-shop-buying-tool_btn_wrap_desc").removeClass("sh-g-shop-buying-tool_active");

                            EMC_COMPONENT.elem._imeiCode = "";
                            $(document).find("[data-role='trade-type'] *").removeAttr("style");
                            $(document).find("[data-role='trade-type'] .pop_info_num").val("");
                            $(document).find("[data-role='trade-type'] input").prop("checked", false);
                            $(document).find("[data-role='insurance-type'] input").prop("checked", false);
                            if ($(document).find("[data-role='insurance-type'] .choose_box:first-child input").length > 0) {
                                $(document).find("[data-role='insurance-type'] .choose_box:first-child input").prop("checked", true);
                                $(document).find("[data-role='insurance-type'] .choose_box:first-child").addClass("active").siblings().removeClass("active");
                            }
                            EMC_COMPONENT.elem.choice_product = [];
                            EMC_COMPONENT.elem.choice_promotion = [];
                            EMC_COMPONENT.elem.choice_tradeIn = [];
                            EMC_COMPONENT.elem.choice_care = [];
                        } else {

                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").prevAll("[data-required='true'].sh-g-shop-buying-tool_active").find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                                "height": 0,
                                "min-height": 0,
                                "opacity": 0
                            });

                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").prevAll("[data-required='true'].sh-g-shop-buying-tool_active").find(".sh-g-shop-buying-tool_btn_choose").addClass("sh-g-shop-buying-tool_active");
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").prevAll("[data-required='true']").removeClass("sh-g-shop-buying-tool_active");
                            
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll("[data-required='true']").removeClass("sh-g-shop-buying-tool_required");
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll("[data-required='true']").find(".sh-g-shop-buying-tool_btn_option").removeClass("sh-g-shop-buying-tool_active");
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll("[data-required='true'].sh-g-shop-buying-tool_active").find(".sh-g-shop-buying-tool_btn_choose").removeClass("sh-g-shop-buying-tool_active");
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll("[data-required='true']").find(".sh-g-shop-buying-tool_btn_wrap").addClass("sh-g-shop-buying-tool_active");
                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll("[data-required='true']").find(".sh-g-shop-buying-tool_btn_choose").text("");

                            EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll("[data-required='true'].sh-g-shop-buying-tool_active").find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                                "height": "auto",
                                "min-height": 70
                            });

                            EMC_COMPONENT.calc.reset(_this);
                            EMC_COMPONENT.elem.choice_product = [];
                            EMC_COMPONENT.elem.choice_promotion = [];
                            EMC_COMPONENT.elem.choice_tradeIn = [];
                            EMC_COMPONENT.elem.choice_care = [];

                        }
                    }

                    if (_this != null) {

                        if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "model") {

                            this.elem._modelTarget = _this.data("role-name");
                            this.elem._carrierTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[this.elem._modelTarget].carrier.data[0];
                            this.elem._colorTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[this.elem._modelTarget].carrier[this.elem._carrierTarget].color.data[0];
                            this.elem._storageTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[this.elem._modelTarget].carrier[this.elem._carrierTarget].color[this.elem._colorTarget].storage.data[0];


                            this.elem._optionArray[0] = this.elem._modelTarget;
                            this.elem._optionArray[1] = this.elem._carrierTarget;
                            this.elem._optionArray[2] = this.elem._colorTarget;
                            this.elem._optionArray[3] = this.elem._storageTarget;
                            this.elem._checkArray = [false, true, true, true];

                        }

                        if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "carrier") {

                            this.elem._carrierTarget = _this.data("role-name");
                            this.elem._colorTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[this.elem._modelTarget].carrier[this.elem._carrierTarget].color.data[0];
                            this.elem._storageTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[this.elem._modelTarget].carrier[this.elem._carrierTarget].color[this.elem._colorTarget].storage.data[0];


                            this.elem._optionArray[1] = this.elem._carrierTarget;
                            this.elem._optionArray[2] = this.elem._colorTarget;
                            this.elem._optionArray[3] = this.elem._storageTarget;
                            this.elem._checkArray = [false, false, true, true];

                        }

                        if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "color") {

                            this.elem._colorTarget = _this.data("role-name");
                            this.elem._storageTarget = EMC_COMPONENT.click.draw.elem._optionObj.model[this.elem._modelTarget].carrier[this.elem._carrierTarget].color[this.elem._colorTarget].storage.data[0];

                            this.elem._optionArray[2] = this.elem._colorTarget;
                            this.elem._optionArray[3] = this.elem._storageTarget;
                            this.elem._checkArray = [false, false, false, true];

                        }

                        if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "storage") {
                            this.elem._checkArray = [false, false, false, false];
                        }

                        this.typeEvent(this.elem._optionArray, modelIdx, _this, type);
                    }

                },

                typeEvent: function (optionArray, modelIdx, _this, type) {
                    var carrierArr = EMC_COMPONENT.click.draw.elem._optionObj.model[EMC_COMPONENT.click.draw.elem._optionObj.model.data[modelIdx]].carrier.data,
                        carrierDefaultName = "";

                    if (_this != null) {
                        var type = _this.parents(".sh-g-shop-buying-tool_product_select").data("role-type");
                        EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll().find(".sh-g-shop-buying-tool_btn_list").removeClass("sh-g-shop-buying-tool_active");
                        EMC_COMPONENT.elem._this.find("[data-role-type='" + type + "']").nextAll().find(".sh-g-shop-buying-tool_btn_list .sh-g-shop-buying-tool_btn_option").removeClass("sh-g-shop-buying-tool_active");
                        $(document).find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list").removeAttr("style");
                    }

                    $(document).find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list").removeAttr("style");
                    for (var c = 0; c < carrierArr.length; c++) {
                        if (carrierArr[c] === optionArray[1]) {
                            var carrierType = EMC_COMPONENT.elem._this.find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_option[data-role-name='" + carrierArr[c] + "']");

                            if (this.elem._checkArray[1]) {
                                carrierType.parent().siblings().find(".sh-g-shop-buying-tool_btn_option").removeClass("sh-g-shop-buying-tool_default");
                                carrierType.addClass("sh-g-shop-buying-tool_default");

                                EMC_COMPONENT.elem._this.find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list_wrap").prepend(carrierType.parent());
                            }

                            carrierDefaultName = carrierArr[c];
                            var colorArr = EMC_COMPONENT.click.draw.elem._optionObj.model[EMC_COMPONENT.click.draw.elem._optionObj.model.data[modelIdx]].carrier[carrierDefaultName].color.data;
                        }

                        EMC_COMPONENT.elem._this.find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_option[data-role-name='" + carrierArr[c] + "']").parent().addClass("sh-g-shop-buying-tool_active");

                    }

                    var carrierLen = $(document).find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list.sh-g-shop-buying-tool_active").length;

                    $(document).find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list.sh-g-shop-buying-tool_active").each(function (i) {
                        if ((i % 3) === 1) {
                            if (window.innerWidth > 768) {
                                EMC_COMPONENT.elem._this.find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list.sh-g-shop-buying-tool_active").eq(i).css({
                                    "margin-left": "2%",
                                    "margin-right": "2%"
                                });
                            } else {
                                $(document).find("[data-role-type='carrier'] .sh-g-shop-buying-tool_btn_list.sh-g-shop-buying-tool_active").eq(i).css({
                                    "margin-left": "3%",
                                    "margin-right": "3%"
                                });
                            }
                        }
                    });

                    for (var v = 0; v < colorArr.length; v++) {
                        if (colorArr[v] === optionArray[2]) {

                            var colorType = EMC_COMPONENT.elem._this.find("[data-role-type='color'] .sh-g-shop-buying-tool_btn_option[data-role-name='" + colorArr[v] + "']");

                            if (this.elem._checkArray[2]) {
                                colorType.parent().siblings().find(".sh-g-shop-buying-tool_btn_option").removeClass("sh-g-shop-buying-tool_default");
                                colorType.addClass("sh-g-shop-buying-tool_default");
                                EMC_COMPONENT.elem._this.find("[data-role-type='color'] .sh-g-shop-buying-tool_btn_list_wrap").prepend(colorType.parent());
                            }

                            colorDefaultName = optionArray[2];
                            var storageArr = EMC_COMPONENT.click.draw.elem._optionObj.model[EMC_COMPONENT.click.draw.elem._optionObj.model.data[modelIdx]].carrier[carrierDefaultName].color[colorDefaultName].storage.data;
                        }

                        EMC_COMPONENT.elem._this.find("[data-role-type='color'] .sh-g-shop-buying-tool_btn_option[data-role-name='" + colorArr[v] + "']").parent().addClass("sh-g-shop-buying-tool_active");
                    }

                    EMC_COMPONENT.elem._this.find("[data-role-type='storage'] .sh-g-shop-buying-tool_btn_list").removeClass("sh-g-shop-buying-tool_active");
                    for (var s = 0; s < storageArr.length; s++) {
                        storageArr = storageArr.sort();
                        optionArray[3] = storageArr[0];

                        if (storageArr.sort()[s] === optionArray[3]) {

                            var colorType = EMC_COMPONENT.elem._this.find("[data-role-type='storage'] .sh-g-shop-buying-tool_btn_option[data-role-name='" + storageArr.sort()[0] + "']");

                            if (this.elem._checkArray[3]) {
                                colorType.parent().siblings().find(".sh-g-shop-buying-tool_btn_option").removeClass("sh-g-shop-buying-tool_default");
                                colorType.addClass("sh-g-shop-buying-tool_default");
                            }
                        }

                        EMC_COMPONENT.elem._this.find("[data-role-type='storage'] .sh-g-shop-buying-tool_btn_option[data-role-name='" + storageArr.sort()[s] + "']").parent().addClass("sh-g-shop-buying-tool_active");
                    }

                    if (type != "storage") {
                        EMC_COMPONENT.calc.storagePriceSet(modelIdx);
                    }

                },

                optionCheck: function (type) {
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_product_select[data-required='true']").each(function (i, v) {
                        if ($(this).is(".sh-g-shop-buying-tool_required") === true) {
                            var roleTypeName = $(this).data("role-type"),
                                roleSelectName = $(this).find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name");

                            EMC_COMPONENT.elem._optionSelectData[roleTypeName] = roleSelectName.replace(/(\s*)/g, "").toLowerCase();
                        }
                    });
                },

                promotionCheck: function (_this) {
                    
                    var colorChipHtml = "",
                        stockClass = "",
                        drawCheckIdx = 0,
                        drawCheck = false,
                        modelPrice,
                        setPromotionPrice,
                        setProductPrice,
                        savePrice,
                        addPrice,
                        selectedText = "",
                        selectArray = [],
                        activeCheck = true,
                        nameCheck = false,
                        num = 0;

                    if (_this != null && _this.is(".sh-g-shop-buying-tool_btn_choose")) {
                        if (_this.parents("[data-role-type='promotion']").find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").length > 0) {
                            activeCheck = false;
                        }
                    }

                    if (activeCheck === true) {
                        EMC_COMPONENT.click.draw.elem._matchObj.matchCode = EMC_COMPONENT.elem.choice_product[0];
                        EMC_COMPONENT.click.draw.elem._matchArray = [];

                        EMC_COMPONENT.promotionInfo.filter(function (arr) {
                            for (var i = 0; i < arr.length; i++) {
                                if (arr[i].matchCode === EMC_COMPONENT.click.draw.elem._matchObj.matchCode) {
                                    EMC_COMPONENT.click.draw.elem._matchArray.push(arr[i]);
                                }
                            }
                        });

                        $.each(EMC_COMPONENT.click.draw.elem._matchArray, function (i, obj) {

                            if (i === 0) {
                                selectArray[i] = [];
                                selectArray[i][i] = EMC_COMPONENT.click.draw.elem._matchArray[i];

                            } else {

                                for (var n = 0; n < selectArray.length; n++) {
                                    if (selectArray[n][0].name === obj.name) {
                                        nameCheck = false;
                                        selectArray[n].push(obj);
                                        break;
                                    } else {
                                        nameCheck = true;
                                    }
                                }

                                if (nameCheck === true) {
                                    num = num + 1;
                                    selectArray[num] = [];
                                    selectArray[num][0] = obj;
                                }
                            }
                        });

                        this.elem._promotionCheckArray = [];
                        this.elem._promotionCheckArray = selectArray;

                        function promoMatch() {

                            if (EMC_COMPONENT.elem.choice_product_obj.promotionPrice != undefined && EMC_COMPONENT.elem.choice_product_obj.promotionPrice != "" && EMC_COMPONENT.elem.choice_product_obj.promotionPrice < EMC_COMPONENT.elem.choice_product_obj.price) {
                                modelPrice = EMC_COMPONENT.calc.numberConvert(EMC_COMPONENT.elem.choice_product_obj.promotionPrice);
                            } else {
                                modelPrice = EMC_COMPONENT.calc.numberConvert(EMC_COMPONENT.elem.choice_product_obj.price);
                            }

                            $.each(EMC_COMPONENT.click.draw.elem._promotionCheckArray, function (i, arr) {
                                $.each(arr, function (n, obj) {

                                    setPromotionPrice = EMC_COMPONENT.calc.numberConvert(obj.promotionPrice);
                                    setProductPrice = EMC_COMPONENT.calc.numberConvert(obj.productPrice);
                                    savePrice = (modelPrice + setProductPrice) - setPromotionPrice;
                                    addPrice = setProductPrice - savePrice;

                                    floatCheck = /^([0-9]*)[\.]?([0-9])?$/;

                                    if (floatCheck.test(savePrice)) {
                                        savePrice = EMC_COMPONENT.calc.numberConvert(savePrice);
                                    } else {
                                        savePrice = EMC_COMPONENT.calc.numberConvert(savePrice.toFixed(2));
                                    }

                                    if (floatCheck.test(addPrice)) {
                                        addPrice = EMC_COMPONENT.calc.numberConvert(addPrice);
                                    } else {
                                        addPrice = EMC_COMPONENT.calc.numberConvert(addPrice.toFixed(2));
                                    }

                                    obj.savePrice = savePrice;
                                    obj.addPrice = addPrice;
                                });
                            });

                            if (EMC_COMPONENT.apiPriceSet.elem._successPromotionCheck === true && EMC_COMPONENT.apiPriceSet.elem._successCheck === true) {
                                for (var n = 0; n < EMC_COMPONENT.click.draw.elem._promotionCheckArray.length; n++) {
                                    if (EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].addPrice === 0) {
                                        EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].name + "'] .sh-g-shop-buying-tool_product_inner .sh-g-shop-buying-tool_price_was .sh-g-shop-buying-tool_save_price").text(EMC_COMPONENT.elem._txtFree + " ");

                                    } else {
                                        EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].name + "'] .sh-g-shop-buying-tool_product_inner .sh-g-shop-buying-tool_price_was .sh-g-shop-buying-tool_save_price").text("+" + EMC_COMPONENT.common.addComma(EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].addPrice, EMC_COMPONENT.elem.is_currency) + " ");
                                    }

                                    if (EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].stock === "outOfStock") {
                                        EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].name + "'] .sh-g-shop-buying-tool_stock_txt").addClass("sh-g-shop-buying-tool_active");
                                    }

                                    for (var c = 0; c < EMC_COMPONENT.click.draw.elem._promotionCheckArray[n].length; c++) {

                                        if (EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][c].stock === "outOfStock") {
                                            stockClass = " sh-g-shop-buying-tool_btn_stock";
                                            selectedText = "unselected (out of stock)";
                                        } else {
                                            stockClass = "";
                                            selectedText = "unselected";
                                        }

                                        if (EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][c].matchCode === EMC_COMPONENT.click.draw.elem._matchObj.matchCode) {
                                            colorChipHtml += "<input type='checkbox' id='" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].name.replace(/(\s*)/g, "").toLowerCase() + "_" + (c + 1) + "' name='" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].name.replace(/(\s*)/g, "").toLowerCase() + "_" + (n) + "' class='sh-g-shop-buying-tool_color_chip" + stockClass + "' data-role-idx='" + c + "'>";
                                            colorChipHtml += "<label for='" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].name.replace(/(\s*)/g, "").toLowerCase() + "_" + (c + 1) + "' style='background:" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][c].colorCode + "' data-omni-type='microsite_gallery' data-omni='promotion_color|;" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][c].promotionCode.toLowerCase() + "|" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][c].promotionCode.toUpperCase() + "'>";
                                            colorChipHtml += "<span style='background:" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][c].colorCode + "'>" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][c].color;
                                            colorChipHtml += "<em class='blind'>" + selectedText + "</em>";
                                            colorChipHtml += "</span>";
                                            colorChipHtml += "<span class='sh-g-shop-buying-tool_stock'></span>";
                                            colorChipHtml += "</label>";
                                        }
                                    }

                                    EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].name + "']").next(".sh-g-shop-buying-tool_color_wrap").html(colorChipHtml);
                                    colorChipHtml = "";

                                    EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].name + "'] .sh-g-shop-buying-tool_product_inner .sh-g-shop-buying-tool_price_was .sh-g-shop-buying-tool_price em").html(" &rlm;(<span>" + EMC_COMPONENT.elem._txtSave + " </span>" + EMC_COMPONENT.common.addComma(EMC_COMPONENT.click.draw.elem._promotionCheckArray[n][0].savePrice, EMC_COMPONENT.elem.is_currency) + ")&rlm;");
                                }

                                var promotionList = EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] .sh-g-shop-buying-tool_btn_list");
                                promotionList.each(function () {
                                    if ($(this).is(".sh-g-shop-buying-tool_active") === true) {
                                        $(this).find(".sh-g-shop-buying-tool_color_wrap .sh-g-shop-buying-tool_color_chip").filter(":first").prop("checked", true);

                                        if ($(this).find(".sh-g-shop-buying-tool_color_wrap .sh-g-shop-buying-tool_color_chip").is(".sh-g-shop-buying-tool_btn_stock") === true) {
                                            $(this).find(".sh-g-shop-buying-tool_color_wrap .sh-g-shop-buying-tool_color_chip").filter(":first").next("label").find("em").text("selected (out of stock)");
                                        } else {
                                            $(this).find(".sh-g-shop-buying-tool_color_wrap .sh-g-shop-buying-tool_color_chip").filter(":first").next("label").find("em").text("selected");
                                        }
                                    }
                                });
                            }
                        }
                        promoMatch();

                        if (this.elem._promotionCheckArray.length > 0) {
                            for (var n = 0; n < this.elem._promotionCheckArray.length; n++) {
                                EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + this.elem._promotionCheckArray[n][0].name + "']").parent(".sh-g-shop-buying-tool_btn_list").addClass("sh-g-shop-buying-tool_active");
                                EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + this.elem._promotionCheckArray[n][0].name + "'] figure img").attr("data-src-pc", this.elem._promotionCheckArray[n][0].imgPath);
                                EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + this.elem._promotionCheckArray[n][0].name + "'] figure img").attr("data-src-mobile", this.elem._promotionCheckArray[n][0].mobileImgPath);
                                EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + this.elem._promotionCheckArray[n][0].name + "'] .sh-g-shop-buying-tool_product_inner .sh-g-shop-buying-tool_tit").text(this.elem._promotionCheckArray[n][0].name);

                                EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + this.elem._promotionCheckArray[n][0].name + "']").attr("data-omni", "promotion add to list|;" + this.elem._promotionCheckArray[n][0].promotionCode.toLowerCase() + "|" + this.elem._promotionCheckArray[n][0].promotionCode.toUpperCase());

                                if (addPrice === 0) {
                                    EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + this.elem._promotionCheckArray[n][0].name + "'] .sh-g-shop-buying-tool_product_inner .sh-g-shop-buying-tool_price_was .sh-g-shop-buying-tool_save_price").text(EMC_COMPONENT.elem._txtFree + " ");

                                } else {
                                    EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + this.elem._promotionCheckArray[n][0].name + "'] .sh-g-shop-buying-tool_product_inner .sh-g-shop-buying-tool_price_was .sh-g-shop-buying-tool_save_price").text("+" + EMC_COMPONENT.common.addComma(this.elem._promotionCheckArray[n][0].addPrice, EMC_COMPONENT.elem.is_currency) + " ");
                                }

                                EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + this.elem._promotionCheckArray[n][0].name + "'] .sh-g-shop-buying-tool_product_inner .sh-g-shop-buying-tool_price_was .sh-g-shop-buying-tool_price em").html(" &rlm;(<span>" + EMC_COMPONENT.elem._txtSave + " </span>" + EMC_COMPONENT.common.addComma(this.elem._promotionCheckArray[n][0].savePrice, EMC_COMPONENT.elem.is_currency) + ")&rlm;");

                                for (var c = 0; c < this.elem._promotionCheckArray[n].length; c++) {

                                    if (this.elem._promotionCheckArray[n][c].stock === "outOfStock") {
                                        stockClass = " sh-g-shop-buying-tool_btn_stock";
                                        selectedText = "unselected (out of stock)";
                                    } else {
                                        stockClass = "";
                                        selectedText = "unselected";
                                    }

                                    if (this.elem._promotionCheckArray[n][c].matchCode === EMC_COMPONENT.click.draw.elem._matchObj.matchCode) {
                                        colorChipHtml += "<input type='checkbox' id='" + this.elem._promotionCheckArray[n][0].name.replace(/(\s*)/g, "").toLowerCase() + "_" + (c + 1) + "' name='" + this.elem._promotionCheckArray[n][0].name.replace(/(\s*)/g, "").toLowerCase() + "_" + (n) + "' class='sh-g-shop-buying-tool_color_chip" + stockClass + "' data-role-idx='" + c + "'>";
                                        colorChipHtml += "<label for='" + this.elem._promotionCheckArray[n][0].name.replace(/(\s*)/g, "").toLowerCase() + "_" + (c + 1) + "' style='background:" + this.elem._promotionCheckArray[n][c].colorCode + "' data-omni-type='microsite_gallery' data-omni='promotion_color|;" + this.elem._promotionCheckArray[n][c].promotionCode.toLowerCase() + "|" + this.elem._promotionCheckArray[n][c].promotionCode.toUpperCase() + "'>";
                                        colorChipHtml += "<span style='background:" + this.elem._promotionCheckArray[n][c].colorCode + "'>" + this.elem._promotionCheckArray[n][c].color;
                                        colorChipHtml += "<em class='blind'>" + selectedText + "</em>";
                                        colorChipHtml += "</span>";
                                        colorChipHtml += "<span class='sh-g-shop-buying-tool_stock'></span>";
                                        colorChipHtml += "</label>";
                                    }
                                }

                                EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] [data-role-name='" + this.elem._promotionCheckArray[n][0].name + "']").next(".sh-g-shop-buying-tool_color_wrap").html(colorChipHtml);
                                colorChipHtml = "";
                            }

                            var promotionList = EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] .sh-g-shop-buying-tool_btn_list");
                            promotionList.each(function () {
                                if ($(this).is(".sh-g-shop-buying-tool_active") === true) {
                                    $(this).find(".sh-g-shop-buying-tool_color_wrap .sh-g-shop-buying-tool_color_chip").filter(":first").prop("checked", true);

                                    if ($(this).find(".sh-g-shop-buying-tool_color_wrap .sh-g-shop-buying-tool_color_chip").is(".sh-g-shop-buying-tool_btn_stock") === true) {
                                        $(this).find(".sh-g-shop-buying-tool_color_wrap .sh-g-shop-buying-tool_color_chip").filter(":first").next("label").find("em").text("selected (out of stock)");
                                    } else {
                                        $(this).find(".sh-g-shop-buying-tool_color_wrap .sh-g-shop-buying-tool_color_chip").filter(":first").next("label").find("em").text("selected");
                                    }
                                }
                            });

                            var apiSuccessPromCheckInterval = setInterval(function () {
                                if (EMC_COMPONENT.apiPriceSet.elem._successPromotionCheck === true && EMC_COMPONENT.apiPriceSet.elem._successCheck === true) {
                                    clearInterval(apiSuccessPromCheckInterval);
                                    promoMatch();
                                }
                            });

                            EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] .sh-g-shop-buying-tool_no_data").removeClass("sh-g-shop-buying-tool_active");
                            EMC_COMPONENT.common.imgResizeSrc();
                        } else {
                            EMC_COMPONENT.elem._this.find("[data-role-type='promotion'] .sh-g-shop-buying-tool_no_data").addClass("sh-g-shop-buying-tool_active");
                        }
                    }

                }

            },

            requiredCheck: function (_this, idx) {

                var type,
                    thisId,
                    el;

                EMC_COMPONENT.elem._this.find("[data-required='true']").each(function () {
                    var _this = $(this);

                    if ($(this).is(".sh-g-shop-buying-tool_required") === false) {
                        $(this).find(".sh-g-shop-buying-tool_btn_wrap .sh-g-shop-buying-tool_btn_wrap_desc").addClass("sh-g-shop-buying-tool_active");

                        if (!$(this).find(".sh-g-shop-buying-tool_btn_wrap").is(".sh-g-shop-buying-tool_active")) {
                            setTimeout(function(){
                                _this.find(".sh-g-shop-buying-tool_btn_list_wrap").removeAttr("style");
                                _this.find(".sh-g-shop-buying-tool_btn_wrap").css({
                                    "display": "block",
                                    "position": "absolute",
                                    "top": -9999,
                                    "visibility": "hidden",
                                    "width": _this.width(),
                                    "height": "auto"
                                });

                                EMC_COMPONENT.click.elem._optionHeight = _this.find(".sh-g-shop-buying-tool_btn_wrap").outerHeight();
                                setTimeout(function () {
                                    _this.find(".sh-g-shop-buying-tool_btn_wrap").removeAttr("style");
                                    _this.find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                                        "height": 0
                                    });

                                    _this.find(".sh-g-shop-buying-tool_btn_choose").removeClass("sh-g-shop-buying-tool_active");

                                    setTimeout(function () {
                                        _this.find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                                            "opacity": 1,
                                            "height": EMC_COMPONENT.click.elem._optionHeight
                                        });
                                    }, 0);

                                    _this.find(".sh-g-shop-buying-tool_btn_wrap").addClass("sh-g-shop-buying-tool_active");
                                }, 0);
                            },0);

                            setTimeout(function () {
                                EMC_COMPONENT.click.elem._optionHeight = _this.find(".sh-g-shop-buying-tool_btn_wrap").outerHeight();
                                EMC_COMPONENT.scrollMotion.scroll(null, true);
                                EMC_COMPONENT.scrollMotion.scrollStatic(null);
                            }, 500);
                        }
                        
                        _this.prevAll(".sh-g-shop-buying-tool_product_select").removeClass("sh-g-shop-buying-tool_active");
                        _this.prevAll(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_choose").addClass("sh-g-shop-buying-tool_active");
                        _this.prevAll(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_wrap").removeClass("sh-g-shop-buying-tool_active");
                        _this.prevAll(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_wrap").css("display", "none");
                        _this.prevAll(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list_wrap").removeAttr("style");

                        type = $(this).data("role-type");
                        thisId = $(this).prev().attr("id");

                        if (type === "model") {
                            thisId = $(this).parents(".sh-g-shop-buying-tool_product_detail").attr("id");
                        }

                        el = document.getElementById(thisId);
                        el.scrollIntoView(thisId);
                        $(this).find("a").filter(":first").focus();
                        return false;
                    }
                });

            },

            nextOpen: function (_this) {
                EMC_COMPONENT.elem._buyingOptionIdx = _this.parents(".sh-g-shop-buying-tool_product_select").index();

                if (EMC_COMPONENT.elem._buyingOptionLen != EMC_COMPONENT.elem._buyingOptionIdx) {
                    $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_choose").removeClass("sh-g-shop-buying-tool_active");
                    $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_wrap").addClass("sh-g-shop-buying-tool_active");
                    $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_wrap").css("display","block");

                    if (!$(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().is(".sh-g-shop-buying-tool_active")) {

                        $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).prevAll(".sh-g-shop-buying-tool_product_select.sh-g-shop-buying-tool_active").find(".sh-g-shop-buying-tool_btn_wrap .sh-g-shop-buying-tool_btn_list_wrap").css({
                            "height": 0,
                            "opacity": 0
                        });
                        $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).prevAll(".sh-g-shop-buying-tool_product_select.sh-g-shop-buying-tool_active").find(".sh-g-shop-buying-tool_btn_choose").addClass("sh-g-shop-buying-tool_active");
                        $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).prevAll(".sh-g-shop-buying-tool_product_select.sh-g-shop-buying-tool_active").removeClass("sh-g-shop-buying-tool_active");
                        

                        $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_wrap .sh-g-shop-buying-tool_btn_list_wrap").removeAttr("style");
                        if ($(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().data("role-type") === "trade-in" || $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().data("role-type") === "care") {
                            $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_wrap .sh-g-shop-buying-tool_btn_list").css("display","inline-block");
                        }

                        $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_wrap").css({
                            "display": "block",
                            "position": "absolute",
                            "top": -9999,
                            "visibility": "hidden",
                            "width": _this.parents(".sh-g-shop-buying-tool_product_select").width(),
                            "height": "auto"
                        });

                        setTimeout(function () {
                            EMC_COMPONENT.click.elem._prevOptionHeight = $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).find(".sh-g-shop-buying-tool_btn_wrap").outerHeight();
                            EMC_COMPONENT.click.elem._optionHeight = $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_wrap").outerHeight();

                            $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_wrap").removeAttr("style");
                            $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_wrap .sh-g-shop-buying-tool_btn_list_wrap").css({
                                "height": 0
                            });
                            setTimeout(function () {
                                $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_wrap .sh-g-shop-buying-tool_btn_list_wrap").css({
                                    "opacity": 1,
                                    "height": EMC_COMPONENT.click.elem._optionHeight
                                });
                            }, 0);
                        }, 0);

                        setTimeout(function(){
                            EMC_COMPONENT.scrollMotion.scroll(null, true);
                            EMC_COMPONENT.scrollMotion.scrollStatic();
                        },500);
                    }

                    $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().addClass("sh-g-shop-buying-tool_active");

                    if ($(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_skip").length > 0) {
                        $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_skip").addClass("sh-g-shop-buying-tool_active");
                    }

                    if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "promotion" || _this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "trade-in") {
                        $(document).find(".sh-g-shop-buying-tool_product_select").eq(EMC_COMPONENT.elem._buyingOptionIdx).next().find(".sh-g-shop-buying-tool_btn_list").addClass("sh-g-shop-buying-tool_active");
                    }
                }
            },

            imageChange: {

                product: function (type, resetCheck, modelIdx) {
                    var modelName = "",
                        colorName = "",
                        imgPath = "//image.samsung.com/" + EMC_COMPONENT.elem.site_cd + "/smartphones/galaxy-s9/shop/buyingtool/product/";

                    modelName = "";
                    colorName = "";

                    var imgChange = function (modelName, colorName) {
                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_item").each(function (i) {
                            $(this).find("img").attr("data-src-pc", imgPath + "product_" + modelName + "_" + colorName + "_0" + (i + 1) + ".png");
                            $(this).find("img").attr("data-src-mobile", imgPath + "product_" + modelName + "_" + colorName + "_0" + (i + 1) + ".png");
                        });

                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_thumb_item").each(function (i) {
                            $(this).find("img").attr("data-src-pc", imgPath + "product_" + modelName + "_thumb_" + colorName + "_0" + (i + 1) + ".png");
                            $(this).find("img").attr("data-src-mobile", imgPath + "product_" + modelName + "_thumb_" + colorName + "_0" + (i + 1) + ".png");
                        });

                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_product_visual img").each(function () {
                            var dataSrcPc = $(this).attr("data-src-pc"),
                                dataSrcMo = $(this).attr("data-src-mobile");

                            if (window.innerWidth > 768) {
                                $(this).attr("src", dataSrcPc);
                            } else {
                                $(this).attr("src", dataSrcMo);
                            }
                        });
                    }

                    setTimeout(function () {
                        modelName = EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name");
                        if (EMC_COMPONENT.elem._this.find("[data-role-type='color'] .sh-g-shop-buying-tool_btn_option").is(".sh-g-shop-buying-tool_active")) {
                            colorName = EMC_COMPONENT.elem._this.find("[data-role-type='color'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name").replace(/(\s*)/g, "").toLowerCase();
                        } else {
                            colorName = EMC_COMPONENT.elem._this.find("[data-role-type='color'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").data("role-name").replace(/(\s*)/g, "").toLowerCase();
                        }

                        imgChange(modelName, colorName);
                    }, 0);
                },

                etcChange: function (_this, type) {

                    var btnListIdx = 0,
                        thisIdx = _this.parent().find("input:checked").data("role-idx"),
                        pcImgPath = "",
                        moImgPath = "";

                    if (type === "promotion") {

                        $.each(EMC_COMPONENT.click.draw.elem._promotionCheckArray, function (i, arr) {
                            if (arr[0].name === _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().data("role-name")) {
                                btnListIdx = i;
                            }
                        });

                        pcImgPath = EMC_COMPONENT.click.draw.elem._promotionCheckArray[btnListIdx][thisIdx].imgPath;
                        moImgPath = EMC_COMPONENT.click.draw.elem._promotionCheckArray[btnListIdx][thisIdx].mobileImgPath;

                        if (EMC_COMPONENT.click.draw.elem._promotionCheckArray[btnListIdx][thisIdx].stock === "outOfStock") {
                            _this.parents(".sh-g-shop-buying-tool_product_inner").find(".sh-g-shop-buying-tool_stock_txt").addClass("sh-g-shop-buying-tool_active");
                        } else {
                            _this.parents(".sh-g-shop-buying-tool_product_inner").find(".sh-g-shop-buying-tool_stock_txt").removeClass("sh-g-shop-buying-tool_active");
                        }

                    }

                    _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().find("figure img").attr("data-src-pc", pcImgPath);
                    _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().find("figure img").attr("data-src-mobile", moImgPath);

                    if (window.innerWidth > 768) {
                        _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().find("figure img").attr("src", pcImgPath);
                    } else {
                        _this.parents(".sh-g-shop-buying-tool_color_wrap").prev().find("figure img").attr("src", moImgPath);
                    }
                }

            },

            codeSearch: {

                product: function () {
                    var optionSelectLen = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_product_select[data-required='true']").length,
                        optionChoiceLen = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_product_select[data-required='true'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").length,
                        modelIdx = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_product_select[data-role-type='model'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").parent().index(),
                        choiceKey = [],
                        choiceVal = [],
                        choiceObj = {},
                        choiceLen = 0;

                    for (var v = 1; v < optionSelectLen; v++) {
                        choiceKey.push(EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_product_select[data-required='true']").eq(v).data("role-type"));
                        choiceVal.push(EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_product_select[data-required='true']").eq(v).find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name"));
                    }

                    for (var c = 0; c < choiceKey.length; c++) {
                        choiceObj[choiceKey[c]] = choiceVal[c];
                    }

                    EMC_COMPONENT.elem.choice_product_obj = {};
                    EMC_COMPONENT.elem.choice_product = [];
                    if (optionSelectLen === optionChoiceLen) {

                        function searchCode() {
                            EMC_COMPONENT.productInfo[modelIdx].filter(function (item) {
                                choiceLen = 0;
                                for (var key in choiceObj) {
                                    if (item[key] === choiceObj[key]) {
                                        if (choiceLen != optionSelectLen - 2) {
                                            choiceLen = choiceLen + 1;
                                        } else if (choiceLen === optionSelectLen - 2) {
                                            EMC_COMPONENT.elem.choice_product = [];
                                            EMC_COMPONENT.elem.choice_product_obj = item;
                                            EMC_COMPONENT.elem.choice_product.push(item.code);
                                            choiceLen = 0;
                                        }
                                    }
                                }
                            });
                        }
                        searchCode();

                        if (EMC_COMPONENT.elem.api_check === true) {
                            var searchCodeSuccessCheck = setInterval(function () {
                                if (EMC_COMPONENT.apiPriceSet.elem._successCheck === true) {
                                    clearInterval(searchCodeSuccessCheck);
                                    searchCode();
                                }
                            });
                        }

                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap .sh-g-shop-buying-tool_btn_upgrade").attr("data-omni", "samsung upgrade service|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());

                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap .sh-g-shop-buying-tool_btn_calc").attr("data-omni", "calculator|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());

                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap . a").attr("data-omni", ";" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());

                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_btn_layer").attr("data-omni", "trade-in program|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());
                    }

                },

                etcProdcut: function (_this, type) {

                    if (type === "promotion") {
                        (function () {
                            var thisName = _this.data("role-name"),
                                colorIdx = _this.next().find(".sh-g-shop-buying-tool_color_chip:checked").data("role-idx"),
                                searchArray;

                            searchArray = [];
                            EMC_COMPONENT.click.draw.elem._promotionCheckArray.filter(function (arr) {
                                for (var i = 0; i < arr.length; i++) {
                                    if (arr[i].name === thisName) {
                                        return searchArray = arr;
                                    }
                                }
                            });

                            EMC_COMPONENT.elem.choice_promotion.push(searchArray[colorIdx].promotionCode);
                        }());
                    }

                }
            },

            event: function () {

                $(document).on("click", ".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_product_tit_wrap .sh-g-shop-buying-tool_btn_choose", function (e) {
                    e.preventDefault();
                    var _this = $(this);
                    var typeSection = $(this).parents(".sh-g-shop-buying-tool_product_select"),
                        type = typeSection.data("role-type"),
                        prevLen = typeSection.prevAll().length,
                        prevRequiredLen = typeSection.prevAll(".sh-g-shop-buying-tool_required").length,
                        requiredTypeLen = EMC_COMPONENT.elem._this.find("[data-required='true']").length,
                        requiredLen = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_required").length,
                        requiredIdx = $(this).parents("[data-required='true']").length > 0 ? $(this).parents("[data-required='true']").index() : $(this).parents(".sh-g-shop-buying-tool_product_select").index(),
                        idx = $(this).parents(".sh-g-shop-buying-tool_product_select").index(),
                        modelIdx = 0;

                    modelIdx = EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").parent().index();

                    if (requiredLen >= requiredTypeLen || requiredIdx <= requiredLen) {
                        EMC_COMPONENT.elem.click_sucess_check = true;

                        if (!typeSection.find(".sh-g-shop-buying-tool_btn_option").is(".sh-g-shop-buying-tool_active")) {
                            typeSection.removeClass("sh-g-shop-buying-tool_required");
                        }
                        EMC_COMPONENT.click.open($(this));

                    } else {
                        EMC_COMPONENT.click.requiredCheck();
                    }

                    if ($(this).parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "promotion") {
                        if (requiredLen >= requiredTypeLen || requiredIdx <= requiredLen) {
                            EMC_COMPONENT.click.draw.promotionCheck($(this));
                        } else {
                            EMC_COMPONENT.click.requiredCheck();
                        }
                    }

                    setTimeout(function(){
                        _this.parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_list.sh-g-shop-buying-tool_active").filter(":first").find("a").focus();
                    },0);
                });

                $(document).on("click", ".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_product_tit_wrap .sh-g-shop-buying-tool_btn_skip", function (e) {
                    e.preventDefault();

                    var type = $(this).parents(".sh-g-shop-buying-tool_product_select").data("role-type"),
                        idx = $(this).parents(".sh-g-shop-buying-tool_product_select").index() + 1;

                    EMC_COMPONENT.click.skip($(this), idx);

                    if (type === "promotion" || type === "trade-in") {
                        EMC_COMPONENT.click.nextOpen($(this));
                    }

                    if (type === "trade-in" || type === "care") {
                        $(this).parents(".sh-g-shop-buying-tool_product_select").find("em.blind").text("unselected");
                    }

                    EMC_COMPONENT.calc.reset($(this), type);
                });

                $(document).on("click", ".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_btn_list_wrap > li > a", function (e) {
                    e.preventDefault();

                    var thisOption = $(this),
                        typeSection = thisOption.parents(".sh-g-shop-buying-tool_product_select"),
                        sectionIdx = typeSection.index(),
                        type = typeSection.data("role-type"),
                        requiredCheck = typeSection.data("required") === true ? true : false,
                        idx = 0,
                        requiredPrevLen = typeSection.prevAll().length,
                        requiredPrevIdx = typeSection.prevAll(".sh-g-shop-buying-tool_required").length,
                        requiredLength = EMC_COMPONENT.elem._this.find("[data-required='true']").length - 1,
                        requiredIdx = 0,
                        carePrice = 0,
                        requiredTypeLen = EMC_COMPONENT.elem._this.find("[data-required='true']").length,
                        requiredLen = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_required").length;

                    idx = typeSection.data("role-type") === "model" ? $(this).parent().index() : EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").parent().index();

                    if (requiredCheck === true) {
                        if (EMC_COMPONENT.elem.default_option_check === true) {

                            if (requiredPrevLen === requiredPrevIdx || typeSection.is(".sh-g-shop-buying-tool_required") === true) {
                                EMC_COMPONENT.click.option($(this));
                                EMC_COMPONENT.click.imageChange.product(type, false);
                                typeSection.addClass("sh-g-shop-buying-tool_required");
                                EMC_COMPONENT.elem.click_sucess_check = true;

                            } else {
                                EMC_COMPONENT.elem.click_sucess_check = false;
                                EMC_COMPONENT.click.requiredCheck();
                            }

                            if (EMC_COMPONENT.elem._this.find("[data-required='true'].sh-g-shop-buying-tool_required").length > 0) {
                                EMC_COMPONENT.elem._this.find("[data-required='true'].sh-g-shop-buying-tool_required").each(function (i) {
                                    if (requiredLength > requiredIdx) {
                                        requiredIdx = requiredIdx + 1;
                                    } else if (requiredLength === requiredIdx) {
                                        requiredIdx = 0;
                                        EMC_COMPONENT.elem.default_option_check = false;
                                        EMC_COMPONENT.click.nextOpen(thisOption);
                                    }
                                });
                            }

                        } else {
                            EMC_COMPONENT.click.option($(this));
                            typeSection.addClass("sh-g-shop-buying-tool_required");
                            EMC_COMPONENT.click.imageChange.product(type, false, idx);
                        }

                        if (EMC_COMPONENT.elem.click_sucess_check === true) {
                            $(this).parents(".sh-g-shop-buying-tool_btn_list_wrap").find("a").removeClass("sh-g-shop-buying-tool_active");
                            $(this).parents(".sh-g-shop-buying-tool_btn_list_wrap").find("a").removeClass("sh-g-shop-buying-tool_default");
                            $(this).addClass("sh-g-shop-buying-tool_active");

                            EMC_COMPONENT.click.draw.typeOption($(this), idx, sectionIdx);
                            EMC_COMPONENT.calc.selectProduct($(this), idx);
                        }

                        if ($(this).parents(".sh-g-shop-buying-tool_btn_wrap").find(".sh-g-shop-buying-tool_btn_wrap_desc").length > 0) {
                            $(this).parents(".sh-g-shop-buying-tool_btn_wrap").find(".sh-g-shop-buying-tool_btn_wrap_desc").removeClass("sh-g-shop-buying-tool_active");
                        }

                        if (window.innerWidth > 768) {
                            $(".sh-g-shop-buying-tool_visual_thumb").slick("slickGoTo", 0);
                        }
                        $(".sh-g-shop-buying-tool_visual_view").slick("slickGoTo", 0);

                    } else {
                        if (type != "promotion") {
                            EMC_COMPONENT.click.option($(this));
                        }
                    }

                    EMC_COMPONENT.click.codeSearch.product();

                    if (type != "trade-in" && type != "promotion" && requiredPrevLen === requiredPrevIdx) {
                        EMC_COMPONENT.click.nextOpen(thisOption);
                    }

                    if (type === "trade-in"){
                        $(this).parents(".sh-g-shop-buying-tool_btn_list_wrap").css("height","auto");
                        EMC_COMPONENT.click.elem._optionHeight = $(this).parents(".sh-g-shop-buying-tool_btn_list_wrap").css("height", "auto").outerHeight();
                        
                        EMC_COMPONENT.scrollMotion.scroll();
                        EMC_COMPONENT.scrollMotion.scrollStatic();
                    }

                    if ($(this).parents(".sh-g-shop-buying-tool_product_select").next().data("role-type") === "promotion") {
                        if (requiredPrevLen === requiredPrevIdx){
                            EMC_COMPONENT.click.draw.promotionCheck();
                        }
                    }

                    if (type === "promotion") {
                        if (!$(this).find(".sh-g-shop-buying-tool_stock_txt").is(".sh-g-shop-buying-tool_active")) {
                            EMC_COMPONENT.click.option($(this));
                            EMC_COMPONENT.click.nextOpen(thisOption);
                            EMC_COMPONENT.click.codeSearch.etcProdcut($(this), "promotion");
                            EMC_COMPONENT.calc.selectPromotion($(this));
                            EMC_COMPONENT.calc.result();
                        }
                    }

                    if (type === "care") {
                        $(document).scrollTop(0);
                        $(document).find(".layer_popup_wrap[data-role='insurance-type']").css("display", "block");
                        if ($(document).find(".layer_popup_wrap[data-role='insurance-type'] .choose_box").length === 1) {
                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] .choose_box").removeClass("active");
                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] .choose_box").css({
                                "border-top": "1px solid #d9d9d9",
                                "border-right": 0,
                                "border-bottom": "1px solid #d9d9d9",
                                "border-left": 0,
                            });

                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] .ipt_box").css("display", "none");
                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] .info_wrap .info_desc").css("display", "block");
                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] .notice_wrap .desc").css("display", "block");
                        } else {
                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] .info_wrap .info_desc").css("display", "none");
                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] .notice_wrap .desc").css("display", "none");
                            $(document).find(".layer_popup_wrap[data-role='insurance-type'] .notice_wrap .desc").filter(":first").css("display", "block");
                        }

                        $(document).find(".layer_popup_wrap[data-role='insurance-type'] .btn_add").attr("data-omni", "care service_add to order|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());
                        $(document).find(".layer_popup_wrap[data-role='insurance-type'] .btn_cancel").attr("data-omni", "care service_cancel|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());
                        $(document).find(".layer_popup_wrap[data-role='insurance-type'] .btn_close").attr("data-omni", "care service_cancel|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());

                    }

                    if (EMC_COMPONENT.elem.click_sucess_check && type != "promotion") {
                        EMC_COMPONENT.calc.result();
                    }

                    $(this).parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_choose").focus();
                    EMC_COMPONENT.accessibility.click($(this));
                    EMC_COMPONENT.tagging.clickEvent($(this), type);
                });

                $(document).on("click", ".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_btn_list_wrap .sh-g-shop-buying-tool_color_wrap label", function (e) {
                    e.preventDefault();

                    var type = $(this).parents(".sh-g-shop-buying-tool_product_select").data("role-type"),
                        selectIdx = $(this).parents(".sh-g-shop-buying-tool_btn_list").index(),
                        colorIdx = $(this).prev("input").data("role-idx");

                    $(this).siblings("input").prop("checked",false);
                    $(this).prev().prop("checked", true);

                    EMC_COMPONENT.click.imageChange.etcChange($(this), type);
                    EMC_COMPONENT.calc.priceChange($(this), type, selectIdx, colorIdx);
                    EMC_COMPONENT.calc.result();

                    $(this).parent().find("input").each(function () {
                        if ($(this).is(".sh-g-shop-buying-tool_btn_stock") === true) {
                            $(this).next().find("em.blind").text("unselected (out of stock)");
                        } else {
                            $(this).next().find("em.blind").text("unselected");
                        }
                    });

                    if ($(this).prev().is(".sh-g-shop-buying-tool_btn_stock") === true) {
                        $(this).find("em.blind").text("selected (out of stock)");
                    } else {
                        $(this).find("em.blind").text("selected");
                    }
                });

                $(document).on("click", ".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_btn_layer", function (e) {
                    e.preventDefault();

                    $(document).find("[data-role='work-type']").css("display", "block");
                    $(document).find("[data-role='work-type'] a").filter(":first").focus();
                });

                $(document).on("click", "[data-role='work-type'] .btn_close", function (e) {
                    e.preventDefault();

                    $(document).find("[data-role='work-type']").css("display", "none");
                    $(document).find(".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_btn_layer").focus();
                    EMC_COMPONENT.click.optionFocus($(document).find("[data-role-type='trade-in']"));
                });

                $(document).on("click", ".sh-g-shop-buying-tool_trade_list_wrap button", function (e) {
                    e.preventDefault();

                    var data = $(this).data("role"),
                        dataArray;

                    dataArray = data.split(",");

                    EMC_COMPONENT.tradeInData = {
                        name: dataArray[0],
                        storage: dataArray[1],
                        price: dataArray[2],
                        serciveCode: dataArray[3]
                    }

                    EMC_COMPONENT.elem._tradeBrandIdx = $(this).parents(".sh-g-shop-buying-tool_btn_list").index();
                    EMC_COMPONENT.elem._tradeProductIdx = $(this).index();

                    $(document).find("[data-role='trade-type']").css("display", "block");
                    $(document).find("[data-role='trade-type'] .popup_trade_wrap").focus();
                    $(document).find("[data-role='trade-type']").find(".pop_title").text(EMC_COMPONENT.tradeInData.name);
                    $(document).find("[data-role='trade-type']").find(".pop_memory").text(EMC_COMPONENT.tradeInData.storage);
                    $(document).find("[data-role='trade-type']").find(".pop_price").text(EMC_COMPONENT.tradeInData.price);

                    EMC_COMPONENT.tradeInData.price = EMC_COMPONENT.calc.numberConvert(EMC_COMPONENT.tradeInData.price);

                    if ($(this).is(".sh-g-shop-buying-tool_active") === true) {
                        $(document).find("[data-role='trade-type']").find(".pop_info_num").val(EMC_COMPONENT.elem._imeiCode);
                    }

                    $(document).find("[data-role='trade-type'] .btn_continue").attr("data-omni", "trade-in:step1:continue|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());
                    $(document).find("[data-role='trade-type'] .btn_cancel").attr("data-omni", "trade-in:step1:cancel|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());
                    $(document).find("[data-role='trade-type'] .btn_close").attr("data-omni", "trade-in:step1_close");

                    if (window.innerHeight < $(document).find("[data-role='trade-type'] .popup_trade_wrap").height()) {
                        $(document).find("[data-role='trade-type'] .popup_trade_wrap").css({
                            "top" : 20,
                            "margin-top" : 0
                        });
                    }else{
                        $(document).find("[data-role='trade-type'] .popup_trade_wrap").removeAttr("style");
                    }

                    $(window).scrollTop(0);
                });

                $(document).on("click", "[data-role='trade-type'] .btn_continue", function (e) {
                    e.preventDefault();

                    if ($(this).is(".active") === true) {
                        $(this).parents("[data-role='trade-type']").find(".pop_trade_info .pop_continue").css("display", "none");
                        $(this).parents("[data-role='trade-type']").find(".pop_trade_info .step02").css("display", "table-cell");
                        $(this).parents("[data-role='trade-type']").find(".pop_trade_info .step02 input").filter(":first").focus();
                        $(this).css("display", "none");
                        $(this).parent(".btn_confirm").find(".btn_agree").css("display", "inline-block");

                        $(document).find("[data-role='trade-type'] .btn_agree").attr("data-omni", "trade-in:step2:agree|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());
                        $(document).find("[data-role='trade-type'] .btn_cancel").attr("data-omni", "trade-in:step2:cancel|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());
                        $(document).find("[data-role='trade-type'] .btn_close").attr("data-omni", "trade-in:step2_close");

                    } else {
                        $(document).find("[data-role='trade-type']").find(".pop_info_num").focus();
                    }
                });

                $(document).on("click", "[data-role='trade-type'] .btn_cancel", function (e) {
                    e.preventDefault();

                    EMC_COMPONENT.click.layerClose("trade-type");
                    EMC_COMPONENT.elem._imeiCode = "";
                    EMC_COMPONENT.elem.choice_tradeIn = [];
                    $(document).find("[data-role-type='trade-in'] .sh-g-shop-buying-tool_btn_choose").text(EMC_COMPONENT.elem.skipText);
                    $(document).find("[data-role='trade-type'] .btn_continue").removeClass("active");
                    $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_btn_option").removeClass("sh-g-shop-buying-tool_active");
                    $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_trade_list_btn").eq(EMC_COMPONENT.elem._tradeProductIdx).removeClass("sh-g-shop-buying-tool_active");
                    $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find("em.blind").text("unselected");

                    EMC_COMPONENT.click.optionFocus($(document).find("[data-role-type='trade-in']"));
                    delete EMC_COMPONENT.calc.elem._selPrice.tradeIn;
                    EMC_COMPONENT.calc.result();
                });

                $(document).on("click", "[data-role='trade-type'] .btn_close", function (e) {
                    e.preventDefault();

                    $(document).find("[data-role='trade-type']").css("display", "none");
                    if (EMC_COMPONENT.elem.choice_tradeIn.length === 0) {
                        EMC_COMPONENT.elem._imeiCode = "";
                        $(document).find("[data-role='trade-type'] .pop_info_num").val("");
                        $(document).find("[data-role='trade-type'] .btn_continue").removeClass("active");
                        $(document).find("[data-role='trade-type'] .pop_continue").removeAttr("style");
                        $(document).find("[data-role='trade-type'] .btn_confirm a").removeAttr("style");
                        $(document).find("[data-role='trade-type'] .btn_confirm a:first-child").css("display", "inline-block");
                        $(document).find("[data-role='trade-type'] .pop_continue:first-child").css("display", "table-cell");
                    }

                    $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_trade_list_btn").eq(EMC_COMPONENT.elem._tradeProductIdx).focus();
                    EMC_COMPONENT.click.optionFocus($(document).find("[data-role-type='trade-in']"));
                });

                $(document).on("click", "[data-role='trade-type'] .btn_agree", function (e) {
                    e.preventDefault();

                    var agreeCheck = $(this).parents("[data-role='trade-type']").find(".pop_agree_check").prop("checked") === true ? true : false,
                        selectData = $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_trade_list_btn").eq(EMC_COMPONENT.elem._tradeProductIdx).data("role-name"),
                        tradeInPrice = 0;

                    if (agreeCheck === true) {
                        $(document).find("[data-role='trade-type'] .btn_continue").removeClass("active");
                        EMC_COMPONENT.click.nextOpen($(document).find("[data-role-type='trade-in'] .sh-g-shop-buying-tool_info_wrap.sh-g-shop-buying-tool_active"));
                        EMC_COMPONENT.click.layerClose("trade-type");
                        $(document).find(".sh-g-shop-buying-tool_trade_type").parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_skip").removeClass("sh-g-shop-buying-tool_active");
                        $(document).find(".sh-g-shop-buying-tool_trade_type").parents(".sh-g-shop-buying-tool_btn_wrap").removeClass("sh-g-shop-buying-tool_active");
                        $(document).find(".sh-g-shop-buying-tool_trade_type").parents(".sh-g-shop-buying-tool_product_select").removeClass("sh-g-shop-buying-tool_active");
                        $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_info_wrap").removeClass("sh-g-shop-buying-tool_active");
                        $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_info_wrap .sh-g-shop-buying-tool_tit").removeClass("sh-g-shop-buying-tool_up");
                        $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_trade_list_wrap").removeClass("sh-g-shop-buying-tool_active");
                        $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_trade_list_btn").removeClass("sh-g-shop-buying-tool_active");

                        $(document).find(".sh-g-shop-buying-tool_trade_type").parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_choose").addClass("sh-g-shop-buying-tool_active");
                        $(document).find(".sh-g-shop-buying-tool_trade_type").parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_choose").focus();
                        $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_btn_option").addClass("sh-g-shop-buying-tool_active");
                        $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_trade_list_btn").eq(EMC_COMPONENT.elem._tradeProductIdx).addClass("sh-g-shop-buying-tool_active");
                        $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find("em.blind").text("selected");

                        $(document).find(".sh-g-shop-buying-tool_trade_type").parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_choose").text(selectData);

                        $(document).find("[data-role-type='trade-in'] .sh-g-shop-buying-tool_btn_list_wrap").css({
                            "min-height": 0,
                            "height": 0,
                            "opacity": 0
                        });
                        setTimeout(function () {
                            $(document).find("[data-role-type='trade-in'] .sh-g-shop-buying-tool_btn_wrap").css('display', 'none');
                            $(document).find("[data-role-type='trade-in'] .sh-g-shop-buying-tool_btn_list_wrap").removeAttr("style");

                            EMC_COMPONENT.scrollMotion.elem._contHeight = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_cont").outerHeight(true);
                            
                            EMC_COMPONENT.scrollMotion.scroll();
                            EMC_COMPONENT.scrollMotion.scrollStatic();
                        }, 500);

                        EMC_COMPONENT.click.optionFocus($(document).find("[data-role-type='trade-in']"));

                        tradeInPrice = EMC_COMPONENT.tradeInData.price;
                        EMC_COMPONENT.calc.elem._selPrice.tradeIn = tradeInPrice;

                        EMC_COMPONENT.elem.choice_tradeIn = [];
                        EMC_COMPONENT.elem.choice_tradeIn.push(EMC_COMPONENT.tradeInData.serciveCode);
                        EMC_COMPONENT.calc.result();
                    } else {
                        alert("You must agree to the Terms and Conditions to participate in the Trade-In Program.");
                    }
                });

                $(document).on("click", "[data-role='insurance-type'] .btn_list", function (e) {
                    e.preventDefault();

                    var title = $(this).parents(".txt_info").find(".care_tit").text(),
                        textArray = $(this).parents(".choose_wrap").data("toggle-text").split("/");

                    if ($(this).is(".active")) {
                        $(this).removeClass("active");
                        $(this).parents(".info_box").find(".hide_box").removeClass("active");
                        $(this).attr("title", "Expands text details of " + title + " plan within popup.");
                        $(this).text(textArray[0]);
                        $(this).attr("data-omni", "care service:learn more");
                    } else {
                        $(this).addClass("active");
                        $(this).parents(".info_box").find(".hide_box").addClass("active");
                        $(this).attr("title", "Hides text details of " + title + " plan.");
                        $(this).text(textArray[1]);

                        if ($(this).parents(".choose_box").siblings().find(".btn_list").is(".active")) {
                            $(this).parents(".choose_box").siblings().find(".btn_list").removeClass("active");
                            $(this).parents(".choose_box").siblings().find(".hide_box").removeClass("active");
                            $(this).parents(".choose_box").siblings().find(".btn_list").text(textArray[0]);
                            $(this).parents(".choose_box").siblings().find(".btn_list").attr("data-omni", "care service:learn more");
                        }

                        $(this).attr("data-omni", "care service:show less");
                    }
                });

                $(document).on("click, change", "[data-role='insurance-type'] .ipt_box label, [data-role='insurance-type'] .ipt_box input", function (e) {
                    e.preventDefault();

                    var textArray = $(this).parents(".choose_wrap").data("toggle-text").split("/");

                    $(document).find("[data-role='insurance-type'] .choose_box").removeClass("active");
                    $(this).parents(".choose_box").addClass("active");
                    $(this).prev().prop("checked", true);

                    if ($(this).parents(".choose_box").siblings().find(".btn_list").is(".active")) {
                        $(this).parents(".choose_box").siblings().find(".btn_list").removeClass("active");
                        $(this).parents(".choose_box").siblings().find(".hide_box").removeClass("active");
                        $(this).parents(".choose_box").siblings().find(".btn_list").text(textArray[0]);
                        $(this).parents(".choose_box").siblings().find(".btn_list").attr("data-omni", "care service:learn more");
                    }
                });

                $(document).on("click", "[data-role='insurance-type'] .btn_add", function (e) {
                    e.preventDefault();

                    var checkAgree = $(document).find("[data-role='insurance-type'] .chk_box input").prop("checked"),
                        selectArray = [],
                        selectData,
                        selectPrice;

                    if (checkAgree) {

                        selectArray = $(document).find("[data-role='insurance-type'] .ipt_box input:checked").data("role").split("^");
                        selectPrice = EMC_COMPONENT.calc.numberConvert(selectArray[1]);

                        EMC_COMPONENT.click.layerClose("insurance-type");
                        $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_service_type").parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_skip").removeClass("sh-g-shop-buying-tool_active");
                        $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_service_type").parents(".sh-g-shop-buying-tool_btn_wrap").removeClass("sh-g-shop-buying-tool_active");
                        $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_service_type").parents(".sh-g-shop-buying-tool_product_select").removeClass("sh-g-shop-buying-tool_active");
                        $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_service_type").parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_choose").addClass("sh-g-shop-buying-tool_active");
                        $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_service_type .sh-g-shop-buying-tool_btn_option").addClass("sh-g-shop-buying-tool_active");
                        $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_service_type .sh-g-shop-buying-tool_btn_option em.blind").text("selected");

                        $(document).find(".sh-g-shop-buying-tool_service_type").parents(".sh-g-shop-buying-tool_product_select").find(".sh-g-shop-buying-tool_btn_choose").text("+" + EMC_COMPONENT.common.addComma(selectPrice, EMC_COMPONENT.elem.is_currency));

                        setTimeout(function(){
                            EMC_COMPONENT.click.elem._optionHeight = $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_btn_wrap").outerHeight();
                            EMC_COMPONENT.scrollMotion.scroll("close");
                            EMC_COMPONENT.scrollMotion.scrollStatic("close");
                        },100);
                        
                        $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_btn_list_wrap").css({
                            "min-height": 0,
                            "height": 0,
                            "opacity": 0
                        });

                        setTimeout(function () {
                            $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_btn_wrap").css('display', 'none');
                            $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_btn_list_wrap").removeAttr("style");
                        }, 500);
                        
                        $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_btn_choose").focus();
                        EMC_COMPONENT.click.optionFocus($(document).find("[data-role-type='care']"));

                        EMC_COMPONENT.calc.elem._selPrice.care = selectPrice;

                        EMC_COMPONENT.elem.choice_care = [];
                        EMC_COMPONENT.elem.choice_care.push(selectArray[0].toUpperCase());
                        EMC_COMPONENT.calc.result();

                    } else {
                        alert("You must agree to the Terms and Conditions to use Samsung Care services.");
                    }
                });

                $(document).on("click", "[data-role='insurance-type'] .btn_close", function (e) {
                    e.preventDefault();
                    EMC_COMPONENT.click.optionFocus($(document).find("[data-role-type='care']"));
                    EMC_COMPONENT.click.layerClose("insurance-type");
                });

                $(document).on("click", "[data-role='insurance-type'] .btn_cancel", function (e) {
                    e.preventDefault();

                    EMC_COMPONENT.click.optionFocus($(document).find("[data-role-type='care']"));
                    EMC_COMPONENT.click.layerClose("insurance-type");
                    EMC_COMPONENT.elem.choice_care = [];
                    delete EMC_COMPONENT.calc.elem._selPrice.care;
                    EMC_COMPONENT.calc.result();

                    $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_btn_choose").text(EMC_COMPONENT.elem.skipText);
                    $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_btn_option").removeClass("sh-g-shop-buying-tool_active");
                    if ($(document).find("[data-role='insurance-type'] .chk_box input").length > 0) {
                        $(document).find("[data-role='insurance-type'] .chk_box input").prop("checked", false);
                    }

                    if ($(document).find("[data-role='insurance-type'] .ipt_box input").length > 0) {
                        $(document).find("[data-role='insurance-type'] .choose_box:first-child").addClass("active").siblings().removeClass("active");
                        $(document).find("[data-role='insurance-type'] .choose_box:first-child input").prop("checked", true);
                    }
                });

                $(document).on("click", ".sh-g-shop-buying-tool_product_warp . .sh-g-shop-buying-tool_btn_default", function (e) {
                    e.preventDefault();

                    var thisWrap = EMC_COMPONENT.elem._this,
                        productObj = {},
                        requiredLen = thisWrap.find(".sh-g-shop-buying-tool_required").length,
                        requiredTrueLen = thisWrap.find("[data-required='true']").length;

                    if (requiredLen === requiredTrueLen) {
                        EMC_COMPONENT.cart.event();
                    } else {
                        EMC_COMPONENT.click.requiredCheck();
                    }

                });

                $(document).on("click", ".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_notification .sh-g-shop-buying-tool_mini-cart-checkout-button", function (e) {
                    e.preventDefault();
                    location.href = EMC_COMPONENT.elem.api_url;
                });

                $(document).on("click", ".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_notification .sh-g-shop-buying-tool_addtocart-continue-shopping", function (e) {
                    e.preventDefault();

                    $(document).find(".sh-g-shop-buying-tool_notification > .sh-g-shop-buying-tool_modal").removeClass("sh-g-shop-buying-tool_in");
                    setTimeout(function () {
                        $(document).find(".sh-g-shop-buying-tool_notification .sh-g-shop-buying-tool_modal-backdrop").removeClass("sh-g-shop-buying-tool_in");
                        $(document).find(".sh-g-shop-buying-tool_notification").remove();
                    }, 300);

                    $(document).find(".sh-g-shop-buying-tool_product_warp . .sh-g-shop-buying-tool_btn_default").focus();
                });

                $(document).on("click", ".sh-g-shop-buying-tool_total_wrap .sh-g-shop-buying-tool_fin_tit .sh-g-shop-buying-tool_btn_calc", function (e) {
                    e.preventDefault();

                    var url = "http://www.samsung.com/" + EMC_COMPONENT.elem.site_cd + "/consumer/mobile-devices/smartphones/galaxy-s/galaxy-s7/shop/finanzierung/calculator.html?price=";

                    if (EMC_COMPONENT.calc.elem._selPrice.productPrice === undefined) {
                        if (EMC_COMPONENT.productInfo[0][0].promotionPrice != ""){
                            EMC_COMPONENT.calc.elem._selPrice.productPrice = EMC_COMPONENT.productInfo[0][0].promotionPrice;
                        }else{
                            EMC_COMPONENT.calc.elem._selPrice.productPrice = EMC_COMPONENT.productInfo[0][0].price;
                        }
                    }

                    window.open(url + EMC_COMPONENT.calc.elem._selPrice.productPrice, "MONTHLY INSTALLMENT PLAN", "width=640, height=750");

                });

                $(document).on("touchstart", "[data-role-type='trade-in'] .sh-g-shop-buying-tool_trade_list_wrap.sh-g-shop-buying-tool_active", function (e) {
                    $("html").css("overflow", "hidden");
                });

                $(document).on("touchend", "[data-role-type='trade-in'] .sh-g-shop-buying-tool_trade_list_wrap.sh-g-shop-buying-tool_active", function (e) {
                    $("html").css("overflow", "auto");
                });
            },

            layerClose: function (type) {
                $(document).find("[data-role='" + type + "']").css("display", "none");
                $(document).find("[data-role='" + type + "'] *").removeAttr("style");
                $(document).find("[data-role='" + type + "'] input").val("");

                if (type === "trade-type") {
                    $(document).find("[data-role='" + type + "'] input").prop("checked", false);
                    $(document).find(".sh-g-shop-buying-tool_trade_type .sh-g-shop-buying-tool_btn_list").eq(EMC_COMPONENT.elem._tradeBrandIdx).find(".sh-g-shop-buying-tool_trade_list_btn").eq(EMC_COMPONENT.elem._tradeProductIdx).focus();
                }

                if (type === "insurance-type") {
                    $(document).find("[data-role-type='care'] .sh-g-shop-buying-tool_btn_option").focus();
                }
            },

            optionFocus: function(_this){

                var thisId,
                    el;

                thisId = EMC_COMPONENT.elem._this.find("[data-role-type='model']").attr("id");
                el = document.getElementById(thisId);
                el.scrollIntoView(thisId);

            }
        },

        accessibility: {

            default: function () {

                var modelThis = EMC_COMPONENT.elem._this.find("[data-role-type='model']"),
                    colorThis = EMC_COMPONENT.elem._this.find("[data-role-type='color']"),
                    altArray = ["front and rear", "rear", "left side", "right side", "front side with left rotation", "front side with right rotation"],
                    modelName = "",
                    colorName = "";

                modelName = modelThis.find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active .sh-g-shop-buying-tool_tit").text() || modelThis.find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default .sh-g-shop-buying-tool_tit").text();
                colorName = colorThis.find(".sh-g-shop-buying-tool_btn_option").is(".sh-g-shop-buying-tool_active") === true ? colorThis.find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name") : colorThis.find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").data("role-name");

                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_btn_option").each(function () {
                    if ($(this).is(".sh-g-shop-buying-tool_default") === true) {
                        $(this).find(">em.blind").text("placeholder selection");
                    }

                    if ($(this).is(".sh-g-shop-buying-tool_default") === false && $(this).is(".sh-g-shop-buying-tool_active") === false) {
                        $(this).find(">em.blind").text("unselected");
                    }
                });

                if (window.innerWidth < 769) {
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_view .slick-dots li").each(function (i) {
                        if ($(this).is(".slick-active") === true) {
                            $(this).find("button").html("Slide" + (i + 1) + " - " + modelName + " " + colorName + " " + altArray[i] + " <em class='blind'>selected</em>");
                        } else {
                            $(this).find("button").html("Slide" + (i + 1) + " - " + modelName + " " + colorName + " " + altArray[i] + " <em class='blind'>unselected</em>");
                        }
                    });
                }
            },

            click: function (_this) {

                if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") != "trade-in" && _this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") != "care") {
                    _this.find("em.blind").text("selected");
                    _this.parent().siblings().find("em.blind").text("unselected");
                }

                if (_this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").length > 0) {
                    _this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default em.blind").text("placeholder selection");
                }

                if (_this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").length > 0) {
                    _this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default em.blind").text("selected");
                }

                if (_this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").length != 0 && _this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").length != 0) {
                    _this.parents(".sh-g-shop-buying-tool_product_select").next().find(".sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default em.blind").text("unselected");
                }

                if (_this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "model" || _this.parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "color") {

                    var altArray = ["front and rear", "rear", "left side", "right side", "front side with left rotation", "front side with right rotation"],
                        modelName = "",
                        colorName = "";

                    modelName = EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active .sh-g-shop-buying-tool_tit").text() || EMC_COMPONENT.elem._this.find("[data-role-type='model'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default .sh-g-shop-buying-tool_tit").text();
                    colorName = EMC_COMPONENT.elem._this.find("[data-role-type='color'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_active").data("role-name") || EMC_COMPONENT.elem._this.find("[data-role-type='color'] .sh-g-shop-buying-tool_btn_option.sh-g-shop-buying-tool_default").data("role-name");

                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_view img").each(function (i) {
                        $(this).attr("alt", modelName + " " + colorName + " " + altArray[i]);
                    });

                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_thumb img").each(function (i) {
                        $(this).attr("alt", modelName + " " + colorName + " " + altArray[i] + " thumbnail");
                    });

                    if (window.innerWidth < 769) {
                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_view .slick-dots li").each(function (i) {
                            if ($(this).is(".slick-active") === true) {
                                $(this).find("button").html("Slide" + (i + 1) + " - " + modelName + " " + colorName + " " + altArray[i] + " <em class='blind'>selected</em>");
                            } else {
                                $(this).find("button").html("Slide" + (i + 1) + " - " + modelName + " " + colorName + " " + altArray[i] + " <em class='blind'>unselected</em>");
                            }
                        });
                    }

                    EMC_COMPONENT.elem._this.find(". a").attr("title", "Add " + modelName + " to cart. Opens pop-up window for next action.");

                }
            },

            keyEvent: function () {
                $(document).on("keydown", ".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_btn_list_wrap .sh-g-shop-buying-tool_color_wrap input", function (e) {

                    if (e.keyCode === 32) {
                        e.preventDefault();
                        e.stopPropagation();
                        var type = $(this).parents(".sh-g-shop-buying-tool_product_select").data("role-type"),
                            selectIdx = $(this).parents(".sh-g-shop-buying-tool_btn_list").index(),
                            colorIdx = $(this).data("role-idx");

                        $(this).siblings("input").prop("checked", false);
                        $(this).prop("checked", true);

                        EMC_COMPONENT.click.imageChange.etcChange($(this), type);
                        EMC_COMPONENT.calc.priceChange($(this).next(), type, selectIdx, colorIdx);
                        EMC_COMPONENT.calc.result();

                        $(this).parent().find("input").each(function () {
                            if ($(this).is(".sh-g-shop-buying-tool_btn_stock") === true) {
                                $(this).next().find("em.blind").text("unselected (out of stock)");
                            } else {
                                $(this).next().find("em.blind").text("unselected");
                            }
                        });

                        if ($(this).is(".sh-g-shop-buying-tool_btn_stock") === true) {
                            $(this).next().find("em.blind").text("selected (out of stock)");
                        } else {
                            $(this).next().find("em.blind").text("selected");
                        }
                    }
                });

                $(document).on("keydown", ".sh-g-shop-buying-tool_addtocart-continue-shopping", function (e) {
                    if (e.keyCode === 9 && e.shiftKey) {
                    } else if (e.keyCode === 9) {
                        e.preventDefault();
                        $(document).find(".sh-g-shop-buying-tool_mini-cart-checkout-button").focus();
                    }
                });

                $(document).on("keydown", "[data-role='work-type'] .btn_close", function (e) {
                    if (e.keyCode === 9) {
                        e.preventDefault();
                    }
                });

                $(document).on("keydown", "[data-role='trade-type'] .btn_close", function (e) {
                    if (e.keyCode === 9) {
                        e.preventDefault();
                        if ($(document).find("[data-role='trade-type'] .pop_continue.step01").attr("style") === "display: none;") {
                            $(document).find("[data-role='trade-type'] .pop_continue.step02 input").filter(":first").focus();
                        } else {
                            $(document).find("[data-role='trade-type'] input").filter(":first").focus();
                        }
                    }
                });

                $(document).on("keydown", "[data-role='trade-type'] input, [data-role='trade-type'] label", function (e) {
                    if (e.keyCode === 9 && e.shiftKey) {
                        e.preventDefault();
                        $(document).find("[data-role='trade-type'] .btn_close").focus();
                    }
                });

                $(document).on("keyup", ".sh-g-shop-buying-tool_product_select a, .sh-g-shop-buying-tool_product_select button", function (e) {
                    if (window.innerWidth > 768) {
                        if (e.keyCode === 9 || (e.keyCode === 9 && e.shiftKey)) {
                            e.preventDefault();
                            var thisId,
                                el;

                            if ($(this).parents(".sh-g-shop-buying-tool_product_select").data("role-type") === "model") {
                                thisId = $(this).parents(".sh-g-shop-buying-tool_product_detail").attr("id");
                                el = document.getElementById(thisId);
                            } else {
                                thisId = $(this).parents(".sh-g-shop-buying-tool_product_select").prev().attr("id");
                                el = document.getElementById(thisId);
                            }

                            el.scrollIntoView(thisId);
                        }
                    }
                });

                if ($(document).find("[data-role='insurance-type'] .choose_box input:checked").length > 0) {
                    $(document).on("keydown", "[data-role='insurance-type'] .choose_box input:checked", function (e) {
                        if (e.keyCode === 9 && e.shiftKey) {
                            e.preventDefault();
                            $(document).find("[data-role='insurance-type'] .btn_close").focus();
                        }
                    });
                } else {
                    $(document).on("keydown", "[data-role='insurance-type'] .tit_wrap .btn_more", function (e) {
                        if (e.keyCode === 9 && e.shiftKey) {
                            e.preventDefault();
                            $(document).find("[data-role='insurance-type'] .btn_close").focus();
                        }
                    });
                }

                $(document).on("keydown", "[data-role='insurance-type'] .btn_close", function (e) {
                    if (e.keyCode === 9 && e.shiftKey) {
                        e.preventDefault();
                        $(document).find("[data-role='insurance-type'] .btn_cancel").focus();
                    } else if (e.keyCode === 9) {
                        e.preventDefault();
                        if ($(document).find("[data-role='insurance-type'] .choose_box input:checked").length > 0) {
                            $(document).find("[data-role='insurance-type'] .choose_box input:checked").focus();
                        } else {
                            $(document).find("[data-role='insurance-type'] .choose_box a").filter(":first").focus();
                        }
                    }
                });
            }

        },

        tagging: {

            default: function () {

                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap .sh-g-shop-buying-tool_btn_upgrade").attr("data-omni", "samsung upgrade service|;" + EMC_COMPONENT.productInfo[0][0].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[0][0].code.toUpperCase());

                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap .sh-g-shop-buying-tool_btn_calc").attr("data-omni", "calculator|;" + EMC_COMPONENT.productInfo[0][0].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[0][0].code.toUpperCase());

                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_wrap .sh-g-shop-buying-tool_btn_cart a").attr("data-omni", ";" + EMC_COMPONENT.productInfo[0][0].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[0][0].code.toUpperCase());

                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_thumb_item a").each(function () {
                    $(this).attr("data-omni", "gallery:image|;" + EMC_COMPONENT.productInfo[0][0].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[0][0].code.toUpperCase());
                });

                EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_btn_layer").attr("data-omni", "trade-in program|;" + EMC_COMPONENT.productInfo[0][0].code.toLowerCase() + "|" + EMC_COMPONENT.productInfo[0][0].code.toUpperCase());

            },

            slider: function () {

                if (window.innerWidth < 769) {
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_view .slick-dots li button").each(function (i) {
                        $(this).attr("data-omni-type", "microsite_pcontentinter");
                        $(this).attr("data-omni", "gallery rolling:index_" + (i + 1));
                    });
                }
            },

            clickEvent: function (_this, type) {

                var btnListIdx = 0,
                    thisIdx = _this.parent().find("input:checked").data("role-idx"),
                    checkArray;

                if (type === "model" || type === "carrier" || type === "color" || type === "storage") {
                    if (EMC_COMPONENT.elem.choice_product.length > 0) {
                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_visual_thumb_item a").each(function () {
                            $(this).attr("data-omni", "gallery:image|;" + EMC_COMPONENT.elem.choice_product[0].toLowerCase() + "|" + EMC_COMPONENT.elem.choice_product[0].toUpperCase());
                        });
                    }
                }

                $.each(EMC_COMPONENT.click.draw.elem._promotionCheckArray, function (i, arr) {
                    if (arr[0].name === _this.parents(".sh-g-shop-buying-tool_btn_option").data("role-name")) {
                        btnListIdx = i;
                    }
                });

                checkArray = EMC_COMPONENT.click.draw.elem._promotionCheckArray;

                if (type === "promotion") {
                    _this.attr("data-omni", "promotion add to list|;" + checkArray[btnListIdx][thisIdx].promotionCode.toLowerCase() + "|" + checkArray[btnListIdx][thisIdx].promotionCode.toUpperCase());
                }

            }

        },

        keyEvent: {

            layer: function () {

                $(document).find("[data-role='trade-type'] .pop_info_num").on("keyup", function (e) {
                    var val = $(this).val();
                    EMC_COMPONENT.elem._imeiCode = $(document).find("[data-role='trade-type'] .pop_info_num").val();
                    if (val != "" || val.length > 0) {
                        $(document).find("[data-role='trade-type'] .btn_continue").addClass("active");
                    } else {
                        $(document).find("[data-role='trade-type'] .btn_continue").removeClass("active");
                    }
                });

            }

        },

        totalBar: {

            elem: {
                _totalContW: 0,
                _totalFinWrapW: 0,
                _totalBtnW: 0,
                _totalCheck_first: true,
                _totalCheck_second: false,
                _totalWindowW: 0
            },

            add: function () {

                this.elem._totalContW = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_content").width();
                this.elem._totalFinWrapW1 = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_fin_wrap .sh-g-shop-buying-tool_fin_list").eq(0).width();
                this.elem._totalFinWrapW2 = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_fin_wrap .sh-g-shop-buying-tool_fin_list").eq(1).width();
                this.elem._totalBtnW1 = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_price").width();
                this.elem._totalBtnW2 = EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_btn_cart").width();

                if (window.innerWidth > 768) {
                    var result = this.elem._totalFinWrapW1 + this.elem._totalFinWrapW2 + this.elem._totalBtnW1 + this.elem._totalBtnW2;
                    if (this.elem._totalContW < result + (result * 0.05)) {
                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_content").addClass("sh-g-shop-buying_long_length");
                    } else {
                        EMC_COMPONENT.elem._this.find(".sh-g-shop-buying-tool_total_content").removeClass("sh-g-shop-buying_long_length");
                    }
                }

            },

            resize: function () {
                this.add();
            }

        },

        elemSet: function () {
            var _this = EMC_COMPONENT.elem._this;
            if (_this.find(".sh-g-shop-buying-tool-apiUse").val() == 'N') {
                EMC_COMPONENT.elem.api_check = false;
            } else {
                EMC_COMPONENT.elem.api_check = true;
            }
            if ('undefined' !== typeof _this.find(".sh-g-shop-buying-tool-currency").val() && _this.find(".sh-g-shop-buying-tool-currency").val() != "") {
                EMC_COMPONENT.elem.is_currency = _this.find(".sh-g-shop-buying-tool-currency").val();
            }
        },
        init: function () {

            if ($(".sh-g-shop-buying-tool_product_warp").length > 0) {
                if ($(document).find(".sh-g-shop-buying-tool_product_select").length > 0){

                    $(document).find(".sh-g-shop-buying-tool_product_select.sh-g-shop-buying-tool_active").each(function(){
                        $(this).find(".sh-g-shop-buying-tool_btn_list_wrap").css({
                            "min-height": 70,
                            "opacity": 1
                        });
                    });
                }

                this.elemSet();
                this.dataSet.productData();
                this.dataSet.promotionData();
                this.apiPriceSet.setPrice.setProductPrice();
                this.click.draw.drawObj();
                this.click.draw.typeOption(null, 0);

                this.calc.storagePriceSet(0);
                var apiSuccessCheckInterval = setInterval(function () {
                    if (EMC_COMPONENT.apiPriceSet.elem._successCheck && EMC_COMPONENT.apiPriceSet.elem._successPromotionCheck) {
                        clearInterval(apiSuccessCheckInterval);

                        EMC_COMPONENT.calc.storagePriceSet(0);
                        EMC_COMPONENT.calc.selectProduct();
                    }
                }, 10);

                this.slider();
                this.scrollMotion.scroll();
                this.resize();
                this.scroll();
                this.common.imgResizeSrc();
                this.click.event();
                this.keyEvent.layer();
                this.accessibility.default();
                this.accessibility.keyEvent();
                this.tagging.default();
                this.totalBar.add();
            }

            if ($(".fp-floating-nav__wrap").length > 0) {
                $(".fp-floating-nav__wrap").css("z-index", 100);
            }
        }
    }

    if (window.addEventListener) {
        window.addEventListener('DOMContentLoaded', EMC_COMPONENT.init(), false);
    } else if (window.attachEvent) {
        window.attachEvent('onload', function () {
            EMC_COMPONENT.init();
        });
    }


})(window,jQuery);
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

    if('undefined' === typeof win.smg.aem.components.shop) {
        win.smg.aem.components.shop = {};
    }

    var responsiveNamespace = win.smg.aem.components;
    var namespace = win.smg.aem.components.shop;
    var cookiename="modelsetting_list_shop";

    namespace.setBuyingTools = (function() {
	// 쿠키값 세팅
	    return {
	    	init : function(){
	    			this.setModelDataCookie();
	    	},
	    	cookiereset : function(){
                var cookiePath = this.getCookiePath();
    			this.setCookie(cookiename,"",-1, '/' + cookiePath + '/');
	    	},
		   	// 쿠키값 조회
	    	getCookie : function(cname) {
	    		'use strict';
	    		var name = cname + '=',
	    			ca = document.cookie.split(';'),
	    			c;
	
	    		for(var i=0, leng=ca.length; i<leng; i++) {
	    			c = ca[i];
	    			while (c.charAt(0)===' ') {
	    				c = c.substring(1);
	    			}
	    			if (c.indexOf(name) !== -1) {
	    				return c.substring(name.length,c.length);
	    			}
	    		}
	    		return '';
	    	},
	    	// 국가코드 조회
	    	getCookiePath : function() {
	    		'use strict';
	    		var path = location.pathname;
	    		var cookiePath;
	    		
	    		path = path.split('/');
	    		
	    		if(path[1] === 'content') {
	    			cookiePath = path[1] + '/' + path[2] + '/' + path[3];
	    		} else {
	    			cookiePath = path[1];
	    		}
	    		
	    		return cookiePath;
	    	},
			setCookie : function(cname, cvalue, exdays, site_path) {
				'use strict';
				var d = new Date();
				d.setTime(d.getTime() + ((exdays || 0) * 24 * 60 * 60 * 1000));
				document.cookie = cname + '=' + cvalue + '; expires=' + d.toUTCString() + '; path=' + site_path;
			},setModelDataCookie : function(){
				var cookieVal = this.getCookie(cookiename), _visualHeight, _optionHeight;
				if('' !== cookieVal && 'undefined' !== typeof cookieVal ) {
					var cookieValAtt=cookieVal.split("|");
					$(".sh-g-shop-buying-tool_product_select_list ul").each(function(k){
						var subcheckcnt=0;
						$(this).find("li.sh-g-shop-buying-tool_active").each(function(j){

							var subval=$(this).find("a").data("roleName");
							if(subval==cookieValAtt[k]){
								$(this).find("a").click();
								subcheckcnt=1;
								setTimeout(function () {
									_visualHeight = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_visual").outerHeight(true);
									_optionHeight = $(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_detail").outerHeight(true);
									if (_visualHeight > _optionHeight) {
										$(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_visual").addClass("sh-g-shop-buying-tool_static");
									} else {
										$(".sh-g-shop-buying-tool_product_warp").find(".sh-g-shop-buying-tool_product_visual").removeClass("sh-g-shop-buying-tool_static");
									}
								}, 500);
								return false;
                            }
						});
						if(cookieValAtt.length-1==k || subcheckcnt==0){
								return false;
						}
					});
				}
			}
	    };
    })();
    
    $(function() {
    	var shgshopbuyingtool = $("body").find(".sh-g-shop-buying-tool_total_wrap");
    	if(shgshopbuyingtool.length>0) {
			namespace.setBuyingTools.init();
			$(document).on("click", ".sh-g-shop-buying-tool_product_warp .sh-g-shop-buying-tool_btn_option", function() {
				var ul=$(this).parent().parent();
				var divtype=$(this).parent().parent().parent().parent();
				var divtypename=divtype.data("roleType");
				var index=$(".sh-g-shop-buying-tool_product_select_list ul").index(ul);
				var val=$(this).data("roleName");
				var cookiePath = namespace.setBuyingTools.getCookiePath();
				if("model"===divtypename ||  "carrier"===divtypename ||  "color"===divtypename ||  "storage"===divtypename){
					if(index==0){
						namespace.setBuyingTools.setCookie(cookiename,val,30, '/' + cookiePath + '/');
					}else{
						var classcheck=$(".sh-g-shop-buying-tool_product_select_list ul").eq(index-1).parent().hasClass("sh-g-shop-buying-tool_active");
						if(!classcheck){
							$(".sh-g-shop-buying-tool_product_select_list ul").each(function(k){
								var subval=$(this).find("li .sh-g-shop-buying-tool_active").data("roleName");
								if(k==0){
									val=subval;
								}else{
									val=val+"|"+subval;
								}
								if(index==k){
									return false;
								}
							});
							namespace.setBuyingTools.setCookie(cookiename,val,30, '/' + cookiePath + '/');
						}
					}
				}
			});
		}
    });
})(window, window.jQuery);
; (function ($) {

    var EMC_COMPONENT = {

        elem: {
            currency_character: '$',
            site_cd: $("#shopSiteCode").val(),
            is_global: true,
            is_dollar: true,
            api_check: true,
            api_domain: 'https://shop.samsung.com/',
            _this: $(".sh-g-shop-simple-banner_banner_wrap"),
            rtl_check: $("html").is(".rtl") === true ? true : false,
            choice_product: [],
            data_array: [],
            api_url: ""
        },

        productInfo: [],

        common: {
            numberFormat: function (num) {
                num = num.toString();
                var returnValue = "";
                var dotSepNum = num.toString().indexOf(".");
                var commaSepNum = num.toString().indexOf(",");

                num = num.replace(',', '.');
                var sepNum = num.toString().split(".");
                var arrSize = sepNum.length;
                var returnValue = "";
                if (arrSize >= 3) {
                    for (var i = 0; i < arrSize - 1; i++) {
                        returnValue += sepNum[i];
                    }
                    return returnValue + '.' + sepNum[arrSize - 1];
                } else {
                    if (typeof (sepNum[1]) == 'undefined') {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.00';
                    } else {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + sepNum[1];
                    }
                }
            },

            addComma: function (num) {
                if (EMC_COMPONENT.elem.is_dollar) {
                    var tempSepNum = num.toString().split(".");
                    if (typeof (tempSepNum[1]) == 'undefined') {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.00';
                    } else {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + tempSepNum[1];
                    }
                } else {
                    var tempSepNum = num.toString().split(".");
                    if (typeof (tempSepNum[1]) == 'undefined') {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',00';
                    } else {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',' + tempSepNum[1];
                    }
                }
                return returnValue;
            },

            imgResizeSrc: function () {
                var $image = $(".sh-g-shop-simple-banner_banner_wrap").find("img"),
                    img_array = [],
                    img_sources = [];

                for (var i = 0; i < $(".sh-g-shop-simple-banner_banner_wrap img").length; i++) {
                    $image[i] = $($image[i]);
                    img_sources[i] = EMC_COMPONENT.common.getImageSources($image[i]);

                    if (window.innerWidth > 768) {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[2]);
                    } else {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[1]);
                    }
                }
            },

            getImageSources: function ($image) {
                var s2 = $image.attr('data-src-pc') || $image.attr('src'),
                    s3 = s2,
                    s1 = $image.attr('data-src-mobile') || s2;

                return [null, s1, s2, s3]
            },

            layerOpen: function () {
                var _layerHtml = "<div class='sh-g-shop-simple-banner_notification'><div class='sh-g-shop-simple-banner_modal sh-g-shop-simple-banner_fade' role='dialog' tabindex='-1'><div class='sh-g-shop-simple-banner_modal-backdrop sh-g-shop-simple-banner_fade'></div><div class='sh-g-shop-simple-banner_modal-dialog' role='document'><div class='sh-g-shop-simple-banner_modal-content'><div class='sh-g-shop-simple-banner_modal-body sh-g-shop-simple-banner_text-center'><div class='sh-g-shop-simple-banner_icon-tick-96-px' data-grunticon-embed><svg width='96px' height='96px' viewBox='0 0 96 96' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns: xlink='http://www.w3.org/1999/xlink'><desc>Created with sketchtool.</desc><defs><circle id='path-1' cx='32' cy='32' r='32'></circle><mask id='mask-2' maskContentUnits='userSpaceOnUse' maskUnits='objectBoundingBox' x='0' y='0' width='64' height='64' fill='white'><use xlink: href='#path-1'></use></mask></defs><g id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><g id='Icons' transform='translate(-535.000000, -1272.000000)'><g id='64px' transform='translate(535.000000, 272.000000)' stroke-linecap='square' stroke='#008378'><g id='Icon/96/tick-96px' transform='translate(0.000000, 1000.000000)'><g id='tick' transform='translate(16.000000, 16.000000)'><polyline id='Line' stroke-width='2' points='20.8 35.36 28.8 42.4 42.4 22.4'></polyline></g></g></g><g id='16px' transform='translate(135.000000, 224.000000)'></g></g></g></svg></div><p>Item added</p><a href='/au/cart/' class='sh-g-shop-simple-banner_btn sh-g-shop-simple-banner_btn-default sh-g-shop-simple-banner_btn-block sh-g-shop-simple-banner_mini-cart-checkout-button sh-g-shop-simple-banner_js-chekcout-popup-notif' data-omni-type='microsite_scView' data-omni=''>Checkout</a><a href='#' data-dismiss='modal' class='sh-g-shop-simple-banner_btn sh-g-shop-simple-banner_btn-link sh-g-shop-simple-banner_addtocart-continue-shopping sh-g-shop-simple-banner_js-continue-modal' data-omni-type='microsite_basketAdd' data-omni='basket:continue shopping'>Continue Shopping</a></div></div></div></div></div>";

                EMC_COMPONENT.elem._this.append(_layerHtml);
                EMC_COMPONENT.elem._this.find(".sh-g-shop-simple-banner_notification > .sh-g-shop-simple-banner_modal").css("display", "block");
                setTimeout(function () {
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-simple-banner_notification > .sh-g-shop-simple-banner_modal").addClass("sh-g-shop-simple-banner_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-simple-banner_notification .sh-g-shop-simple-banner_modal-backdrop").addClass("sh-g-shop-simple-banner_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-shop-simple-banner_notification a").filter(":first").focus();
                }, 100);
            },

            clickPreorder: function () {
                var selectIdx = $(".model-choose .color li.active").index();
                var checkCookieAPI = '',
                    buyNowAPI = '',
                    //change /nc/cartAndCheckout -> /cart
                    cartAndCheckAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/cart';

                if (!EMC_COMPONENT.elem.is_global) {
                    checkCookieAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/makeBuyNowCookie';
                    addCartAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';

                    $.ajax({
                        url: checkCookieAPI,
                        dataType: 'jsonp',
                        success: function (data) {
                            if (data.resultCode == '0000') {
                                buyNow(addCartAPI, cartAndCheckAPI);
                            } else {
                                alert(data.resultMessage);
                            }
                        }
                    });

                } else {
                    //change /ng/p4v1/buyNow -> /ng/p4v1/addCart
                    buyNowAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';
                    EMC_COMPONENT.common.buyNow(buyNowAPI, cartAndCheckAPI);
                }
            },

            buyNow: function (urlApi, checkApi) {
                // ajax API
                var count = 0,
                    paramater = 'quantity=1&productCode=',
                    accParamater = '',
                    quantity = [];

                //tagging      
                var resultName = [],
                    resultPid = [],
                    tagModelCode = '',
                    tagPid = '';

                $.each(EMC_COMPONENT.elem.choice_product, function (index, ele) {
                    if ($.inArray(ele, resultName) == -1) {
                        resultName.push(ele);
                    }
                });

                if (EMC_COMPONENT.elem.choice_product.length != 0) {

                    for (var i = 0; i < EMC_COMPONENT.elem.choice_product.length; i++) {
                        var keyPid = EMC_COMPONENT.elem.choice_product[i];
                        if (!quantity[keyPid]) {
                            quantity[keyPid] = 1;
                        } else {
                            quantity[keyPid] = quantity[keyPid] + 1;
                        }
                    }

                    var choice_result = 0;
                    var accParamater = "";
                    function checkout() {
                        accParamater = "quantity=" + quantity[keyPid] + "&productCode=" + EMC_COMPONENT.elem.choice_product[choice_result];

                        $.ajax({
                            url: urlApi + accParamater,
                            dataType: 'jsonp',
                            async: false,
                            success: function (data) {
                                if (data.resultCode == '0000') {
                                    $(".js-empty-cart").hide();
                                    $(".s-btn-utility.js-cart").show();
                                    $("#globalCartCount").show();
                                    updateTotalCartCount(data.cartCount);
                                    EMC_COMPONENT.common.layerOpen();
                                    EMC_COMPONENT.elem.api_url = checkApi;
                                } else {
                                    alert(data.resultMessage);
                                }
                            }
                        });
                    }
                    checkout();
                }
            }

        },

        resize: function () {

            $(window).resize(function () {
                EMC_COMPONENT.common.imgResizeSrc();
            });

        },

        init: function () {
            this.resize();
            this.common.imgResizeSrc();
        }
    }

    if (window.addEventListener) {
        window.addEventListener('DOMContentLoaded', EMC_COMPONENT.init(), false);
    } else if (window.attachEvent) {
        window.attachEvent('onload', function () {
            EMC_COMPONENT.init();
        });
    }


})(jQuery);
; (function ($) {

    var EMC_COMPONENT = {

        elem: {
            currency_character: '$',
            site_cd: $("#shopSiteCode").val(),
            is_global: true,
            is_dollar: true,
            api_check: true,
            api_domain: 'https://shop.samsung.com/',
            _this: $(".sh-g-nonshop-check_check_wrap"),
            rtl_check: $("html").is(".rtl") === true ? true : false,
            choice_product: [],
            data_array: [],
            api_url: ""
        },

        productInfo: [],

        common: {
            numberFormat: function (num) {
                num = num.toString();
                var returnValue = "";
                var dotSepNum = num.toString().indexOf(".");
                var commaSepNum = num.toString().indexOf(",");

                num = num.replace(',', '.');
                var sepNum = num.toString().split(".");
                var arrSize = sepNum.length;
                var returnValue = "";
                if (arrSize >= 3) {
                    for (var i = 0; i < arrSize - 1; i++) {
                        returnValue += sepNum[i];
                    }
                    return returnValue + '.' + sepNum[arrSize - 1];
                } else {
                    if (typeof (sepNum[1]) == 'undefined') {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.00';
                    } else {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + sepNum[1];
                    }
                }
            },

            addComma: function (num) {
                if (EMC_COMPONENT.elem.is_dollar) {
                    var tempSepNum = num.toString().split(".");
                    if (typeof (tempSepNum[1]) == 'undefined') {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.00';
                    } else {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + tempSepNum[1];
                    }
                } else {
                    var tempSepNum = num.toString().split(".");
                    if (typeof (tempSepNum[1]) == 'undefined') {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',00';
                    } else {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',' + tempSepNum[1];
                    }
                }
                return returnValue;
            },

            imgResizeSrc: function () {
                var $image = $(".sh-g-nonshop-check_check_wrap").find("img"),
                    img_array = [],
                    img_sources = [];

                for (var i = 0; i < $(".sh-g-nonshop-check_check_wrap img").length; i++) {
                    $image[i] = $($image[i]);
                    img_sources[i] = EMC_COMPONENT.common.getImageSources($image[i]);

                    if (window.innerWidth > 768) {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[2]);
                    } else {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[1]);
                    }
                }
            },

            getImageSources: function ($image) {
                var s2 = $image.attr('data-src-pc') || $image.attr('src'),
                    s3 = s2,
                    s1 = $image.attr('data-src-mobile') || s2;

                return [null, s1, s2, s3]
            },

            layerOpen: function () {
                var _layerHtml = "<div class='sh-g-nonshop-check_notification'><div class='sh-g-nonshop-check_modal sh-g-nonshop-check_fade' role='dialog' tabindex='-1'><div class='sh-g-nonshop-check_modal-backdrop sh-g-nonshop-check_fade'></div><div class='sh-g-nonshop-check_modal-dialog' role='document'><div class='sh-g-nonshop-check_modal-content'><div class='sh-g-nonshop-check_modal-body sh-g-nonshop-check_text-center'><div class='sh-g-nonshop-check_icon-tick-96-px' data-grunticon-embed><svg width='96px' height='96px' viewBox='0 0 96 96' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns: xlink='http://www.w3.org/1999/xlink'><desc>Created with sketchtool.</desc><defs><circle id='path-1' cx='32' cy='32' r='32'></circle><mask id='mask-2' maskContentUnits='userSpaceOnUse' maskUnits='objectBoundingBox' x='0' y='0' width='64' height='64' fill='white'><use xlink: href='#path-1'></use></mask></defs><g id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><g id='Icons' transform='translate(-535.000000, -1272.000000)'><g id='64px' transform='translate(535.000000, 272.000000)' stroke-linecap='square' stroke='#008378'><g id='Icon/96/tick-96px' transform='translate(0.000000, 1000.000000)'><g id='tick' transform='translate(16.000000, 16.000000)'><polyline id='Line' stroke-width='2' points='20.8 35.36 28.8 42.4 42.4 22.4'></polyline></g></g></g><g id='16px' transform='translate(135.000000, 224.000000)'></g></g></g></svg></div><p>Item added</p><a href='/au/cart/' class='sh-g-nonshop-check_btn sh-g-nonshop-check_btn-default sh-g-nonshop-check_btn-block sh-g-nonshop-check_mini-cart-checkout-button sh-g-nonshop-check_js-chekcout-popup-notif' data-omni-type='microsite_scView' data-omni=''>Checkout</a><a href='#' data-dismiss='modal' class='sh-g-nonshop-check_btn sh-g-nonshop-check_btn-link sh-g-nonshop-check_addtocart-continue-shopping sh-g-nonshop-check_js-continue-modal' data-omni-type='microsite_basketAdd' data-omni='basket:continue shopping'>Continue Shopping</a></div></div></div></div></div>";

                EMC_COMPONENT.elem._this.append(_layerHtml);
                EMC_COMPONENT.elem._this.find(".sh-g-nonshop-check_notification > .sh-g-nonshop-check_modal").css("display", "block");
                setTimeout(function () {
                    EMC_COMPONENT.elem._this.find(".sh-g-nonshop-check_notification > .sh-g-nonshop-check_modal").addClass("sh-g-nonshop-check_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-nonshop-check_notification .sh-g-nonshop-check_modal-backdrop").addClass("sh-g-nonshop-check_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-nonshop-check_notification a").filter(":first").focus();
                }, 100);
            },

            clickPreorder: function () {
                var selectIdx = $(".model-choose .color li.active").index();
                var checkCookieAPI = '',
                    buyNowAPI = '',
                    //change /nc/cartAndCheckout -> /cart
                    cartAndCheckAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/cart';

                if (!EMC_COMPONENT.elem.is_global) {
                    checkCookieAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/makeBuyNowCookie';
                    addCartAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';

                    $.ajax({
                        url: checkCookieAPI,
                        dataType: 'jsonp',
                        success: function (data) {
                            if (data.resultCode == '0000') {
                                buyNow(addCartAPI, cartAndCheckAPI);
                            } else {
                                alert(data.resultMessage);
                            }
                        }
                    });

                } else {
                    //change /ng/p4v1/buyNow -> /ng/p4v1/addCart
                    buyNowAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';
                    EMC_COMPONENT.common.buyNow(buyNowAPI, cartAndCheckAPI);
                }
            },

            buyNow: function (urlApi, checkApi) {
                // ajax API
                var count = 0,
                    paramater = 'quantity=1&productCode=',
                    accParamater = '',
                    quantity = [];

                //tagging      
                var resultName = [],
                    resultPid = [],
                    tagModelCode = '',
                    tagPid = '';

                $.each(EMC_COMPONENT.elem.choice_product, function (index, ele) {
                    if ($.inArray(ele, resultName) == -1) {
                        resultName.push(ele);
                    }
                });

                if (EMC_COMPONENT.elem.choice_product.length != 0) {

                    for (var i = 0; i < EMC_COMPONENT.elem.choice_product.length; i++) {
                        var keyPid = EMC_COMPONENT.elem.choice_product[i];
                        if (!quantity[keyPid]) {
                            quantity[keyPid] = 1;
                        } else {
                            quantity[keyPid] = quantity[keyPid] + 1;
                        }
                    }

                    var choice_result = 0;
                    var accParamater = "";
                    function checkout() {
                        accParamater = "quantity=" + quantity[keyPid] + "&productCode=" + EMC_COMPONENT.elem.choice_product[choice_result];

                        $.ajax({
                            url: urlApi + accParamater,
                            dataType: 'jsonp',
                            async: false,
                            success: function (data) {
                                if (data.resultCode == '0000') {
                                    $(".js-empty-cart").hide();
                                    $(".s-btn-utility.js-cart").show();
                                    $("#globalCartCount").show();
                                    updateTotalCartCount(data.cartCount);
                                    EMC_COMPONENT.common.layerOpen();
                                    EMC_COMPONENT.elem.api_url = checkApi;
                                } else {
                                    alert(data.resultMessage);
                                }
                            }
                        });
                    }
                    checkout();
                }
            }

        },

        resize: function () {

            $(window).resize(function () {
                EMC_COMPONENT.common.imgResizeSrc();
            });

        },

        init: function () {
            this.resize();
            this.common.imgResizeSrc();
        }
    }

    if (window.addEventListener) {
        window.addEventListener('DOMContentLoaded', EMC_COMPONENT.init(), false);
    } else if (window.attachEvent) {
        window.attachEvent('onload', function () {
            EMC_COMPONENT.init();
        });
    }


})(jQuery);
;(function ($){
	$(function(){
		var tag = $("#firstmodelcode").val();
		if(typeof tag != "undefined"){
			$(".sh-g-nonshop-check_check_wrap").find(".sh-g-nonshop-check_check_list").find("a").attr("ga-la", tag);
		}
	});
})(jQuery);
; (function ($) {

    var EMC_COMPONENT = {

        elem: {
            currency_character: '$',
            site_cd: $("#shopSiteCode").val(),
            is_global: true,
            is_dollar: true,
            api_check: true,
            api_domain: 'https://shop.samsung.com/',
            _this: $(".sh-g-in-box_components_wrap"),
            rtl_check: $("html").is(".rtl") === true ? true : false,
            choice_product: [],
            data_array: [],
            api_url: ""
        },

        productInfo: [],

        common: {
            numberFormat: function (num) {
                num = num.toString();
                var returnValue = "";
                var dotSepNum = num.toString().indexOf(".");
                var commaSepNum = num.toString().indexOf(",");

                num = num.replace(',', '.');
                var sepNum = num.toString().split(".");
                var arrSize = sepNum.length;
                var returnValue = "";
                if (arrSize >= 3) {
                    for (var i = 0; i < arrSize - 1; i++) {
                        returnValue += sepNum[i];
                    }
                    return returnValue + '.' + sepNum[arrSize - 1];
                } else {
                    if (typeof (sepNum[1]) == 'undefined') {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.00';
                    } else {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + sepNum[1];
                    }
                }
            },

            addComma: function (num) {
                if (EMC_COMPONENT.elem.is_dollar) {
                    var tempSepNum = num.toString().split(".");
                    if (typeof (tempSepNum[1]) == 'undefined') {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.00';
                    } else {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + tempSepNum[1];
                    }
                } else {
                    var tempSepNum = num.toString().split(".");
                    if (typeof (tempSepNum[1]) == 'undefined') {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',00';
                    } else {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',' + tempSepNum[1];
                    }
                }
                return returnValue;
            },

            imgResizeSrc: function () {
                var $image = $(".sh-g-in-box_components_wrap").find("img"),
                    img_array = [],
                    img_sources = [];

                for (var i = 0; i < $(".sh-g-in-box_components_wrap img").length; i++) {
                    $image[i] = $($image[i]);
                    img_sources[i] = EMC_COMPONENT.common.getImageSources($image[i]);

                    if (window.innerWidth > 768) {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[2]);
                    } else {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[1]);
                    }
                }
            },

            getImageSources: function ($image) {
                var s2 = $image.attr('data-src-pc') || $image.attr('src'),
                    s3 = s2,
                    s1 = $image.attr('data-src-mobile') || s2;

                return [null, s1, s2, s3]
            },

            layerOpen: function () {
                var _layerHtml = "<div class='sh-g-cover_notification'><div class='sh-g-cover_modal sh-g-cover_fade' role='dialog' tabindex='-1'><div class='sh-g-cover_modal-backdrop sh-g-cover_fade'></div><div class='sh-g-cover_modal-dialog' role='document'><div class='sh-g-cover_modal-content'><div class='sh-g-cover_modal-body sh-g-cover_text-center'><div class='sh-g-cover_icon-tick-96-px' data-grunticon-embed><svg width='96px' height='96px' viewBox='0 0 96 96' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns: xlink='http://www.w3.org/1999/xlink'><desc>Created with sketchtool.</desc><defs><circle id='path-1' cx='32' cy='32' r='32'></circle><mask id='mask-2' maskContentUnits='userSpaceOnUse' maskUnits='objectBoundingBox' x='0' y='0' width='64' height='64' fill='white'><use xlink: href='#path-1'></use></mask></defs><g id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><g id='Icons' transform='translate(-535.000000, -1272.000000)'><g id='64px' transform='translate(535.000000, 272.000000)' stroke-linecap='square' stroke='#008378'><g id='Icon/96/tick-96px' transform='translate(0.000000, 1000.000000)'><g id='tick' transform='translate(16.000000, 16.000000)'><polyline id='Line' stroke-width='2' points='20.8 35.36 28.8 42.4 42.4 22.4'></polyline></g></g></g><g id='16px' transform='translate(135.000000, 224.000000)'></g></g></g></svg></div><p>Item added</p><a href='/au/cart/' class='sh-g-cover_btn sh-g-cover_btn-default sh-g-cover_btn-block sh-g-cover_mini-cart-checkout-button sh-g-cover_js-chekcout-popup-notif' data-omni-type='microsite_scView' data-omni=''>Checkout</a><a href='#' data-dismiss='modal' class='sh-g-cover_btn sh-g-cover_btn-link sh-g-cover_addtocart-continue-shopping sh-g-cover_js-continue-modal' data-omni-type='microsite_basketAdd' data-omni='basket:continue shopping'>Continue Shopping</a></div></div></div></div></div>";

                EMC_COMPONENT.elem._this.append(_layerHtml);
                EMC_COMPONENT.elem._this.find(".sh-g-cover_notification > .sh-g-cover_modal").css("display", "block");
                setTimeout(function () {
                    EMC_COMPONENT.elem._this.find(".sh-g-cover_notification > .sh-g-cover_modal").addClass("sh-g-cover_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-cover_notification .sh-g-cover_modal-backdrop").addClass("sh-g-cover_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-cover_notification a").filter(":first").focus();
                }, 100);
            },

            clickPreorder: function () {
                var selectIdx = $(".model-choose .color li.active").index();
                var checkCookieAPI = '',
                    buyNowAPI = '',
                    //change /nc/cartAndCheckout -> /cart
                    cartAndCheckAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/cart';

                if (!EMC_COMPONENT.elem.is_global) {
                    checkCookieAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/makeBuyNowCookie';
                    addCartAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';

                    $.ajax({
                        url: checkCookieAPI,
                        dataType: 'jsonp',
                        success: function (data) {
                            if (data.resultCode == '0000') {
                                buyNow(addCartAPI, cartAndCheckAPI);
                            } else {
                                alert(data.resultMessage);
                            }
                        }
                    });

                } else {
                    //change /ng/p4v1/buyNow -> /ng/p4v1/addCart
                    buyNowAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';
                    EMC_COMPONENT.common.buyNow(buyNowAPI, cartAndCheckAPI);
                }
            },

            buyNow: function (urlApi, checkApi) {
                // ajax API
                var count = 0,
                    paramater = 'quantity=1&productCode=',
                    accParamater = '',
                    quantity = [];

                //tagging      
                var resultName = [],
                    resultPid = [],
                    tagModelCode = '',
                    tagPid = '';

                $.each(EMC_COMPONENT.elem.choice_product, function (index, ele) {
                    if ($.inArray(ele, resultName) == -1) {
                        resultName.push(ele);
                    }
                });

                if (EMC_COMPONENT.elem.choice_product.length != 0) {

                    for (var i = 0; i < EMC_COMPONENT.elem.choice_product.length; i++) {
                        var keyPid = EMC_COMPONENT.elem.choice_product[i];
                        if (!quantity[keyPid]) {
                            quantity[keyPid] = 1;
                        } else {
                            quantity[keyPid] = quantity[keyPid] + 1;
                        }
                    }

                    var choice_result = 0;
                    var accParamater = "";
                    function checkout() {
                        accParamater = "quantity=" + quantity[keyPid] + "&productCode=" + EMC_COMPONENT.elem.choice_product[choice_result];

                        $.ajax({
                            url: urlApi + accParamater,
                            dataType: 'jsonp',
                            async: false,
                            success: function (data) {
                                if (data.resultCode == '0000') {
                                    $(".js-empty-cart").hide();
                                    $(".s-btn-utility.js-cart").show();
                                    $("#globalCartCount").show();
                                    updateTotalCartCount(data.cartCount);
                                    EMC_COMPONENT.common.layerOpen();
                                    EMC_COMPONENT.elem.api_url = checkApi;
                                } else {
                                    alert(data.resultMessage);
                                }
                            }
                        });
                    }
                    checkout();
                }
            }

        },

        resize: function () {

            $(window).resize(function () {
                EMC_COMPONENT.common.imgResizeSrc();
            });

        },

        init: function () {
            this.resize();
            EMC_COMPONENT.common.imgResizeSrc();
        }
    }

    if (window.addEventListener) {
        window.addEventListener('DOMContentLoaded', EMC_COMPONENT.init(), false);
    } else if (window.attachEvent) {
        window.attachEvent('onload', function () {
            EMC_COMPONENT.init();
        });
    }


})(jQuery);
; (function ($) {

    var EMC_COMPONENT = {

        elem: {
            currency_character: '$',
            site_cd: $("#shopSiteCode").val(),
            is_global: true,
            is_dollar: true,
            api_check: true,
            api_domain: 'https://shop.samsung.com/',
            _this: $(".sh-g-highlights_highlights_wrap"),
            rtl_check: $("html").is(".rtl") === true ? true : false,
            choice_product: [],
            data_array: [],
            api_url: ""
        },

        productInfo: [],

        common: {
            numberFormat: function (num) {
                num = num.toString();
                var returnValue = "";
                var dotSepNum = num.toString().indexOf(".");
                var commaSepNum = num.toString().indexOf(",");

                num = num.replace(',', '.');
                var sepNum = num.toString().split(".");
                var arrSize = sepNum.length;
                var returnValue = "";
                if (arrSize >= 3) {
                    for (var i = 0; i < arrSize - 1; i++) {
                        returnValue += sepNum[i];
                    }
                    return returnValue + '.' + sepNum[arrSize - 1];
                } else {
                    if (typeof (sepNum[1]) == 'undefined') {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.00';
                    } else {
                        return sepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + sepNum[1];
                    }
                }
            },

            addComma: function (num) {
                if (EMC_COMPONENT.elem.is_dollar) {
                    var tempSepNum = num.toString().split(".");
                    if (typeof (tempSepNum[1]) == 'undefined') {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.00';
                    } else {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '.' + tempSepNum[1];
                    }
                } else {
                    var tempSepNum = num.toString().split(".");
                    if (typeof (tempSepNum[1]) == 'undefined') {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',00';
                    } else {
                        returnValue = tempSepNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ',' + tempSepNum[1];
                    }
                }
                return returnValue;
            },

            imgResizeSrc: function () {
                var $image = $(".sh-g-highlights_highlights_wrap").find("img"),
                    img_array = [],
                    img_sources = [];

                for (var i = 0; i < $(".sh-g-highlights_highlights_wrap img").length; i++) {
                    $image[i] = $($image[i]);
                    img_sources[i] = EMC_COMPONENT.common.getImageSources($image[i]);

                    if (window.innerWidth > 768) {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[2]);
                    } else {
                        $image[i].attr("src", EMC_COMPONENT.common.getImageSources($image[i])[1]);
                    }
                }
            },

            getImageSources: function ($image) {
                var s2 = $image.attr('data-src-pc') || $image.attr('src'),
                    s3 = s2,
                    s1 = $image.attr('data-src-mobile') || s2;

                return [null, s1, s2, s3]
            },

            layerOpen: function () {
                var _layerHtml = "<div class='sh-g-cover_notification'><div class='sh-g-cover_modal sh-g-cover_fade' role='dialog' tabindex='-1'><div class='sh-g-cover_modal-backdrop sh-g-cover_fade'></div><div class='sh-g-cover_modal-dialog' role='document'><div class='sh-g-cover_modal-content'><div class='sh-g-cover_modal-body sh-g-cover_text-center'><div class='sh-g-cover_icon-tick-96-px' data-grunticon-embed><svg width='96px' height='96px' viewBox='0 0 96 96' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns: xlink='http://www.w3.org/1999/xlink'><desc>Created with sketchtool.</desc><defs><circle id='path-1' cx='32' cy='32' r='32'></circle><mask id='mask-2' maskContentUnits='userSpaceOnUse' maskUnits='objectBoundingBox' x='0' y='0' width='64' height='64' fill='white'><use xlink: href='#path-1'></use></mask></defs><g id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><g id='Icons' transform='translate(-535.000000, -1272.000000)'><g id='64px' transform='translate(535.000000, 272.000000)' stroke-linecap='square' stroke='#008378'><g id='Icon/96/tick-96px' transform='translate(0.000000, 1000.000000)'><g id='tick' transform='translate(16.000000, 16.000000)'><polyline id='Line' stroke-width='2' points='20.8 35.36 28.8 42.4 42.4 22.4'></polyline></g></g></g><g id='16px' transform='translate(135.000000, 224.000000)'></g></g></g></svg></div><p>Item added</p><a href='/au/cart/' class='sh-g-cover_btn sh-g-cover_btn-default sh-g-cover_btn-block sh-g-cover_mini-cart-checkout-button sh-g-cover_js-chekcout-popup-notif' data-omni-type='microsite_scView' data-omni=''>Checkout</a><a href='#' data-dismiss='modal' class='sh-g-cover_btn sh-g-cover_btn-link sh-g-cover_addtocart-continue-shopping sh-g-cover_js-continue-modal' data-omni-type='microsite_basketAdd' data-omni='basket:continue shopping'>Continue Shopping</a></div></div></div></div></div>";

                EMC_COMPONENT.elem._this.append(_layerHtml);
                EMC_COMPONENT.elem._this.find(".sh-g-cover_notification > .sh-g-cover_modal").css("display", "block");
                setTimeout(function () {
                    EMC_COMPONENT.elem._this.find(".sh-g-cover_notification > .sh-g-cover_modal").addClass("sh-g-cover_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-cover_notification .sh-g-cover_modal-backdrop").addClass("sh-g-cover_in");
                    EMC_COMPONENT.elem._this.find(".sh-g-cover_notification a").filter(":first").focus();
                }, 100);
            },

            clickPreorder: function () {
                var selectIdx = $(".model-choose .color li.active").index();
                var checkCookieAPI = '',
                    buyNowAPI = '',
                    //change /nc/cartAndCheckout -> /cart
                    cartAndCheckAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/cart';

                if (!EMC_COMPONENT.elem.is_global) {
                    checkCookieAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/makeBuyNowCookie';
                    addCartAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';

                    $.ajax({
                        url: checkCookieAPI,
                        dataType: 'jsonp',
                        success: function (data) {
                            if (data.resultCode == '0000') {
                                buyNow(addCartAPI, cartAndCheckAPI);
                            } else {
                                alert(data.resultMessage);
                            }
                        }
                    });

                } else {
                    //change /ng/p4v1/buyNow -> /ng/p4v1/addCart
                    buyNowAPI = EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/addCart?';
                    EMC_COMPONENT.common.buyNow(buyNowAPI, cartAndCheckAPI);
                }
            },

            buyNow: function (urlApi, checkApi) {
                // ajax API
                var count = 0,
                    paramater = 'quantity=1&productCode=',
                    accParamater = '',
                    quantity = [];

                //tagging      
                var resultName = [],
                    resultPid = [],
                    tagModelCode = '',
                    tagPid = '';

                $.each(EMC_COMPONENT.elem.choice_product, function (index, ele) {
                    if ($.inArray(ele, resultName) == -1) {
                        resultName.push(ele);
                    }
                });

                if (EMC_COMPONENT.elem.choice_product.length != 0) {

                    for (var i = 0; i < EMC_COMPONENT.elem.choice_product.length; i++) {
                        var keyPid = EMC_COMPONENT.elem.choice_product[i];
                        if (!quantity[keyPid]) {
                            quantity[keyPid] = 1;
                        } else {
                            quantity[keyPid] = quantity[keyPid] + 1;
                        }
                    }

                    var choice_result = 0;
                    var accParamater = "";
                    function checkout() {
                        accParamater = "quantity=" + quantity[keyPid] + "&productCode=" + EMC_COMPONENT.elem.choice_product[choice_result];

                        $.ajax({
                            url: urlApi + accParamater,
                            dataType: 'jsonp',
                            async: false,
                            success: function (data) {
                                if (data.resultCode == '0000') {
                                    $(".js-empty-cart").hide();
                                    $(".s-btn-utility.js-cart").show();
                                    $("#globalCartCount").show();
                                    updateTotalCartCount(data.cartCount);
                                    EMC_COMPONENT.common.layerOpen();
                                    EMC_COMPONENT.elem.api_url = checkApi;
                                } else {
                                    alert(data.resultMessage);
                                }
                            }
                        });
                    }
                    checkout();
                }
            }

        },

        dataSet: function () {

            EMC_COMPONENT.elem._this.find("[data-role]").each(function () {
                EMC_COMPONENT.elem.data_array.push($(this).data("role").split("|"));
            });

            for (var i = 0; i < EMC_COMPONENT.elem.data_array.length; i++) {
                for (var v = 0; v < EMC_COMPONENT.elem.data_array[i].length; v++) {
                    EMC_COMPONENT.elem.data_array[i][v] = EMC_COMPONENT.elem.data_array[i][v].split(",");
                }
            }

            for (var a = 0; a < EMC_COMPONENT.elem.data_array.length; a++) {
                EMC_COMPONENT.productInfo.push([]);
            }

            for (var l = 0; l < EMC_COMPONENT.productInfo.length; l++) {
                for (var d = 0; d < EMC_COMPONENT.elem.data_array[l].length; d++) {
                    EMC_COMPONENT.productInfo[l].push({
                        code: EMC_COMPONENT.elem.data_array[l][d][0],
                        price: ""
                    });
                }
            }
        },

        apiPriceSet: {

            elem: {
                _dataLength: 0,
                _dataIndex: 1,
                _successCheck: false
            },

            getPrice: function (modelCode, obj) {
                $.ajax({
                    url: EMC_COMPONENT.elem.api_domain + EMC_COMPONENT.elem.site_cd + '/ng/p4v1/getRealTimeProductSimpleInfo?productCode=' + modelCode,
                    dataType: 'jsonp',
                    success: function (data) {
                        if (data && data.resultCode == '0000') {
                            if (data.promotionPrice != "") {
                                obj.price = EMC_COMPONENT.common.numberFormat(data.price.trim().replace(/[^0-9.,.]/g, ''));
                                obj.promotionPrice = EMC_COMPONENT.common.numberFormat(data.promotionPrice.trim().replace(/[^0-9.,.]/g, ''));
                            } else {
                                obj.price = EMC_COMPONENT.common.numberFormat(data.price.trim().replace(/[^0-9.,.]/g, ''));
                            }

                            if (EMC_COMPONENT.apiPriceSet.elem._dataLength != EMC_COMPONENT.apiPriceSet.elem._dataIndex) {
                                EMC_COMPONENT.apiPriceSet.elem._dataIndex = EMC_COMPONENT.apiPriceSet.elem._dataIndex + 1;
                            } else {
                                EMC_COMPONENT.apiPriceSet.elem._successCheck = true;
                            }
                        }
                    }
                });
            },

            setPrice: function () {

                for (var i = 0; i < EMC_COMPONENT.productInfo.length; i++) {
                    EMC_COMPONENT.apiPriceSet.elem._dataLength += EMC_COMPONENT.productInfo[i].length;
                }

                if (EMC_COMPONENT.elem.api_check === true) {
                    for (var x = 0; x < EMC_COMPONENT.productInfo.length; x++) {
                        $.each(EMC_COMPONENT.productInfo[x], function (i, v) {
                            EMC_COMPONENT.apiPriceSet.getPrice(v.code.toUpperCase(), v);
                        });
                    }

                } else {
                    EMC_COMPONENT.apiPriceSet.elem._successCheck = true;
                }

                var apiSuccessCheckInterval = setInterval(function () {
                    if (EMC_COMPONENT.apiPriceSet.elem._successCheck === true) {
                        clearInterval(apiSuccessCheckInterval);
                        for (var v = 0; v < EMC_COMPONENT.productInfo.length; v++){
                            EMC_COMPONENT.elem._this.find(".sh-g-shop-accessories-3_price").each(function (i) {
                                $(this).text(EMC_COMPONENT.elem.currency_character + EMC_COMPONENT.common.addComma(EMC_COMPONENT.productInfo[v][i].price));
                            });
                        }
                    }
                }, 10);

            }
        },

        resize: function () {

            $(window).resize(function () {
                EMC_COMPONENT.common.imgResizeSrc();
            });

        },

        init: function () {
            this.resize();
            this.common.imgResizeSrc();
            this.dataSet();
            this.apiPriceSet.setPrice();
        }
    }

    if (window.addEventListener) {
        window.addEventListener('DOMContentLoaded', EMC_COMPONENT.init(), false);
    } else if (window.attachEvent) {
        window.attachEvent('onload', function () {
            EMC_COMPONENT.init();
        });
    }


})(jQuery);
!function(s,i){"use strict";"undefined"==typeof s.smg&&(s.smg={}),"undefined"==typeof s.smg.aem&&(s.smg.aem={}),"undefined"==typeof s.smg.aem.components&&(s.smg.aem.components={}),"undefined"==typeof s.smg.aem.components.flagshipPD&&(s.smg.aem.components.flagshipPD={}),"undefined"==typeof s.smg.aem.components.flagshipPD.product&&(s.smg.aem.components.flagshipPD.product={}),"undefined"==typeof s.smg.aem.components.flagshipPD.product.galaxyS9&&(s.smg.aem.components.flagshipPD.product.galaxyS9={});var t=s.smg.aem.varStatic,e=s.smg.aem.util,n=s.smg.aem.customEvent,o=s.smg.aem.components.flagshipPD.product.galaxyS9;o.reviewColumn=function(){var s={isMobile:!1,carousel:{wrap:".js-slick-review-column",slides:".fp-review-column__col",setSlickSlideNum:1,slickOpts:{rtl:i("html").hasClass("rtl"),speed:500,useTransform:!0,dots:!0,infinite:!1,arrows:!1,adaptiveHeight:!0}},cssClass:{hasSlick:"slick-initialized"}};return{init:function(i,t){(this.container=i).size()&&(this.opts=e.def(s,t||{}),this.setElements(),this.bindEvents())},setElements:function(){this.carousel=this.container.find(this.opts.carousel.wrap)},bindEvents:function(){this.container.on(n.RESPONSIVE.CHANGE,i.proxy(this.onResponsiveChange,this)),this.container.trigger(n.RESPONSIVE.GET_STATUS)},onResponsiveChange:function(s,i){this.responsiveDeivceName=i.RESPONSIVE_NAME,this.responsiveDeivceName===t.RESPONSIVE.MOBILE.NAME?this.setSlick():this.unSlick()},setTagging:function(s){for(var i,t=0,e=0;e<s.length;e++)i=s.eq(e).find("button"),t=e+1,i.attr("data-omni-type","microsite_pcontentinter"),i.attr("data-omni","rolling:index_"+t),i.attr("ga-ca","flagship pdp"),i.attr("ga-ac","indicator"),i.attr("ga-la","rolling_"+t)},setSlick:function(){var s,t,e,n=this;i.each(this.carousel,function(){s=i(this),t=n.hasSlick(s),e=s.find(n.opts.carousel.slides).size(),!t&&e>=n.opts.carousel.setSlickSlideNum&&(s.on("init",function(s,t){var e=i(t.$dots).find("li");n.setTagging(e)}),s.slick(n.opts.carousel.slickOpts))})},unSlick:function(){var s,t,e=this;i.each(this.carousel,function(){s=i(this),t=e.hasSlick(s),t&&s.slick("unslick")})},hasSlick:function(s){return s.hasClass(this.opts.cssClass.hasSlick)}}}(),i(function(){o.reviewColumn.init(i("body"))})}(window,window.jQuery);
!function(n,o){"use strict";"undefined"==typeof n.smg&&(n.smg={}),"undefined"==typeof n.smg.aem&&(n.smg.aem={}),"undefined"==typeof n.smg.aem.components&&(n.smg.aem.components={}),"undefined"==typeof n.smg.aem.components.flagshipPD&&(n.smg.aem.components.flagshipPD={}),"undefined"==typeof n.smg.aem.components.flagshipPD.common&&(n.smg.aem.components.flagshipPD.common={});var t=n.smg.aem.varStatic,e=(n.smg.aem.util,n.smg.aem.customEvent),i=n.smg.aem.components.flagshipPD.common.floatingNav;i=function(){var i=!1,f=null,r=o(".fp-floating-nav"),s=function(){var n=o("body"),f=function(n,o){i=o.RESPONSIVE_NAME===t.RESPONSIVE.MOBILE.NAME?!0:!1},r=function(){n.on(e.RESPONSIVE.CHANGE,o.proxy(f,this)),n.trigger(e.RESPONSIVE.GET_STATUS)},s=function(){n.off(e.RESPONSIVE.CHANGE),n.off(e.RESPONSIVE.GET_STATUS)};return{run:r,reset:s}}(),a=function(){return r.length?r:o(".fp-floating-nav")},u=function(){var t=a(),e="s-nav-fixed",i=function(){o(n).on("floating.scroll",o.proxy(function(){var n=s();n.scrollTop>n.offset?f():r()}))},f=function(){t.hasClass(e)||t.addClass(e)},r=function(){t.hasClass(e)&&t.removeClass(e)},s=function(){return{offset:t.length?t.offset().top:0,scrollTop:o(n).scrollTop()}},u=function(){o(n).off("floating.scroll")},c=function(){i(),o(n).on("scroll",o.proxy(function(){o(n).trigger("floating.scroll")}))};return{run:c,reset:u}}(),c=function(){var t=a(),e=t.find(".fp-floating-nav__menu-list"),f=e.find("li >a"),r=e.find("li.s-active >a"),s=t.find(".bar"),u=19,c=function(n,o){var t=n&&n.length?n.position().left+u:0,e=n.outerWidth(!0)-2*u;s.css("transition-duration","1s").stop()[o?"css":"animate"]({left:t,width:e},{duration:550})},l=function(){f.on("mouseenter",function(n){if(n.preventDefault(),!i){var t=o(n.currentTarget);c(t,!0)}}),e.on("mouseleave",function(n){if(n.preventDefault(),!i){{o(n.currentTarget)}c(r,!0)}})},m=function(){f.off("mouseenter"),e.off("mouseleave")},g=function(){o(n).on("resize orientationchange",function(){c(r,!0)})},p=function(){o(n).on("load",function(){c(r,!0)})},d=function(){l(),c(r,!0),p(),setTimeout(function(){c(r,!0)},3e3)};return{run:d,resize:g,reset:m}}(),l=function(){var t=(a(),function(){o(n).on("floating.resize",o.proxy(function(){clearTimeout(f),f=setTimeout(o.proxy(function(){c.resize()}),100)}))}),e=function(){t(),o(n).on("resize orientationchange",o.proxy(function(){o(n).trigger("floating.resize")}))},i=function(){o(n).off("floating.resize")};return{run:e,reset:i}}(),m=function(){var n=a(),t=n.find(".fp-floating-nav__headline-link"),e="s-nav-opened",f=function(){t.on("click",o.proxy(function(o){o.preventDefault(),i&&(n.hasClass(e)?n.removeClass(e):n.addClass(e))}))};f()},g=function(){r.length&&(s.run(),u.run(),c.run(),m(),l.run())};return{init:g}}(),o(function(){i.init()})}(window,window.jQuery);
!function(e,o){"use strict";"undefined"==typeof e.smg&&(e.smg={}),"undefined"==typeof e.smg.aem&&(e.smg.aem={}),"undefined"==typeof e.smg.aem.components&&(e.smg.aem.components={}),"undefined"==typeof e.smg.aem.components.flagshipPD&&(e.smg.aem.components.flagshipPD={}),"undefined"==typeof e.smg.aem.components.flagshipPD.common&&(e.smg.aem.components.flagshipPD.common={});var n=e.smg.aem.components.flagshipPD.common.disclaimer;n=function(){var e,n,t=3e3,s="___PAGE_NETWORK",i="___PAGE_COLOR",a=o.cookieMode.get(s),c=o("body"),m=o(".fp-footer-disclaimer"),r=m.find("a.network"),d=m.find(".fp-footer-disclaimer--options >a"),f=m.find(".color-button"),p=r.text(),l=function(e,n){return o.cookieMode.set(e,n,1,"/"),this},g=function(e){return o.cookieMode.get(e)},u=function(){r.on("click",h),d.on("click",w),f.on("click",T)},h=function(e){e.preventDefault();var n=o(e.currentTarget),t=n.next(".fp-footer-disclaimer--options");n.toggleClass("opened"),t.is(":visible")?t.css("display","none"):t.css("display","block")},w=function(e){e.preventDefault();var n=o(e.currentTarget),t=n.data("page-network");l(s,t),window.scrollTo(0,0),r.text(p+" ("+t+")"),location.reload()},T=function(e){e.preventDefault();var n=o(e.currentTarget),t=n.data("page-color");"type1"==t?c.addClass("s-mode-high-contrast"):c.removeClass("s-mode-high-contrast"),l(i,t)},v=function(){var e,o=g(s),t=g(i);"type1"==t?c.addClass("s-mode-high-contrast"):c.removeClass("s-mode-high-contrast"),e=o==n?o:o?o:n,r.text(p+" ("+e+")"),c.addClass("s-mode-"+e.toLowerCase()+"-speed")},_=function(){e=window.PAGE_START_TIME?PAGE_START_TIME:(new Date).getTime(),n="LOW"==a?"LOW":"HIGH"==a?"HIGH":(new Date).getTime()-e>t?"LOW":"HIGH",v(),u()};return{init:_}}(),o(function(){n.init()})}(window,window.jQuery);
!function(n,e){"use strict";"undefined"==typeof n.smg&&(n.smg={}),"undefined"==typeof n.smg.aem&&(n.smg.aem={}),"undefined"==typeof n.smg.aem.components&&(n.smg.aem.components={}),"undefined"==typeof n.smg.aem.components.flagshipPD&&(n.smg.aem.components.flagshipPD={}),"undefined"==typeof n.smg.aem.components.flagshipPD.common&&(n.smg.aem.components.flagshipPD.common={});var i=n.smg.aem.varStatic,t=(n.smg.aem.util,n.smg.aem.customEvent,n.smg.aem.components.flagshipPD.common.carousel);t=function(){var t=e("html"),s=e("body"),o=null,a=function(){return o.length?!0:!1},c=function(){var i;e(n).on("resize orientationchange",function(){for(var n=0;n<o.length;n++)i=o.eq(n),i.hasClass("slick-initialized")&&i.slick("setPosition")})},l=function(){for(var n,e,a=t.hasClass("rtl")||!1,c=s.hasClass(i.SUPPORT.TOUCH_DEVICE)?150:500,l=0;l<o.length;l++)n=o.eq(l),e=n.closest("section"),!n.hasClass("slick-initialized")&&n.children().length>1&&n.slick({rtl:a,dots:!0,arrows:!0,infinite:!1,speed:c})},m=function(){for(var n,e=0;e<o.length;e++)n=o.eq(e),n.hasClass("slick-initialized")&&n.find(".slick-slide").length>1&&n.slick("unslick")},f=function(n){o=n,a()&&!e.aemEditMode()&&(c(),l())},r=function(n){o=n,m(),l()};return{init:f,reInit:r}}(),e.fn.fgCarousel=function(n){n=n||{},n.type=n.type||"init",n.prevFunction=n.prevFunction||null,"init"==n.type?t.init(e(this)):"reInit"==n.type&&("function"==typeof n.prevFunction&&n.prevFunction(e(this)),t.reInit(e(this)))},e(function(){e(".js-fd-carousel").fgCarousel()})}(window,window.jQuery);
