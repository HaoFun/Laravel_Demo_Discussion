<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Auth;
use Image;
use Hash;
class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth')->except('confirmEmail');
        $this->userRepository=$userRepository;
    }


    public function confirmEmail($confirm_code)
    {

        $user_confirm = $this->userRepository->confrim($confirm_code);
        if(is_null($user_confirm))
        {
            return redirect('/');
        }
        $user_confirm -> is_confirmed =1;
        $user_confirm -> confirm_code = str_random(48);
        $user_confirm -> save();
        return redirect('/login');
    }

    public function avatar()
    {
        return view('auth.avatar');
    }

    public function changeavatar(Request $request)
    {
        $file = $request->file('avatar');
        $path = 'images/avatar/';
        $filename = Auth::user()->id.'_'.time().$file->getClientOriginalName();
        $file->move($path,$filename);
        Image::make($path.$filename)->fit(200)->save();
        $user = $this->userRepository->getUserByID(Auth::user()->id);
        $user ->avatar = '/'.$path.$filename;
        $user -> save();
        return redirect()->action('UserController@avatar');
    }

    public function changepassword()
    {
        return view('auth.password');
    }

    public function changed(StorePasswordRequest $request)
    {
        $user = $this->userRepository->getUserByID($request->get('id'));
        if(!Hash::check($request->get('old_password'),Auth::user()->password))
        {
            flash('修改密碼失敗，請確認密碼是否有誤')->error();
            return redirect('/');
        }
        $data = [
            'password' => bcrypt($request->get('new_password')),
        ];
        $user->update($data);
        flash('修改密碼成功')->success();
        return redirect('/');
    }
}
