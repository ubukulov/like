<?php
session_start();
$url = $_SERVER["SERVER_NAME"];
$domain = explode(".",$url);
$sub_domain = $domain[0];
if($sub_domain == 'likemoney'){
    $user_id = 15;
    $user_phone = 77086144660;
}else{
    $user_id = $_SESSION['store_user_id'];
    $user_phone = preg_replace('![^0-9]+!', '', $_SESSION['store_user_phone']);
}
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <title>Предзаказ | Samsung Galaxy S9 и S9+ – Официальный сайт Galaxy | Samsung KZ</title>
    <meta name="title" content="Предзаказ | Samsung Galaxy S9 и S9+ – Официальный сайт Galaxy ">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>

    <meta name="keywords" content="samsung galaxy S9, samsung galaxy S9+, smartphone 2018, samsung galaxy S9 Pre-order, samsung galaxy S9+ Pre-order, samsung galaxy S9 Pre-order, samsung galaxy S9+ Pre-order">
    <meta name="description" content="Закажите Galaxy S9 | S9+ уже сейчас">
    <meta name="date" content="2018-02-27"><!--Latest Publishing Date -->

    <meta property="og:title" content="Предзаказ | Samsung Galaxy S9 и S9+ – Официальный сайт Galaxy"/>
    <meta property="og:description" content="Закажите Galaxy S9 | S9+ уже сейчас"/>
    <meta property="og:country-name" content="ru"/>

    <meta itemprop="name" content="Samsung ru">
    <meta itemprop="description" content="Закажите Galaxy S9 | S9+ уже сейчас">
    <meta itemprop="keywords" content="samsung galaxy S9, samsung galaxy S9+, smartphone 2018, samsung galaxy S9 Pre-order, samsung galaxy S9+ Pre-order, samsung galaxy S9 Pre-order, samsung galaxy S9+ Pre-order">

    <link rel="shortcut icon" href="//cdn.samsung.com/etc/designs/smg/global/imgs/favicon.ico">
    <link rel="apple-touch-icon" href="//cdn.samsung.com/etc/designs/smg/global/imgs/app_ico.png" sizes="144x144">

    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link rel="stylesheet" href="css/page-shop.css" type="text/css"/>
    <link rel="stylesheet" href="css/ru.css" type="text/css">
    <!--[if lt IE 9]>
    <script src="/etc/designs/smg/global/ie9/html5.js"></script>
    <![endif]-->

    <script type="text/javascript">
        /* DataLayer for Samsung - Last Modified Date 2016-07-13 by Kim myounggyu */
        var siteCode = "";
        var pageURL = "";

        siteCode = window.location.href.split("/")[3];
        pageURL = window.location.href;

        var digitalData = {
            "page" : {
                "pageInfo" : {
                    "siteCode" : siteCode,
                    "siteSection": "", //pathIndicator정보 이용하여 설정
                    "pageName" : "", //pathIndicator정보 이용하여 설정
                    "pageURL" : pageURL,
                    "pageTrack" : "" //All page(server-side)
                },
                "pathIndicator" : { //product page(server-side)
                    "depth_2" : "mobile",
                    "depth_3" : "mobile",
                    "depth_4" : "smartphones",
                    "depth_5" : "galaxy-s9"
                }
            },
            "user" : {
                "loginStatus" : ""
            },
            "product" : {
                "category" : "", // pathIndicator depth정보 이용하여 설정
                "model_code" : "SM-G960FZKDSER", // PD class정보 이용하여 설정
                "model_name" : "SM-G960F/DS", // PD page(server-side)
                "displayName" : "Galaxy S9", // PD class정보 이용하여 설정
                "pvi_type_code" : "", //PD page(server-side)
                "pvi_type_name" : "Mobile", //PD page(server-side)
                "pvi_subtype_code" : "", //PD page(server-side)
                "pvi_subtype_name" : "Smartphone" //PD page(server-side)
            }
        };

        //server-side
        digitalData.page.pageInfo.pageTrack = "flagship pdp";
        var mktProductModelCode = "SM-G960FZKDSER";

        // depth Info.
        var depth = window.location.href.split("/").length;
        var depth_last = window.location.href.split("/")[depth-1];
        if(depth_last =="" || depth_last.charAt(0)=="?"){
            depth -= 1;
        }

        // set site section value
        if((digitalData.page.pathIndicator.depth_2 != "")||(digitalData.page.pageInfo.pageTrack == "flagship pdp")){
            digitalData.page.pageInfo.siteSection = siteCode + ":consumer"; //product page
        }else if(depth == 4){
            digitalData.page.pageInfo.siteSection = siteCode + ":home"; //home
        }else{
            digitalData.page.pageInfo.siteSection = siteCode + ":" + window.location.href.split("/")[4];
        }

        // set product category value
        if(digitalData.page.pathIndicator.depth_3 != ""){
            digitalData.product.category = digitalData.page.pathIndicator.depth_3;
        }

        // set pathIndicator(not product page)
        if(mktProductModelCode == ""){
            if(digitalData.page.pathIndicator.depth_2 == ""){
                if(depth >= 5) digitalData.page.pathIndicator.depth_2 = window.location.href.split("/")[4];
                if(depth >= 6) digitalData.page.pathIndicator.depth_3 = window.location.href.split("/")[5];
                if(depth >= 7) digitalData.page.pathIndicator.depth_4 = window.location.href.split("/")[6];
                if(depth >= 8) digitalData.page.pathIndicator.depth_5 = window.location.href.split("/")[7]
            }
        }

        // set pageName
        var pageName = siteCode;
        if(digitalData.page.pathIndicator.depth_2 != "")
            pageName += ":" + digitalData.page.pathIndicator.depth_2;
        if(digitalData.page.pathIndicator.depth_3 != "")
            pageName += ":" + digitalData.page.pathIndicator.depth_3;
        if(digitalData.page.pathIndicator.depth_4 != "")
            pageName += ":" + digitalData.page.pathIndicator.depth_4;
        if(digitalData.page.pathIndicator.depth_5 != "")
            pageName += ":" + digitalData.page.pathIndicator.depth_5.replace(/^\s+|\s+$/gm,'');

        // check PD, GPD
        var pageTrackName = digitalData.page.pageInfo.pageTrack;
        if(pageTrackName == "product detail" || pageTrackName == "generic product details"){
            var modelCode = document.getElementsByClassName("product-details__s-sku")[0].innerHTML;
            var displayName = document.getElementsByClassName("product-details__title")[0].innerHTML.replace(/(<([^>]+)>)/gi, "");
            digitalData.product.model_code = modelCode;
            digitalData.product.displayName = displayName;
            pageName += ":" + modelCode;
        }
        digitalData.page.pageInfo.pageName = pageName;

    </script>


    <script src="js/satelliteLib-db2822c526e4500fa9b86a9e9ca775ba4d6db18e.js"></script>


    <script>
        var dataLayer=[{
            'gtmServerType': 'live'
        }];
    </script>

