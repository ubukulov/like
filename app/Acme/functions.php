<?php
use Illuminate\Support\Facades\DB;
use App\OptPartner;
use App\User;
use App\Task;
use App\CertView;
# Посчитать кол-во задании
function count_certs(){
    $result = DB::select("SELECT * FROM certs");
    return count($result);    
}

# Посчитать кол-во картов
function count_cards(){
    $result = DB::select("SELECT * FROM cards");
    return count($result);
}

# Посчитать кол-во партнеров
function count_partners(){
    $result = DB::select("SELECT * FROM partners");
    return count($result);
}

# Посчитать кол-во пользователей
function count_users(){
    $result = DB::select("SELECT * FROM users");
    return count($result);
}

# Посчитать кол-во пользователей
function count_pages(){
    $result = DB::select("SELECT * FROM pages");
    return count($result);
}
# Посчитать кол-во заявок на вывод
function count_withdraw(){
    $result = DB::select("SELECT * FROM user_withdraw_history");
    return count($result);
}

# По ид пользователя получить его номер карты
function getCardNumberByUserID($user_id){
    $result = DB::select("SELECT code FROM cards WHERE user_id = '$user_id'");
    if($result){
        return $result[0]->code;
    }else{
        return false;
    }
}

# По ид пользователя получить его город
function getUserCity($city_id){
    $result = DB::select("SELECT * FROM city WHERE id='$city_id'");
    if($result){
        return $result[0]->city;
    }else{
        return "Город не указан";
    }
}

# Получить список городов
function getCities(){
    $result = DB::select("SELECT * FROM city WHERE city!=''");
    return $result;
}
# метод шифрование по ключу
function __encode($text, $key) {
    $td = mcrypt_module_open("tripledes", '', 'cfb', '');
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    if (mcrypt_generic_init($td, $key, $iv) != -1) {
        $enc_text = base64_encode(mcrypt_generic($td, $iv . $text));
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $enc_text;
    }
}
# метод расшифрование по ключу
function __decode($text, $key) {
    $td = mcrypt_module_open("tripledes", '', 'cfb', '');
    $iv_size = mcrypt_enc_get_iv_size($td);
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    if (mcrypt_generic_init($td, $key, $iv) != -1) {
        $decode_text = substr(mdecrypt_generic($td, base64_decode($text)), $iv_size);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $decode_text;
    }
}

# Определить оставшых дней - Business
function check_count_day_tariff($user_id){
    $sql = "SELECT (TO_DAYS(p.deadline) - TO_DAYS(CURRENT_TIMESTAMP)) AS count_day FROM user_pay_tariff p WHERE id_user='$user_id'";
    $result = DB::select($sql);
    if($result){
        $count_day = $result[0]->count_day;
        if($count_day){
            switch ($count_day){
                case $count_day > 4:
                    return "осталось ".$count_day." дней";
                    break;
                case ($count_day < 5) AND ($count_day > 1):
                    return "осталось ".$count_day." дня";
                    break;
                case $count_day == 1:
                    return "осталось ".$count_day." день";
                    break;
            }
        }else{
            $sql = "SELECT (UNIX_TIMESTAMP(p.deadline) - UNIX_TIMESTAMP(CURRENT_TIMESTAMP)) AS count_time FROM user_pay_tariff p WHERE id_user='$user_id'";
            $result = $this->db->query($sql);
            $res = $result->fetch(PDO::FETCH_ASSOC);
            $count_time = $res['count_time'];
            switch ($count_time){
                case $count_time > 14400:
                    return "осталось ".round(($count_time/60)/60)." часов";
                    break;
                case ($count_time < 18000) AND ($count_time > 3600):
                    return "осталось ".round(($count_time/60)/60)." часа";
                    break;
                case $count_time == 3600:
                    return "осталось час";
                    break;
                case ($count_time < 3600) AND ($count_time >= 60):
                    return "осталось ".round($count_time/60)." мин";
                    break;
                case ($count_time < 60) AND ($count_time > 10):
                    return "осталось минута";
                    break;
                default:
                    return "срок истек";
                    break;
            }
        }
    }
}

