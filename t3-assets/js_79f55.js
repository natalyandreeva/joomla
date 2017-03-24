/* js_84926301910afc4b800b75e5dd90cf61.jquery.ui.autocomplete.html.js */
(function($){var proto=$.ui.autocomplete.prototype,initSource=proto._initSource;function filter(array,term){var matcher=new RegExp($.ui.autocomplete.escapeRegex(term),"i");return $.grep(array,function(value){return matcher.test($("<div>").html(value.label||value.value||value).text());});}
$.extend(proto,{_initSource:function(){if(this.options.html&&$.isArray(this.options.source)){this.source=function(request,response){response(filter(this.options.source,request.term));};}else{initSource.call(this);}},_renderItem:function(ul,item){return $("<li></li>").data("item.autocomplete",item).append($("<a></a>")[this.options.html?"html":"text"](item.label)).appendTo(ul);}});})(jQuery);;;

/* js_50468f55aa04e8698a5afbee8cc17719.jquery.noconflict.js */
jQuery.noConflict();;;

/* js_07afe8cd0a43ba707cef21d70bbed258.update_cart.js */
if(typeof Virtuemart==="undefined")
Virtuemart={};jQuery(function($){Virtuemart.customUpdateVirtueMartCartModule=function(el,options){var base=this;base.el=jQuery(".vmCartModule");base.options=jQuery.extend({},Virtuemart.customUpdateVirtueMartCartModule.defaults,options);base.init=function(){jQuery.ajaxSetup({cache:false})
jQuery.getJSON(Virtuemart.vmSiteurl+"index.php?option=com_virtuemart&nosef=1&view=cart&task=viewJS&format=json"+Virtuemart.vmLang,function(datas,textStatus){base.el.each(function(index,module){if(datas.totalProduct>0){jQuery(module).find(".vm_cart_products").html("");jQuery.each(datas.products,function(key,val){jQuery(module).find(".hiddencontainer .vmcontainer .product_row").clone().appendTo(jQuery(module).find(".vm_cart_products"));jQuery.each(val,function(key,val){jQuery(module).find(".vm_cart_products ."+key).last().html(val);});});}
jQuery(module).find(".show_cart").html(datas.cart_show);jQuery(module).find(".total_products").html(datas.totalProductTxt);jQuery(module).find(".total").html(datas.billTotal);});});};base.init();};Virtuemart.customUpdateVirtueMartCartModule.defaults={name1:'value1'};});jQuery(document).ready(function($){jQuery(document).off("updateVirtueMartCartModule","body",Virtuemart.customUpdateVirtueMartCartModule);jQuery(document).on("updateVirtueMartCartModule","body",Virtuemart.customUpdateVirtueMartCartModule);});;;

/* js_86566b8c602bc7ba996664ec17942abe.script.js */
var jaboxes=[];var jaboxoverlay=null;showBox=function(box,focusobj,caller,e){if(!jaboxoverlay){jaboxoverlay=new Element('div',{id:"jabox-overlay"}).inject($(box),'before');jaboxoverlay.setStyle('opacity',0.01);jaboxoverlay.addEvent('click',function(e){jaboxes.each(function(box){if(box.status=='show'){box.status='hide';box.setStyle('visibility','hidden');var fx=new Fx.Tween(box);fx.pause();fx.start('opacity',box.getStyle('opacity'),0);if(box._caller)box._caller.removeClass('show');}},this);jaboxoverlay.setStyle('display','none');});}
caller.blur();box=$(box);if(!box)return;if($(caller))box._caller=$(caller);if(!jaboxes.contains(box)){jaboxes.include(box);}
if(box.getStyle('display')=='none'){box.setStyles({display:'block',opacity:0});}
if(box.status=='show'){box.status='hide';box.setStyle('visibility','hidden');var fx=new Fx.Tween(box);fx.pause();fx.start('opacity',box.getStyle('opacity'),0);if(box._caller)box._caller.removeClass('show');jaboxoverlay.setStyle('display','none');}else{jaboxes.each(function(box1){if(box1!=box&&box1.status=='show'){box1.status='hide';box1.setStyle('visibility','hidden');var fx=new Fx.Tween(box1);fx.pause();fx.start('opacity',box1.getStyle('opacity'),0);if(box1._caller)box1._caller.removeClass('show');}},this);box.status='show';box.setStyle('visibility','visible');var fx=new Fx.Tween(box,{onComplete:function(){if($(focusobj))$(focusobj).focus();}});fx.pause();fx.start('opacity',box.getStyle('opacity'),1);if(box._caller)box._caller.addClass('show');jaboxoverlay.setStyle('display','block');}};;
