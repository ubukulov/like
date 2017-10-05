//Создаем массив с картинками
$(function(){

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
                                var html = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>Успешно отправлен!</span></div>';
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