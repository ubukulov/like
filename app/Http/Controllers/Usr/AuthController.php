<?php

namespace App\Http\Controllers\Usr;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Cookie;
use App\Card;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/account';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            //'name' => $data['name'],
            //'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showLogin(){
        return view('user/login');
    }

    public function authenticate(Request $request){
        if (Auth::attempt(['mphone' => $request->get('username'), 'password' => $request->get('password')])) {
            $this->checkPartnerAuth();
            if(Cookie::has('cert')){
                return redirect(Cookie::get('cert'));
            }
            return redirect()->intended('user/account');

        }else{
            return redirect()->back()->with('message', 'Логин или пароль не правильно');
        }
    }

    protected function username(){
        return 'mphone';
    }

    # проверка
    public function checkPartnerAuth(){
        if(Auth::guard('partner')->check()){
            Auth::guard('partner')->logout();
        }
    }

    # форма сброса пароля пользователя
    public function showResetForm(){
        return view('user/password-reset');
    }

    # сброс пароля
    public function reset(Request $request){
        $phone = $request->get('username');
        $password = generateCode(4);
        $hash_password = Hash::make($password);
        sendSms($phone,"Vash noviy parol: $password");
        $result = DB::update("UPDATE users SET password='$hash_password' WHERE mphone='$phone'");
        if($result){
            return redirect()->back()->with('message', 'Пароль успешно сброшен. Новый пароль отправлено на ваш номер.');
        }
    }

    # форма регистрации нового пользователя
    public function showRegisterForm(){
        return view('user/user-register');
    }
    
    # регистрация нового пользователя
    public function register(Request $request){
        $password = generateCode(4);
        $hash_password = Hash::make($password);
        $phone = $request->get('username');
        $balance = __encode('0', env('KEY'));
        $data = [
            'firstname' => $request->get('firstname'), 'lastname' => $request->get('lastname'),
            'email' => $request->get('email'), 'mphone' => $phone, 'fm' => $balance,
            'referral' => $request->get('id_referral'), 'password' => $hash_password
        ];
        if(User::check_user_by_phone($phone)){
            $lastInsertId = User::create($data)->id;
            if($lastInsertId){
                Auth::loginUsingId($lastInsertId, true);
                Card::setCard($lastInsertId);
                sendSms($phone, "Vashy dannye: Login: $phone, parol: $password");
                return redirect('user/account');
            }
        }else{
            return redirect()->back()->with('message', 'Пользователь с таким номер уже зарегистрирован');
        }
    }
}