# OptPrice
function check_count_day($user_id){
    $sql = "SELECT (TO_DAYS(p.deadline) - TO_DAYS(CURRENT_TIMESTAMP)) AS count_day FROM user_pay_access p WHERE id_user='$user_id'";
    $result = DB::select($sql);
    if($result){
        $count_day = $result[0]->count_day;
        if($count_day){
            switch ($count_day){
                case $count_day > 4:
                    return "осталось ".$count_day." дней";
                    break;
                case ($count_day < 5) AND ($count_day > 1):
                    return "осталось ".$count_day." дня";
                    break;
                case $count_day == 1:
                    return "осталось ".$count_day." день";
                    break;
            }
        }else{
            $sql = "SELECT (UNIX_TIMESTAMP(p.deadline) - UNIX_TIMESTAMP(CURRENT_TIMESTAMP)) AS count_time FROM user_pay_access p WHERE id_user='$user_id'";
            $result = $this->db->query($sql);
            $res = $result->fetch(PDO::FETCH_ASSOC);
            $count_time = $res['count_time'];
            switch ($count_time){
                case $count_time > 14400:
                    return "осталось ".round(($count_time/60)/60)." часов";
                    break;
                case ($count_time < 18000) AND ($count_time > 3600):
                    return "осталось ".round(($count_time/60)/60)." часа";
                    break;
                case $count_time == 3600:
                    return "осталось час";
                    break;
                case ($count_time < 3600) AND ($count_time >= 60):
                    return "осталось ".round($count_time/60)." мин";
                    break;
                case ($count_time < 60) AND ($count_time > 10):
                    return "осталось минута";
                    break;
                default:
                    return "срок истек";
                    break;
            }
        }
    }
}

# Проверить статуса "бизнес"
function is_tariff($user_id){
    $sql = "SELECT (UNIX_TIMESTAMP(p.deadline) - UNIX_TIMESTAMP(CURRENT_TIMESTAMP)) AS count_time FROM user_pay_tariff p WHERE id_user='$user_id'";
    $result = DB::select($sql);
    if($result){
        $count_time = $result[0]->count_time;
        if($count_time > 0){
            return true;
        }else{
            return false;
        }
    }
}

# Определить срок тарифа Бизнес
function get_deadline_tariff($user_id){
    $result = DB::select("SELECT UNIX_TIMESTAMP(deadline) AS dd FROM user_pay_tariff WHERE id_user='$user_id'");
    
    return $result[0]->dd;
}

