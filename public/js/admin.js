$(function(){
    $(".select2").select2();
    $('.ui.checkbox').checkbox();
    $('#date_start').datepicker({
        dateFormat: 'dd.mm.YY'
    });
    $('#date_end').datepicker({});

    $('#id_cat').dropdown();
    // $('#info_editor').froalaEditor({
    //     heightMin: 160,
    //     heightMax: 800,
    //     language: 'ru',
    //     charCounterMax: 3072,
    //     toolbarSticky: false,
    //     enter: $.FroalaEditor.ENTER_DIV,
    //     tabSpaces: 8,
    //     fontSize: ['8', '10', '12', '14', '18'],
    //     toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript',
    //         'fontFamily', 'fontSize', '|',
    //         'color', 'emoticons', 'paragraphStyle', '|',
    //         'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent','quote', 'insertHR', '|',
    //         'insertLink', /*'insertImage', 'insertVideo', 'insertFile', 'insertTable',*/ 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
    //     tableStyles: {
    //         fr_portal_table1: 'стиль таблицы 1',
    //         fr_portal_table2: 'стиль таблицы 2',
    //         fr_portal_table3: 'стиль таблицы 3'
    //     }
    // });
    $('#task_variant1').change(function(){
        if($(this).prop('checked')){
            $('.task_money').show();
            $('#taskButton_money').show();
        }else{
            $('.task_money').hide();
            $('#taskButton_money').hide();
        }
    });
    $('#task_variant2').change(function(){
        if($(this).prop('checked')){
            $('.task_gift').show();
            $('#taskButton_gift').show();
        }else{
            $('.task_gift').hide();
            $('#taskButton_gift').hide();
        }
    });
    $("#phone").mask("+7 (999)-999-99-99");
    $("#card_number").mask("99999999");

    // стоимость доставки
    $('#id_cost_delivery').change(function(){
        if($(this).val() == 1){
            $('#delivery').show();
        }else{
            $('#delivery').hide();
            $('#cost_delivery').val('');
        }
    });

    // только цифры
    $('.int').on('input', function () {
        this.value = this.value.replace(/^\.|[^\d\.]|\.(?=.*\.)|^-1+(?=\d)/g, '');
    });

    // деактивировать поля
    $("#deactivated").on('click', function(){
        $(".deactivated").each(function(){
            $(this).prop('readonly', false);
            $(this).prop('disabled', false);
        });
        $(this).prop('disabled', true);
        $("#activated").prop('disabled', false);
    });
    // сохранить некоторые данные заказов
    $("#activated").on('click', function(){
        var count = $("#cnt").val();
        var pay   = $("#tp :selected").val();
        var id_item = $("#id_item").val();
        var customer_address = $("#customer_address").val();
        var firstname_customer = $("#firstname_customer").val();
        if(count == 0){
            alert("Нужно указать количество");
            $("#cnt").focus();
        }else if(pay == 0){
            alert("Нужно выбрать тип оплаты");
            $("#tp").focus();
        }else if(customer_address.length == 0){
            alert("Укажите адрес доставки");
            $("#customer_address").focus();
        }else{
            var form = new FormData();
            form.append('_token',$('#_token').val());
            form.append('count', count);
            form.append('pay', pay);
            form.append('id_item', id_item);
            form.append('customer_address', customer_address);
            form.append('firstname_customer', firstname_customer);
            $.ajax({
                type: 'post',
                url: '/admin/order/'+id_item,
                cache: false,
                data: form,
                contentType:false,
                processData:false,
                success: function(res){
                    if(res == 0){
                        alert("Данные успешно сохранен");
                        window.location = '/admin/order/'+id_item;
                    }
                    if(res == 101){
                        alert("Ошибка! Попробуйте позже");
                        window.location = '/admin/orders';
                    }
                }
            });
        }
    });
    // поиск по нажатие кнопку ентер
    $("#cert_title").keyup(function(e){
        if(e.keyCode == 13){
            search_cert_by_title();
        }
    });
    // сохранение канал продаж
    $("#channel_sells").change(function(){
        var val = $("#channel_sells :selected").val();
        var id= $("#id_item").val();
        var choice = confirm('Вы действительно хотите сохранить этот вариант?');
        if(choice){
            $.get("/admin/order/"+id+"/channel/"+val, function(){
                alert("Успешно изменен!");
                window.location.href = "/admin/order/"+id;
            });
        }
    });
});

