
//debugger;
mid = ""; //璧犻€佷汉id
gvid = "";//閫変腑鐨勭ぜ鐗﹊d
type = "";//绀肩墿or缈昏瘧鍖�
gpage = 0;//绀肩墿鍒嗛〉
tpage = 0;//缈昏瘧鍖呭垎椤�

/**鎵撳紑绀肩墿鍒楄〃*/
/*function openGiftList(gagaID){
	$.ajax({
		type : "post",
		url : ctx+"/Member/giftlist",
		contentType : "application/x-www-form-urlencoded",
		data: {"page":1},
		
		success: function(data){
			if(data.success){ 
				
				var str = "";
				for(var i = 0;i < data.obj.length;i++){
					str += "<li onclick=\"selectedgift(this,"+data.obj[i].giviId+",1)\">"
					+"<p><img src=\""+qiniuImgURL+data.obj[i].giviDisplay+"?imageMogr2/thumbnail/100x100\" ></p>"
					+"<p class=\"mt5\"><span class=\"c-ff8a00 f18 mr5\">"+data.obj[i].giviGold
					+"</span><span class=\"money\"></span></p><div class=\"chosed\"></div></li>";
				}
				$(".giftCon").find(".giftcont1").append(str);
				openDialog1(gagaID);
			}else{
				alert(data.msg);
			}
		 }
	});
}
*/
function openGiftList(gagaID){
	//$(".gift").click(function(e) {
		gvid = "";//閫変腑鐨勭ぜ鐗﹊d
		type = "";//绀肩墿or缈昏瘧鍖�
		mid =gagaID;
		gpage = 0;
		$.ajax({//铏氭嫙绀肩墿
			type : "post",
			url : ctx + "/Member/giftlist",
			contentType : "application/x-www-form-urlencoded",
			data: {"page":0},
			success: function(data){
				if(data.success){
					var str = "";
					for(var i = 0;i < data.obj.length;i++){
						str += "<li onclick=\"selectedgift(this,"+data.obj[i].giviId+",1)\">"
						+"<p><img src='"+ qiniuImgURL+data.obj[i].giviDisplay+"?imageMogr2/thumbnail/100x100'></p>"
						+"<p class=\"mt5\"><span class=\"c-ff8a00 f18 mr5\">"+data.obj[i].giviGold
						+"</span><span class=\"money\"></span></p><div class=\"chosed\"></div></li>";
					}
					$(".giftCon .giftcont").find(".gift1").append(str);


					layer.open({
						type: 1,
						area: '700px',
						skin: 'giftCon1',
						title:$.t("global.giftGiving"),
				        content: $(".giftCon").html(),
				        btn: $.t("global.ok"),
				        yes: function (index, layero) {
				        	if(null == gvid || $.trim(gvid).length <= 0
				            	||null == type || $.trim(type).length <= 0){
				        		layer.msg($.t("global.chooseGift"));
				           		return;
				            }
				            returnGive();
				            layer.close(index);
				        },
				        cancel: function (index) {
						},
					});
					
					$(".giftCon1 .gift-top span").click(function(e) {
						$(this).addClass("gift-chose").siblings().removeClass("gift-chose");
						var $ulobj = $(this).parents(".layui-layer-content").find(".giftcont").find("ul");
						$ulobj.hide().eq($(this).index()).show();
					});
				}else{
					
					layer.msg(data.msg);
				}
			 }
		});
		$.ajax({//缈昏鍖�
			type : "post",
			url : ctx + "/Member/transpackagelist",
			contentType : "application/x-www-form-urlencoded",
			data: {"page":++tpage},
			success: function(data){
				if(data.success){
					var str = "";
					for(var i = 0;i < data.obj.length;i++){
						str += "<li onclick=\"selectedgift(this,"+data.obj[i].trpaId+",2)\">"
						+"<p><img src='"+ qiniuImgURL +data.obj[i].trpaImgurl+"?imageMogr2/thumbnail/100x78' ></p>"
						+"<p>"+data.obj[i].trpaCharcount+"<spring:message code='ihome.ilike.text.character'/></p>"
						+"<p class=\"mt5\"><span class=\"c-ff8a00 f18 mr5\">"+data.obj[i].trpaGold
						+"</span><span class=\"money\"></span></p><div class=\"chosed\"></div></li>";
					}
					$(".giftCon .giftcont").find(".trans1").append(str);
				}else{
					
					layer.msg(data.msg);
				}
			 }
		});
		
		
	}

