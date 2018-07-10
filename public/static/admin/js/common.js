$(function(){

    // 打开iframe
    $('.openWindow').click(function(){
        var url = $(this).attr('url');
        var title = $(this).text();
        var size = $(this).attr('window-size');
        var width = '700px';
        var height = '450px';
        if(size){
            var sizeArr = size.split(',');
            width = sizeArr[0] + 'px';
            height = sizeArr[1] + 'px';
        }
        layer.open({
        type: 2,
        title: false,
        shade: 0.8,
        resize: false,
        area: [width, height],
        fixed: true, //不固定
        maxmin: false, //放大缩小
        content: [url,'yes'],
        });
    });


});

//提示框
function showMsg(msg,icon){
    if(!icon) icon = 1;
    layer.msg(msg,{shade:0.2,icon:icon,shift:6});
}









