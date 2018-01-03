/**
 * 라이브 링콘 on/off이미지
 */
CAPP_ASYNC_METHODS.aDatasetList.push('Livelinkon');
CAPP_ASYNC_METHODS.Livelinkon = {
    __$target: $('#ec_livelinkon_campain_on'),
    __$target2: $('#ec_livelinkon_campain_off'),

    isUse: function()
    {
        if (this.__$target.length > 0 && this.__$target2.length > 0) {
            return true;
        }
        return false;
    },

    execute: function()
    {
        var sCampaignid = '';
        if (EC_ASYNC_LIVELINKON_ID != undefined) {
            sCampaignid = EC_ASYNC_LIVELINKON_ID
        }
        $.ajax({
            url: '/exec/front/Livelinkon/Campaignajax?campaign_id='+sCampaignid,
            async: false,
            success: function(data) {
                if (data == 'on') {
                    CAPP_ASYNC_METHODS.Livelinkon.__$target.removeClass('displaynone').show();
                    CAPP_ASYNC_METHODS.Livelinkon.__$target2.removeClass('displaynone').hide();
                } else if (data == 'off') {
                    CAPP_ASYNC_METHODS.Livelinkon.__$target.removeClass('displaynone').hide();
                    CAPP_ASYNC_METHODS.Livelinkon.__$target2.removeClass('displaynone').show();
                } else {
                    CAPP_ASYNC_METHODS.Livelinkon.__$target.removeClass('displaynone').hide();
                    CAPP_ASYNC_METHODS.Livelinkon.__$target2.removeClass('displaynone').hide();
                }
            }
        });
    }
};
/**
 * 비동기식 데이터 - 마이쇼핑 > 주문 카운트 (주문 건수 / CS건수 / 예전주문)
 */
CAPP_ASYNC_METHODS.aDatasetList.push('OrderHistoryCount');
CAPP_ASYNC_METHODS.OrderHistoryCount = {
    __sTotalOrder: null,
    __sTotalOrderCs: null,
    __sTotalOrderOld: null,

    __$target: $('#ec_myshop_total_orders'),
    __$target2: $('#ec_myshop_total_orders_cs'),
    __$target3: $('#ec_myshop_total_orders_old'),

    isUse: function()
    {
        if (CAPP_ASYNC_METHODS.IS_LOGIN === true) {
            if (this.__$target.length > 0) {
                return true;
            }

            if (this.__$target2.length > 0) {
                return true;
            }

            if (this.__$target3.length > 0) {
                return true;
            }
        }

        return false;
    },

    setData: function(aData)
    {
        this.__sTotalOrder = aData['total_orders'];
        this.__sTotalOrderCs = aData['total_orders_cs'];
        this.__sTotalOrderOld = aData['total_orders_old'];

    },

    execute: function()
    {
        this.__$target.html(this.__sTotalOrder);
        this.__$target2.html(this.__sTotalOrderCs);
        this.__$target3.html(this.__sTotalOrderOld);
    }
};
$(document).ready(function()
{
	CAPP_ASYNC_METHODS.init();
});
$(document).ready(function(){
    main();
    layout();
    header();
    remove();
    about();
    nav();
    shop_animate();
});

$(window).load(function(){
    setTimeout(function(){
        $('#load').hide();
    },350);

    /*
    $('#main .scroll_down').animate({top : $(window).height() - 150} , 2500 , 'easeOutBounce');
    */
});

$(window).resize(function(){
    $('#logo').css({ 'left' : ($(window).width() - $('#logo a').width()) / 2 });
    $('#main .scroll_down').css({top : $(window).height() - 150});
    $('#main ul li').eq(0).css({ 'min-height' : $(window).height() , 'overflow':'hidden'});
});

$(window).scroll(function(){
    if($(window).scrollTop() > 1000){
        $('#scroll_top').fadeIn();
    } else{
        $('#scroll_top').fadeOut();
    }
});

