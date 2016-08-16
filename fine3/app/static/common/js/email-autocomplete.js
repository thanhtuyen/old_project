var email_domains = ['@c.vodafone.ne.jp',
                     '@docomo.ne.jp',
                     '@disney.ne.jp',
                     '@d.vodafone.ne.jp',
                     '@emobile.ne.jp',
                     '@excite.co.jp',
                     '@ezweb.ne.jp',
                     '@gmail.com',
                     '@hotmail.co.jp',
                     '@hotmail.com',
                     '@h.vodafone.ne.jp',
                     '@i.softbank.jp',
                     '@icloud.com',
                     '@infoseek.jp',
                     '@k.vodafone.ne.jp',
                     '@live.jp',
                     '@me.com',
                     '@mail.goo.ne.jp',
                     '@msn.com',
                     '@nifty.com',
                     '@n.vodafone.ne.jp',
                     '@outlook.com',
                     '@q.vodafone.ne.jp',
                     '@r.vodafone.ne.jp',
                     '@softbank.ne.jp',
                     '@s.vodafone.ne.jp',
                     '@t.vodafone.ne.jp',
                     '@willcom.com',
                     '@yahoo.co.jp',
                     '@ybb.ne.jp']
;
$(document).ready(function () {
    $('input[name="mail"], input[name="email"]').mailtip({
        afterselect: function (mail){
            console.log(mail);
        }
    });

});


