/* js_84926301910afc4b800b75e5dd90cf61.jquery.ui.autocomplete.html.js */
(function($){var proto=$.ui.autocomplete.prototype,initSource=proto._initSource;function filter(array,term){var matcher=new RegExp($.ui.autocomplete.escapeRegex(term),"i");return $.grep(array,function(value){return matcher.test($("<div>").html(value.label||value.value||value).text());});}
$.extend(proto,{_initSource:function(){if(this.options.html&&$.isArray(this.options.source)){this.source=function(request,response){response(filter(this.options.source,request.term));};}else{initSource.call(this);}},_renderItem:function(ul,item){return $("<li></li>").data("item.autocomplete",item).append($("<a></a>")[this.options.html?"html":"text"](item.label)).appendTo(ul);}});})(jQuery);;;

/* js_50468f55aa04e8698a5afbee8cc17719.jquery.noconflict.js */
jQuery.noConflict();;;

/* js_dc444e1a59af69ba749fb78b7a4c7f29.vmsite.js */
var Virtuemart=window.Virtuemart||{};(function($){var methods={_cache:{},list:function(options){if(typeof Virtuemart.vmSiteurl==='undefined')Virtuemart.vmSiteurl='';return this.each(function(){this.self=$(this);this.opt=this.opt||{};this.opt=$.extend(true,{},$.fn.vm2front.defaults,this.opt,methods._processOpt(options));this.form=$(this).closest('form');this.state_fields=$(this.form).find(this.opt.state_field_selector);methods._update.call(this,false);$(this).on('change',function(){methods._update.call(this,this.opt.show_list_loader);});});},setOpt:function(options){return this.each(function(){this.opt=$.extend(true,{},$.fn.vm2front.defaults,this.opt,methods._processOpt(options));});},_processOpt:function(options){if(options.hasOwnProperty('dest')){options['state_field_selector']=options.dest;delete options.dest;}
if(options.hasOwnProperty('ids')){options['selected_state_ids']=options.ids;delete options.ids;}
if(options.hasOwnProperty('prefiks')){options['field_prefix']=options.prefiks;delete options.prefiks;}
return options;},_update:function(showLoader){var that=this,selected_country_ids=$(this).val()||[];if(!$.isArray(selected_country_ids)){selected_country_ids=$.makeArray(selected_country_ids);}
if(selected_country_ids.length){selected_country_ids=selected_country_ids.join(',');if(methods._cache.hasOwnProperty(selected_country_ids)){methods._addToList.call(that,methods._cache[selected_country_ids]);}else{$.ajax({dataType:'JSON',url:Virtuemart.vmSiteurl+'index.php?option=com_virtuemart&view=state&format=json&virtuemart_country_id='+selected_country_ids,beforeSend:function(){if(showLoader){methods.startVmLoading();}},success:function(data){if(data){methods._cache[selected_country_ids]=data;methods._addToList.call(that,methods._cache[selected_country_ids]);}
if(showLoader){methods.stopVmLoading();}},error:function(e,t,n){console.log(e);console.log(t);console.log(n);if(showLoader){methods.stopVmLoading();}}})}}},_addToList:function(data){var that=this,dataType=$.type(data),i=0;selected_state_ids=[];if(that.opt.selected_state_ids&&that.opt.selected_state_ids.length){if(that.opt.selected_state_ids){if($.type(that.opt.selected_state_ids)==='string'){selected_state_ids=that.opt.selected_state_ids.split(',');}
if($.type(that.opt.selected_state_ids)==='number'){selected_state_ids.push(that.opt.selected_state_ids);}}}
$(that.state_fields).each(function(){var state_field=this,id=$(this).attr('id'),form=$(that.form),label=id&&form.length?form.find('label[for="'+id+'"]'):null,required=$(state_field).data('required'),hasData=false;$(state_field).data('label',label);if((required!==true&&required!==false)||($(state_field).attr('required')||$(state_field).hasClass('required'))){if($(state_field).attr('required')||$(state_field).hasClass('required')){$(state_field).data('required',true).removeAttr('required').removeAttr('aria-required').removeClass('required');if(label&&label.length&&that.opt.asterisk_class){label.find('.'+that.opt.asterisk_class).hide();}}else{$(state_field).data('required',false);}}
$('optgroup',state_field).each(function(){if($(this).data('ajaxloaded'))$(this).remove();});if(dataType==='object'||dataType==='array'){hasData=false;$.each(data,function(country_id,states){var country_name=$(that).find('option[value="'+country_id+'"]').text(),prefix=that.opt.field_prefix?that.opt.field_prefix+'-':that.opt.field_prefix,optgroup_id=prefix+'group-'+i+'-'+country_id,optgroup,option;if(!$('#'+optgroup_id,this).length){optgroup=$('<optgroup />',{id:optgroup_id,label:country_name}).data('ajaxloaded',true);$.each(states,function(index,state){option=$('<option />',{value:state.virtuemart_state_id}).text(state.state_name);if($.inArray(state.virtuemart_state_id,selected_state_ids)>=0){option.attr('selected',true);}
optgroup.append(option);hasData=true;});}
if(optgroup&&hasData){$(state_field).append(optgroup);}});}
if(hasData&&$(state_field).data('required')){$(state_field).attr('required',true).attr('aria-required',true);label=$(state_field).data('label');if(label&&$(label).length&&that.opt.asterisk_class){$(label).find('.'+that.opt.asterisk_class).show();}}
if($(state_field).hasClass('invalid')||$(state_field).attr('aria-invalid')=='true'){$(state_field).trigger('blur');}
if(that.opt.field_update_trigger&&$.type(that.opt.field_update_trigger)==='string'){$(state_field).trigger(that.opt.field_update_trigger);}
i++;});},startVmLoading:function(message){var object={data:{msg:(!message?'':message)}};Virtuemart.startVmLoading(object);},stopVmLoading:function(){Virtuemart.stopVmLoading();}};$.fn.vm2front=function(method){if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}else if(typeof method==='object'||!method){return methods.init.apply(this,arguments);}else{$.error('Method '+method+' does not exist in Vm2front plugin.');}};$.fn.vm2front.defaults={state_field_selector:'#virtuemart_state_id_field',selected_state_ids:'',field_prefix:'',field_update_trigger:'liszt:updated',show_list_loader:true,asterisk_class:'asterisk'};Virtuemart.startVmLoading=function(a){var msg='';if(typeof a.data.msg!=='undefined'){msg=a.data.msg;}
$('body').addClass('vmLoading');if(!$('div.vmLoadingDiv').length){$('body').append('<div class="vmLoadingDiv"><div class="vmLoadingDivMsg">'+msg+'</div></div>');}};Virtuemart.stopVmLoading=function(){if($('body').hasClass('vmLoading')){$('body').removeClass('vmLoading');$('div.vmLoadingDiv').remove();}};Virtuemart.sendCurrForm=function(event){event.preventDefault();if(event.currentTarget.length>0){$(event.currentTarget[0].form.submit());}else{var f=jQuery(event.currentTarget).closest('form');f.submit();}}})(jQuery);;

