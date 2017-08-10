<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cert extends Model
{
    protected $fillable = [
        'id', 'title', 'category_id', 'pod_cat', 'conditions', 'description', 'features', 'special1', 'special2',
        'special3', 'special4', 'old_price', 'economy', 'image', 'image2', 'image3', 'purchased', 'partner_id',
        'partner', 'partner_email', 'partner_address', 'partner_hours', 'partner_phone', 'date_start', 'date_end',
        'periodicity', 'period_start', 'period_end', 'period_count', 'coords', 'zoom', 'meta_description',
        'meta_keywords', 'sort', 'views', 'cert_type', 'created_at', 'updated_at'
    ];

    # Получить список задании по условии срока
    public static function get(){
        $mk_date = time();
        $result = DB::select("SELECT * FROM certs WHERE date_end > '$mk_date' ORDER BY sort,id DESC");
        return $result;
    }

    # Получить список задании без условия
    public static function getNotWhere(){
        $result = DB::table('certs')->orderBy("id", 'DESC')->paginate(30);
        return $result;
    }
    
    # Получить данные по ид
    public static function getByIdCertData($id){
        $cert = Cert::find($id);
        return $cert;
    }

    # Получить список задании определенного партнера
    public static function getCertOfPartner($id_partner){
        $result = DB::table('certs')->where(['partner_id' => $id_partner])->paginate(10);
        return $result;
    }
    
    # Посчитать кол-во задании партнера
    public static function countCertOfPartner($id_partner){
        return count(Cert::where(['partner_id' => $id_partner])->get());
    }
}
