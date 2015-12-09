/**
 * Created by Rag_Panda on 2015/12/9.
 */
$app.factory("ArticleService",["$http",function($http){

    var articleData = {};
    var classData = {};
    var limit = {num:0};
    var sArticle = function(limitData)
    {
        if(undefined == limitData){limitData = limit}
        return $http.post("/api_sArticle",{query_limit:limitData});

    };
    var sClass = function(limitData)
    {
        if(undefined == limitData){limitData = this.limit}
        return $http.post("/api_sArticleClass",{query_limit:limitData}); //没打return
    };


    return {
        articleData:articleData,
        classData:classData,
        limit:limit,
        sArticle:function(limitData){
            return sArticle(limitData);
        },
        sClass:function(limitData){
            return sClass(limitData)
        },
    }

}]);