</head>
<body>




<div id="wrap">


    <div class="page-title cm-g-page-title">

    </div>



    <div id="content" class="page-content" role="main">
        <input type="hidden" name="shopSiteCode" id="shopSiteCode" value="ru">
        <!-- include the parsys component -->
        <div class="sh-g-buying-tool-dataset par-dataset"></div>

        <div class="par parsys"><div class="sh-g-shop-buying-tool section">
                <section class="sh-g-shop-buying-tool_product_warp" data-role-common="free,save">
                    <input type="hidden" class="sh-g-shop-buying-tool-apiUse" value="N">
                    <input type="hidden" class="sh-g-shop-buying-tool-currency" value="rub">
                    <input type="hidden" class="sh-g-shop-buying-tool-siteCode" value="ru">
                    <input type="hidden" class="sh-g-shop-buying-tool-choose" value="ВЫБЕРИТЕ">

                    <input type="hidden" id="firstmodelcode" value="sm-g960fzkdser">
                    <!-- trade-in css s-->

                    <!-- trade-in css e-->
                    <!-- care css s-->

                    <!-- care css e-->

                    <div class="sh-g-shop-buying-tool_product_cont">
                        <div class="sh-g-shop-buying-tool_product_visual">
                            <div class="sh-g-shop-buying-tool_visual_thumb">
                                <div class="sh-g-shop-buying-tool_visual_thumb_item  sh-g-shop-buying-tool_active">
                                    <a href="#" data-omni-type="microsite_gallery" data-omni="">
                                        <img alt="Galaxy S9 Black front and rear thumbnail" data-src-mobile="images/product_galaxys9_thumb_midnightblack_01.png" data-src-pc="images/product_galaxys9_thumb_midnightblack_01.png">
                                        <em class="blind">selected</em>
                                    </a>
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_thumb_item">
                                    <a href="#" data-omni-type="microsite_gallery" data-omni="">
                                        <img alt="Galaxy S9 Black rear thumbnail" data-src-mobile="images/product_galaxys9_thumb_midnightblack_02.png" data-src-pc="images/product_galaxys9_thumb_midnightblack_02.png">
                                        <em class="blind">unselected</em>
                                    </a>
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_thumb_item">
                                    <a href="#" data-omni-type="microsite_gallery" data-omni="">
                                        <img alt="Galaxy S9 Black left side thumbnail" data-src-mobile="images/product_galaxys9_thumb_midnightblack_03.png" data-src-pc="images/product_galaxys9_thumb_midnightblack_03.png">
                                        <em class="blind">unselected</em>
                                    </a>
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_thumb_item">
                                    <a href="#" data-omni-type="microsite_gallery" data-omni="">
                                        <img alt="Galaxy S9 Black right side thumbnail" data-src-mobile="images/product_galaxys9_thumb_midnightblack_04.png" data-src-pc="images/product_galaxys9_thumb_midnightblack_04.png">
                                        <em class="blind">unselected</em>
                                    </a>
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_thumb_item">
                                    <a href="#" data-omni-type="microsite_gallery" data-omni="">
                                        <img alt="Galaxy S9 Black Galaxy S9 Black front side with left rotation thumbnail" data-src-mobile="images/product_galaxys9_thumb_midnightblack_05.png" data-src-pc="images/product_galaxys9_thumb_midnightblack_05.png">
                                        <em class="blind">unselected</em>
                                    </a>
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_thumb_item">
                                    <a href="#" data-omni-type="microsite_gallery" data-omni="">
                                        <img alt="Galaxy S9 Black front side with right rotation thumbnail" data-src-mobile="images/product_galaxys9_thumb_midnightblack_06.png" data-src-pc="images/product_galaxys9_thumb_midnightblack_06.png">
                                        <em class="blind">unselected</em>
                                    </a>
                                </div>
                            </div>
                            <div class="sh-g-shop-buying-tool_visual_view">
                                <div class="sh-g-shop-buying-tool_visual_item">
                                    <img alt="Galaxy S9 Black front and rear" src="images/blank.gif" data-src-mobile="images/product_galaxys9_midnightblack_01.png" data-src-pc="images/product_galaxys9_midnightblack_01.png">
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_item">
                                    <img alt="Galaxy S9 Black rear" src="images/blank.gif" data-src-mobile="images/product_galaxys9_midnightblack_02.png" data-src-pc="images/product_galaxys9_midnightblack_02.png">
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_item">
                                    <img alt="Galaxy S9 Black left side" src="images/blank.gif" data-src-mobile="images/product_galaxys9_midnightblack_03.png" data-src-pc="images/product_galaxys9_midnightblack_03.png">
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_item">
                                    <img alt="Galaxy S9 Black right side" src="images/blank.gif" data-src-mobile="images/product_galaxys9_midnightblack_04.png" data-src-pc="images/product_galaxys9_midnightblack_04.png">
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_item">
                                    <img alt="Galaxy S9 Black Galaxy S9 Black front side" src="images/blank.gif" data-src-mobile="images/product_galaxys9_midnightblack_05.png" data-src-pc="images/product_galaxys9_midnightblack_05.png">
                                </div>
                                <div class="sh-g-shop-buying-tool_visual_item">
                                    <img alt="Galaxy S9 Black front side with right rotation" src="images/blank.gif" data-src-mobile="images/product_galaxys9_midnightblack_06.png" data-src-pc="images/product_galaxys9_midnightblack_06.png">
                                </div>
                            </div>
                        </div>



                        <div id="sh-g-shop-buying-tool_option_wrap" class="sh-g-shop-buying-tool_product_detail">
                            <div class="sh-g-shop-buying-tool_product_name">

                                <h1 class="sh-g-shop-buying-tool_tit"><span class="sh-g-shop-buying-tool_line">Galaxy S9</span>S9+</h1>
                                <ul class="sh-g-shop-buying-tool_desc_list_wrap">
                                    <li class="sh-g-shop-buying-tool_desc_list">

                                        · Сверхзамедленная съёмка 960 кадров/сек.<br />
                                        <br />
                                        · Яркие снимки в темноте благодаря двойной диафрагме камеры<br />
                                        <br />
                                        · Анимированные сэлфимоджи – выглядят в точности, как ты
                                        <br><br>
                                        · Первый в мире смартфон с функцией майнинга криптовалюты
                                    </li>
                                    <!-- <li class="sh-g-shop-buying-tool_desc_list">960 fps Super <b>Slow-mo</b> for social media</li>
                                    <li class="sh-g-shop-buying-tool_desc_list">Stunning <b>low light</b> photos with <b>dual aperture</b></li>
                                    <li class="sh-g-shop-buying-tool_desc_list"><b>AR Emoji,</b> animated to look just like you</li> -->
                                </ul>
                            </div>
                            <div class="sh-g-shop-buying-tool_product_select_list">
                                <!-- select galaxy s -->
                                <div id="sh-g-shop-buying-tool_product_select_galaxy" class="sh-g-shop-buying-tool_product_select sh-g-shop-buying-tool_active" data-required="true" data-role-type="model">
                                    <div class="sh-g-shop-buying-tool_product_tit_wrap">
                                        <h2 class="sh-g-shop-buying-tool_tit">Выберите свой Galaxy</h2>
                                        <button class="sh-g-shop-buying-tool_btn_choose" title="Click to open SELECT GALAXY options."></button>
                                        <!-- button text -->
                                    </div>
                                    <div class="sh-g-shop-buying-tool_btn_wrap sh-g-shop-buying-tool_active">
                                        <ul class="sh-g-shop-buying-tool_btn_list_wrap">

                                            <li class="sh-g-shop-buying-tool_btn_list sh-g-shop-buying-tool_active" data-role="galaxys9^SM-G960FZKDSER^^ST-01^midnightblack^#000000^316000^|galaxys9^SM-G960FZADSER^^ST-01^titaniumgray^#727179^316000^|galaxys9^SM-G960FZPDSER^^ST-01^lilacpurple^#916E8F^316000^">
                                                <a id="s91" href="#" class="sh-g-shop-buying-tool_btn_option sh-g-shop-buying-tool_default" data-role-name="galaxys9" data-omni-type="microsite_pdpoption" data-omni="option selector:model">
                                                    <div class="sh-g-shop-buying-tool_info_wrap">
                                                        <div class="sh-g-shop-buying-tool_info">

                                                            <strong class="sh-g-shop-buying-tool_tit">Galaxy S9</strong>

                                                            <!-- <p class="sh-g-shop-buying-tool_desc"></p> -->
                                                        </div>
                                                        <div class="sh-g-shop-buying-tool_price_wrap">
                                                            <em class="sh-g-shop-buying-tool_price"></em>
                                                        </div>
                                                    </div>
                                                    <em class="blind"></em>
                                                </a>
                                            </li>

                                            <li class="sh-g-shop-buying-tool_btn_list sh-g-shop-buying-tool_active" data-role="galaxys9plus^SM-G965FZKDSER^^ST-01^midnightblack^#000000^353100|galaxys9plus^SM-G965FZADSER^^ST-01^titaniumgray^#727179^353100|galaxys9plus^SM-G965FZPDSER^^ST-01^lilacpurple^#916E8F^353100|galaxys9plus^SM-G965FZKHSER^^ST-02^midnightblack^#000000^74990^">
                                                <a id="s92" href="#" class="sh-g-shop-buying-tool_btn_option " data-role-name="galaxys9plus" data-omni-type="microsite_pdpoption" data-omni="option selector:model">
                                                    <div class="sh-g-shop-buying-tool_info_wrap">
                                                        <div class="sh-g-shop-buying-tool_info">

                                                            <strong class="sh-g-shop-buying-tool_tit">Galaxy S9+</strong>

                                                            <!-- <p class="sh-g-shop-buying-tool_desc"></p> -->
                                                        </div>
                                                        <div class="sh-g-shop-buying-tool_price_wrap">
                                                            <em class="sh-g-shop-buying-tool_price"></em>
                                                        </div>
                                                    </div>
                                                    <em class="blind"></em>
                                                </a>
                                            </li>

                                            <li class="sh-g-shop-buying-tool_btn_list sh-g-shop-buying-tool_active" data-role="galaxys9plus^SM-G965FZKDSER^^ST-01^midnightblack^#000000^306300^|galaxys9plus^SM-G965FZADSER^^ST-01^titaniumgray^#727179^353100^|galaxys9plus^SM-G965FZPDSER^^ST-01^lilacpurple^#916E8F^353100^|galaxys9plus^SM-G965FZKHSER^^ST-02^midnightblack^#000000^74990^">
                                                <a id="s93" href="#" class="sh-g-shop-buying-tool_btn_option " data-role-name="galaxys9opt" data-omni-type="microsite_pdpoption" data-omni="option selector:model">
                                                    <div class="sh-g-shop-buying-tool_info_wrap">
                                                        <div class="sh-g-shop-buying-tool_info">

                                                            <strong class="sh-g-shop-buying-tool_tit">Galaxy S9 оптом от 3-х штук</strong>

                                                            <!-- <p class="sh-g-shop-buying-tool_desc"></p> -->
                                                        </div>
                                                        <div class="sh-g-shop-buying-tool_price_wrap">
                                                            <em class="sh-g-shop-buying-tool_price"></em>
                                                        </div>
                                                    </div>
                                                    <em class="blind"></em>
                                                </a>
                                            </li>

                                            <li class="sh-g-shop-buying-tool_btn_list sh-g-shop-buying-tool_active" data-role="galaxys9plus^SM-G965FZKDSER^^ST-01^midnightblack^#000000^343100^|galaxys9plus^SM-G965FZADSER^^ST-01^titaniumgray^#727179^353100^|galaxys9plus^SM-G965FZPDSER^^ST-01^lilacpurple^#916E8F^353100^|galaxys9plus^SM-G965FZKHSER^^ST-02^midnightblack^#000000^74990^">
                                                <a id="s94" href="#" class="sh-g-shop-buying-tool_btn_option " data-role-name="galaxys9plusщзе" data-omni-type="microsite_pdpoption" data-omni="option selector:model">
                                                    <div class="sh-g-shop-buying-tool_info_wrap">
                                                        <div class="sh-g-shop-buying-tool_info">

                                                            <strong class="sh-g-shop-buying-tool_tit">Galaxy S9+ оптом от 3-х штук</strong>

                                                            <!-- <p class="sh-g-shop-buying-tool_desc"></p> -->
                                                        </div>
                                                        <div class="sh-g-shop-buying-tool_price_wrap">
                                                            <em class="sh-g-shop-buying-tool_price"></em>
                                                        </div>
                                                    </div>
                                                    <em class="blind"></em>
                                                </a>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                                <!-- select galaxy e -->



                                <!-- select carrier s -->

                                <!-- select carrier e -->

                                <!-- select color s -->
                                <div id="sh-g-shop-buying-tool_product_select_color" class="sh-g-shop-buying-tool_product_select sh-g-shop-buying-tool_active" data-required="true" data-role-type="color">
                                    <div class="sh-g-shop-buying-tool_product_tit_wrap">
                                        <h2 class="sh-g-shop-buying-tool_tit">Выберите цвет</h2>
                                        <button class="sh-g-shop-buying-tool_btn_choose" title="Click to open SELECT COLOR options."></button>
                                    </div>
                                    <div class="sh-g-shop-buying-tool_btn_wrap sh-g-shop-buying-tool_active">
                                        <p class="sh-g-shop-buying-tool_btn_wrap_desc">Выберите цвет, чтобы продолжить</p>
                                        <ul class="sh-g-shop-buying-tool_btn_list_wrap sh-g-shop-buying-tool_col2">


                                            <li class="sh-g-shop-buying-tool_btn_list" style="width: 33% !important;">
                                                <a href="#" id="type_color1" class="sh-g-shop-buying-tool_btn_option" data-role-name="midnightblack" data-omni-type="microsite_pdpoption" data-omni="option selector:color">
                                                    <div class="sh-g-shop-buying-tool_info_wrap">
                                                        <div class="sh-g-shop-buying-tool_info">
                                                            <strong class="sh-g-shop-buying-tool_tit">
                                                                <span class="sh-g-shop-buying-tool_color_option" style="background:#000000;"></span>
                                                                <label style="font-size: 12px;">черный бриллиант</label>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <em class="blind"></em>
                                                </a>
                                            </li>



                                            <li class="sh-g-shop-buying-tool_btn_list" style="width: 25% !important;">
                                                <a href="#" id="type_color2" class="sh-g-shop-buying-tool_btn_option" data-role-name="titaniumgray" data-omni-type="microsite_pdpoption" data-omni="option selector:color">
                                                    <div class="sh-g-shop-buying-tool_info_wrap">
                                                        <div class="sh-g-shop-buying-tool_info">
                                                            <strong class="sh-g-shop-buying-tool_tit">
                                                                <span class="sh-g-shop-buying-tool_color_option" style="background:#727179;"></span><label style="font-size: 12px;">титан</label>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <em class="blind"></em>
                                                </a>
                                            </li>



                                            <li class="sh-g-shop-buying-tool_btn_list" style="width: 33% !important;">
                                                <a href="#" id="type_color3" class="sh-g-shop-buying-tool_btn_option" data-role-name="lilacpurple" data-omni-type="microsite_pdpoption" data-omni="option selector:color">
                                                    <div class="sh-g-shop-buying-tool_info_wrap">
                                                        <div class="sh-g-shop-buying-tool_info">
                                                            <strong class="sh-g-shop-buying-tool_tit">
                                                                <span class="sh-g-shop-buying-tool_color_option" style="background:#916E8F;"></span><label style="font-size: 12px;">ультрафиолет</label>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <em class="blind"></em>
                                                </a>
                                            </li>
                                            <input type="hidden" value="1" id="type_color">

                                        </ul>
                                    </div>
                                </div>
                                <!-- select color e -->


                                <!-- select storage e -->
                                <!-- select promotion s -->

                                <div id="sh-g-shop-buying-tool_product_select_promotion" class="sh-g-shop-buying-tool_product_select" data-role-type="promotion">

                                    <div class="sh-g-shop-buying-tool_btn_wrap">
                                        <ul class="sh-g-shop-buying-tool_btn_list_wrap sh-g-shop-buying-tool_promotion_type">
                                            <li class="sh-g-shop-buying-tool_btn_list" data-role="SM-G960FZKDSER^Быстрое беспроводное з/у EP-PG950^SM-G960FZKDSER^Черный^#000000^images/promotion_wireless_black.png^images/m_promotion_wireless_black.png^4990^316000|SM-G960FZADSER^Быстрое беспроводное з/у EP-PG950^SM-G960FZADSER^Черный^#000000^images/promotion_wireless_black.png^images/m_promotion_wireless_black.png^4990^316000|SM-G960FZPDSER^Быстрое беспроводное з/у EP-PG950^SM-G960FZPDSER^Черный^#000000^images/promotion_wireless_black.png^images/m_promotion_wireless_black.png^4990^316000|SM-G965FZKDSER^Быстрое беспроводное з/у EP-PG950^SM-G965FZKDSER^Черный^#000000^images/promotion_wireless_black.png^images/m_promotion_wireless_black.png^4990^353100|SM-G965FZADSER^Быстрое беспроводное з/у EP-PG950^SM-G965FZADSER^Черный^#000000^images/promotion_wireless_black.png^images/m_promotion_wireless_black.png^4990^353100|SM-G965FZPDSER^Быстрое беспроводное з/у EP-PG950^SM-G965FZPDSER^Черный^#000000^images/promotion_wireless_black.png^images/m_promotion_wireless_black.png^4990^353100|SM-G965FZKHSER^Быстрое беспроводное з/у EP-PG950^SM-G965FZKHSER^Черный^#000000^images/promotion_wireless_black.png^images/m_promotion_wireless_black.png^4990^74990">

                                                <a href="#" class="sh-g-shop-buying-tool_btn_option" data-role-name="Быстрое беспроводное з/у EP-PG950" data-omni-type="microsite_contentinter" data-omni="">
                                                    <div class="sh-g-shop-buying-tool_info_wrap">
                                                        <div class="sh-g-shop-buying-tool_thum_wrap">

                                                            <figure>
                                                                <img alt="" src="images/blank.gif" data-src-mobile="images/m_promotion_wireless_black.png" data-src-pc="images/promotion_wireless_black.png">
                                                            </figure>
                                                        </div>
                                                        <div class="sh-g-shop-buying-tool_product_inner">
                                                            <strong class="sh-g-shop-buying-tool_tit"></strong>
                                                            <div class="sh-g-shop-buying-tool_price_wrap">
                                                                <em class="sh-g-shop-buying-tool_price"></em>
											<span class="sh-g-shop-buying-tool_price_was">
												<strong class="sh-g-shop-buying-tool_save_price"></strong>
												<span class="sh-g-shop-buying-tool_price">
													<em></em>
												</span>
											</span>
                                                                <span class="sh-g-shop-buying-tool_stock_txt">Out of Stock</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <em class="blind"></em>
                                                </a>
                                                <div class="sh-g-shop-buying-tool_color_wrap"></div>
                                            </li>










                                            <li class="sh-g-shop-buying-tool_btn_list sh-g-shop-buying-tool_no_data">
                                                <p>К сожалению, для выбранных вами опций нет специальных предложений.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- select promotion e -->
                                <!-- select trade-in s -->

                                <!-- select trade-in e -->
                                <!-- select care s -->

                                <!-- select care e -->
                            </div>
                        </div>
                    </div>

                    <div class="sh-g-shop-buying-tool_total_wrap">
                        <div class="sh-g-shop-buying-tool_total_content">
                            <div class="sh-g-shop-buying-tool_fin_wrap">
                                <div class="sh-g-shop-buying-tool_fin_list">

                                    <figure>
                                        <img src="//cdn.samsung.com/etc/designs/smg/global/imgs/pre-order/blank.gif" data-src-mobile="images/m_plans_02.png" data-src-pc="images/plans_02.png">
                                    </figure>
                                    <div class="sh-g-shop-buying-tool_fin_text_wrap">
                                        <div class="sh-g-shop-buying-tool_fin_text_box">
                                            <strong class="sh-g-shop-buying-tool_fin_tit">
                                                <a href="//images.samsung.com/is/content/samsung/p5/ru/smartphones/galaxy-s9/rules.pdf" class="sh-g-shop-buying-tool_btn_upgrade" title="Правила акции" data-omni-type="microsite_pdpoption" data-omni="">Ранняя доставка с 8 марта</a>
                                            </strong>
                                            <p class="sh-g-shop-buying-tool_fin_desc"> </p>
                                        </div>
                                        <em class="sh-g-shop-buying-tool_fin_price"> </em>
                                    </div>
                                </div>

                            </div>
                            <div class="sh-g-shop-buying-tool_total_price_wrap">
                                <div class="sh-g-shop-buying-tool_total_price">
                                    <span>ИТОГО</span>
                                    <em id="price" class="sh-g-shop-buying-tool_price"></em>
                                </div>
                                <div class="sh-g-shop-buying-tool_btn_cart">
                                    <a href="#" class="sh-g-shop-buying-tool_btn_default" id="myBtn">КУПИТЬ</a>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- trade-in layer s -->

                    <!-- trade-in layer e -->
                    <!-- care layer s -->

                    <!-- care layer e -->
                    <!-- trade-in js s -->

                    <!-- trade-in js e -->
                    <!-- care js s -->

                    <!-- care js e -->
                </section>
            </div>
        </div>

        <div class="sh-g-title section"><section class="sh-g-title_title_wrap s-buffer-top ">




                <article class="sh-g-title_cont_feature">
                    <div class="sh-g-title_header_warp">
                        <h1 class="sh-g-title_tit">Камера. Создана заново.</h1>

                    </div>
                </article>
            </section></div>
        <div class="sh-g-highlights section">

            <section class="sh-g-highlights_highlights_wrap">
                <article class="sh-g-highlights_cont_feature">
                    <div class="sh-g-highlights_container_wrap">
                        <div class="sh-g-highlights_list_wrap">
                            <div class="sh-g-highlights_list  sh-g-highlights_col_center ">

                                <div class="sh-g-highlights_base">

                                    <figure>
                                        <img src="images/blank.gif" alt="Кристальная чистота капель, замерших в полёте, истинная природа человеческих эмоций, запечатлённая с помощью сверхзамедленной съёмки и отраженная на экране Galaxy S9+. Вы можете увидеть разницу между стандартным для большинства камер режиме съёмки, с частотой 240 кадров в секунду и сверхзамедленной съёмкой 960 кадров в секунду." data-src-mobile="images/m_highlights_list_slow.jpg" data-src-pc="images/highlights_list_slow.jpg">
                                    </figure>
                                </div>
                                <div class="sh-g-highlights_list_cont">
                                    <div class="sh-g-highlights_inner">

                                        <em class="sh-g-highlights_point_txt">Сверхзамедленная съемка (960 кадров/сек)</em>


                                        <h2 class="sh-g-highlights_tit">Камера, способная замедлить время и сделать впечатляющими обычные моменты жизни.</h2>


                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="sh-g-highlights_list_wrap">
                            <div class="sh-g-highlights_list sh-g-highlights_white sh-g-highlights_col_center ">

                                <div class="sh-g-highlights_base">

                                    <figure>
                                        <img src="images/blank.gif" alt="Утончённый вид нового флагманского смартфона спереди. Изысканный дизайн задней части корпуса Galaxy S9+ в цвете Ультрафиолет. И всё это увенчивает непревзойдённая двойная камера" data-src-mobile="images/m_highlights_list_camera.jpg" data-src-pc="images/highlights_list_camera.jpg">
                                    </figure>
                                </div>
                                <div class="sh-g-highlights_list_cont">
                                    <div class="sh-g-highlights_inner">

                                        <em class="sh-g-highlights_point_txt">Яркие снимки в темноте</em>


                                        <h2 class="sh-g-highlights_tit">Революционная камера, адаптирующаяся к освещению как зрачок глаза</h2>
                                        <p class="sh-g-highlights_desc">Съемка изображений при ярком дневном и лунном свете в условиях низкой освещённости с использованием настраиваемой апертуры.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sh-g-highlights_list_wrap">
                            <div class="sh-g-highlights_list  sh-g-highlights_col_right ">

                                <div class="sh-g-highlights_base">

                                    <figure>
                                        <img src="images/blank.gif" alt="Пошаговое сравнение фотографий улыбающейся девушки и её селфимоджи, выполненные в различных мультипликационных техниках." data-src-mobile="images/m_highlights_list_emoji.jpg" data-src-pc="images/highlights_list_emoji.jpg">
                                    </figure>
                                </div>
                                <div class="sh-g-highlights_list_cont">
                                    <div class="sh-g-highlights_inner">

                                        <em class="sh-g-highlights_point_txt">Селфимоджи</em>


                                        <h2 class="sh-g-highlights_tit">Камера, превращающая тебя в эмоджи. Теперь ты действительно не такой, как все.</h2>
                                        <div class="sh-g-shop-buying-tool_btn_cart">
                                            <a href="#" class="sh-g-shop-buying-tool_btn_default" id="myBtn1">Предзаказ</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>

        </div>
        <div class="sh-g-title section"><section class="sh-g-title_title_wrap  ">




                <article class="sh-g-title_cont_feature">
                    <div class="sh-g-title_header_warp">
                        <h1 class="sh-g-title_tit">Ваш новый Galaxy</h1>

                    </div>
                </article>
            </section></div>
        <div class="section sh-g-in-box"><section class="sh-g-in-box_components_wrap">

                <article class="sh-g-in-box_cont_feature">
                    <div class="sh-g-in-box_container_wrap">
                        <div class="sh-g-in-box_inner">
                            <div class="sh-g-in-box_represent_product">


                                <figure>
                                    <img src="images/blank.gif" data-src-mobile="images/m_img_represent_product.png" data-src-pc="images/img_represent_product.png" alt="Galaxy S9 | S9+">
                                </figure>
                                <em class="sh-g-in-box_tit">Galaxy S9 | S9+</em>
                            </div>
                            <ul class="sh-g-in-box_list_compontents">

                                <li>

                                    <figure>
                                        <img src="images/blank.gif" data-src-mobile="images/m_list_compontents01.png" data-src-pc="images/list_compontents01.png" alt="USB кабель">
                                    </figure>

                                    <em class="sh-g-in-box_tit">USB кабель</em>
                                </li>

                                <li>

                                    <figure>
                                        <img src="images/blank.gif" data-src-mobile="images/m_list_compontents02.png" data-src-pc="images/list_compontents02.png" alt="Наушники">
                                    </figure>

                                    <em class="sh-g-in-box_tit">Наушники</em>
                                </li>

                                <li>

                                    <figure>
                                        <img src="images/blank.gif" data-src-mobile="images/m_list_compontents03.png" data-src-pc="images/list_compontents03.png" alt="Шпилька для извлечения SIM">
                                    </figure>

                                    <em class="sh-g-in-box_tit">Шпилька для извлечения SIM</em>
                                </li>

                                <li>

                                    <figure>
                                        <img src="images/blank.gif" data-src-mobile="images/m_list_compontents04.png" data-src-pc="images/list_compontents04.png" alt="Зарядное устройство">
                                    </figure>

                                    <em class="sh-g-in-box_tit">Зарядное устройство</em>
                                </li>

                                <li>

                                    <figure>
                                        <img src="images/blank.gif" data-src-mobile="images/m_list_compontents05.png" data-src-pc="images/list_compontents05.png" alt="Руководство пользователя">
                                    </figure>

                                    <em class="sh-g-in-box_tit">Руководство пользователя</em>
                                </li>

                                <li>

                                    <figure>
                                        <img src="images/blank.gif" data-src-mobile="images/m_list_compontents06.png" data-src-pc="images/list_compontents06.png" alt="Type-C – Type A переходник">
                                    </figure>

                                    <em class="sh-g-in-box_tit">Type-C – Type A переходник</em>
                                </li>

                                <li>

                                    <figure>
                                        <img src="images/blank.gif" data-src-mobile="images/m_list_compontents07.png" data-src-pc="images/list_compontents07.png" alt="MicroUSB переходник">
                                    </figure>

                                    <em class="sh-g-in-box_tit">MicroUSB переходник</em>
                                </li>

                                <li>

                                    <figure>
                                        <img src="images/blank.gif" data-src-mobile="images/m_list_compontents08.png" data-src-pc="images/list_compontents08.png" alt="Лифлет Smart Switch">
                                    </figure>

                                    <em class="sh-g-in-box_tit">Лифлет Smart Switch</em>
                                </li>






                            </ul>

                        </div>
                    </div>
                </article>
            </section></div>
        <div class="cm-g-static-content section">
            <script type="text/javascript">
                var axel = Math.random() + "";
                var a = axel * 10000000000000;
                document.write('<iframe src="https://6721613.fls.doubleclick.net/activityi;src=6721613;type=invmedia;cat=wzfgkybp;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
            </script>
            <noscript>
                <iframe src="https://6721613.fls.doubleclick.net/activityi;src=6721613;type=invmedia;cat=wzfgkybp;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
            </noscript>
            <script type="text/javascript">
                var axel = Math.random() + "";
                var a = axel * 10000000000000;
                document.write('<iframe src="https://6721613.fls.doubleclick.net/activityi;src=6721613;type=invmedia;cat=gwvq8s46;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
            </script>
            <noscript>
                <iframe src="https://6721613.fls.doubleclick.net/activityi;src=6721613;type=invmedia;cat=gwvq8s46;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
            </noscript>
            <!-- End of DoubleClick Floodlight Tag: Please do not remove -->

        </div>

    </div>

</div>

<footer id="footer" role="contentinfo">
    <!--googleoff: all-->
    <div class="gb-footer">
        <div class="gb-footer__bottom">
            <div class="gb-footer__inner">
                <div class="gb-footer__container">
                    <div class="gb-footer__bottom-list">
                        <ul class="gb-footer__list">



                        </ul>
                        <div class="gb-footer__lang">
                            <a href="https://api.whatsapp.com/send?phone=<?php echo $user_phone;?>&text=Здравствуйте!%20Я%20хотел%20бы%20заказать%20Samsung%20s9.%20%20Спасибо!" title="WhatsApp" target="_blank">
                                <img src="images/whatsapp.png"/> +<?php echo $user_phone;?>
                            </a>



                            <div class="gb-footer__lang-dimmed s-layer-dimmed" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="gb-footer__legal">
                        <p>Данный веб-сайт корректно отображается в браузере Microsoft Internet Explorer версии 9 или выше, а также в последних версиях браузеров Google Chrome и Mozilla Firefox.</p>



                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="s-gotop-wrap">
    <button class="s-btn-gotop">Наверх</button>
</div>
<!--googleon: all-->

</div>

<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Сделать предзаказ</p>
        <form action="">
            <input type="text" id="name" required placeholder="Введите ваше имя*" class="input">
            <input type="tel" id="phone" required placeholder="Введите ваш телефон*" class="input">
            <input type="submit" id="order_btn1" value="Предзаказ" class="input submit">
            <input type="hidden" id="btn" value="1">
            <input type="hidden" id="user_phone" value="<?=$user_phone;?>">
        </form>
        <p class="small">Ваши данные не будут переданы третьим лицам</p>
    </div>
</div>

<script type="text/javascript" src="js/page.js"></script>
<script type="text/javascript" src="js/page-shop.js"></script>

<!--[if lte IE 9]>
<script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.3/jquery.xdomainrequest.min.js'></script>
<![endif]-->
<script type="text/javascript" src="js/script.js"></script>

<script type="text/javascript">
    gaCheck === true ? ga('topTracker.send', 'pageview') : "";
    _satellite.pageBottom();
    gaCheck === true ?  ga('bottomTracker.send', 'pageview') : "";
</script>

<script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
</script>

<script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn1");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    mobile.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
</script>
</body>
</html>