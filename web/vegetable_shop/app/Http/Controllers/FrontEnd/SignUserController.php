<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SignUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title_name = 'Đăng nhập';
        return view('FrontEnd.signin', compact('title_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title_name = 'Đăng kí';
        return view('FrontEnd.signin', compact('title_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->action == 'SignIn'){
            $check= array('email'=>$request->email, 'password'=>$request->password);

            if(Auth::attempt($check)){
                if (Auth::user()->level == 2) {

                    return response()->json([
                        'status'=>200,
                        'url'=>Session::get('previous_url'),
                        'message'=>'Sign In Success!'
                    ]);
                }else{
                    return response()->json([
                        'status'=>200,
                        'url'=>route('dashboard.index'),
                    ]);
                }
            }else{

                return response()->json([
                    'status'=>404,
                    'message'=>'Email Or Password Invalid!'
                ]);
            }
        }
        else if($request->action == 'SignUp'){
            $user = User::where('email',$request->email)->first();
            if(!$user){
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->level = 2;
                $user->save();

                Auth::login($user,true);
                return response()->json([
                    'status'=>200,
                    'message'=>'Sign Up Successfully!'
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Email already exists'
                ]);
            }
        }
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
}
