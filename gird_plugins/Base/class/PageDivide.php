<?php

/* 
 * 分页类
 */
namespace GirdPlugins\Base;
use Illuminate\Support\Facades\DB;
class PageDivide
{
    private $limit;
    private $class;
    private $sortDesc;
    private $sort;
    
    public function __construct() {
        ;
    }
    
    
    /**
     * make一个分页
     * @access public
     * @param url 当前页的url
     * @param string $message 提示信息  
     * @param string $plugin  需要额外加入的页面组件，如链接按钮等，显示在信息框底部
     * @param string $redirect  如果需要顺便跳转到某个页面，可以将其url填入，如果为空，则忽略不跳转
     * @return NULL/直接跳转
     */
    public function makePageDivide($url,$sql,$pageLimit,$class,$sort)
    {
        
    }
    
    private function setLimit()
    {
        
    }
    private function setClass()
    {
        
    }
    
    private function setSort()
    {
        
    }
    
    private function setSortDesc($bool)
    {
        $this->sortDesc = $bool;
    }
}