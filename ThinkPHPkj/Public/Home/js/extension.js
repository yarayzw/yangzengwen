/**
 * @class   jQuery.Plugin 鎵╁睍
 * Created by 鏉庨懌娴� on 2016/3/23.
 */
(function ($) {
    'use strict';
    $.fn.extend({

        /**
         * @method
         * 閫夐」鍗″垏鎹�
         *
         * 璋冪敤姝ゆ柟娉曠殑鍏冪礌瑕佷负鍖呭惈閫夐」鍗℃爣绛剧殑"ul"鍏冪礌锛屾瘡涓€夐」鍗￠兘灏嗛€氳繃姝ゅ厓绱犳煡鎵剧洿鎺ュ瓙鍏冪礌"li"鏉ヨ幏鍙�
         * @param   {Object}        options                     閰嶇疆閫夐」
         * @param   {Object}        options.panel
         * 瀵瑰簲閫夐」鍗＄殑闈㈡澘锛岄潰鏉夸负甯︽湁"tab_panel"绫荤殑鍏冪礌
         *
         * * 濡傛灉浼犻€掔殑璇ュ厓绱犲寘鍚�"tab_panel"绫伙紝鍒欑洿鎺ヨ涓鸿鍏冪礌涓洪潰鏉垮厓绱犻泦鍚堛€�
         * * 濡傛灉涓嶅寘鍚紝鍒欐煡鎵惧叾鐩存帴瀛愬厓绱燾lass涓�"tab_panel"鐨勫厓绱犮€�
         * * 濡傛灉鏈€缁堝厓绱犻泦鍚堜釜鏁颁负0锛屽垯涓嶆墽琛屼换浣曞姩浣滐紝鐩存帴閫€鍑哄嚱鏁颁綋銆�
         * @param   {'click'/
         *           'mouseover'}   [options.event='click']             瑙﹀彂鍒囨崲鐨勪簨浠�
         * @param   {string}        [options.cls='active']                 鍒囨崲鍚庡綋鍓嶉€夐」鍗＄殑鏍囩ず绫�
         * @param   {number}        [options.initIndex=0]               鍒濆閫変腑鐨勭储寮曞€�
         *
         * @param   {Function}      [options.beforeTrigger]             閫夐」鍗″垏鎹箣鍓嶇殑鍥炶皟鍑芥暟
         * @param   {number}        [options.beforeTrigger.lastIdx]     涓婁竴涓储寮曞€�
         * @param   {Object}        [options.beforeTrigger.lastTab]     涓婁竴涓€夐」鍗�
         * @param   {Object}        [options.beforeTrigger.lastPanel]   涓婁竴涓€夐」鍗″搴旂殑鍐呭鍏冪礌
         * @param   {Object}        [options.beforeTrigger.curIdx]      褰撳墠绱㈠紩鍊�
         *
         * @param   {Function}      [options.callback]                  閫夐」鍗″垏鎹箣鍚庣殑鍥炶皟鍑芥暟
         * @param   {number}        [options.callback.idx]              褰撳墠绱㈠紩鍊�
         * @param   {Object}        [options.callback.tab]              褰撳墠閫夐」鍗�
         * @param   {Object}        [options.callback.panel]            褰撳墠閫夐」鍗″搴旂殑鍐呭鍏冪礌
         * @param   {Object}        [options.callback.lastIdx]          涓婁竴涓€夐」鍗＄殑绱㈠紩鍊�
         *
         * @param   {boolean}       [options.initTrigger=true]  鍒濆鍖栨椂鏄惁鎵ц鍥炶皟浜嬩欢
         * @param   {boolean}       [options.reTrigger=true]    鏄惁鍙互閲嶅瑙﹀彂鍚屼竴涓€夐」鍗�
         * @param   {boolean}       [options.isClear=false]     閫夐」鍗″垏鎹㈡椂锛屼箣鍓嶇殑鍐呭闈㈡澘鏄惁娓呯┖銆倀rue涓烘竻绌�
         */
        tabMenu: function (options) {
            // 榛樿閫夐」
            var o = {
                event: 'click',
                cls: 'active',
                panel: null,
                callback: null,
                beforeTrigger: null,
                initIndex: 0,
                isClear: false,
                initTrigger: true,
                reTrigger: true
            };
            // 杞藉叆鑷畾涔夎缃�
            $.extend(o, options);
            if ($(this)[0].tabMenuBinded) {
                return;
            }
            var ele = $(this), tabs = ele.find('> li'), tabsLen = tabs.length, // 闈㈡澘鍏冪礌
            // 鍙互涓洪潰鏉垮垪琛紝涔熷彲浠ヤ负鍗曚釜闈㈡澘
                panels = o.panel.hasClass('tab_panel') ? o.panel : o.panel.find('> .tab_panel'), panelsLen = panels.length, index;
            if (panelsLen === 0) {
                return;
            }
            // 璺宠浆鍒版寚瀹氱储寮曢€夐」
            // @param   {number}    idx     璺宠浆鐨勭储寮曞€�
            function skipToItem(idx) {
                // 淇绱㈠紩鍊�
                idx = idx % tabsLen;
                // 鏄惁鍙互閲嶅瑙﹀彂璺宠浆
                if (!o.reTrigger && idx === index) {
                    return;
                }
                var lastPanel = panels.eq(index), curTab = tabs.eq(idx), panelIdx = idx % panelsLen, curPanel = panels.eq(panelIdx);
                // 璺宠浆涔嬪墠瑙﹀彂浜嬩欢
                if (typeof o.beforeTrigger === 'function') {
                    typeof o.beforeTrigger(index, tabs.eq(index), lastPanel, idx);
                }
                // 绉婚櫎涓婁竴涓猼ab涓巔anel鐨勭姸鎬�
                tabs.removeClass(o.cls);
                if (panels.length > 1) {
                    // 瀵逛笂涓€涓樉绀虹殑 panel 鍋氬唴瀹规竻闄ゆ搷浣�
                    if (lastPanel.length > 0) {
                        if (o.isClear) {
                            lastPanel.html('');
                        }
                    }
                }
                // 闅愯棌鍏朵粬闈㈡澘
                panels.not(curPanel).hide();
                // 璇籭褰撳墠绱㈣鍒囨崲鐨� tab 涓� panel 娣诲姞鐘舵€�
                curTab.addClass(o.cls);
                curPanel.show();
                // 瀹屾垚鍥炶皟
                if (typeof o.callback === 'function') {
                    o.callback(idx, curTab, curPanel, index);
                }
                index = idx;
            }

            // 浜嬩欢缁戝畾
            tabs.each(function (idx, item) {
                $(item).on(o.event, function (e) {
                    e.target.hasAttribute("disabled") || skipToItem(idx);
                }).find('a').on('click', function (e) {
                    e.preventDefault();
                });
            })
            // 鏍囩ず缁戝畾鐘舵€�
            ele[0].tabMenuBinded = true;
            // 缂撳瓨璺宠浆鍒版寚瀹氶」鏂规硶
            ele.data('skipToItem', skipToItem);
            // 鍒濆鍖�
            // 鍒濆鍖栨椂鏄惁瑕佽Е鍙戝姩浣�
            if (o.initTrigger) {
                var realIdx = o.initIndex % tabsLen;
                tabs.removeClass(o.cls).eq(realIdx).addClass(o.cls);
                panels.hide().eq(realIdx).show();
                skipToItem(o.initIndex);
            }
        },
        /**
         * @method
         * * 鎸夊洖杞︽悳绱nput[onenter | textarea[onenter]
         * * 璋冪敤鏂瑰紡
         */
        enterSearchFn: function () {
            'use strict';
            var curEle = $(this);
            //涓嶆槸input,textarea
            if (this[0].tagName != 'INPUT' && this[0].tagName != 'TEXTAREA') {
                $.each(curEle.find('input[onenter]'), function (index, item) {
                    inputEnter.call(this);
                });
                $.each(curEle.find('textarea[onenter]'), function (index, item) {
                    textareaEnter.call(this);
                });
            } else if (curEle.length > 1) {
                curEle.each(function (index, item) {
                    if (item.tagName == "INPUT") {
                        inputEnter.call(this);
                    } else {
                        textareaEnter.call(this);
                    }
                });

            } else {
                if (this[0].tagName == 'INPUT') {
                    inputEnter.call(this);
                }
                if (this[0].tagName == 'TEXTAREA') {
                    textareaEnter.call(this);
                }
            }
            var inputEnterTimeOut;
            //input enter鏂规硶
            function inputEnter() {
                var self = this, enterID = $(self).attr("onenter");
                if (self.isBindEnter) {
                    return;
                }
                //闃绘杈撳叆鐒︾偣鐨勯粯璁や簨浠�,IE涓嬭繛缁Е鍙慴ug
                $(self).parent().off('keydown').on('keydown', function (e) {
                    if (e.keyCode == 13) {
                        e.preventDefault();
                    }
                })
                $(self).off('keyup').on("keyup", function (e) {
                    if (e.keyCode == 13) {
                        if (enterID) {
                            $("#" + enterID).focus().click();
                        }
                    }
                });
                self.isBindEnter = true;
            }

            //textarea enter鏂规硶
            function textareaEnter() {
                var self = this, enterID = $(self).attr("onenter");
                if (self.isBindEnter) {
                    return;
                }
                $(self).off('keyup').on("keyup", function (e) {
                    if (e.ctrlKey && (e.keyCode == 13 || e.keyCode == 10)) {
                        if (enterID) {
                            $("#" + enterID).focus().click();
                        }
                    }
                });
                self.isBindEnter = true;
            }

            return this;
        },
        /**
         * @method
         * * 鑷畾涔夋枃鏈鐨刾laceholder
         * * 閽堝input[inputtips],textarea[inputtips]璁剧疆鎻愮ず
         * * 涓嶉€傜敤鐢ㄥ悓绾ф湁float鐨勫尯鍩�,濡傛湁璇风敤涓€涓猟iv鍖哄潡杩涜鍖呰９
         * * 璋冪敤鏂瑰紡 $('#ele').inputTips();
         * @param      {Object}        options            閰嶇疆鍙傛暟
         * @param      {Object}        [options.css]      璁剧疆鎻愮ず鐨刢ss鏍峰紡
         */
        inputTips: function (options) {
            'use strict';
            //鏂囨湰妗嗘敼鍙樻柟娉�
            var inputChange = function () {
                var self = $(this), prevLabel = self.prev("label"), inputtips = self.attr("inputtips");
                if (self.val() == "") {
                    prevLabel.html(inputtips).show();
                } else {
                    prevLabel.text("");
                    self.is("[labelhidden]") && prevLabel.hide()
                }
            }, options = options || {}, eachEle = $(this), eachDomEle = eachEle[0];
            if (!eachDomEle) {
                return eachEle;
            }
            //涓嶆槸input,textarea
            if (eachDomEle.tagName != 'INPUT' && eachDomEle.tagName != 'TEXTAREA') {
                eachEle = eachEle.find('input[inputtips],textarea[inputtips]');
            }
            $.each(eachEle, function (index, item) {
                var self = this, ele = $(this);
                //宸茬粡鐢熸垚杩囨彁绀轰俊鎭�,鐩存帴杩斿洖
                if (self.inpHasTips) {
                    return;
                } else {
                    var inputtips = ele.attr("inputtips"), labelForID = ele.attr("id"), default_css_params = {
                        'color': '#8B9096',
                        'cursor': 'text',
                        'position': 'absolute',
                        // 'padding': '6px 0 0 8px',
                        'z-index': '1',
                        'background': 'transparent',
                        'line-height': '16px',
                        "font-weight": "normal"
                    }, options_css = options.css || {}, cssParams = $.extend(default_css_params, options_css), forStr = '', par = ele.parent(), fs = parseInt(ele.css('font-size')), bol = parseFloat(ele.css('borderLeftWidth')) || 0, bot = parseFloat(ele.css('borderTopWidth')) || 0, lh = parseFloat(ele.css('lineHeight')) || 16, left, top, pos;
                    if (!/^relative|absolute$/.test(par.css('position'))) {
                        par.css('position', 'relative');
                    }
                    // 褰撳墠瀹氫綅鑾峰彇
                    pos = ele.position();
                    if (_.isEmpty(options_css)) {
                        left = (parseFloat(ele.css('paddingLeft')) || 0) + bol;
                        // if (self.tagName == 'INPUT') {
                        //     top = Math.ceil((ele.outerHeight() - fs - 2) / 2);
                        // } else {
                        //     top = parseInt(ele.css('paddingTop'));
                        // }
                        if (ele[0].tagName.toLowerCase() !== 'textarea') {
                            lh = Math.max(lh, ele.height());
                        }
                        top = (parseInt(ele.css('paddingTop')) || 0) + (lh - 16) / 2 + bot;
                    }
                    // 瀹氫綅鎻愮ず妗�
                    default_css_params.left = Math.floor(left) + pos.left + 'px';
                    default_css_params.top = Math.floor(top) + pos.top + 'px';
                    if (labelForID) {
                        forStr = 'for="' + labelForID + '"';
                    }
                    var prevLabel = $('<label class="inputtips" ' + forStr + '>' + inputtips + '</label>');
                    //璁剧疆label鐨刢ss鏍峰紡
                    prevLabel.css(cssParams)
                    if ($(self).val() != '') {
                        prevLabel.css({
                            'opacity': 0
                        }).text('');
                    }
                    //鍦ㄥ綋鍓嶇殑鍏冪礌鍓嶉潰澧炲姞label
                    $(self).before(prevLabel);
                    $(self).focus(function () { //鑾峰彇鍏夋爣
                        if ($(self).attr("disabled")) {
                            return;
                        }
                        prevLabel.stop().animate({
                            'opacity': 0.5
                        }, 300);
                    }).blur(function () { //澶卞幓鍏夋爣
                        prevLabel.stop().animate({
                            'opacity': 1
                        }, 300);
                    });
                    if ('onpropertychange' in self) { //ie娴忚鍣�
                        self.onpropertychange = function () {
                            if (window.event.propertyName.toLowerCase() == "value") {
                                inputChange.call(self, window.event);
                            }
                        };
                        self.onkeyup = self.onchange = inputChange;
                    } else { //闈瀒e娴忚鍣�
                        self.addEventListener("input", inputChange, false);
                        $(self).on('keyup', inputChange);
                        $(self).on('change', inputChange);
                    }
                    self.inpHasTips = true;
                }
            });
            $("label.inputtips").on("click", function () {
                $(this).next("input").focus();
            });
            return this;
        },
        /**
         * 杞崲xml涓哄璞″舰寮�
         * @method
         * @return {Object}
         */
        toObject: function () {
            if (this == null) return null;
            var retObj = new Object;
            buildObjectNode(retObj, /*jQuery*/this.get(0));
            return $(retObj);
            function buildObjectNode(cycleOBJ, /*Element*/elNode) {
                /*NamedNodeMap*/
                var nodeAttr = elNode.attributes;
                if (nodeAttr != null) {
                    if (nodeAttr.length && cycleOBJ == null) cycleOBJ = new Object;
                    for (var i = 0; i < nodeAttr.length; i++) {
                        cycleOBJ[nodeAttr[i].name] = nodeAttr[i].value;
                    }
                }
                var nodeText = "text";
                if (elNode.text == null) nodeText = "textContent";
                /*NodeList*/
                var nodeChilds = elNode.childNodes;
                if (nodeChilds != null) {
                    if (nodeChilds.length && cycleOBJ == null) cycleOBJ = new Object;
                    for (var i = 0; i < nodeChilds.length; i++) {
                        if (nodeChilds[i].tagName != null) {
                            if (nodeChilds[i].childNodes[0] != null && nodeChilds[i].childNodes.length <= 1 && (nodeChilds[i].childNodes[0].nodeType == 3 || nodeChilds[i].childNodes[0].nodeType == 4)) {
                                if (cycleOBJ[nodeChilds[i].tagName] == null) {
                                    cycleOBJ[nodeChilds[i].tagName] = nodeChilds[i][nodeText];
                                } else {
                                    if (typeof(cycleOBJ[nodeChilds[i].tagName]) == "object" && cycleOBJ[nodeChilds[i].tagName].length) {
                                        cycleOBJ[nodeChilds[i].tagName][cycleOBJ[nodeChilds[i].tagName].length] = nodeChilds[i][nodeText];
                                    } else {
                                        cycleOBJ[nodeChilds[i].tagName] = [cycleOBJ[nodeChilds[i].tagName]];
                                        cycleOBJ[nodeChilds[i].tagName][1] = nodeChilds[i][nodeText];
                                    }
                                }
                            } else {
                                if (nodeChilds[i].childNodes.length) {
                                    if (cycleOBJ[nodeChilds[i].tagName] == null) {
                                        cycleOBJ[nodeChilds[i].tagName] = new Object;
                                        buildObjectNode(cycleOBJ[nodeChilds[i].tagName], nodeChilds[i]);
                                    } else {
                                        if (cycleOBJ[nodeChilds[i].tagName].length) {
                                            cycleOBJ[nodeChilds[i].tagName][cycleOBJ[nodeChilds[i].tagName].length] = new Object;
                                            buildObjectNode(cycleOBJ[nodeChilds[i].tagName][cycleOBJ[nodeChilds[i].tagName].length - 1], nodeChilds[i]);
                                        } else {
                                            cycleOBJ[nodeChilds[i].tagName] = [cycleOBJ[nodeChilds[i].tagName]];
                                            cycleOBJ[nodeChilds[i].tagName][1] = new Object;
                                            buildObjectNode(cycleOBJ[nodeChilds[i].tagName][1], nodeChilds[i]);
                                        }
                                    }
                                } else {
                                    cycleOBJ[nodeChilds[i].tagName] = nodeChilds[i][nodeText];
                                }
                            }
                        }
                    }
                }
            }
        },
        /**
         * @method
         * 閫氳繃瀵硅皟鐢ㄦ鏂规硶鐨勫厓绱犳坊鍔犱簨浠舵潵瀹炵幇瀵圭洰鏍囧厓绱犵殑鏄剧ず/闅愯棌鏁堟灉
         *
         * 鏄剧ず/闅愯棌鏁堟灉閫氳繃 {@link Zoneyet.Tool#toggleToolkit} 涓€绯诲垪鏂规硶瀹炵幇
         *
         * __濡傛灉鎯冲鎸囧畾閫夋嫨鍣ㄧ殑鍏冪礌鎸佷箙缁戝畾toggleTarget锛堢被浼间簬JQ鑰佺増鏈殑"live"鏂规硶锛夛紝
         * 璇峰弬鑰� {@link Zoneyet.Tool#liveToggleTarget Zoneyet.Tool.liveToggleTarget}__
         *
         * 濡傛灉甯屾湜瑙﹀彂鍏冪礌涓埆鑺傜偣琚偣鍑诲悗涓嶆墽琛屾樉绀�/闅愯棌锛岃€屾墽琛岃妭鐐规湰韬殑鐐瑰嚮浜嬩欢锛屼緥濡傝秴閾炬帴鐨勮烦杞瓑锛屽垯鍦ㄨ鑺傜偣涓婂鍔爊oprevent灞炴€э紝鐩墠鍙敮鎸佺偣鍑讳簨浠�
         *
         * 濡傚笇鏈涘湪鐐瑰嚮鐩爣鍏冪礌鑷姩闅愯棌鐨勫熀纭€涓婏紝浣跨洰鏍囧厓绱犵殑涓埆鑺傜偣浣滀负鐗逛緥锛�
         * 鐐瑰嚮涓嶉殣钘忓叾闈㈡澘锛岃鍦ㄨ鑺傜偣涓婂姞鍏� preventautohide="true" 灞炴€�
         * @param   {Object}        options         閰嶇疆閫夐」
         * @param   {Object/
         *           Function}      options.target  瑕佹樉绀�/闅愯棌鐨勭洰鏍囧厓绱 
         * @param   {'click'/
         *           'mouseover'}   [options.event='click']
         * 瑙﹀彂浜嬩欢
         * @param   {boolean}       [options.isSingleTarget=false]
         * 濡傛灉璇ュ弬鏁颁负true锛屽垯璁や负澶氫釜寮曠敤鍏冪礌鍏敤涓€涓洰鏍囧厓绱狅紝姝ゆ椂锛屼細瀵瑰叾璁剧疆鎺掍粬鎬с€�
         * 鑰屼笖濡傛灉type涓簆op鏃讹紝鍙細瀵筪ocument缁戝畾涓€娆′簨浠朵娇鍏堕殣钘�
         *
         * * 鑻ヤ负"click"锛屽垯瀵规瘡娆＄偣鍑昏繘琛岀姸鎬佸垽鏂�
         * * 鑻ヤ负"mouseover"锛屽垯瀵归紶鏍囨寚鍚�(mouseover)鏃惰Е鍙戞樉绀烘晥鏋滐紝榧犳爣绉诲紑(mouseout)鏃惰Е鍙戦殣钘忔晥鏋�
         * @param   {string}    [options.cls='opened']  鐩爣鍏冪礌鏄剧ず鏃跺瑙﹀彂鍏冪礌娣诲姞鐨勬爣绀虹被
         * @param   {'block'/
         *           'pop'}     [options.type='block']
         * 鐩爣鍏冪礌鐨勭被鍨嬨€�
         *
         * * 鑻ヤ负"block"锛岃涓虹洰鏍囧厓绱犱负鍧楃骇鍏冪礌锛屽彧瀵瑰紩鐢ㄥ厓绱犵粦瀹氫簨浠�
         * * 鑻ヤ负"pop"锛岃涓虹洰鏍囧厓绱犱负寮圭獥銆�
         *   鍦╡vent涓�"click"鏃讹紝闄や簡瀵瑰紩鐢ㄥ厓绱犵粦瀹氫簨浠跺锛岃繕浼氬document鍏冪礌缁戝畾锛�
         *   鏉ョ‘淇濈偣鍑婚潪寮曠敤鍏冪礌涓庣洰鏍囧厓绱犳椂锛屽脊绐楀彲姝ｅ父鍏抽棴銆�
         *
         *   __璇风‘淇濆湪绫荤殑"destroy"鏂规硶涓皟鐢ㄤ簡瀵瑰簲鐢ㄦ琛屼负鍏冪礌鐨剓@link jQuery.Plugin#destroyToggleTarget 娉ㄩ攢鏂规硶}锛屼互渚垮document瑙ｇ粦浜嬩欢锛屾彁鍗囨晥鐜囥€俖_
         * @param   {boolean}   [options.stopPropagation=true]  鐩爣鍏冪礌鐐瑰嚮鍚庢槸鍚﹂樆姝㈠叾鍋氳嚜鍔ㄩ殣钘忔搷浣滐紙绫讳技浜庨樆姝㈠啋娉★級
         * @param   {boolean}   [options.initShow=false]        鍒濆鍖栨椂鐩爣鍏冪礌鏄惁灞曠幇
         *
         * @param   {Function}  [options.beforeTrigger]         寮曠敤鍏冪礌浜嬩欢瑙﹀彂涔嬪墠鐨勫洖璋冨嚱鏁�
         * @param   {Object}    [options.beforeTrigger.from]    璋冪敤鍏冪礌
         * @param   {Object}    [options.beforeTrigger.target]  鐩爣鍏冪礌
         * @param   {'show'/
         *           'hide'}    [options.beforeTrigger.status]  鍗冲皢鍙戠敓鐨勫姩浣滄槸鏄剧ず杩樻槸闅愯棌
         *
         * @param   {Function}  [options.callback]              寮曠敤鍏冪礌浜嬩欢瑙﹀彂涔嬪悗鐨勫洖璋冨嚱鏁般€�
         * @param   {Object}    [options.callback.from]         璋冪敤鍏冪礌
         * @param   {Object}    [options.callback.target]       鐩爣鍏冪礌
         * @param   {'show'/
         *           'hide'}    [options.callback.status]       鍗冲皢鍙戠敓鐨勫姩浣滄槸鏄剧ず杩樻槸闅愯棌
         *
         * @param   {Function}  [options.onshow]                鐩爣鍏冪礌鏄剧ず鍚庤Е鍙戠殑鍥炶皟鍑芥暟
         * @param   {Object}    [options.onshow.from]           璋冪敤鍏冪礌
         * @param   {Object}    [options.onshow.target]         鐩爣鍏冪礌
         *
         * @param   {Function}  [options.onhide]                鐩爣鍏冪礌闅愯棌鍚庤Е鍙戠殑鍥炶皟鍑芥暟
         * @param   {Object}    [options.onhide.from]           璋冪敤鍏冪礌
         * @param   {Object}    [options.onhide.target]         鐩爣鍏冪礌
         */
        toggleTarget: function (options) {
            var o = {
                event: 'click',
                type: 'block',
                target: null,
                cls: 'opened',
                beforeTrigger: null,
                callback: null,
                onshow: null,
                onhide: null,
                stopPropagation: true,
                initShow: false,
                isSingleTarget: false
            };
            // 杞藉叆鑷畾涔夎缃�
            $.extend(o, options);
            var toggleToolkit = Zoneyet.Tool.toggleToolkit, ts = new Date() - 0, singleTargetHideFn, singleTar;
            // 濡傛灉鐩爣涓哄悓涓€涓厓绱狅紝鍒欏document鍙粦瀹氫竴娆′簨浠�
            if (o.isSingleTarget) {
                singleTar = typeof o.target === 'function' ? o.target() : $(o.target);
                if (o.type === 'pop' && o.event === 'click') {
                    // 鐐瑰嚮document鏃惰嚜鍔ㄩ殣钘忓叾target鍙傛暟
                    singleTargetHideFn = function (e) {
                        var source = $(e.target), from = $(singleTar[0].toggleSource), isPrevent;
                        // 褰撳墠鍏冪礌鏄惁瑙﹀彂鐨勫厓绱狅紝鎴栧寘鍚湪瑙﹀彂鍏冪礌鍐呴儴
                        if (source[0] === from[0] || source.closest('[togglemark=' + ts + ']').length > 0 || source.attr('preventautohide') || source.closest('[preventautohide]').length > 0) {
                            isPrevent = true;
                        }
                        if (!isPrevent && singleTar.hasClass(toggleToolkit.showClass)) {
                            Zoneyet.Tool.toggleToolkit.hideTarget(from, singleTar, o);
                        }
                    };
                    $(document).on('click', singleTargetHideFn);
                    // 鍒濆鍖栭殣钘忓崟涓洰鏍囧厓绱 
                    Zoneyet.Tool.toggleToolkit.hideTarget($(singleTar[0].toggleSource), singleTar, {cls: o.cls});
                }
                if (o.event === 'mouseover') {
                    singleTar.on('mouseover', function () {
                        var timer = $(this).data('hoverTimer');
                        // 缁堟闅愯棌鐩爣鍥惧眰璁℃椂鍣�
                        if (timer) {
                            clearTimeout(timer);
                        }
                    });
                    singleTar.on('mouseout', function () {
                        var timer = $(this).data('hoverTimer'), timeout;
                        // 缁堟闅愯棌鐩爣鍥惧眰璁℃椂鍣�
                        if (timer) {
                            clearTimeout(timer);
                        }
                        // 鎸囧畾寤惰繜鍚庨殣钘忕洰鏍囧浘灞�
                        timeout = setTimeout(function () {
                            toggleToolkit.hideTarget($(singleTar[0].toggleSource), singleTar, o);
                        }, 200);
                        $(this).data('hoverTimer', timeout);
                    });
                }
            }
            $(this).each(function (idx, element) {
                var ele = $(element), eleSrc = ele[0], target, targetSrc, tskey = ts, bindEle;
                // 鑾峰彇鐩爣鍏冪礌
                if (singleTar) {
                    target = singleTar;
                } else {
                    target = typeof o.target === 'function' ? o.target(ele) : $(o.target);
                }
                targetSrc = target[0];
                // 閬垮厤閲嶅缁戝畾
                if (eleSrc.toggleTargetBinded) {
                    return;
                }
                // 淇濆瓨寮曠敤
                eleSrc.toggleTarget = target;
                targetSrc.toggleSource = eleSrc;
                // click 浜嬩欢涓� mouseover 浜嬩欢鍖哄垎瀵瑰緟
                if (o.event === 'click') {
                    // click浜嬩欢涓姣忔鐐瑰嚮鍒ゆ柇鏄惁鍚湁鐩爣鍏冪礌宸茬粡鏄剧ず鐨勬爣绀�
                    if (o.isSingleTarget) {
                        // 鐩爣涓哄悓涓€涓厓绱犳椂锛岀偣鍑讳簨浠堕渶瑕佹湁鎺掍粬鎬�
                        ele.click(function (e) {
                            if (!e.target.hasAttribute("noprevent")) {
                                e.preventDefault();
                            } else {
                                return
                            }
                            var me = $(this);
                            if (targetSrc.toggleSource === this && me.hasClass(o.cls)) {
                                toggleToolkit.hideTarget(me, target, o);
                            } else {
                                $(targetSrc.toggleSource).removeClass(o.cls);
                                toggleToolkit.showTarget(me, target, o);
                                targetSrc.toggleSource = this;
                            }
                        });
                    }
                    ele.find('a').click(function (e) {
                        if (!e.target.hasAttribute("noprevent")) {
                            e.preventDefault();
                        }
                    });
                    ele.attr('togglemark', tskey);
                    target.attr('istoggletarget', true);
                    // 濡傛灉鐩爣鍏冪礌涓哄脊绐楋紝鑰岄潪鍧楃骇鏄剧ず/闅愯棌鍏冪礌锛�
                    // 闇€瑕佸document浜嬩欢杩涜鐩戝惉锛屾瘡娆＄偣鍑婚兘瀵瑰叾闅愯棌
                    if (o.type === 'pop') {
                        if (o.isSingleTarget) {
                            ele.data('rootHideFn', singleTargetHideFn);
                        } else {
                            // 鍖呭惈鍒欓殣钘忥紝涓嶅寘鍚垯鏄剧ず
                            ele.click(function (e) {
                                if (!e.target.hasAttribute("noprevent")) {
                                    e.preventDefault();
                                } else {
                                    return
                                }
                                e.stopPropagation();
                                var t = $(this.toggleTarget);
                                if (t.hasClass(toggleToolkit.showClass)) {
                                    toggleToolkit.hideTarget(ele, t, o);
                                } else {
                                    if ($(this).closest('[istoggletarget]').length === 0) {
                                        $(document).click();
                                    }
                                    toggleToolkit.showTarget(ele, t, o);
                                }
                            });
                            tskey = new Date() - 0;
                            ele.attr('togglemark', tskey);
                            ele.data('rootHideFn', function (e) {
                                var bd = $(document.body);
                                // 鑷姩娉ㄩ攢鏈哄埗
                                if (bd.find(ele).length === 0) {
                                    ele.destroyToggleTarget();
                                    return;
                                }
                                if (!e) {
                                    Zoneyet.Tool.toggleToolkit.hideTarget(ele, target, o);
                                    return;
                                }
                                var source = $(e.target), isPrevent;
                                // 褰撳墠鍏冪礌鏄惁瑙﹀彂鐨勫厓绱狅紝鎴栧寘鍚湪瑙﹀彂鍏冪礌鍐呴儴
                                if (source.closest('[togglemark]').length > 0 || source.attr('preventautohide') || source.closest('[preventautohide]').length > 0) {
                                    isPrevent = true;
                                }
                                // 濡傛灉闇€瑕佹樉绀�/闅愯棌鐨勭洰鏍囧厓绱犻渶瑕佺偣鍑绘椂闃绘璧疯Е鍙戜簨浠�
                                if (!isPrevent && o.stopPropagation) {
                                    if (source.closest('[istoggletarget]').length > 0) {
                                        isPrevent = true;
                                    }
                                }
                                if (!isPrevent) {
                                    Zoneyet.Tool.toggleToolkit.hideTarget(ele, target, o);
                                }
                            });
                            $(document).on('click', ele.data('rootHideFn'));
                        }
                        // 瀵圭洰鏍囧厓绱犱腑鍚湁 close_pop 绫荤殑鍏冪礌缁戝畾鐐瑰嚮闅愯棌寮圭獥浜嬩欢
                        target.find('.close_pop').click(function () {
                            ele.data('rootHideFn')();
                        });
                    } else if (!o.isSingleTarget) {
                        // 鍖呭惈鍒欓殣钘忥紝涓嶅寘鍚垯鏄剧ず
                        ele.click(function (e) {
                            if (!e.target.hasAttribute("noprevent")) {
                                e.preventDefault();
                            } else {
                                return
                            }
                            var t = $(this.toggleTarget);
                            if (t.hasClass(toggleToolkit.showClass)) {
                                toggleToolkit.hideTarget(ele, t, o);
                            } else {
                                toggleToolkit.showTarget(ele, t, o);
                            }
                        });
                    }
                } else {
                    // 濡傛灉鐩爣鍏冪礌涓哄悓涓€涓厓绱狅紝缁戝畾鐩爣浣滆皟鏁达紝閬垮厤閲嶅缁戝畾
                    if (o.isSingleTarget) {
                        bindEle = ele;
                    } else {
                        bindEle = ele.add(target);
                    }
                    bindEle.on('mouseover', function () {
                        var timer = $(target).data('hoverTimer');
                        // 缁堟闅愯棌鐩爣鍥惧眰璁℃椂鍣�
                        if (timer) {
                            clearTimeout(timer);
                        }
                        if (target.hasClass(toggleToolkit.showClass) && target.toggleSource === this) {
                            return;
                        }
                        toggleToolkit.showTarget(ele, target, o);
                        target.toggleSource = this;
                    });
                    bindEle.on('mouseout', function () {
                        var timer = $(target).data('hoverTimer'), timeout;
                        // 缁堟闅愯棌鐩爣鍥惧眰璁℃椂鍣�
                        if (timer) {
                            clearTimeout(timer);
                        }
                        // 鎸囧畾寤惰繜鍚庨殣钘忕洰鏍囧浘灞�
                        timeout = setTimeout(function () {
                            toggleToolkit.hideTarget(ele, target, o);
                        }, 200);
                        $(target).data('hoverTimer', timeout);
                    });
                }
                // 鍐掓场闃绘
                // if (o.stopPropagation) {
                // target.click(function (e) {
                // if ($(e.target).closest('[istoggletarget]').length===1) {
                //     e.stopPropagation();
                // }
                // });
                // }
                // 鏍囩ず缁戝畾鐘舵€�
                eleSrc.toggleTargetBinded = true;
                if (!o.isSingleTarget) {
                    if (o.initShow) {
                        // 鍒濆鍖栨樉绀�
                        toggleToolkit.showTarget(ele, target, o);
                    } else {
                        // 鍒濆鍖栭殣钘�
                        toggleToolkit.hideTarget(ele, target, o);
                    }
                }
            });
        },
        /**
         * @method
         * 娉ㄩ攢 {@link jQuery.Plugin#toggleTarget} 涓� event涓�'click'锛宼ype涓�'pop'鏃跺 document 缁戝畾鐨勪簨浠�
         *
         * 濡傛灉寮曠敤姝ゆ柟娉曠殑鍏冪礌娌℃湁瀵瑰簲鏍囩ず锛屽垯涓嶆墽琛屼换浣曞姩浣�
         */
        destroyToggleTarget: function () {
            $(this).each(function (idx, element) {
                var ele = $(this), fn = ele.data('rootHideFn');
                // 妫€娴嬫槸鍚︽湁瀵瑰簲鏍囩ず
                if (typeof fn === 'function') {
                    $(document).off('click', fn);
                    ele.removeData('rootHideFn');
                }
                if (typeof ele[0].toggleTargetBinded !== 'undefined') {
                    delete ele[0].toggleTargetBinded;
                }
            })
        },
    });
}(jQuery));
// 甯︾紦瀛樼殑鍔犺剼鏈姞杞斤紝鐢ㄦ硶鍙傝€� $.getScript
jQuery.cacheScript = function (url, options) {
    options = $.extend(options || {}, {
        dataType: "script",
        cache: true,
        url: url
    });
    return jQuery.ajax(options);
}