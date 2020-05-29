<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegPost;
use App\Users;
class LoginController extends Controller
{
    // 登录
    public function login(){
        return view('index.login');
    }
    // 确认登录
    public function loginDo(){
        $data=request()->except('_token');
        // dd($data);
        $info=Users::where('user_name',$data['user_name'])->first();
        // dd($info);
        if(decrypt($info->user_pwd)==$data['user_pwd']){
            session(['user'=>$info]);
            if($data['refer']){
                return redirect($data['refer']);
            }
            return redirect('/');die;
        }
        return redirect('/login')->with('msg','账号或密码错误');die;
    }
    // 注册
    public function reg(){
        return view('index.reg');
    }
    // 注册入库
    public function regDo(RegPost $request){
        $data=$request->except('_token','repwd');
        // 接受session值
        $Session=session('code'.$data['user_name']);
        $code=$request->session()->all();
        // dump($code);
        // dd($Session);
        if(!$Session){
            return redirect('/reg')->with('msg','您的手机号有误');
        }
        if(!$Session==$data['code']){
            return redirect('/reg')->with('msg','您的验证码有误');
        }
        $data['user_pwd']=encrypt($data['user_pwd']);
        $res=Users::insert($data);
        if($res){
            return redirect('/login');
        }

    }
    // 手机号发送验证码
    public function telSms(){
        // AccessKey ID
        // LTAI4GBafRsGqYxDxYwbTrdk
        // AccessKey Secret
        // vFlu666ELiI5Bh4mw256w2IUXmMAUB
        $name=request()->name;
        $reg='/^1[3|4|5|6|7|8|9]\d{9}$/';
        if(!preg_match($reg,$name)){
            return json_encode(['code'=>'00001','msg'=>'请输入正确的手机号']);die;
        }
        // 随机六位数验证码
        $code=rand(100000,999999);
        $result=$this->send($name,$code);
        if($result['Message']=='OK'){
            session(['code'.$name=>$code]);
            request()->session()->save();
            return json_encode(['code'=>'00000','msg'=>'验证码已发送，请注意查收']);die;
        }
    }
    public function send($name,$code){
        AlibabaCloud::accessKeyClient('LTAI4GBafRsGqYxDxYwbTrdk', 'vFlu666ELiI5Bh4mw256w2IUXmMAUB')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

        try {
            $result = AlibabaCloud::rpc()
                                ->product('Dysmsapi')
                                // ->scheme('https') // https | http
                                ->version('2017-05-25')
                                ->action('SendSms')
                                ->method('POST')
                                ->host('dysmsapi.aliyuncs.com')
                                ->options([
                                                'query' => [
                                                'RegionId' => "cn-hangzhou",
                                                'PhoneNumbers' => $name,
                                                'SignName' => "豪豪影视",
                                                'TemplateCode' => "SMS_190786105",
                                                'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            return $e->getErrorMessage() . PHP_EOL;
        }
    }
    // 邮箱注册
    public function emailSms(){
        $name=request()->name;
        $reg='/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/';
        if(!preg_match($reg,$name)){
            return json_encode(['code'=>'00001','msg'=>'请输入正确的邮箱账号']);die;
        }
        // 随机六位数验证码
        $code=rand(100000,999999);
        Mail::to($name)->send(new sendEmail($code));
        session(['code'.$name=>$code]);
    }

}
// vrvlwubdejjbghde
