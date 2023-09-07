<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Carbon;
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
    //protected $redirectTo = RouteServiceProvider::HOME;

    public function authenticated()
    {


        if(Auth::user()->role_as == '1') {
            return redirect('admin/dashboard')->with('status', 'Welcome to Dashboard');
        } else {

            $todayDate = Carbon::now()->format('Y-m-d');
            $thisMonth = Carbon::now()->format('m');
            $thisYear = Carbon::now()->format('Y');

            $totalOrder = Order::where('user_id', auth()->user()->id)->count();
            $todayOrder = Order::whereDate('created_at', $todayDate)->where('user_id', auth()->user()->id)->count();
            $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->where('user_id', auth()->user()->id)->count();
            $thisYearOrder = Order::whereYear('created_at', $thisYear)->where('user_id', auth()->user()->id)->count();

            return redirect('/home')->with(['totalOrder' => $totalOrder, 'todayOrder' => $todayOrder, 'thisMonthOrder' => $thisMonthOrder, 'thisYearOrder' => $thisYearOrder, 'status', 'Logged In Successfully.']);
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
