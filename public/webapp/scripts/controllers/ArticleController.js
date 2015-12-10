/**
 * Created by Rag_Panda on 2015/12/7.
 */
$app.controller("ArticleController",function($scope,ArticleService,$http){


    /*
    * 刷新界面数据
    * $start 起始条数
    * $num 结束条数
    * $class 分类
    * $sort 排序
    * $search 特殊查询
    * */
    //$scope.article = ArticleService;//文章服务


    $scope.nowStatus={};
    $scope.nowStatus.url = "/sArticle";
    $scope.nowStatus.title = "查看所有文章"

    //----------------------文章服务----------------------
    $scope.article = {};
    $scope.article = ArticleService;
    $scope.article.articleData = {};//文章数据
    $scope.article.total = null ;   //总条数
    $scope.article.nowPage = null ; //当前页数
    $scope.article.totalPage = null ;   //总页数


    //刷新文章数据
    $scope.article.flushArticle = function(){
        $scope.article.sArticle().success(function(response){

            $scope.article.articleData = response.data;
            $scope.article.total = response.total;
            $scope.article.nowPage = parseInt($scope.article.limit.start/$scope.article.limit.num +1);
            $scope.article.totalPage = parseInt($scope.article.total/$scope.article.limit.num );
            if($scope.article.total%$scope.article.limit.num!=0)
            {
                $scope.article.totalPage += 1;
            }

        }).error(function(response){
            $scope.showHeaderMsg = "与服务器通讯失败";
            $scope.headerMsg.status = true;
        });

    };


    //刷新类的数据
    $scope.article.flushClass = function (){
        $scope.article.sClass().success(function(response){

            $scope.article.classData = response.data;

        }).error(function(response){
            $scope.showHeaderMsg = "与服务器通讯失败";
            $scope.headerMsg.status = true;
        });
    };
    $scope.article.changeLimit=function(limit,value) {
        $scope.article.limit[limit] = value;
        $scope.article.flushArticle();

    };

    //下一页
    $scope.article.nextPage = function()
    {
        $scope.article.limit.start += $scope.article.limit.num;
        if($scope.article.limit.start >=$scope.article.total){$scope.article.limit.start = $scope.article.total-1;}
        $scope.article.flushArticle();
    };
    //上一页
    $scope.article.previousPage = function()
    {
        $scope.article.limit.start -= $scope.article.limit.num;
        if($scope.article.limit.start <0){$scope.article.limit.start=0}
        $scope.article.flushArticle();
    };
    //----------------------------end--------------------------------
    //$scope.article.changeLimit("num",3);
    $scope.article.flushArticle();
    $scope.article.flushClass();

});