function about(){
    if(window.location.href.indexOf('company.html') > 0){
        $('#contents').css({'padding-top' : '0'});
        $('#wrap').css({'padding':'0'});
    }
}




function layout(){
    $('.product_list_right ul li.item').height($('.product_list_right ul li.item').width() * 1.8);
    $('#contents').css({'min-height' : $(window).height()  });
    $('#logo').css({ 'left' : ($(window).width() - $('#logo a').width()) / 2 });
    $('#scroll_top').click(function(){
        $('body,html').animate({scrollTop : '0' } , 1500 , 'easeOutQuint' );
    });
     $('.middle').each(function(){
        $(this).css({ 'position':'absolute' , 'top':'50%' , 'margin-top' : - $(this).height() / 2 , 'left':'50%' , 'margin-left' : - $(this).width() / 2});
    });
    if($('#login').length > 0 ){
        $('#contents').css({'min-height':'600px'});
   }
}

function main(){
    if($('#main').length > 0){
        $(window).load(function(){
            $('#main_sub .name').each(function(){
                $(this).height($(this).parent().height());
            });
        });
        $('#main_sub').css({'top' : $('#main ul li').eq(0).height()});
        $('#contents').css({ 'position':'absolute' , 'top':'0' , 'left':'0' , 'padding':'0'});
        $('#wrap').css({'padding':'0'});
        $('#header_wrap').css({ 'opacity':'0' , 'filter':'alpha(opacity=0)'});

        $('#footer_wrap').hide();
        $(window).resize(function(){
            $('#main_sub .name').each(function(){
                $(this).height($(this).parent().height());
            });
        });
        $(window).scroll(function(){
            if($('#main_sub').offset().top  <=  $(window).scrollTop()){
                $('#header_wrap').css({ 'opacity':'1' , 'filter':'alpha(opacity=100)'});
                $('#main_sub').css({'top' : '0'});
                $('#main').fadeTo(1,0);
                setTimeout(function(){
                    $('body').trigger('click');
                },1);
            }               
        });
        $('body').one('click',function(){
            $('body,html').animate({ 'scrollTop' : '0'},2);
        });
    }
    $('#main_sub li').hover(function(){
            $(this).stop().find('img').fadeTo(250 , 0.5);
        },function(){
            $(this).stop().find('img').fadeTo(250 , 1);
    });    
    
    $('#main .scroll_down').click(function(){
        $('#main .scroll_down').hide();
        $('#main ul li').show();
        $('body,html').animate({scrollTop : $(document).height()} , 2500 , 'easeInOutQuint');
    });
}

function header(){
	"use strict";
    $('#nav ul li .sub').each(function(){
        $(this).css({'left' : $(this).prev().position().left});
    });
    $('#nav ul li.cate').hover(function(){
        $(this).find('.sub').slideDown();
    },function(){
        $(this).find('.sub').hide();
    });
}

function remove(){
    $('p.imgArea').remove();
}

function nav(){
    var nav_url = window.location.search.replace(/[^0-9]/g,'');
    var detail_url = window.location.search.slice(23,29).replace(/[^0-9]/g,'');
    $('#nav .nav').each(function(){
            if($(this).attr('search').replace(/[^0-9]/g,'') == nav_url || $(this).attr('search').replace(/[^0-9]/g,'') == detail_url ){
                $(this).css({'border-bottom':'2px solid #000'});
            }
    });
    $('#nav .sub a').each(function(){
            if($(this).attr('search').replace(/[^0-9]/g,'') == nav_url || $(this).attr('search').replace(/[^0-9]/g,'') == detail_url){
                $(this).parent().parent().parent().prev().css({'border-bottom':'2px solid #000'});
            }
    });
}

