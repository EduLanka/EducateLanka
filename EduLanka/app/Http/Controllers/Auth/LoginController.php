<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function login(Request $request){
        $credentials=$request->validate([
            'email'=> 'required|email',
            'password'=>'required',
        ]);
        if(Auth::attempt($credentials)){
            $user_role=Auth::user()->role;

            switch($user_role){
                case 1:
                    return redirect('admin');
                    break;
                    case 2:
                        return redirect('student');
                        break;
                        case 3:
                            return redirect('teacher');
                            break;
                            case 4:
                                return redirect('parent');
                                break;
                                case 5:
                                    return redirect('developer');
                                    break;
                                    default:
                                    Auth::logout();
                                    return redirect('/login')->with('error','ooops something went wrong try again later');

            }
        
        }else{
            return redirect('/login')->with('error', 'Invalid credentials. Please try again');
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
   
}
