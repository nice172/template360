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

    $('.ajax-confirm').click(function(){
        var _this = $(this);
        layer.confirm('确认要执行操作吗?', {icon: 3, title:false}, function(index){
            $.get(_this.attr('url'),{},function(res){
                if (res.code == 1){
                    showMsg(res.msg, 1);
                    setTimeout(() => {
                        if (res.data.reload == 1){
                            window.location.reload();
                            return;
                        }
                        if (res.url) {
                            window.location.href = res.url;
                        }
                    }, 2000);
                }else{
                    showMsg(res.msg, 2);
                    layer.close(index);
                }
            });
            
        });
    });


});

//提示框
function showMsg(msg,icon,reload){
    if(!icon) icon = 1;
    layer.msg(msg,{shade:0.2,icon:icon,shift:6});
    if(reload){
        setTimeout(() => {
           if(parent.window){
               parent.window.location.reload();
           } else{
               window.location.reload();
           }
        }, 2000);
    }
}

function closeWin(){
    setTimeout(() => {
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
    }, 2000);
}








