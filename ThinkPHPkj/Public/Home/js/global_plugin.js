var apiUrl = ctx; 
var staticUrl = staticPath; 
var facePath = staticUrl + '/IM/img/qqFace/';


(function($) {
    //瀛楃閲嶇紪鐮�
    $.extend($.string || ($.string = {}), {
        encodeHtmlEp: function(str) {
            return String(str).replace(/[&'"<>\/\\\-\x00-\x1f\x80-\xff]/g, function(r) {
                return "&#" + r.charCodeAt(0) + ";";
            });
        },
        encodeHtml: function(str) {
            return String(str).replace(/[&'"<>\/\\\-\x00-\x09\x0b-\x0c\x1f\x80-\xff]/g, function(r) {
                return "&#" + r.charCodeAt(0) + ";";
            }).replace(/ /g, "&nbsp;").replace(/\r\n/g, "<br />").replace(/\n/g, "<br />").replace(/\r/g, "<br />");
        },
        encodeScript: function(str) {
            return String(str).replace(/[\\"']/g, function(r) {
                return "\\" + r;
            }).replace(/%/g, "\\x25").replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\x01/g, "\\x01");
        },
        encodeURIComponent: function(str) {
            return encodeURIComponent(String(str));
        },
        encodeRegExp: function(str) {
            return String(str).replace(/[\\\^\$\*\+\?\{\}\.\(\)\[\]]/g, function(a, b) {
                return "\\" + a;
            });
        },
        encodeNone: function(str) {
            return String(str);
        },
        decodeHtml: function(str) {
            var m = {
                amp: '&',
                'lt': '<',
                'gt': '>',
                'quot': '"',
                'apos': "'",
                'nbsp': ' '
            };
            return String(str).replace(/&(([a-z]+)|(#([0-9]+))|(#x([0-9a-f]+)));|(\<br\s*\/*\>)/ig, function($m, $00, $w, $01, $d, $02, $h, $l) {
                if ($w) {
                    return m[$w] || $m;
                }
                if ($d) {
                    return String.fromCharCode(parseInt($d, 10));
                }
                if ($h) {
                    return String.fromCharCode(parseInt($h, 16));
                }
                /* 灞忚斀鎹㈣绗�<br><br/><br />鐨勬浛鎹�
                if ($l) {
                    return '\n';
                }*/
                return $m;
            });
        },
        encodeFormatMore: function(str, length) {
            return $.string.encodeNone($.formatMore(str, length));
        }
    });
    //闀垮害鎴彇鏂规硶锛屾澶勮皟鐢ㄤ笂鏂圭殑 $.string.encodeFormatMore(str, len), 鑰屼笉浣跨敤姝ゆ柟娉�
    $.formatMore = function(str, len) {
        var _str = String(str);
        if (_str.length > len) {
            _str = '<span title="' + _str + '">' + _str.substring(0, len) + '...<span>';
        }
        return _str;
    };


    /*
     js妯℃澘鐢熸垚鎻掍欢
     鍙傛暟锛�
     strTmpl: 妯℃澘瀛楃涓�
     data: 濉厖鐨凧SON鏁版嵁瀵硅薄

     demo:
     $.tmpl('<ul><%for(var i=0; i<items.length; ++i) { var item = items[i]; %> <li><%=$.string.encodeNone(item.name)%><%=$.string.escapeHtml(item.data)%></li> <%}%></ul>', {
     items: [{
     name: 'name1',
     data: '<script>'
     }, {
     name: 'name2',
     data: '</script>'
     }]
     });
     */
    //鐗规畩瀛楃鏀逛负 <# ... #> <#= ... #>
    $.template = function(strTmpl, data) {
        function tmpl(strTmpl) {
            // 瀛楃涓睯SON杞箟
            function sstringify(data) {
                if (typeof(JSON) !== 'undefined') {
                    return JSON.stringify(data);
                }
                var e = {
                    "\u0000": "\\u0000",
                    "\u0001": "\\u0001",
                    "\u0002": "\\u0002",
                    "\u0003": "\\u0003",
                    "\u0004": "\\u0004",
                    "\u0005": "\\u0005",
                    "\u0006": "\\u0006",
                    "\u0007": "\\u0007",
                    "\b": "\\b",
                    "\t": "\\t",
                    "\n": "\\n",
                    "\u000b": "\\u000b",
                    "\f": "\\f",
                    "\r": "\\r",
                    "\u000e": "\\u000e",
                    "\u000f": "\\u000f",
                    "\u0010": "\\u0010",
                    "\u0011": "\\u0011",
                    "\u0012": "\\u0012",
                    "\u0013": "\\u0013",
                    "\u0014": "\\u0014",
                    "\u0015": "\\u0015",
                    "\u0016": "\\u0016",
                    "\u0017": "\\u0017",
                    "\u0018": "\\u0018",
                    "\u0019": "\\u0019",
                    "\u001a": "\\u001a",
                    "\u001b": "\\u001b",
                    "\u001c": "\\u001c",
                    "\u001d": "\\u001d",
                    "\u001e": "\\u001e",
                    "\u001f": "\\u001f",
                    "\"": "\\\"",
                    "\\": "\\\\"
                };
                return '"' + data.replace(/[\s\S]/g, function(a) {
                    return (e[a] || a);
                }) + '"';
            }

            var code = ['var  ____internal  = [];', 'with (data) {', '    ____internal .push(' + strTmpl.replace(/(^|#\>)([\s\S]*?)(\<#|$)/g, function($m, $1, $2, $3) {
                return $1 + sstringify($2) + $3;
            }).replace(/\<#[\s]*=([\s\S]*?)#\>/g, function($m, $1) {
                return $1.match(/^\s*\$\.string\.encode\w+\([\s\S]*\)\s*$/) ? (', ' + $1 + ', ') : (', $.string.encodeHtml(' + $1 + '), ');
            }).replace(/\<#([\s\S]*?)#\>/g, ');\n$1\n\t ____internal .push(') + ');', '}', 'return  ____internal .join("");'].join('\n');
            var tf = new Function('data', '$', code);
            return (function(data) {
                return tf(data, $);
            });
        }

        return tmpl(strTmpl)(data);
    };

    //鑷畾涔塸ost鏂规硶
    $._post = function(url, data, callback, error) {
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (callback) {
                    callback(data);
                }
            },
            error: function(xhr, text) {
                if (xhr.responseText) {
                    $('body').append(xhr.responseText);
                }
                if (error) {
                    error(xhr, text);
                } else {
                    layer.msg($.t('global.zoneApiError'), {
                        time: 1000
                    }, function() {
                        layer.closeAll();
                    });
                    console.log(text);
                }
            }
        });
    }


    /* 閫氱敤鎻掍欢搴撶储寮� (浠ｇ爜琛�)
     * 璋冪敤鏂规硶, jqueryObj.xxx(aaa,bbb...), 濡傦細$('#aaa').report(...); 鎴栬€呮病鏈塲Query瀵硅薄鏃惰繖鏍� $.fn.xxx() 璋冪敤
     * 1銆亁ss杩囨护锛屽鎵€鏈夎緭鍏ユ鐨勫€艰繘琛岃繃婊�
     * 2銆佷妇鎶�
     * 3銆乁TC鏃堕棿杞崲
     * 4銆佽〃鎯�
     */
    $.fn.extend({
        //灞€閮╨oader
        partialLoader: function(option) {
            if (option && option === "close") {
                $(".partialLoader", this).remove();
            } else {
                $(".partialLoader", this).remove();
                this.append('<div class="partialLoader" id="partialLoader"> <img src="' + staticUrl + '/images/load2.gif"></div>');
                $(".partialLoader", this).width(this.width()).height(this.height());
                var mtop = ($(".partialLoader", this).height() - $(".partialLoader img", this).height()) / 2;
                $(".partialLoader img", this).css({
                    "margin-top": mtop + "px"
                });
            }
        },
        xss: function(s) {
            /* 杩囨护鐗规畩瀛楃 "%--`~!@#$^&*()=|{}':;',\\[\\].<>/?~锛丂#锟モ€︹€�&*锛堬級鈥斺€攟{}銆愩€戔€橈紱锛氣€濃€�'銆傦紝銆侊紵"
             * 鍙傛暟1锛氶渶瑕佽杩囨护鐨勫瓧绗︿覆锛宻tring瀛楃涓诧紝濡傦細'aaa'
             * 杩斿洖锛歴tring
             */
            var pattern = new RegExp("[<>]");
            var rs = "";
            for (var i = 0; i < s.length; i++) {
                rs = rs + s.substr(i, 1).replace(pattern, '');
            }
            return rs;
        },
        report: function(callback, self_class) {
            /* 閫氱敤涓炬姤鎻掍欢
             * 鍙傛暟1锛氭彃浠堕渶瑕佸洖璋冪殑鍑芥暟
             * 鍙傛暟2锛氬彲閫夛紝鍙紶鍏ヤ竴涓嚜瀹氫箟绫伙紝娣诲姞鍒板脊绐椾笂
             * 杩斿洖锛� string(鍘熷洜), jquery瀵硅薄锛堣Е鍙戝厓绱狅級
             */
            var $btn = $(this);
            var reportHtml = '<div class="jqss jqssn3 clearfix" style="display:block"><p><input type="radio" class="radio" value="lj" id="a1" name="jb"><label class="radio" for="a1">' + $.t('global.junkAd') + '</label></p><p><input type="radio" class="radio" value="sq" id="b1" name="jb"><label class="radio" for="b1">' + $.t('global.obscene') + '</label></p><p><input type="radio" class="radio" value="xj" id="c1" name="jb"><label class="radio" for="c1">' + $.t('global.falseWin') + '</label></p><p><input type="radio" class="radio" value="mg" id="d1" name="jb"><label class="radio" for="d1">' + $.t('global.SensitiveInfor') + '</label></p><p><input type="radio" class="radio" value="gj" id="f" name="jb"><label class="radio" for="f">' + $.t('global.PersonalAttack') + '</label></p><p><input type="radio" class="radio" value="sr" id="g" name="jb"><label class="radio" for="g">' + $.t('global.HarassOthers') + '</label></p><div class="clear"></div></div>';
            var reason = {
                lj: '鍨冨溇骞垮憡',
                sq: '娣Ы鑹叉儏',
                xj: '铏氬亣涓',
                mg: '鏁忔劅淇℃伅',
                gj: '浜鸿韩鏀诲嚮',
                sr: '楠氭壈浠栦汉'
            };
            $btn.unbind('click').click(function() {
                layer.open({
                    area: ['482px', '320px'],
                    skin: self_class,
                    title: [$.t('global.report'), 'font-size:18px;'],
                    content: reportHtml,
                    btn: $.t('global.submit'),
                    yes: function(index, layero) {
                        var intHot = reason[$("input[name='jb']:checked").val()];
                        if (intHot) {
                            callback(intHot, $btn);
                            layer.close(index);
                        } else {
                            layer.msg($.t('global.noReportContent'), {
                                time: 1000
                            });
                        }
                    }
                });
            });
        },
        convertUTC: function(time, type, format) {
            /* 閫氱敤UTC杞崲鍑芥暟
             * 鍙傛暟1锛歎TC鏃堕棿鎴�
             * 鍙傛暟2锛氳杞寲涓虹殑鏍煎紡 full,鏃狅紝time   - date.getTimezoneOffset() / 60
             * 鍙傛暟3娣卞害鑷畾涔夋牸寮� YYYY/MM/DD hh:mm:ss  YYYY-MM-DD hh:mm:ss绛夌瓑
             * 杩斿洖锛� string, 褰撳墠鎵€鍦ㄦ椂鍖烘椂闂�: 鍚勭鏍煎紡
             */
            var date = new Date(Number(time));
            var _year = date.getFullYear();
            var _month = date.getMonth() + 1;
            var _date = date.getDate();
            var _hours = date.getHours();
            var _min = date.getMinutes();
            var _sec = date.getSeconds();
            var isLongMonth = _month == 1 || _month == 3 || _month == 5 || _month == 7 || _month == 8 || _month == 10 || _month == 12;
            var isShortMonth = _month == 4 || _month == 6 || _month == 9 || _month == 11;
            var isleap = (_year % 4 === 0 && _year % 100 !== 0) || (_year % 400 === 0);
            if (type == 'time') {
                return date.getTime() - date.getTimezoneOffset() * 60000;
            }

            var currentDate = new Date();
            var cur_year = currentDate.getFullYear();
            var cur_month = prefixZero(currentDate.getMonth() + 1);
            var cur_date = prefixZero(currentDate.getDate());
            var returnType;

            // 琛ュ厖0
            function prefixZero(num) {
                num = num + "";
                if (num < 10) {
                    return 0 + num;
                }
                return num;
            }
            //灏忔椂澶т簬24
            if (_hours >= 24) {
                _hours = _hours - 24;
                _date = _date + 1;
                //鏃ユ湡澶т簬褰撴湀鏁�
                if ((isLongMonth && _date > 31) || (isShortMonth && _date > 30) || (isleap && _date > 29 && _month == 2) || (!isleap && _date > 28 && _month == 2)) {
                    _month = _month + 1;
                    if (isShortMonth) {
                        _date -= 30;
                    } else if (isleap && _month == 2) {
                        _date -= 29;
                    } else if (!isleap && _month == 2) {
                        _date -= 28;
                    } else {
                        _date -= 31;
                    }
                }
                if (_month > 12) {
                    _month = _month - 12;
                    _year = _year + 1;
                }
            }
            if (format) {
                var pY = /Y+/.exec(format), // 鍖归厤骞翠唤
                    pM = /M+/.exec(format), // 鍖归厤鏈堜唤
                    pD = /D+/.exec(format), // 鍖归厤鏃ユ湡
                    ph = /h+/.exec(format), // 鍖归厤灏忔椂
                    pm = /m+/.exec(format), // 鍖归厤鍒嗛挓
                    ps = /s+/.exec(format); // 鍖归厤绉�
                // 骞翠唤鏇挎崲
                if (pY) {
                    if (pY[0].length === 2) {
                        _year = _year.slice(2);
                    }
                    format = format.replace(pY[0], _year);
                }
                // 鏈堜唤鏇挎崲
                if (pM) {
                    if (pM[0].length === 2) {
                        _month = prefixZero(_month);
                    }
                    format = format.replace(pM[0], _month);
                }
                // 鏃ユ湡鏇挎崲
                if (pD) {
                    if (pD[0].length === 2) {
                        _date = prefixZero(_date);
                    }
                    format = format.replace(pD[0], _date);
                }
                // 灏忔椂鏇挎崲
                if (ph) {
                    if (ph[0].length === 2) {
                        _hours = prefixZero(_hours);
                    }
                    format = format.replace(ph[0], _hours);
                }
                // 鍒嗛挓鏇挎崲
                if (pm) {
                    if (pm[0].length === 2) {
                        _min = prefixZero(_min);
                    }
                    format = format.replace(pm[0], _min);
                }
                // 绉掓暟鏇挎崲
                if (ps) {
                    if (ps[0].length === 2) {
                        _sec = prefixZero(_sec);
                    }
                    format = format.replace(ps[0], _sec);
                }
                return format;
            } else {
                _month = prefixZero(_month);
                _date = prefixZero(_date);
                _hours = prefixZero(_hours);
                _min = prefixZero(_min);
                _sec = prefixZero(_sec);
                if (type == 'full') {
                    if (_year == cur_year) {
                        if (_month == cur_month && _date == cur_date) {
                            return _hours + ":" + _min;
                        } else {
                            return _month + "-" + _date + " " + _hours + ":" + _min;
                        }
                    } else {
                        return _year + "-" + _month + "-" + _date + " " + _hours + ":" + _min;
                    }
                } else {
                    if (_year == cur_year) {
                        if (_month == cur_month && _date == cur_date) {
                            return _hours + ":" + _min;
                        } else {
                            return _month + "-" + _date + " " + _hours + ":" + _min;
                        }
                    } else {
                        return _year + "-" + _month + "-" + _date + " " + _hours + ":" + _min;
                    }
                }
            }
        },
        returnTime: function(time, type, format) {
            /* 閫氱敤鏃堕棿杞崲鍑芥暟
             * 鍙傛暟1锛歎TC鏃堕棿鎴�
             * 鍙傛暟2锛氳杞寲涓虹殑鏍煎紡 full,鏃狅紝time
             * 鍙傛暟3娣卞害鑷畾涔夋牸寮� YYYY/MM/DD hh:mm:ss  YYYY-MM-DD hh:mm:ss绛夌瓑
             * 杩斿洖锛� string, 褰撳墠鎵€鍦ㄦ椂鍖烘椂闂�: 鍚勭鏍煎紡
             */
            var date = new Date(Number(time));
            var _year = date.getFullYear();
            var _month = date.getMonth() + 1;
            var _date = date.getDate();
            var _hours = date.getHours();
            var _min = date.getMinutes();
            var _sec = date.getSeconds();
            var isLongMonth = _month == 1 || _month == 3 || _month == 5 || _month == 7 || _month == 8 || _month == 10 || _month == 12;
            var isShortMonth = _month == 4 || _month == 6 || _month == 9 || _month == 11;
            var isleap = (_year % 4 === 0 && _year % 100 !== 0) || (_year % 400 === 0);
            if (type == 'time') {
                return date.getTime() - date.getTimezoneOffset() * 60000;
            }

            var currentDate = new Date();
            var cur_year = currentDate.getFullYear();
            var cur_month = prefixZero(currentDate.getMonth() + 1);
            var cur_date = prefixZero(currentDate.getDate());
            var returnType;

            // 琛ュ厖0
            function prefixZero(num) {
                num = num + "";
                if (num < 10) {
                    return 0 + num;
                }
                return num;
            }
            //灏忔椂澶т簬24
            if (_hours >= 24) {
                _hours = _hours - 24;
                _date = _date + 1;
                //鏃ユ湡澶т簬褰撴湀鏁�
                if ((isLongMonth && _date > 31) || (isShortMonth && _date > 30) || (isleap && _date > 29 && _month == 2) || (!isleap && _date > 28 && _month == 2)) {
                    _month = _month + 1;
                    if (isShortMonth) {
                        _date -= 30;
                    } else if (isleap && _month == 2) {
                        _date -= 29;
                    } else if (!isleap && _month == 2) {
                        _date -= 28;
                    } else {
                        _date -= 31;
                    }
                }
                if (_month > 12) {
                    _month = _month - 12;
                    _year = _year + 1;
                }
            }
            if (format) {
                var pY = /Y+/.exec(format), // 鍖归厤骞翠唤
                    pM = /M+/.exec(format), // 鍖归厤鏈堜唤
                    pD = /D+/.exec(format), // 鍖归厤鏃ユ湡
                    ph = /h+/.exec(format), // 鍖归厤灏忔椂
                    pm = /m+/.exec(format), // 鍖归厤鍒嗛挓
                    ps = /s+/.exec(format); // 鍖归厤绉�
                // 骞翠唤鏇挎崲
                if (pY) {
                    if (pY[0].length === 2) {
                        _year = _year.slice(2);
                    }
                    format = format.replace(pY[0], _year);
                }
                // 鏈堜唤鏇挎崲
                if (pM) {
                    if (pM[0].length === 2) {
                        _month = prefixZero(_month);
                    }
                    format = format.replace(pM[0], _month);
                }
                // 鏃ユ湡鏇挎崲
                if (pD) {
                    if (pD[0].length === 2) {
                        _date = prefixZero(_date);
                    }
                    format = format.replace(pD[0], _date);
                }
                // 灏忔椂鏇挎崲
                if (ph) {
                    if (ph[0].length === 2) {
                        _hours = prefixZero(_hours);
                    }
                    format = format.replace(ph[0], _hours);
                }
                // 鍒嗛挓鏇挎崲
                if (pm) {
                    if (pm[0].length === 2) {
                        _min = prefixZero(_min);
                    }
                    format = format.replace(pm[0], _min);
                }
                // 绉掓暟鏇挎崲
                if (ps) {
                    if (ps[0].length === 2) {
                        _sec = prefixZero(_sec);
                    }
                    format = format.replace(ps[0], _sec);
                }
                return format;
            } else {
                _month = prefixZero(_month);
                _date = prefixZero(_date);
                _hours = prefixZero(_hours);
                _min = prefixZero(_min);
                _sec = prefixZero(_sec);
                if (type == 'full') {
                    if (_year == cur_year) {
                        if (_month == cur_month && _date == cur_date) {
                            return _hours + ":" + _min;
                        } else {
                            return _month + "-" + _date + " " + _hours + ":" + _min;
                        }
                    } else {
                        return _year + "-" + _month + "-" + _date + " " + _hours + ":" + _min;
                    }
                } else {
                    if (_year == cur_year) {
                        if (_month == cur_month && _date == cur_date) {
                            return _hours + ":" + _min;
                        } else {
                            return _month + "-" + _date + " " + _hours + ":" + _min;
                        }
                    } else {
                        return _year + "-" + _month + "-" + _date + " " + _hours + ":" + _min;
                    }
                }
            }
        },
        facePackage: function(inputBox) {
            /* 閫氱敤琛ㄦ儏鍖�
             * 鍙傛暟1锛氳〃鎯呰緭鍏ユ閫夋嫨鍣紝濡傦細'aaa' (ps锛氳緭鍏ユ闇€鍚屾椂璁剧疆 id 鍜� name 灞炴€�, 涓斿悕瀛楃浉鍚�)
             * 鍙傛暟2锛氳〃鎯呭浘鐗囪矾寰勶紝濡傦細'/gaga_sns_static/IM/img/qqFace/'
             * 杩斿洖锛� null
             * 澶囨敞锛氭湭鏉ラ渶鎵╁睍鍏朵粬琛ㄦ儏鍖咃紝鏆傛椂鐢ㄩ粯璁ょ殑
             */
            var $selectBtn = $(this);
            var $inputBox = $(inputBox);
            $selectBtn.qqFace({
                assign: inputBox,
                path: facePath
            });

            var self = {
                convertData: function(str) {
                    //鎻愪氦鏁版嵁鏃惰皟鐢紝杞崲瀛樺偍鏁版嵁锛屽弬鏁帮細杈撳叆妗唙alue, string
                    str = str.replace(/\</g, '&lt;');
                    str = str.replace(/\>/g, '&gt;');
                    str = str.replace(/\n/g, '<br>');
                    //str = str.replace(/\[em_([0-9]*)\]/g,'[$1]');
                    return str;
                },
                getImg: function(str) {
                    //椤甸潰灞曠ず鏃惰皟鐢紝杞崲鏁版嵁涓鸿〃鎯呭寘鍥剧墖鎴栬浆鎹tml鏍囩锛屽弬鏁帮細寰呰浆鎹㈠唴瀹癸紝string
                    if (str && ((str.indexOf('[') != -1 && str.indexOf(']') != -1) || str.indexOf('&lt;') != -1)) {
                        var strNew = '', _html = '', _html1 = '', _html2 = '', _html3 = '';
                        strNew = str.replace(/[a-z]+\_/g, '');
                        _html = strNew.replace(/\[/g, ('<img src="' + facePath));
                        _html1 = _html.replace(/\]/g, '.gif" />');
                        _html2 = _html1.replace(/&lt;/g, '<');
                        _html3 = _html2.replace(/&gt;/g, '>');
                        return _html3;
                    } else {
                        return str;
                    }
                }
            };
            return self;
        },
        zoneDetail: function(zoneid, imgIndex, callback, others) {
            /* 鍔ㄦ€佽鎯�
             * 鍙傛暟1: 鍔ㄦ€両D
             * 鍙傛暟2: 鎵€鐐瑰嚮鍥剧墖鐨勪笅鏍�
             * 鍙傛暟3锛氬彲閫夛紝鍥炶皟鍑芥暟
             * 鍙傛暟4锛氬彲閫夛紝鍏朵粬璁剧疆锛屽寘鎷互涓嬭缃細
                      1銆乮sAcross锛屾槸鍚﹂渶瑕佽法鍔ㄦ€侊紝甯冨皵鍊�
                      2銆乮sReverse锛屾帶鍒跺乏鍙冲垏鎹㈢殑鏂瑰悜锛岄粯璁� 宸︼細涓婁竴鏉�(寮 ) 鍙筹細涓嬩竴鏉�(寮 )锛岃缃畉rue鍚庣浉鍙�
                      3銆乸hotoArr锛宑urPhoto锛岄拡瀵圭収鐗囧鍥剧墖鐨勮缃紝鍚屾椂瀛樺湪
                      4銆乻howLink, 缃《鍔ㄦ€佽鎯呭脊绐楋紝閾炬帴鏄惁瑙ｆ瀽
             * 杩斿洖锛歯ull              
             */
            var zoneId = zoneid;
            var gagaId;
            var language = 'zh-cn';
            var isLove = 0;
            var temp = '';
            var page = 1;
            var initImgIndex = imgIndex;
            var zoneTextLenght = 0;
            var returnData = {
                obj: []
            };
            var isGetComplete = true;

            //鑾峰彇妯℃澘

            if ($('#zoneDetailBox').length) {
                getDetail();
            } else {
                $.get(staticUrl + '/js/common_template.html', function(data) {
                    temp = data;
                    $('body').append(temp);
                    $('body').append('<div id="zoneDetailBox" class="hide"></div>');
                    getDetail();
                });                
            }

            //鍔犺浇鏁版嵁
            function getDetail() {
                if (isGetComplete) {
                    isGetComplete = false;
                    $._post(apiUrl + '/Zone/get', {
                        "zoneId": zoneId
                    }, function(data) {
                        isGetComplete = true;
                        if (data.success && data.obj.zone) {
                            gagaId = data.obj.zone.zoneGagaid;
                            zoneText = data.obj.zone.zoneContent ? data.obj.zone.zoneContent.replace(/\[[a-z]+\_([0-9]*)\]/g, '') : '';
                            if (others && others.curPhoto) {
                                initDetail(data, undefined, others.curPhoto);
                            } else {
                                initDetail(data);
                            }
                        } else {
                            layer.msg(data.msg || $.t('global.zoneApiError'), {
                                time: 1000
                            });
                        }
                    }, function(reason, text) {
                        isGetComplete = true;
                        layer.msg(reason.statusText, {
                            time: 1000
                        });
                    });
                }                
            }

            function initDetail(data, isReplace, curimg) {
                var $container = $('#zoneDetailBox');               
                var html = $.template($('#zone-tmpl').html(), {
                    datalist: data
                });
                language = data.obj.publishMem.membLanguage || language;
                isLove = data.obj.isLove;
                $container.html(html);
                var $zoneContent = $container.find('.detail_txt');
                var $zoneTransTxt = $container.find('.text.js_detail_trans');
                if ($.trim($zoneContent.html())) {            
                    if (others && others.showLink) {
                        $zoneContent.html($.string.decodeHtml($.IM.replace_em($zoneContent.html().replace(/\&amp;/g, '&'))));
                    } else {
                        $zoneContent.html($.IM.replace_em($zoneContent.html()));
                    }                    
                }
                if ($.trim($zoneTransTxt.html())) {
                    if (others && others.showLink) {
                        $zoneTransTxt.html($.string.decodeHtml($.IM.replace_em($zoneTransTxt.html().replace(/\&amp;/g, '&'))));
                    } else {
                        $zoneTransTxt.html($.IM.replace_em($zoneTransTxt.html()));
                    }                    
                }              
                if (isReplace) {
                    $('.common-zone-detail .layui-layer-content').html($container.html());
                    initLayerDetail(curimg);
                } else {
                    layer.open({
                        area: ['860px', '630px'],
                        type: 1,
                        title: false,
                        skin: 'common-zone-detail',
                        content: $container.html(),
                        shadeClose: true,
                        success: function() {
                            initLayerDetail(curimg);
                        },
                        cancel: function() {
                            returnData.zone_likecount = $('.common-zone-detail .detail_onlike span').html();
                            returnData.isLove = $('.common-zone-detail .detail_onlike i').hasClass('on') ? 1 : 0;
                            returnData.zone_commentcount = $('.common-zone-detail .onreply span').html();
                            if (callback) {
                                callback(returnData);
                            }                            
                        },
                        end: function() {
                            $('html').removeClass('no-scroll-overflow no-scroll-margin');
                            $('.head').removeClass('no-scroll-right no-scroll-head');
                            $('#IM').removeClass('no-scroll-right');
                        }
                    });
                }
            }

            //寮圭獥鍚勫姛鑳藉垵濮嬪寲
            function initLayerDetail(curimg) {
                if (document.documentElement.scrollHeight> document.documentElement.clientHeight) {
                   $('html').addClass('no-scroll-overflow no-scroll-margin');
                    $('.head').addClass('no-scroll-right no-scroll-head');
                    $('#IM').addClass('no-scroll-right'); 
                }                
                var $layerBox = $('.common-zone-detail .dynamic_detail');
                var $contentDiv = $layerBox.find('.detail-content-div');
                /*if (zoneText.indexOf('br/') != -1 || zoneText.length > 38) {
                    $layerBox.find('.layer_detail_content').mCustomScrollbar();
                }*/                
                $contentDiv.mCustomScrollbar();
                $layerBox.find('.layer_detail_content').mCustomScrollbar();


                //鍥剧墖灞曠ず鐩稿叧
                var $imgBox = $layerBox.find('.bd');
                var $prevCell;
                var $nextCell;
                var $bigBtn = $layerBox.find('.bigger');
                var $resetBtn = $layerBox.find('.normal');
                if (others && others.isReverse) {
                    $prevCell = $layerBox.find('.next_btn');
                    $nextCell = $layerBox.find('.prev_btn');
                } else {
                    $prevCell = $layerBox.find('.prev_btn');
                    $nextCell = $layerBox.find('.next_btn');
                }
                var $lis = $imgBox.find('.slide_item');
                if (!others || (others && !others.photoArr)) {
                    var isFirstZone = false;
                    var isLastZone = false;
                    $lis.hide();
                    $lis.eq(initImgIndex || 0).show().addClass('on');
                    $lis.eq(initImgIndex || 0).find('img').load(function() {
                        $imgBox.find('.detail-img-load').fadeOut('normal', function() {
                            $(this).remove();
                        });
                    });
                    if ($lis.length <= 1 && (!others || (others && !others.isAcross))) {
                        $prevCell.hide();
                        $nextCell.hide();
                    }
                    $prevCell.click(function() {
                        var index = $imgBox.find('.on').index() - 1;
                        if (index < 0) {
                            if (others && others.isAcross) {
                                if (isLastZone) {
                                    layer.msg($.t('global.nodata'), {
                                        time: 1000
                                    });
                                    return;
                                }
                                $._post(apiUrl + '/Zone/oneInfo', {
                                    gagaId: gagaId,
                                    zoneId: zoneId,
                                    type: -1
                                }, function(data) {
                                    if (data.success) {
                                        if (data.obj.zone) {
                                            zoneId = data.obj.zone.zoneId;
                                            initImgIndex = data.obj.imgList.length - 1;
                                            zoneText = data.obj.zone.zoneContent ? data.obj.zone.zoneContent.replace(/\[[a-z]+\_([0-9]*)\]/g, '') : '';
                                            initDetail(data, true);
                                        } else {
                                            isLastZone = true;
                                            layer.msg($.t('global.nodata'), {
                                                time: 1000
                                            });
                                        }
                                    } else {
                                        layer.msg($.t('global.zoneApiError'), {
                                            time: 1000
                                        });
                                    }
                                });
                            } else {
                                $lis.hide().removeClass('on');
                                $lis.last().show().addClass('on');
                            }
                        } else {
                            $lis.hide().removeClass('on');
                            $lis.eq(index).show().addClass('on');
                        }
                        clearImg();
                    });
                    $nextCell.click(function() {
                        var index = $imgBox.find('.on').index() + 1;
                        if (index >= $lis.length) {
                            if (others && others.isAcross) {
                                if (isFirstZone) {
                                    layer.msg($.t('global.nodata'), {
                                        time: 1000
                                    });
                                    return;
                                }
                                $._post(apiUrl + '/Zone/oneInfo', {
                                    gagaId: gagaId,
                                    zoneId: zoneId,
                                    type: 1
                                }, function(data) {
                                    if (data.success) {
                                        if (data.obj.zone) {
                                            zoneId = data.obj.zone.zoneId;
                                            initImgIndex = 0;
                                            zoneText = data.obj.zone.zoneContent ? data.obj.zone.zoneContent.replace(/\[[a-z]+\_([0-9]*)\]/g, '') : '';
                                            initDetail(data, true);
                                        } else {
                                            isFirstZone = true;
                                            layer.msg($.t('global.nodata'), {
                                                time: 1000
                                            });
                                        }
                                    } else {
                                        layer.msg($.t('global.zoneApiError'), {
                                            time: 1000
                                        });
                                    }
                                });
                            } else {
                                $lis.hide().removeClass('on');
                                $lis.first().show().addClass('on');
                            }
                        } else {
                            $lis.hide().removeClass('on');
                            $lis.eq(index).show().addClass('on');
                        }
                        clearImg();
                    });
                } else {
                    $prevCell = $layerBox.find('.prev_btn');
                    $nextCell = $layerBox.find('.next_btn');
                    var currentId = curimg;
                    $imgBox.find('.slide_item:not([imgid="' + currentId.imgid + '"])').remove();
                    $imgBox.find('.slide_item img').load(function() {
                        $imgBox.find('.detail-img-load').fadeOut('normal', function() {
                            $(this).remove();
                        });
                    });
                    var currentZoneIndex;
                    others.photoArr.forEach(function(item, i) {
                        if (item.zoneid == currentId.zoneid && item.imgid == currentId.imgid) {
                            currentZoneIndex = i;
                        }
                    });
                    var nextIndex = currentZoneIndex + 1;
                    var prevIndex = currentZoneIndex - 1;
                    if (nextIndex > others.photoArr.length - 1) {
                        nextIndex = 0;
                    }
                    if (prevIndex < 0) {
                        prevIndex = others.photoArr.length - 1;
                    }
                    $prevCell.click(function() {
                        $._post(apiUrl + '/Zone/get', {
                            zoneId: others.photoArr[prevIndex].zoneid
                        }, function(data) {
                            if (data.success) {
                                if (data.obj.zone) {
                                    zoneId = data.obj.zone.zoneId;
                                    initImgIndex = data.obj.imgList.length - 1;
                                    zoneText = data.obj.zone.zoneContent ? data.obj.zone.zoneContent.replace(/\[[a-z]+\_([0-9]*)\]/g, '') : '';
                                    initDetail(data, true, others.photoArr[prevIndex]);
                                } else {
                                    isLastZone = true;
                                    layer.msg($.t('global.nodata'), {
                                        time: 1000
                                    });
                                }
                            } else {
                                layer.msg($.t('global.zoneApiError'), {
                                    time: 1000
                                });
                            }
                        });
                        clearImg();
                    });
                    $nextCell.click(function() {
                        $._post(apiUrl + '/Zone/get', {
                            zoneId: others.photoArr[nextIndex].zoneid
                        }, function(data) {
                            if (data.success) {
                                if (data.obj.zone) {
                                    zoneId = data.obj.zone.zoneId;
                                    initImgIndex = data.obj.imgList.length - 1;
                                    zoneText = data.obj.zone.zoneContent ? data.obj.zone.zoneContent.replace(/\[[a-z]+\_([0-9]*)\]/g, '') : '';
                                    initDetail(data, true, others.photoArr[nextIndex]);
                                } else {
                                    isLastZone = true;
                                    layer.msg($.t('global.nodata'), {
                                        time: 1000
                                    });
                                }
                            } else {
                                layer.msg($.t('global.zoneApiError'), {
                                    time: 1000
                                });
                            }
                        });
                        clearImg();
                    });
                }
                $bigBtn.click(function() {
                    var $thisImg;
                    if (others && others.photoArr) {
                        $thisImg = $layerBox.find('.slide_item img');
                    } else {
                        $thisImg = $layerBox.find('.slide_item.on img');
                    }                    
                    var oldUrl = $thisImg.attr('src');
                    var bigUrl = oldUrl.split('?')[0];
                    $resetBtn.attr({
                        'data-url': oldUrl,
                        'data-i': $thisImg.closest('.slide_item').attr('imgid')
                    });
                    $thisImg.attr('src', bigUrl);
                    $thisImg.css({
                        'position': 'relative',
                        'left': 0,
                        'top': 0
                    });
                    $thisImg.addClass('primal-size');
                    var oBoolean = false,
                        oLeftSpace = 0,
                        oTopSpace = 0;
                    $thisImg.mousemove(function(e) {
                        if (oBoolean) {
                            $thisImg.css({
                                'left': e.clientX - oLeftSpace,
                                'top': e.clientY - oTopSpace
                            });
                            return false;
                        }
                    });
                    $thisImg.mousedown(function(e) {
                        mStart();
                    }).mouseup(function(e) {
                        mEnd();
                    });
                    $imgBox.mouseleave(function() {
                        mEnd();
                    });
                    $bigBtn.addClass('hide');
                    $resetBtn.removeClass('hide');

                    function mStart() {
                        oBoolean = true;
                        if (oBoolean) {
                            oLeftSpace = window.event.clientX - Number($thisImg.css('left').replace('px', ''));
                            oTopSpace = window.event.clientY - Number($thisImg.css('top').replace('px', ''));
                        }
                    }

                    function mEnd() {
                        oBoolean = false;
                    }
                });
                $resetBtn.click(function() {
                    if ($(this).attr('data-url') && $(this).attr('data-i')) {
                        var $targetImg = $layerBox.find('[imgid="' + $(this).attr('data-i') + '"] img');
                        $targetImg.attr('src', $(this).attr('data-url'));
                        clearImg();
                    }
                });

                function clearImg() {
                    $resetBtn.attr({
                        'data-url': '',
                        'data-i': ''
                    });
                    $layerBox.find('.slide_item img').removeClass('primal-size').css({
                        'position': 'relative',
                        'left': 0,
                        'top': 0
                    }).unbind('mousemove').unbind('mousedown').unbind('mouseup');
                    $bigBtn.removeClass('hide');
                    $resetBtn.addClass('hide');
                }

                //鍔ㄦ€佺炕璇戜笌灞曠ず
                var $transBtn = $layerBox.find('.dt_tranS_btn');
                var $langae = $transBtn.find('.language_obj_detail li');
                var $transBox = $layerBox.find('.detail_info .detail_trans');
                if ($transBtn && $transBtn.attr('istrans') == 0) {
                    $langae.unbind('click').click(function() {
                        var transType = $(this).attr('langs-lang');
                        $.fn.checkTrans($layerBox.find('.detail_txt').html(), function() {
                            $transBtn.addClass('trans_londing');
                            $._post(apiUrl + '/Zone/translate', {
                                zoneId: zoneId,
                                translatType: transType
                            }, function(data) {                                                            
                                if (data.success) {
                                    returnData.zoneTrans = data.obj;
                                    layer.msg($.t('global.zoneApiSucc'), {
                                        time: 1000
                                    });
                                    if (zoneText.indexOf('br/') != -1 || zoneText.length > 37) {
                                        $layerBox.find('.layer_detail_content').mCustomScrollbar();
                                    }
                                    if (data.obj.zotrCompletime) {
                                       $transBox.removeClass('hide').find('.text').html($.IM.replace_em(data.obj.zotrTranslathigh || data.obj.zotrTranslat)); //data.obj.zmtrTranslathigh || data.obj.zmtrTranslat                                    
                                       $transBtn.remove(); 
                                       $transBtn.removeClass('trans_londing'); 
                                    } else {
                                        $transBtn.find('.language_obj_detail').remove();
                                    }                                    
                                    $transBtn.attr('istrans', '1');
                                } else {
                                    $transBtn.removeClass('trans_londing');
                                    layer.msg($.t('global.zoneApiError'), {
                                        time: 1000
                                    });
                                }
                            }, function() {
                                $transBtn.removeClass('trans_londing');
                                layer.msg($.t('global.zoneApiError'), {
                                    time: 1000
                                });
                            });
                        });
                    });
                }
                if ($transBtn && $transBtn.attr('istrans') == 1) {
                    $transBtn.click(function() {
                        if (zoneText.indexOf('br/') != -1 || zoneText.length > 37) {
                            $layerBox.find('.layer_detail_content').mCustomScrollbar();
                        }
                        if ($transBox.is(':visible')) {
                            $transBox.addClass('hide');
                        } else {
                            $transBox.removeClass('hide');
                        }
                    });
                }

                //鐐硅禐銆佸彇娑堢偣璧�
                var lickBtn = $layerBox.find('.detail_onlike i');
                var lickCount = $layerBox.find('.detail_onlike span');
                lickBtn.unbind('click').click(function() {
                    var likeApi = isLove == 0 ? '/Zone/love' : '/Zone/cancelLove';
                    if (isLove == 0) {
                        $.zone.likeAct($(this));
                    }
                    $._post(apiUrl + likeApi, {
                        zoneId: zoneId
                    }, function(data) {
                        if (data.success) {
							/*
                            layer.msg($.t('global.zoneApiSucc'), {
                                time: 1000
                            });*/
                            if (isLove == 0) {
                                isLove = 1;
                                lickBtn.addClass('on');
                                lickCount.html(Number(lickCount.html()) + 1);
                            } else {
                                isLove = 0;
                                lickBtn.removeClass('on');
                                lickCount.html(Number(lickCount.html()) - 1);
                            }
                        } else {
                            layer.msg($.t('global.zoneApiError'), {
                                time: 1000
                            });
                        }
                    });
                });

                //涓炬姤
                var $reportBtn = $layerBox.find('.report');
                $reportBtn.report(function(_reason) {
                    var reportData = {
                        type: 'Z',
                        id: zoneId,
                        reason: _reason
                    };
                    $._post(apiUrl + '/Report/report', reportData, function(data) {
                        layer.msg($.t('global.zoneApiSucc'), {
                            time: 1000
                        });
                    }, function(request, errorText) {
                        layer.msg($.t('global.zoneApiError'), {
                            time: 1000
                        });
                    });
                }, 'other-zone-report');

                //璇勮鍒濆鍖栵紝浠ュ強鍔犺浇鏇村detail_comment
                var $detailBox = $layerBox.find('.detail_comment');
                var $subReply = $layerBox.find('.comment-temp .comment_item');
                var $moreComment = $layerBox.find('.detail_more');
                var isLast = false;
                //$detailBox.mCustomScrollbar();
                if ($.trim($detailBox.html())) {
                    $subReply.each(function() {
                        var parentId = $(this).attr('parent-id');
                        var parentItem = $detailBox.find('.comment_item[zoco-id="' + parentId + '"]');
                        var nextItem = parentItem.next();
                        if (nextItem.hasClass('sub')) {
                            parentItem.nextAll('.sub[parent-id="' + parentId + '"]:last').after($(this));
                        } else {
                            parentItem.after($(this));
                        }
                    });
                    $detailBox.find('.reply-name').each(function() {
                        var parentId = $(this).attr('parent-id');
                        var parentName = $detailBox.find('.user_home[zoco-id="' + parentId + '"]').html();
                        $(this).html(parentName);
                    });
                } else {
                    $detailBox.addClass('hide');
                }
                if ($detailBox.find('.comment_item').length < 10) {
                    $moreComment.addClass('hide');
                } else {
                    $moreComment.removeClass('hide');
                }
                $moreComment.click(function() {
                    if (isLast) {
                        layer.msg($.t('zone.nomorecomment'), {
                            time: 1000
                        });
                        $moreComment.addClass('hide');
                        return;
                    }
                    var itemNum = $detailBox.find('.comment_item').length - $detailBox.find('.comment_item.new').length;
                    $._post(apiUrl + '/ZoneComment/list', {
                        zoneId: zoneId,
                        pageNum: Math.ceil(itemNum / 10 + 1)
                    }, function(data) {
                        if (data.success && data.obj.length > 0) {
                            var comData = {
                                attributes: {
                                    imgUrlPre: data.attributes.imgUrlPre
                                },
                                obj: []
                            };
                            var replyData = {
                                attributes: {
                                    imgUrlPre: data.attributes.imgUrlPre
                                },
                                obj: []
                            };
                            comData.obj = $.grep(data.obj, function(item) {                               
                                return !item.zoco_parentid && !$detailBox.find('.comment_item[zoco-id="' + item.zoco_id + '"]').length;
                            });
                            replyData.obj = $.grep(data.obj, function(item) {
                                return item.zoco_parentid && !$detailBox.find('.comment_item[zoco-id="' + item.zoco_id + '"]').length;
                            });
                            var $newDetailBox = $detailBox;
                            if (comData.obj.length) {
                                var comHtml = $.template($('#zoneDetail-commont-temp').html(), {
                                    datalist: comData
                                });                            
                                $(comHtml).each(function(i, n) {
                                    if ($(n).hasClass('comment_item')) {
                                        if ($newDetailBox.find('.r.new').length) {
                                            $newDetailBox.find('.r.new:first').before(n);
                                        } else {
                                            $newDetailBox.append(n);
                                        }
                                    }                                
                                });      
                            }                            
                            var replyHtml = $.template($('#zoneDetail-reply-temp').html(), {
                                datalist: replyData
                            });
                            $layerBox.find('.comment-temp').html(replyHtml);
                            $layerBox.find('.comment-temp .comment_item').each(function() {
                                var parentId = $(this).attr('parent-id');
                                var parentItem = $newDetailBox.find('.comment_item[zoco-id="' + parentId + '"]');
                                var nextItem = parentItem.next();
                                if (nextItem.hasClass('sub')) {
                                    var $lastReply = parentItem.nextAll('.sub[parent-id="' + parentId + '"]:last')
                                    if ($lastReply.hasClass('new')) {
                                        $lastReply.before($(this));
                                    } else {
                                        $lastReply.after($(this));
                                    }                                    
                                } else {
                                    parentItem.after($(this));
                                }
                            });
                            $newDetailBox.find('.reply-name').each(function() {
                                var parentId = $(this).attr('parent-id');
                                var parentName = $newDetailBox.find('.user_home[zoco-id="' + parentId + '"]').html();
                                $(this).html(parentName);
                            });

                            initComTrans();
                            //$contentDiv.mCustomScrollbar('scrollTo', 'bottom');
                            if (data.obj.length < 10) {
                                isLast = true;
                                $moreComment.addClass('hide');
                            }
                        } else {
                            isLast = true;
                            $moreComment.addClass('hide');
                            layer.msg($.t('zone.nomorecomment'), {
                                time: 1000
                            });
                        }
                    });
                });

                //璇勮缈昏瘧涓庡睍绀�
                initComTrans();

                function initComTrans() {
                    var $transBtn2 = $layerBox.find('.dt_tranS_btn2');
                    $transBtn2.each(function() {
                        var $thisTrans = $(this);
                        if ($(this).attr('istrans') == 0) {
                            var $langae2 = $thisTrans.find('.language_obj_detail');
                            $langae2.find('li').unbind('click').click(function() {
                                var transType = $(this).attr('langs-lang');
                                var $thisStransBtn = $(this).closest('.dt_tranS_btn2');
                                var $transBox2 = $thisTrans.parent().next();
                                var zocoId = $thisStransBtn.attr('zoco-id');
                                $.fn.checkTrans($thisStransBtn.prev('span').html(), function() {
                                    $thisStransBtn.addClass('sub_trans_londing');
                                    $._post(apiUrl + '/ZoneComment/translate', {
                                        zocoId: zocoId,
                                        translatType: transType
                                    }, function(data) {                                        
                                        if (data.success) {
                                            layer.msg($.t('global.zoneApiSucc'));
                                            if (data.obj.zmtrCompletime) {
                                                $transBox2.removeClass('hide').html(data.obj.zmtrTranslathigh || data.obj.zmtrTranslat);
                                                $thisStransBtn.remove();                                                
                                            } else {           
                                                $thisStransBtn.find('.language_obj_detail').remove();                                     
                                            }                                                                                                                        
                                            $thisStransBtn.attr('istrans', '1');

                                            returnData.comTrans = returnData.comTrans || [];
                                            returnData.comTrans.push(data.obj);
                                        } else {
                                            $thisStransBtn.removeClass('sub_trans_londing');
                                            layer.msg($.t('global.zoneApiError'), {
                                                time: 1000
                                            });
                                        }
                                    }, function() {
                                        $thisStransBtn.removeClass('sub_trans_londing');
                                        layer.msg($.t('global.zoneApiError'), {
                                            time: 1000
                                        });
                                    });
                                });
                            });
                            $(this).hover(function() {
                                if ($(this).position().left >= 100) {
                                    var _left = Math.ceil($(this).position().left) - 100;
                                    $langae2.css('left', (-30 - _left + 'px'));
                                    $langae2.find('.lanI').css('left', (_left + 30 + 'px'));
                                }
                            }, function() {

                            });
                        }
                        if ($(this).attr('istrans') == 1) {
                            $(this).click(function() {
                                var $transBox2 = $(this).parent().next();
                                if ($transBox2.is(':visible')) {
                                    $transBox2.addClass('hide');
                                } else {
                                    $transBox2.removeClass('hide');
                                }
                            });
                        }
                    });
                }

                //璇勮鍒犻櫎
                var delNum = 0;
                $layerBox.find('.detail_comment').delegate('.del_comment', 'click', function() {
                    var delId = $(this).attr('del-id');
                    var $comItem = $(this).closest('.comment_item');
                    $._post(apiUrl + '/ZoneComment/delete', {
                        zocoId: delId
                    }, function(data) {
                        if (data.success) {
                            $layerBox.find('.detail_comment').find('.comment_item[zoco-id="' + delId + '"]').remove();
                            $layerBox.find('.detail_comment').find('.comment_item[parent-id="' + delId + '"]').remove();
                            //layer.msg($.t('global.zoneApiSucc'));
                            if (!$comItem.hasClass('sub')) {
                                $commentNum.html(Number($commentNum.html()) - 1);
                            }
                            returnData.delArr = returnData.delArr || [];
                            returnData.delArr.push(delId);
                        } else {
                            layer.msg($.t('global.zoneApiError'), {
                                time: 1000
                            });
                        }
                    });
                });

                //瀵瑰姩鎬佽瘎璁�
                var $detailPushBtn = $layerBox.find('.detail_comment_input');
                var $detailPushBox = $layerBox.find('.reply_box');
                var $pushInput = $detailPushBox.find('textarea');
                var $commentNum = $layerBox.find('.detail_info .onreply span');
                var $textLeng = $layerBox.find('.reply-lens');
                $layerBox.find('.detail_info .onreply').click(function() {
                    detailZonePush($(this).attr('zone-id'));
                });
                $layerBox.find('.detail_comment_input').click(function() {
                    detailZonePush($(this).attr('zone-id'));
                });

                //瀵硅瘎璁虹殑鍥炲
                $layerBox.find('.detail_comment').delegate('.dt_reply_btn2', 'click', function() {
                    detailZonePush($(this).attr('reply-id'), 'reply');
                });


                function detailZonePush(id, type) {
                    $detailPushBtn.hide();
                    $detailPushBox.removeClass('hide');
                    $pushInput.blur(function() {
                        if ($pushInput.val() === '') {
                            $detailPushBtn.show();
                            $detailPushBox.addClass('hide');
                        }
                    }).keyup(function() {
                        var val = $pushInput.val();
                        if ($.trim(val)) {
                            if (val.length >= 240) {
                                $pushInput.val(val.substring(0, 240));
                            }
                            $textLeng.html($pushInput.val().length + '/240');
                        } else {
                            $pushInput.val('');
                            $textLeng.html('0/240');
                        }
                    }).focus();
                    var $pushBtn = $layerBox.find('.reply_send');
                    $pushBtn.unbind('click').click(function() {
                        var value = $.fn.xss($pushInput.val());
                        if (value) {
                            $._post(apiUrl + '/ZoneComment/publish', {
                                zoneId: zoneId,
                                zocoParentid: type == 'reply' ? id : undefined,
                                content: value
                            }, function(data) {
                                if (data.success) {
                                    if ($detailBox.is(':hidden')) {
                                        $detailBox.removeClass('hide');
                                    }
                                    var comData = {
                                        attributes: data.attributes,
                                        obj: [data.obj]
                                    };
                                    returnData.attributes = data.attributes;
                                    returnData.obj.push(data.obj);
                                    var newOne;
                                    if (type == 'reply') {
                                        var replyHtml = $.template($('#zoneDetail-reply-temp').html(), {
                                            datalist: comData
                                        });
                                        newOne = $(replyHtml).addClass('new');
                                        var $newDetailBox = $detailBox;
                                        $layerBox.find('.comment-temp').html(newOne);
                                        $layerBox.find('.comment-temp .comment_item').each(function() {
                                            var parentId = $(this).attr('parent-id');
                                            var parentItem = $newDetailBox.find('.comment_item[zoco-id="' + parentId + '"]');
                                            var nextItem = parentItem.next();
                                            if (nextItem.hasClass('sub')) {
                                                parentItem.nextAll('.sub[parent-id="' + parentId + '"]:last').after($(this));
                                            } else {
                                                parentItem.after($(this));
                                            }
                                        });
                                        $newDetailBox.find('.reply-name').each(function() {
                                            var parentId = $(this).attr('parent-id');
                                            var parentName = $newDetailBox.find('.user_home[zoco-id="' + parentId + '"]').html();
                                            $(this).html(parentName);
                                        });
                                    } else {
                                        var comHtml = $.template($('#zoneDetail-commont-temp').html(), {
                                            datalist: comData
                                        });
                                        newOne = $(comHtml).addClass('new');
                                        $layerBox.find('.detail_comment').append(newOne);
                                        $commentNum.html(Number($commentNum.html()) + 1);
                                    }
                                    initComTrans();
                                    $contentDiv.mCustomScrollbar('scrollTo', 'bottom');
                                    //layer.msg($.t('global.zoneApiSucc'));
                                    $detailPushBox.addClass('hide');
                                    $pushInput.val('');
                                    $textLeng.html('0/240');
                                    $detailPushBtn.show();
                                } else { //$.t('global.zoneApiError')
                                    layer.msg(data.msg, {
                                        time: 1000
                                    });
                                }
                            });
                        }
                    });
                }

            }
        },
        uploadImg: function(callback) {
            var BASE_URL = '..';
            var isUp = true,

                $wrap = $('#uploader'),

                // 鍥剧墖瀹瑰櫒
                $queue = $('<ul class="filelist"></ul>').appendTo($wrap.find('.queueList')),

                // 鐘舵€佹爮锛屽寘鎷繘搴﹀拰鎺у埗鎸夐挳
                $statusBar = $wrap.find('.statusBar'),

                // 鏂囦欢鎬讳綋閫夋嫨淇℃伅銆�
                $info = $wrap.find('.info'),

                // 涓婁紶鎸夐挳
                $upload = $wrap.find('.uploadBtn'),

                // 娌￠€夋嫨鏂囦欢涔嬪墠鐨勫唴瀹广€�
                $placeHolder = $wrap.find('.placeholder'),

                // 鎬讳綋杩涘害鏉�
                $progress = $statusBar.find('.progress').hide(),

                // 娣诲姞鐨勬枃浠舵暟閲�
                fileCount = 0,

                //鍓╀綑涓婁紶鐨勬暟閲�
                fileSurplus = 9,

                // 娣诲姞鐨勬枃浠舵€诲ぇ灏�
                fileSize = 0,

                // 浼樺寲retina, 鍦╮etina涓嬭繖涓€兼槸2
                ratio = window.devicePixelRatio || 1,

                // 缂╃暐鍥惧ぇ灏�
                thumbnailWidth = 78 * ratio,
                thumbnailHeight = 78 * ratio,

                // 鍙兘鏈塸edding, ready, uploading, confirm, done.
                state = 'pedding',

                // 鎵€鏈夋枃浠剁殑杩涘害淇℃伅锛宬ey涓篺ile id
                percentages = {},
                token, key,

                supportTransition = (function() {
                    var s = document.createElement('p').style,
                        r = 'transition' in s ||
                        'WebkitTransition' in s ||
                        'MozTransition' in s ||
                        'msTransition' in s ||
                        'OTransition' in s;
                    s = null;
                    return r;
                })(),

                // WebUploader瀹炰緥
                uploader;

            if (!WebUploader.Uploader.support()) {
                alert('Web Uploader 涓嶆敮鎸佹偍鐨勬祻瑙堝櫒锛佸鏋滀綘浣跨敤鐨勬槸IE娴忚鍣紝璇峰皾璇曞崌绾� flash 鎾斁鍣�');
                throw new Error('WebUploader does not support the browser you are using.');
            }
            if (uploader) {
                uploader.destroy();
            }
            // 瀹炰緥鍖�
            uploader = WebUploader.create({
                auto: false,
                pick: {
                    id: '#filePicker',
                    label: ''
                },
                dnd: '#uploader .queueList',
                paste: document.body,
                thumb: {
                    quality: 100
                },
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                },

                // swf鏂囦欢璺緞
                swf: staticPath + 'js/Uploader.swf',

                disableGlobalDnd: true,

                chunked: true,
                server: 'http://up.qiniu.com/',
                fileNumLimit: 9,
                fileSizeLimit: 50 * 1024 * 1024, // 
                fileSingleSizeLimit: 5 * 1024 * 1024 // 5 M
            });

            // 娣诲姞鈥滄坊鍔犳枃浠垛€濈殑鎸夐挳锛�
            uploader.addButton({
                id: '#filePicker2',
                label: '缁х画娣诲姞'
            });

            // 褰撴湁鏂囦欢娣诲姞杩涙潵鏃舵墽琛岋紝璐熻矗view鐨勫垱寤�
            function addFile(file) {
                if ($queue.find("li").size() >= 8) {
                    $("#filePicker2").hide();
                } else {
                    $("#filePicker2").show();
                }
                var $li = $('<li id="' + file.id + '">' +
                        '<p class="title">' + file.name + '</p>' +
                        '<p class="imgWrap"></p>' +
                        '<p class="progress"><span></span></p>' +
                        '</li>'),

                    $btns = $('<div class="file-panel">' +
                        '<span class="cancel">鍒犻櫎</span>').appendTo($li),
                    $prgress = $li.find('p.progress span'),
                    $wrap = $li.find('p.imgWrap'),
                    $info = $('<p class="error"></p>'),

                    showError = function(code) {
                        switch (code) {
                            case 'exceed_size':
                                text = $.t('global.uploadBig');
                                break;

                            case 'interrupt':
                                text = $.t('global.uploadHold');
                                break;

                            default:
                                text = $.t('global.uploadfailed');
                                break;
                        }

                        $info.text(text).appendTo($li);
                    };

                if (file.getStatus() === 'invalid') {
                    showError(file.statusText);
                } else {
                    // @todo lazyload
                    $wrap.text('棰勮涓�');
                    uploader.makeThumb(file, function(error, src) {
                        if (error) {
                            $wrap.text('涓嶈兘棰勮');
                            return;
                        }

                        var img = $('<img src="' + src + '">');
                        $wrap.empty().append(img);
                    }, thumbnailWidth, thumbnailHeight);

                    percentages[file.id] = [file.size, 0];
                    file.rotation = 0;
                }

                file.on('statuschange', function(cur, prev) {
                    if (prev === 'progress') {
                        $prgress.hide().width(0);
                    } else if (prev === 'queued') {
                        $li.off('mouseenter mouseleave');
                        $btns.remove();
                    }

                    // 鎴愬姛
                    if (cur === 'error' || cur === 'invalid') {
                        // console.log( file.statusText );
                        showError(file.statusText);
                        percentages[file.id][1] = 1;
                    } else if (cur === 'interrupt') {
                        showError('interrupt');
                    } else if (cur === 'queued') {
                        percentages[file.id][1] = 0;
                    } else if (cur === 'progress') {
                        $info.remove();
                        $prgress.css('display', 'block');
                    } else if (cur === 'complete') {
                        $li.append('<span class="success"></span>');
                    }

                    $li.removeClass('state-' + prev).addClass('state-' + cur);
                });

                $li.on('mouseenter', function() {
                    $btns.stop().animate({
                        height: 87
                    });
                });

                $li.on('mouseleave', function() {
                    $btns.stop().animate({
                        height: 0
                    });
                });

                $btns.on('click', 'span', function() {
                    var index = $(this).index(),
                        deg;

                    switch (index) {
                        case 0:
                            uploader.removeFile(file);
                            return;

                        case 1:
                            file.rotation += 90;
                            break;

                        case 2:
                            file.rotation -= 90;
                            break;
                    }

                    if (supportTransition) {
                        deg = 'rotate(' + file.rotation + 'deg)';
                        $wrap.css({
                            '-webkit-transform': deg,
                            '-mos-transform': deg,
                            '-o-transform': deg,
                            'transform': deg
                        });
                    } else {
                        $wrap.css('filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (~~((file.rotation / 90) % 4 + 4) % 4) + ')');
                        // use jquery animate to rotation
                        // $({
                        //     rotation: rotation
                        // }).animate({
                        //     rotation: file.rotation
                        // }, {
                        //     easing: 'linear',
                        //     step: function( now ) {
                        //         now = now * Math.PI / 180;

                        //         var cos = Math.cos( now ),
                        //             sin = Math.sin( now );

                        //         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                        //     }
                        // });
                    }


                });

                $li.appendTo($queue);
                // console.log( file);
                // console.log( percentages);

            }

            // 璐熻矗view鐨勯攢姣�
            function removeFile(file) {
                var $li = $('#' + file.id);
                delete percentages[file.id];
                updateTotalProgress();
                $li.off().find('.file-panel').off().end().remove();
                if ($queue.find("li").size() > 8) {
                    $("#filePicker2").hide();
                } else {
                    $("#filePicker2").show();
                    $("#filePicker").hide();
                }
            }

            function updateTotalProgress() {
                var loaded = 0,
                    total = 0,
                    spans = $progress.children(),
                    percent;

                $.each(percentages, function(k, v) {
                    total += v[0];
                    loaded += v[0] * v[1];
                });

                percent = total ? loaded / total : 0;

                spans.eq(0).text(Math.round(percent * 100) + '%');
                spans.eq(1).css('width', Math.round(percent * 100) + '%');
                updateStatus();
            }

            function updateStatus() {
                var text = '',
                    stats;

                if (state === 'ready') {
                    text = $.t('zone.upImgWord', {'max': fileCount, 'surplus': fileSurplus});
                } else if (state === 'confirm') {
                    stats = uploader.getStats();
                    if (stats.uploadFailNum) {
                        text = $.t("home.uploadResultTip", {
                                uploaded: stats.successNum,
                                failed: stats.uploadFailNum
                            }) +
                            '<a class="retry c-2d57a1 curPor mr10" href="#"> ' + $.t("home.reupload") + '</a>' + $.t("home.or") + '<a class="ignore c-2d57a1 curPor ml10" href="#">' + $.t("home.ignore") + '</a>';
                    }

                } else {
                    stats = uploader.getStats();
                    text = $.t('zone.upImgWord', {'max': fileCount, 'surplus': fileSurplus});
                }

                $info.html(text);
            }

            function setState(val) {
                var file, stats;

                if (val === state) {
                    return;
                }

                $upload.removeClass('state-' + state);
                $upload.addClass('state-' + val);
                state = val;

                switch (state) {
                    case 'pedding':
                        $placeHolder.removeClass('element-invisible');
                        $queue.parent().removeClass('filled');
                        $queue.hide();
                        $statusBar.addClass('element-invisible');
                        uploader.refresh();
                        break;

                    case 'ready':
                        $placeHolder.addClass('element-invisible');
                        $('#filePicker2').removeClass('element-invisible');
                        $queue.parent().addClass('filled');
                        $queue.show();
                        $statusBar.removeClass('element-invisible');
                        uploader.refresh();
                        break;

                    case 'uploading':
                        $('#filePicker2').addClass('element-invisible');
                        $progress.show();
                        $upload.text($.t('global.uploadHold'));
                        var loadIndex = layer.load(0, {
                            shade: 0.1
                        });
                        break;

                    case 'paused':
                        $progress.show();
                        $upload.text($.t('global.uploadContinue'));
                        break;

                    case 'confirm':
                        $progress.hide();
                        $upload.text($.t('global.uploadStart')).addClass('disabled');

                        stats = uploader.getStats();
                        if (stats.successNum && !stats.uploadFailNum) {
                            setState('finish');
                            return;
                        }
                        break;
                    case 'finish':
                        stats = uploader.getStats();
                        if (stats.successNum) {
                            layer.msg($.t('global.uploadSucc'));
                            layer.closeAll('loading');
                            if (callback) {
                                callback();
                            }
                        } else {
                            // 娌℃湁鎴愬姛鐨勫浘鐗囷紝閲嶈
                            state = 'done';
                            location.reload();
                        }
                        break;
                }

                updateStatus();
            }

            uploader.onUploadProgress = function(file, percentage) {
                var $li = $('#' + file.id),
                    $percent = $li.find('.progress span');

                $percent.css('width', percentage * 100 + '%');
                percentages[file.id][1] = percentage;
                updateTotalProgress();
            };

            uploader.onFileQueued = function(file) {
                fileCount++;
                fileSurplus--;
                fileSize += file.size;

                if (fileCount === 1) {
                    $placeHolder.addClass('element-invisible');
                    $statusBar.show();
                    $("#filePicker2").show();
                }

                addFile(file);

                setState('ready');
                updateTotalProgress();

            };

            var index = 0;
            uploader.on('uploadBeforeSend', function(block, data) {
                // console.log('as:' +block)
                key = $("#upLoad_box").attr("data-key").split(",");
                token = $("#upLoad_box").attr("data-upToken");
                data.key = key[index];
                data.token = token;
                index++;
            });

            uploader.on('uploadAccept', function(block, data) {

            });
            uploader.onFileDequeued = function(file) {
                fileCount--;
                fileSurplus++;
                fileSize -= file.size;

                if (!fileCount) {
                    setState('pedding');
                }

                removeFile(file);
                updateTotalProgress();

            };

            uploader.on('all', function(type) {
                var stats;
                switch (type) {
                    case 'uploadFinished':
                        setState('confirm');
                        break;

                    case 'startUpload':
                        key = $("#upLoad_box").attr("data-key");
                        token = $("#upLoad_box").attr("data-upToken");
                        setState('uploading');
                        break;

                    case 'stopUpload':
                        setState('paused');
                        break;

                }
            });

            uploader.onError = function(code) {
                console.log('Eroor: ' + code);
                if (code == "Q_EXCEED_NUM_LIMIT") {
                    layer.msg($.t('global.uploadMax'));
                }
                if (code == "F_DUPLICATE") {
                    layer.msg($.t('global.uploadRepeat'));
                }
                if (code == "F_EXCEED_SIZE") {
                    layer.msg($.t('global.uploadBig'));
                }
                if (code == "Q_TYPE_DENIED") {
                    layer.msg($.t('global.uploadTypeError'));
                }
            };

            $upload.on('click', function() {
                if ($(this).hasClass('disabled')) {
                    return false;
                }

                if (state === 'ready') {
                    uploader.upload();
                } else if (state === 'paused') {
                    uploader.upload();
                } else if (state === 'uploading') {
                    uploader.stop();
                }
            });

            $info.on('click', '.retry', function() {
                uploader.retry();
            });

            $info.on('click', '.ignore', function() {
                layer.msg('todo');
            });

            $upload.addClass('state-' + state);
            updateTotalProgress();
        },
        checkTrans: function(str, callback, error, cancelCallback) {
            var newStr = str.replace(/<\s?img[^>]*>/gi, '') // /<img\s*src=\"([^\"]*?)\"\s*\/>/gi            
            $._post(apiUrl + '/pm/getTranGold', {
                msg: newStr
            }, function(data) {
                if (data.success && (data.obj != -1)) {
                    if (data.obj == 0) {
                        if (callback) {
                            callback();
                        }
                    } else { //area: ['300px', '174px'],    <br/><a href="' + apiUrl + '/pay/translationPack">' + $.t('im.buyPackageMoreCost-effective') + '</a>
                        layer.open({
                            skin: 'tran-gold-layer',
                            title: false,
                            content: '<p>' + $.t('im.translationNeeds') + $.t('im.goldContinue') + '</p>',
                            btn: [$.t('global.ok'), $.t('global.cancel')],
                            yes: function(index, layero) {
                                if (callback) {
                                    callback();
                                }
                                layer.close(index);
                            },
                            cancel: function() {
                            	if (cancelCallback) {
                            		cancelCallback();
                                }
                            }
                        });
                    }

                } else {
                    if (error) {
                        error();
                    }
                    layer.open({ //area: ['300px', '174px'],                        
                        skin: 'tran-gold-layer',
                        title: false,
                        content: '<p>' + $.t('im.goldLack') + $.t('im.ToRecharge') + '</p>',
                        btn: $.t('im.ToRecharge'),
                        yes: function(index, layero) {
                            window.location = apiUrl + '/pay/recharge';
                        },
                        cancel: function() {}
                    });
                }
            });
        }
    });

    $.zone = $.zone || {};
    $.zone = {
        changeZoneTrans: function(transObj) {
            //console.log('鍔ㄦ€佺炕璇�', transObj);
            if (!transObj) return;
            var locationUrl = window.location.pathname;
            var isZonePage = locationUrl.indexOf('/Zone') != -1;
            var $zoneItem = isZonePage ? $('#zone_list .dynamic_item[data-zoneid="' + transObj.zotrZoneid + '"] .js_detail_trans') : $('#gerendongtai li[zone-id="' + transObj.zotrZoneid + '"] .translate_content');
            if (isZonePage) {
                $('.trans_londing[data-id="' + transObj.zotrZoneid + '"]').remove();
                $zoneItem.parent().removeClass('hide');
            } else {
                $zoneItem.closest('.dynamic-top').find('.dt_tranS_box.zones').remove();
                $zoneItem.parent().show();
            }            
            $zoneItem.html(transObj.zotrTranslat);

            if ($('.layui-layer-content .trans_londing[data-id="' + transObj.zotrZoneid + '"]')) {
                var $layerTransBtn = $('.layui-layer-content .trans_londing[data-id="' + transObj.zotrZoneid + '"]');
                var $layerTransBox = $('.layui-layer-content .detail_trans');
                $layerTransBtn.remove();
                $layerTransBox.removeClass('hide').find('.text').html(transObj.zotrTranslat);
            }
        },
        changeCommentTrans: function(transObj) {
            //console.log('璇勮缈昏瘧', transObj);
            if (!transObj) return;
            var locationUrl = window.location.pathname;
            var isZonePage = locationUrl.indexOf('/Zone') != -1;
            var $commentItem = isZonePage ? $('#zone_list .dynamic_item .comment_item[reply-id="' + transObj.zmtrCommentid + '"] .sub-trans span') : $('#gerendongtai .commont-content-out[data-id="' + transObj.zmtrCommentid + '"] .zoco_content-translate');
            if (isZonePage) {
                $commentItem.closest('.comment_item').find('.dt_tranS_btn2').remove();
                $commentItem.parent().removeClass('hide');
            } else {
                $commentItem.closest('.commont-content-out').find('.dt_tranS_box').remove();
                $commentItem.parent().show();
            }            
            $commentItem.html(transObj.zmtrTranslat);

            if ($('.layui-layer-content .sub_trans_londing[zoco-id="' + transObj.zmtrCommentid + '"]')) {
                var $layerTransBtn = $('.layui-layer-content .sub_trans_londing[zoco-id="' + transObj.zmtrCommentid + '"]');
                var $layerTransBox = $layerTransBtn.parent().next();
                $layerTransBtn.remove();
                $layerTransBox.removeClass('hide').html(transObj.zmtrTranslat);
            }
        },
        filterZone: function(str) {
            if (str) {
                var _str = $.string.decodeHtml(str);
                return _str.replace(/\[[a-z]+\_[0-9]+\]/g, '').replace(/<[^>]*>/g, '').replace(/\[[0-9]+\]/g, '');
            } else {
                return '';          
            }            
        },
        getBrIndex: function(str) {
            if (str) {
                 var i = 0;
                var rows = 0;
                var index;
                while (i != -1) {
                    i = str.indexOf('<br', i);
                    if (i != -1) {
                        if (rows == 3) break;
                        index = i;
                        i++;
                        rows++;
                    }
                };
                return index;
            }           
        },
        likeAct: function(obj,from) {
            var img = '<em class="like-style"></em>';
            $(obj).append(img);
            if (from) {
                $('.like-style').css(from);
            }            
            $('.like-style').stop(false, true).animate({
                top: "-40px",
                opacity: "0"
            }, 500, undefined, function() {
                $('.like-style').remove();
            });
        }
    };
})(jQuery);
