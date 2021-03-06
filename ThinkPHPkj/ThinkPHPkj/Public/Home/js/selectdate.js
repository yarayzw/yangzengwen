// JavaScript Document
(function ($) {
    //SELECT鎺т欢璁剧疆鍑芥暟
    function setSelectControl(oSelect, iStart, iLength, iIndex, type) {
        oSelect.empty();
        for (var i = 0; i < iLength; i++) {
            if(type == 'year') {
                oSelect.prepend("<li value='" + (parseInt(iStart) + i) + "'>" + (parseInt(iStart) + i) + "</li>");
            } else {
                oSelect.append("<li value='" + (parseInt(iStart) + i) + "'>" + (parseInt(iStart) + i) + "</li>");
            }
        }
    }

    $.fn.DateSelector = function (options) {
        options = options || {};

        //鍒濆鍖�
        this._options = {
            ctlYearId: null,
            ctlMonthId: null,
            ctlDayId: null,
            defYear: 0,
            defMonth: 0,
            defDay: 0,
            minYear: 1882,
            maxYear: new Date().getFullYear()
        }

        for (var property in options) {
            this._options[property] = options[property];
        }

        this.yearValueId = $("#" + this._options.ctlYearId);
        this.monthValueId = $("#" + this._options.ctlMonthId);
        this.dayValueId = $("#" + this._options.ctlDayId);

        var dt = new Date(),
            iMonth = parseInt($.trim($("#reg_month").text()) == '鏈�' ? '' : $.trim($("#reg_month").text()) || this._options.defMonth),
            iDay = parseInt($.trim($("#reg_day").text()) == '鏃�' ? '' : $.trim($("#reg_month").text()) || this._options.defDay),
            iMinYear = parseInt(this._options.minYear),
            iMaxYear = parseInt(this._options.maxYear);

        this.Year = parseInt($.trim($("#reg_year").text()) == '骞�' ? '' : $.trim($("#reg_year").text()) || this._options.defYear) || dt.getFullYear();
        this.Month = 1 <= iMonth && iMonth <= 12 ? iMonth : dt.getMonth() + 1;
        this.Day = iDay > 0 ? iDay : dt.getDate();
        this.minYear = iMinYear && iMinYear < this.Year ? iMinYear : this.Year;
        this.maxYear = iMaxYear; //&& iMaxYear > this.Year ? iMaxYear : this.Year;

        //鍒濆鍖栨帶浠�
        //璁剧疆骞�
        setSelectControl(this.yearValueId, this.minYear, this.maxYear - this.minYear + 1, this.Year, 'year');
        //璁剧疆鏈�
        setSelectControl(this.monthValueId, 1, 12, this.Month);
        //璁剧疆鏃�
        var daysInMonth = new Date(this.Year, this.Month, 0).getDate(); //鑾峰彇鎸囧畾骞存湀鐨勫綋鏈堝ぉ鏁癧new Date(year, month, 0).getDate()]
        if (this.Day > daysInMonth) {
            this.Day = daysInMonth;
        }
        ;
        setSelectControl(this.dayValueId, 1, daysInMonth, this.Day);

        var oThis = this;
        //缁戝畾鎺т欢浜嬩欢
        $("#selYear li").click(function () {
            $("#reg_year").text($(this).attr('value'));
            setSelectControl(oThis.monthValueId, 1, 12, oThis.Month);

        });
        $("#selMonth li").live('click', (function () {
            $("#reg_month").text($(this).attr('value'));
            var daysInMonth = new Date(parseInt($.trim($("#reg_year").text())), parseInt($(this).attr('value')), 0).getDate();
            if (oThis.Day > daysInMonth) {
                oThis.Day = daysInMonth;
            }
            ;
            setSelectControl(oThis.dayValueId, 1, daysInMonth, oThis.Day);
        }));
        $("#selDay li").live('click', function () {
            $("#reg_day").text($(this).attr('value'));
        })
    }
})(jQuery);





