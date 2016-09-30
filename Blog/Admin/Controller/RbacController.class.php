<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/8/28
 * Time: 21:16
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Model;


class RbacController extends CommonController
{

    //用户列表
    public function index()
    {
        $current = 0;
        if (IS_GET) {
            $current = I("get.number", 0, 'int');
        }
        $user = D('UserRelation');
        $result = $user->relation(true)->page($current, C('PAGE_SIZE'))->select();
        $userCount = $user->count();
        $page['total'] = ceil($userCount / C('PAGE_SIZE'));
        $page['current'] = $current;
        $this->page = $page;
        $this->users = $result;
        $this->display();
    }

    public function addUser()
    {
        if (IS_POST) {
            $data['username'] = I('post.username', '');
            $data['password'] = I('post.password', '');
            $data['password'] = md5($data['password']);
            $data['email'] = I("post.email", '', "email");
            $data['remark'] = I("post.remark", '');
            $data['status'] = I("post.status", 0, 'int');
            $data['create_time'] = date("Y-m-d H:i:s");
            $data['login_time'] = date("Y-m-d H:i:s");
            $data['create_ip'] = getIp();
            $userRole = I("post.roleId");

            $user = D("User");
            if (!$user->create($data)) {
                $this->error($user->getError());
            }

            $result = $user->insertUser($data, $userRole);
            if ($result['flag']) {
                $this->success($result['msg']);
            } else {
                $this->error($result['msg']);
            }

            return;
        }

        $this->roles = M("role")->field("name,id")->select();
        layout(false);
        $this->display();
    }


    //编辑用户
    public function editUser()
    {

        $id = I("get.id", 0);
        if ($id == 0) {
            $this->error("id 错误");
        }

        if (IS_POST) {
            //实例化模型
            $user = D("User");

            //密码处理
            if (!empty(I('post.password', ''))) {
                if (I('post.password') == I("post.repassword") && preg_match('/^[\w-_]{6,25}$/', I("post.password"))) {
                    $data['password'] = md5(I("post.password"), '');
                } else {
                    $this->error("密码正确");
                }
            }

            //用户是否重复处理
            $userNameConfirm = $user->where("username='%s'", I("post.username", ''))->field('id')->find();
            if ($userNameConfirm['id'] != $id && !empty($userNameConfirm)) {
                $this->error("用户名已经被注册");
            }
            if (empty($userNameConfirm)) {
                $data['username'] = I('post.username', '');
            }

            //电子邮件是否重复处理
            $emailConfirm = $user->where("email='%s'", I("post.email", ''))->field("id")->find();
            if ($emailConfirm['id'] != $id && !empty($emailConfirm)) {
                $this->error("电子邮箱已经被注册");
            }
            if (empty($emailConfirm)) {
                $data['email'] = I("post.email", '');
            }

            //获取表单数据
            $data['remark'] = I("post.remark", '');
            $data['status'] = I("post.status", 0, 'int');
            $userRole = I('post.roleId');

            //角色表数据整理
            for ($i = 0; $i < count($userRole); $i++) {
                if (preg_match('/[\d]*/', $userRole[$i])) {
                    $userRole[$i] = array("role_id" => $userRole[$i], "user_id" => $id);
                } else {
                    return array('flag' => false, "msg" => "角色id错误");
                }
            }

            //表单数据验证

            if (!$user->create($data)) {
                $this->error($user->getError());
                var_dump($data);
                die();
            }

            //更新表单数据
            $result = $user->updateUser($id, $data, $userRole);
            if ($result['flag']) {
                $this->success($result['msg']);
            } else {
                $this->error($result['msg']);
            }
            return;
        }
        $userData = D("UserRelation")->getUserData($id);
        $this->user = $userData;

        layout(false);
        $this->display();
    }


    //删除用户
    public function removeUser()
    {
        if (IS_GET) {
            $id = I("get.id", 0, 'int');
            if ($id == 0) {
                $this->error("参数错误");
            }
            $this->id = $id;
            layout(false);
            $this->display();
        }

        if (IS_POST) {
            $id = I("post.id", 0, 'int');
            if ($id == 0) {
                $this->error("参数错误");
            }


            $result = D("user")->removeUser($id);
            if ($result['flag']) {
                $this->success($result['msg'], U("Rbac/index"));
            } else {
                $this->error($result['msg'], U("Rbac/index"));
            }
        }
    }


    //添加节点
    public function nodeList()
    {
        $data = D("Node")->getNodeList();
        $this->data = $data;
        $this->display();
    }


