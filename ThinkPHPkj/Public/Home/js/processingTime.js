function TimeDifference(time2, time1) {
    //瀹氫箟涓や釜鍙橀噺time1,time2鍒嗗埆淇濆瓨寮€濮嬪拰缁撴潫
    //var time1 = "2009-12-02 12:25";
    //var time2 = "2009-12-03 12:35";


    //鍒ゆ柇寮€濮嬫椂闂存槸鍚﹀ぇ浜庣粨鏉熸棩鏈�
    //if (time1 > time2) {
    //    //alert("寮€濮嬫椂闂翠笉鑳藉ぇ浜庣粨鏉熸椂闂达紒");
    //    return false;
    //}
    if (time1=="") {
        //alert("缁撴潫鏃堕棿");
       // console.log("a");
        return time2.substr(0, 16);
      //  return "骞存湀鏃ユ椂鍒�";
    }
    //鎴彇骞翠唤
    var year1 = time1.substr(0, 4);
    var year2 = time2.substr(0, 4);
   // console.log("bb");
    if ((year2 - year1) > 0) {
       // console.log("b");
        return time1.substr(0, 16);
       // return "骞存湀鏃ユ椂鍒�";
    }

    //鎴彇瀛楃涓诧紝寰楀埌鏃ユ湡閮ㄥ垎"2009-12-02",鐢╯plit鎶婂瓧绗︿覆鍒嗛殧鎴愭暟缁�
    var begin1 = time1.substr(0, 10).split("-");
    var end1 = time2.substr(0, 10).split("-");

    //灏嗘媶鍒嗙殑鏁扮粍閲嶆柊缁勫悎锛屽苟瀹炰緥鎴愬寲鏂扮殑鏃ユ湡瀵硅薄
    /*var date1 = new Date(begin1[1] + - +begin1[2] + - +begin1[0]);
    var date2 = new Date(end1[1] + - +end1[2] + - +end1[0]);*/
    var date1 = new Date(begin1[1],begin1[2],begin1[0]);
    var date2 = new Date(end1[1],end1[2],end1[0]);

    //寰楀埌涓や釜鏃ユ湡涔嬮棿鐨勫樊鍊糾锛屼互鍒嗛挓涓哄崟浣�
    //Math.abs(date2-date1)璁＄畻鍑轰互姣涓哄崟浣嶇殑宸€�
    //Math.abs(date2-date1)/1000寰楀埌浠ョ涓哄崟浣嶇殑宸€�
    //Math.abs(date2-date1)/1000/60寰楀埌浠ュ垎閽熶负鍗曚綅鐨勫樊鍊�
    var m = parseInt(Math.abs(date2 - date1) / 1000 / 60);
    //console.log("cc");
    if (m > 0) {
      //  console.log("c");
        return time1.substr(5, 11);
       // return "鏈堟棩鏃跺垎";
    }


    //灏忔椂鏁板拰鍒嗛挓鏁扮浉鍔犲緱鍒版€荤殑鍒嗛挓鏁�
    //time1.substr(11,2)鎴彇瀛楃涓插緱鍒版椂闂寸殑灏忔椂鏁�
    //parseInt(time1.substr(11,2))*60鎶婂皬鏃舵暟杞寲鎴愪负鍒嗛挓
    var min1 = parseInt(time1.substr(11, 2)) * 60 + parseInt(time1.substr(14, 2));
    var min2 = parseInt(time2.substr(11, 2)) * 60 + parseInt(time2.substr(14, 2));

    //涓や釜鍒嗛挓鏁扮浉鍑忓緱鍒版椂闂撮儴鍒嗙殑宸€硷紝浠ュ垎閽熶负鍗曚綅
    var n = min2 - min1;
  //  console.log("n:"+n);
  //  console.log("dd");
    if (n >0) {
       // console.log(min2 + "||" + min1);
        return time1.substr(11, 5);
        //return "鏃跺垎";
    } else {
        return "";
    }

    //灏嗘棩鏈熷拰鏃堕棿涓や釜閮ㄥ垎璁＄畻鍑烘潵鐨勫樊鍊肩浉鍔狅紝鍗冲緱鍒颁袱涓椂闂寸浉鍑忓悗鐨勫垎閽熸暟
   // var minutes = m + n;
    // document.writeln(minutes);

    

    //if (!endTime) {
    //    return "骞存湀鏃ユ椂鍒�";
    //}
    //var startTime = new Date(startTime);
    //var yearStart = startTime.getFullYear();
    //var monthStart = startTime.getMonth();
    //var dayStart = startTime.getDate();
    //var hStart = startTime.getHours();
    //var mStart = startTime.getMinutes();

    //var endTime = new Date(endTime);
    //var yearEnd = endTime.getFullYear();
    //var monthEnd = endTime.getMonth();
    //var dayEnd = endTime.getDate();
    //var hEnd = endTime.getHours();
    //var mEnd = endTime.getMinutes();
    //console.log(yearEnd + "||" + yearStart);
    //if ((yearEnd - yearStart) > 0) {
    //    return "骞存湀鏃ユ椂鍒�";
    //}
    //if ((monthEnd - monthStart) > 0) {
    //    return "鏈堟棩鏃跺垎";
    //}
    //if ((dayEnd - dayStart) > 0) {
    //    return "鏈堟棩鏃跺垎";
    //}
    //if ((hEnd * 60 + mEnd - hStart * 60 - mStart) > 0) {
    //    return "鏃跺垎";
    //}
    //return "";
}
/*---newTime < oldTime----newTime---*/
function TimeDifference2(newTime, oldTime,nowTime) {
    //瀹氫箟涓や釜鍙橀噺oldTime,newTime鍒嗗埆淇濆瓨寮€濮嬪拰缁撴潫
    //var oldTime = "2009-12-02 12:25";
    //var newTime = "2009-12-03 12:35";
    //鎴彇骞翠唤
    var oldYear = oldTime.substr(0, 4);
    var newYear = newTime.substr(0, 4);
    var nowYear = null;
    var nowDate = null;
    var nowm = null;
    var end = newTime.substr(0, 10).split("-");
    var newDate = new Date(end[1],end[2],end[0]);
    if(nowTime){
        nowYear = nowTime.substr(0, 4);
        var nowYMR = nowTime.substr(0, 10).split("-");
        nowDate = new Date(nowYMR[1],nowYMR[2],nowYMR[0]);
        nowm = parseInt(Math.abs(nowDate - newDate) / 1000 / 60);
    } 

    //鍒ゆ柇寮€濮嬫椂闂存槸鍚﹀ぇ浜庣粨鏉熸棩鏈�
    if (oldTime == "" ) {
        if(nowTime && (nowYear == newYear)){
            if(nowm ==0){
                return newTime.substr(11, 5);
                // return "鏃跺垎"; 
            }else{
               return newTime.substr(5, 11);
               // return "鏈堟棩鏃跺垎"; 
            } 
        }else{
             return newTime.substr(0, 16); 
             // return "骞存湀鏃ユ椂鍒�";
        }  
    }
    
    if((newYear - oldYear) > 0){
        if(nowTime && (nowYear == newYear)){
             return newTime.substr(5, 11);
             // return "鏈堟棩鏃跺垎";
        }else{
             return newTime.substr(0, 16);
             // return "骞存湀鏃ユ椂鍒�";
        }
    }
     //鎴彇瀛楃涓诧紝寰楀埌鏃ユ湡閮ㄥ垎"2009-12-02",鐢╯plit鎶婂瓧绗︿覆鍒嗛殧鎴愭暟缁�
    var begin = oldTime.substr(0, 10).split("-");
    //灏嗘媶鍒嗙殑鏁扮粍閲嶆柊缁勫悎锛屽苟瀹炰緥鎴愬寲鏂扮殑鏃ユ湡瀵硅薄
    var oldDate = new Date(begin[1],begin[2],begin[0]);
   

    //寰楀埌涓や釜鏃ユ湡涔嬮棿鐨勫樊鍊糾锛屼互鍒嗛挓涓哄崟浣�
    //Math.abs(newDate-oldDate)璁＄畻鍑轰互姣涓哄崟浣嶇殑宸€�
    //Math.abs(newDate-oldDate)/1000寰楀埌浠ョ涓哄崟浣嶇殑宸€�
    //Math.abs(newDate-oldDate)/1000/60寰楀埌浠ュ垎閽熶负鍗曚綅鐨勫樊鍊�
    var m = parseInt(Math.abs(newDate - oldDate) / 1000 / 60);
    if (m > 0) {
        if(nowTime && nowm == 0){
            return newTime.substr(11, 5);
            //return "鏃跺垎";
        }else{
            return newTime.substr(5, 11);
            //return "鏈堟棩鏃跺垎"
        }
    }
    
    
    
    //灏忔椂鏁板拰鍒嗛挓鏁扮浉鍔犲緱鍒版€荤殑鍒嗛挓鏁�
    //oldTime.substr(11,2)鎴彇瀛楃涓插緱鍒版椂闂寸殑灏忔椂鏁�
    //parseInt(oldTime.substr(11,2))*60鎶婂皬鏃舵暟杞寲鎴愪负鍒嗛挓
    var oldMin = parseInt(oldTime.substr(11, 2)) * 60 + parseInt(oldTime.substr(14, 2));
    var newMin = parseInt(newTime.substr(11, 2)) * 60 + parseInt(newTime.substr(14, 2));

    //涓や釜鍒嗛挓鏁扮浉鍑忓緱鍒版椂闂撮儴鍒嗙殑宸€硷紝浠ュ垎閽熶负鍗曚綅
    var n = newMin - oldMin;    
    if(n >0){
        if(nowTime && nowm == 0){
            return newTime.substr(11, 5);
            //return "鏃跺垎";
        }else{
            return newTime.substr(5, 11);
            //return "鏈堟棩鏃跺垎"
        }
    }else{
        return "";
    }  
}
function jsonDateFormat(jsonDate) {//json鏃ユ湡鏍煎紡杞崲涓烘甯告牸寮�
    try {//鍑鸿嚜http://www.cnblogs.com/ahjesus 灏婇噸浣滆€呰緵鑻﹀姵鍔ㄦ垚鏋�,杞浇璇锋敞鏄庡嚭澶�,璋㈣阿!
        var date = new Date(parseInt(jsonDate.replace("/Date(", "").replace(")/", ""), 10));
        var month = date.getMonth() + 1 < 10 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1;
        var day = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
        var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
       // var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
       // var milliseconds = date.getMilliseconds();
        return date.getFullYear() + "-" + month + "-" + day + " " + hours + ":" + minutes;// + ":" + seconds+ "." + milliseconds;
    } catch (ex) {//鍑鸿嚜http://www.cnblogs.com/ahjesus 灏婇噸浣滆€呰緵鑻﹀姵鍔ㄦ垚鏋�,杞浇璇锋敞鏄庡嚭澶�,璋㈣阿!
        return "";
    }
}
function jsonDateFormatReceive(jsonDate) {//json鏃ユ湡鏍煎紡杞崲涓烘甯告牸寮�
    try {//鍑鸿嚜http://www.cnblogs.com/ahjesus 灏婇噸浣滆€呰緵鑻﹀姵鍔ㄦ垚鏋�,杞浇璇锋敞鏄庡嚭澶�,璋㈣阿!
        jsonDate = jsonDate.replace("T", " ").split(".")[0];
        jsonDate = jsonDate.substr(0, 16);
        return jsonDate;
    } catch (ex) {//鍑鸿嚜http://www.cnblogs.com/ahjesus 灏婇噸浣滆€呰緵鑻﹀姵鍔ㄦ垚鏋�,杞浇璇锋敞鏄庡嚭澶�,璋㈣阿!
        return "";
    }
}
function formatTime(t) {
    if (t < 9) {
        t = "0" + t;
    }
    return t;
}
Date.prototype.Format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //鏈堜唤 
        "d+": this.getDate(), //鏃� 
        "h+": this.getHours(), //灏忔椂 
        "m+": this.getMinutes(), //鍒� 
        "s+": this.getSeconds(), //绉� 
        "q+": Math.floor((this.getMonth() + 3) / 3), //瀛ｅ害 
        "S": this.getMilliseconds() //姣 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}