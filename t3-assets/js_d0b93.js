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

/* 41.jquery.validationEngine.js */

(function($){var methods={init:function(options){var form=this;if(!form.data('jqv')||form.data('jqv')==null){methods._saveOptions(form,options);$(".formError").live("click",function(){$(this).fadeOut(150,function(){$(this).remove();});});}},attach:function(userOptions){var form=this;var options;if(userOptions)
options=methods._saveOptions(form,userOptions);else
options=form.data('jqv');if(!options.binded){if(options.bindMethod=="bind"){form.find("[class*=validate]:not([type=checkbox])").bind(options.validationEventTrigger,methods._onFieldEvent);form.find("[class*=validate][type=checkbox]").bind("click",methods._onFieldEvent);form.bind("submit",methods._onSubmitEvent);}else if(options.bindMethod=="live"){form.find("[class*=validate]:not([type=checkbox])").live(options.validationEventTrigger,methods._onFieldEvent);form.find("[class*=validate][type=checkbox]").live("click",methods._onFieldEvent);form.live("submit",methods._onSubmitEvent);}
options.binded=true;}},detach:function(){var form=this;var options=form.data('jqv');if(options.binded){form.find("[class*=validate]").not("[type=checkbox]").unbind(options.validationEventTrigger,methods._onFieldEvent);form.find("[class*=validate][type=checkbox]").unbind("click",methods._onFieldEvent);form.unbind("submit",methods.onAjaxFormComplete);form.find("[class*=validate]").not("[type=checkbox]").die(options.validationEventTrigger,methods._onFieldEvent);form.find("[class*=validate][type=checkbox]").die("click",methods._onFieldEvent);form.die("submit",methods.onAjaxFormComplete);form.removeData('jqv');}},validate:function(){return methods._validateFields(this);},validateField:function(el){var options=$(this).data('jqv');return methods._validateField($(el),options);},validateform:function(){return methods._onSubmitEvent.call(this);},showPrompt:function(promptText,type,promptPosition,showArrow){var form=this.closest('form');var options=form.data('jqv');if(!options)options=methods._saveOptions(this,options);if(promptPosition)
options.promptPosition=promptPosition;options.showArrow=showArrow==true;methods._showPrompt(this,promptText,type,false,options);},hidePrompt:function(){var promptClass="."+methods._getClassName($(this).attr("id"))+"formError"
$(promptClass).fadeTo("fast",0.3,function(){$(this).remove();});},hide:function(){if($(this).is("form")){var closingtag="parentForm"+$(this).attr('id');}else{var closingtag=$(this).attr('id')+"formError"}
$('.'+closingtag).fadeTo("fast",0.3,function(){$(this).remove();});},hideAll:function(){$('.formError').fadeTo("fast",0.3,function(){$(this).remove();});},_onFieldEvent:function(){var field=$(this);var form=field.closest('form');var options=form.data('jqv');methods._validateField(field,options);},_onSubmitEvent:function(){var form=$(this);var options=form.data('jqv');var r=methods._validateFields(form,true);if(r&&options.ajaxFormValidation){methods._validateFormWithAjax(form,options);return false;}
if(options.onValidationComplete){options.onValidationComplete(form,r);return false;}
return r;},_checkAjaxStatus:function(options){var status=true;$.each(options.ajaxValidCache,function(key,value){if(!value){status=false;return false;}});return status;},_validateFields:function(form,skipAjaxValidation){var options=form.data('jqv');var errorFound=false;form.trigger("jqv.form.validating")
form.find('[class*=validate]').not(':hidden').each(function(){var field=$(this);errorFound|=methods._validateField(field,options,skipAjaxValidation);});form.trigger("jqv.form.result",[errorFound])
if(errorFound){if(options.scroll){var destination=Number.MAX_VALUE;var lst=$(".formError:not('.greenPopup')");for(var i=0;i<lst.length;i++){var d=$(lst[i]).offset().top;if(d<destination)
destination=d;}
if(!options.isOverflown)
$("html:not(:animated),body:not(:animated)").animate({scrollTop:destination},1100);else{var overflowDIV=$(options.overflownDIV);var scrollContainerScroll=overflowDIV.scrollTop();var scrollContainerPos=-parseInt(overflowDIV.offset().top);destination+=scrollContainerScroll+scrollContainerPos-5;var scrollContainer=$(options.overflownDIV+":not(:animated)");scrollContainer.animate({scrollTop:destination},1100);}}
return false;}
return true;},_validateFormWithAjax:function(form,options){var data=form.serialize();var url=(options.ajaxFormValidationURL)?options.ajaxFormValidationURL:form.attr("action");$.ajax({type:"GET",url:url,cache:false,dataType:"json",data:data,form:form,methods:methods,options:options,beforeSend:function(){return options.onBeforeAjaxFormValidation(form,options);},error:function(data,transport){methods._ajaxError(data,transport);},success:function(json){if(json!==true){var errorInForm=false;for(var i=0;i<json.length;i++){var value=json[i];var errorFieldId=value[0];var errorField=$($("#"+errorFieldId)[0]);if(errorField.length==1){var msg=value[2];if(value[1]==true){if(msg==""||!msg){methods._closePrompt(errorField);}else{if(options.allrules[msg]){var txt=options.allrules[msg].alertTextOk;if(txt)
msg=txt;}
methods._showPrompt(errorField,msg,"pass",false,options,true);}}else{errorInForm|=true;if(options.allrules[msg]){var txt=options.allrules[msg].alertText;if(txt)
msg=txt;}
methods._showPrompt(errorField,msg,"",false,options,true);}}}
options.onAjaxFormComplete(!errorInForm,form,json,options);}else
options.onAjaxFormComplete(true,form,"",options);}});},_validateField:function(field,options,skipAjaxValidation){if(!field.attr("id"))
$.error("jQueryValidate: an ID attribute is required for this field: "+field.attr("name")+" class:"+
field.attr("class"));var rulesParsing=field.attr('class');var getRules=/validate\[(.*)\]/.exec(rulesParsing);if(!getRules)
return false;var str=getRules[1];var rules=str.split(/\[|,|\]/);var isAjaxValidator=false;var fieldName=field.attr("name");var promptText="";var required=false;options.isError=false;options.showArrow=true;optional=false;for(var i=0;i<rules.length;i++){var errorMsg=undefined;switch(rules[i]){case"optional":optional=true;break;case"required":required=true;errorMsg=methods._required(field,rules,i,options);break;case"custom":errorMsg=methods._customRegex(field,rules,i,options);break;case"ajax":if(!skipAjaxValidation){methods._ajax(field,rules,i,options);isAjaxValidator=true;}
break;case"minSize":errorMsg=methods._minSize(field,rules,i,options);break;case"maxSize":errorMsg=methods._maxSize(field,rules,i,options);break;case"min":errorMsg=methods._min(field,rules,i,options);break;case"max":errorMsg=methods._max(field,rules,i,options);break;case"past":errorMsg=methods._past(field,rules,i,options);break;case"future":errorMsg=methods._future(field,rules,i,options);break;case"maxCheckbox":errorMsg=methods._maxCheckbox(field,rules,i,options);field=$($("input[name='"+fieldName+"']"));break;case"minCheckbox":errorMsg=methods._minCheckbox(field,rules,i,options);field=$($("input[name='"+fieldName+"']"));break;case"equals":errorMsg=methods._equals(field,rules,i,options);break;case"funcCall":errorMsg=methods._funcCall(field,rules,i,options);break;default:}
if(errorMsg!==undefined){promptText+=errorMsg+"<br/>";options.isError=true;}}
if(!required){if(field.val()=="")options.isError=false;}
var fieldType=field.attr("type");if((fieldType=="radio"||fieldType=="checkbox")&&$("input[name='"+fieldName+"']").size()>1){field=$($("input[name='"+fieldName+"'][type!=hidden]:first"));options.showArrow=false;}
if(options.isError){methods._showPrompt(field,promptText,"",false,options);}else{if(!isAjaxValidator)methods._closePrompt(field);}
field.closest('form').trigger("jqv.field.error",[field,options.isError,promptText])
return options.isError;},_required:function(field,rules,i,options){switch(field.attr("type")){case"text":case"password":case"textarea":case"file":default:if(!field.val())
return options.allrules[rules[i]].alertText;break;case"radio":case"checkbox":var name=field.attr("name");if($("input[name='"+name+"']:checked").size()==0){if($("input[name='"+name+"']").size()==1)
return options.allrules[rules[i]].alertTextCheckboxe;else
return options.allrules[rules[i]].alertTextCheckboxMultiple;}
break;case"select-one":if(!field.val())
return options.allrules[rules[i]].alertText;break;case"select-multiple":if(!field.find("option:selected").val())
return options.allrules[rules[i]].alertText;break;}},_customRegex:function(field,rules,i,options){var customRule=rules[i+1];var rule=options.allrules[customRule];if(!rule){alert("jqv:custom rule not found "+customRule);return;}
var ex=rule.regex;if(!ex){alert("jqv:custom regex not found "+customRule);return;}
var pattern=new RegExp(ex);if(!pattern.test(field.attr('value')))
return options.allrules[customRule].alertText;},_funcCall:function(field,rules,i,options){var functionName=rules[i+1];var fn=window[functionName];if(typeof(fn)=='function')
return fn(field,rules,i,options);},_equals:function(field,rules,i,options){var equalsField=rules[i+1];if(field.attr('value')!=$("#"+equalsField).attr('value'))
return options.allrules.equals.alertText;},_maxSize:function(field,rules,i,options){var max=rules[i+1];var len=field.attr('value').length;if(len>max){var rule=options.allrules.maxSize;return rule.alertText+max+rule.alertText2;}},_minSize:function(field,rules,i,options){var min=rules[i+1];var len=field.attr('value').length;if(len<min){var rule=options.allrules.minSize;return rule.alertText+min+rule.alertText2;}},_min:function(field,rules,i,options){var min=parseFloat(rules[i+1]);var len=parseFloat(field.attr('value'));if(len<min){var rule=options.allrules.min;if(rule.alertText2)return rule.alertText+min+rule.alertText2;return rule.alertText+min;}},_max:function(field,rules,i,options){var max=parseFloat(rules[i+1]);var len=parseFloat(field.attr('value'));if(len>max){var rule=options.allrules.max;if(rule.alertText2)return rule.alertText+max+rule.alertText2;return rule.alertText+max;}},_past:function(field,rules,i,options){var p=rules[i+1];var pdate=(p.toLowerCase()=="now")?new Date():methods._parseDate(p);var vdate=methods._parseDate(field.attr('value'));if(vdate<pdate){var rule=options.allrules.past;if(rule.alertText2)return rule.alertText+methods._dateToString(pdate)+rule.alertText2;return rule.alertText+methods._dateToString(pdate);}},_future:function(field,rules,i,options){var p=rules[i+1];var pdate=(p.toLowerCase()=="now")?new Date():methods._parseDate(p);var vdate=methods._parseDate(field.attr('value'));if(vdate>pdate){var rule=options.allrules.future;if(rule.alertText2)return rule.alertText+methods._dateToString(pdate)+rule.alertText2;return rule.alertText+methods._dateToString(pdate);}},_maxCheckbox:function(field,rules,i,options){var nbCheck=rules[i+1];var groupname=field.attr("name");var groupSize=$("input[name='"+groupname+"']:checked").size();if(groupSize>nbCheck){options.showArrow=false;if(options.allrules.maxCheckbox.alertText2)return options.allrules.maxCheckbox.alertText+" "+nbCheck+" "+options.allrules.maxCheckbox.alertText2;return options.allrules.maxCheckbox.alertText;}},_minCheckbox:function(field,rules,i,options){var nbCheck=rules[i+1];var groupname=field.attr("name");var groupSize=$("input[name='"+groupname+"']:checked").size();if(groupSize<nbCheck){options.showArrow=false;return options.allrules.minCheckbox.alertText+" "+nbCheck+" "+
options.allrules.minCheckbox.alertText2;}},_ajax:function(field,rules,i,options){var errorSelector=rules[i+1];var rule=options.allrules[errorSelector];var extraData=rule.extraData;var extraDataDynamic=rule.extraDataDynamic;if(!extraData)
extraData="";if(extraDataDynamic){var tmpData=[];var domIds=String(extraDataDynamic).split(",");for(var i=0;i<domIds.length;i++){var id=domIds[i];if($(id).length){var inputValue=field.closest("form").find(id).attr("value");var keyValue=id.replace('#','')+'='+escape(inputValue);tmpData.push(keyValue);}}
extraDataDynamic=tmpData.join("&");}else{extraDataDynamic="";}
if(!options.isError){$.ajax({type:"GET",url:rule.url,cache:false,dataType:"json",data:"fieldId="+field.attr("id")+"&fieldValue="+field.attr("value")+"&extraData="+extraData+"&"+extraDataDynamic,field:field,rule:rule,methods:methods,options:options,beforeSend:function(){var loadingText=rule.alertTextLoad;if(loadingText)
methods._showPrompt(field,loadingText,"load",true,options);},error:function(data,transport){methods._ajaxError(data,transport);},success:function(json){var errorFieldId=json[0];var errorField=$($("#"+errorFieldId)[0]);if(errorField.length==1){var status=json[1];var msg=json[2];if(!status){options.ajaxValidCache[errorFieldId]=false;options.isError=true;if(msg){if(options.allrules[msg]){var txt=options.allrules[msg].alertText;if(txt)
msg=txt;}}
else
msg=rule.alertText;methods._showPrompt(errorField,msg,"",true,options);}else{if(options.ajaxValidCache[errorFieldId]!==undefined)
options.ajaxValidCache[errorFieldId]=true;if(msg){if(options.allrules[msg]){var txt=options.allrules[msg].alertTextOk;if(txt)
msg=txt;}}
else
msg=rule.alertTextOk;if(msg)
methods._showPrompt(errorField,msg,"pass",true,options);else
methods._closePrompt(errorField);}}}});}},_ajaxError:function(data,transport){if(data.status==0&&transport==null)
alert("The page is not served from a server! ajax call failed");else if(typeof console!="undefined")
console.log("Ajax error: "+data.status+" "+transport);},_dateToString:function(date){return date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();},_parseDate:function(d){var dateParts=d.split("-");if(dateParts==d)
dateParts=d.split("/");return new Date(dateParts[0],(dateParts[1]-1),dateParts[2]);},_showPrompt:function(field,promptText,type,ajaxed,options,ajaxform){var prompt=methods._getPrompt(field);if(ajaxform)prompt=false;if(prompt)
methods._updatePrompt(field,prompt,promptText,type,ajaxed,options);else
methods._buildPrompt(field,promptText,type,ajaxed,options);},_buildPrompt:function(field,promptText,type,ajaxed,options){var prompt=$('<div>');prompt.addClass(methods._getClassName(field.attr("id"))+"formError");if(field.is(":input"))prompt.addClass("parentForm"+methods._getClassName(field.parents('form').attr("id")));prompt.addClass("formError");switch(type){case"pass":prompt.addClass("greenPopup");break;case"load":prompt.addClass("blackPopup");}
if(ajaxed)
prompt.addClass("ajaxed");var promptContent=$('<div>').addClass("formErrorContent").html(promptText).appendTo(prompt);if(options.showArrow){var arrow=$('<div>').addClass("formErrorArrow");switch(options.promptPosition){case"bottomLeft":case"bottomRight":prompt.find(".formErrorContent").before(arrow);arrow.addClass("formErrorArrowBottom").html('<div class="line1"><!-- --></div><div class="line2"><!-- --></div><div class="line3"><!-- --></div><div class="line4"><!-- --></div><div class="line5"><!-- --></div><div class="line6"><!-- --></div><div class="line7"><!-- --></div><div class="line8"><!-- --></div><div class="line9"><!-- --></div><div class="line10"><!-- --></div>');break;case"topLeft":case"topRight":arrow.html('<div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div>');prompt.append(arrow);break;}}
if(options.isOverflown)
field.before(prompt);else
$("body").append(prompt);var pos=methods._calculatePosition(field,prompt,options);prompt.css({"top":pos.callerTopPosition,"left":pos.callerleftPosition,"marginTop":pos.marginTopSize,"opacity":0});return prompt.animate({"opacity":0.87});},_updatePrompt:function(field,prompt,promptText,type,ajaxed,options){if(prompt){if(type=="pass")
prompt.addClass("greenPopup");else
prompt.removeClass("greenPopup");if(type=="load")
prompt.addClass("blackPopup");else
prompt.removeClass("blackPopup");if(ajaxed)
prompt.addClass("ajaxed");else
prompt.removeClass("ajaxed");prompt.find(".formErrorContent").html(promptText);var pos=methods._calculatePosition(field,prompt,options);prompt.animate({"top":pos.callerTopPosition,"marginTop":pos.marginTopSize});}},_closePrompt:function(field){var prompt=methods._getPrompt(field);if(prompt)
prompt.fadeTo("fast",0,function(){prompt.remove();});},closePrompt:function(field){return methods._closePrompt(field);},_getPrompt:function(field){var className="."+methods._getClassName(field.attr("id"))+"formError";var match=$(className)[0];if(match)
return $(match);},_calculatePosition:function(field,promptElmt,options){var promptTopPosition,promptleftPosition,marginTopSize;var fieldWidth=field.width();var promptHeight=promptElmt.height();var overflow=options.isOverflown;if(overflow){promptTopPosition=promptleftPosition=0;marginTopSize=-promptHeight;}else{var offset=field.offset();promptTopPosition=offset.top;promptleftPosition=offset.left;marginTopSize=0;}
switch(options.promptPosition){default:case"topRight":if(overflow)
promptleftPosition+=fieldWidth-30;else{promptleftPosition+=fieldWidth-30;promptTopPosition+=-promptHeight;}
break;case"topLeft":promptTopPosition+=-promptHeight-10;break;case"centerRight":promptleftPosition+=fieldWidth+13;break;case"bottomLeft":promptTopPosition=promptTopPosition+field.height()+15;break;case"bottomRight":promptleftPosition+=fieldWidth-30;promptTopPosition+=field.height()+5;}
return{"callerTopPosition":promptTopPosition+"px","callerleftPosition":promptleftPosition+"px","marginTopSize":marginTopSize+"px"};},_saveOptions:function(form,options){if($.validationEngineLanguage)
var allRules=$.validationEngineLanguage.allRules;else
$.error("jQuery.validationEngine rules are not loaded, plz add localization files to the page");var userOptions=$.extend({validationEventTrigger:"blur",scroll:true,promptPosition:"topRight",bindMethod:"bind",inlineAjax:false,ajaxFormValidation:false,ajaxFormValidationURL:false,onAjaxFormComplete:$.noop,onBeforeAjaxFormValidation:$.noop,onValidationComplete:false,isOverflown:false,overflownDIV:"",allrules:allRules,binded:false,showArrow:true,isError:false,ajaxValidCache:{}},options);form.data('jqv',userOptions);return userOptions;},_getClassName:function(className){return className.replace(":","_").replace(".","_");}};$.fn.validationEngine=function(method){var form=$(this);if(!form[0])return false;if(typeof(method)=='string'&&method.charAt(0)!='_'&&methods[method]){if(method!="showPrompt"&&method!="hidePrompt"&&method!="hide"&&method!="hideAll")
methods.init.apply(form);return methods[method].apply(form,Array.prototype.slice.call(arguments,1));}else if(typeof method=='object'||!method){methods.init.apply(form,arguments);return methods.attach.apply(form);}else{$.error('Method '+method+' does not exist in jQuery.validationEngine');}};})(jQuery);;

