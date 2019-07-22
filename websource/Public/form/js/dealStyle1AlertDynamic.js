/**
 * Created by Huajie on 2016/11/8.
 */

function dealStyle1AlertDynamic(l){

    var node=$('#'+l.getAlertId());
    $('.wrap-box:visible').find('form[id*="Search"] input[type="button"]').eq(0).click()
    node.on('click','input[type="submit"]',function(){
        $('#'+l.getFormId()).parent().show();
        l.close(2);
        if(!l.isErr){
            $('#'+l.getFormId()).parent().find('a.close').click()
        }
    });

    node.on('click','a.close ',function(){
        $('#'+l.getFormId()).parent().show();
        l.close(2);
    });

}