function shop_animate(){
    if($('.product_list_wrap_outer_2').length > 0 ){
        $('#logo').css({'position':'absolute' , 'top':'0'});
        $('#nav > ul').css({'margin':'0'});
        $('#nav > ul').animate({'left':'225px'},500);

        $('#logo').delay(500).animate({ 'left':'0'},500).animate({'top':'28px'},500);
        $('#nav p.title').hide();
        $(window).resize(function(){
            $('#logo').css({'left':'0'});
        });
    }
    if($('.product_list_wrap_outer').length > 0 ){
        $('#logo').css({'position':'absolute' , 'top':'0'});
        $('#nav > ul').css({'margin':'0'});
        $('#nav > ul').css({'left' : '225px'});
        $('#logo').css({ 'left':'0' , 'top':'28px' });
        $('#nav p.title').hide();
        $(window).resize(function(){
            $('#logo').css({'left':'0'});
        });
    }
}


$(document).ready(function(){
    list();
    lookbook();
    press();
    stockist();
    collection();
});



$(window).load(function(){
    $('.product_list .box').each(function(){
        $(this).css({ 'top' : ($(this).parent().height() - $(this).height()) / 2 });
    });
});

$(window).resize(function(){
    $('.product_list .box').each(function(){
        $(this).css({ 'top' : ($(this).parent().height() - $(this).height()) / 2 });
    });
});



function list(){
    /*
    var list_title = $('#list_title img').attr( 'src' );
    $('#list_bg').css('background-image', 'url(' + list_title + ')');
    $('#list_bg').height($(window).height());
    $('#list_bg').fadeTo(1500 , 1);
    */


    if($('.product_list_wrap').length > 0 ){
        /*
        $('#contents').css({'padding-top' : $(window).height() / 2.3 });
        */
        $('#wrap').css({'padding':'0'});
        $('#header_wrap a').css({'color':'#000'});
    }


    $('.product_list .item').hover(function(){
        $(this).find('.thumb').stop().fadeTo(500 , 0.5);
        $(this).find('.box').show();
    },function(){
        $(this).find('.thumb').stop().fadeTo(500 , 1);
        $(this).find('.box').hide();
    });
    $('.product_list .box').each(function(){
        $(this).css({ 'top' : ($(this).parent().height() - $(this).height()) / 2 });
    });
    if($('.product_list_left_wrap').length > 0 ){
        $(window).scroll(function(){
            if($('.product_list_left_wrap').offset().top < $(window).scrollTop() ){
                $('.product_list_left').addClass('fix');
            }else{
                $('.product_list_left').removeClass('fix');
            }
        });
    }
}




function lookbook(){    
    $('.lookbook_list li.item').hover(function(){
            $(this).stop().fadeTo(250 , 0.5);
        },function(){
            $(this).stop().fadeTo(250 , 1);
    });    
    $('.lookbook_list li.item').click(function(){
        
        $('body,html').animate({ 'scrollTop' : '0' },450);
        $('#mask').fadeTo(250 , 0.8);
        $('#lookbook_outer').append($(this).find('.zoom').detach());
        $('#lookbook_outer').fadeIn();        
        
            $('#lookbook_outer img').click(function(){
                $('#mask , #lookbook_outer').hide();
                $('#lookbook_outer').empty();
            });
        
    });
}

function press(){
    $('.press_list li').hover(function(){
       $(this).find('img').fadeTo(250 , 0.3);
       $(this).find('.box').fadeTo(250 , 1);
    },function(){
        $(this).find('img').fadeTo(250 , 1);
        $(this).find('.box').fadeTo(250 , 0);
    });
}

function stockist(){
    $('.stockist_list li').live('click',function(){
       $('#mask').fadeTo(250 , 0.8);
       $('#stockist_list_zoom').prepend($(this).find('.popup').clone());
       $('#stockist_list_zoom').fadeTo(250 , 0.8);
       $('#stockist_list_zoom img').css({ 'margin-top' : - $('#stockist_list_zoom img').height() / 2 , 'margin-left' : - $('#stockist_list_zoom img').width() / 2 });
    });
    $('#stockist_list_zoom img').live('click',function(){
       $('#stockist_list_zoom ,#mask').hide();
       $('#stockist_list_zoom').empty();
    });
    for(var i=0; i < $('.stockist_list li.item').length ; i++){
        i += 3;
        $('.stockist_list li.item').eq(i).css({'width':'50%'});
        i += 1;
        $('.stockist_list li.item').eq(i).css({'width':'50%'});
    }
}

