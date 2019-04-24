<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll('users',$users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('locale'))
        {
            $locale = $request->locale;
            App::setLocale($locale);
        }
        $ruls =
            [
                'name'     => ['required','string','max:250'],
            'email'    => ['required','email','max:250'],
            'password' => ['required','string','min:9','confirmed'],
            'phone'    => ['required','numeric','unique:users'],
            'city'  =>    ['required','alpha_dash'],];
        $this->validate($request,$ruls);
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => bcrypt($request->password),
            'api_token'    => User::generateToken(),
            'role'     => User::REGULAR_USER,
            'status'   => User::ON,
            'address'  => $request->address,
            'city'     => $request->city,
            'verify'   => User::generateVerificationKey(),

        ]);

        return $this->showOne('user',$user,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = User::where("api_token",$request->api_token)->first();
        return $this->showOne('user',$user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if ($request->has('locale'))
        {
            $locale = $request->locale;
            App::setLocale($locale);
        }
        $rules  = [
            'name' => 'nullable|string|max:190',
            'email' => 'nullable|email',
            'city' => 'nullable|string'
        ];
        $this->validate($request,$rules);

        $user = User::where('api_token',$request->api_token)->first();
        if ($request->has('name'))
               $user->name = $request->name;
        if ($request->has('email'))
               $user->email = $request->email;

        if ($request->has('address'))
                $user->address = $request->address;


        if ($request->has('city'))
                $user->city = $request->city;

        if ($user->isClean())
            return $this->errorResponse('you should enter new data.',422);

        $user->save();

        return $this->showOne('user',$user,200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user)
    {

        if ($user->api_token != $request->api_token)
            return $this->errorResponse('عفوا غير مصرح لك باجراء هذه العملية',422);

        $user->delete();
        return $this->showOne('user',$user,200);
    }

    public function send(Request $request)
    {
        if ($request->has('locale'))
        {
            $locale = $request->locale;
            App::setLocale($locale);
        }

        $user = User::where('email',$request->email)->first();
        if (!$user)
            return $this->errorResponse('please enter valid data',422);

        $verification = User::generateVerificationKey();

        $user->password = bcrypt($verification);

        $user->save();
        $message = "
                تم ارسال هذا البريد بناءا على طلبك لتحديث كلمة السر. كلمة السر الجديدة الخاصة بك :
  {$verification}              
";

        Mail::raw($message,function ($message)use ($request,$user){
            $message->to($user->email)->subject($request->subject);
        });

        return response()->json(["message"=>"تم ارسال رسالة لايميل الخاص بك"],200);

    }

    public function updatePassword(Request $request)
    {
        $user = User::where('api_token',$request->api_token)->first();
        $rules = [
            'oldpassword'   => 'required|string',
            'password'      => 'required|string|confirmed',
        ];
        $this->validate($request, $rules);

       if(!Hash::check($request->oldpassword,$user->password))
               return response()->json(["error"=>"كلمة السر غير صحيحة"],422);

        $user->password = bcrypt($request->password);
        $user->verify = null;
        $user->save();
        return $this->showOne('user',$user);
    }
}
