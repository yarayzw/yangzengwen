var Zoneyet=Zoneyet||{};(function(e){e=Zoneyet;Zoneyet.define=function(e,t,n){"use strict";if(!e||typeof e!=="string"){throw new Error('鍛藉悕蹇呴』涓轰互鍦嗙偣"."椋庢牸鐨勫瓧绗︿覆褰㈠紡锛�')}if(e==="Zoneyet.Class"){throw new Error("涓嶅彲瀵� Zoneyet.Class 鍋氳鐩栨搷浣滐紒")}var o=e.split("."),r=o.length,i=window,s,f,a,p,y;if(typeof n==="boolean"){n={isFn:n}}n=n||{};for(y=0;y<r;y++){a=o[y];if(y===r-1){s=typeof i[a]==="object"}i[a]=i[a]||{};if(y<r-1){i=i[a]}}if(typeof t!=="undefined"){if(typeof t==="function"&&!n.isFn){f=t()}else{f=t}if(n.isExtend&&s&&typeof f==="object"){for(p in f){i[a][p]=f[p]}}else{i[a]=f}}return i[a]};Zoneyet.defineClass=function(e,t){"use strict";var n="Zoneyet.Class.";if(!e||typeof e!=="string"){throw new Error("浼犻€掔殑绫诲悕绉板弬鏁板繀椤讳负瀛楃涓叉牸寮忥紒")}if(!Zoneyet.Class){Zoneyet.Class={}}if(Zoneyet.Class[e]){throw new Error('鍒涘缓鐨勭被"Zoneyet.Class.'+e+'"宸插瓨鍦紒')}if(typeof t!=="function"){throw new Error("绫诲畾涔夊疄浣撳繀椤讳负鍑芥暟锛�")}var o,r=t(),i,s;if(typeof r._superClass==="string"){r._superClass=Zoneyet.Class[r._superClass]}if(r._superClass&&typeof r._superClass==="function"){i=true}if(r.constructor&&typeof r.constructor==="function"){if(i){o=function(){r._superClass.apply(this,arguments);r.constructor.apply(this,arguments)}}else{o=function(){r.constructor.apply(this,arguments)}}}else{o=function(){}}if(typeof r._static==="object"){if(r._static.prototype){r._proto=r._static.prototype;delete r._static.prototype}for(s in r._static){o[s]=r._static[s]}}if(i){for(s in r._superClass.prototype){o.prototype[s]=r._superClass.prototype[s]}o.prototype._super={};if(r._superClass.prototype._super){for(s in r._superClass.prototype._super){o.prototype._super[s]=r._superClass.prototype._super[s]}}}if(typeof r._proto==="object"){for(s in r._proto){if(o.prototype._super&&o.prototype[s]){o.prototype._super[s]=o.prototype[s]}o.prototype[s]=r._proto[s]}}if(r.destroy&&typeof r.destroy==="function"){if(i){o.prototype.destroy=function(){r._superClass.prototype.destroy.apply(this,arguments);r.destroy.apply(this,arguments)}}else{o.prototype.destroy=function(){r.destroy.apply(this,arguments)}}}else if(i){o.prototype.destroy=function(){r._superClass.prototype.destroy.apply(this,arguments)}}else{o.prototype.destroy=function(){}}return Zoneyet.define(n+e,o,true)};Zoneyet.create=function(e,t,n){if(!e){throw new Error("璇蜂紶閫掓墍瑕佸垱寤虹殑绫伙紒")}if(arguments.length===2){if(typeof t==="string"){n=t;t=[]}}var o;if(typeof e==="string"){o=e;e=Zoneyet.Class[e]}if(!e){if(typeof o==="string"){throw new Error('鎵€瑕佸垱寤虹殑绫�"Zoneyet.Class.'+o+'"涓嶅瓨鍦紒')}else{throw new Error("鎵€瑕佸垱寤虹殑绫讳笉瀛樺湪锛�")}}if(!t||!(t instanceof Array)){t=[]}n=n||"main";function r(){e.apply(this,t)}r.prototype=e.prototype;r.constructor=e;var i=new r;Zoneyet.Instance.addInstance(i,n);return i}})(Zoneyet);Zoneyet.define("Zoneyet.Browser",function(){"use strict";var e=navigator.userAgent.toLowerCase(),t={isIE:e.indexOf("msie")>-1,isIE6:e.indexOf("msie 6")>-1,isIE7:e.indexOf("msie 7")>-1,isIE8:e.indexOf("msie 8")>-1,isIE9:e.indexOf("msie 9")>-1,isIE10:e.indexOf("msie 10")>-1,isIE11:e.indexOf("msie 11")>-1,isWebkit:e.indexOf("webkit")>-1,isChrome:e.indexOf("chrome")>-1,isOpera:e.indexOf("opera")>-1,isFF:e.indexOf("firefox")>-1,isBlink:e.indexOf("blink")>-1};t.isGecko=!t.isWebkit&&e.indexOf("gecko")>-1;t.isSafari=!t.isChrome&&e.indexOf("safari")>-1;t.isLtIE8=t.isIE&&(t.isIE7||t.isIE6);t.isGtIE8=t.isIE&&!t.isIE8&&!t.isIE7&&!t.isIE6;t.isWin=e.indexOf("windows")>-1;t.isMac=e.indexOf("Mac")>-1;t.isLinux=navigator.platform.indexOf("Linux")>-1;return t});Zoneyet.define("Zoneyet.Static",{CONTENT_BOX_ID:"content",GUIDE_BOX_ID:"guidePage"});Zoneyet.define("Zoneyet.Instance",function(){"use strict";var e={};function t(t,n){e[t]={instances:[],xhr:{},subBox:n||[]}}t(Zoneyet.Static);function n(n){if(!n){return}if(!e[n]){t(n)}}var o="xhr";return{getAllInstances:function(){return e},getInstancesByScope:function(t){if(!t)throw new Error("scope涓哄繀閫夋潯浠讹紒");return e[t]},pauseXhr:function(){for(var t in e){for(var n in e[t].xhr){var o=e[t].xhr[n];e[t].xhr[n].instance.abort();e[t].xhr[n]=$.extend(o,{paused:true})}}},sendXhr:function(){for(var t in e){for(var n in e[t].xhr){if(e[t].xhr[n].paused){e[t].xhr[n].instance=$.ajax(e[t].xhr[n].obj)}}}},addInstance:function(t,o){n(o);o=o||Zoneyet.Static.CONTENT_BOX_ID;e[o].instances.push(t)},addXhr:function(t,r,i,s){if(s){n(s);e[s].xhr[o+i]={instance:t,obj:r,paused:false}}},removeXhr:function(t,n){if(!n||typeof t==="undefined"){return}delete e[n].xhr[o+t]},destroy:function(t){t=t||Zoneyet.Static.CONTENT_BOX_ID;function n(t){if(!t){return}var o=t.subBox,r,i;if(o.length>0){r=o.length;for(i=0;i<r;i++){n(e[o[i]])}}var s=t.instances.length,f,a,p,y;for(p in t.xhr){y=t.xhr[p];if(y.instance){if(y.instance.abort){y.instance.abort()}}delete t.xhr[p]}for(f=0;f<s;f++){a=t.instances[f];if(typeof a.destroy==="function"){a.destroy()}}t.instances=[];t.xhr={}}n(e[t])}}});Zoneyet.define("Zoneyet.Global");Zoneyet.define("Zoneyet.template",function(e,t){var n=/\#\#(.+?)\#\#/g,o={};t=t||{};e=e||"";e=e.replace(n,function(e,n){var r=t[n],i=o[n];if(r instanceof Array){o[n]=typeof i==="undefined"?0:i+1;r=r[o[n]]}return $.t(n,r)});return laytpl(e)},true);