(function ($){
    //探测oninput事件支持
    var hasInputEvent = 'oninput' in document.createElement('input'),
        ISIE9 = /MSIE 9.0;/i.test(navigator.appVersion || '');
    //字符串转正则函数
    function parseRegExp(pattern, attributes){
        var imp = /[\^\.\\\|\(\)\*\+\-\$\[\]\?]/igm;
        pattern = pattern.replace(imp, function (match){
            return '\\' + match;
        });
        return new RegExp(pattern, attributes);
    }

    //创建提示条
    var createTip = function (input, config){
        var tip = null;
        //只在第一次按键时生成列表
        if (!input.data('data-mailtip')) {
            var wrap = input.parent();
            //如果外层控件没有设置定位，就去给外层设置相对定位。
            !/absolute|relative/i.test(wrap.css('position')) && wrap.css('position', 'relative');
            //关闭自动完成
            input.attr('autocomplete', 'off');

            var offset = input.offset();
            var wrapOffset = wrap.offset();

            tip = $('<ul id="domain_candidate" class="mailtip" style="display: none; float: none; position:absolute; margin: 0; padding: 0; z-index: ' + config.zindex + '"></ul>');

            //放入DOM树
            input.after(tip);

            tip.css({
                top: offset.top - wrapOffset.top + input.outerHeight() + config.offsettop,
                left: offset.left - wrapOffset.left + config.offsetleft,
                width: config.width || input.outerWidth() - tip.outerWidth() + tip.width()
            });

            //绑定鼠标事件
            tip.delegate('li', 'mouseenter mouseleave click', function (e){
                switch (e.type) {
                    case 'mouseenter':
                        $(this).addClass('hover');
                        $('.mailtip li').removeClass('active');
                        break;
                    case 'click':
                        var mail = $(this).attr('title');
                        input.val(mail).focus();
                        config.afterselect.call(input[0], mail);
                        break;
                    case 'mouseleave':
                        $(this).removeClass('hover');
                        break;
                    default:
                        break;
                }
            });

            //点击其它地方关闭提示框
            $(document).bind('click', function (e){
                if (e.target === input[0]) return;
                tip.hide();
            });

            input.data('data-mailtip', tip);
        }

        return tip || input.data('data-mailtip');
    };

    //创建提示列表项
    var createLists = function (value, mails){
        var lists = '';
        var hasAt = /@/.test(value);
        if (hasAt) {
            var arr = value.split('@');
            if (arr.length > 2) return lists;
            if(arr[1].length ==0){
                return false;
            }
            value = arr[0];
            var regx = parseRegExp('@' + arr[1], 'i');
        }else{
            return;
        }

        value = hasAt ? value.split('@')[0] : value;

        for (var i = 0, len = mails.length; i < len; i++) {
            if (hasAt && !regx.test(mails[i])) continue;
            lists += '<li title="' + value + mails[i] + '" style="margin: 0; padding: 0; float: none;"><p>' + value + mails[i] + '</p></li>';
        }

        return lists.replace(/^<li([^>]*)>/, '<li$1 class="active">');
    };

    //改变列表激活状态
    var changeActive = function (panle, up){
        //如果提示框隐藏跳出执行
        if (panle.css('display') === 'none') return;
        var liActive = panle.find('li.active');
        if (up) {
            var liPrev = liActive.prev();
            liPrev = liPrev.length ? liPrev : panle.find('li:last');
            liActive.removeClass('active');
            liPrev.addClass('active');
        } else {
            var liNext = liActive.next();
            liNext = liNext.length ? liNext : panle.find('li:first');
            liActive.removeClass('active');
            liNext.addClass('active');
        }
    };

    //展示隐藏提示
    var toggleTip = function (val, tip, mails){
        //如果输入为空，带空格，中文字符，英文逗号，@开头，或者两个以上@直接隐藏提示
        if (!val || /[,]|[\u4e00-\u9fa5]|\s|^@/.test(val) || val.split('@').length > 2) {
            tip.hide();
        } else {
            var lists = createLists(val, mails);
            //如果返回的有列表项展开提示，否则隐藏。
            if (lists) {
                tip.html(lists).show();
            } else {
                tip.hide();
            }
        }
    };

    //调用接口
    $.fn.mailtip = function (config){
        var defaults = {
            mails: email_domains,
            afterselect: $.noop,
            width: null,
            offsettop: 0,
            offsetleft: 0,
            zindex: 1000
        };

        config = $.extend({}, defaults, config);
        config.afterselect = typeof config.afterselect === 'function' ? config.afterselect : defaults.afterselect;
        config.width = typeof config.width === 'number' ? config.width : defaults.width;
        config.offsettop = typeof config.offsettop === 'number' ? config.offsettop : defaults.offsettop;
        config.offsetleft = typeof config.offsetleft === 'number' ? config.offsetleft : defaults.offsetleft;
        config.zindex = typeof config.zindex === 'number' ? config.zindex : defaults.zindex;

        return this.each(function (){
            //缓存当前输入框对象
            var input = $(this);
            //初始提示框
            var tip = createTip(input, config);

            //绑定事件
            input.bind('keydown input propertychange', function (e){
                $('.mailtip li').removeClass('hover');
                if (e.type === 'keydown') {
                    //根据按键执行不同操作
                    switch (e.keyCode) {
                        //退格键
                        case 8:
                            //妹哦！IE9以上input事件有BUG,退格键不会触发input事件，所以就有了这个hack！
                            //if ($.browser.msie && $.browser.version >= 9) input.trigger('input');
                            break;
                        case 9:
                            tip.hide();
                            break;
                        //向上键
                        case 38:
                            changeActive(tip, true);
                            break;
                        //向下键
                        case 40:
                            changeActive(tip);
                            break;
                        //回车键
                        case 13:
                            //如果提示框隐藏跳出执行
                            if (tip.css('display') === 'none') return;
                            e.preventDefault();
                            var mail = tip.find('li.active').attr('title');
                            input.val(mail).focus();
                            tip.hide();
                            config.afterselect.call(input[0], mail);
                            break;
                        default:
                            break;
                    }
                } else {
                    if (hasInputEvent) {
                        toggleTip(input.val(), tip, config.mails);
                    } else if (e.originalEvent.propertyName === 'value') {
                        toggleTip(input.val(), tip, config.mails);
                    }
                }
            });

            //妹哦！IE9以上input事件有BUG,退格键不会触发input事件，所以就有了这个hack！
            ISIE9 && input.on('keyup', function (e){
                e.keyCode === 8 && toggleTip(input.val(), tip, config.mails);
            });
        });
    };
}(jQuery));
