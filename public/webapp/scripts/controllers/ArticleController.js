/**
 * Created by Rag_Panda on 2015/12/7.
 */

$articleController = $app.controller("ArticleController",function($scope,$http,$location){


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

    $scope.nowStatus.title = "查看所有文章";
   // $location.path("/sArticle");




});


//项目路由
$articleController.config(["$routeProvider",function($routeProvider){
    $routeProvider.when("/",{
        templateUrl:'/webapp/views/Article/sArticle.html',
        controller:'sArticleController'
    });

    /*$routeProvider.when("/aArticle",{
        templateUrl:'/webapp/views/Article/aArticle.html',
        controller:'aArticleController'
    });*/
}]);



$articleController.controller("sArticleController",function($scope,$http){
    //----------------------文章服务----------------------


    $scope.article = {};
    $scope.article.articleData = {};//文章数据
    $scope.article.total = null ;   //总条数
    $scope.article.nowPage = null ; //当前页数
    $scope.article.totalPage = null ;   //总页数
    $scope.article.limit = {
        num:5,  //每页条数
        user:0,//传入0，可以自动判断session
        start:0,//开始点

    };

    //刷新文章数据
    $scope.article.flushArticle = function(){
        $http.post("/api_sArticle",{query_limit:$scope.article.limit}).success(function(response){

            if(response.status!=true)
            {
                $scope.headerMsg.msg = response.message;
                $scope.headerMsg.status = true;
                return ;
            }
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
        $http.post("/api_sArticleClass",{query_limit:$scope.article.limit}).success(function(response){

            if(response.status!=true)
            {
                $scope.headerMsg.msg = response.message;
                $scope.headerMsg.status = true;
                return ;
            }
            $scope.article.classData = response.data;

        }).error(function(response){
            $scope.headerMsg.msg  = "与服务器通讯失败";
            $scope.headerMsg.status = true;
        });
    };


    //改变条件
    $scope.article.changeLimit=function(limit,value) {
        $scope.article.limit[limit] = value;
        $scope.article.flushArticle();

    };
    $scope.article.sortDesc=function(){
        $scope.article.limit["desc"] = !$scope.article.limit["desc"];
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


    $scope.article.articleGroup = [];
    $scope.article.opGroup = function(articleId){

            for (var i = 0; i < $scope.article.articleGroup.length; i++)
            {
                if ($scope.article.articleGroup[i] == articleId){
                    $scope.article.articleGroup.splice(i,1);
                    return;
                }
            }
        $scope.article.articleGroup.push(articleId);

    }
    $scope.article.delete = function(article_id)
    {
        $http.post("/api_dArticle",{article_id:article_id}).success(function(response){
            $scope.article.flushArticle();
            $scope.headerMsg.msg = "删除成功";
            $scope.headerMsg.status = true;

        });

    }
    $scope.article.deleteGroup = function()
    {

        for(var i = 0; i < $scope.article.articleGroup.length;i++)
        {
            $http.post("/api_dArticle",{article_id:$scope.article.articleGroup[i]}).success(function(response){


            });
        }


        $scope.article.flushArticle();
        $scope.headerMsg.msg  = "已执行";
        $scope.headerMsg.status = true;

    }

    //$scope.article.changeLimit("num",3);
    $scope.article.flushArticle();
    $scope.article.flushClass();
    $scope.headerMsg.msg  = "已获取数据";
    $scope.headerMsg.status = true;
});
/*
$articleController.controller("aArticleController",function($scope,$http){
    $scope.articleData = {} ;
    var  ue = UE.getEditor('article_detail');
});*/