/* js_79b09509d5ad7a3d21604a0726684e27.vmkeepalive.js */
var vmKeepAlive=function(){jQuery(function($){var lastUpd=0,kAlive=0,minlps=1,stopped=true;var sessMSec=60*1000*parseFloat(sessMin);var interval=(sessMSec-40000)*0.99;console.log('keepAlive each '+interval+' minutes and maxlps '+maxlps);var tKeepAlive=function($){if(stopped){kAlive=1;var loop=setInterval(function(){var newTime=new Date().getTime();if(kAlive>=minlps&&newTime-lastUpd>sessMSec*(parseFloat(maxlps)+0.99)){stopped=true;clearInterval(loop);}else{console.log('keep alive '+kAlive+' newTime '+((newTime-lastUpd)/60000)+' < '+(sessMin*(parseFloat(maxlps)+0.99)));kAlive++;$.ajax({url:vmAliveUrl,cache:false});}},interval);stopped=false;}};lastUpd=new Date().getTime();tKeepAlive($);$(document).on('keyup click','body',function(e){lastUpd=new Date().getTime();if(stopped){$.ajax({url:vmAliveUrl,cache:false});tKeepAlive($);}});});};vmKeepAlive();;;

/* js_4368bd92d005ea6d1df2f0f34799b9a5.core.js */
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
function $$_(els){if(typeOf(els)=='string')return $$(els);var els_=[];els.each(function(el){el=$(el);if(el)els_.push(el);});return els_;}
$(document).addEvent('domready',function(){$$('[data-dismiss="alert"]').each(function(el){el.addEvent('click',function(){el.getParent().destroy();if($('system-message').getChildren().length==0){Joomla.removeMessages();}});});});;;

