<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends EmptyController{

    public function index(){
        if(I('get.error')){
            $error=I('get.error');
            $this->assign('error',$error);
        }
        $m=M('Advert');
        $result=$m->where('id=1')->find();
        $this->assign('prepicpath1',$result['prepicpath1']);
        $this->assign('prepicpath2',$result['prepicpath2']);
        $this->assign('prepicpath3',$result['prepicpath3']);
        $this->assign('prepicpath4',$result['prepicpath4']);
        $this->display();
    }
    public function code(){
        $Verify = new \Think\Verify();
        $Verify->fontSize = 13;
        $Verify->length   = 4;
        $Verify->useImgBg = false;
        $Verify->useCurve = false;
        $Verify->useNoise = false;
        $Verify->entry();
    }
    public function LoginAction(){
        $code=I('post.icode');
        $username=I('post.username');
        $password=I('post.password');
        $password=md5($password);
        if(!check_verify($code)){
            $this->redirect('index',array('error'=>1));
        }
        $m=M('user');
        $userData1=$m->where("username='$username'")->find();
        $userData2=$m->where("tel='$username'")->find();
        if(!($userData1 || $userData2)){
            $this->redirect('index',array('error'=>2));
        }
        if($userData1){
            if($userData1['password']!=$password){
                $this->redirect('index',array('error'=>3));
            }
            if($userData1['status']==3){
                $this->redirect('index',array('error'=>4));
            }
            if( $userData1['time']+12*60*60<time()){
                $explevel1['judge']=1;
                $m->where("username='$username'")->save($explevel1);
            }
            if( $userData1['exp']>$userData1['level']*2){
                $explevel2['level']=$userData1['level']+1;
                $m->where("username='$username'")->save($explevel2);
            }
            session('headphoto',$userData1['headphoto']);
            session('level',$userData1['level']);
            session('name',$userData1['name']);
            session('id',$userData1['id']);
            session('status',$userData1['status']);
        }
        if($userData2){
            if($userData2['password']!=$password){
                $this->redirect('index',array('error'=>3));
            }
            if($userData2['status']==3){
                $this->redirect('index',array('error'=>4));
            }
            if( $userData2['time']+12*60*60<time()){
                $explevel1['judge']=1;
                $m->where("tel=".$username)->save($explevel1);
            }
            if( $userData2['exp']>$userData2['level']*2){
                $explevel2['level']=$userData2['level']+1;
                $m->where("tel=".$username)->save($explevel2);
            }
            session('headphoto',$userData2['headphoto']);
            session('level',$userData2['level']);
            session('name',$userData2['name']);
            session('id',$userData2['id']);
            session('status',$userData2['status']);
        }
        $this->redirect('Home/homepage');

    }
    public function register(){
         $this->display();
    }
    public function registerAction(){

        $tel=I('post.tel');
        $uname=I('post.uname');
        $email=I('post.email');
        $phone=I('get.mobile');
        $phone1=I('get.mobile1');
        $mcode=I('get.mcode');
        $mcode1=I('get.mcode1');
        $code=I('get.code');
        $pwd=I('get.pwd');
        if($tel){
            $m=M('User');
            $arr['tel']=$tel;
            $result=$m->where($arr)->select();
            if($result){
                echo json_encode('1');
            }else{
                echo json_encode('2');
            }
        }

        if($uname){

            $m=M('User');
            $arr['username']=$uname;
            $result=$m->where($arr)->select();

            if($result){

                echo json_encode('3');
            }else{
                echo json_encode('4');
            }
        }

        if($email){
            $m=M('User');
            $arr['email']=$email;
            $result=$m->where($arr)->select();
            if($result){

                echo json_encode('5');
            }else{
                echo json_encode('6');
            }
        }

      $ch = curl_init();
        $url = "http://apis.baidu.com/kingtto_media/106sms/106sms?mobile={$phone}&content=%E3%80%90%E5%87%AF%E4%BF%A1%E9%80%9A%E3%80%91%E6%82%A8%E7%9A%84%E9%AA%8C%E8%AF%81%E7%A0%81%EF%BC%9A{$mcode}";
        $header = array(
            'apikey:',
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch , CURLOPT_URL , $url);
        $res = curl_exec($ch);

        if($mcode1==$code){
            $m=M('User');
            $arr['tel']=$phone1;
            $arr['password']=md5($pwd);
            $arr['addtime'] = date("Y-m-d H:i:s");
            if(!empty($arr['tel'])){
                $uid=$m->add($arr);
                session('uid',$uid);
            }
        }
    }
    public function writeMessage(){

        $arr['tel']=I('post.hidmsg');
        $data['username']=I('post.username');
        $data['email']=I('post.email');
        $data['name']=I('post.name');
        $data['school']=I('post.school');
        $data['age']=I('post.age');
        $data['sex']=I('post.sex');
        $arr['s_province']=I('post.s_province');
        $arr['s_city']=I('post.s_city');
        $arr['s_county']=I('post.s_county');
        $str=$arr['s_province'].','.$arr['s_city'].','.$arr['s_county'];
        $data['city']=$str;
        $m=M('User');
        if($arr['tel']){
            $m->where('tel='.$arr['tel'])->save($data);
            session('name',$data['name']);
            session('id',session('uid'));
            session('status','1');
            $this->redirect('Home/homepage');
        }
    }
    public function getpassword(){
        $phone['tel']=I('post.phone');
        $m=M('User');
        $res=$m->where($phone)->find();
        $email=$res['email'];
        $psw=md5(I('post.password'));
        $time=time();
        $link="localhost/thinkphp/Home/Index/reseting/email/$email/psw/$psw/k/$time";
        $smtpserver = "smtp.163.com";//SMTP服务器
        $smtpserverport =25;//SMTP服务器端口
        $smtpusermail = "";//SMTP服务器的用户邮箱
        $smtpemailto = $email;//发送给谁
        $smtpuser = "";//SMTP服务器的用户帐号
        $smtppass = "";//SMTP服务器的用户密码
        $mailtitle = '重置密码';//邮件主题
        $mailcontent = "请点击连接(有效期为30分钟)$link";//邮件内容
        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
//************************ 配置信息 ****************************
        $smtp = A("Smtp");//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
        $smtp->debug = false;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
        echo "<div style='width:300px; margin:36px auto;'>";
        if($state==""){
            echo "对不起，邮件发送失败！请检查手机号填写是否有误。";
            echo "<a href=".__CONTROLLER__.">点此返回</a>";
            exit();
        }
        echo "恭喜！邮件发送成功！！";
        echo "<a href=".__CONTROLLER__.">点此返回</a>";
        echo "</div>";
    }
    public function reseting(){
        $data['email']=I('get.email');
        $arr['password']=I('get.psw');
        $k=I('get.k');
        if($k+30*60>time()){
            if($data['email'] && $arr['password']){
                $m=M('User');
                $res=$m->where($data)->save($arr);
                if($res){
                    $this->redirect('index',array('error'=>5));
                }
            }
        }else{
            $this->redirect('index',array('error'=>6));
        }

    }
    public function personpage(){
        $id=session('id');
        $data['username']=I('post.username');
        $data['email']=I('post.email');
        if($data['username'] && $data['email']){
            $arr['username']=$data['username'];
            $arr['email']=$data['email'];
        }
        $arr['name']=I('post.name');
        $arr['school']=I('post.school');
        $arr['age']=I('post.age');
        $arr['sex']=I('post.sex');

        $User=M('User');
        if(I('post.s_province')=='省份'){
            $User->where('id='.$id)->save($arr);
        }else{
            $city=I('post.s_city')=='地级市'?null:I('post.s_city');
            $country=I('post.s_country')=='市、县级市'?null:I('post.s_country');
            $arr['city']=I('post.s_province').'&nbsp;&nbsp;'.$city.'&nbsp;&nbsp;'.$country;
            $User->where('id='.$id)->save($arr);
        }
        session('name',$arr['name']);
        $this->redirect('home/personpage');
    }
}