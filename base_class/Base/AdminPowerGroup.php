<?php
/**
 * Created by PhpStorm.
 * User: Rag_Panda
 * Date: 2015/12/3
 * Time: 16:12
 */

namespace BaseClass\Base;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Class AdminPowerGroup
 * @package BaseClass\Base
 */
class AdminPowerGroup
{
    /**
     * @var 权限组id,构造函数的必须参数
     */
    private $group_id;
    /**
     * @var 权限数组
     */
    private $power_list;
    /**
     * @var 管理员数组
     */

    private $admin_list;

    /**
     * @var 基本信息对象（权限组表中该group_id的一条记录，即一个对象）
     */
    private $info;


    /**
     * 在权限组中查询管理员
     * @param bool|false $page
     * @return mixed
     */
    static function getAdminPowerGroup($page = false)
    {

        $data['readPower'] = DB::table("base_admin_re_power")->where("relation_power_id", "=", 4)->get();
        $base_admin_group = DB::table("base_admin_group");
        if ($page) {
            $data["GroupData"] = $base_admin_group->paginate(5);
            return $data;
        } else {
            $data["GroupData"] = $base_admin_group->get();
            return $data;
        }
    }


    /**
     * 创建一个管理员组
     * @param $group_name
     * @return AdminPowerGroup|bool
     */
    static function  add($group_name)
    {
        $groupExisted = DB::table("base_admin_group")
            ->where("group_name", "=", $group_name)
            ->first(); //查看数据库中是否存在此管理员组
        if ($groupExisted != null) {
            return false;
        };
        //不存在，则创建
        $data["group_name"] = $group_name;
        if (DB::table('base_admin_group')->insert($data)) {
            return true;
        }
    }


    /**
     * 删除这个管理员组
     * @param $group_name
     * @param $group_id
     * @return bool
     *
     */
    static function delete($group_id)
    {
        $first = DB::table("base_admin_group")
            ->where("group_id", "=", $group_id)
            ->first();
        if ($first) {
           $delete =  DB::table("base_admin_group")
                ->where("group_id", "=", $group_id)
                ->delete();
            if($delete)
            {
                return true;
            }
            return false;
        } else {
            return false;  //不存在该管理员组
        }

    }


    /**
     * 修改这个管理员组
     * @param $group_name
     * @param $group_id
     * @return bool
     */
    static function update($group_name, $group_id)
    {
        $first = DB::table("base_admin_group")
            ->where("group_id", "=", $group_id)
            ->first();
        if ($first)
        {
           $count =  DB::table("base_admin_group")
                ->where("group_id", "=", $group_id)
                ->update(["group_name" => $group_name]);
            return $count;
        } else {
            return false;  //不存在该管理员组
        }

    }

    /**
     * 查询管理权限组详情
     * @return mixed
     */
    public function moreAdminPowerGroup()
    {
        //获取该权限组信息
        $data["GroupData"] = DB::table("base_admin_group")->where("group_id", "=", $this->group_id)->get();
        //连表查询,获取该权限组的管理员信息
        $data['articleAdmin'] = DB::table("base_admin_group")
            ->leftJoin("base_admin", "admin_group", "=", "group_id")
            ->where("group_id", "=", $this->group_id)
            ->get();

        $data['checkAdmin'] = DB::table("base_admin")->get();
        $data['checkPower'] = DB::table("base_admin_power")->get();
        //连表查询，获取该权限组对应的所有权限
        $AdminPowerGroup = DB::table("base_admin_re_power")
            ->leftJoin("base_admin_power", "power_id", "=", "relation_power_id")
            ->where("relation_group_id", "=", $this->group_id)
            ->get();
        $power_ids = array();
        foreach ($AdminPowerGroup as $value) {
            $power_ids[] = $value->power_id;
        }
        $data['power_ids'] = $power_ids;  //权限id数组
        $data['AdminPowerGroup'] = $AdminPowerGroup;


        return $data;
    }


    /**
     * 按照权限组来初始化
     * @param $group_id
     */
    public function __construct($group_id)
    {
        $this->group_id = $group_id;
        $this->syncBaseInfo();
    }

