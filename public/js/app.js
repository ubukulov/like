$(document).ready(function(){
    $('#id_cat').dropdown();
    $('.ui.checkbox').checkbox();
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
    if($('div').is('#tabs')){
        $("#tabs").tabs();
    }
    $('#doneTask').click(function(){
        $('.ui.modal').modal({
            closable  : false,
        }).modal('show');
    });
    $('#undoTask').click(function(){
        $('.ui.modal').modal('hide').remove();
    });


    $('.ui .dropdown .item').on('hover', function(){
        $('.menu').addClass('active').css({'margin-top': '20px'}).dropdown();
    });
    
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

    $('#sendTask').on('click', function(){
        var formdata = new FormData();
        formdata.append('title', $('#title').val());
        formdata.append('text', $('#info_editor').val());
        formdata.append('link_to_work', $('#link_to_work').val());
        formdata.append('id_task', $('#id_task').val());
        formdata.append('_token', $("input[name='_token']").val());
        formdata.append('image', $("#photo1").val());
        $.ajax({
            type: 'post',
            url: '/task/done',
            cache: false,
            data: formdata,
            //datatype: 'json',
            processData: false,
            contentType: false,
            success: function(data){
                if(data == 0){
                    var html = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Данные успешно сохранены!</h4></div>';
                    $('#positive').html(html).removeClass('hidden');
                }
                if(data == 2){
                    var html = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Ошибка! Данные не сохранены</h4></div>';
                    $('#positive').html(html).removeClass('hidden');
                }
                if(data == 1){
                    var html = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Ошибка! Данные уже сохранены!</h4></div>';
                    $('#positive').html(html).removeClass('hidden');
                }
            },
            error: function(data){
                //
            }

        });
    });

    //только цифры
    $('.int').on('input', function () {
        this.value = this.value.replace(/^\.|[^\d\.]|\.(?=.*\.)|^-1+(?=\d)/g, '');
    });
    //
    $('#closeCertDetails').click(function(){
        $('.ui.modal').modal({
            closable  : false,
        }).modal('hide');
        $('#positive').addClass('hidden').html('');
    });
    // Пересчитать корзину
    $(".cart_input").each(function () {
        var qty_start = $(this).val();
        $(this).change(function () {
            var qty = $(this).val();
            var res = confirm("Пересчитать корзину?");
            if(res){
                var id = $(this).attr("id");
                id = id.substr(3);
                if(!parseInt(qty)){
                    qty = qty_start;
                }
                $.get("/cart/count/"+id+"/"+qty, function (data) {
                    data = JSON.parse(data);
                    if(data == 1){
                        window.location = '/cart';
                    }else{
                        alert("Пересчитать корзину по каким то причинам не получилось");
                        window.location = '/cart';
                    }
                });
            }else{
                $(this).val(qty_start);
            }
        });
    });
    $('.phone').each(function(){
        $(this).mask("+7 (999)-999-99-99");
    });

});

