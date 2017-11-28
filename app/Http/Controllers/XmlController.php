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
        var_dump(extension_loaded ('zip'));
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
                <category id="1" parentId="0">Test</category>
            </categories>
            <offers>
        ';

        for($i = 1; $i<count($sheetData); $i++) {
            $title = $sheetData[$i]['A'];
            $price = (int)$sheetData[$i]['B'];
            $xml .= "<offer id='$i'  type='vendor.model' available='true'>";
			$xml .= "<price>$price</price>";
            $xml .= "<currencyId>USD</currencyId>";
            $xml .= "<categoryId>1</categoryId>";
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
