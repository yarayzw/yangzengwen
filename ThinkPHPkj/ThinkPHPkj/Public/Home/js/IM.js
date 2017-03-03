/**
 * 
 * 杩炴帴IM娑堟伅鏈嶅姟绔�
 * IM.connection({
 *      token   token
 *      url  Im url
 *      onRead	璇诲彇娑堟伅(鍙傛暟瀛楃涓�)
 *      onError 閿欒澶勭悊(鍙傛暟瀛楃涓�)
 * });
 * @author xingdongyang
 */
var IM =function() {
		function request(url, token, onRead, onError) {
			$.ajax({
				url: url,
				data: 't=' + token + '&dt=' + new Date().getTime(),
				complete: function(xhr, ts) {},
				success: function(data) {
					if (data.code == 0) {
						try {
							onRead(data.content);
						} catch (e) {
							console.log(e.message);
						}
						request(url, token, onRead, onError);
					} else if (data.code == 6) {
						onError("6"); //Token澶辨晥
						return;
					} else if (data.code == 1) {
						request(url, token, onRead, onError);
					}
					//setTimeout(request(url,token,onRead,onError), 1000);
				},
				error: function(xhr, status, errorThrown) {
					//				if(xhr.readyState==4&&xhr.status==404){
					setTimeout(function () {
						request(url, token, onRead, onError);
					}, 3000);
					//					 console.log("*******"+status);
					//				}else{
					//					if(status=="error"){
					//						 setTimeout(function secondStep() {setTimeout(request(url,token,onRead,onError), 3000);}, 3000);
					//					 }else if(status=="timeout"){
					//						 setTimeout(function secondStep() {setTimeout(request(url,token,onRead,onError), 3000);}, 3000);
					//					 }
					//				}
				},
				timeout: 40000,
				dataType: "json"
			});
		};

		function connection(opt) {
			var token = opt.token || null,
				url = opt.url || null,
				onRead = opt.onRead || fn;
			onError = opt.onError || fn;
			if (token == null || url == null) {
				onError("2"); //鍙傛暟涓嶆纭�
				return;
			}
			request(url, token, onRead, onError);
		};

		return {
			connection: connection
		};
	}();