function collection(){
    $('.collection_list ul').css({ 'margin-top' : - $('.collection_list ul').height() / 2 });
   
}
$(document).ready(function(){

    detail_layout();
    detail_remove();
    detail_event();

    collection_detail();
    edi_detail();
});

$(window).load(function(){
    detail_layout();
});

$(window).resize(function(){
    detail_layout();
});

function detail_event(){
    $('#detail_center img').live('click',function(){
       $('body,html').animate({scrollTop : 0} , 1000 , 'easeInOutQuint');
       $('#zoom_outer').append($('#detail_center img').clone());
       $('#zoom_outer').show();
    });
    $('#zoom_outer img').live('click',function(){
        $('body,html').animate({scrollTop : 0} , 0 );
        $('#zoom_outer').hide();
        $('#zoom_outer img').remove();
    });
    $('#size li.title').click(function(){
        $(this).next().slideToggle();
    });
}

function detail_remove(){
  /*  $('#NewProductQuantityDummy').parent().css({'position':'absolute' , 'bottom' : '0' , 'opacity':'0' , 'filter':'alpha(opacity=0)' , 'height':'1' , 'line-height':'0'});*/
    $('#detail_right table tr').eq(0).hide();    
    $('.QuantityUp').attr({ 'src' : '/img/qty_up.png' });
    $('.QuantityDown').attr({ 'src' : '/img/qty_down.png' });
    $('.QuantityUp , .QuantityDown').css({ 'cursor':'pointer'});
    $('#quantity').before($('.QuantityUp').detach());
    $('#quantity').css({ 'border':'0' , 'font-size':'20px' , 'font-weight':'bold' , 'padding-left':'20px' });

}

function detail_layout(){
    if($('#detail_wrap').length > 0 ){
        $('#detail_left').css({ 'left' : $('#detail_wrap').offset().left}).width($('#detail_wrap').width() / 5);
        $('#detail_right').css({ 'left' : $('#detail_right_position').offset().left}).width($('#detail_wrap').width() / 6.5);
        $('#detail_left_bg , #detail_right_bg').height($(window).height()).width($('#detail_wrap').width() / 5);
        $('#detail_right td').eq(1).css({ 'padding-bottom':'20px' });
    }
}





function collection_detail(){
    $('#collection_detail').width($('#collection_detail img').width() * $('#collection_detail img').length );
}


