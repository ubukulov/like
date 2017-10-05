<?php

namespace App\Http\Controllers\Usr;

use App\Card;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\SimpleImage;

class IndexController extends Controller
{

    protected $id_user;

    public function __construct()
    {
        $this->id_user = Auth::id();
    }

    public function account(){
        Card::setCard($this->id_user);
        return view('user/account');
    }
    
    # Выход из личного кабинета
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    # Форма редактирование профиль пользователя
    public function setting_form(){
        return view('user/settings');
    }
    
    # Сохранение данные о пользователя
    public function setting_save(Request $request){
        $data = $request->all();
        $data['id'] = $this->id_user;
        $user = User::findOrFail($this->id_user);
        $user->update($data);
        return redirect()->back();
    }

    public function balance_history(){
        $balances = DB::table('user_fm_history')->where(['id_user' => $this->id_user])->orderBy('date', 'DESC')->paginate(30);
        $profit_today = User::get_count_sum_agent($this->id_user,1);
        $profit_week  = User::get_count_sum_agent($this->id_user,2);
        $profit_month = User::get_count_sum_agent($this->id_user,3);
        return view('user/balance-history', compact('balances', 'profit_today', 'profit_week', 'profit_month'));
    }

    # снят со счета
    public function withdraw(Request $request){
        $data = $request->all();
        $amount = $data['amount'];
        //$amount_in_commission = $data['amount_in_commission'];
        $lastInsertID = DB::table('user_withdraw_history')->insertGetId([
            'id_user' => $this->id_user, 'amount' => $amount, 'status' => '0', 'created_at' => date("Y-m-d H:i:s")
        ]);

        if($lastInsertID){
            return $lastInsertID;
        }else{
            return 0;
        }
    }

    # тариф бизнес
    public function business(){
        $business_store = DB::table('business_store')->where(['id_user' => $this->id_user])->first();
        return view('user/business', compact('business_store'));
    }

    public function business_set(Request $request){
        $data = $request->all();
        $business_store = DB::table('business_store')->where(['id_user' => $this->id_user])->first();
        if($business_store){
            if(!empty($data['photo1'])){
                $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
                $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/users/store/'.$data['photo1'];
                $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/users/store/'.$data['photo1'];

                // Вызываем класс
                $img = new SimpleImage();
                $img->load($from);
                $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
                $img->save($to);
                $img->adaptive_resize(141, 65);
                $img->save($to_mini);
                unlink($from);
            }
            $path_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/users/store/';
            if(file_exists($path_mini.$business_store->store_img) && !empty($business_store->store_img)){
                unlink($path_mini.$business_store->store_img);
            }

            DB::table('business_store')
                ->where('id', $business_store->id)
                ->update([
                'id_user' => $this->id_user, 'tarif' => $request->tariff, 'store_name' => $request->store_name, 'created_at' => date("Y-m-d H:i:s"),
                'store_img' => $data['photo1']
            ]);
            return redirect()->back()->with('message', 'Успешно отправлено. Ждите!');
        }else{
            if(!empty($data['photo1'])){
                $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$data['photo1'];
                $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/users/store/'.$data['photo1'];
                $to_mini = $_SERVER['DOCUMENT_ROOT'] . '/uploads/users/store/'.$data['photo1'];

                // Вызываем класс
                $img = new SimpleImage();
                $img->load($from);
                $img->fit_to_width(900); // В аргумент ширину картинки, которая нужна(Она пропорц. уменьш.)
                $img->save($to);
                $img->adaptive_resize(141, 65);
                $img->save($to_mini);
                unlink($from);
            }
            DB::table('business_store')->insertGetId([
                'id_user' => $this->id_user, 'tarif' => $request->tariff, 'store_name' => $request->store_name, 'created_at' => date("Y-m-d H:i:s"),
                'store_img' => $data['photo1']
            ]);
            return redirect()->back()->with('message', 'Успешно отправлено. Ждите!');
        }
    }

    public function bank(Request $request){
        $image = $request->input('image');
        $user = User::find($this->id_user);
        if(!empty($image)){
            $from = $_SERVER['DOCUMENT_ROOT'] . '/temp/'.$image;
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/users/bank/'.$image;

            // Вызываем класс
            $img = new SimpleImage();
            $img->load($from);
            $img->adaptive_resize(227, 140);
            $img->save($to);
            unlink($from);
        }
        $user->update([
            'bank_card' => $image
        ]);
        return 0;
    }
}