/**
 * Created by Rag_Panda on 2015/12/7.
 */
/*调用方法：
* header-msg 元素
* p-status 是否激活显示(不能多次调用，不带排队功能)
* p-msg 需要显示的信息
* p-auto-hide 是否自动隐藏
* */
$app.directive("headerMsg",function(){
    return {
        restrict:"A",
        replace:true,
        templateUrl:"/webapp/views/directive/headerMsg.html",
        scope:{
            pStatus:'@',
            pMsg:'@',
            pAutoHide:"@"
        },
        controller:function($scope,$timeout){
            $scope.hide =function(){
                $scope.pStatus=false;
            }
            if($scope.pAutoHide != false)
            {
                $timeout(function(){$scope.pStatus=false;},2000);
            }
        }
    }
});