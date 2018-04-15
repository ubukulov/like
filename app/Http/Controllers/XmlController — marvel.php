<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Excel5;

class XmlController extends Controller
{
	
    public function create(){
        return view('xml');
    }

    public function execute(){
        $file_name = $_FILES['file']['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($file_name);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $current_date = date("Y-m-d H:i:s");
        $xml = "<?xml version='1.0' encoding='UTF-8'?><yml_catalog date='$current_date'>";
        $xml .= '
        <shop>
            <name>Likemoney.me</name>
            <company>Likemoney LLC</company>
            <url>likemoney.me</url>
            <currencies>
                <currency id="USD" rate="1"/>
            </currencies>
            <categories>
                <category id="1" parentId="0">Ноутбуки</category>
                <category id="2" parentId="0">Планшетные компьютеры</category>
                <category id="3" parentId="0">Моноблоки</category>
                <category id="4" parentId="0">ПК</category>
                <category id="5" parentId="0">Мониторы</category>
                <category id="6" parentId="0">Профессиональные панели</category>
                <category id="7" parentId="0">МФУ и принтеры</category>
                <category id="8" parentId="0">Сканеры</category>
                <category id="9" parentId="0">Цифровые копиры</category>
                <category id="10" parentId="0">Плоттеры</category>
                <category id="11" parentId="0">Опции для оргтехники</category>
                <category id="12" parentId="0">Расходные материалы для оргтехники</category>
                <category id="13" parentId="0">Клавиатуры, мыши, джойстики</category>
                <category id="14" parentId="0">Гарнитуры для ПК</category>
                <category id="15" parentId="0">Процессоры</category>
                <category id="16" parentId="0">Материнские платы</category>
                <category id="17" parentId="0">Видеокарты</category>
                <category id="18" parentId="0">Оперативная память</category>
                <category id="19" parentId="0">Жесткие диски и SSD</category>
                <category id="20" parentId="0">Опции для ПК</category>
                <category id="21" parentId="0">Внешние жесткие диски и SSD</category>
                <category id="22" parentId="0">Карты памяти</category>
                <category id="23" parentId="0">Смартфоны</category>
                <category id="24" parentId="0">Акустические системы Hi-Fi</category>
                <category id="25" parentId="0">Аксессуары</category>
                <category id="26" parentId="0">Аксессуары для продукции Apple</category>
                <category id="27" parentId="0">Аксессуары для ноутбуков</category>
                <category id="28" parentId="0">Аксессуары для смартфонов и планшетов</category>
                <category id="29" parentId="0">Портативная акустика, наушники и гарнитуры</category>
                <category id="30" parentId="0">Серверы</category>
                <category id="31" parentId="0">Опции</category>
                <category id="32" parentId="0">ИБП</category>
                <category id="33" parentId="0">Сетевые фильтры и стабилизаторы</category>
                <category id="34" parentId="0">Кондиционеры</category>
                <category id="35" parentId="0">Активное сетевое оборудование для дома и малого офиса</category>
                <category id="36" parentId="0">Пассивное сетевое оборудование</category>
                <category id="37" parentId="0">Телефония</category>
                <category id="38" parentId="0">Видеоконференцсвязь</category>
                <category id="39" parentId="0">Операционные системы</category>
                <category id="40" parentId="0">Приложения</category>
            </categories>
            <offers>
        ';

        for($i = 2; $i<count($sheetData); $i++) {
            $title = $sheetData[$i]['D'];
			//$title=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $title);
            //$price = (int)$sheetData[$i]['J'];
            $article_code = $sheetData[$i]['C'];
            //$cat_id = (int)$sheetData[$i]['I'];
            $vendor = $sheetData[$i]['B'];
            $cat = $sheetData[$i]['G'];
            $xml .= "<offer id='$i'  type='vendor.model' available='true'>";
			//$xml .= "<price>$price</price>";
            //$xml .= "<currencyId>USD</currencyId>";
            $xml .= "<categoryId>$cat</categoryId>";
            $xml .= "<vendor>$vendor</vendor>";
            $xml .= "<vendorCode>$article_code</vendorCode>";
            $xml .= "<model>$title</model>";
            $xml .= "</offer>";
        }
        $xml .= '</offers>
                </shop>
                </yml_catalog>';
        $path = $_SERVER['DOCUMENT_ROOT'] . '/xml_files/';
        $xml_file = md5(time()) . '.xml';
        $destination = $path.$xml_file;
        $my_file = fopen($destination, "w") or die("Unable to open file!");
        fwrite($my_file, $xml);
        fclose($my_file);
        header("Location: /xml_files/".$xml_file);
        exit();
    }
}
