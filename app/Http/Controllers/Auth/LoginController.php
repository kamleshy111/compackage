<?php

namespace App\Http\Controllers\Auth;

use App\Models\LoginLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

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

    public function showLoginForm()
    {
        $keywords = 'total compensation statements, total benefit reports, employee benefit reports, total salary reports, software, COMPackage';
        $title = 'Total Compensation Statements | Employee Benefit Reports | COMPackage';
        $description = 'Show your employees their total benefits with Total Compensation Statements from COMPackage. Take a virtual tour of our benefits software today.';
        
        return view('auth.login', compact('title', 'keywords', 'description'));
    }

    /**
     * Check the user role on the login then, redirect accordingly.
     */
    protected function authenticated(Request $request, $user)
    {
        /**
         * Creating login logs of every user that authenticate in Webapp
         */
        $loginlog = new LoginLog;
        $loginlog->user_id = $user->id;
        $loginlog->ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "";
        $loginlog->save();

        /**
         * Checking user role and redirecting user to respective dashboard.
         */
        if( ! empty($user) && $user->isAdmin() ) {
            return redirect()->route('admin.dashboard');
        } else if( auth()->user()->isReseller() || auth()->user()->isUser() ) {
            return redirect()->route('webapp.dashboard');
        } else {
            return redirect()->route('home');
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
    {   
        $input = $request->all();
        $remember = ( ! empty($input['remember']) && $input['remember'] == 'on' ) ? true : false;

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        //$fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'username' : 'username';
        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']), $remember))
        {
            /**
             * Creating login logs of every user that authenticate in Webapp
             */
            $loginlog = new LoginLog;
            $loginlog->user_id = auth()->id();
            $loginlog->ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "";
            $loginlog->save();
            return redirect()->route('login');
        }
        else{
            return redirect()->route('login')
                ->withErrors(['Incorrect username or password.']);
        }
          
    }
}
