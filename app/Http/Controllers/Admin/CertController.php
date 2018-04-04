<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cert;
use App\Category;
use App\Partner;
use Illuminate\Support\Facades\DB;
use App\SimpleImage;
use Intervention\Image\Facades\Image as Image;
use App\Supplier;

class CertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certs = Cert::getNotWhere();
        return view('admin/cert/cert-index', compact('certs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Category::get();
        $partner = Partner::all();
        $pod_cat = DB::select("SELECT * FROM pod_cat");
        $cats = DB::table('cats')->where(['parent' => 0])->get();
        return view('admin/cert/cert-create', compact('cat','partner','pod_cat', 'cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = [
            'title' => $request->input('title'), 'category_id' => $request->input('id_main_cat'),
            'pod_cat' => $request->input('id_pod_cat'), 'conditions' => $request->input('conditions'),
            'description' => $request->input('description'), 'features' => $request->input('features'),
            /*'special1' => $request->input('special1'),*/ 'special2' => $request->input('special2'),
            'special3' => $request->input('special3'), 'special4' => $request->input('special4'),
            'old_price' => $request->input('old_price'), 'economy' => $request->input('economy'),
            'image' => $request->input('photo1'), 'image2' => $request->input('photo2'),
            'image3' => $request->input('photo3'),
            'partner_id' => $request->input('id_partner'),
            /*'date_start' => strtotime($request->input('date_start')),'date_end' => strtotime($request->input('date_end')),*/
            'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'), 'sort' => $request->input('sort'),
            'cert_type' => $request->input('cert_type'), 'article_code' => $request->input('article_code'),
            'b1' => $request->input('b1'), 'b2' => $request->input('b2'), 'b3' => $request->input('b3'),
            'prime_cost' => $request->input('prime_cost'), 'count' => $request->input('count'),
            'section_type' => $request->input('section_type'), 'label_type' => $request->input('label_type')
        ];
        if(!empty($data['image'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$data['image'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/'.$data['image'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
        }
        if(!empty($data['image2'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image2'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$data['image2'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/'.$data['image2'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
        }
        if(!empty($data['image3'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image3'];
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$data['image3'];
            $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/'.$data['image3'];

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
            $img->save($to);
            $img->adaptive_resize(227, 140);
            $img->save($to_mini);
            unlink($from);
        }
        $lastInsertId = Cert::create($data)->id;
		$count = $request->input('cnt');
        if ($count >= 1 AND !empty($request->get('from1')) AND !empty($request->get('to1'))) {
			for ($i = 1; $i <= $count; $i++) {
				$from = $request->get('from' . $i);
				$to   = $request->get('to' . $i);
				$sum   = $request->get('sum' . $i);
				$current_time = date("Y-m-d H:i:s");
				DB::insert("INSERT INTO cert_opt (id_cert,nach,kon,summa,created_at) VALUES('$lastInsertId','$from','$to', '$sum', '$current_time')");
			}
        }
        
        return redirect('admin/certs')->with('message', "Задания успешно добавлен");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cert = Cert::findOrFail($id);
        $cat = Category::get();
        $partner = Partner::all();
        $pod_cat = DB::select("SELECT * FROM pod_cat");
        $cats = DB::table('cats')->where(['parent' => 0])->get();
        $opt = DB::table('cert_opt')->where(['id_cert' => $id])->get();
        //$suppliers = Supplier::all();
        $suppliers = Partner::all();
        $best_prices = DB::table('best_price')->where(['id_cert' => $id])->get();
        return view('admin/cert/cert-show', compact('cert', 'cat', 'partner', 'pod_cat', 'cats', 'opt', 'suppliers', 'best_prices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data = [
            'title' => $request->input('title'), 'category_id' => $request->input('id_main_cat'),
            'pod_cat' => $request->input('id_pod_cat'), 'conditions' => $request->input('conditions'),
            'description' => $request->input('description'), 'features' => $request->input('features'),
            /*'special1' => $request->input('special1'),*/ 'special2' => $request->input('special2'),
            'special3' => $request->input('special3'), 'special4' => $request->input('special4'),
            'old_price' => $request->input('old_price'), 'economy' => $request->input('economy'),
            'image' => $request->input('photo1'), 'image2' => $request->input('photo2'),
            'image3' => $request->input('photo3'),
            'partner_id' => $request->input('id_partner'),
            /*'date_start' => strtotime($request->input('date_start')),'date_end' => strtotime($request->input('date_end')),*/
            'meta_description' => $request->input('meta_description'),
            'meta_keywords' => $request->input('meta_keywords'), 'sort' => $request->input('sort'),
            'cert_type' => $request->input('cert_type'), 'article_code' => $request->input('article_code'),
            'b1' => $request->input('b1'), 'b2' => $request->input('b2'), 'b3' => $request->input('b3'),
            'prime_cost' => $request->input('prime_cost'), 'count' => $request->input('count'),
            'section_type' => $request->input('section_type'), 'label_type' => $request->input('label_type')
        ];

        if(!empty($data['image'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image'];
            if(file_exists($from)){
                $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$data['image'];
                $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/'.$data['image'];

                // Вызываем класс
                $img = new SimpleImage();
                $img->load($from);
                $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
                $img->save($to);
                $img->adaptive_resize(227, 140);
                $img->save($to_mini);
                unlink($from);
            }
        }
        if(!empty($data['image2'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image2'];
            if(file_exists($from)){
                $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$data['image2'];
                $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/'.$data['image2'];

                // Вызываем класс
                $img = new SimpleImage();
                $img->load($from);
                $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
                $img->save($to);
                $img->adaptive_resize(227, 140);
                $img->save($to_mini);
                unlink($from);
            }
        }
        if(!empty($data['image3'])){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['image3'];
            if(file_exists($from)){
                $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/'.$data['image3'];
                $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/'.$data['image3'];

                // Вызываем класс
                $img = new SimpleImage();
                $img->load($from);
                $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
                $img->save($to);
                $img->adaptive_resize(227, 140);
                $img->save($to_mini);
                unlink($from);
            }

        }
        $cert = Cert::find($id);
        $cert->update($data);
		$count = $request->input('cnt');
        
		if($count != 0){
            for ($i = 1; $i <= $count; $i++) {
                $from = $request->get('from' . $i);
                $to   = $request->get('to' . $i);
                $sum   = $request->get('sum' . $i);
                $current_time = date("Y-m-d H:i:s");
                DB::insert("INSERT INTO cert_opt (id_cert,nach,kon,summa,created_at) VALUES('$id','$from','$to', '$sum', '$current_time')");
            }
        }

        if(isset($_SESSION['opt'])){
            unset($_SESSION['opt']['is']);
            for($i = 0; $i<count($_SESSION['opt']); $i++){
                $n = $_SESSION['opt'][$i];
                $from = $request->get('from' . $n);
                $to   = $request->get('to' . $n);
                $sum   = $request->get('sum' . $n);
                DB::update("UPDATE cert_opt SET nach='$from', kon='$to', summa='$sum' WHERE id='$n'");
            }
        }

        return redirect('admin/certs')->with('message', 'Задания успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cert = Cert::find($id);
        $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/';
        $path_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/certs/small/';
        if(!empty($cert->image)){
            if(file_exists($path.$cert->image)){
                $image = $path.$cert->image;
                unlink($image);
            }
            if(file_exists($path_mini.$cert->image)){
                $image_m = $path_mini.$cert->image;
                unlink($image_m);
            }
        }
        if(!empty($cert->image2)){
            if(file_exists($path.$cert->image2)){
                $image2 = $path.$cert->image2;
                unlink($image2);
            }
            if(file_exists($path_mini.$cert->image2)){
                $image2_m = $path_mini.$cert->image2;
                unlink($image2_m);
            }
        }
        if(!empty($cert->image3)){
            if(file_exists($path.$cert->image3)){
                $image3 = $path.$cert->image3;
                unlink($image3);
            }
            if(file_exists($path_mini.$cert->image3)){
                $image3_m = $path_mini.$cert->image3;
                unlink($image3_m);
            }
        }
        Cert::destroy($id);
        return redirect()->back()->with('message', 'Задания удален успешно');
    }

    # получить список под категории
    public function get_cats($id_cat){
        $result = DB::table('cats')->where(['parent' => $id_cat])->get();
        return json_encode($result);
    }

    public function delete_opt($id){
        if(isset($_SESSION['opt'][$id])){
            unset($_SESSION['opt'][$id]);
        }
        DB::table('cert_opt')->where('id', '=', $id)->delete();
        return 0;
    }

    public function search($title){
        $result = DB::select("SELECT * FROM certs WHERE title LIKE '%$title%'");
        return json_encode($result);
    }

    public function unprocessed(){
        $certs = DB::table('certs')->whereNull('features')->whereNull('image')->orderBy("id", 'DESC')->paginate(30);
        return view('admin/cert/unprocessed', compact('certs'));
    }

    // получить список поставщиков из таблицу suppliers
    public function supp(){
        //$result = Supplier::all();
        $result = Partner::all();
        return json_encode($result);
    }

    public function supp_settings(Request $request, $id_cert){
        $data = $request->all();
        $count = $data['cnt_supp'];
        $price = [];
        if($count != 0){
            for ($i = 1; $i <= $count; $i++) {
                $price_supp = (int) $data['price_supp'.$i];
                $id_supp   = (int) $data['supp'.$i];
                $current_time = date("Y-m-d H:i:s");
                $price[] = $price_supp;
				$result = DB::select("SELECT * FROM best_price WHERE id_cert=$id_cert AND id_supp=$id_supp");
				if($result){
					DB::update("UPDATE best_price SET price_supp=$price_supp WHERE id_cert=$id_cert AND id_supp=$id_supp");
				}else{
					DB::insert("INSERT INTO best_price (id_cert,id_supp,price_supp,created_at) VALUES('$id_cert','$id_supp','$price_supp', '$current_time')");	
				}
            }
            $cert = Cert::find($id_cert);
            $min_price_sup = min($price); // самые минимальные цены best_price
            $cert_prime_cost = $cert->prime_cost; // себестоимость товара
            if($cert_prime_cost > $min_price_sup){
                $price_difference = $cert_prime_cost - $min_price_sup;
                $new_special2 = (int) $cert->special2 - $price_difference;
                $cert->update([
                    'prime_cost' => $min_price_sup, 'special2' => $new_special2, 'is_best_price' => 1
                ]);
            }

            return redirect('admin/certs')->with('message', 'BestPrice успешно сохранен');
        }
    }

    public function best_price(){
        $best_prices = DB::select("SELECT CT.id, CT.title,MIN(BP.price_supp) AS min_price,SP.name AS com_title,SP.address,SP.mphone,SP.email,BP.created_at FROM best_price BP
                                    INNER JOIN certs CT ON CT.id=BP.id_cert
                                    INNER JOIN partners SP ON SP.id=BP.id_supp
                                    GROUP BY BP.id_cert");
        return view('admin/best_price', compact('best_prices'));
    }
}
