<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Excel5;
use App\Cert;
use Illuminate\Support\Facades\DB;

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
        /*
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
                <category id="1" parentId="0">Без производителей</category>
                <category id="2" parentId="0">Производителей начинается с А</category>
                <category id="3" parentId="0">Производителей начинается с B,C</category>
                <category id="4" parentId="0">Производителей начинается с D,E</category>
                <category id="5" parentId="0">Производителей начинается с F,G,H</category>
                <category id="6" parentId="0">Производителей начинается с I,J,K,L</category>
                <category id="7" parentId="0">Производителей начинается с M,N,O,P</category>
                <category id="8" parentId="0">Производителей начинается с R,S,T</category>
                <category id="9" parentId="0">Производителей начинается с U,V,W,Z</category>
            </categories>
            <offers>
        ';
		
        for($i = 2; $i<count($sheetData); $i++) {
            $title = $sheetData[$i]['B'];
			//$title=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $title);
            //$price = (int)$sheetData[$i]['J'];
            $article_code = $sheetData[$i]['A'];
            //$cat_id = (int)$sheetData[$i]['I'];
            $vendor = $sheetData[$i]['F'];
            $cat = $sheetData[$i]['J'];
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
        exit();*/
		
		
		for($i = 2; $i<count($sheetData); $i++) {
            $article_code = $sheetData[$i]['A'];
            $special2 = $sheetData[$i]['B'];
			DB::update("UPDATE certs SET special2='$special2' WHERE article_code='$article_code'");
        }
		echo "Успешно!";
    }
}
