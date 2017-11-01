$(document).ready(function(){
    var url = location.pathname
    if(url.match(/home_page/g)){
        $('#color-change>.li1').addClass('active')
    }else if(url.match(/staff/g)){
        $('#color-change>.li2').addClass('active')
    }else if(url.match(/account/g)){
        $('#color-change>.li3').addClass('active')
    }else if(url.match(/set/g)){
        $('#color-change>.li4').addClass('active')
    }
});


