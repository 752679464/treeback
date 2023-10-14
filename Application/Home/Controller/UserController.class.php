<?php

namespace Home\Controller;

use Think\Controller;

class UserController extends BaseController
{
    public function test()
    {
        var_dump(321);
    }
    /**
     * 登录函数
     * @return [type] [description]
     */
    public function sign()
    {

        //检验username是否存在
        if (!$_POST['username']) {
            $return_data = array();
            $return_data['errorCode'] = 1;
            $return_data['msg'] = '参数不足：username';

            $this->ajaxReturn($return_data);
        }
        //检验phone是否存在
        if (!$_POST['phone']) {
            $return_data = array();
            $return_data['errorCode'] = 1;
            $return_data['msg'] = '参数不足：phone';

            $this->ajaxReturn($return_data);
        }
        //检验password是否存在
        if (!$_POST['password']) {
            $return_data = array();
            $return_data['errorCode'] = 1;
            $return_data['msg'] = '参数不足：password';

            $this->ajaxReturn($return_data);
        }
        //检验password_again是否存在
        if (!$_POST['password_again']) {
            $return_data = array();
            $return_data['errorCode'] = 1;
            $return_data['msg'] = '参数不足：password_again';

            $this->ajaxReturn($return_data);
        }
        //检验两次密码是否正确
        if ($_POST['password'] != $_POST['password_again']) {
            $return_data = array();
            $return_data['error_code'] = 2;
            $return_data['msg'] = '两次密码不一致';

            $this->ajaxReturn($return_data);
        } 
        else {//检验用户手机号是否已经注册
            // dump('两次密码正确');
            $where = array();
            $where['phone'] = $_POST['phone'];

            $User = M('User');
            $user = $User->where($where)->find();
            
            if($user){
                $return_data = array();
                $return_data['error_code'] = 3;
                $return_data['msg'] = '该手机号已经被注册';

                $this->ajaxReturn($return_data);
            }
            else{//用户手机号没有注册，插入数据
                $data = array();
                $data['username'] = $_POST['username'];
                $data['phone'] = $_POST['phone'];
                $data['password'] = md5($_POST['password']);
                
                $result = $User->add($data);

                if($result){
                    //如果插入数据成功，获取数据，直接登录
                    // dump('插入成功');
                    $return_data = array();
                    $return_data['error_code'] = 0;
                    $return_data['msg'] = '注册成功';
                    $return_data['data']['user_id'] = $result;
                    $return_data['data']['username'] = $_POST['username'];
                    $return_data['data']['phone'] = $_POST['phone'];
                    $return_data['data']['face_url'] = $_POST['face_url'];

                    $this->ajaxReturn($return_data);

                }
                else{
                    //插入数据执行失败
                    $return_data = array();
                    $return_data['error_code'] = 4;
                    $return_data['msg'] = '插入失败';
                    
                    $this->ajaxReturn($return_data);
                }


            }
            
        }
    }
}
