$(function() {
	preLoadImg([(staticPath+'/css/skin/actions/qrj_tc_cn.png'), (staticPath+'/css/skin/actions/qrj_tc_en.png'), (staticPath+'/css/skin/actions/qrj_ac_bg1.jpg')]);
	
	function preLoadImg(imgArr) {
		var imgs = [];
		for(var i = 0, l = imgArr.length; i < l; i++) {
			imgs[i] = new Image();
			imgs[i].src = imgArr[i];
		}
	}
});





















