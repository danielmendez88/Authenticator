<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;  //
use Illuminate\Support\Facades\Auth; //
use App\Binnacle;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash; //
use Illuminate\Support\Facades\Lang;//
use Illuminate\Support\Facades\DB; //

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
    protected $redirectTo = '/home';

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
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
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
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();     


        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

         //aqui obtengo el id_user
        $id_usuario = $this->GetUserId($request->email);
        $contador = 0;
        $counter_function = $this->GetUserCounter($id_usuario);
        $CurrentDate = $this->GetDateCompare($id_usuario);
        $diffDays = $this->GetDiffDate($request->email);
        
        if ($diffDays < 1) {
            # code...
            if ($counter_function < 5) {
                # code...
                    if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
                        # code...
                        //return dd($this->store($request));
                        $request->request->add(['mylog' => '1']);
                        $this->store($request); //aqui llamamos a la función que guardará los datos en la tabla Binnacle
                        
                        $contador =+ 1;

                        $id = Auth::user()->id;

                        $counter_function += $contador;
                            /**
                             * Aquí invocaremos el metodo que actualizará el numero de veces que se
                             * autentica el usuario y daremos paso a que nos redireccione al home 
                             */
                            $this->UpdateAttempts($id, $counter_function);
                            return $this->handleUserWasAuthenticated($request, $throttles);
                    }
            }
            else
            {
                try {
                    // enviamos los parametros al metodo para que nos envie directo al token
                    return $this->GenToken($request, $id_usuario);

                } catch (Exception $e) {
                    return $e->getMessage();
                }
            }
        }
        else
        {
            //aquí entrará a la función que lo enviará directamente al token
            return $this->GenToken($request, $id_usuario);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        $request->request->add(['mylog' => '2']);
        $this->store($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function store(Request $request)
    {
        switch ($request->mylog) {
            case '1':
                # code...
                $type_logs = 1;
                $logs = "ingreso al sistema de manera satisfactoria, cuenta con credenciales";
                break;
            case '2':
                # code...
                $type_logs = 2;
                $logs = "No ingreso al sistema de manera satisfactoria, No cuenta con credenciales para realizarlo";
                break;
        }
        # code...
        $bitacora = new Binnacle;
        $date = Carbon::now();
        $bitacora->myip = $request->ip();
        $bitacora->user_acount = $request->email;
        $bitacora->logs = $logs;
        $bitacora->log_types = $type_logs;
        $bitacora->save();
    }

    protected function GetUserId($string)
    {
        # code...
        $user_id = DB::table('users')
            ->where('email', $string)
            ->value('id');

        return $user_id;
    }

    protected function GetDateCompare($value)
    {
        # code...
        $Updated_at = DB::table('users')
                            ->where('id', $value)
                            ->value('updated_at');

        return $Updated_at;
    }
    /**
     * enviar una respuesta si falla
    */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }

    /**
     * función que nos permite obtener la diferencia de la ultima fecha en que ingresa un usuario con
    */
    protected function GetDiffDate($updated)
    {
        # code...
        $Last_Updated = DB::table('users')
                     ->where('email', $updated)
                     ->value('updated_at');

        $Ahora = Carbon::now();
        $Last_Updated = Carbon::parse($Last_Updated);

        return $Last_Updated->diffInDays($Ahora); 
    }
    /**
     * Generamos una función que nos permita generar y renviar a la plantilla token
    */
    protected function GenToken(Request $solicitud, $id)
    {
        # code...
        $contrasena = $solicitud->password;
        $usuarios = $solicitud->email;

            $ForUsers = User::where('email', '=', $usuarios)->first();
            $passCheck = Hash::check($contrasena, $ForUsers->password);

        if ($ForUsers == true && $passCheck == true) {
                        # code...
            return redirect()->route('tokenActive', ['id' => $id, 'contrasena' => $contrasena]);
        }
        else
        {
            return $this->sendFailedLoginResponse($solicitud);
        }
    }


    /**
     * generate a ramdonToken
    */
    protected function RandomTokenDebug($digits_needed = 8)
    {
        $num = str_pad(random_int(0,99999999),$digits_needed,'0',STR_PAD_LEFT);

        $random_number=''; // set up a blank string

        $count=0;

        while ( $count < $digits_needed ) {
            $random_digit = mt_rand(0, 9);
            
            $random_number .= $random_digit;
            $count++;
        }

        return $num;
    }
    /**
    */

    function mtr($seed = null, $min = 0, $max = 99999999)
    {
      static $mt = array(); // 624 element array used to get random numbers
      static $ps = null; // Previous Seed
      static $idx = 0; // The index to use when selecting a number to randomize


      // Seed if none was given
      if($seed === null && !$ps) {
        $seed = time();
      }


      // Regenerate when reseeding or seeding initially
      if($seed !== null && $seed !== $ps) {
        $mt = array(&$seed, 624 => &$seed);
        $ps = $seed;


      for($i = 1; $i < 624; ++$i) {
          $mt[$i] = (0x6c078965 * ($mt[$i - 1] ^ ($mt[$i - 1] >> 30)) + $i) & 0xffffffff;
        }
      }


      // Every 624 numbers we regenerate
      if($idx == 0) {
        // This has been tweaked for maximum speed and elegance
        // Explanation of possibly confusing variables:
        //   $p = previous index
        //   $sp = split parts of array - the numbers at which to stop and continue on
        //   $n = number to iterate to - we loop up to 227 adding 397 after which we finish looping up to 624
        //        subtracting 227 to continue getting out 397 indices ahead reference
        //   $m = 397 or -227 to add to $i to keep our 397 index difference
        //   $i = the previous element in $sp, our starting index in this iteration
        for($j = 1, $sp = array(0, 227, 397); $j < count($sp); ++$j) {
          for($p = $j - 1, $i = $sp[$p], $m = ((624 - $sp[$j]) * ($p ? -1 : 1)), $n = ($sp[$j] + $sp[$p]); $i < $n; ++$i) {
            $y = ($mt[$i] & 0x80000000) + ($mt[$i + 1] & 0x7fffffff);
            $mt[$i] = $mt[$i + $m] ^ (($y & 0x1) * 0x9908b0df);
          }
        }
      }


      // Select a number from the array and randomize it
      $y = $mt[$idx];
      $y ^= $y >> 11;
      $y ^= ($y << 7) & 0x9d2c5680;
      $y ^= ($y << 15) & 0xefc60000;
      $y ^= $y >> 18;


      // Increment the index so we will be able to get a different random number without changing the seed
      $idx++;
      if($idx == 624) $idx = 0;


     return $y % ($max - $min + 1) + $min;
    }

}
