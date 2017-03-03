(function(){
	//鍒濆鍖朩eb Uploader
	var uploader = WebUploader.create({
		// 閫夊畬鏂囦欢鍚庯紝鏄惁鑷姩涓婁紶銆�
		//auto: true,
		// swf鏂囦欢璺緞
		swf: staticCtx+'js/Uploader.swf',
		// 鏂囦欢鎺ユ敹鏈嶅姟绔€�
		server: "http://up.qiniu.com",
		// 閫夋嫨鏂囦欢鐨勬寜閽€傚彲閫夈€�
		// 鍐呴儴鏍规嵁褰撳墠杩愯鏄垱寤猴紝鍙兘鏄痠nput鍏冪礌锛屼篃鍙兘鏄痜lash.
		pick: {
		   id: '.js_imgBtn',
		   multiple: false
		},
		duplicate: true,
		// 鍙厑璁搁€夋嫨鍥剧墖鏂囦欢銆�
		accept: {
		   title: 'Images',
		   extensions: 'gif,jpg,jpeg,bmp,png',
		   mimeTypes: 'image/*'
		}
	});
	function IMupIMG(){	
		var IMupIMGgagaID = "";
        var IMupLoadImgContainer ="";
		var urlIMGPath="";
        uploader.on('beforeFileQueued', function (file) {
			//console.log("鏂囦欢琚姞鍏ラ槦鍒椾箣鍓嶈Е鍙戯細"+file);
			$.post(ctx+"/Image/uploadInit",{"type":"I","imgNum":1},function(regImg){
				if(regImg.success){		
					//console.log("涓冪墰鏉冮檺锛�"+regImg);
					//console.log("涓冪墰鏉冮檺锛�"+JSON.stringify(regImg));
					$(".FunBtncontainer .js_imgBtn").attr({"data-token":regImg.obj.upToken,"data-imgname":regImg.obj.img[0]});
					uploader.upload();
					urlIMGPath = regImg.attributes.imgUrlPre + regImg.obj.img[0];
					IMupIMGgagaID = $(".lowerLeft .chatPeopleChoiced").attr("data-gagaid");
					IMupLoadImgContainer = $(".lowerRight ").children("[data-gagaID = " + IMupIMGgagaID + "]").find(".upLoadImgContainer");
					IMupLoadImgContainer.show();
		            IMupLoadImgContainer.find(".upLoadContnet").hide();
		            IMupLoadImgContainer.find(".upLoadImging").css("background", "url("+staticCtx+"img/upLoadImging.gif) no-repeat").show();
		            IMupLoadImgContainer.find(".upLoadImgState").text($.t("Letter.uploadIng")).css("color", "#333").show();
		            IMupLoadImgContainer.find(".upLoadImgDelete").hide();
		            IMupLoadImgContainer.find(".upLoadImgName").text(regImg.obj.img[0]);
		            IMupLoadImgContainer.attr("data-imgId", regImg.obj.img[0]);
		            
				}
			});
		});
		// 褰撴湁鏂囦欢娣诲姞杩涙潵鐨勬椂鍊�
		uploader.on('fileQueued', function (file) {
			//console.log("涓婁紶鍥剧墖鍔犲叆鍒楅槦锛�"+file);
		    //IMupLoadImgContainer.show();
		});
		uploader.on('uploadBeforeSend', function(block, data) {
		    data.key = $(".FunBtncontainer .js_imgBtn").attr("data-imgname");
		    data.token = $(".FunBtncontainer .js_imgBtn").attr("data-token");
		});
		//褰撲竴鎵规枃浠舵坊鍔犺繘闃熷垪浠ュ悗瑙﹀彂銆�
		uploader.on('filesQueued', function (files) {
		        //console.log("褰撲竴鎵规枃浠舵坊鍔犺繘闃熷垪浠ュ悗瑙﹀彂"+files);
		});
		uploader.on('uploadSuccess', function (file) {
			//console.log("鎴愬姛锛�"+JSON.stringify(file));
			//console.log("鎴愬姛锛�"+file);
			IMupLoadImgContainer.show();
			IMupLoadImgContainer.find(".upLoadImg").attr("src", urlIMGPath);
			IMupLoadImgContainer.find(".upLoadContnet").show();
			IMupLoadImgContainer.find(".upLoadImging").hide();
			IMupLoadImgContainer.find(".upLoadImgState").hide();
			IMupLoadImgContainer.find(".upLoadImgDelete").show();
            $(".FunBtncontainer .sendBtn").css({ "color": "#fff", "background-color": "#2D57A1" });
            
            
		});
		uploader.on('uploadError', function (file) {
			//console.log("澶辫触锛�"+JSON.stringify(file));
			//console.log("澶辫触锛�"+file);
			IMupLoadImgContainer.show();
			IMupLoadImgContainer.find(".upLoadContnet").hide();
			IMupLoadImgContainer.find(".upLoadImging").css("background", "url(" + staticCtx + "img/IMicon.png) -472px -80px no-repeat").show();
			IMupLoadImgContainer.find(".upLoadImgState").text($.t("Letter.uploadFailed")).css("color", "#d24040").show();
			IMupLoadImgContainer.find(".upLoadImgDelete").show();
		});
		uploader.on('uploadComplete', function (file) {
			 //console.log("瀹屾垚锛�"+JSON.stringify(file));
			 //console.log("瀹屾垚锛�"+file);
		});
	};
	$(".imgBtn1 input").click();
	IMupIMG();
})();


