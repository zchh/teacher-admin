/**
 * Created by Rag_Panda on 2015/12/7.
 */
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
            if($scope.pAutoHide != false)
            {
                $timeout(function(){$scope.pStatus=false;},2000);
            }
        }
    }
});