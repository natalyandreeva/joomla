/* 0d.jquery.noConflict.js */

jQuery.noConflict();;

/* 68.vmsite.js */

(function($){var undefined,methods={list:function(options){var dest=options.dest;var ids=options.ids;methods.update(this,dest,ids);$(this).change(function(){methods.update(this,dest)});},update:function(org,dest,ids){var opt=$(org),optValues=opt.val()||[],byAjax=[];if(!$.isArray(optValues))optValues=jQuery.makeArray(optValues);if(typeof oldValues!=="undefined"){$.each(oldValues,function(key,oldValue){if(($.inArray(oldValue,optValues))<0)$("#group"+oldValue+"").remove();});}
$.each(optValues,function(optkey,optValue){if(opt.data('d'+optValue)===undefined)byAjax.push(optValue);});if(byAjax.length>0){$.getJSON('index.php?option=com_virtuemart&view=state&format=json&virtuemart_country_id='+byAjax,function(result){var virtuemart_state_id=$('#virtuemart_state_id');var status=virtuemart_state_id.attr('required');if(status=='required'){if(result[byAjax].length>0){virtuemart_state_id.attr('required','required');}else{virtuemart_state_id.removeAttr('required');}}
$.each(result,function(key,value){if(value.length>0){opt.data('d'+key,value);}else{opt.data('d'+key,0);}});methods.addToList(opt,optValues,dest);if(typeof ids!=="undefined"){var states=ids.length?ids.split(','):[];$.each(states,function(k,id){$(dest).find('[value='+id+']').attr("selected","selected");});}
$(dest).trigger("liszt:updated");});}else{methods.addToList(opt,optValues,dest)
$(dest).trigger("liszt:updated");}
oldValues=optValues;},addToList:function(opt,values,dest){$.each(values,function(dataKey,dataValue){var groupExist=$("#group"+dataValue+"").size();if(!groupExist){var datas=opt.data('d'+dataValue);if(datas.length>0){var label=opt.find("option[value='"+dataValue+"']").text();var group='<optgroup id="group'+dataValue+'" label="'+label+'">';$.each(datas,function(key,value){if(value)group+='<option value="'+value.virtuemart_state_id+'">'+value.state_name+'</option>';});group+='</optgroup>';$(dest).append(group);}}});}};$.fn.vm2front=function(method){if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}else if(typeof method==='object'||!method){return methods.init.apply(this,arguments);}else{$.error('Method '+method+' does not exist on Vm2 front jQuery library');}};})(jQuery);

/* 19.facebox.js */