function delete_opt_partner(id) {
    var choice = confirm('Вы действительно хотите удалить?');
    if(choice){
        window.location = '/admin/opt_partner/delete/'+id;
    }
}
// удаление задание
function delete_cert(id) {
    var del = confirm('Вы действительно хотите удалить?');
    if(del){
        window.location = '/admin/cert/delete/'+id;
    }
}
// удаление основного прайса
function delete_opt_price(id) {
    var choice = confirm('Вы действительно хотите удалить?');
    if(choice){
        window.location = '/admin/opt_price/delete/'+id;
    }
}
// ассортимент
function delete_opt_price_range(id) {
    var choice = confirm('Вы действительно хотите удалить?');
    if(choice){
        window.location = '/admin/range/delete/'+id;
    }
}
// удаление страницы
function delete_page(id) {
    var choice = confirm('Вы действительно хотите удалить?');
    if(choice){
        window.location = '/admin/page/delete/'+id;
    }
}
// удаление тип задание
function delete_type_task(id) {
    var del = confirm('Вы действительно хотите удалить?');
    if(del){
        window.location = '/admin/task/type/delete/'+id;
    }
}
// удаление сертификатов
function delete_cert_sub(id) {
    var del = confirm('Вы действительно хотите удалить?');
    if(del){
        window.location = '/admin/cert/sub/delete/'+id;
    }
}
// opt_price
function createUploadForm(){
    var m = Array();
    var i = 0;

    $(".uploadPrice").each(function(){
        i = i + 1;
        var n = $(this).attr('id');
        m[i] = n.substr(11);
    });
    var count = m.length;
    var k = m.length-1;
    var n = k+1;
    $('#count').val(count);
    var html = '<div class="row uploadPrice" id="uploadPrice'+n+'"><div class="col-md-1"><label for="number'+n+'">№</label><span class="form-control">'+n+'</span></div><div class="col-md-3"><label for="title'+n+'">Название</label><input type="text" id="title'+n+'" class="form-control" name="title'+n+'" required></div><div class="col-md-3"><label for="count_type'+n+'">Количество видов</label><input type="text" id="count_type'+n+'" class="form-control" name="count_type'+n+'" required></div><div class="col-md-3"><label for="excel'+n+'">Файл</label><br><input type="file" id="excel'+n+'" name="excel'+n+'" class="excel form-control" required></div><div class="col-md-1"><label for="number'+n+'">Удалить</label><button onclick="deleteUploadForm('+n+');" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></div></div>';
    $("#createUploadButton").before(html);
}
//
function deleteUploadForm(id) {
    $('#uploadPrice'+id).remove();
    var count = $('#count').val();
    $('#count').val(count-1);
}
// удаление таск по ид
function delete_task(id) {
    var del = confirm('Вы действительно хотите удалить?');
    if(del){
        window.location = '/admin/task/delete/'+id;
    }
}
// удаление партнера по ид
function delete_partner(id) {
    var del = confirm('Вы действительно хотите удалить?');
    if(del){
        window.location = '/admin/partner/delete/'+id;
    }
}
// возврат
function return_pay_to_user(id) {
    var del = confirm('Вы действительно хотите отменить?');
    if(del){
        window.location = '/admin/partner/charge/refund/'+id;
    }
}
// поиск по телефон номеру
function search_by_phone() {
    var phone = $('#phone').val();
    var user_content = $('#user_content');
    $.ajax({
        type: 'post',
        url: '/admin/users/phone',
        data: { phone: phone },
        cache: false,
        //dataType: 'json',
        success: function (res) {
            user_content.html('');
        }
    });
}
// поиск по номер карты
function search_by_card() {
    var card_number = $('#card_number').val();
    var user_content = $('#user_content');
    $.get("/admin/users/card/"+card_number, function(data){
        user_content.html('');
        data = JSON.parse(data);
        var html = "";
        for(var i = 0; i < data.length; i++){
            var avatar;
            var reg_date;
            if(data[i].avatar == ''){
                avatar = '<img src="/img/blank_avatar_220.png" alt="" height="40" width="40" />';
            }else{
                avatar = '<img src="/uploads/users/small/'+data[i].avatar+'" alt="" height="40" width="40" />';
            }
            if(data[i].reg_date == ''){
                reg_date = data[i].created_at;
            }else{
                reg_date = data[i].reg_date;
            }
            avatar = avatar + ' ' + data[i].firstname+' '+data[i].lastname;
            html = html + '<tr><td>'+data[i].id+'</td><td>'+data[i].referral+'</td><td>'+avatar+'</td><td></td><td>'+data[i].mphone+'</td><td><button class="blue" >войти</button></td><td>'+data[i].code+'</td><td>'+data[i].fm+'</td><td>'+reg_date+'</td></tr>';
        }
        user_content.html(html);
    });
}
// одобрение магазина
function confirm_store(id) {
    var del = confirm('Вы действительно хотите одобрить?');
    if(del){
        window.location = '/admin/business/up/'+id;
    }
}
// отказ магазина
function cancel_store(id) {
    var del = confirm('Вы действительно хотите отменить?');
    if(del){
        window.location = '/admin/business/down/'+id;
    }
}
// удаление новости
function delete_news(id) {
    var del = confirm('Вы действительно хотите удалить?');
    if(del){
        window.location = '/admin/news/delete/'+id;
    }
}
// подтвердить статус заказа
function confirm_store_order(id) {
    var del = confirm('Вы действительно хотите подтвердить?');
    if(del){
        var status = $('#status'+id+' :selected').val();
        window.location = '/admin/order/'+id+'/status/'+status;
    }
}
// учитывать стоимость доставки
function cost_delivery(id_order){
    var cost_delivery = $('#cost_delivery').val();
    var id_cost_delivery = $('#id_cost_delivery :selected').val();
    if(id_cost_delivery == 0){
        // доставка бесплатно
        $.get('/admin/order/'+id_order+'/delivery/', function(data){
            if(data == 0){
                alert("Изменение успешно принят!");
                window.location = '/admin/order/'+id_order;
            }
            if(data == 400){
                alert("Произошло не предвиденная ошибка!");
                window.location = '/admin/order/'+id_order;
            }
        });
    }else{
        // доставка платно
        if(cost_delivery < 500){
            // минимальная стоимость доставки - 500 тг
            alert("Минимальная стоимость доставки - 500тг.");
            $('#cost_delivery').focus();
        }else{
            // иначе
            $.get('/admin/order/'+id_order+'/delivery/'+cost_delivery, function(data){
                if(data == 0){
                    alert("Изменение успешно принят!");
                    window.location = '/admin/order/'+id_order;
                }
                if(data == 400){
                    alert("Произошло не предвиденная ошибка!");
                    window.location = '/admin/order/'+id_order;
                }
            });
        }
    }

}
// список категории
function get_cats(id1, id2){
    if(id1 == 'id_pod_cat1'){
        $('#id_pod_cat').val($('#'+id1+' :selected').val());
    }
    if(id1 == 'id_pod_cat2'){
        $('#id_pod_cat').val($('#'+id1+' :selected').val());
    }
    if(id1 == 'id_pod_cat3'){
        $('#id_pod_cat').val($('#'+id1+' :selected').val());
    }else{
        var id_cat = $('#'+id1).val();
        $.get('/admin/cert/get/cats/'+id_cat, function(data){
            data = JSON.parse(data);
            var html = '<option value="">-- Выберите --</option>';
            for(var i=0; i<data.length; i++){
                html = html + '<option value="'+data[i].id+'">'+data[i].title+'</option>';
            }
            $('#'+id2).html(html);

        });
    }
}
// закрыт статус предложение
function close_suggest(id) {
    var del = confirm('Вы действительно хотите закрыть?');
    if(del){
        window.location = '/admin/suggest/'+id;
    }
}
// закрыт купить в 1 клик
function close_buy_1_click(id) {
    var del = confirm('Вы действительно хотите закрыть?');
    if(del){
        window.location = '/admin/buy_one_click/'+id;
    }
}
// opt_price
function createOptom(){
    var m = Array();
    var i = 0;
    if($("div").is("#uploadPrice1")) {
        $(".uploadPrice").each(function(){
            i = i + 1;
            var n = $(this).attr('id');
            m[i] = n.substr(11);
        });
        var count = m.length;
        var k = m.length-1;
        var n = k+1;
        $('#cnt').val(count);
        var html = '<div class="row uploadPrice" id="uploadPrice'+n+'"><div class="col-md-2"><label for="number'+n+'">№</label><span class="form-control">'+n+'</span></div><div class="col-md-2"><label for="from">от</label><input type="text" id="from'+n+'" class="form-control int" name="from'+n+'" required></div><div class="col-md-2"><label for="to'+n+'">до</label><input type="text" id="to'+n+'" class="form-control int" name="to'+n+'" required></div><div class="col-md-4"><label for="sum'+n+'">сумма</label><input type="text" id="sum'+n+'" class="form-control int" name="sum'+n+'" required></div><div class="col-md-2"><label for="number'+n+'">удалить</label><button type="button" onclick="deleteOptom('+n+');" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></div></div>';
        $("#createUploadButton").before(html);
    }else{
        $('#cnt').val(1);
        var html = '<div class="row uploadPrice" id="uploadPrice1"><div class="col-md-2"><label for="number1">№</label><span class="form-control">1</span></div><div class="col-md-2"><label for="from">от</label><input type="text" id="from1" class="form-control int" name="from1" required></div><div class="col-md-2"><label for="to1">до</label><input type="text" id="to1" class="form-control int" name="to1" required></div><div class="col-md-4"><label for="sum1">сумма</label><input type="text" id="sum1" class="form-control int" name="sum1" required></div></div>';
        $("#createUploadButton").before(html);
    }
}
//
function deleteOptom(id) {
    $('#uploadPrice'+id).remove();
    var count = $('#cnt').val();
    $('#cnt').val(count-1);
}
function deleteOptomBD(id, id_cert){
    $('#uploadPrice'+id).remove();
    $.get("/admin/cert/opt/"+id, function(data){
        if(data == 0){
            alert("Успешно удален");
            window.location = '/admin/cert/'+id_cert;
        }
    });

}
// поиск по название
function search_cert_by_title() {
    var cert_title = $('#cert_title').val();
    var cert_content = $('#cert_content');
    $.get("/admin/cert/search/"+cert_title, function(data){
        cert_content.html('');
        data = JSON.parse(data);
        var html = "";
        if(data.length != 0){
            for(var i = 0; i < data.length; i++){
                var avatar;
                var reg_date;
                if(data[i].image == ''){
                    avatar = '<img src="/img/blank_avatar_220.png" alt="" height="40" width="40" />';
                }else{
                    avatar = '<img src="/uploads/certs/'+data[i].image+'" alt="" height="40" width="60" />';
                }
                if(data[i].reg_date == ''){
                    reg_date = data[i].created_at;
                }else{
                    reg_date = data[i].reg_date;
                }
                html = html + '<tr><td>'+data[i].id+'</td><td>'+avatar+'</td><td>'+data[i].title+'</td><td></td><td></td><td></td><td><a href="/admin/cert/'+data[i].id+'" class="btn btn-warning">Редактировать</a></td><td></td></tr>';
            }
            cert_content.html(html);
            $(".pagination").remove();
        }else{
            cert_content.html("<div class='alert alert-info'>Не найдено записей</div>");
        }
    });
}
// BestPrice
function createSupp(){
    var m = Array();
    var i = 0;
    var supp;
    if($("div").is("#uploadPriceSupp1")) {
        $(".uploadSupp").each(function(){
            i = i + 1;
            var n = $(this).attr('id');
            m[i] = n.substr(11);
        });
        var count = m.length;
        var k = m.length-1;
        var n = k+1;
        $.get("/admin/cert/supplier/101", function(data){
            data = JSON.parse(data);
            supp = '<label for="supp'+n+'">Поставщик</label><select id="supp'+n+'" name="supp'+n+'" class="form-control select2" style="cursor: pointer;">';
            for(var i=0; i<data.length; i++){
                supp = supp + '<option value="'+data[i].id+'">'+data[i].name+'</option>';
            }
            supp = supp + '</select>';

            $('#cnt_supp').val(count);
            var html = '<div class="row uploadSupp" id="uploadPriceSupp'+n+'"><div class="col-md-2"><label for="n'+n+'">№</label><span class="form-control">'+n+'</span></div><div class="col-md-3"><label for="from">Цена</label><input type="text" id="price_supp'+n+'" name="price_supp'+n+'" required class="form-control int"></div><div class="col-md-5">'+supp+'</div><div class="col-md-2"><label for="n'+n+'">удалить</label><button type="button" onclick="deleteSupp('+n+');" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></div></div>';
            $("#createUploadButtonSupp").before(html);
        });
    }else{
        $('#cnt_supp').val(1);
        var html = '<div class="row uploadSupp" id="uploadPriceSupp1"><div class="col-md-2"><label for="n">№</label><span class="form-control">1</span></div><div class="col-md-3"><label for="from">Цена</label><input type="text" id="price_supp1" name="price_supp1" required class="form-control int"></div><div class="col-md-5">'+supp+'</div></div>';
        $("#createUploadButtonSupp").before(html);
    }
}
// удаление строк которые хотели удалить в форме настройки цены
function deleteSupp(id) {
    $('#uploadPriceSupp'+id).remove();
    var count = $('#cnt_supp').val();
    $('#cnt_supp').val(count-1);
}