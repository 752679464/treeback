<?php
namespace Home\Controller;

use Think\Controller;
class TestController extends BaseController {
    public function test(){
        var_dump(321);
    }	
    /**
     * 测试函数
     * @return [type] [description]
     */
    public function insert_test(){
        $Message = M('Message');
        $data = array();
        $data['user_id'] = 112;
        $data['username'] = '李四';
        $data['face_url'] = 'xxx.jpg';
        $data['content'] = '不开心';
        $data['total_likes'] = 0;
        $data['send_timestamp'] = time();

        $result = $Message->add($data);
        
        var_dump($result);

        var_dump($Message->getLastSql());

    }

}

