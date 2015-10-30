<html>
    <head>
        <script src="/js/jquery-1.9.1.min.js"></script>
    </head>
    <body>
        <div class="subcategorybox">
            <ul>
                <li title="苹果">苹果</li>
                <li title="橘子">橘子</li>
                <li title="菠萝">菠萝</li>
                <li title="苹果">苹果</li>
                <li title="橘子">橘子</li>
                <li title="菠萝">菠萝</li>
                <li title="苹果">苹果</li>
                <li title="橘子">橘子</li>
                <li title="菠萝">菠萝</li>
            </ul>
        </div>
        <div class="add">
            <a href="#">添加</a>
        </div>
        <div class="showmore">
            <a href="#">显示更多</a>
        </div>
        <div>
            <input type="text" class="address" value="请输入邮箱地址"/>
            <input type="text" class="password" value="请输入邮箱密码"/>
            <input type="button" value="登录">
        </div>
    </body>
</html>
<script type="text/javascript">
    $('div.add').click(function(){
        $('ul').append("<li title='wyf'>wyf</li>");
    })
</script>

<script text="text/javascript">
    $(function(){
        $('div.address').focus(functon(){
            var txt_value = $(this).val();
            if(txt_value == "请输入邮箱地址")
            {
                $(this).val("");
            }
        });
        $('div.address').blur(functon(){
            var txt_value = $(this).val();
            if(txt_value == "")
            {
                $(this).val("请输入邮箱地址");
            }
        })
        $('div.password').focus(functon(){
            var txt_value = $(this).val();
            if(txt_value == "请输入邮箱密码")
            {
                $(this).val("");
            }
        });
        $('div.password').blur(functon(){
            var txt_value = $(this).val();
            if(txt_value == "")
            {
                $(this).val("请输入邮箱密码");
            }
        })
    });
</script>

<script type="text/javascript">
    $(function(){
        var $fruit = $('ul li:gt(5):not(:last)');
        $fruit.hide();
        var $morefruit = $('div.showmore > a');
        $morefruit.click(function(){
            if($fruit.is(":visible")){
                $fruit.hide();
                $(this).text("显示更多");
            }else{
                $fruit.show();
                $(this).text("收起");
            }
        });
    });
</script>
