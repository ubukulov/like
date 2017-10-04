$(function(){
    $(".select2").select2();
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
    $('#id_main_cat').change(function(){
        var id_cat = $(this).val();
        $.get('/admin/cert/get/cats/'+id_cat, function(data){
            data = JSON.parse(data);
            var html = '';
            for(var i=0; i<data.length; i++){
                html = html + '<option value="'+data[i].id+'">'+data[i].title+'</option>';
            }
            $('#id_pod_cat').html(html);
        });
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