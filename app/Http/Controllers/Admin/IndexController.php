<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;
use SSH;

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
        $store = DB::table('business_store')->where(['id' => $id])->first();
        $name = $store->store_name;
        $filename = $name.'.likemoney.me';
        $file = "<VirtualHost 127.0.0.1:8080>\r\n";
        $file .= "      ServerName $name.likemoney.me\r\n";
        $file .= "      AddDefaultCharset UTF-8\r\n";
        $file .= "      AssignUserID admin admin\r\n";
        $file .= "      DirectoryIndex index.html index.php\r\n";
        $file .= "      DocumentRoot /var/www/admin/data/www/asay.likemoney.me/\r\n";
        $file .= "      ServerAdmin webmaster@asay.likemoney.me\r\n";
        $file .= "      ServerAlias www.$name.likemoney.me\r\n";
        $file .= "<FilesMatch \'\.ph(p[3-5]?|tml)$\'>"."\r\n";
        $file .= "      SetHandler application/x-httpd-php\r\n";
        $file .= "</FilesMatch>\r\n";
        $file .= "<FilesMatch \"\.phps$\">\r\n";
        $file .= "      SetHandler application/x-httpd-php-source\r\n";
        $file .= "</FilesMatch>\r\n";
        $file .= "      php_admin_value sendmail_path \"/usr/sbin/sendmail -t -i -f webmaster@asay.likemoney.me\"\r\n";
        $file .= "      php_admin_value upload_tmp_dir \"/var/www/admin/data/mod-tmp\"\r\n";
        $file .= "      php_admin_value session.save_path \"/var/www/admin/data/mod-tmp\"\r\n";
        $file .= "      php_admin_value open_basedir \"/var/www/admin/data:.\"\r\n";
        $file .= "      CustomLog /var/www/httpd-logs/asay.likemoney.me.access.log combined\r\n";
        $file .= "      ErrorLog /var/www/httpd-logs/asay.likemoney.me.error.log\r\n";
        $file .= "</VirtualHost>\r\n";
        $file .= "<Directory /var/www/admin/data/www/asay.likemoney.me>\r\n";
        $file .= "      php_admin_flag engine on\r\n";
        $file .= "      Options -ExecCGI\r\n";
        $file .= "</Directory>\r\n";
        SSH::run([
            'cd /var/www/admin/data/www/likemoney.me/public',
            "touch $filename",
            "chmod 777 $filename"
        ]);
        $path = '/var/www/admin/data/www/likemoney.me/public/'.$filename;
        $fp = fopen($path, "a"); // Открываем файл в режиме записи
        $mytext = "Это строку необходимо нам записать\r\n"; // Исходная строка
        $test = fwrite($fp, $file);
        fclose($fp);
        SSH::run([
            "mv /var/www/admin/data/www/likemoney.me/public/$filename /etc/httpd/conf/vhosts/admin/$filename",
            '/bin/systemctl restart httpd.service'
        ]);
        $store->status = '1';
        $store->save();
        return redirect()->back()->with('message', 'Успешно обработан');
    }
}
