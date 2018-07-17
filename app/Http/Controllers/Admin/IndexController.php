<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;
use SSH;
use PHPExcel_IOFactory;
use App\Partner;

class IndexController extends Controller
{
    
    public function index(){
        return view('admin/index');
    }

    # Бизнес
    public function business(){
        $withdraw = DB::table('business_store')->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin/business', compact('withdraw'));
    }

    public function up($id){
//        $store = DB::table('business_store')->where(['id' => $id])->first();
//        $name = $store->store_name;
//        $filename = $name.'.likemoney.me';
//        $file = "<VirtualHost 127.0.0.1:8080>\r\n";
//        $file .= "      ServerName $name.likemoney.me\r\n";
//        $file .= "      AddDefaultCharset UTF-8\r\n";
//        $file .= "      AssignUserID admin admin\r\n";
//        $file .= "      DirectoryIndex index.html index.php\r\n";
//        $file .= "      DocumentRoot /var/www/admin/data/www/asay.likemoney.me/\r\n";
//        $file .= "      ServerAdmin webmaster@asay.likemoney.me\r\n";
//        $file .= "      ServerAlias www.$name.likemoney.me\r\n";
//        $file .= "<FilesMatch \'\.ph(p[3-5]?|tml)$\'>"."\r\n";
//        $file .= "      SetHandler application/x-httpd-php\r\n";
//        $file .= "</FilesMatch>\r\n";
//        $file .= "<FilesMatch \"\.phps$\">\r\n";
//        $file .= "      SetHandler application/x-httpd-php-source\r\n";
//        $file .= "</FilesMatch>\r\n";
//        $file .= "      php_admin_value sendmail_path \"/usr/sbin/sendmail -t -i -f webmaster@asay.likemoney.me\"\r\n";
//        $file .= "      php_admin_value upload_tmp_dir \"/var/www/admin/data/mod-tmp\"\r\n";
//        $file .= "      php_admin_value session.save_path \"/var/www/admin/data/mod-tmp\"\r\n";
//        $file .= "      php_admin_value open_basedir \"/var/www/admin/data:.\"\r\n";
//        $file .= "      CustomLog /var/www/httpd-logs/asay.likemoney.me.access.log combined\r\n";
//        $file .= "      ErrorLog /var/www/httpd-logs/asay.likemoney.me.error.log\r\n";
//        $file .= "</VirtualHost>\r\n";
//        $file .= "<Directory /var/www/admin/data/www/asay.likemoney.me>\r\n";
//        $file .= "      php_admin_flag engine on\r\n";
//        $file .= "      Options -ExecCGI\r\n";
//        $file .= "</Directory>\r\n";
//        SSH::run([
//            'cd /var/www/admin/data/www/likemoney.me/public',
//            "touch $filename",
//            "chmod 777 $filename"
//        ]);
//        $path = '/var/www/admin/data/www/likemoney.me/public/'.$filename;
//        $fp = fopen($path, "a"); // Открываем файл в режиме записи
//        $mytext = "Это строку необходимо нам записать\r\n"; // Исходная строка
//        $test = fwrite($fp, $file);
//        fclose($fp);
//        SSH::run([
//            "mv /var/www/admin/data/www/likemoney.me/public/$filename /etc/httpd/conf/vhosts/admin/$filename",
//            '/bin/systemctl restart httpd.service'
//        ]);
        DB::update("UPDATE business_store SET status='1' WHERE id='$id'");
        return redirect()->back()->with('message', 'Успешно обработан');
    }

    # отменить одобрение заявки
    public function down($id){
        DB::update("UPDATE business_store SET status='2' WHERE id='$id'");
        return redirect()->back()->with('message', 'Заявка на открытие магазина успешно отменен!');
    }

    # Предложение
    public function suggest($id = 0){
        if($id != 0){
            DB::update("UPDATE suggests SET status='1' WHERE id='$id'");
            return redirect()->back()->with('message', 'Предложение закрыт!');
        }else{
            $suggests = DB::table('suggests')->orderBy('id', 'DESC')->paginate(20);
            return view('admin/suggest', compact('suggests'));
        }
    }

    # Купить в 1 клик
    public function buy_one_click($id = 0){
        if($id != 0){
            DB::update("UPDATE buy_1_click SET status='1' WHERE id='$id'");
            return redirect()->back()->with('message', 'Заявка закрыт!');
        }else{
            $clicks = DB::table('buy_1_click')
                ->join('certs', 'certs.id', '=', 'buy_1_click.id_item')
                ->select('buy_1_click.*', 'certs.title', 'certs.image', 'certs.special2', 'certs.id AS cert_id')
                ->orderBy('id', 'DESC')
                ->paginate(20);
            return view('admin/click', compact('clicks'));
        }
    }

    # обновление цены
    public function upgrade_price(){
        $partners = Partner::all();
        return view('admin/upgrade/index', compact('partners'));
    }

    # процесс обновление цены
    public function execute(Request $request){
        $file_name = $_FILES['file']['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($file_name);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $partner_id = $request->input('partner_id');

        for($i = 2; $i<count($sheetData); $i++) {
            $article_code = $sheetData[$i]['A'];
            $title = $sheetData[$i]['B'];
            $manufacturer = $sheetData[$i]['C'];
            $price = (int) $sheetData[$i]['D'];
            $prime_cost = (int) $sheetData[$i]['E'];

//            $opt_price1 = $sheetData[$i]['E'];
//            $opt_price2 = $sheetData[$i]['G'];
//            $opt_price3 = $sheetData[$i]['I'];
//            $opt_count1 = $sheetData[$i]['D'];
//            $opt_count2 = $sheetData[$i]['F'];
//            $opt_count3 = $sheetData[$i]['H'];

            //обновление всех цен
            /*DB::update("UPDATE certs SET prime_cost='$prime_cost', opt_price1='$opt_price1', opt_price2='$opt_price2',
                        opt_price3='$opt_price3', opt_count1='$opt_count1', opt_count2='$opt_count2', opt_count3='$opt_count3'
                        WHERE article_code='$article_code' AND price_company='ТехноГрад'");*/
            // обновление себестоимость и розничную
            DB::update("UPDATE certs SET cert_type='2', partner_id='$partner_id', speacial2='$price', prime_cost='$prime_cost', manufacturer='$manufacturer'
            WHERE article_code='$article_code' AND manufacturer='$manufacturer'");
        }

        return redirect()->back()->with('message', 'Цены успешно обновлены.');
    }
}
