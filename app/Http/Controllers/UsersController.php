<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Token;

use Auth;

use Carbon\Carbon;

use Laracasts\Flash\Flash;

use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Foundation\Auth\ThrottlesLogins; //

class UsersController extends Controller
{

    use ThrottlesLogins;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $contrasena)
    {
        //inicio
        //$id_usuario = Auth::User()->id;
        $user_counter = DB::table('users')->where('id', $id)->value('counter');
        //$users = User::orderBy('id', 'ASC')->paginate(2);
        $aleatorios = $this->GetRandomNumbers(1,9,6);
        $funcion = $this->StoreToken($aleatorios, $id);
        return view('admin.profile', ['contador' => $user_counter, 'token_number' => $funcion, 'id' => $id, 
            'password' => $contrasena]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function GetRandomNumbers($min, $max, $length)
    {
        # code...
        $arr = array();
        $random_number = '';
        $contador = 0;
        while ($contador < $length) {
            # code...
            $tmp = mt_rand($min, $max);
            if (! in_array($tmp, $arr)) {
                # code...
                $arr[] = $tmp;
                $random_number .= $tmp;
                $contador++;
            }
        }
        return $random_number;
    }

    protected function StoreToken($Random, $id)
    {
        # code...
        $isnotNull = DB::table('tokens')
            ->where('user_id', $id)
            ->value('id');

        if ($isnotNull == null) {
            # insertar en la tabla tokens...
            DB::table('tokens')
                ->insert([
                    'user_id' => $id,
                    'token' => $Random,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                    ]);
            return $Random;
        }
        else
        {
            $token_number = DB::table('tokens')
                                ->where('user_id', $id)
                                ->value('token');

            return $token_number;
        }
    }

    public function login(Request $request)
    {
        #validamos el formulario antes de empezar
        $this->validate($request,[
            'token' => 'required|max:6',
            ]);

        # consulta que generamos para saber si tenemos un dato en la tabla tokens
       $consulta = DB::table('tokens')
            ->join('users', 'tokens.user_id', '=', 'users.id')
            ->select('users.email', 'users.password', 'users.type', 'users.id', 'tokens.token')
            ->where('tokens.user_id', $request->id)
            ->get();

        if ($consulta == null) {
            # code...

            return redirect()->route('login');
        }
        else
        {
            $user_id = '';
            foreach ($consulta as $query) {
                # code...
                $user_id = $query->id;
            }

            if (strcmp($request->token, $query->token) !== 0) {
                # code...
                flash('Lo sentimos! Por favor  intentalo nuevamente.', 'danger');
                return redirect()->route('tokenActive', ['id' => $user_id, 'contrasena' => $request->contrasena]);
            }
            else
            {

                if (Auth::attempt(['email' => $query->email, 'password' => $request->contrasena])) {
                    # code...
                    $this->UpdateUsersandTokens($query->id);
                    return redirect()->intended('home');
                }
            }

        }

    }
    protected function UpdateUsersandTokens($idUser)
    {
        # code...
       $showCOunter = $this->GetUserCounter($idUser);
       $contador = 0;

       if ($showCOunter < 5) {
           # code...
            $contador += $showCOunter + 1;
       }
       else
       {
            $contador = 0;
       }

       # actualizamos el registro con la variable que traemos

       $updateQuery = DB::table('users')
            ->where('id', $idUser)
            ->update(['counter' => $contador]);

            return $updateQuery;
    }
}