/* js_7fd7468b1a35883a66a4079930d35cdd.mega.js */
var jaMegaMenuMoo=new Class({Implements:Options,options:{slide:0,duration:300,fading:0,bgopacity:0.9,delayHide:500,direction:'down',action:'mouseenter',hidestyle:'normal',offset:5,fixArrow:false},toElement:function(){return this.menu;},initialize:function(menu,options){this.menu=$(menu);if(!this.menu){return;}
this.setOptions(options);if(!this.options.slide&&!this.options.fading){this.options.delayHide=10;}
this.childopen=[];this.imgloaded=false;this.loaded=false;this.prepare();},prepare:function(){var imgElms=this.menu.getElements('img');if(imgElms.length&&!this.imgloaded){var imgSrcs=[];imgElms.each(function(image){imgSrcs.push(image.src)});new Asset.images(imgSrcs,{onComplete:function(){this.start();}.bind(this)});this.imgloaded=true;this.start.delay(3000,this);}else{this.start();}},start:function(){if(this.loaded){return;}
this.loaded=true;this.zindex=1000;var pw=this.menu;while(pw=pw.getParent()){if(pw.hasClass('main')||pw.hasClass('wrap')){this.wrapper=pw;break;}}
this.items=this.menu.getElements('li.mega');this.items.each(function(li){var link=li.getChildren('a.mega')[0],child=li.getChildren('.childcontent')[0],level0=li.getParent().hasClass('level0'),parent=this.getParent(li),item={stimer:null,direction:((level0&&this.options.direction=='up')?0:1)};if(child){var childwrap=child.getElement('.childcontent-inner-wrap'),childinner=child.getElement('.childcontent-inner'),width=childinner.getWidth(),height=childinner.getHeight(),padding=childwrap.getStyle('padding-left').toInt()+childwrap.getStyle('padding-right').toInt(),overflow=false;child.setStyles({width:width+20,height:height+20});childwrap.setStyle('width',width);if(['auto','scroll'].contains(childinner.getStyle('overflow'))){overflow=true;if(Browser.ie){if(Browser.version<=7){childinner.setStyle('position','relative');}
if(Browser.version==6){childinner.setStyle('height',childinner.getStyle('max-height')||400);}}}
if(this.options.direction=='up'){if(level0){child.setStyle('top',-child.getHeight());}else{child.setStyle('bottom',0);}}}
if(child&&this.options.bgopacity){new Element('div',{'class':'childcontent-bg',styles:{width:'100%',height:height,opacity:this.options.bgopacity,position:'absolute',top:0,left:0,zIndex:1,background:child.getStyle('background'),backgroundImage:child.getStyle('background-image'),backgroundRepeat:child.getStyle('background-repeat'),backgroundColor:child.getStyle('background-color')}}).inject(childwrap,'top');child.setStyle('background','none');childwrap.setStyles({position:'relative',zIndex:2});}
if(child&&(this.options.slide||this.options.fading)){if(child.hasClass('right')){child.setStyle('right',0);}
var fx=new Fx.Morph(childwrap,{duration:this.options.duration,transition:Fx.Transitions.linear,onComplete:this.itemAnimDone.bind(this,item),link:'cancel'}),stylesOn={};if(this.options.slide){if(level0){stylesOn[item.direction==1?'margin-top':'bottom']=0;}else{stylesOn[window.isRTL?'margin-right':'margin-left']=0;}}
if(this.options.fading){stylesOn['opacity']=1;}}
if(child&&this.options.action=='click'){li.addEvent('click',function(e){e.stopPropagation();if(li.hasClass('group')){return;}
if(item.status=='open'){if(this.cursorIn(li,e)){this.itemHide(item);}else{this.hideOthers(li);}}else{this.itemShow(item);}}.bind(this));}
if(this.options.action=='mouseover'||this.options.action=='mouseenter'){li.addEvent('mouseover',function(e){if(li.hasClass('group')){return;}
e.stop();clearTimeout(item.stimer);clearTimeout(this.atimer);this.intent(item,'open');this.itemShow(item);}.bind(this)).addEvent('mouseleave',function(e){if(li.hasClass('group')){return;}
clearTimeout(item.stimer);this.intent(item,'close');if(child){item.stimer=this.itemHide.delay(this.options.delayHide,this,[item]);}else{this.itemHide(item);}}.bind(this));if(link&&child){link.addEvent('click',function(e){if(!item.clickable){e.stop();}});}
li.addEvent('click',function(e){e.stopPropagation()});if(child){child.addEvent('mouseover',function(){clearTimeout(item.stimer);clearTimeout(this.atimer);this.intent(item,'open');this.itemShow(item);}.bind(this)).addEvent('mouseleave',function(e){e.stop();this.intent(item,'close');clearTimeout(item.stimer);if(!this.cursorIn(item.el,e)){this.atimer=this.hideAlls.delay(this.options.delayHide,this);}}.bind(this))}}
if(link&&!child){link.addEvent('click',function(e){e.stopPropagation();this.hideOthers(null);this.menu.getElements('.active').removeClass('active');var p=li;while(p){var idata=p.retrieve('item');p.addClass('active');idata.link.addClass('active');p=idata.parent;}}.bind(this));}
Object.append(item,{el:li,parent:parent,link:link,child:child,childwrap:childwrap,childinner:childinner,width:width,height:height,padding:padding,level0:level0,fx:fx,stylesOn:stylesOn,overflow:overflow,clickable:!(link&&child)});li.store('item',item);},this);var container=$('ja-wrapper');if(!container){container=document.body;}
container.addEvent('click',function(e){this.hideAlls();}.bind(this));this.menu.getElements('.childcontent').setStyle('display','none');},getParent:function(el){var p=el;while((p=p.getParent())){if(this.items.contains(p)&&!p.hasClass('group')){return p;}
if(!p||p==this.menu){return null;}}},intent:function(item,action){item.intent=action;while(item.parent&&(item=item.parent.retrieve('item'))){item.intent=action;}},cursorIn:function(el,event){if(!el||!event){return false;}
var pos=el.getPosition(),cursor=event.page;return(cursor.x>pos.x&&cursor.x<pos.x+el.getWidth()&&cursor.y>pos.y&&cursor.y<pos.y+el.getHeight());},itemOver:function(item){item.el.addClass('over');if(item.el.hasClass('haschild')){item.el.removeClass('haschild').addClass('haschild-over');}
if(item.link){item.link.addClass('over');}},itemOut:function(item){item.el.removeClass('over');if(item.el.hasClass('haschild-over')){item.el.removeClass('haschild-over').addClass('haschild');}
if(item.link){item.link.removeClass('over');}},itemShow:function(item){if(this.childopen.indexOf(item)<this.childopen.length-1){this.hideOthers(item.el);}
if(item.status=='open'){return;}
this.itemOver(item);if(item.level0){this.childopen.length=0;}
if(item.child){this.childopen.push(item);}
item.intent='open';item.status='open';this.enableclick.delay(100,this,item);if(item.child){this.positionSubmenu(item);if(item.fx&&!item.stylesOff){item.stylesOff={};if(this.options.slide){if(item.level0){item.stylesOff[item.direction==1?'margin-top':'bottom']=-item.height;}else{item.stylesOff[window.isRTL?'margin-right':'margin-left']=(item.direction==1?-item.width:item.width);}}
if(this.options.fading){item.stylesOff['opacity']=0;}
item.fx.set(item.stylesOff);}
clearTimeout(item.sid);item.child.setStyles({display:'block',zIndex:this.zindex++});}
if(!item.fx||!item.child){return;}
item.child.setStyle('overflow','hidden');if(item.overflow){item.childinner.setStyle('overflow','hidden');}
item.fx.start(item.stylesOn);},itemHide:function(item){clearTimeout(item.stimer);item.status='close';item.intent='close';this.itemOut(item);this.childopen.erase(item);if(!item.fx&&item.child){clearTimeout(item.sid);item.sid=setTimeout(function(){item.child.setStyle('display','none');},this.options.delayHide);}
if(!item.fx||!item.child||item.child.getStyle('opacity')=='0'){return;}
item.child.setStyle('overflow','hidden');if(item.overflow){item.childinner.setStyle('overflow','hidden');}
switch(this.options.hidestyle){case'fast':item.fx.options.duration=100;item.fx.start(item.stylesOff);break;case'fastwhenshow':item.fx.start(Object.merge(item.stylesOff,{'opacity':0}));break;case'normal':default:item.fx.start(item.stylesOff);break;}},itemAnimDone:function(item){if(item.status=='close'){if(this.options.hidestyle.test(/fast/)){item.fx.options.duration=this.options.duration;if(!this.options.fading){item.childwrap.setStyle('opacity',1);}}
item.child.setStyle('display','none');this.disableclick.delay(100,this,item);var pitem=item.parent?item.parent.retrieve('item'):null;if(pitem&&pitem.intent=='close'){this.itemHide(pitem);}}
if(item.status=='open'){item.child.setStyle('overflow','');if(item.overflow){item.childinner.setStyle('overflow-y','auto');}
item.childwrap.setStyle('opacity',1);item.child.setStyle('display','block');}},hideOthers:function(el){this.childopen.each(function(item){if(!el||(item.el!=el&&!item.el.contains(el))){item.intent='close';}});if(this.options.slide||this.options.fading){var last=this.childopen.getLast();if(last&&last.intent=='close'){this.itemHide(last);}}else{this.childopen.each(function(item){if(item.intent=='close'){this.itemHide(item);}},this);}},hideAlls:function(el){this.childopen.flatten().each(function(item){if(!item.fx){this.itemHide(item);}else{item.intent='close';}},this);if(this.options.slide||this.options.fading){var last=this.childopen.getLast();if(last&&last.intent=='close'){this.itemHide(last);}}},enableclick:function(item){if(item.link&&item.child){item.clickable=true;}},disableclick:function(item){item.clickable=false;},positionSubmenu:function(item){var options=this.options,offsleft,offstop,left,top,stylesOff={},icoord=item.el.getCoordinates(),bodySize=$(document.body).getScrollSize(),winRect={top:window.getScrollTop(),left:window.getScrollLeft(),width:window.getWidth(),height:window.getHeight()},wrapRect=this.wrapper?this.wrapper.getCoordinates():{top:0,left:0,width:winRect.width,height:winRect.height};winRect.top=Math.max(winRect.top,wrapRect.top);winRect.left=Math.max(winRect.left,wrapRect.left);winRect.width=Math.min(winRect.width,wrapRect.width);winRect.height=Math.min(winRect.height,$(document.body).getScrollHeight());winRect.right=winRect.left+winRect.width;winRect.bottom=winRect.top+winRect.height;if(!item.level0){var pitem=item.parent.retrieve('item'),offsety=parseFloat(pitem.child.getFirst().getStyle('margin-top')),offsetx=parseFloat(pitem.child.getFirst().getStyle(window.isRTL?'margin-right':'margin-left'));item.direction=pitem.direction;window.isRTL&&(offsetx=0-offsetx);icoord.top-=offsety;icoord.bottom-=offsety;icoord.left-=offsetx;icoord.right-=offsetx;}
if(item.level0){if(window.isRTL){offsleft=Math.max(winRect.left,icoord.right-item.width-20);left=Math.max(0,offsleft-winRect.left);}else{offsleft=Math.max(winRect.left,Math.min(winRect.right-item.width,icoord.left));left=Math.max(0,Math.min(winRect.right-item.width,icoord.left)-winRect.left);}}else{if(window.isRTL){if(item.direction==1){offsleft=icoord.left-item.width-20+options.offset;left=-icoord.width-20;if(offsleft<winRect.left){item.direction=0;offsleft=Math.min(winRect.right,Math.max(winRect.left,icoord.right+item.padding-20-options.offset));left=icoord.width-20;stylesOff['margin-right']=item.width;}}else{offsleft=icoord.right+item.padding-20;left=icoord.width-20;if(offsleft+item.width>winRect.right){item.direction=1;offsleft=Math.max(winRect.left,icoord.left-item.width-20);left=-icoord.width-20;stylesOff['margin-right']=-item.width;}}}else{if(item.direction==1){offsleft=icoord.right-options.offset;left=icoord.width;if(offsleft+item.width>winRect.right){item.direction=0;offsleft=Math.max(winRect.left,icoord.left-item.width-item.padding+options.offset);left=-icoord.width;stylesOff['margin-left']=item.width;}}else{offsleft=icoord.left-item.width-item.padding+options.offset;left=-icoord.width;if(offsleft<winRect.left){item.direction=1;offsleft=Math.max(winRect.left,Math.min(winRect.right-item.width,icoord.right-options.offset));left=icoord.width;stylesOff['margin-left']=-item.width;}}}}
if(options.slide&&item.fx&&Object.getLength(stylesOff)){item.fx.set(stylesOff);}
if(options.fixArrow&&item.childinner){item.childinner.setStyle('background-position',(icoord.left-offsleft+(icoord.width/2-4.5))+'px top');}
var oldp=item.child.getStyle('display');item.child.setStyle('display','block');if(item.child.getOffsetParent()){left=offsleft-item.child.getOffsetParent().getCoordinates().left;}
item.child.setStyles({'margin-left':0,'left':left,'display':oldp});}});;;

