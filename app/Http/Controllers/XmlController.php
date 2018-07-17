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
                <category id="1" parentId="0">1-прайс</category>
                <category id="2" parentId="0">2-прайс</category>
                <category id="3" parentId="0">3-прайс</category>
                <category id="4" parentId="0">4-прайс</category>
                <category id="5" parentId="0">5-прайс</category>
                <category id="6" parentId="0">6-прайс</category>
            </categories>
            <offers>
        ';
		
        for($i = 2; $i<count($sheetData); $i++) {
            $title = $sheetData[$i]['B'];
			//$title=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $title);
            //$price = (int)$sheetData[$i]['J'];
            $article_code = $sheetData[$i]['A'];
            //$cat_id = (int)$sheetData[$i]['I'];
            $vendor = $sheetData[$i]['C'];
            //$cat = $sheetData[$i]['G'];
		
            $xml .= "<offer id='$i'  type='vendor.model' available='true'>";
			//$xml .= "<price>$price</price>";
            //$xml .= "<currencyId>USD</currencyId>";
	    if($i < 500){
		$xml .= "<categoryId>1</categoryId>";
	    }
	    if($i >= 500){
		$xml .= "<categoryId>2</categoryId>";
	    }
 	    if($i >= 1000){
		$xml .= "<categoryId>3</categoryId>";
	    }
	    if($i >= 1500){
		$xml .= "<categoryId>4</categoryId>";	
	    }
            if($i >= 2000){
		$xml .= "<categoryId>5</categoryId>";
	    }
	    if($i >= 2500){
		$xml .= "<categoryId>6</categoryId>";
	    }	
            
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
		
		/*
	
		for($i = 2; $i<count($sheetData); $i++) {
            $article_code = $sheetData[$i]['B'];
            $title = $sheetData[$i]['A'];
            $price_company = $sheetData[$i]['D'];
	    //$manufacturer = $sheetData[$i]['D'];
	        $partner_id = 576;
            //$prime_cost = $sheetData[$i]['E'];
	    //$conditions = $sheetData[$i]['D'];
            //$opt_price1 = $sheetData[$i]['E'];
            //$opt_price2 = $sheetData[$i]['G'];
            //$opt_price3 = $sheetData[$i]['I'];
            //$opt_count1 = $sheetData[$i]['D'];
            //$opt_count2 = $sheetData[$i]['F'];
            //$opt_count3 = $sheetData[$i]['H'];
			// обновление всех цен			
			/*
			DB::update("UPDATE certs SET special2='$special2', prime_cost='$prime_cost', opt_price1='$opt_price1', opt_price2='$opt_price2',
                        opt_price3='$opt_price3', opt_count1='$opt_count1', opt_count2='$opt_count2', opt_count3='$opt_count3'
                        WHERE article_code='$article_code' AND price_company='ТехноГрад'"); 
			// обновление только себестоимость */
			//DB::update("UPDATE certs SET cert_type='2', partner_id='$partner_id' WHERE article_code='$article_code' AND price_company='Главрыба'");
        //}
	//echo "Успешно!"; 
    }
}
