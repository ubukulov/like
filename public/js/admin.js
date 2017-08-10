$(function(){
    $(".select2").select2();
    $('#date_start').datepicker({
        dateFormat: 'dd.mm.YY'
    });
    $('#date_end').datepicker({});

    $('#id_cat').dropdown();
    $('#info_editor').froalaEditor({
        heightMin: 160,
        heightMax: 800,
        language: 'ru',
        charCounterMax: 3072,
        toolbarSticky: false,
        enter: $.FroalaEditor.ENTER_DIV,
        tabSpaces: 8,
        fontSize: ['8', '10', '12', '14', '18'],
        toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript',
            'fontFamily', 'fontSize', '|',
            'color', 'emoticons', 'paragraphStyle', '|',
            'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent','quote', 'insertHR', '|',
            'insertLink', /*'insertImage', 'insertVideo', 'insertFile', 'insertTable',*/ 'undo', 'redo', 'clearFormatting', 'selectAll', 'html'],
        tableStyles: {
            fr_portal_table1: 'стиль таблицы 1',
            fr_portal_table2: 'стиль таблицы 2',
            fr_portal_table3: 'стиль таблицы 3'
        }
    });
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