/*function openDialog1(gvreGagaid){
	layer.open({
	    area: '700px',
		skin: 'giftCon1',
        title:'<spring:message code="ihome.ilike.text.gift.giving"/>',
        content: $(".giftCon").html(),
        btn: '<spring:message code="ihome.ilike.text.confirm"/>',
        yes: function (index, layero) {
            if(null == mid || $.trim(mid).length <= 0
            		||null == gvid || $.trim(gvid).length <= 0
            		||null == type || $.trim(type).length <= 0){
            		alert("<spring:message code='ihome.ilike.text.please.choose.gifts'/>");
            		return;
            }
            returnGive();
            layer.close(index);
        },
        cancel: function (index) {
        },
	});
	mid = gvreGagaid;
	//$(".giftcont1").mCustomScrollbar();
	$(".giftCon1 .gift-top span").click(function(e) {
		var bh=$(this).attr("id");
		$(this).addClass("gift-chose").siblings().removeClass("gift-chose"); 
		var ulobj = $(this).parents(".layui-layer-content").find(".giftcont").find("ul");
		for(var i = 0; i < ulobj.length ;i++ ){
			if($(ulobj[i]).is(":hidden")){
				$(ulobj[i]).show();
			}else{
				$(ulobj[i]).hide();
			}
		}
	});
}*/

/**閫変腑绀肩墿*/
function selectedgift(obj,gid,types){
   //$(obj).siblings().children(".chosed").css("display","none");
	$(obj).closest(".giftcont").find(".giftcont1 li").children(".chosed").css("display","none");
	$(obj).children(".chosed").css("display","block");
	gvid = gid;
	type = types;
}


/**鑾峰彇绀肩墿*/
var isHasData = true;
var isGiftCom = true;
function findgiftlist(obj){
	//alert(obj.scrollHeight+"--------"+obj.scrollTop + "------"+$(obj).height()
	if (!isHasData) {
		return;
	}
	if(obj.scrollHeight > obj.scrollTop +40 +420){
		return;
	}
	if (isGiftCom) {
		isGiftCom = false;
		$.ajax({
			type : "post",
			url : ctx+"/Member/giftlist",
			contentType : "application/x-www-form-urlencoded",
			data: {"page":++gpage},
			success: function(data){
				if(data.success){ 
					//$("#mCSB_5").find(".mCSB_container").find("li").remove();//娓呯┖div
					if (data.obj && data.obj.length > 0) {
						var str = "";
						for(var i = 0;i < data.obj.length;i++){
							str += "<li onclick=\"selectedgift(this,"+data.obj[i].giviId+",1)\">"
							+"<p><img src='"+qiniuImgURL+data.obj[i].giviDisplay+"?imageMogr2/thumbnail/100x100' ></p>"
							+"<p class=\"mt5\"><span class=\"c-ff8a00 f18 mr5\">"+data.obj[i].giviGold
							+"</span><span class=\"money\"></span></p><div class=\"chosed\"></div></li>";
						}
						$(obj).append(str);
					} else {
						isHasData = false;
					}				
				}else{
					layer.msg(data.msg);
				}
			 }
		})
		.always(function() {
			isGiftCom = true;
		});
	}
}

/**鑾峰彇缈昏瘧鍖�*/

function findTranspackage(obj){
	if(obj.scrollHeight > obj.scrollTop +20 + 420){
		return;
	}
	$.ajax({
		type : "post",
		url : ctx+"/Member/transpackagelist",
		contentType : "application/x-www-form-urlencoded",
		data: {"page":++tpage},
		success: function(data){
			if(data.success){ 
				//$("#mCSB_6").find(".mCSB_container").find("li").remove();//娓呯┖div
				var str = "";
				for(var i = 0;i < data.obj.length;i++){
					str += "<li onclick=\"selectedgift(this,"+data.obj[i].trpaId+",2)\">"
					+"<p><img src='"+qiniuImgURL+data.obj[i].trpaImgurl+"?imageMogr2/thumbnail/100x78' ></p>"
					+"<p>"+data.obj[i].trpaCharcount+"<spring:message code='ihome.ilike.text.character'/></p>"
					+"<p class=\"mt5\"><span class=\"c-ff8a00 f18 mr5\">"+data.obj[i].trpaGold
					+"</span><span class=\"money\"></span></p><div class=\"chosed\"></div></li>";
				}
				$(obj).append(str);
			}else{
				
				layer.msg(data.msg);
			}
		 }
	});
}


/**鍥炶禒*/
function returnGive(){
	$.ajax({
		type : "post",
		url : ctx + "/Member/givegift",
		contentType : "application/x-www-form-urlencoded",
		data: {"mid":mid,"gvid":gvid,"type":type},
		success: function(data){
			if(data.success){
				layer.msg(data.msg);
                $.IM.getMoneyNum();
			}else{
				//layer.msg(data.msg);
				 var contentTip = '<div class="textCenter marT5">'+$.t("im.goldLack")+$.t("im.ToRecharge")+'</div>';
                 layer.open({
                     title: false,
                     content: contentTip,
                     skin: 'noTitleTips',
                     btn: [$.t("im.ToRecharge")],
                     yes: function (index, layero) {
                          window.location.href=ctx+"/pay/recharge"; 
                         layer.close(index);
                     }
                 });
			}
		 }
	});
} 