    /**
     * 初始化信息，构造函数应该通过这个函数获取到信息,同步数据
     * 通过表之间的依赖关系和group_id，来获取其他几个数据成员的值
     * @return bool
     */
    public function syncBaseInfo()
    {
        $group_id = $this->group_id;
        if (DB::table("base_admin_group")
                ->where("group_id", "=", $group_id)
                ->first() == null) {
            return false;
        }

        //1.拿到该权限组的所有权限,把一个权限组对应多个权限，获取权限放入数组  $this->power_list[]
        $powerData = DB::table("base_admin_re_power")
            ->where("relation_group_id", "=", $group_id)
            ->get();

        foreach ($powerData as $value) {
            $this->power_list[] = $value->relation_power_id;
        }

        //2.拿到该权限组的所有管理员  $this->admin_list[]
        $adminData = DB::table("base_admin")
            ->where("admin_group", "=", $group_id)
            ->get();
        foreach ($adminData as $Data) {
            $this->admin_list[] = $Data->admin_id;
        }

        //3.拿到该权限组的基本信息,获取权限组表为group_id的记录   $this->info
        $this->info = DB::table("base_admin_group")
            ->where("group_id", "=", $group_id)
            ->first();

    }


    /**
     * 添加一个权限到该组
     * @param $power_id
     * @return bool
     */
    public function addPower($power_id_array)
    {

        if($power_id_array== null)
        {
            return false;  //没勾选
        }
        foreach ($power_id_array as $data) {   //$data为admin_id

            $relationExisted = DB::table("base_admin_re_power")
                ->where("relation_power_id", "=", $data)
                ->where("relation_group_id", "=", $this->info->group_id)
                ->first();
            if ($relationExisted != null) {
                return false;  //已经有这个权限组对应的这个权限
            }

            $relation["relation_power_id"] = $data;
            $relation["relation_group_id"] = $this->info->group_id;
            if(DB::table("base_admin_re_power")->insert($relation))
            {
                $this->syncBaseInfo();
                return true;

            }

        }

    }


    /**
     * 移除一个权限（不是删除）
     * @param $power_id
     * @return bool
     */
    public function removePower($power_id)
    {

        $relationExisted = DB::table("base_admin_re_power")
            ->where("relation_power_id", "=", $power_id)
            ->where("relation_group_id", "=", $this->info->group_id)
            ->delete();
        if ($relationExisted == 0) {
            return false;  //该权限或该权限组不存在
        }
        else
        {
            $this->syncBaseInfo();
            return true;

        }


    }


    /**
     * 添加一个管理员到该权限组（必须存在此管理员才行）
     * @param $admin_id
     * @return bool
     */
    public function addAdmin($admin_id_array)
    {
        if($admin_id_array == null)
        {
            return false;  //没勾选
        }
        foreach ($admin_id_array as $data) {   //$data为admin_id

            $adminExisted = DB::table("base_admin")
                ->where("admin_id", "=", $data)
                ->first();
            if ($adminExisted == null) {
                return false;
            }

            $adminUpdate = DB::table("base_admin")
                ->where("admin_id", "=",$data)
                ->update(["admin_group" => $this->info->group_id]);

            if ($adminUpdate >= 0)
             {
                $this->syncBaseInfo();
                return true;
            }

        }

    }


    /**
     * 从该权限组移除一个管理员
     * @param $admin_id
     * @return bool
     */
    static function removeAdmin($admin_id)
    {
        $adminExisted = DB::table("base_admin")
            ->where("admin_id", "=", $admin_id)
            ->first();
        if ($adminExisted == null) {
            return false;
        }
        if (DB::table("base_admin")
            ->where("admin_id", "=", $admin_id)
            ->update(["admin_group" => null])
        ) {
            return true;
        } else {
            return false;  //该管理员不存在
        }
    }


    /**
     * 管理员权限获取
     * @access public
     * @return Array 返回权限数组
     */
    public function loadAdminPowerToSession()
    {

        $powerData = DB::table("base_admin_re_power")->where("relation_group_id", "=", $this->info->group_id)->get();
        //dump($powerData);
        $returnData = [];
        foreach ($powerData as $data) {
            $returnData[] = $data->relation_power_id;
        }
        session(['admin.admin_power'=>$returnData]);



        return $returnData;
    }

    /**
     * 管理员权限检查
     *
     *
     * @access public
     * @param int powerId 权限ID
     *
     * @return 若成功，返回用户信息，失败返回false；
     */
    static function checkAdminPower($powerId)
    {
        $powerData = session("admin.admin_power");
        if ($powerData == NULL) {
            return false;
        }
        foreach ($powerData as $data) {
            if ($data == $powerId) {
                return true;
            }
        }
        return false;
    }
}