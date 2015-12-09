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

    //文章服务
    $scope.article = {};
    $scope.article = ArticleService;

    $scope.article.flushArticle = function(){
        $scope.article.sArticle().success(function(response){

            $scope.article.articleData = response.data;

        }).error(function(response){
            $scope.showHeaderMsg = "与服务器通讯失败";
            $scope.headerMsg.status = true;
        });

    };
    $scope.article.flushClass = function (){
        $scope.article.sClass().success(function(response){

            $scope.article.classData = response.data;

        }).error(function(response){
            $scope.showHeaderMsg = "与服务器通讯失败";
            $scope.headerMsg.status = true;
        });
    };
   $scope.article.flushArticle();
    $scope.article.flushClass();

});

