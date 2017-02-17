/* 0d.jquery.noConflict.js */

jQuery.noConflict();;

/* 68.vmsite.js */

(function($){var undefined,methods={list:function(options){var dest=options.dest;var ids=options.ids;methods.update(this,dest,ids);$(this).change(function(){methods.update(this,dest)});},update:function(org,dest,ids){var opt=$(org),optValues=opt.val()||[],byAjax=[];if(!$.isArray(optValues))optValues=jQuery.makeArray(optValues);if(typeof oldValues!=="undefined"){$.each(oldValues,function(key,oldValue){if(($.inArray(oldValue,optValues))<0)$("#group"+oldValue+"").remove();});}
$.each(optValues,function(optkey,optValue){if(opt.data('d'+optValue)===undefined)byAjax.push(optValue);});if(byAjax.length>0){$.getJSON('index.php?option=com_virtuemart&view=state&format=json&virtuemart_country_id='+byAjax,function(result){var virtuemart_state_id=$('#virtuemart_state_id');var status=virtuemart_state_id.attr('required');if(status=='required'){if(result[byAjax].length>0){virtuemart_state_id.attr('required','required');}else{virtuemart_state_id.removeAttr('required');}}
$.each(result,function(key,value){if(value.length>0){opt.data('d'+key,value);}else{opt.data('d'+key,0);}});methods.addToList(opt,optValues,dest);if(typeof ids!=="undefined"){var states=ids.length?ids.split(','):[];$.each(states,function(k,id){$(dest).find('[value='+id+']').attr("selected","selected");});}
$(dest).trigger("liszt:updated");});}else{methods.addToList(opt,optValues,dest)
$(dest).trigger("liszt:updated");}
oldValues=optValues;},addToList:function(opt,values,dest){$.each(values,function(dataKey,dataValue){var groupExist=$("#group"+dataValue+"").size();if(!groupExist){var datas=opt.data('d'+dataValue);if(datas.length>0){var label=opt.find("option[value='"+dataValue+"']").text();var group='<optgroup id="group'+dataValue+'" label="'+label+'">';$.each(datas,function(key,value){if(value)group+='<option value="'+value.virtuemart_state_id+'">'+value.state_name+'</option>';});group+='</optgroup>';$(dest).append(group);}}});}};$.fn.vm2front=function(method){if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}else if(typeof method==='object'||!method){return methods.init.apply(this,arguments);}else{$.error('Method '+method+' does not exist on Vm2 front jQuery library');}};})(jQuery);

/* 9a.core.js */

function switchFontSize(ckname,val){var bd=document.getElementsByTagName('body');if(!bd||!bd.length)return;bd=bd[0];switch(val){case'inc':if(CurrentFontSize+1<7){CurrentFontSize++;}
break;case'dec':if(CurrentFontSize-1>0){CurrentFontSize--;}
break;case'reset':default:CurrentFontSize=DefaultFontSize;}
var newclass='fs'+CurrentFontSize;bd.className=bd.className.replace(new RegExp('fs.?','g'),'');bd.className=trim(bd.className);bd.className+=(bd.className?' ':'')+newclass;createCookie(ckname,CurrentFontSize,365);}
function switchTool(ckname,val){createCookie(ckname,val,365);window.location.reload();}
function cpanel_reset(){var matches=document.cookie.match(new RegExp('(?:^|;)\\s*'+tmpl_name.escapeRegExp()+'_([^=]*)=([^;]*)','g'));if(!matches)return;for(var i=0;i<matches.length;i++){var ck=matches[i].match(new RegExp('(?:^|;)\\s*'+tmpl_name.escapeRegExp()+'_([^=]*)=([^;]*)'));if(ck){createCookie(tmpl_name+'_'+ck[1],'',-1);}}
if(window.location.href.indexOf('?')>-1){window.location.href=window.location.href.substr(0,window.location.href.indexOf('?'));}else{window.location.reload(true);}}
function cpanel_apply(){var elems=document.getElementById('ja-cpanel-main').getElementsByTagName('*');var usersetting={};for(var i=0;i<elems.length;i++){var el=elems[i];if(el.name&&(match=el.name.match(/^user_(.*)$/))){var name=match[1];var value='';if(el.tagName.toLowerCase()=='input'&&(el.type.toLowerCase()=='radio'||el.type.toLowerCase()=='checkbox')){if(el.checked)value=el.value;}else{value=el.value;}
if(usersetting[name]){if(value)usersetting[name]=value+','+usersetting[name];}else{usersetting[name]=value;}}}
for(var k in usersetting){name=tmpl_name+'_'+k;value=usersetting[k].trim();if(value.length>0){createCookie(name,value,365);}}
if(window.location.href.indexOf('?')>-1){window.location.href=window.location.href.substr(0,window.location.href.indexOf('?'));}else{window.location.reload(true);}}
function createCookie(name,value,days){if(days){var date=new Date();date.setTime(date.getTime()+(days*24*60*60*1000));var expires="; expires="+date.toGMTString();}else{expires="";}
document.cookie=name+"="+value+expires+"; path=/";}
function trim(str,chars){return ltrim(rtrim(str,chars),chars);}
function ltrim(str,chars){chars=chars||"\\s";return str.replace(new RegExp("^["+chars+"]+","g"),"");}
function rtrim(str,chars){chars=chars||"\\s";return str.replace(new RegExp("["+chars+"]+$","g"),"");}
function getScreenWidth(){var x=0;if(self.innerHeight){x=self.innerWidth;}else if(document.documentElement&&document.documentElement.clientHeight){x=document.documentElement.clientWidth;}else if(document.body){x=document.body.clientWidth;}
return x;}
function equalHeight(els){els=$$_(els);if(!els||els.length<2)return;var maxh=0;var els_=[];els.each(function(el,i){if(!el)return;els_[i]=el;var ch=els_[i].getCoordinates().height;maxh=(maxh<ch)?ch:maxh;},this);els_.each(function(el,i){if(!el)return;if(el.getStyle('padding-top')!=null&&el.getStyle('padding-bottom')!=null){if(maxh-el.getStyle('padding-top').toInt()-el.getStyle('padding-bottom').toInt()>0){el.setStyle('min-height',maxh-el.getStyle('padding-top').toInt()-el.getStyle('padding-bottom').toInt());}}else{if(maxh>0)el.setStyle('min-height',maxh);}},this);}
function getDeepestWrapper(el){while(el.getChildren().length==1){el=el.getChildren()[0];}
return el;}
function fixHeight(els,group1,group2){els=$$_(els);group1=$$_(group1);group2=$$_(group2);if(!els||!group1)return;var height=0;group1.each(function(el){if(!el)return;height+=el.getCoordinates().height;});if(group2){group2.each(function(el){if(!el)return;height-=el.getCoordinates().height;});}
els.each(function(el,i){if(!el)return;if(el.getStyle('padding-top')!=null&&el.getStyle('padding-bottom')!=null){if(height-el.getStyle('padding-top').toInt()-el.getStyle('padding-bottom').toInt()>0){el.setStyle('min-height',height-el.getStyle('padding-top').toInt()-el.getStyle('padding-bottom').toInt());}}else{if(height>0){el.setStyle('min-height',height);}}});}
function addFirstLastItem(el){el=$(el);if(!el||!el.getChildren()||!el.getChildren().length)return;el.getChildren()[0].addClass('first-item');el.getChildren()[el.getChildren().length-1].addClass('last-item');}
function $$_(els){if($type(els)=='string')return $$(els);var els_=[];els.each(function(el){el=$(el);if(el)els_.push(el);});return els_;};
