<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
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
        $user_confirm -> confirm_code = str_random(64);
        $user_confirm -> save();
        return redirect('/login');
    }

    public function avatar()
    {
        return view('auth.avatar');
    }

    public function changeAvatar(Request $request)
    {
        $file = $request->file('avatar');

        $input = array('image'=>$file);
        $rules = array('image' => 'image');
        $validator = \Validator::make($input,$rules);
        if($validator -> fails())
        {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
        }


        $path = 'images/avatar/';
        $filename = \Auth::user()->id.'_'.time().$file->getClientOriginalName();
        $file->move($path,$filename);
        Image::make($path.$filename)->resize(400, null, function ($constraint)
        {
            $constraint->aspectRatio();
        })->save();
//        $user = $this->userRepository->getUserByID(Auth::user()->id);
//        $user ->avatar = '/'.$path.$filename;
//        $user -> save();
//        return redirect()->action('UserController@avatar');
        return \Response::json([
            'success' => true,
            'avatar'  => asset($path.$filename),
            'image'   => $path.$filename,
        ]);
    }

    public function cropAvatar(Request $request)
    {
        $photo = $request->get('photo');
        $width = (int)$request->get('w');
        $height = (int)$request->get('h');
        $xAlign = (int)$request->get('x');
        $yAlign = (int)$request->get('y');
        Image::make($photo)->crop($width,$height,$xAlign,$yAlign)->save();
        $user = Auth::user();
        $user -> avatar = asset($photo);
        $user -> save();
        return redirect('/user/avatar');
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
