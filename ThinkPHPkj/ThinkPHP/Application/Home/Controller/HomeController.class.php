<?php
/**
 * Created by PhpStorm.
 * User: psmingyu
 * Date: 2016/6/20
 * Time: 18:03
 */
namespace Home\Controller;
use Think\Controller;

class HomeController extends EmptyController {
    public function homepage(){
        $data['name']=session('name');
        $data['id']=session('id');
        $this->assign('name',$data['name']);
        $this->assign('id',$data['id']);
        $m=M('User');
        $explevel=$m->where('id='.$data['id'])->find();
        if($explevel['time']+24*60*60<time()){
            $explevel0['num']=0;
            $m->where('id='.$data['id'])->save($explevel0);
        }
        $this->assign('level',$explevel['level']);
        $this->assign('sign',$explevel['judge']);
        $Vip=M('Vip');
        $ress=$Vip->where(array('uid'=>$data['id']))->find();
        if(time()>$ress['expiredtime']){
            $m->where(array('id'=>$data['id']))->save(array('status'=>1));
            $Vip->where(array('uid'=>$data['id']))->delete();
        }
        $login=$m->where('id='.$data['id'])->field('status,headphoto')->find();
        session('status',$login['status']);
        $this->assign('status',$login['status']);
        $this->assign('headphoto',$login['headphoto']);
        $str=$m->where('id='.$data['id'])->field('friendid')->find();
        $arr=explode('@',$str['friendid']);
        $arr=array_filter($arr);
        foreach($arr as $v){
            $brr[]=$m->where('id='.$v)->field('id,headphoto,name')->find();
        }
        $mood=M('Mood');
        foreach($arr as $vv){
            $fmood[]=$mood->where('uid='.$vv)->select();
        }
        foreach($fmood as $v0){
            foreach($v0 as $v1){
                $fmod[]=$v1;
            }
        }
        $sort = array(
            'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field'     => 'addtime',
        );
        $arrSort = array();
        foreach($fmod AS $uniqid => $row){
            foreach($row AS $key=>$value){
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $fmod);
        }
        $this->assign('fmod',$fmod);
        $this->assign('brr',$brr);
        $visitid=$m->where('id='.$data['id'])->field('visitid')->find();
        $visitid=explode('@',$visitid['visitid']);
        $visitid=array_filter($visitid);
        foreach($visitid as $k=>$v){
            $visitid[$k]=explode('*',$v);
        }
        foreach($visitid as $k=>$v){
            $visitid[$k]=$m->where('id='.$v['0'])->field('name,headphoto')->find();
            $visitid[$k]['addtime']=$v['1'];
        }
        $this->assign('visitid',$visitid);
        $mm=M('Message');
        $crr=$mm->where('recipientid='.$data['id'])->field('status,senderid,content,sendername,addtime')->order('addtime DESC')->select();
        foreach($crr as $v){
            if($v['status']==1){
                $msgstatus=1;
            }
        }
        $this->assign('msgstatus',$msgstatus);
        $this->assign('crr',$crr);

        $ncate=M('Newcategory');
        $arr0=$ncate->where('pid=1')->select();
        $this->assign('arr0',$arr0);
        $arr1=$ncate->where('pid=2')->select();
        $this->assign('arr1',$arr1);
        $arr2=$ncate->where('pid=3')->select();
        $this->assign('arr2',$arr2);
        if(I('post.cate_id')){
            $str=I('post.cate_id');
            $arr08=explode('@',$str);
            $arr08=array_filter($arr08);
            $arr08= array_flip($arr08);
            $arr08= array_flip($arr08);
            $namestr=I('post.catename');

            $arr080=explode('@',$namestr);
            $arr080=array_filter($arr080);
            $arr080= array_flip($arr080);
            $arr080= array_flip($arr080);

            foreach($arr080 as $v080){
                $arr081[]=explode('*',$v080);
                $arr081=array_filter($arr081);
            }

            if(I('post.delenewscate_id')){

                $strnum=I('post.delenewscate_id');
                    foreach($arr08 as $k=>$v08){
                        if($strnum == $v08) unset($arr08[$k]);
                    }
                    foreach($arr081 as $k=>$vv0){
                        if($vv0[1]==$strnum){
                            unset($arr081[$k]);
                        }
                    }

            }
            $this->assign('arr081',$arr081);
            $m=M('News');
            foreach($arr08 as $v){
                $arr10[]=$m->where('cid='.$v)->select();
            }
            foreach($arr10 as $vv){
                foreach($vv as $vvv){
                    $arr11[]=$vvv;
                }

            }
            $this->assign('arr11',$arr11);
            if(!($arr11)){
                $news=M('News');
                $newsdata=$news->select();
                $this->assign('newsdata',$newsdata);
            }

        }else{
            $news=M('News');
            $newsdata=$news->select();
            $this->assign('newsdata',$newsdata);
        }
        $album=M('Album');
        $album=$album->where('uid='.$data['id'])->field('id,name')->select();
        $this->assign('album',$album);
        $advert=M('Advert');
        $advertpic=$advert->where('id=1')->find();
        $this->assign('homepicpath1',$advertpic['homepicpath1']);
        $this->assign('homepicpath2',$advertpic['homepicpath2']);
        $Comment=M('Comment');
        $res=$Comment->join('think_user ON think_comment.comment_uid = think_user.id')->select();
        $this->assign('res_comment',$res);
        $this->display();
    }
    public function photo(){
        $data['name']=session('name');
        $data['id']=session('id');
        $this->assign('name',$data['name']);
        $this->assign('id',$data['id']);
        $m=M('Album');
        $uid=$data['id'];
        $arr=$m->where("uid=$uid")->select();
        $this->assign('arr',$arr);
        $this->display();
    }
    public function createalbum(){
        $arr1['name']=I('post.hid1');
        $arr1['content']=2;
        $arr2['name']=I('post.hid2');
        $arr2['content']=3;
        $arr3['name']=I('post.hid3');
        $arr3['content']=4;
        $uid=I('post.uid');
        $data['name']=I('post.createalbum');
        $m=M('album');
        $result=$m->where("uid=$uid")->select();
        if(session('status')==1){
            $data['uid']=$uid;
            $m->add($data);
        }
        $b='';
        foreach($result as $v){
            if($v['content']>1){
                $b=$v['content'];
            }
        }


        if(session('status')==2 && $b){
            $data['uid']=$uid;
            $m->add($data);
        }
        if(session('status')==2 && !$b){
            $arr1['uid']=$uid;
            $arr2['uid']=$uid;
            $arr3['uid']=$uid;
            $data['uid']=$uid;
            $m->add($arr1);
            $m->add($arr2);
            $m->add($arr3);
            $m->add($data);
        }


        $this->redirect('photo');
    }
    public function modify(){
        $arr['id']=I('post.id');
        $data['status']=I('post.modify');
        if($data['status']!=3){
            $m=M('Album');
            $m->where($arr)->save($data);
        }
        $this->redirect('photo');

    }
    public function uploadify(){
        $targetFolder = '/thinkphp/Public/Uploads/img';
        $verifyToken = md5('unique_salt' . $_POST['timestamp']);
        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $num = strrpos($_FILES['Filedata']['name'],'.');
            $houzhui = substr($_FILES['Filedata']['name'],$num);
            $name=time().rand(0,1000).$houzhui;
            $targetFile = rtrim($targetPath,'/') . '/' . $name;
            $fileTypes = array('jpg','jpeg','gif','png');
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            if (in_array($fileParts['extension'],$fileTypes)) {
                move_uploaded_file($tempFile,$targetFile);
                echo $name."'>";
            } else {
                echo '上传失败.';
            }
        }
    }
    public function upload(){
        $data['pid']=I('post.uploadalbum');
        $data['uid']=I('post.uid');
        $arr=I('post.photopath');
        $photo=M('Photo');
        foreach($arr as $v){
            $data['path']=$v;
            $photo->add($data);
        }
        if(I('post.key')==1){
            $this->redirect('homepage');
        }
        if(I('post.key')==2){
            $this->redirect('photo');
        }
    }

    public function search(){
        if(I('post.albumid')){
            $data['pid']=I('post.albumid');
            $content=I('post.album');
        }
        if(I('get.content')){
            $content=I('get.content');
            $data['pid']=I('get.pid');
        }
        $m=M('Photo');
        $arr=$m->where($data)->field('id,pid,path')->select();
        $this->assign('photopath',$arr);
        $this->assign('content',$content);
        $this->display();
    }
    public function setup(){
        $data['id']=I('post.setup0');
        $data0['id']=I('post.setup1');
        $hpminpath=I('post.setminpath');
        $mm=M('Album');
        $homepage['homepage']=$hpminpath;
        $mm->where($data0)->save($homepage);
        $this->redirect('photo');
    }
    public function delpic(){
        $arr['id']=I('post.delete');
        $path=I('post.path');
        $pid=I('post.pid');
        $content=I('post.setup3');
        $delpath='./Public/Uploads/img/'.$path;
        unlink($delpath);
        $m=M('Photo');
        $m->where($arr)->delete();
        $homepage['homepage']=$path;
        $album=M('Album');
        $res=$album->where($homepage)->find();
        if($res){
            $homepage0['homepage']='1';
            $album->where($homepage)->save($homepage0);
            }
        $this->redirect('search',array('content'=>$content,'pid'=>$pid));
    }
    public function delalb(){
        $data['id']=I('post.albid');
        $content=I('post.albcont');
        if($content==1){
            $m=M('Album');
            $m->where($data)->delete();
            $mm=M('Photo');
            $result=$mm->where('pid='.$data['id'])->field('path')->select();
            foreach($result as $v){
                $arr[]='./Public/Uploads/img/'.$v['path'];
            }
            foreach($arr as $vv){
                unlink($vv);
            }
            $mm->where('pid='.$data['id'])->delete();
        }

        $this->redirect('photo');
    }
    public function sendmsg(){
        $data['sendername']=I('post.sendername');
        $data['recipientid']=I('post.recipientid');
        $data['senderid']=I('post.senderid');
        $data['content']=I('post.content');
        $data['addtime'] = date("Y-m-d H:i:s");
        if($data['content']){
            $m=M('Message');
            $m->add($data);
        }

    }
    public function readmsg(){
        $read=I('post.msgstatus');
        $data['recipientid']=I('post.id');
        $arr['status']='2';
        if($read=='op'){
            $m=M('Message');
            $m->where($data)->save($arr);
            $this->redirect('homepage');
        }

    }
    public function sendsession(){
        if(I('post.newscid')){
            $num0=I('post.newscid');
            $name=I('post.newscatename');
            $strnum=session('meme');
            $strname=session('memename');
            $num=str_replace($num0.'@','',$strnum);
            $str00=$name.'*'.$num0.'@';
            $strname=str_replace($str00,'',$strname);
            session('meme', $num);
            session('memename',$strname);
        }else{
            session('meme',I('post.meme'));
            session('memename',I('post.memename'));
        }


    }
    public function personpage(){
        $name=session('name');
        $data['id']=session('id');
        $status=session('status');
        $this->assign('name',$name);
        $this->assign('id',$data['id']);
        $this->assign('status',$status);
        $m=M('User');
        $result=$m->where($data)->find();
        $sanji=explode(',',$result['city']);
        $this->assign('sanji',$sanji);
        $this->assign('ssex',$result['sex']);
        $this->assign('username',$result['username']);
        $this->assign('email',$result['email']);
        $this->assign('school',$result['school']);
        $this->assign('city',$result['city']);
        $this->assign('headphoto',$result['headphoto']);
        session('headphoto',$result['headphoto']);
        if($result['sex']==1){
            $sex='男生';
        }else{
            $sex='女生';
        }
        $this->assign('sex',$sex);
        $this->assign('age',$result['age']);
        $time1=M('Mood');
        $arr0=$time1->where('uid='.$data['id'])->field("addtime,content")->select();
        foreach($arr0 as $k=>$v){
            $arr00[$k]['year']=substr($v['addtime'],0,4);
            $arr00[$k]['date']=substr($v['addtime'],6,5);
            $arr00[$k]['content']=$v['content'];
        }
        $time2=M('Daily');
        $arr1=$time2->where('uid='.$data['id'])->field("addtime,title")->select();
        foreach($arr1 as $k=>$v){
            $arr01[$k]['year']=substr($v['addtime'],0,4);
            $arr01[$k]['date']=substr($v['addtime'],6,5);
            $arr01[$k]['title']=$v['title'];
        }
        $arr=array_merge($arr00,$arr01);
        $sort = array(
            'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field'     => 'date',
        );
        $arrSort = array();
        foreach($arr AS $uniqid => $row){
            foreach($row AS $key=>$value){
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $arr);
        }
        $this->assign('arr',$arr);

        $this->display();
    }
    public function headphoto(){
        $data['id']=I('post.uid');
        if($_FILES['headphoto']['name']){
            $upload=new \Think\Upload();
            $upload->maxSize=3145728 ;
            $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
            $upload->rootPath='./Public/Uploads/';
            $upload->saveName = time().'_'.mt_rand();
            $info   =   $upload->uploadOne($_FILES['headphoto']);
            $arr['headphoto']=$info['savepath'].$info['savename'];
            $m=M('User');
            $hppath=$m->where($data)->field('headphoto')->find();
            if($hppath['headphoto']=="men_main.gif"){
                $m->where($data)->save($arr);

            }else{
                unlink('./Public/Uploads/'.$hppath['headphoto']);
                $m->where($data)->save($arr);
                $mood=M('Mood');
                $mood->where('uid='.$data['id'])->save($arr);
            }

        }
        $this->redirect('personpage');
    }
    public function msgbox(){
        $headphoto=session('headphoto');
        $this->assign('headphoto',$headphoto);
        $db = M("Message");
        $count = $db->where('recipientid='.session('id'))->count();
        $pagecount = 5;
        $page = new \Think\Page($count , $pagecount);
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        $list = $db->order('id')->where('recipientid='.session('id'))->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);

        $this->display();

    }
    public function daily(){
        $headphoto=session('headphoto');
        $this->assign('headphoto',$headphoto);
        $db = M("Daily");
        $count = $db->where('uid='.session('id'))->count();
        $pagecount = 5;
        $page = new \Think\Page($count , $pagecount);
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        $list = $db->order('id')->where('uid='.session('id'))->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    public function mood(){
        $headphoto=session('headphoto');
        $this->assign('headphoto',$headphoto);
        $db = M("Mood");
        $count = $db->where('uid='.session('id'))->count();
        $pagecount = 5;
        $page = new \Think\Page($count , $pagecount);
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        $list = $db->order('id')->where('uid='.session('id'))->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    public function delemsg(){
        $data['id']=I('post.msgid');
        $m=M('Message');
        $m->where($data)->delete();
        $this->redirect('msgbox');
    }
    public function deledaily(){
        $data['id']=I('post.msgid');
        $m=M('Daily');
        $m->where($data)->delete();
        $this->redirect('daily');
    }
    public function writemood(){
        $data['uid']=I('post.uid');
        $data['content']=I('post.content');
        $data['name']=I('post.name');
        $data['headphoto']=I('post.headphoto');
        $upload=new \Think\Upload();
        $upload->maxSize=3145728 ;
        $upload->exts=array('jpg', 'gif', 'png', 'jpeg');
        $upload->rootPath='./Public/Uploads/';
        $upload->saveName = time().'_'.mt_rand();
        $info   =   $upload->uploadOne($_FILES['picpath']);
        $data['picpath']=$info['savepath'].$info['savename'];
        $data['addtime'] = date("Y-m-d H:i:s");
        $m=M('Mood');
        $m->add($data);
        $this->redirect('homepage');
    }
    public function relative(){
        $id=session('id');
        $m=M('User');
        $result=$m->where('id='.$id)->field('school')->find();
        $friendid=$m->where('id='.$id)->field('friendid')->find();
        $friendid=explode('@',$friendid['friendid']);
        $friendid=array_filter($friendid);
        $arr=$m->where($result)->select();
        foreach($friendid as $v){
            foreach($arr as $k=>$vv){
                if($v==$vv['id']){
                    unset($arr[$k]);
                }
            }
        }
        foreach($arr as $k=>$v){
            if($v['id']==$id){
                unset($arr[$k]);
            }
        }
        $this->assign('arr',$arr);
        $this->display();
    }
    public function addfriend(){
        $id=I('post.id');
        $data['id']=session('id');
        $m=M('User');
        $str=$m->where($data)->field('friendid')->find();
        if(!strstr($str['friendid'],$id)){
            $str['friendid']=$str['friendid'].$id.'@';
            session('asdf',$str);
            $m->where($data)->save($str);
        }

    }
    public function sessionfriend(){
        $sex=I('post.sex');
        $age=I('post.age');
        $school=I('post.school');
        $province=I('post.province');
        session('ssex',$sex);
        session('sage',$age);
        session('sschool',$school);
        session('sprovince',$province);
    }
    public function searchfriend(){
        $id=session('id');
        $sex=session('ssex');
        $age=session('sage');
        $school=session('sschool');
        $province=session('sprovince');
        if($province=='省份'){
            $province='';
        }
        $pre=substr($age,0,2);
        $after=substr($age,3,2);
        $map['sex']=$sex;
        $map['age']=array(array("gt",$pre),array('lt',$after));
        $map['school']=$school;
        $map['city']=array('like','%'.$province.'%');
        $m=M('User');
        $friendid=$m->where('id='.$id)->field('friendid')->find();
        $friendid=explode('@',$friendid['friendid']);
        $friendid=array_filter($friendid);
        $arr=$m->where($map)->select();
        foreach($friendid as $v){
            foreach($arr as $k=>$vv){
                if($v==$vv['id']){
                    unset($arr[$k]);
                }
            }
        }
        foreach($arr as $k=>$v){
            if($v['id']==$id){
                unset($arr[$k]);
            }
        }
        $this->assign('arr',$arr);
        $this->display();
    }
    public function scanfriend(){
        $friendid=I('post.friendid');
        $myselfid=I('post.myselfid');
        session('friendid',$friendid);
        if(session('friendid')){
            $friendid=session('friendid');
        }
        $time=date("Y-m-d H:i:s");
        $m=M('User');
        $data1=$m->where('id='.$friendid)->field('visitid')->find();
        $data1['visitid']=$data1['visitid'].$myselfid.'*'.$time.'@';
        $m->where('id='.$friendid)->save($data1);
        $result=$m->where('id='.$friendid)->find();
        session('friendname',$result['name']);
        session('friendlevel',$result['level']);
        session('friendhphoto',$result['headphoto']);
        session('friendstatus',$result['status']);
        $this->assign('name',$result['name']);
        $this->assign('headphoto',$result['headphoto']);
        $this->assign('level',$result['level']);
        $this->assign('status',$result['status']);
        $this->assign('age',$result['age']);
        $this->assign('school',$result['school']);
        $this->assign('city',$result['city']);
        if($result['sex']==1){
            $sex='男生';
        }else{
            $sex='女生';
        }
        $this->assign('sex',$sex);

        $time1=M('Mood');
        $arr0=$time1->where('uid='.$friendid)->field("addtime,content")->select();
        foreach($arr0 as $k=>$v){
            $arr00[$k]['year']=substr($v['addtime'],0,4);
            $arr00[$k]['date']=substr($v['addtime'],6,5);
            $arr00[$k]['content']=$v['content'];
        }
        $time2=M('Daily');
        $arr1=$time2->where('uid='.$friendid)->field("addtime,title")->select();
        foreach($arr1 as $k=>$v){
            $arr01[$k]['year']=substr($v['addtime'],0,4);
            $arr01[$k]['date']=substr($v['addtime'],6,5);
            $arr01[$k]['title']=$v['title'];
        }
        $arr=array_merge($arr00,$arr01);
        $sort = array(
            'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field'     => 'date',
        );
        $arrSort = array();
        foreach($arr AS $uniqid => $row){
            foreach($row AS $key=>$value){
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $arr);
        }
        $this->assign('arr',$arr);
        $this->display();
    }
    public function friendalbum(){
        $id=session('friendid');
        $m=M('Album');
        $result=$m->where('uid='.$id)->select();
        foreach($result as $k=>$v){
            if($v['status']==1){
                unset($result[$k]);
            }
        }
        $this->assign('arr',$result);
        $this->display();

    }
    public function friendsearch(){
        $name=session('friendname');
        $status=session('friendstatus');
        $headphoto=session('friendhphoto');
        $this->assign('name',$name);
        $this->assign('headphoto',$headphoto);
        $this->assign('status',$status);
        $data['pid']=I('post.albumid');
        $content=I('post.album');
        $m=M('Photo');
        $arr=$m->where($data)->field('id,pid,path')->select();
        $this->assign('photopath',$arr);
        $this->assign('content',$content);
        $this->display();

    }
    public function friendmood(){
        $id=session('friendid');
        $name=session('friendname');
        $status=session('friendstatus');
        $headphoto=session('friendhphoto');
        $this->assign('name',$name);
        $this->assign('headphoto',$headphoto);
        $this->assign('status',$status);
        $db = M("Mood");
        $count = $db->where('uid='.$id)->count();
        $pagecount = 5;
        $page = new \Think\Page($count , $pagecount);
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        $list = $db->order('id')->where('uid='.$id)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();


    }
    public function frienddaily(){
        $id=session('friendid');
        $name=session('friendname');
        $status=session('friendstatus');
        $headphoto=session('friendhphoto');
        $this->assign('name',$name);
        $this->assign('headphoto',$headphoto);
        $this->assign('status',$status);
        $id=session('friendid');
        $db = M("Daily");
        $count = $db->where('uid='.$id)->count();
        $pagecount = 5;
        $page = new \Think\Page($count , $pagecount);
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        $list = $db->order('id')->where('uid='.$id)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();

    }
    public function writedaily(){
        $data['uid']=I('post.uid');
        $data['title']=I('post.title');
        $data['content']=I('post.contdaily');
        $data['addtime']=date("Y-m-d H:i:s");
        if($data['title']==''){
            $data['title']='无题';
        }
        $m=M('Daily');
        $m->add($data);
        $this->redirect('homepage');
    }
    public function recharge(){
        $id=session('id');
        $User=M('User');
        $res=$User->find($id);
        $name=$res['name'];
        $this->assign('name',$name);
        if(I('error')){
            $error=I('error');
            $arr=array(1=>'验证码错误');
            $this->assign('error',$arr[$error]);
        }
        $this->display();
    }

    public function saveVipuser(){
        $code=I('post.checkcode');
        $Verify = new \Think\Verify();
        $res=$Verify->check($code);
        if(!$res){
            $this->redirect('recharge',array('error'=>1));
        }

        $Vip=M('Vip');
        $User=M('User');
        $id=session('id');   //获取登录的id    更新数据库哪条记录的条件
        $money=I('post.money');   //充值数   更新数据库status字段的状态的条件    根据传值判断开通的时间
        $row=$User->find($id);
        if($money && $row['status']==1){
            $extime=time()+$money*10;
            $arr=array(
                'uid'=>$id,
                'money'=>$money,
                'addtime'=>time(),
                'expiredtime'=>$extime);
            $res= $Vip->add($arr);
            if($res){
                $User->where(array('id'=>$id))->save(array('status'=>2));
            }
        }elseif($money && $row['status']==2) {
            $extime=$money*10;
            $exstime = $Vip->where('uid='.$id)->find();
            $finaltime =$exstime['expiredtime'];
            $arr = array(
                'uid' => $id,
                'money' => $money,
                'addtime' => time(),
                'expiredtime' => $finaltime+$extime);
                $Vip->save($arr);
        }
        $this->redirect('home/homepage');
    }
    public function searchall()
    {

        if(IS_POST){
            $User = M('User');
            $News = M('News');
            $search = I('post.search');
            /*$where['_string']="(name like \"%$search%\")  OR (school like \"%$search%\")";*/
            $where['name']=array('like',"%$search%");
            $res = $User->where($where)->select();
            $wherenews['_string']="(title like \"%$search%\") OR (content like \"%$search%\")";
            $resnews = $News->where($wherenews)->select();
            $this->assign('res',$res);
            $this->assign('resnews',$resnews);
        }
        $this->display();

    }
    public function logout(){
        session(null);
        $this->redirect('Index/index');
    }
    public function explevel(){
        $id=I('post.id');
        $m=M('User');
        $result=$m->where('id='.$id)->find();
        $today_zero=strtotime(date('Y-m-d',time()));
        if($result['time']<time() && time()>$today_zero && $result['num']<4){
            $data['time']=time();
            $data['exp']=$result['exp']+1;
            $data['num']=$result['num']+1;
            $data['judge']=2;
            $m->where('id='.$id)->save($data);

        }
        if($result['time']<time() && time()>$today_zero && $result['num']>3){
            $data['time']=time();
            $data['exp']=$result['exp']+2;
            $data['num']=$result['num']+1;
            $data['judge']=2;
            $m->where('id='.$id)->save($data);
        }
    }
    public function addComment(){
        $uid=I('post.uid');
        $moodid=I('post.moodid');
        $content=I('post.content');
        $arr=array(
            'comment_uid'=>$uid,
            'moodid'=>$moodid,
            'content'=>$content,
            'comment_addtime'=>date('Y-m-d H:i:s')
        );
        $Comment=M('Comment');
        $res=$Comment->add($arr);
        if($res){
            $this->redirect('homepage');
        }
    }
}
