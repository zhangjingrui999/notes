layui.use(['form', 'element'], function () {
    var form = layui.form, element = layui.element;
    var province = $(".province");
    for (var i = 0; i < provinceList.length; i++) {
        addEle(province, provinceList[i].name);
    }

    function addEle(ele, value) {
        var optionStr = "";
        optionStr = "<option value=" + value + " >" + value + "</option>";
        ele.append(optionStr);
    }

    form.render('select');

    function removeEle(ele) {
        ele.find("option").remove();
        var optionStar = "<option value=''>" + "请选择" + "</option>";
        ele.append(optionStar);
    }

    var provinceText, cityText, cityItem;
    form.on('select(province)', function (data) {
        var city = $(data.elem).parents(".layui-form-item").find(".city"),
            district = $(data.elem).parents(".layui-form-item").find(".district");
        provinceText = data.value;
        $.each(provinceList, function (i, item) {
            if (provinceText == item.name) {
                cityItem = i;
                return cityItem;
            }
        });
        removeEle(city);
        removeEle(district);
        $.each(provinceList[cityItem].cityList, function (i, item) {
            addEle(city, item.name);
        })
        form.render('select');
    })
    form.on('select(city)', function (data) {
        var district = $(data.elem).parents(".layui-form-item").find(".district");
        cityText = data.value;
        removeEle(district);
        $.each(provinceList, function (i, item) {
            if (provinceText == item.name) {
                cityItem = i;
                return cityItem;
            }
        });
        $.each(provinceList[cityItem].cityList, function (i, item) {
            if (cityText == item.name) {
                for (var n = 0; n < item.areaList.length; n++) {
                    addEle(district, item.areaList[n]);
                }
            }
        })
        form.render('select');
    })
})
