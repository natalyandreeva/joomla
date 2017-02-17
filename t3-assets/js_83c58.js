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

/* 62.script.js */

var jaboxes=[];var jaboxoverlay=null;showBox=function(box,focusobj,caller,e){if(!jaboxoverlay){jaboxoverlay=new Element('div',{id:"jabox-overlay"}).injectBefore($(box));jaboxoverlay.setStyle('opacity',0.01);jaboxoverlay.addEvent('click',function(e){jaboxes.each(function(box){if(box.status=='show'){box.status='hide';box.setStyle('visibility','hidden');var fx=new Fx.Tween(box);fx.pause();fx.start('opacity',box.getStyle('opacity'),0);if(box._caller)box._caller.removeClass('show');}},this);jaboxoverlay.setStyle('display','none');});}
caller.blur();box=$(box);if(!box)return;if($(caller))box._caller=$(caller);if(!jaboxes.contains(box)){jaboxes.include(box);}
if(box.getStyle('display')=='none'){box.setStyles({display:'block',opacity:0});}
if(box.status=='show'){box.status='hide';box.setStyle('visibility','hidden');var fx=new Fx.Tween(box);fx.pause();fx.start('opacity',box.getStyle('opacity'),0);if(box._caller)box._caller.removeClass('show');jaboxoverlay.setStyle('display','none');}else{jaboxes.each(function(box1){if(box1!=box&&box1.status=='show'){box1.status='hide';box1.setStyle('visibility','hidden');var fx=new Fx.Tween(box1);fx.pause();fx.start('opacity',box1.getStyle('opacity'),0);if(box1._caller)box1._caller.removeClass('show');}},this);box.status='show';box.setStyle('visibility','visible');var fx=new Fx.Tween(box,{onComplete:function(){if($(focusobj))$(focusobj).focus();}});fx.pause();fx.start('opacity',box.getStyle('opacity'),1);if(box._caller)box._caller.addClass('show');jaboxoverlay.setStyle('display','block');}};

