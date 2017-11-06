$(function() {

    var provinceId = $("[name='provinceId']").val();
    var cityId = $("[name='cityId']").val();

    //设置默认值
    var option = $("<option>").val("0").text("请选择省");
    $("[name='province']").append(option);

    option = $("<option>").val("0").text("请选择市");
    $("[name='city']").append(option);

    //绑定省
    for (var i = 0; i < province.length; i++) {
            option = $("<option>").val(province[i].province_id).text(province[i].provinceName);
            $("[name='province']").append(option);
    }
    //市联动
    $("[name='province']").bind("change", function() {
        $("[name='city']").show();
        var code = parseInt($(this).val());
        //加载市
        if (code > 0) {
            $("[name='city'] option:gt(0)").remove();
            for (var i = 0; i < city.length; i++) {
                if (parseInt(city[i].province_id) == code) {
                    option = $("<option>").val(city[i].cityId).text(city[i].cityName);
                    $("[name='city']").append(option);
                }
            }
        } else {
            $("[name='city'] option:gt(0)").remove();
        }

    });

    var p_province = $("[name='province'] option");
    for (var i = 0; i < p_province.length; i++) {
        if (p_province.eq(i).val() == provinceId) {
            p_province.eq(i).attr("selected", "true");
            $("[name='province']").change();
        }
    }

    var c_city = $("[name='city'] option");
    for (var i = 0; i < c_city.length; i++) {
        if (parseInt(c_city.eq(i).val()) == cityId) {
            c_city.eq(i).attr("selected", "true");
        }
    }

});