(function($){$.facebox=function(data,klass){$.facebox.loading()
if(data.ajax)fillFaceboxFromAjax(data.ajax,klass)
else if(data.iframe)fillFaceboxFromHref(data.iframe,klass,data.rev)
else if(data.image)fillFaceboxFromImage(data.image,klass)
else if(data.div)fillFaceboxFromHref(data.div,klass,data.rev)
else if(data.text)fillFaceboxFromText(data.text,klass)
else if($.isFunction(data))data.call($)
else $.facebox.reveal(data,klass)}
$.extend($.facebox,{settings:{opacity:0.2,overlay:true,loadingImage:'components/com_virtuemart/assets/images/facebox/loading.gif',closeImage:'components/com_virtuemart/assets/images/facebox/closelabel.png',imageTypes:['png','jpg','jpeg','gif'],faceboxHtml:'\
    <div id="facebox" style="display:none;"> \
      <div class="popup"> \
        <div class="content"> \
        </div> \
        <a href="#" class="close"></a> \
      </div> \
    </div>'},loading:function(){init()
if($('#facebox .loading').length==1)return true
showOverlay()
$('#facebox .content').empty()
$('#facebox .body').children().hide().end().append('<div class="loading"><img src="'+$.facebox.settings.loadingImage+'"/></div>')
$('#facebox').css({top:getPageScroll()[1]+($(window).height()/10),left:($(window).width()-$('#facebox').width())/2}).show()
$(document).bind('keydown.facebox',function(e){if(e.keyCode==27)$.facebox.close()
return true})
$(document).trigger('loading.facebox')},reveal:function(data,klass){$(document).trigger('beforeReveal.facebox')
if(klass)$('#facebox .content').addClass(klass)
$('#facebox .content').append(data)
$('#facebox .loading').remove()
$('#facebox .body').children().fadeIn('normal')
$('#facebox').css('left',$(window).width()/2-($('#facebox .popup').width()/2))
$(document).trigger('reveal.facebox').trigger('afterReveal.facebox')},close:function(){$(document).trigger('close.facebox')
return false}})
$.fn.facebox=function(settings){if($(this).length==0)return
init(settings)
function clickHandler(){$.facebox.loading(true)
var klass=this.rel.match(/facebox\[?\.(\w+)\]?/)
if(klass)klass=klass[1]
fillFaceboxFromHref(this.href,klass,this.rev)
return false}
return this.bind('click.facebox',clickHandler)}
function init(settings){if($.facebox.settings.inited)return true
else $.facebox.settings.inited=true
$(document).trigger('init.facebox')
makeCompatible()
var imageTypes=$.facebox.settings.imageTypes.join('|')
$.facebox.settings.imageTypesRegexp=new RegExp('\.('+imageTypes+')$','i')
if(settings)$.extend($.facebox.settings,settings)
$('body').append($.facebox.settings.faceboxHtml)
var preload=[new Image(),new Image()]
preload[0].src=$.facebox.settings.closeImage
preload[1].src=$.facebox.settings.loadingImage
$('#facebox').find('.b:first, .bl').each(function(){preload.push(new Image())
preload.slice(-1).src=$(this).css('background-image').replace(/url\((.+)\)/,'$1')})
$('#facebox .close').click($.facebox.close)
$('#facebox .close_image').attr('src',$.facebox.settings.closeImage)}
function getPageScroll(){var xScroll,yScroll;if(self.pageYOffset){yScroll=self.pageYOffset;xScroll=self.pageXOffset;}else if(document.documentElement&&document.documentElement.scrollTop){yScroll=document.documentElement.scrollTop;xScroll=document.documentElement.scrollLeft;}else if(document.body){yScroll=document.body.scrollTop;xScroll=document.body.scrollLeft;}
return new Array(xScroll,yScroll)}
function getPageHeight(){var windowHeight
if(self.innerHeight){windowHeight=self.innerHeight;}else if(document.documentElement&&document.documentElement.clientHeight){windowHeight=document.documentElement.clientHeight;}else if(document.body){windowHeight=document.body.clientHeight;}
return windowHeight}
function makeCompatible(){var $s=$.facebox.settings
$s.loadingImage=$s.loading_image||$s.loadingImage
$s.closeImage=$s.close_image||$s.closeImage
$s.imageTypes=$s.image_types||$s.imageTypes
$s.faceboxHtml=$s.facebox_html||$s.faceboxHtml}
function fillFaceboxFromHref(href,klass,rev){if(href.match(/#/)){var url=window.location.href.split('#')[0]
var target=href.replace(url,'')
if(target=='#')return
$.facebox.reveal($(target).html(),klass)}else if(rev.split('|')[0]=='iframe'){fillFaceboxFromIframe(href,klass,rev.split('|')[1],rev.split('|')[2])}else if(href.match($.facebox.settings.imageTypesRegexp)){fillFaceboxFromImage(href,klass)}else{fillFaceboxFromAjax(href,klass)}}
function fillFaceboxFromIframe(href,klass,height,width){$.facebox.reveal('<iframe scrolling="auto" marginwidth="0" width="'+width+'" height="'+height+'" frameborder="0" src="'+href+'" marginheight="0"></iframe>',klass)}
function fillFaceboxFromImage(href,klass){var image=new Image()
image.onload=function(){$.facebox.reveal('<div class="image"><img src="'+image.src+'" /></div>',klass)}
image.src=href}
function fillFaceboxFromText(text,klass){$.facebox.reveal('<div>'+text+'</div>',klass)}
function fillFaceboxFromAjax(href,klass){$.get(href,function(data){$.facebox.reveal(data,klass)})}
function skipOverlay(){return $.facebox.settings.overlay==false||$.facebox.settings.opacity===null}
function showOverlay(){if(skipOverlay())return
if($('#facebox_overlay').length==0)
$("body").append('<div id="facebox_overlay" class="facebox_hide"></div>')
$('#facebox_overlay').hide().addClass("facebox_overlayBG").css('opacity',$.facebox.settings.opacity).click(function(){$(document).trigger('close.facebox')}).fadeIn(200)
return false}
function hideOverlay(){if(skipOverlay())return
$('#facebox_overlay').fadeOut(200,function(){$("#facebox_overlay").removeClass("facebox_overlayBG")
$("#facebox_overlay").addClass("facebox_hide")
$("#facebox_overlay").remove()})
return false}
$(document).bind('close.facebox',function(){$(document).unbind('keydown.facebox')
$('#facebox').fadeOut(function(){$('#facebox .content').removeClass().addClass('content')
$('#facebox .loading').remove()
$(document).trigger('afterClose.facebox')})
hideOverlay()})
$(document).bind('afterReveal.facebox',function(){var windowHeight=$(window).height();var faceboxHeight=$('#facebox').height();if(faceboxHeight<windowHeight){var scrolltop=$(window).scrollTop();var top=Math.floor((windowHeight-faceboxHeight)/2)+scrolltop;$('#facebox').css('top',(top));}
else{$('#facebox').css('top',$(window).scrollTop());}});})(jQuery);;

/* b5.vmprices.js */

if(typeof Virtuemart==="undefined")
{var Virtuemart={setproducttype:function(form,id){form.view=null;var $=jQuery,datas=form.serialize();var prices=form.parents(".productdetails").find(".product-price");if(0==prices.length){prices=$("#productPrice"+id);}
datas=datas.replace("&view=cart","");prices.fadeTo("fast",0.75);$.getJSON(window.vmSiteurl+'index.php?option=com_virtuemart&nosef=1&view=productdetails&task=recalculate&virtuemart_product_id='+id+'&format=json'+window.vmLang,encodeURIComponent(datas),function(datas,textStatus){prices.fadeTo("fast",1);for(var key in datas){var value=datas[key];if(value!=0)prices.find("span.Price"+key).show().html(value);else prices.find(".Price"+key).html(0).hide();}});return false;},productUpdate:function(mod){var $=jQuery;$.ajaxSetup({cache:false})
$.getJSON(window.vmSiteurl+"index.php?option=com_virtuemart&nosef=1&view=cart&task=viewJS&format=json"+window.vmLang,function(datas,textStatus){if(datas.totalProduct>0){mod.find(".vm_cart_products").html("");$.each(datas.products,function(key,val){$("#hiddencontainer .container").clone().appendTo(".vmCartModule .vm_cart_products");$.each(val,function(key,val){if($("#hiddencontainer .container ."+key))mod.find(".vm_cart_products ."+key+":last").html(val);});});mod.find(".total").html(datas.billTotal);mod.find(".show_cart").html(datas.cart_show);}
mod.find(".total_products").html(datas.totalProductTxt);});},sendtocart:function(form){if(Virtuemart.addtocart_popup==1){Virtuemart.cartEffect(form);}else{form.append('<input type="hidden" name="task" value="add" />');form.submit();}},cartEffect:function(form){var $=jQuery;$.ajaxSetup({cache:false})
var datas=form.serialize();$.getJSON(vmSiteurl+'index.php?option=com_virtuemart&nosef=1&view=cart&task=addJS&format=json'+vmLang,encodeURIComponent(datas),function(datas,textStatus){if(datas.stat==1){var txt=form.find(".pname").val()+' '+vmCartText;$.facebox.settings.closeImage=closeImage;$.facebox.settings.loadingImage=loadingImage;$.facebox.settings.faceboxHtml=faceboxHtml;$.facebox({text:datas.msg+"<H4>"+txt+"</H4>"},'my-groovy-style');}else if(datas.stat==2){var value=form.find('.quantity-input').val();var txt=form.find(".pname").val();$.facebox.settings.closeImage=closeImage;$.facebox.settings.loadingImage=loadingImage;$.facebox.settings.faceboxHtml=faceboxHtml;$.facebox({text:datas.msg+"<H4>"+txt+"</H4>"},'my-groovy-style');}else{$.facebox.settings.closeImage=closeImage;$.facebox.settings.loadingImage=loadingImage;$.facebox.settings.faceboxHtml=faceboxHtml;$.facebox({text:"<H4>"+vmCartError+"</H4>"+datas.msg},'my-groovy-style');}
if($(".vmCartModule")[0]){Virtuemart.productUpdate($(".vmCartModule"));}});$.ajaxSetup({cache:true});},product:function(carts){carts.each(function(){var cart=jQuery(this),addtocart=cart.find('input.addtocart-button'),plus=cart.find('.quantity-plus'),minus=cart.find('.quantity-minus'),select=cart.find('select'),radio=cart.find('input:radio'),virtuemart_product_id=cart.find('input[name="virtuemart_product_id[]"]').val(),quantity=cart.find('.quantity-input');addtocart.click(function(e){Virtuemart.sendtocart(cart);return false;});plus.click(function(){var Qtt=parseInt(quantity.val());if(!isNaN(Qtt)){quantity.val(Qtt+1);Virtuemart.setproducttype(cart,virtuemart_product_id);}});minus.click(function(){var Qtt=parseInt(quantity.val());if(!isNaN(Qtt)&&Qtt>1){quantity.val(Qtt-1);}else quantity.val(1);Virtuemart.setproducttype(cart,virtuemart_product_id);});select.change(function(){Virtuemart.setproducttype(cart,virtuemart_product_id);});radio.change(function(){Virtuemart.setproducttype(cart,virtuemart_product_id);});quantity.keyup(function(){Virtuemart.setproducttype(cart,virtuemart_product_id);});});}};jQuery.noConflict();jQuery(document).ready(function($){Virtuemart.product($("form.product"));$("form.js-recalculate").each(function(){if($(this).find(".product-fields").length){var id=$(this).find('input[name="virtuemart_product_id[]"]').val();Virtuemart.setproducttype($(this),id);}});});};

/*  */
/*
		MIT-style license
 @author		Harald Kirschner <mail [at] digitarald.de>
 @author		Rouven Weßling <me [at] rouvenwessling.de>
 @copyright	Author
*/
var SqueezeBox={presets:{onOpen:function(){},onClose:function(){},onUpdate:function(){},onResize:function(){},onMove:function(){},onShow:function(){},onHide:function(){},size:{x:600,y:450},sizeLoading:{x:200,y:150},marginInner:{x:20,y:20},marginImage:{x:50,y:75},handler:!1,target:null,closable:!0,closeBtn:!0,zIndex:65555,overlayOpacity:0.7,classWindow:"",classOverlay:"",overlayFx:{},resizeFx:{},contentFx:{},parse:!1,parseSecure:!1,shadow:!0,overlay:!0,document:null,ajaxOptions:{}},initialize:function(a){if(this.options)return this;
this.presets=Object.merge(this.presets,a);this.doc=this.presets.document||document;this.options={};this.setOptions(this.presets).build();this.bound={window:this.reposition.bind(this,[null]),scroll:this.checkTarget.bind(this),close:this.close.bind(this),key:this.onKey.bind(this)};this.isOpen=this.isLoading=!1;return this},build:function(){this.overlay=new Element("div",{id:"sbox-overlay","aria-hidden":"true",styles:{zIndex:this.options.zIndex},tabindex:-1});this.win=new Element("div",{id:"sbox-window",
role:"dialog","aria-hidden":"true",styles:{zIndex:this.options.zIndex+2}});if(this.options.shadow)if(Browser.chrome||Browser.safari&&3<=Browser.version||Browser.opera&&10.5<=Browser.version||Browser.firefox&&3.5<=Browser.version||Browser.ie&&9<=Browser.version)this.win.addClass("shadow");else if(!Browser.ie6){var a=(new Element("div",{"class":"sbox-bg-wrap"})).inject(this.win),b=function(a){this.overlay.fireEvent("click",[a])}.bind(this);"n,ne,e,se,s,sw,w,nw".split(",").each(function(c){(new Element("div",
{"class":"sbox-bg sbox-bg-"+c})).inject(a).addEvent("click",b)})}this.content=(new Element("div",{id:"sbox-content"})).inject(this.win);this.closeBtn=(new Element("a",{id:"sbox-btn-close",href:"#",role:"button"})).inject(this.win);this.closeBtn.setProperty("aria-controls","sbox-window");this.fx={overlay:(new Fx.Tween(this.overlay,Object.merge({property:"opacity",onStart:Events.prototype.clearChain,duration:250,link:"cancel"},this.options.overlayFx))).set(0),win:new Fx.Morph(this.win,Object.merge({onStart:Events.prototype.clearChain,
unit:"px",duration:750,transition:Fx.Transitions.Quint.easeOut,link:"cancel",unit:"px"},this.options.resizeFx)),content:(new Fx.Tween(this.content,Object.merge({property:"opacity",duration:250,link:"cancel"},this.options.contentFx))).set(0)};document.id(this.doc.body).adopt(this.overlay,this.win)},assign:function(a,b){return(document.id(a)||$$(a)).addEvent("click",function(){return!SqueezeBox.fromElement(this,b)})},open:function(a,b){this.initialize();null!=this.element&&this.trash();this.element=
document.id(a)||!1;this.setOptions(Object.merge(this.presets,b||{}));if(this.element&&this.options.parse){var c=this.element.getProperty(this.options.parse);c&&(c=JSON.decode(c,this.options.parseSecure))&&this.setOptions(c)}this.url=(this.element?this.element.get("href"):a)||this.options.url||"";this.assignOptions();var d=d||this.options.handler;return d?this.setContent(d,this.parsers[d].call(this,!0)):this.parsers.some(function(a,b){var c=a.call(this);return c?(this.setContent(b,c),!0):!1},this)},
fromElement:function(a,b){return this.open(a,b)},assignOptions:function(){this.overlay.addClass(this.options.classOverlay);this.win.addClass(this.options.classWindow)},close:function(a){var b="domevent"==typeOf(a);b&&a.stop();if(!this.isOpen||b&&!Function.from(this.options.closable).call(this,a))return this;this.fx.overlay.start(0).chain(this.toggleOverlay.bind(this));this.win.setProperty("aria-hidden","true");this.fireEvent("onClose",[this.content]);this.trash();this.toggleListeners();this.isOpen=
!1;return this},trash:function(){this.element=this.asset=null;this.content.empty();this.options={};this.removeEvents().setOptions(this.presets).callChain()},onError:function(){this.asset=null;this.setContent("string",this.options.errorMsg||"An error occurred")},setContent:function(a,b){if(!this.handlers[a])return!1;this.content.className="sbox-content-"+a;this.applyTimer=this.applyContent.delay(this.fx.overlay.options.duration,this,this.handlers[a].call(this,b));if(this.overlay.retrieve("opacity"))return this;
this.toggleOverlay(!0);this.fx.overlay.start(this.options.overlayOpacity);return this.reposition()},applyContent:function(a,b){if(this.isOpen||this.applyTimer)this.applyTimer=clearTimeout(this.applyTimer),this.hideContent(),a?(this.isLoading&&this.toggleLoading(!1),this.fireEvent("onUpdate",[this.content],20)):this.toggleLoading(!0),a&&(["string","array"].contains(typeOf(a))?this.content.set("html",a):a!==this.content&&this.content.contains(a)||this.content.adopt(a)),this.callChain(),this.isOpen?
this.resize(b):(this.toggleListeners(!0),this.resize(b,!0),this.isOpen=!0,this.win.setProperty("aria-hidden","false"),this.fireEvent("onOpen",[this.content]))},resize:function(a,b){this.showTimer=clearTimeout(this.showTimer||null);var c=this.doc.getSize(),d=this.doc.getScroll();this.size=Object.merge(this.isLoading?this.options.sizeLoading:this.options.size,a);this.size.x==self.getSize().x&&(this.size.y-=50,this.size.x-=20);c={width:this.size.x,height:this.size.y,left:(d.x+(c.x-this.size.x-this.options.marginInner.x)/
2).toInt(),top:(d.y+(c.y-this.size.y-this.options.marginInner.y)/2).toInt()};this.hideContent();b?(this.win.setStyles(c),this.showTimer=this.showContent.delay(50,this)):this.fx.win.start(c).chain(this.showContent.bind(this));return this.reposition()},toggleListeners:function(a){a=a?"addEvent":"removeEvent";this.closeBtn[a]("click",this.bound.close);this.overlay[a]("click",this.bound.close);this.doc[a]("keydown",this.bound.key)[a]("mousewheel",this.bound.scroll);this.doc.getWindow()[a]("resize",this.bound.window)[a]("scroll",
this.bound.window)},toggleLoading:function(a){this.isLoading=a;this.win[a?"addClass":"removeClass"]("sbox-loading");a&&(this.win.setProperty("aria-busy",a),this.fireEvent("onLoading",[this.win]))},toggleOverlay:function(a){if(this.options.overlay){var b=this.doc.getSize().x;this.overlay.set("aria-hidden",a?"false":"true");this.doc.body[a?"addClass":"removeClass"]("body-overlayed");a?this.scrollOffset=this.doc.getWindow().getSize().x-b:this.doc.body.setStyle("margin-right","")}},showContent:function(){this.content.get("opacity")&&
this.fireEvent("onShow",[this.win]);this.fx.content.start(1)},hideContent:function(){this.content.get("opacity")||this.fireEvent("onHide",[this.win]);this.fx.content.cancel().set(0)},onKey:function(a){switch(a.key){case "esc":this.close(a);case "up":case "down":return!1}},checkTarget:function(a){return a.target!==this.content&&this.content.contains(a.target)},reposition:function(){var a=this.doc.getSize(),b=this.doc.getScroll(),c=this.doc.getScrollSize(),d=this.overlay.getStyles("height"),d=parseInt(d.height);
c.y>d&&a.y>=d&&(this.overlay.setStyles({width:c.x+"px",height:c.y+"px"}),this.win.setStyles({left:(b.x+(a.x-this.win.offsetWidth)/2-this.scrollOffset).toInt()+"px",top:(b.y+(a.y-this.win.offsetHeight)/2).toInt()+"px"}));return this.fireEvent("onMove",[this.overlay,this.win])},removeEvents:function(a){if(!this.$events)return this;a?this.$events[a]&&(this.$events[a]=null):this.$events=null;return this},extend:function(a){return Object.append(this,a)},handlers:new Hash,parsers:new Hash};SqueezeBox.extend(new Events(function(){})).extend(new Options(function(){})).extend(new Chain(function(){}));
SqueezeBox.parsers.extend({image:function(a){return a||/\.(?:jpg|png|gif)$/i.test(this.url)?this.url:!1},clone:function(a){if(document.id(this.options.target))return document.id(this.options.target);if(this.element&&!this.element.parentNode)return this.element;var b=this.url.match(/#([\w-]+)$/);return b?document.id(b[1]):a?this.element:!1},ajax:function(a){return a||this.url&&!/^(?:javascript|#)/i.test(this.url)?this.url:!1},iframe:function(a){return a||this.url?this.url:!1},string:function(){return!0}});
SqueezeBox.handlers.extend({image:function(a){var b,c=new Image;this.asset=null;c.onload=c.onabort=c.onerror=function(){c.onload=c.onabort=c.onerror=null;if(c.width){var a=this.doc.getSize();a.x-=this.options.marginImage.x;a.y-=this.options.marginImage.y;b={x:c.width,y:c.height};for(var e=2;e--;)if(b.x>a.x)b.y*=a.x/b.x,b.x=a.x;else if(b.y>a.y)b.x*=a.y/b.y,b.y=a.y;b.x=b.x.toInt();b.y=b.y.toInt();this.asset=document.id(c);c=null;this.asset.width=b.x;this.asset.height=b.y;this.applyContent(this.asset,
b)}else this.onError.delay(10,this)}.bind(this);c.src=a;if(c&&c.onload&&c.complete)c.onload();return this.asset?[this.asset,b]:null},clone:function(a){return a?a.clone():this.onError()},adopt:function(a){return a?a:this.onError()},ajax:function(a){var b=this.options.ajaxOptions||{};this.asset=(new Request.HTML(Object.merge({method:"get",evalScripts:!1},this.options.ajaxOptions))).addEvents({onSuccess:function(a){this.applyContent(a);null!==b.evalScripts&&!b.evalScripts&&Browser.exec(this.asset.response.javascript);
this.fireEvent("onAjax",[a,this.asset]);this.asset=null}.bind(this),onFailure:this.onError.bind(this)});this.asset.send.delay(10,this.asset,[{url:a}])},iframe:function(a){this.asset=new Element("iframe",Object.merge({src:a,frameBorder:0,width:this.options.size.x,height:this.options.size.y},this.options.iframeOptions));return this.options.iframePreload?(this.asset.addEvent("load",function(){this.applyContent(this.asset.setStyle("display",""))}.bind(this)),this.asset.setStyle("display","none").inject(this.content),
!1):this.asset},string:function(a){return a}});SqueezeBox.handlers.url=SqueezeBox.handlers.ajax;SqueezeBox.parsers.url=SqueezeBox.parsers.ajax;SqueezeBox.parsers.adopt=SqueezeBox.parsers.clone;

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

/* e2.iphone.js */

var JAIToolbox=new Class({initialize:function(options){this.options=$extend({animOn:false,axis:'x',slideInterval:0,slideSpeed:20},options||{});window.addEvent('domready',this.start.bind(this));},start:function(){this._backs=[];this._currenttoggle=null;this._last=null;this._links=$$('a');this._back=$('toolbar-back');this._close=$('toolbar-close');this._title=$('toolbar-title');this._boxes=$$('.toolbox');this._boxes2=$$('.toolbox');if(!this._boxes||!this._boxes.length)return;this._overlay=$('ja-overlay');this._mainbox=$('ja-toolbar-main');if(this.options.animOn){this._boxes.setStyle('opacity',0);this._overlay.setStyle('opacity',0);this._boxes.push($('ja-toolbar-main'));this._boxes.push(this._overlay);this._fx=new Fx.Elements(this._boxes,{'onComplete':this.slidedone.bind(this)});}
var top=(this._boxes&&this._boxes.length)?this._boxes[0].getCoordinates().top:0;this._links.each(function(link){if(link.href&&link.hash&&link.hash!="#"){link._box=$(link.hash.substr(1));if(!link._box||!link._box.hasClass('toolbox'))return;link._box._link=link;link._h=top+link._box.getCoordinates().height;if(link.hasClass('ip-button')){link.addEvent('click',function(e){new Event(e).stop();this.togglebox(link);return false;}.bind(this));}else{link.addEvent('click',function(e){new Event(e).stop();this.showbox(link,true);return false;}.bind(this));}}},this);if(this._back){this._back.addEvent('click',function(e){new Event(e).stop();this.back();return false;}.bind(this));}
if(this._close){this._close.addEvent('click',function(e){new Event(e).stop();this.close();return false;}.bind(this));}
this._overlay.addEvent('click',function(e){this.close();return false;}.bind(this));},slidedone:function(){if(this._currenttoggle==null){this._overlay.setStyle('display','none');}},togglebox:function(link){if(this._currenttoggle==link){this.close();}
if(this._currenttoggle==null){this._overlay.setStyles({'display':'block','height':$('ja-wrapper').offsetHeight});}
this.showbox(link,true);this._currenttoggle=link;},showbox:function(link,addback){if(this.options.animOn)this.showbox2(link,addback);else this.showbox1(link,addback);},close:function(){if(this.options.animOn)this.close2();else this.close1();},showbox1:function(link,addback){this._boxes2.setStyle('display','none');link._box.setStyle('display','block');this._mainbox.setStyle('height',link._h);if(addback&&this._last){this._backs.push(this._last);}
this._last=link;this.updatestatus(link);},close1:function(){this._boxes2.setStyle('display','none');this._mainbox.setStyle('height',0);this._overlay.setStyle('display','none');this._backs=[];this._currenttoggle=null;this._last=null;},showbox2:function(link,addback){this._fx.stop();objs={};for(i=0;i<this._boxes.length-2;i++){if(this._boxes[i]!=link._box){objs[i]={'opacity':0};}else{objs[i]={'opacity':1};}}
objs[this._boxes.length-2]={'height':link._h};if(this._currenttoggle==null){objs[this._boxes.length-1]={'opacity':0.7};}
this._fx.start(objs);if(addback&&this._last){this._backs.push(this._last);}
this._last=link;this.updatestatus(link);},close2:function(){this._fx.stop();objs={};for(i=0;i<this._boxes.length-2;i++){objs[i]={'opacity':0};}
objs[this._boxes.length-2]={'height':0};objs[this._boxes.length-1]={'opacity':0};this._fx.start(objs);this._backs=[];this._currenttoggle=null;this._last=null;},updatestatus:function(link){this._title.innerHTML=link.title;if((lastlink=this._backs.getLast())){this._back.innerHTML=lastlink.title;this._back.setStyle('display','block');}else{this._back.innerHTML='';this._back.setStyle('display','none');}},back:function(){if((link=this._backs.pop())){this.showbox(link);}}})
new JAIToolbox();;