/* bb.jquery.validationEngine-en.js */

(function($){$.fn.validationEngineLanguage=function(){};$.validationEngineLanguage={newLang:function(){$.validationEngineLanguage.allRules={"required":{"regex":"none","alertText":"* This field is required","alertTextCheckboxMultiple":"* Please select an option","alertTextCheckboxe":"* This checkbox is required"},"minSize":{"regex":"none","alertText":"* Minimum ","alertText2":" characters allowed"},"maxSize":{"regex":"none","alertText":"* Maximum ","alertText2":" characters allowed"},"min":{"regex":"none","alertText":"* Minimum value is "},"max":{"regex":"none","alertText":"* Maximum value is "},"past":{"regex":"none","alertText":"* Date prior to "},"future":{"regex":"none","alertText":"* Date past "},"maxCheckbox":{"regex":"none","alertText":"* Maximum ","alertText2":" options allowed"},"minCheckbox":{"regex":"none","alertText":"* Please select ","alertText2":" options"},"equals":{"regex":"none","alertText":"* Fields do not match"},"phone":{"regex":/^([\+][0-9]{1,3}[ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/,"alertText":"* Invalid phone number"},"email":{"regex":/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,"alertText":"* Invalid email address"},"integer":{"regex":/^[\-\+]?\d+$/,"alertText":"* Not a valid integer"},"number":{"regex":/^[\-\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$/,"alertText":"* Invalid floating decimal number"},"date":{"regex":/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/,"alertText":"* Invalid date, must be in YYYY-MM-DD format"},"ipv4":{"regex":/^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,"alertText":"* Invalid IP address"},"url":{"regex":/^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/,"alertText":"* Invalid URL"},"onlyNumberSp":{"regex":/^[0-9\ ]+$/,"alertText":"* Numbers only"},"onlyLetterSp":{"regex":/^[a-zA-Z\ \']+$/,"alertText":"* Letters only"},"onlyLetterNumber":{"regex":/^[0-9a-zA-Z]+$/,"alertText":"* No special characters allowed"},"ajaxUserCall":{"url":"ajaxValidateFieldUser","extraData":"name=eric","alertText":"* This user is already taken","alertTextLoad":"* Validating, please wait"},"ajaxUserCallPhp":{"url":"phpajax/ajaxValidateFieldUser.php","extraData":"name=eric","alertTextOk":"* This username is available","alertText":"* This user is already taken","alertTextLoad":"* Validating, please wait"},"ajaxNameCall":{"url":"ajaxValidateFieldName","alertText":"* This name is already taken","alertTextOk":"* This name is available","alertTextLoad":"* Validating, please wait"},"ajaxNameCallPhp":{"url":"phpajax/ajaxValidateFieldName.php","alertText":"* This name is already taken","alertTextLoad":"* Validating, please wait"},"validate2fields":{"alertText":"* Please input HELLO"}};}};$.validationEngineLanguage.newLang();})(jQuery);;

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

