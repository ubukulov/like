//Создаем массив с картинками
var images =  Array();
$(function(){
    if($("div").is("#image1")) {
        //Загрузка первого изображения
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
                    images[0]=response;
                } else{
                    //иначе выводим ошибку
                    $('<li></li>').appendTo('#files').text(file).addClass('error');
                }
            }
        });
    }
    
    if($("div").is("#image2")) {
        //Загрузка второго изображения
        var status2=$('#image2');
        new AjaxUpload($('#upload2'), {
            action: '/js/upload-file.php',
            name: 'upload_file',
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    // extension is not allowed
                    status2.text('Поддерживаемые форматы JPG, PNG или GIF');
                    return false;
                }
                status2.html('<img height="100" src="/img/big_load.gif"/>');
            },
            onComplete: function(file, response){
                //Убираем загрузку
                status2.text('');
                if(response === 'error'){
                    status2.text('По каким то причинам картинка не загружена!');
                }
                //Если нет ошибок выводим картинки
                else if(response){
                    //выводим картинку
                    $('#image2').html('<img src="/temp/'+response+'" height="100">').hide().fadeIn();
                    $('#image2').after('<input type="hidden" name="photo2" value="'+response+'" />');
                    images[1]=response;
                } else{
                    //иначе выводим ошибку
                    $('<li></li>').appendTo('#files').text(file).addClass('error');
                }
            }
        });
    }

    if($("div").is("#image3")) {
        //Загрузка третего изображения
        var status3 = $('#image3');
        new AjaxUpload($('#upload3'), {
            action: '/js/upload-file.php',
            name: 'upload_file',
            onSubmit: function (file, ext) {
                if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                    // extension is not allowed
                    status3.text('Поддерживаемые форматы JPG, PNG или GIF');
                    return false;
                }
                status3.html('<img height="100" src="/img/big_load.gif"/>');
            },
            onComplete: function (file, response) {
                //Убираем загрузку
                status3.text('');
                if (response === 'error') {
                    status3.text('По каким то причинам картинка не загружена!');
                }
                //Если нет ошибок выводим картинки
                else if (response) {
                    //выводим картинку
                    $('#image3').html('<img src="/temp/' + response + '" height="100">').hide().fadeIn();
                    $('#image3').after('<input type="hidden" name="photo3" value="' + response + '" />');
                    images[2] = response;
                } else {
                    //иначе выводим ошибку
                    $('<li></li>').appendTo('#files').text(file).addClass('error');
                }
            }
        });
    }

    if($("div").is("#image4")) {
        //Загрузка логотип
        var status4 = $('#image4');
        new AjaxUpload($('#upload4'), {
            action: '/js/upload-file.php',
            name: 'upload_file',
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    // extension is not allowed
                    status4.text('Поддерживаемые форматы JPG, PNG или GIF');
                    return false;
                }
                status4.html('<img height="100" src="/img/big_load.gif"/>');
            },
            onComplete: function(file, response){
                //Убираем загрузку
                status4.text('');
                if(response === 'error'){
                    status4.text('По каким то причинам картинка не загружена!');
                }
                //Если нет ошибок выводим картинки
                else if(response){
                    //выводим картинку
                    $('#image4').html('<img src="/temp/'+response+'" height="100">').hide().fadeIn();
                    $('#image4').after('<input type="hidden" name="logo" value="'+response+'" />');
                    images[3]=response;
                } else{
                    //иначе выводим ошибку
                    $('<li></li>').appendTo('#files').text(file).addClass('error');
                }
            }
        });
    }

    if($("div").is("#image1")) {
        //Загрузка первого изображения
        var status1=$('#image1');
        new AjaxUpload($('#upload5'), {
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
                    $('#image1').html('<img src="/temp/'+response+'" height="140">').hide().fadeIn();
                    $('#image1').after('<input type="hidden" name="photo1" id="photo1" value="'+response+'" />');
                    // images[0]=response;
                    var form = new FormData();
                    form.append('_token',$('#token').val());
                    form.append('image', $('#photo1').val());
                    $.ajax({
                        type: 'post',
                        url: '/user/account/bank',
                        cache: false,
                        data: form,
                        contentType:false,
                        processData:false,
                        success: function(res){
                            if(res == 0){
                                var html = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4>Успешно отправлен!</h4></div>';
                                $('#msg').html(html).removeClass('hidden');
                            }
                        }
                    });
                } else{
                    //иначе выводим ошибку
                    $('<li></li>').appendTo('#files').text(file).addClass('error');
                }
            }
        });
    }
});