function taskButton_money(){
    var m = Array();
    var i = 0;

    $(".task_money").each(function(){
        i = i + 1;
        var n = $(this).attr('id');
        m[i] = n.substr(11);
    });
    var count = m.length;
    var k = m.length-1;
    var n = k+1;
    $('#money').val(count);
    var html = '<div id="task_money'+n+'" class="three fields task_money" style="border-top: 1px solid #ccc;padding-top: 10px;"><div class="field" style="width: 50px;vertical-align: middle;padding: 34px 25px;"><span style="font-weight: bold;font-size: 20px;">'+n+'</span></div><div class="field" style="width: 350px;"><div class="ui left action input"><button type="button" style="width: 150px;" class="ui big teal labeled icon button"><i class="payment icon"></i>Стоимость</button><input type="text" placeholder="Введите сумму" name="amount'+n+'"></div><br><br><div class="ui left action input"><button type="button" style="width: 150px;" class="ui big orange labeled icon button"><i class="tag icon"></i>Количество предложений</button><input type="text" placeholder="Введите" name="count'+n+'"></div></div><div class="field" style="width: 50px;padding: 36px 20px;"><i class="remove big red circle icon" style="cursor: pointer;" onclick="deleteTaskMoney('+n+');" title="Удалить"></i></div></div>';
    $("#taskButton_money").before(html);
}
//
function deleteTaskMoney(id) {
    $('#task_money'+id).remove();
    var count = $('#money').val();
    $('#money').val(count-1);
}
function taskButton_gift(){
    var m = Array();
    var i = 0;

    $(".task_gift").each(function(){
        i = i + 1;
        var n = $(this).attr('id');
        m[i] = n.substr(10);
    });
    var count = m.length;
    var k = m.length-1;
    var n = k+1;
    $('#gift').val(count);
    var html = '<div id="task_gift'+n+'" class="three fields task_gift" style="border-top: 1px solid #ccc;padding-top: 10px;"><div class="field" style="width: 50px;vertical-align: middle;padding: 34px 25px;"><span style="font-weight: bold;font-size: 20px;">'+n+'</span></div><div class="field" style="width: 350px;"><div class="ui left action input"><button type="button" style="width: 150px;" class="ui big blue teal labeled icon button"><i class="payment icon"></i>Наименование</button><input type="text" placeholder="Название" name="gift_name'+n+'"></div><br><br><div class="ui left action input"><button type="button" style="width: 150px;" class="ui big labeled icon button"><i class="tag icon"></i>Количество предложений</button><input type="text" placeholder="Введите" name="gift_count'+n+'"></div></div><div class="field" style="width: 50px;padding: 36px 20px;"><i class="remove big red circle icon" style="cursor: pointer;" onclick="deleteTaskGift('+n+');" title="Удалить"></i></div></div>';
    $("#taskButton_gift").before(html);
}
//
function deleteTaskGift(id) {
    $('#task_gift'+id).remove();
    var count = $('#gift').val();
    $('#gift').val(count-1);
}
//
function approve_btn(id_task,id_work){
    $.get("/partner/work/"+id_task, function (data) {
        data = JSON.parse(data);
        var html = '<div class="ui modal" style="top:0px; height: 600px; width: 1000px;"><div class="content"><div class="row"><h2>Форма вознаграждение испольнителя</h2><hr>';
        html = html + '<div class="col-md-6"><h4>Вознаграждение денгами</h4>';
        for(var i=0; i<data.length; i++){
            if(data[i].amount != null && data[i].count != null && data[i].count != 0){
                html = html + '<div class="ui small labeled input" style="margin-bottom: 5px;"><div class="ui small orange label" style="width: 150px;">'+data[i].amount+'</div><input disabled="disabled" type="text" id="count'+data[i].id+'" style="width: 150px;" value="'+data[i].count+'">&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="sendTaskMoney('+data[i].id+','+id_task+', '+id_work+');" class="btn btn-success"><i class="dollar icon"></i>&nbsp;Отправить</button></div>';
            }
        }
        html = html + '</div>';

        html = html + '<div class="col-md-6"><h4>Вознаграждение подарками</h4>';
        for(var i=0; i<data.length; i++){
            if(data[i].gift_name != null && data[i].gift_count != null && data[i].gift_count != 0){
                html = html + '<div class="ui small labeled input" style="margin-bottom: 5px;"><div class="ui small orange label" style="width: 150px;">'+data[i].gift_name+'</div><input disabled="disabled" type="text" id="gift_count'+data[i].id+'" style="width: 150px;" value="'+data[i].gift_count+'">&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="sendTaskGift('+data[i].id+','+id_work+');" class="btn btn-success"><i class="gift icon"></i>&nbsp;Отправить</button></div>';
            }
        }
        html = html + '</div></div><br><br><hr>';
        html = html + '<div class="row"><div class="col-md-12"><h3 style="text-align: center;">Оцените работу испольнителя</h3><br><div class="row"><div class="col-md-4"><button type="button" onclick="task_rating(3,'+id_work+');" style="width: 100%;" class="btn btn-success">КЛАСС!</button></div><div class="col-md-4"><button type="button" onclick="task_rating(2,'+id_work+');" style="width: 100%;" class="btn btn-warning">ХОРОШО</button></div><div class="col-md-4"><button type="button" onclick="task_rating(1,'+id_work+');" style="width: 100%;" class="btn btn-app">НОРМАЛЬНО</button></div></div></div></div><br><br><hr><button id="undoTask" onclick="approve_btn_close();" type="button" class="btn btn-danger"><i class="remove small circle icon"></i>&nbsp;&nbsp;Закрыть окно</button><br><br><div id="positive" class="hidden"></div></div></div>';
        $('#work').after(html);
        $(function(){
            $('.ui.modal').modal({
                closable  : false,
            }).modal('show');
        });    
    });
}
function approve_btn_close() {
    $(function(){
        $('.ui.modal').modal('hide').remove();
    });
}
// task rating user
function task_rating(id_rating, id_work) {
    var id_rating = parseInt(id_rating);
    var id_work = parseInt(id_work);
    $.get("/partner/task/rating/"+id_rating+"/work/"+id_work, function(data){
        if(data == 0){
            var html = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Вы успешно оценили испольнителя!</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
        if(data == 100){
            var html = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Вы уже оценили испольнителя по этому работу!</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
        if(data == 101){
            var html = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Ошибка! По каким-то причинам не удалось оценить!</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
    });
}
// task send money : task_details column id
function sendTaskMoney(id_detail, id_task, id_work) {
    $.get('/partner/task/send/'+id_detail+'/'+id_task+'/'+id_work, function(data){
        if(data == 0){
            var html = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Вы успешно вознаграждали испольнителя денгами!</h4></div>';
            $('#positive').html(html).removeClass('hidden');
            var count =  $('#count'+id_detail).val();
            $('#count'+id_detail).val(count-1);
        }
        if(data == 100){
            var html = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Ошибка! Для этого работу не указано никаких вознаграждении</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
        if(data == 101){
            var html = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Вы уже вознаграждали испольнителя!</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
        if(data == 102){
            var html = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Ошибка! Не удалось получить данные о работе</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
        if(data == 103){
            var html = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>У вас не достаточно денег в балансе!</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
    });
}
// task send gift
function sendTaskGift(id_task_detail, id_work){
    $.get('/partner/task/sendgift/'+id_task_detail+'/'+id_work, function(data){
        if(data == 0){
            var html = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Вы успешно вознаграждали испольнителя подарками!</h4></div>';
            $('#positive').html(html).removeClass('hidden');
            var count =  $('#gift_count'+id_task_detail).val();
            $('#count'+id_task_detail).val(count-1);
        }
        if(data == 100){
            var html = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Ошибка! Не удалось получить данные</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
        if(data == 101){
            var html = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Вы уже вознаграждали испольнителя!</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
    });
}
// task commit
function task_commit(id_work, token) {
    var html = '<div class="ui modal" style="top:0px; height: 800px; width: 1000px;"><input type="hidden" name="_token" id="token'+id_work+'" value="'+token+'"/><div class="content"><div class="row"><h2 class="green">Форма переписки</h2><hr><div class="col-md-12"><input type="text" id="title'+id_work+'" placeholder="Введите названия" class="form-control"><br><textarea id="info_editor'+id_work+'" cols="30" rows="10"></textarea></div></div><br><div class="row"><div class="col-md-6"><div class="ui labeled input"> <div class="ui label"> Ссылка </div> <input style="width: 350px;" type="text" placeholder="mysite.com" id="link'+id_work+'"> </div> </div> <div class="col-md-6"> <div class="ui small image"> <div id="image1"> <img src="/img/image.png"> </div> <br> <button onclick="task_commit_img();" type="button" id="upload1" class="btn btn-warning">Выбрать картинку</button> </div> </div> </div><hr><button onclick="sendTaskCommit('+id_work+');" type="button" class="btn btn-success"><i class="send icon"></i>&nbsp;&nbsp; Комментировать и отправить</button>&nbsp;&nbsp;&nbsp;<button onclick="task_commit_close();" type="button" class="btn btn-danger"><i class="remove small circle icon"></i>&nbsp;&nbsp;Закрыть окно</button><br><br><div id="positive" class="hidden"></div></div></div>';
    $('#work').after(html);
    $(function(){
        $('.ui.modal').modal({
            closable  : false,
        }).modal('show');
        $('#info_editor'+id_work).froalaEditor({
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
    });
}
// task close
function task_close_work(id_work) {
    var del = confirm('Вы действительно хотите отменить работу испольнителя?');
    if(del){
        window.location = '/partner/task/work/close/'+id_work;
    }
}
// task commit
function sendTaskCommit(id_work){
    var title = $('#title'+id_work).val();
    var text  = $('#text'+id_work).val();
    var link  = $('#link'+id_work).val();
    var image  = $('#photo1').val();
    var form = new FormData();
    form.append('_token',$('#token'+id_work).val());
    form.append('id_work', id_work);
    form.append('title', title);
    form.append('text', text);
    form.append('link', link);
    form.append('image', image);
    $.ajax({
        type: 'post',
        url: '/partner/task/work/commit',
        cache: false,
        data: form,
        contentType:false,
        processData:false,
        success: function(res){
            if(res == 0){
                var html = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Вы успешно комментировали!</h4></div>';
                $('#positive').html(html).removeClass('hidden');
            }
            if(res == 100){
                var html = '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Ошибка! Не удалось комментировать</h4></div>';
                $('#positive').html(html).removeClass('hidden');
            }
        }
    });
}
//
function task_commit_close() {
    $(function(){
        $('.ui.modal').modal('hide').remove();
    });
}
//
function task_commit_img() {
    $(function(){
        var status1=$('#image1');
        new AjaxUpload($('#upload1'), {
            action: '/js/upload-file.php',
            name: 'upload_file',
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    // extension is not allowed
                    status1.text('Поддерживаемые форматы JPG, PNG или GIF');
                    return false;
                }
                status1.html('<img height="100" src="/img/big_load.gif"/>');
            },
            onComplete: function(file, response){
                //Убираем загрузку
                status1.text('');
                if(response === 'error'){
                    status1.text('По каким то причинам картинка не загружена!');
                }
                //Если нет ошибок выводим картинки
                else if(response){
                    //выводим картинку
                    $('#image1').html('<img src="/temp/'+response+'" height="100">').hide().fadeIn();
                    $('#image1').after('<input type="hidden" name="photo1" id="photo1" value="'+response+'" />');
                    //images[0]=response;
                } else{
                    //иначе выводим ошибку
                    $('<li></li>').appendTo('#files').text(file).addClass('error');
                }
            }
        });
    });
}
// перенаправлять пользователя на форму авторизации
function redirect_to_user_login_form() {
    window.location = '/user/login';
}
// варианты предложении задании
function certDetails(){
    $(function() {
        $('.ui.modal').modal({
            closable: false,
        }).modal('show');
    });
}
function payment(id) {
    var id = id;
    switch (id){
        case 1:
            $("#pay").show();
            $("#qiwi").hide();
            break;

        case 2:
            $("#pay").hide();
            $("#qiwi").show();
            break;

        case 3:
            $("#pay").hide();
            $("#qiwi").hide();
            break;
    }
}
// добавить товар в корзину
function addToCart(offer_id){
    var offer_id = parseInt(offer_id);
    $.get("/cart/add/"+offer_id, function(data){
        if(data == 1){
            var html = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Товар добавлен в корзину</h4></div>';
            $('#positive').html(html).removeClass('hidden');
        }
    });
}