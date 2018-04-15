<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function index(){
        return view('search');
    }

    public function search(Request $request){
        $keywords = $request->get('keywords');
        $search_certs = DB::select("SELECT * FROM ((SELECT CT.id,CT.title,CT.image,CT.prime_cost,CT.special2,CT.special3,CT.article_code FROM certs CT 
                        WHERE CT.conditions<>'' AND CT.image<>'' AND CT.title LIKE '%$keywords%')
                        UNION
        (SELECT CT.id,CT.title,CT.image,CT.prime_cost,CT.special2,CT.special3,CT.article_code FROM certs CT WHERE CT.conditions<>'' AND CT.image<>'' AND CT.article_code LIKE '%$keywords%')) A;");
        return view('search', compact('search_certs','keywords'));
    }
}
