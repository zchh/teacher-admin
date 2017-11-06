$(function() {

    var majorId = $("[name='majorId']").val();
    var typeId = $("[name='typeId']").val();

    //设置默认值
    var option = $("<option>").val("0").text("请选择专业");
    $("[name='major']").append(option);

    option = $("<option>").val("0").text("请选择类型");
    $("[name='type']").append(option);

    //绑定專業
    for (var i = 0; i < major.length; i++) {
            option = $("<option>").val(major[i].major_id).text(major[i].majorName);
            $("[name='major']").append(option);
    }
    //類型联动
    $("[name='major']").bind("change", function() {
        $("[name='type']").show();
        var code = parseInt($(this).val());
        //加载類型
        if (code > 0) {
            $("[name='type'] option:gt(0)").remove();
            for (var i = 0; i < type.length; i++) {
                if (parseInt(type[i].major_id) == code) {
                    option = $("<option>").val(type[i].typeId).text(type[i].typeName);
                    $("[name='type']").append(option);
                }
            }
        } else {
            $("[name='type'] option:gt(0)").remove();
        }

    });

    var p_province = $("[name='major'] option");
    for (var i = 0; i < p_province.length; i++) {
        if (p_province.eq(i).val() == majorId) {
            p_province.eq(i).attr("selected", "true");
            $("[name='major']").change();
        }
    }

    var c_city = $("[name='type'] option");
    for (var i = 0; i < c_city.length; i++) {
        if (parseInt(c_city.eq(i).val()) == typeId) {
            c_city.eq(i).attr("selected", "true");
        }
    }

});
