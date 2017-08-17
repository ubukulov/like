$(document).ready(function(){

    $('.pay2_sum_vvod').keyup(function () {
        sub = JSON.parse($(this).attr('data-sub'));

        var pay2_sum_vvod = $(this).val();

        //сумма каторая показывается
        var pay2_sum = pay2_sum_vvod - (pay2_sum_vvod * sub.percent / 100);

        var pay2_sum_nachislen = pay2_sum * sub.price / 100;


        $('.pay2_sum_' + sub.id).text(pay2_sum);

        $('.pay2_sum_nachislen_' + sub.id).text(pay2_sum_nachislen);

        $('.pay2_sum_vvod_' + sub.id).val(pay2_sum_vvod);

        calc_pay2_total_sum();
        //console.log(pay2_sum);
    });

    $("#partner_card_num").on('keyup',function (){
        if ($("#partner_card_num").val().length == 8) {
            $('#partner_card_pin').focus();
            search_user_card();
        }else{
            $('#card_username').text("Карта не найдена!").hide().fadeIn();
            $('#card_avatar').attr('src', '').hide().fadeIn();
            $('#act').html('').hide().fadeIn();
            $('#acc').html('').hide().fadeIn();
            $('#spisat_summu').removeClass("btn_green");
            $('#spisat_summu').prop("disabled", true);
        }
    });
});


function calc_pay2_total_sum() {

    var total_sum = 0

    $('.pay2_sum_nachislen').each(function () {
        //заносим в массив

        if ($(this).text()) {
            total_sum = total_sum + parseInt($(this).text());
        }

    });
    console.log(total_sum);

    $('#kupon_all_sum').text(total_sum);
}
// находим данные пользователя по его номер карту
function search_user_card() {
    var card_code = $('#partner_card_num').val();

    $.get("/partner/transfer_percent/"+card_code, function (data) {
        data = JSON.parse(data);
        var card_username = $('#card_username');
        var card_avatar = $('#card_avatar');
        var spisat_summu = $('#spisat_summu');
        var acc = $('#acc');
        var act = $('#act');
        if (data.user_name) {
            card_username.text(data.user_name + '\n' + data.mphone).hide().fadeIn();

            if (data.avatar) {
                card_avatar.attr('src', '/uploads/users/small/' + data.avatar).hide().fadeIn();
            } else {
                card_avatar.attr('src', '/img/blank_avatar_220.png').hide().fadeIn();
            };
            if(data.is_active == 1){
                acc.html('<label for="is_active">Доступ: </label> <span id="is_active" style="color:green;">'+data.active+'</span>').hide().fadeIn();
                act.html('<span style="font-size: 12px;">действует до '+data.active_time+'</span>').hide().fadeIn();
                spisat_summu.addClass("btn_green");
                spisat_summu.prop("disabled", false);
            }else{
                acc.html('<label for="is_active">Доступ: </label> <span id="is_active" style="color:red;">'+data.active+'</span>').hide().fadeIn();
                act.html('').hide();
            }

            spisat_summu.removeClass("btn-danger").addClass('btn btn-success');
        } else {
            card_username.text(data.message).hide().fadeIn();
            card_avatar.attr('src', '').hide().fadeIn();
            act.html('').hide().fadeIn();
            acc.html('').hide().fadeIn();
        }
    });
}
// делаем начисление пользователю
function pay_to_user_percent() {
    $(function () {
        var subs = {};
        $('input[name^="sub"]').each(function () {
            //заносим в массив
            subs[$(this).attr('name')] = $(this).val();
        });

        if ($('#kupon_all_sum').text() == 0) {
            alert('Выберите предложения!')
        } else {
            //$('#spisat_summu').button('loading');
            subs['card_code'] = $('#partner_card_num').val();
            subs['total'] = $('.proizvol_val').val();
            subs['_token'] = $('#_token').val();
            $.ajax({
                type: 'POST',
                url: '/partner/transfer_percent/user',
                dataType: 'json',
                data: subs,
                success: function (data) {
                    if (data.code == 3) {
                        $('.status_payment').html('<span style="color: red">' + data.message + '</span>').hide().fadeIn();
                        $('#spisat_summu').button('reset');
                    } else if (data.code == 4) {
                        $('.status_payment').html('<span style="color: red">' + data.message + '</span>').hide().fadeIn();
                        $('#spisat_summu').button('reset');
                    } else if (data.code == 0) {
                        $('.status_payment').html('<span style="color: green">' + data.message + '</span>').hide().fadeIn();
                        var timeout = setTimeout("location.reload(true);", 1000);
                        function resetTimeout() {
                            clearTimeout(timeout);
                            timeout = setTimeout("location.reload(true);", 1000);
                        }
                    }
                }
            });
        }
    });
}