<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 13:57
 */

namespace BaseClass\Role;

use BaseClass\Base\AdminPowerGroup;
use Illuminate\Support\Facades\DB;

/**
 * Class Admin
 * @package BaseClass\Role
 */
class Admin
{

    /**
     * @var管理员的一条记录（即一个对象）
     */
    public $info;
    /**
     * @var管理员id
     */
    private $admin_id;

    /**
     * 参数：数组
     * @param $userData
     */
    static function login($userData)
    {
        $sessionInitData["admin_status"] = true;
        $sessionInitData["admin_id"] = $userData->admin_id;
        $sessionInitData["admin_nickname"] = $userData->admin_nickname;
        $sessionInitData["admin_group"] = $userData->admin_group;

        $admin = new AdminPowerGroup($userData->admin_group);
        $sessionInitData["admin_power"] = $admin->loadAdminPowerToSession();

        session(["admin" => $sessionInitData]);//session结构请见ReadMe文档
    }

    /**
     * 检测管理员名和密码是否正确
     * @param $user_name
     * @param $password
     * @return bool
     */
    static function loginAdminCheck($user_name, $password)
    {
        $userData = DB::table("base_admin")
            ->where("admin_username", "=", $user_name)
            ->where("admin_password", "=", md5($password))
            ->first();
        if ($userData != NULL) {
            return $userData;
        } else {
            return false;
        }
    }

    /**
     * 构造函数
     * @param $admin_id
     */
    public function __construct($admin_id)
    {
        $this->admin_id = $admin_id;
        //通过admin_id得到
        $this->syncBaseInfo();
    }

    /**
     * 同步信息函数
     * @return bool
     */
    public function syncBaseInfo()
    {
        $admin_id = $this->admin_id;
        if (DB::table('base_admin')
                ->where("admin_id", "=", $admin_id)
                ->first() == null
        ) {
            return false;
        }

        $this->info = DB::table('base_admin')->where("admin_id", "=", $admin_id)->first();//提取一条记录

    }


    /**
     * 获取管理员信息（包括其所属的权限组）和所有权限组信息
     * @param bool|false $page
     * @return mixed
     */
    static function getAdmin($page = false)
    {

        $base_admin = DB::table("base_admin")->leftJoin("base_admin_group", "admin_group", "=", "group_id");
        if ($page)  //判断是否分页
        {
            $data['articleData'] = $base_admin->paginate(5);
            $data['groupData'] = DB::table("base_admin_group")->get();
            return $data;
        } else {
            $data['articleData'] = $base_admin->get();
            $data['groupData'] = DB::table("base_admin_group")->get();
            return $data;
        }

    }

    /**
     * 获取该管理员对应的多个权限,把这些权限放进一个数组，作为返回值
     * @return array|bool
     */
    public function getAdminPower()
    {

        $adminId = $this->admin_id;
        $groupData = DB::table("base_admin")->where("admin_id", "=", $adminId)->first();
        if ($groupData != null) {
            $powerData = DB::table("base_admin_re_power")->where("relation_group_id", "=", $groupData->admin_group)->get();
            $returnData = [];
            foreach ($powerData as $data) {
                $returnData[] = $data->relation_power_id;
            }
            return $returnData;
        }
        return false;

    }

    /**
     * 添加管理员
     * @param $input
     */
    static function addAdmin($input)
    {

        $data["admin_username"] = DB::table('base_admin')->where("admin_username", "=", $input['admin_username'])->get();
        if( $data["admin_username"] != null)  //判断此用户是否已经存在
        {
            return false;
        }
        if(DB::table("base_admin")->insert($input))
        {
            return true;
        }
        return false;


    }

    /**
     * 修改管理员
     * @param $input 数组
     */
    public function updateAdmin($input)
    {
        $adminId = $this->admin_id;
       $return = DB::table("base_admin")->where("admin_id", "=", $adminId)->update([
            "admin_username" => $input['adminUserName'],
            "admin_nickname" => $input['adminNickName'],
            "admin_group" => $input['adminGroup']
        ]);
        if($return >= 0)
        {
            return true;
        }
        return false;

    }

    /**
     * 删除管理员
     * @return bool
     */
    public function delete()
    {
        $admin_id = $this->admin_id;
        //判断是否存在
        if (DB::table('base_admin')->where("admin_id", "=", $admin_id)->first() != null) {
            //不存在，再删
            if (DB::table('base_admin')->where("admin_id", "=", $admin_id)->delete()) {
                return true;
            }
            return false;

        }
        return false;
    }


}