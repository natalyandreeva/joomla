!function($){"use strict";var newsShowSP2=function(element,options){this.$element=$(element)
this.$indicators=this.$element.find('.nssp2-controllers')
this.options=options
this.options.pause=='hover'&&this.$element.on('mouseenter',$.proxy(this.pause,this)).on('mouseleave',$.proxy(this.cycle,this))}
newsShowSP2.prototype={cycle:function(e){if(!e)this.paused=false
if(this.interval)clearInterval(this.interval);this.options.interval&&!this.paused&&(this.interval=setInterval($.proxy(this.next,this),this.options.interval))
return this},getActiveIndex:function(){this.$active=this.$element.find('.item.active')
this.$items=this.$active.parent().children()
return this.$items.index(this.$active)},to:function(pos){var activeIndex=this.getActiveIndex(),that=this
if(pos>(this.$items.length-1)||pos<0)return
if(this.sliding){return this.$element.one('walking',function(){that.to(pos)})}
if(activeIndex==pos){return this.pause().cycle()}
return this.nsspwalk(pos>activeIndex?'next':'prev',$(this.$items[pos]))},pause:function(e){if(!e)this.paused=true
if(this.$element.find('.next, .prev').length&&$.support.nssp2transition.end){this.$element.trigger($.support.nssp2transition.end)
this.cycle(true)}
clearInterval(this.interval)
this.interval=null
return this},next:function(){if(this.sliding)return
return this.nsspwalk('next')},prev:function(){if(this.sliding)return
return this.nsspwalk('prev')},nsspwalk:function(type,next){var $active=this.$element.find('.item.active'),$next=next||$active[type](),isCycling=this.interval,direction=type=='next'?'left':'right',fallback=type=='next'?'first':'last',that=this,e
this.sliding=true
isCycling&&this.pause()
$next=$next.length?$next:this.$element.find('.item')[fallback]()
e=$.Event('slide',{relatedTarget:$next[0],direction:direction})
if($next.hasClass('active'))return
if(this.$indicators.length){this.$indicators.find('.active').removeClass('active')
this.$element.one('walking',function(){var $nextIndicator=$(that.$indicators.children()[that.getActiveIndex()])
$nextIndicator&&$nextIndicator.addClass('active')})}
if($.support.nssp2transition&&this.$element.hasClass('nssp2-slide')){this.$element.trigger(e)
if(e.isDefaultPrevented())return
$next.addClass(type)
$next[0].offsetWidth
$active.addClass(direction)
$next.addClass(direction)
this.$element.one($.support.nssp2transition.end,function(){$next.removeClass([type,direction].join(' ')).addClass('active')
$active.removeClass(['active',direction].join(' '))
that.sliding=false
setTimeout(function(){that.$element.trigger('walking')},0)})}else{this.$element.trigger(e)
if(e.isDefaultPrevented())return
$active.removeClass('active')
$next.addClass('active')
this.sliding=false
this.$element.trigger('walking')}
isCycling&&this.cycle()
return this}}
var old=$.fn.nssp2
$.fn.nssp2=function(option){return this.each(function(){var $this=$(this),data=$this.data('nssp2'),options=$.extend({},$.fn.nssp2.defaults,typeof option=='object'&&option),action=typeof option=='string'?option:options.nsspwalk
if(!data)$this.data('nssp2',(data=new newsShowSP2(this,options)))
if(typeof option=='number')data.to(option)
else if(action)data[action]()
else if(options.interval)data.pause().cycle()})}
$.fn.nssp2.defaults={interval:5000,pause:'hover'}
$.fn.nssp2.Constructor=newsShowSP2
$.fn.nssp2.noConflict=function(){$.fn.nssp2=old
return this}
$(document).on('click.nssp2.data-api','[data-nsspwalk], [data-nsspwalk-to]',function(e){var $this=$(this),href,$target=$($this.attr('data-target')||(href=$this.attr('href'))&&href.replace(/.*(?=#[^\s]+$)/,'')),options=$.extend({},$target.data(),$this.data()),slideIndex
$target.nssp2(options)
if(slideIndex=$this.attr('data-nsspwalk-to')){$target.data('nssp2').pause().to(slideIndex).cycle()}
e.preventDefault()})}(window.jQuery);!function($){"use strict";$(function(){$.support.nssp2transition=(function(){var transitionEnd=(function(){var el=document.createElement('bootstrap'),transEndEventNames={'WebkitTransition':'webkitTransitionEnd','MozTransition':'transitionend','OTransition':'oTransitionEnd otransitionend','transition':'transitionend'},name
for(name in transEndEventNames){if(el.style[name]!==undefined){return transEndEventNames[name]}}}())
return transitionEnd&&{end:transitionEnd}})()})}(window.jQuery);;