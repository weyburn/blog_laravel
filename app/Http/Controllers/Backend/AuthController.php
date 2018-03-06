<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use  Validator;

/**
 * 后台登录控制器
 * Class AuthController
 * @package App\Http\Controllers\Backend
 */
class AuthController extends BackendController
{
    /**
     * 登录视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // 新增数据
//        $hashPassword = Hash::make('12345678');
//        $user = User::create([
//            'name' => 'weyburn',
//            'email' => '695397572@qq.com',
//            'password' => $hashPassword
//        ]);
//        dd($user);

        // 更新数据
//        $user = User::where('name', 'weyburn')->first();
//        $user->email = 'weyburn@126.com';
//        $bool = $user->save();
//        var_dump($bool);

        // 软删除数据
//         $user = User::where('name', 'weyburn')->first();
//         $bool = $user->delete();
//         var_dump($bool);

        // 恢复软删除数据
//         $num = User::withTrashed()->where('name', 'weyburn')->restore();
//         var_dump($num);

        return view('backend.auth.login');
    }


    /**
     * 处理登录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // 获取请求数据
        $data = $request->only([
            'username',
            'password'
        ]);

        // 校验规则
        $rules = [
            'username' => 'bail|required|email|max:64',
            'password' => 'required'
        ];

        // 错误消息
        $messages = [
            'username.required' => '账号不能为空',
            'username.email' => '账号必须是有效邮箱',
            'username.max' => '账号不得超过64个字符',
            'password.required' => '密码不能为空',
        ];

        // 表单基础校验
        $validator = Validator::make($data, $rules, $messages);

        // 校验失败
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->all(),
            ]);
        }

        // 校验账号密码是否正确
        $user = User::where('email', $data['username'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            // 账号存在，且密码正确
            Auth::login($user);
            return response()->json([
                'status' => 200,
                'message' => '登录成功',
            ]);
        }

        // 账号或密码错误
        return response()->json([
            'status' => 400,
            'message' => '账号或密码错误',
        ]);
    }


    /**
     * 注销登录
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/admin/login');
    }
}
