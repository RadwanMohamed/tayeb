<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Http\Request;
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
    public function store(UserRequest $request)
    {
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
    public function show(User $user)
    {
        return $this->showOne('user',$user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $rules  = [
            'name' => 'nullable|string|max:190',
            'email' => 'nullable|email',
            'city' => 'nullable|string'
        ];
        $this->validate($request,$rules);

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
    public function destroy(User $user)
    {
        $user->delete();
        return $this->showOne('user',$user,200);
    }

    public function send(Request $request)
    {
        $user = User::find($request->id);
        $user->verify = User::generateVerificationKey();
        $user->save();
        Mail::send('emails.forget', $user, function ($message) use ($user) {
            $message->to($user->email, $user->name)->subject('تغير كلمة السر ');
        });
    }

    public function resetPassword(Request $request)
    {
        $rules = [

            'password' => 'required|string|confirmed',
        ];
        $this->validate($request, $rules);
        $user = User::find($request->id);
        if($user->verify != $request->verify )
                return $this->errorResponse('عفوا تاكد من  صحة البيانات المدخلة');
        $user->password = bcrypt($request->password);
        $user->verify = null;
        $user->save();
        return $this->showOne('user',$user);
    }
}
