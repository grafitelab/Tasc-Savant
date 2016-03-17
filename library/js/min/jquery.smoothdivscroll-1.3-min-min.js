!function($){$.widget("thomaskahn.smoothDivScroll",{options:{scrollingHotSpotLeftClass:"scrollingHotSpotLeft",scrollingHotSpotRightClass:"scrollingHotSpotRight",scrollingHotSpotLeftVisibleClass:"scrollingHotSpotLeftVisible",scrollingHotSpotRightVisibleClass:"scrollingHotSpotRightVisible",scrollableAreaClass:"scrollableArea",scrollWrapperClass:"scrollWrapper",hiddenOnStart:!1,getContentOnLoad:{},countOnlyClass:"",startAtElementId:"",hotSpotScrolling:!0,hotSpotScrollingStep:15,hotSpotScrollingInterval:10,hotSpotMouseDownSpeedBooster:3,visibleHotSpotBackgrounds:"hover",hotSpotsVisibleTime:5e3,easingAfterHotSpotScrolling:!0,easingAfterHotSpotScrollingDistance:10,easingAfterHotSpotScrollingDuration:300,easingAfterHotSpotScrollingFunction:"easeOutQuart",mousewheelScrolling:"",mousewheelScrollingStep:70,easingAfterMouseWheelScrolling:!0,easingAfterMouseWheelScrollingDuration:300,easingAfterMouseWheelScrollingFunction:"easeOutQuart",manualContinuousScrolling:!1,autoScrollingMode:"",autoScrollingDirection:"endlessLoopRight",autoScrollingStep:1,autoScrollingInterval:10,touchScrolling:!1,scrollToAnimationDuration:1e3,scrollToEasingFunction:"easeOutQuart"},_create:function(){var t=this,l=this.options,a=this.element;a.data("scrollWrapper",a.find("."+l.scrollWrapperClass)),a.data("scrollingHotSpotRight",a.find("."+l.scrollingHotSpotRightClass)),a.data("scrollingHotSpotLeft",a.find("."+l.scrollingHotSpotLeftClass)),a.data("scrollableArea",a.find("."+l.scrollableAreaClass)),a.data("scrollingHotSpotRight").length>0&&a.data("scrollingHotSpotRight").detach(),a.data("scrollingHotSpotLeft").length>0&&a.data("scrollingHotSpotLeft").detach(),0===a.data("scrollableArea").length&&0===a.data("scrollWrapper").length?(a.wrapInner("<div class='"+l.scrollableAreaClass+"'>").wrapInner("<div class='"+l.scrollWrapperClass+"'>"),a.data("scrollWrapper",a.find("."+l.scrollWrapperClass)),a.data("scrollableArea",a.find("."+l.scrollableAreaClass))):0===a.data("scrollWrapper").length?(a.wrapInner("<div class='"+l.scrollWrapperClass+"'>"),a.data("scrollWrapper",a.find("."+l.scrollWrapperClass))):0===a.data("scrollableArea").length&&(a.data("scrollWrapper").wrapInner("<div class='"+l.scrollableAreaClass+"'>"),a.data("scrollableArea",a.find("."+l.scrollableAreaClass))),0===a.data("scrollingHotSpotRight").length?(a.prepend("<div class='"+l.scrollingHotSpotRightClass+"'></div>"),a.data("scrollingHotSpotRight",a.find("."+l.scrollingHotSpotRightClass))):a.prepend(a.data("scrollingHotSpotRight")),0===a.data("scrollingHotSpotLeft").length?(a.prepend("<div class='"+l.scrollingHotSpotLeftClass+"'></div>"),a.data("scrollingHotSpotLeft",a.find("."+l.scrollingHotSpotLeftClass))):a.prepend(a.data("scrollingHotSpotLeft")),a.data("speedBooster",1),a.data("scrollXPos",0),a.data("hotSpotWidth",a.data("scrollingHotSpotLeft").innerWidth()),a.data("scrollableAreaWidth",0),a.data("startingPosition",0),a.data("rightScrollingInterval",null),a.data("leftScrollingInterval",null),a.data("autoScrollingInterval",null),a.data("hideHotSpotBackgroundsInterval",null),a.data("previousScrollLeft",0),a.data("pingPongDirection","right"),a.data("getNextElementWidth",!0),a.data("swapAt",null),a.data("startAtElementHasNotPassed",!0),a.data("swappedElement",null),a.data("originalElements",a.data("scrollableArea").children(l.countOnlyClass)),a.data("visible",!0),a.data("enabled",!0),a.data("scrollableAreaHeight",a.data("scrollableArea").height()),a.data("scrollerOffset",a.offset()),l.touchScrolling&&a.data("enabled")&&a.data("scrollWrapper").kinetic({y:!1,moved:function(e){l.manualContinuousScrolling&&(a.data("scrollWrapper").scrollLeft()<=0?t._checkContinuousSwapLeft():t._checkContinuousSwapRight()),t._trigger("touchMoved")},stopped:function(l){a.data("scrollWrapper").stop(!0,!1),t.stopAutoScrolling(),t._trigger("touchStopped")}}),a.data("scrollingHotSpotRight").bind("mousemove",function(t){if(l.hotSpotScrolling){var e=t.pageX-$(this).offset().left;a.data("scrollXPos",Math.round(e/a.data("hotSpotWidth")*l.hotSpotScrollingStep)),(1/0===a.data("scrollXPos")||a.data("scrollXPos")<1)&&a.data("scrollXPos",1)}}),a.data("scrollingHotSpotRight").bind("mouseover",function(){l.hotSpotScrolling&&(a.data("scrollWrapper").stop(!0,!1),t.stopAutoScrolling(),a.data("rightScrollingInterval",setInterval(function(){a.data("scrollXPos")>0&&a.data("enabled")&&(a.data("scrollWrapper").scrollLeft(a.data("scrollWrapper").scrollLeft()+a.data("scrollXPos")*a.data("speedBooster")),l.manualContinuousScrolling&&t._checkContinuousSwapRight(),t._showHideHotSpots())},l.hotSpotScrollingInterval)),t._trigger("mouseOverRightHotSpot"))}),a.data("scrollingHotSpotRight").bind("mouseout",function(){l.hotSpotScrolling&&(clearInterval(a.data("rightScrollingInterval")),a.data("scrollXPos",0),l.easingAfterHotSpotScrolling&&a.data("enabled")&&a.data("scrollWrapper").animate({scrollLeft:a.data("scrollWrapper").scrollLeft()+l.easingAfterHotSpotScrollingDistance},{duration:l.easingAfterHotSpotScrollingDuration,easing:l.easingAfterHotSpotScrollingFunction}))}),a.data("scrollingHotSpotRight").bind("mousedown",function(){a.data("speedBooster",l.hotSpotMouseDownSpeedBooster)}),$("body").bind("mouseup",function(){a.data("speedBooster",1)}),a.data("scrollingHotSpotLeft").bind("mousemove",function(t){if(l.hotSpotScrolling){var e=a.data("hotSpotWidth")-(t.pageX-$(this).offset().left);a.data("scrollXPos",Math.round(e/a.data("hotSpotWidth")*l.hotSpotScrollingStep)),(1/0===a.data("scrollXPos")||a.data("scrollXPos")<1)&&a.data("scrollXPos",1)}}),a.data("scrollingHotSpotLeft").bind("mouseover",function(){l.hotSpotScrolling&&(a.data("scrollWrapper").stop(!0,!1),t.stopAutoScrolling(),a.data("leftScrollingInterval",setInterval(function(){a.data("scrollXPos")>0&&a.data("enabled")&&(a.data("scrollWrapper").scrollLeft(a.data("scrollWrapper").scrollLeft()-a.data("scrollXPos")*a.data("speedBooster")),l.manualContinuousScrolling&&t._checkContinuousSwapLeft(),t._showHideHotSpots())},l.hotSpotScrollingInterval)),t._trigger("mouseOverLeftHotSpot"))}),a.data("scrollingHotSpotLeft").bind("mouseout",function(){l.hotSpotScrolling&&(clearInterval(a.data("leftScrollingInterval")),a.data("scrollXPos",0),l.easingAfterHotSpotScrolling&&a.data("enabled")&&a.data("scrollWrapper").animate({scrollLeft:a.data("scrollWrapper").scrollLeft()-l.easingAfterHotSpotScrollingDistance},{duration:l.easingAfterHotSpotScrollingDuration,easing:l.easingAfterHotSpotScrollingFunction}))}),a.data("scrollingHotSpotLeft").bind("mousedown",function(){a.data("speedBooster",l.hotSpotMouseDownSpeedBooster)}),a.data("scrollableArea").mousewheel(function(e,o,r,s){if(a.data("enabled")&&l.mousewheelScrolling.length>0){var n;"vertical"===l.mousewheelScrolling&&0!==s?(t.stopAutoScrolling(),e.preventDefault(),n=Math.round(l.mousewheelScrollingStep*s*-1),t.move(n)):"horizontal"===l.mousewheelScrolling&&0!==r?(t.stopAutoScrolling(),e.preventDefault(),n=Math.round(l.mousewheelScrollingStep*r*-1),t.move(n)):"allDirections"===l.mousewheelScrolling&&(t.stopAutoScrolling(),e.preventDefault(),n=Math.round(l.mousewheelScrollingStep*o*-1),t.move(n))}}),l.mousewheelScrolling&&a.data("scrollingHotSpotLeft").add(a.data("scrollingHotSpotRight")).mousewheel(function(t){t.preventDefault()}),$(window).bind("resize",function(){t._showHideHotSpots(),t._trigger("windowResized")}),jQuery.isEmptyObject(l.getContentOnLoad)||t[l.getContentOnLoad.method](l.getContentOnLoad.content,l.getContentOnLoad.manipulationMethod,l.getContentOnLoad.addWhere,l.getContentOnLoad.filterTag),l.hiddenOnStart&&t.hide(),$(window).load(function(){if(l.hiddenOnStart||t.recalculateScrollableArea(),l.autoScrollingMode.length>0&&!l.hiddenOnStart&&t.startAutoScrolling(),"always"!==l.autoScrollingMode)switch(l.visibleHotSpotBackgrounds){case"always":t.showHotSpotBackgrounds();break;case"onStart":t.showHotSpotBackgrounds(),a.data("hideHotSpotBackgroundsInterval",setTimeout(function(){t.hideHotSpotBackgrounds(250)},l.hotSpotsVisibleTime));break;case"hover":a.mouseenter(function(a){l.hotSpotScrolling&&(a.stopPropagation(),t.showHotSpotBackgrounds(250))}).mouseleave(function(a){l.hotSpotScrolling&&(a.stopPropagation(),t.hideHotSpotBackgrounds(250))})}t._showHideHotSpots(),t._trigger("setupComplete")})},_init:function(){var t=this,l=this.element;t.recalculateScrollableArea(),t._showHideHotSpots(),t._trigger("initializationComplete")},_setOption:function(t,l){var a=this,e=this.options,o=this.element;e[t]=l,"hotSpotScrolling"===t?l===!0?a._showHideHotSpots():(o.data("scrollingHotSpotLeft").hide(),o.data("scrollingHotSpotRight").hide()):"autoScrollingStep"===t||"easingAfterHotSpotScrollingDistance"===t||"easingAfterHotSpotScrollingDuration"===t||"easingAfterMouseWheelScrollingDuration"===t?e[t]=parseInt(l,10):"autoScrollingInterval"===t&&(e[t]=parseInt(l,10),a.startAutoScrolling())},showHotSpotBackgrounds:function(t){var l=this,a=this.element,e=this.options;void 0!==t?(a.data("scrollingHotSpotLeft").addClass(e.scrollingHotSpotLeftVisibleClass),a.data("scrollingHotSpotRight").addClass(e.scrollingHotSpotRightVisibleClass),a.data("scrollingHotSpotLeft").add(a.data("scrollingHotSpotRight")).fadeTo(t,.35)):(a.data("scrollingHotSpotLeft").addClass(e.scrollingHotSpotLeftVisibleClass),a.data("scrollingHotSpotLeft").removeAttr("style"),a.data("scrollingHotSpotRight").addClass(e.scrollingHotSpotRightVisibleClass),a.data("scrollingHotSpotRight").removeAttr("style")),l._showHideHotSpots()},hideHotSpotBackgrounds:function(t){var l=this.element,a=this.options;void 0!==t?(l.data("scrollingHotSpotLeft").fadeTo(t,0,function(){l.data("scrollingHotSpotLeft").removeClass(a.scrollingHotSpotLeftVisibleClass)}),l.data("scrollingHotSpotRight").fadeTo(t,0,function(){l.data("scrollingHotSpotRight").removeClass(a.scrollingHotSpotRightVisibleClass)})):(l.data("scrollingHotSpotLeft").removeClass(a.scrollingHotSpotLeftVisibleClass).removeAttr("style"),l.data("scrollingHotSpotRight").removeClass(a.scrollingHotSpotRightVisibleClass).removeAttr("style"))},_showHideHotSpots:function(){var t=this,l=this.element,a=this.options;a.hotSpotScrolling?a.hotSpotScrolling&&"always"!==a.autoScrollingMode&&null!==l.data("autoScrollingInterval")?(l.data("scrollingHotSpotLeft").show(),l.data("scrollingHotSpotRight").show()):"always"!==a.autoScrollingMode&&a.hotSpotScrolling?l.data("scrollableAreaWidth")<=l.data("scrollWrapper").innerWidth()?(l.data("scrollingHotSpotLeft").hide(),l.data("scrollingHotSpotRight").hide()):0===l.data("scrollWrapper").scrollLeft()?(l.data("scrollingHotSpotLeft").hide(),l.data("scrollingHotSpotRight").show(),t._trigger("scrollerLeftLimitReached"),clearInterval(l.data("leftScrollingInterval")),l.data("leftScrollingInterval",null)):l.data("scrollableAreaWidth")<=l.data("scrollWrapper").innerWidth()+l.data("scrollWrapper").scrollLeft()?(l.data("scrollingHotSpotLeft").show(),l.data("scrollingHotSpotRight").hide(),t._trigger("scrollerRightLimitReached"),clearInterval(l.data("rightScrollingInterval")),l.data("rightScrollingInterval",null)):(l.data("scrollingHotSpotLeft").show(),l.data("scrollingHotSpotRight").show()):(l.data("scrollingHotSpotLeft").hide(),l.data("scrollingHotSpotRight").hide()):(l.data("scrollingHotSpotLeft").hide(),l.data("scrollingHotSpotRight").hide())},_setElementScrollPosition:function(t,l){var a=this.element,e=this.options,o=0;switch(t){case"first":return a.data("scrollXPos",0),!0;case"start":return""!==e.startAtElementId&&a.data("scrollableArea").has("#"+e.startAtElementId)?(o=$("#"+e.startAtElementId).position().left,a.data("scrollXPos",o),!0):!1;case"last":return a.data("scrollXPos",a.data("scrollableAreaWidth")-a.data("scrollWrapper").innerWidth()),!0;case"number":return isNaN(l)?!1:(o=a.data("scrollableArea").children(e.countOnlyClass).eq(l-1).position().left,a.data("scrollXPos",o),!0);case"id":return l.length>0&&a.data("scrollableArea").has("#"+l)?(o=$("#"+l).position().left,a.data("scrollXPos",o),!0):!1;default:return!1}},jumpToElement:function(t,l){var a=this,e=this.element;if(e.data("enabled")&&a._setElementScrollPosition(t,l))switch(e.data("scrollWrapper").scrollLeft(e.data("scrollXPos")),a._showHideHotSpots(),t){case"first":a._trigger("jumpedToFirstElement");break;case"start":a._trigger("jumpedToStartElement");break;case"last":a._trigger("jumpedToLastElement");break;case"number":a._trigger("jumpedToElementNumber",null,{elementNumber:l});break;case"id":a._trigger("jumpedToElementId",null,{elementId:l})}},scrollToElement:function(t,l){var a=this,e=this.element,o=this.options,r=!1;e.data("enabled")&&a._setElementScrollPosition(t,l)&&(null!==e.data("autoScrollingInterval")&&(a.stopAutoScrolling(),r=!0),e.data("scrollWrapper").stop(!0,!1),e.data("scrollWrapper").animate({scrollLeft:e.data("scrollXPos")},{duration:o.scrollToAnimationDuration,easing:o.scrollToEasingFunction,complete:function(){switch(r&&a.startAutoScrolling(),a._showHideHotSpots(),t){case"first":a._trigger("scrolledToFirstElement");break;case"start":a._trigger("scrolledToStartElement");break;case"last":a._trigger("scrolledToLastElement");break;case"number":a._trigger("scrolledToElementNumber",null,{elementNumber:l});break;case"id":a._trigger("scrolledToElementId",null,{elementId:l})}}}))},move:function(t){var l=this,a=this.element,e=this.options;if(a.data("scrollWrapper").stop(!0,!0),0>t&&a.data("scrollWrapper").scrollLeft()>0||t>0&&a.data("scrollableAreaWidth")>a.data("scrollWrapper").innerWidth()+a.data("scrollWrapper").scrollLeft()||e.manualContinuousScrolling){var o=a.data("scrollableArea").width()-a.data("scrollWrapper").width(),r=a.data("scrollWrapper").scrollLeft()+t;if(0>r)for(var s=function(){a.data("swappedElement",a.data("scrollableArea").children(":last").detach()),a.data("scrollableArea").prepend(a.data("swappedElement")),a.data("scrollWrapper").scrollLeft(a.data("scrollWrapper").scrollLeft()+a.data("swappedElement")[0].getBoundingClientRect().width)};0>r;)s(),r=a.data("scrollableArea").children(":first")[0].getBoundingClientRect().width+r;else if(r-o>0)for(var n=function(){a.data("swappedElement",a.data("scrollableArea").children(":first").detach()),a.data("scrollableArea").append(a.data("swappedElement"));var t=a.data("scrollWrapper").scrollLeft();a.data("scrollWrapper").scrollLeft(t-a.data("swappedElement")[0].getBoundingClientRect().width)};r-o>0;)n(),r-=a.data("scrollableArea").children(":last")[0].getBoundingClientRect().width;e.easingAfterMouseWheelScrolling?a.data("scrollWrapper").animate({scrollLeft:a.data("scrollWrapper").scrollLeft()+t},{duration:e.easingAfterMouseWheelScrollingDuration,easing:e.easingAfterMouseWheelFunction,complete:function(){l._showHideHotSpots(),e.manualContinuousScrolling&&(t>0?l._checkContinuousSwapRight():l._checkContinuousSwapLeft())}}):(a.data("scrollWrapper").scrollLeft(a.data("scrollWrapper").scrollLeft()+t),l._showHideHotSpots(),e.manualContinuousScrolling&&(t>0?l._checkContinuousSwapRight():l._checkContinuousSwapLeft()))}},getFlickrContent:function(t,l){var a=this,e=this.element;$.getJSON(t,function(t){function o(t,c){var g=t.media.m,h=g.replace("_m",s[c].letter),u=$("<img />").attr("src",h);u.load(function(){if(this.height<e.data("scrollableAreaHeight")&&c+1<s.length?o(t,c+1):r(this),p===d){switch(l){case"addFirst":e.data("scrollableArea").children(":first").before(n);break;case"addLast":e.data("scrollableArea").children(":last").after(n);break;default:e.data("scrollableArea").html(n)}a.recalculateScrollableArea(),a._showHideHotSpots(),a._trigger("addedFlickrContent",null,{addedElementIds:i})}})}function r(t){var l=e.data("scrollableAreaHeight")/t.height,a=Math.round(t.width*l),o=$(t).attr("src").split("/"),r=o.length-1;o=o[r].split("."),$(t).attr("id",o[0]),$(t).css({height:e.data("scrollableAreaHeight"),width:a}),i.push(o[0]),n.push(t),p++}var s=[{size:"small square",pixels:75,letter:"_s"},{size:"thumbnail",pixels:100,letter:"_t"},{size:"small",pixels:240,letter:"_m"},{size:"medium",pixels:500,letter:""},{size:"medium 640",pixels:640,letter:"_z"},{size:"large",pixels:1024,letter:"_b"}],n=[],i=[],c,d=t.items.length,p=0;c=e.data("scrollableAreaHeight")<=75?0:e.data("scrollableAreaHeight")<=100?1:e.data("scrollableAreaHeight")<=240?2:e.data("scrollableAreaHeight")<=500?3:e.data("scrollableAreaHeight")<=640?4:5,$.each(t.items,function(t,l){o(l,c)})})},getAjaxContent:function(t,l,a){var e=this,o=this.element;$.ajaxSetup({cache:!1}),$.get(t,function(r){var s;switch(s=void 0!==a?a.length>0?$("<div>").html(r).find(a):t:r,l){case"addFirst":o.data("scrollableArea").children(":first").before(s);break;case"addLast":o.data("scrollableArea").children(":last").after(s);break;default:o.data("scrollableArea").html(s)}e.recalculateScrollableArea(),e._showHideHotSpots(),e._trigger("addedAjaxContent")})},getHtmlContent:function(t,l,a){var e=this,o=this.element,r;switch(r=void 0!==a&&a.length>0?$("<div>").html(t).find(a):t,l){case"addFirst":o.data("scrollableArea").children(":first").before(r);break;case"addLast":o.data("scrollableArea").children(":last").after(r);break;default:o.data("scrollableArea").html(r)}e.recalculateScrollableArea(),e._showHideHotSpots(),e._trigger("addedHtmlContent")},recalculateScrollableArea:function(){var t=0,l=!1,a=this.options,e=this.element;e.data("scrollableArea").children(a.countOnlyClass).each(function(){a.startAtElementId.length>0&&$(this).attr("id")===a.startAtElementId&&(e.data("startingPosition",t),l=!0),t+=$(this)[0].getBoundingClientRect().width}),l||e.data("startAtElementId",""),e.data("scrollableAreaWidth",t),e.data("scrollableArea").width(e.data("scrollableAreaWidth")),e.data("scrollWrapper").scrollLeft(e.data("startingPosition")),e.data("scrollXPos",e.data("startingPosition"))},getScrollerOffset:function(){var t=this.element;return t.data("scrollWrapper").scrollLeft()},stopAutoScrolling:function(){var t=this,l=this.element;null!==l.data("autoScrollingInterval")&&(clearInterval(l.data("autoScrollingInterval")),l.data("autoScrollingInterval",null),t._showHideHotSpots(),t._trigger("autoScrollingStopped"))},startAutoScrolling:function(){var t=this,l=this.element,a=this.options;l.data("enabled")&&(t._showHideHotSpots(),clearInterval(l.data("autoScrollingInterval")),l.data("autoScrollingInterval",null),t._trigger("autoScrollingStarted"),l.data("autoScrollingInterval",setInterval(function(){if(!l.data("visible")||l.data("scrollableAreaWidth")<=l.data("scrollWrapper").innerWidth())clearInterval(l.data("autoScrollingInterval")),l.data("autoScrollingInterval",null);else switch(l.data("previousScrollLeft",l.data("scrollWrapper").scrollLeft()),a.autoScrollingDirection){case"right":l.data("scrollWrapper").scrollLeft(l.data("scrollWrapper").scrollLeft()+a.autoScrollingStep),l.data("previousScrollLeft")===l.data("scrollWrapper").scrollLeft()&&(t._trigger("autoScrollingRightLimitReached"),t.stopAutoScrolling());break;case"left":l.data("scrollWrapper").scrollLeft(l.data("scrollWrapper").scrollLeft()-a.autoScrollingStep),l.data("previousScrollLeft")===l.data("scrollWrapper").scrollLeft()&&(t._trigger("autoScrollingLeftLimitReached"),t.stopAutoScrolling());break;case"backAndForth":l.data("scrollWrapper").scrollLeft("right"===l.data("pingPongDirection")?l.data("scrollWrapper").scrollLeft()+a.autoScrollingStep:l.data("scrollWrapper").scrollLeft()-a.autoScrollingStep),l.data("previousScrollLeft")===l.data("scrollWrapper").scrollLeft()&&("right"===l.data("pingPongDirection")?(l.data("pingPongDirection","left"),t._trigger("autoScrollingRightLimitReached")):(l.data("pingPongDirection","right"),t._trigger("autoScrollingLeftLimitReached")));break;case"endlessLoopRight":l.data("scrollWrapper").scrollLeft(l.data("scrollWrapper").scrollLeft()+a.autoScrollingStep),t._checkContinuousSwapRight();break;case"endlessLoopLeft":l.data("scrollWrapper").scrollLeft(l.data("scrollWrapper").scrollLeft()-a.autoScrollingStep),t._checkContinuousSwapLeft()}},a.autoScrollingInterval)))},_checkContinuousSwapRight:function(){var t=this.element,l=this.options;if(t.data("getNextElementWidth")&&(l.startAtElementId.length>0&&t.data("startAtElementHasNotPassed")?(t.data("swapAt",$("#"+l.startAtElementId)[0].getBoundingClientRect().width),t.data("startAtElementHasNotPassed",!1)):t.data("swapAt",t.data("scrollableArea").children(":first")[0].getBoundingClientRect().width),t.data("getNextElementWidth",!1)),t.data("swapAt")<=t.data("scrollWrapper").scrollLeft()){t.data("swappedElement",t.data("scrollableArea").children(":first").detach()),t.data("scrollableArea").append(t.data("swappedElement"));var a=t.data("scrollWrapper").scrollLeft();t.data("scrollWrapper").scrollLeft(a-t.data("swappedElement")[0].getBoundingClientRect().width),t.data("getNextElementWidth",!0)}},_checkContinuousSwapLeft:function(){var t=this.element,l=this.options;t.data("getNextElementWidth")&&(l.startAtElementId.length>0&&t.data("startAtElementHasNotPassed")?(t.data("swapAt",$("#"+l.startAtElementId)[0].getBoundingClientRect().width),t.data("startAtElementHasNotPassed",!1)):t.data("swapAt",t.data("scrollableArea").children(":first")[0].getBoundingClientRect().width),t.data("getNextElementWidth",!1)),0===t.data("scrollWrapper").scrollLeft()&&(t.data("swappedElement",t.data("scrollableArea").children(":last").detach()),t.data("scrollableArea").prepend(t.data("swappedElement")),t.data("scrollWrapper").scrollLeft(t.data("scrollWrapper").scrollLeft()+t.data("swappedElement")[0].getBoundingClientRect().width),t.data("getNextElementWidth",!0))},restoreOriginalElements:function(){var t=this,l=this.element;l.data("scrollableArea").html(l.data("originalElements")),t.recalculateScrollableArea(),t.jumpToElement("first")},show:function(){var t=this.element;t.data("visible",!0),t.show()},hide:function(){var t=this.element;t.data("visible",!1),t.hide()},enable:function(){var t=this.element;this.options.touchScrolling&&t.data("scrollWrapper").kinetic("attach"),t.data("enabled",!0)},disable:function(){var t=this,l=this.element;t.stopAutoScrolling(),clearInterval(l.data("rightScrollingInterval")),clearInterval(l.data("leftScrollingInterval")),clearInterval(l.data("hideHotSpotBackgroundsInterval")),this.options.touchScrolling&&l.data("scrollWrapper").kinetic("detach"),l.data("enabled",!1)},destroy:function(){var t=this,l=this.element;t.stopAutoScrolling(),clearInterval(l.data("rightScrollingInterval")),clearInterval(l.data("leftScrollingInterval")),clearInterval(l.data("hideHotSpotBackgroundsInterval")),l.data("scrollingHotSpotRight").unbind("mouseover"),l.data("scrollingHotSpotRight").unbind("mouseout"),l.data("scrollingHotSpotRight").unbind("mousedown"),l.data("scrollingHotSpotLeft").unbind("mouseover"),l.data("scrollingHotSpotLeft").unbind("mouseout"),l.data("scrollingHotSpotLeft").unbind("mousedown"),l.unbind("mousenter"),l.unbind("mouseleave"),l.data("scrollingHotSpotRight").remove(),l.data("scrollingHotSpotLeft").remove(),l.data("scrollableArea").remove(),l.data("scrollWrapper").remove(),l.html(l.data("originalElements")),$.Widget.prototype.destroy.apply(this,arguments)}})}(jQuery);