    //添加节点
    public function addNode()
    {
        $data['pid'] = I('get.pid', 0, 'int');
        $data['level'] = I('get.level', 1, 'int');

        if (IS_POST) {
            $data['title'] = I('post.title', '', 'strip_tags');
            $data['name'] = I('post.name', '', 'strip_tags');
            $data['sort'] = I('post.sort', '', 'int');
            $data['status'] = I('post.status', '', 'int');
            $node = D('Node');
            if (!$node->create($data)) {
                $this->error($node->getError());
            }
            $result = $node->add($data);
            if (!$result) {
                $this->error("写入失败");
            } else {
                $this->success("写入成功");
            }
            return;
        }

        $this->assign('data', $data);
        layout(false);
        $this->display();
    }


    //修改节点
    public function editNode()
    {
        $id = I('get.id', 0, 'int');
        if ($id == 0) {
            var_dump(I('get.id'));
            die();
            $this->error("节点Id错误");
        }
        $node = M('Node')->where("id=$id")->field('id,name,title,pid,status,sort')->find();
        if (IS_POST) {
            $data['title'] = I('post.title', '', 'strip_tags');
            $data['name'] = I('post.name', '', 'strip_tags');
            $data['sort'] = I('post.sort', '', 'int');
            $data['status'] = I('post.status', '', 'int');
            $node = D('Node');
            if (!$node->create($data)) {
                $this->error($node->getError());
            }
            $result = $node->where("id=$id")->save($data);
            if (!$result) {
                $this->error("写入失败");
            } else {
                $this->success("写入成功");
            }
            return;

        }
        $this->assign('data', $node);
        layout(false);
        $this->display();
    }


    //删除节点
    public function removeNode()
    {
        $id = I('get.id', 0, 'int');
        if ($id == 0) {
            $this->error("参数错误");
        }
        $result = D('node')->remove($id);
        if ($result['flag']) {
            $this->success($result['msg'], U("Rbac/nodeList"));
        } else {
            $this->error($result['msg'], U("Rbac/nodeList"));
        }
    }


    //管理员管理
    public function roleList()
    {

        //$result = D("RoleRelation")->select();
        $this->data = D("RoleRelation")->order("id asc")->select();
        $this->display();
    }

    //添加角色
    public function addRole()
    {
        $result = D("Node")->getNodeList();
        if (IS_POST) {
            $data = I("post.");
            foreach ($data['access'] as $k => $v) {
                $data['access'][$k] = explode('_', $v);
                $data['access'][$k]['node_id'] = intval($data['access'][$k][0]);
                $data['access'][$k]['level'] = intval($data['access'][$k][1]);
                unset($data['access'][$k][0]);
                unset($data['access'][$k][1]);
            }

            $roleRelation = D("RoleRelation");
            if (!$roleRelation->create($data)) {
                // print_r( $data );
                //var_dump($data['access']);
                //die();
                $this->error($roleRelation->getError());
            }
            $result = $roleRelation->Relation(true)->add($data);
            if (!$result) {
                $this->error("添加角色失败");
            } else {
                $this->success("添加角色完成");
            }
            return;
            print_r($data);
            die();
        }

        $this->data = $result;
        layout(false);
        $this->display();
    }

    //编辑角色
    public function editRole()
    {
        $id = I("get.id", 0, "int");
        if ($id == 0) {
            $this->error("id参数错误！");
        }
        if (IS_POST) {
            ;
            $roleData['status'] = I("post.status", 0, 'int');
            $roleData['id'] = $id;
            $roleData['name'] = I("post.name", '', 'string');
            $roleData['remark'] = I("post.remark", '', 'string');
            $roleData['access'] = I('post.access');
            foreach ($roleData['access'] as $k => $v) {
                $roleData['access'][$k] = explode('_', $v);
                $roleData['access'][$k]['node_id'] = intval($roleData['access'][$k][0]);
                $roleData['access'][$k]['level'] = intval($roleData['access'][$k][1]);
                $roleData['access'][$k]['role_id'] = $id;
                unset($roleData['access'][$k][0]);
                unset($roleData['access'][$k][1]);
            }
            $accessData = $roleData['access'];
            unset($roleData['access']);
            $result = D("roleRelation")->updateRole($id, $roleData, $accessData);
            if ($result['flag']) {
                $this->success($result['msg'], U("Rbac/roleList"));
            } else {
                $this->error($result['msg'], U("Rbac/roleList"));
            }

            return;
        }
        $result = D('RoleRelation')->getCurrentRole($id);
        $this->data = $result;
        layout(false);
        $this->display();
    }

    //删除角色
    public function removeRole()
    {
        $id = I("get.id");
        if (IS_POST) {
            $id = I("post.id", 0, "int");
            $result = D("RoleRelation")->removeRole($id);
            if ($result) {
                $this->success("删除成功");
            } else {
                $this->error("角色删除失败");
            }
            return;
        }
        $this->id = $id;
        layout(false);
        $this->display();
    }
}