function edi_detail(){
    $(window).load(function(){
        $('#edi_detail').height($('#edi_detail img').height());
    });
    $(window).resize(function(){
        $('#edi_detail').height($('#edi_detail img').height());
    });
    $('#edi_detail ul img').wrap('<li></li>');
    $('#edi_detail').height($('#edi_detail img').height());

    var edi_idx = 0;
    var edi_length = $('#edi_detail li').length - 1;

    edi_no();

    $('#edi_right_button').click(function(){
        if(edi_idx < $('#edi_detail li').length - 1){
            edi_idx += 1;
            edi_right_animate();
        }else{
            edi_idx = 0;
            edi_right_animate();
        }
    });
    $('#edi_left_button').click(function(){
        if(edi_idx == 0){
            edi_idx = edi_length;
            edi_left_animate();
        }else{
            edi_idx -= 1;
            edi_left_animate();
        }
    });


    function edi_right_animate(){
        $('#edi_detail li').eq(1).css({ 'left' : $('#edi_detail').position().left - $('#edi_detail').width() });
        $('#edi_detail ul').animate({ 'left' : '+=' + $('#edi_detail').width()},function(){
            $('#edi_detail ul').append($('#edi_detail li').eq(0).detach());
            $(this).css({ 'left' : '0' });
            $('#edi_detail li').css({'left':'0'});
            edi_no();
        });
    }

    function edi_left_animate(){
        $('#edi_detail li').eq(edi_length).css({ 'left' : $('#edi_detail').position().left + $('#edi_detail').width() });
        $('#edi_detail ul').animate({ 'left' : '-=' + $('#edi_detail').width()},function(){
            $('#edi_detail ul').prepend($('#edi_detail li').eq(edi_length).detach());
            $(this).css({ 'left' : '0' });
            $('#edi_detail li').css({'left':'0'});
            edi_no();
        });
    }

    function edi_no(){
        for(var i=0;  i < edi_length + 1; i++){
            $('#edi_detail li').eq(i).css({'z-index' : edi_length - i});
        }
    }
}
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright   2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */
jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(a,b,c,d,e){return jQuery.easing[jQuery.easing.def](a,b,c,d,e)},easeInQuad:function(a,b,c,d,e){return d*(b/=e)*b+c},easeOutQuad:function(a,b,c,d,e){return-d*(b/=e)*(b-2)+c},easeInOutQuad:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b+c;return-d/2*(--b*(b-2)-1)+c},easeInCubic:function(a,b,c,d,e){return d*(b/=e)*b*b+c},easeOutCubic:function(a,b,c,d,e){return d*((b=b/e-1)*b*b+1)+c},easeInOutCubic:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b+c;return d/2*((b-=2)*b*b+2)+c},easeInQuart:function(a,b,c,d,e){return d*(b/=e)*b*b*b+c},easeOutQuart:function(a,b,c,d,e){return-d*((b=b/e-1)*b*b*b-1)+c},easeInOutQuart:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b+c;return-d/2*((b-=2)*b*b*b-2)+c},easeInQuint:function(a,b,c,d,e){return d*(b/=e)*b*b*b*b+c},easeOutQuint:function(a,b,c,d,e){return d*((b=b/e-1)*b*b*b*b+1)+c},easeInOutQuint:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b*b+c;return d/2*((b-=2)*b*b*b*b+2)+c},easeInSine:function(a,b,c,d,e){return-d*Math.cos(b/e*(Math.PI/2))+d+c},easeOutSine:function(a,b,c,d,e){return d*Math.sin(b/e*(Math.PI/2))+c},easeInOutSine:function(a,b,c,d,e){return-d/2*(Math.cos(Math.PI*b/e)-1)+c},easeInExpo:function(a,b,c,d,e){return b==0?c:d*Math.pow(2,10*(b/e-1))+c},easeOutExpo:function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c},easeInOutExpo:function(a,b,c,d,e){if(b==0)return c;if(b==e)return c+d;if((b/=e/2)<1)return d/2*Math.pow(2,10*(b-1))+c;return d/2*(-Math.pow(2,-10*--b)+2)+c},easeInCirc:function(a,b,c,d,e){return-d*(Math.sqrt(1-(b/=e)*b)-1)+c},easeOutCirc:function(a,b,c,d,e){return d*Math.sqrt(1-(b=b/e-1)*b)+c},easeInOutCirc:function(a,b,c,d,e){if((b/=e/2)<1)return-d/2*(Math.sqrt(1-b*b)-1)+c;return d/2*(Math.sqrt(1-(b-=2)*b)+1)+c},easeInElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return-(h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g))+c},easeOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return h*Math.pow(2,-10*b)*Math.sin((b*e-f)*2*Math.PI/g)+d+c},easeInOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e/2)==2)return c+d;if(!g)g=e*.3*1.5;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);if(b<1)return-.5*h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)+c;return h*Math.pow(2,-10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)*.5+d+c},easeInBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*(b/=e)*b*((f+1)*b-f)+c},easeOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*((b=b/e-1)*b*((f+1)*b+f)+1)+c},easeInOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;if((b/=e/2)<1)return d/2*b*b*(((f*=1.525)+1)*b-f)+c;return d/2*((b-=2)*b*(((f*=1.525)+1)*b+f)+2)+c},easeInBounce:function(a,b,c,d,e){return d-jQuery.easing.easeOutBounce(a,e-b,0,d,e)+c},easeOutBounce:function(a,b,c,d,e){if((b/=e)<1/2.75){return d*7.5625*b*b+c}else if(b<2/2.75){return d*(7.5625*(b-=1.5/2.75)*b+.75)+c}else if(b<2.5/2.75){return d*(7.5625*(b-=2.25/2.75)*b+.9375)+c}else{return d*(7.5625*(b-=2.625/2.75)*b+.984375)+c}},easeInOutBounce:function(a,b,c,d,e){if(b<e/2)return jQuery.easing.easeInBounce(a,b*2,0,d,e)*.5+c;return jQuery.easing.easeOutBounce(a,b*2-e,0,d,e)*.5+d*.5+c}})
/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright   2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */
//window popup script
function winPop(url) {
    window.open(url, "popup", "width=300,height=300,left=10,top=10,resizable=no,scrollbars=no");
}
/**
 * document.location.href split
 * return array Param
 */
