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
# 
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