# Посчитать кол-во оставших дней промокодов
function promo_count_day($date){
    $sql = "SELECT (TO_DAYS('$date') - TO_DAYS(CURRENT_TIMESTAMP)) AS count_day";
    $result = DB::select($sql);
    $count_day = $result[0]->count_day;
    if ($count_day) {
        switch ($count_day) {
            case $count_day > 4:
                return $count_day . " дней";
                break;
            case ($count_day < 5) AND ($count_day > 1):
                return $count_day . " дня";
                break;
            case $count_day == 1:
                return $count_day . " день";
                break;
        }
    }
}
# OptPrice - по ид партнера получить его логотип
function getOptPartnerLogo($id_partner){
    $result = OptPartner::find($id_partner);
    return $result->logo;
}
# По ид партнера получить данные партнера по оптпрайсу
function getOptPartnerData($id_partner){
    $result = OptPartner::find($id_partner);
    return $result;
}
# посчитает кол-во задание по категориям
function count_certs_main_cat($id){
    $mk_date = time();
    $sql = "SELECT id FROM certs WHERE category_id= '$id' AND date_end > '$mk_date'";
    $result = DB::select($sql);
    return count($result);
}
# проверка урл
function request_uri($url){
    $pattern = '/'.$url.'/i';
    $request_uri = $_SERVER['REQUEST_URI'];
    $result = preg_match($pattern, $request_uri);
    if($result){
        return true;
    }
}
# Получить по ид пользователя получить его данные
function getUser($id){
    $user = User::find($id);
    return $user->firstname." ".$user->lastname;
}
#
function getTaskDetails($id){
    $details = DB::select("SELECT * FROM task_details WHERE id_task='$id'");
    return $details;
}
//Подключаем смс
function sendSms($sms_phone, $sms_message) {
    $SMS_LOGIN = 'Likemoney';
    $SMS_PASS  = '!Q@W#E';
    $data = 'login=' . urlencode($SMS_LOGIN) . '&psw=' . urlencode($SMS_PASS) . '&phones=' . urlencode($sms_phone) . '&mes=' . urlencode($sms_message);
    $url = 'http://smsc.kz/sys/send.php?' . $data;
    $fp = @fsockopen("212.24.33.196", 80, $errno, $errstr, 30);
    if ($fp) {
        $request = "GET /sys/send.php?$data HTTP/1.1\r\n";
        $request .= "Host: smsc.kz\r\n";
        $request .= "Connection: Close\r\n\r\n";
        fwrite($fp, $request);
        while (!feof($fp))
            fgets($fp, 1024);
        fclose($fp);
    }
}
//
function getCountTaskCommit($id_work){
    $result = DB::select("SELECT * FROM task_work_commits WHERE id_work='$id_work' AND new='1'");
    return count($result);
}
function getCountTaskCommitNew($id_work){
    $result = DB::select("SELECT * FROM task_work_commits WHERE id_work='$id_work' AND new='0'");
    return count($result);
}
# количество выполненных работ
function getCountDoneWork(){
    $result = DB::select("SELECT * FROM task_works WHERE status='1'");
    return count($result);
}
# количество выполненных работ определенного партнера
function getCountDoneWorkPartner($id){
    $result = DB::select("SELECT * FROM task_works TW WHERE TW.status='1' AND TW.id_task IN(SELECT TT.id FROM tasks TT WHERE TT.id_partner='$id')");
    return count($result);
}
# количество испольнителей в таск проекте
function getCountWorkUser(){
    $result = DB::select("SELECT * FROM task_works GROUP BY id_user");
    return count($result);
}
# количество испольнителей в таск проекте определенного задании партнера
function getCountWorkUserPartner(){
    $result = DB::select("SELECT * FROM task_works GROUP BY id_user");
    return count($result);
}
# посчитать общую сумму заработанных в проекте ТАСК
function getAllSumTask(){
    $result = DB::select("SELECT SUM(amount) AS summ FROM user_fm_history WHERE is_task='1'");
    if($result[0]->summ){
        $sum = $result[0]->summ;
        $str_len = strlen($sum);
        switch ($sum){
            case ($str_len == 4):
                return substr_replace($sum,' ',1,0); // 1000
                break;
            case ($str_len == 5):
                return substr_replace($sum,' ',2,0); // 12 000
                break;
            case ($str_len == 6):
                return substr_replace($sum,' ',3,0); // 120 000
                break;
            case ($str_len == 7):
                $str = substr_replace($sum,' ',1,0); // 1 230430
                return substr_replace($str,' ',5,0); // 1 230 430
                break;
            case ($str_len == 8):
                $str = substr_replace($sum,' ',2,0); // 12 304300
                return substr_replace($str,' ',6,0); // 12 304 300
                break;
        }
    }
    return 0;
}
// 
function getCountAllTask(){
    return count(Task::all());
}
# Функция для генерации случайной строки
function generateCode($length = 6) {
    $chars = "ABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}
# посчитать количество испольнителей которые получили подарки
function getCountTaskGift(){
    $result = DB::select("SELECT * FROM task_gift_history");
    return count($result);
}
# по ид партнера получить его данные
function getPartner($id){
    $partner = \App\Partner::find($id);
    return $partner;
}
# получить по ид пользователя его данные
function getUserData($id){
    $user = User::find($id);
    return $user;
}
# По ролу пользователя скрыть некоторые модули
function check_admin_users_role($role){
    if($role == 4){
        return true;
    }
}
# По ип адреса получить идентификатор
function get_id_wrapping($ip){
    $result = CertView::where('ip','=',$ip)->get();
    return $result[0]->id;
}
# распечатка массива
function print_array($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}
# проверить по номер карты его существование в базе
function check_card_by_number($card_number){
    $result = DB::select("SELECT * FROM cards WHERE code='$card_number'");
    if(count($result) == 1){
        return $result;
    }
}
### PAYBOX ###
function get_post_return_array($action, $data) {
    $ch = curl_init($action);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
    $json = json_encode($xml);
    $array = json_decode($json, TRUE);

    return $array;
}
### PAYBOX ###
# проверить у пользователя есть ли картинка
function check_user_store_img($id_user){
    $result = DB::table('business_store')->where(['id_user' => $id_user])->first();
    if($result){
        if(!empty($result->store_img)){
            return $result->store_img;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
# проверить у пользователя какой тариф магазина
function check_user_store_tarif($id_user){
    $result = DB::table('business_store')->where(['id_user' => $id_user])->first();
    if($result){
        $tarif = $result->tarif;
        return $tarif;
    }else{
        return false;
    }
}
# по ид пользователя получить название магазина
function get_user_store_name($id_user){
    $result = DB::table('business_store')->where(['id_user' => $id_user])->first();
    if($result){
        return $result->store_name.".likemoney.me";
    }
}
# переобразовать дата
function russian_date($date){
    $date = explode(".", $date);
    switch ($date[1]){
        case 1: $m = 'января'; break;
        case 2: $m = 'февраля'; break;
        case 3: $m = 'марта'; break;
        case 4: $m = 'апреля'; break;
        case 5: $m = 'мая'; break;
        case 6: $m = 'июня'; break;
        case 7: $m = 'июля'; break;
        case 8: $m = 'августа'; break;
        case 9: $m = 'сентября'; break;
        case 10: $m = 'октября'; break;
        case 11: $m = 'ноября'; break;
        case 12: $m = 'декабря'; break;
    }
    return $date[0]." ".$m." ".$date[2];
}
#
function check_pod_cat($id, $lvl){
    if($id != 0){
        $count_query = 0;
        $result1 = DB::table('cats')->where(['id' => $id])->where('parent', '!=', 0)->first();
        if($result1){
            $count_query += 1;
            $result2 = DB::table('cats')->where(['id' => $result1->parent])->where('parent', '!=', 0)->first();
            if($result2){
                $count_query += 1;
                $result3 = DB::table('cats')->where(['id' => $result2->parent])->where('parent', '!=', 0)->first();
                if($result3){
                    $count_query += 1;
                    $result4 = DB::table('cats')->where(['id' => $result3->parent])->where('parent', '!=', 0)->first();
                    if($result4){
                        $count_query += 1;
                    }
                }
            }
        }
        switch($lvl){
            case 1:
                if($count_query == 1){
                    return $result1->title;
                }
                if($count_query == 2){
                    return $result2->title;
                }
                if($count_query == 3){
                    return $result3->title;
                }
                break;
            case 2:
                if($count_query == 2){
                    return $result1->title;
                }
                if($count_query == 3){
                    return $result2->title;
                }
                break;
            case 3:
                if($count_query == 3){
                    return $result1->title;
                }
                break;
        }
    }
}
function getUserIdByStoreName($store_name){
    $result = DB::table('business_store')->where(['store_name' => $store_name, 'status' => 1])->first();
    return $result;
}
// для определенных пользователей показывать доп. информации о поставщика
function show_add_info_about_cert($id_cert, $id_user){
    $users = [
        15 => 'Алижан'
    ];
    if(array_key_exists($id_user,$users)){

    }

}
// сделок за день
function count_order_today(){
    $result = DB::select("SELECT COUNT(*) AS cnt FROM business_orders BO WHERE BO.status='3' AND DATE_FORMAT(BO.updated_at,'%d-%m-%Y')=DATE_FORMAT(NOW(),'%d-%m-%Y');");
    return $result[0]->cnt;
}
// самый высокий доход за сегодня
function max_price_today(){
    $result = DB::select("SELECT TB.*,CT.prime_cost FROM
		(SELECT BO.*, (BO.qty*BO.price) AS max_price FROM business_orders BO WHERE BO.status='3' AND DATE_FORMAT(BO.updated_at,'%d-%m-%Y')=DATE_FORMAT(NOW(),'%d-%m-%Y')) AS TB
	LEFT JOIN certs CT ON CT.id=TB.id_cert
ORDER BY TB.max_price DESC LIMIT 1;");
    if($result){
        $sum = ($result[0]->max_price - $result[0]->prime_cost)*0.3;
        return $sum;
    }else{
        return 0;
    }

}
// определяет роль у пользователя
function check_user_roles($user_id){
    $result = DB::select("SELECT * FROM users_roles WHERE user_id=$user_id");
    if($result){
        if($result[0]->role_id == 1){
            return 0; // admin
        }
        if($result[0]->role_id == 2){
            return 1; // operator
        }
    }else{
        return false;
    }
}