function getQueryString(sKey)
{
    var sQueryString = document.location.search.substring(1);
    var aParam       = {};

    if (sQueryString) {
        var aFields = sQueryString.split("&");
        var aField  = [];
        for (var i=0; i<aFields.length; i++) {
            aField = aFields[i].split('=');
            aParam[aField[0]] = aField[1];
        }
    }

    aParam.page = aParam.page ? aParam.page : 1;
    return sKey ? aParam[sKey] : aParam;
};


/**
 * paging HTML strong tag로 변형
 */
function convertPaging(){

    $('.paging ol a').each(function() {
        var sPage = $(this).text() ? $(this).text() : 1;

        if (sPage == '['+getQueryString('page')+']') {
            $(this).parent().html('<strong title="현재페이지">'+sPage+'</strong>');
        } else {
            var sHref = $(this).attr('href');
            $(this).parent().html('<a href="'+sHref+'" title="'+sPage+'페이지로 이동">'+sPage+'</a>');
        }
    });
}

$(document).ready(function(){
    // tab
    $.eTab = function(ul){
        $(ul).find('a').click(function(){
            var _li = $(this).parent('li').addClass('selected').siblings().removeClass('selected'),
                _target = $(this).attr('href'),
                _siblings = '.' + $(_target).attr('class');
            $(_target).show().siblings(_siblings).hide();
            return false
        });
    }
    if ( window.call_eTab ) {
        call_eTab();
    };
});
$.fn.extend({
    center: function() {
        this.each(function() {
            var
                $this = $(this),
                $w = $(window);
            $this.css({
                position: "absolute",
                top: ~~(($w.height() - $this.outerHeight()) / 2) + $w.scrollTop() + "px",
                left: ~~(($w.width() - $this.outerWidth()) / 2) + $w.scrollLeft() + "px"
            });
        });
        return this;
    }
});
$(function() {
    var $container = function(){/*
<div id="modalContainer">
    <iframe id="modalContent" scroll="0" scrolling="no" frameBorder="0"></iframe>
</div>');
*/}.toString().slice(14,-3);
    $('body')
    .append($('<div id="modalBackpanel"></div>'))
    .append($($container));
    function closeModal () {
        $('#modalContainer').hide();
        $('#modalBackpanel').hide();
    }
    $('#modalBackpanel').click(closeModal);
    zoom = function ($piProductNo, $piCategoryNo, $piDisplayGroup) {
        var $url = '/product/image_zoom.html?product_no=' + $piProductNo + '&cate_no=' + $piCategoryNo + '&display_group=' + $piDisplayGroup;
        $('#modalContent').attr('src', $url);
        $('#modalContent').bind("load",function(){
            $(".header .close",this.contentWindow.document.body).bind("click", closeModal);
        });
        $('#modalBackpanel').css({width:$("body").width(),height:$("body").height(),opacity:.4}).show();
        $('#modalContainer').center().show();
    }
});