/* html5fallback.js */
(function(e,t,n){typeof Object.create!="function"&&(Object.create=function(e){function t(){}return t.prototype=e,new t});var r={init:function(n,r){var i=this;i.elem=r,i.$elem=e(r),r.H5Form=i,i.options=e.extend({},e.fn.h5f.options,n),i.field=t.createElement("input"),i.checkSupport(i),r.nodeName.toLowerCase()==="form"&&i.bindWithForm(i.elem,i.$elem)},bindWithForm:function(e,t){var r=this,i=!!t.attr("novalidate"),s=e.elements,o=s.length;r.options.formValidationEvent==="onSubmit"&&t.on("submit",function(e){i=!!t.attr("novalidate");var s=this.H5Form.donotValidate!=n?this.H5Form.donotValidate:!1;!s&&!i&&!r.validateForm(r)?(e.preventDefault(),this.donotValidate=!1):t.find(":input").each(function(){r.placeholder(r,this,"submit")})}),t.on("focusout focusin",function(e){r.placeholder(r,e.target,e.type)}),t.on("focusout change",r.validateField),t.find("fieldset").on("change",function(){r.validateField(this)}),r.browser.isFormnovalidateNative||t.find(":submit[formnovalidate]").on("click",function(){r.donotValidate=!0});while(o--){var u=s[o];r.polyfill(u),r.autofocus(r,u)}},polyfill:function(e){if(e.nodeName.toLowerCase()==="form")return!0;var t=e.form.H5Form;t.placeholder(t,e),t.numberType(t,e)},checkSupport:function(e){e.browser={},e.browser.isRequiredNative="required"in e.field,e.browser.isPatternNative="pattern"in e.field,e.browser.isPlaceholderNative="placeholder"in e.field,e.browser.isAutofocusNative="autofocus"in e.field,e.browser.isFormnovalidateNative="formnovalidate"in e.field,e.field.setAttribute("type","email"),e.browser.isEmailNative=e.field.type=="email",e.field.setAttribute("type","url"),e.browser.isUrlNative=e.field.type=="url",e.field.setAttribute("type","number"),e.browser.isNumberNative=e.field.type=="number",e.field.setAttribute("type","range"),e.browser.isRangeNative=e.field.type=="range"},validateForm:function(){var e=this,t=e.elem,n=t.elements,r=n.length,i=!0;t.isValid=!0;for(var s=0;s<r;s++){var o=n[s];o.isRequired=!!o.required,o.isDisabled=!!o.disabled,o.isDisabled||(i=e.validateField(o),t.isValid&&!i&&e.setFocusOn(o),t.isValid=i&&t.isValid)}return e.options.doRenderMessage&&e.renderErrorMessages(e,t),t.isValid},validateField:function(t){var r=t.target||t;if(r.form===n)return null;var i=r.form.H5Form,s=e(r),o=!1,u=!!e(r).attr("required"),a=!!s.attr("disabled");r.isDisabled||(o=!i.browser.isRequiredNative&&u&&i.isValueMissing(i,r),isPatternMismatched=!i.browser.isPatternNative&&i.matchPattern(i,r)),r.validityState={valueMissing:o,patterMismatch:isPatternMismatched,valid:r.isDisabled||!o&&!isPatternMismatched},i.browser.isRequiredNative||(r.validityState.valueMissing?s.addClass(i.options.requiredClass):s.removeClass(i.options.requiredClass)),i.browser.isPatternNative||(r.validityState.patterMismatch?s.addClass(i.options.patternClass):s.removeClass(i.options.patternClass));if(!r.validityState.valid){s.addClass(i.options.invalidClass);var f=i.findLabel(s);f.addClass(i.options.invalidClass)}else{s.removeClass(i.options.invalidClass);var f=i.findLabel(s);f.removeClass(i.options.invalidClass)}return r.validityState.valid},isValueMissing:function(r,i){var s=e(i),o=/^(input|textarea|select)$/i,u=/^submit$/i,a=s.val(),f=i.type!==n?i.type:i.tagName.toLowerCase(),l=/^(checkbox|radio|fieldset)$/i;if(!l.test(f)&&!u.test(f)){if(a==="")return!0;if(!r.browser.isPlaceholderNative&&s.hasClass(r.options.placeholderClass))return!0}else if(l.test(f)){if(f==="checkbox")return!s.is(":checked");var c;f==="fieldset"?c=s.find("input"):c=t.getElementsByName(i.name);for(var h=0;h<c.length;h++)if(e(c[h]).is(":checked"))return!1;return!0}return!1},matchPattern:function(t,r){var i=e(r),s=!t.browser.isPlaceholderNative&&i.attr("placeholder")&&i.hasClass(t.options.placeholderClass)?"":i.attr("value"),o=i.attr("pattern"),u=i.attr("type");if(s!=="")if(u==="email"){var a=!0;if(i.attr("multiple")===n)return!t.options.emailPatt.test(s);s=s.split(t.options.mutipleDelimiter);for(var f=0;f<s.length;f++){a=t.options.emailPatt.test(s[f].replace(/[ ]*/g,""));if(!a)return!0}}else{if(u==="url")return!t.options.urlPatt.test(s);if(u==="text"&&o!==n)return usrPatt=new RegExp("^(?:"+o+")$"),!usrPatt.test(s)}return!1},placeholder:function(t,r,i){var s=e(r),o={placeholder:s.attr("placeholder")},u=/^(focusin|submit)$/i,a=/^(input|textarea)$/i,f=/^password$/i,l=t.browser.isPlaceholderNative;!l&&a.test(r.nodeName)&&!f.test(r.type)&&o.placeholder!==n&&(r.value===""&&!u.test(i)?(r.value=o.placeholder,s.addClass(t.options.placeholderClass)):r.value===o.placeholder&&u.test(i)&&(r.value="",s.removeClass(t.options.placeholderClass)))},numberType:function(t,n){var r=e(n);node=/^input$/i,type=r.attr("type");if(node.test(n.nodeName)&&(type=="number"&&!t.browser.isNumberNative||type=="range"&&!t.browser.isRangeNative)){var i=parseInt(r.attr("min")),s=parseInt(r.attr("max")),o=parseInt(r.attr("step")),u=parseInt(r.attr("value")),a=r.prop("attributes"),f=e("<select>"),l;i=isNaN(i)?-100:i;for(var c=i;c<=s;c+=o)l=e("<option>").attr("value",c).text(c),(u==c||u>c&&u<c+o)&&l.attr("selected",""),f.append(l);e.each(a,function(){f.attr(this.name,this.value)}),r.replaceWith(f)}},autofocus:function(n,r){var i=e(r),s=!!i.attr("autofocus"),o=/^(input|textarea|select|fieldset)$/i,u=/^submit$/i,a=n.browser.isAutofocusNative;!a&&o.test(r.nodeName)&&!u.test(r.type)&&s&&e(t).ready(function(){n.setFocusOn(r)})},findLabel:function(t){var n=e('label[for="'+t.attr("id")+'"]');if(n.length<=0){var r=t.parent(),i=r.get(0).tagName.toLowerCase();i=="label"&&(n=r)}return n},setFocusOn:function(t){t.tagName.toLowerCase()==="fieldset"?e(t).find(":first").focus():e(t).focus()},renderErrorMessages:function(t,n){var r=n.elements,i=r.length,s={};s.errors=new Array;while(i--){var o=e(r[i]),u=t.findLabel(o);o.hasClass(t.options.requiredClass)&&(s.errors[i]=u.text().replace("*","")+t.options.requiredMessage),o.hasClass(t.options.patternClass)&&(s.errors[i]=u.text().replace("*","")+t.options.patternMessage)}s.errors.length>0&&Joomla.renderMessages(s)}};e.fn.h5f=function(e){return this.each(function(){var t=Object.create(r);t.init(e,this)})},e.fn.h5f.options={invalidClass:"invalid",requiredClass:"required",requiredMessage:" is required.",placeholderClass:"placeholder",patternClass:"pattern",patternMessage:" doesn't match pattern.",doRenderMessage:!1,formValidationEvent:"onSubmit",emailPatt:/^[a-zA-Z0-9.!#$%&‚Äô*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,urlPatt:/[a-z][\-\.+a-z]*:\/\//i},e(function(){e("form").h5f({doRenderMessage:!0,requiredClass:"musthavevalue"})})})(jQuery,document);;

/* js_07afe8cd0a43ba707cef21d70bbed258.update_cart.js */
if(typeof Virtuemart==="undefined")
Virtuemart={};jQuery(function($){Virtuemart.customUpdateVirtueMartCartModule=function(el,options){var base=this;base.el=jQuery(".vmCartModule");base.options=jQuery.extend({},Virtuemart.customUpdateVirtueMartCartModule.defaults,options);base.init=function(){jQuery.ajaxSetup({cache:false})
jQuery.getJSON(Virtuemart.vmSiteurl+"index.php?option=com_virtuemart&nosef=1&view=cart&task=viewJS&format=json"+Virtuemart.vmLang,function(datas,textStatus){base.el.each(function(index,module){if(datas.totalProduct>0){jQuery(module).find(".vm_cart_products").html("");jQuery.each(datas.products,function(key,val){jQuery(module).find(".hiddencontainer .vmcontainer .product_row").clone().appendTo(jQuery(module).find(".vm_cart_products"));jQuery.each(val,function(key,val){jQuery(module).find(".vm_cart_products ."+key).last().html(val);});});}
jQuery(module).find(".show_cart").html(datas.cart_show);jQuery(module).find(".total_products").html(datas.totalProductTxt);jQuery(module).find(".total").html(datas.billTotal);});});};base.init();};Virtuemart.customUpdateVirtueMartCartModule.defaults={name1:'value1'};});jQuery(document).ready(function($){jQuery(document).off("updateVirtueMartCartModule","body",Virtuemart.customUpdateVirtueMartCartModule);jQuery(document).on("updateVirtueMartCartModule","body",Virtuemart.customUpdateVirtueMartCartModule);});;;

/* js_86566b8c602bc7ba996664ec17942abe.script.js */
var jaboxes=[];var jaboxoverlay=null;showBox=function(box,focusobj,caller,e){if(!jaboxoverlay){jaboxoverlay=new Element('div',{id:"jabox-overlay"}).injectBefore($(box));jaboxoverlay.setStyle('opacity',0.01);jaboxoverlay.addEvent('click',function(e){jaboxes.each(function(box){if(box.status=='show'){box.status='hide';box.setStyle('visibility','hidden');var fx=new Fx.Tween(box);fx.pause();fx.start('opacity',box.getStyle('opacity'),0);if(box._caller)box._caller.removeClass('show');}},this);jaboxoverlay.setStyle('display','none');});}
caller.blur();box=$(box);if(!box)return;if($(caller))box._caller=$(caller);if(!jaboxes.contains(box)){jaboxes.include(box);}
if(box.getStyle('display')=='none'){box.setStyles({display:'block',opacity:0});}
if(box.status=='show'){box.status='hide';box.setStyle('visibility','hidden');var fx=new Fx.Tween(box);fx.pause();fx.start('opacity',box.getStyle('opacity'),0);if(box._caller)box._caller.removeClass('show');jaboxoverlay.setStyle('display','none');}else{jaboxes.each(function(box1){if(box1!=box&&box1.status=='show'){box1.status='hide';box1.setStyle('visibility','hidden');var fx=new Fx.Tween(box1);fx.pause();fx.start('opacity',box1.getStyle('opacity'),0);if(box1._caller)box1._caller.removeClass('show');}},this);box.status='show';box.setStyle('visibility','visible');var fx=new Fx.Tween(box,{onComplete:function(){if($(focusobj))$(focusobj).focus();}});fx.pause();fx.start('opacity',box.getStyle('opacity'),1);if(box._caller)box._caller.addClass('show');jaboxoverlay.setStyle('display','block');}};;

