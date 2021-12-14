/*! jQuery v3.4.1 | (c) JS Foundation and other contributors | jquery.org/license */


/* popper JS */
/*
 Copyright (C) Federico Zivolo 2019
 Distributed under the MIT License (license terms are at http://opensource.org/licenses/MIT).



/*!
  * Bootstrap v4.3.1 (https://getbootstrap.com/)
  * Copyright 2011-2019 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
  */




/*!
 * perfect-scrollbar v1.4.0
 * (c) 2018 Hyunje Jun
 * @license MIT
 */

import PerfectScrollbar from 'perfect-scrollbar';

/*! Hammer.JS - v2.0.8 - 2016-04-23
 * http://hammerjs.github.io/
 *
 * Copyright (c) 2016 Jorik Tangelder;
 * Licensed under the MIT license */
!function(a,b,c,d){"use strict";function e(a,b,c){return setTimeout(j(a,c),b)}function f(a,b,c){return Array.isArray(a)?(g(a,c[b],c),!0):!1}function g(a,b,c){var e;if(a)if(a.forEach)a.forEach(b,c);else if(a.length!==d)for(e=0;e<a.length;)b.call(c,a[e],e,a),e++;else for(e in a)a.hasOwnProperty(e)&&b.call(c,a[e],e,a)}function h(b,c,d){var e="DEPRECATED METHOD: "+c+"\n"+d+" AT \n";return function(){var c=new Error("get-stack-trace"),d=c&&c.stack?c.stack.replace(/^[^\(]+?[\n$]/gm,"").replace(/^\s+at\s+/gm,"").replace(/^Object.<anonymous>\s*\(/gm,"{anonymous}()@"):"Unknown Stack Trace",f=a.console&&(a.console.warn||a.console.log);return f&&f.call(a.console,e,d),b.apply(this,arguments)}}function i(a,b,c){var d,e=b.prototype;d=a.prototype=Object.create(e),d.constructor=a,d._super=e,c&&la(d,c)}function j(a,b){return function(){return a.apply(b,arguments)}}function k(a,b){return typeof a==oa?a.apply(b?b[0]||d:d,b):a}function l(a,b){return a===d?b:a}function m(a,b,c){g(q(b),function(b){a.addEventListener(b,c,!1)})}function n(a,b,c){g(q(b),function(b){a.removeEventListener(b,c,!1)})}function o(a,b){for(;a;){if(a==b)return!0;a=a.parentNode}return!1}function p(a,b){return a.indexOf(b)>-1}function q(a){return a.trim().split(/\s+/g)}function r(a,b,c){if(a.indexOf&&!c)return a.indexOf(b);for(var d=0;d<a.length;){if(c&&a[d][c]==b||!c&&a[d]===b)return d;d++}return-1}function s(a){return Array.prototype.slice.call(a,0)}function t(a,b,c){for(var d=[],e=[],f=0;f<a.length;){var g=b?a[f][b]:a[f];r(e,g)<0&&d.push(a[f]),e[f]=g,f++}return c&&(d=b?d.sort(function(a,c){return a[b]>c[b]}):d.sort()),d}function u(a,b){for(var c,e,f=b[0].toUpperCase()+b.slice(1),g=0;g<ma.length;){if(c=ma[g],e=c?c+f:b,e in a)return e;g++}return d}function v(){return ua++}function w(b){var c=b.ownerDocument||b;return c.defaultView||c.parentWindow||a}function x(a,b){var c=this;this.manager=a,this.callback=b,this.element=a.element,this.target=a.options.inputTarget,this.domHandler=function(b){k(a.options.enable,[a])&&c.handler(b)},this.init()}function y(a){var b,c=a.options.inputClass;return new(b=c?c:xa?M:ya?P:wa?R:L)(a,z)}function z(a,b,c){var d=c.pointers.length,e=c.changedPointers.length,f=b&Ea&&d-e===0,g=b&(Ga|Ha)&&d-e===0;c.isFirst=!!f,c.isFinal=!!g,f&&(a.session={}),c.eventType=b,A(a,c),a.emit("hammer.input",c),a.recognize(c),a.session.prevInput=c}function A(a,b){var c=a.session,d=b.pointers,e=d.length;c.firstInput||(c.firstInput=D(b)),e>1&&!c.firstMultiple?c.firstMultiple=D(b):1===e&&(c.firstMultiple=!1);var f=c.firstInput,g=c.firstMultiple,h=g?g.center:f.center,i=b.center=E(d);b.timeStamp=ra(),b.deltaTime=b.timeStamp-f.timeStamp,b.angle=I(h,i),b.distance=H(h,i),B(c,b),b.offsetDirection=G(b.deltaX,b.deltaY);var j=F(b.deltaTime,b.deltaX,b.deltaY);b.overallVelocityX=j.x,b.overallVelocityY=j.y,b.overallVelocity=qa(j.x)>qa(j.y)?j.x:j.y,b.scale=g?K(g.pointers,d):1,b.rotation=g?J(g.pointers,d):0,b.maxPointers=c.prevInput?b.pointers.length>c.prevInput.maxPointers?b.pointers.length:c.prevInput.maxPointers:b.pointers.length,C(c,b);var k=a.element;o(b.srcEvent.target,k)&&(k=b.srcEvent.target),b.target=k}function B(a,b){var c=b.center,d=a.offsetDelta||{},e=a.prevDelta||{},f=a.prevInput||{};b.eventType!==Ea&&f.eventType!==Ga||(e=a.prevDelta={x:f.deltaX||0,y:f.deltaY||0},d=a.offsetDelta={x:c.x,y:c.y}),b.deltaX=e.x+(c.x-d.x),b.deltaY=e.y+(c.y-d.y)}function C(a,b){var c,e,f,g,h=a.lastInterval||b,i=b.timeStamp-h.timeStamp;if(b.eventType!=Ha&&(i>Da||h.velocity===d)){var j=b.deltaX-h.deltaX,k=b.deltaY-h.deltaY,l=F(i,j,k);e=l.x,f=l.y,c=qa(l.x)>qa(l.y)?l.x:l.y,g=G(j,k),a.lastInterval=b}else c=h.velocity,e=h.velocityX,f=h.velocityY,g=h.direction;b.velocity=c,b.velocityX=e,b.velocityY=f,b.direction=g}function D(a){for(var b=[],c=0;c<a.pointers.length;)b[c]={clientX:pa(a.pointers[c].clientX),clientY:pa(a.pointers[c].clientY)},c++;return{timeStamp:ra(),pointers:b,center:E(b),deltaX:a.deltaX,deltaY:a.deltaY}}function E(a){var b=a.length;if(1===b)return{x:pa(a[0].clientX),y:pa(a[0].clientY)};for(var c=0,d=0,e=0;b>e;)c+=a[e].clientX,d+=a[e].clientY,e++;return{x:pa(c/b),y:pa(d/b)}}function F(a,b,c){return{x:b/a||0,y:c/a||0}}function G(a,b){return a===b?Ia:qa(a)>=qa(b)?0>a?Ja:Ka:0>b?La:Ma}function H(a,b,c){c||(c=Qa);var d=b[c[0]]-a[c[0]],e=b[c[1]]-a[c[1]];return Math.sqrt(d*d+e*e)}function I(a,b,c){c||(c=Qa);var d=b[c[0]]-a[c[0]],e=b[c[1]]-a[c[1]];return 180*Math.atan2(e,d)/Math.PI}function J(a,b){return I(b[1],b[0],Ra)+I(a[1],a[0],Ra)}function K(a,b){return H(b[0],b[1],Ra)/H(a[0],a[1],Ra)}function L(){this.evEl=Ta,this.evWin=Ua,this.pressed=!1,x.apply(this,arguments)}function M(){this.evEl=Xa,this.evWin=Ya,x.apply(this,arguments),this.store=this.manager.session.pointerEvents=[]}function N(){this.evTarget=$a,this.evWin=_a,this.started=!1,x.apply(this,arguments)}function O(a,b){var c=s(a.touches),d=s(a.changedTouches);return b&(Ga|Ha)&&(c=t(c.concat(d),"identifier",!0)),[c,d]}function P(){this.evTarget=bb,this.targetIds={},x.apply(this,arguments)}function Q(a,b){var c=s(a.touches),d=this.targetIds;if(b&(Ea|Fa)&&1===c.length)return d[c[0].identifier]=!0,[c,c];var e,f,g=s(a.changedTouches),h=[],i=this.target;if(f=c.filter(function(a){return o(a.target,i)}),b===Ea)for(e=0;e<f.length;)d[f[e].identifier]=!0,e++;for(e=0;e<g.length;)d[g[e].identifier]&&h.push(g[e]),b&(Ga|Ha)&&delete d[g[e].identifier],e++;return h.length?[t(f.concat(h),"identifier",!0),h]:void 0}function R(){x.apply(this,arguments);var a=j(this.handler,this);this.touch=new P(this.manager,a),this.mouse=new L(this.manager,a),this.primaryTouch=null,this.lastTouches=[]}function S(a,b){a&Ea?(this.primaryTouch=b.changedPointers[0].identifier,T.call(this,b)):a&(Ga|Ha)&&T.call(this,b)}function T(a){var b=a.changedPointers[0];if(b.identifier===this.primaryTouch){var c={x:b.clientX,y:b.clientY};this.lastTouches.push(c);var d=this.lastTouches,e=function(){var a=d.indexOf(c);a>-1&&d.splice(a,1)};setTimeout(e,cb)}}function U(a){for(var b=a.srcEvent.clientX,c=a.srcEvent.clientY,d=0;d<this.lastTouches.length;d++){var e=this.lastTouches[d],f=Math.abs(b-e.x),g=Math.abs(c-e.y);if(db>=f&&db>=g)return!0}return!1}function V(a,b){this.manager=a,this.set(b)}function W(a){if(p(a,jb))return jb;var b=p(a,kb),c=p(a,lb);return b&&c?jb:b||c?b?kb:lb:p(a,ib)?ib:hb}function X(){if(!fb)return!1;var b={},c=a.CSS&&a.CSS.supports;return["auto","manipulation","pan-y","pan-x","pan-x pan-y","none"].forEach(function(d){b[d]=c?a.CSS.supports("touch-action",d):!0}),b}function Y(a){this.options=la({},this.defaults,a||{}),this.id=v(),this.manager=null,this.options.enable=l(this.options.enable,!0),this.state=nb,this.simultaneous={},this.requireFail=[]}function Z(a){return a&sb?"cancel":a&qb?"end":a&pb?"move":a&ob?"start":""}function $(a){return a==Ma?"down":a==La?"up":a==Ja?"left":a==Ka?"right":""}function _(a,b){var c=b.manager;return c?c.get(a):a}function aa(){Y.apply(this,arguments)}function ba(){aa.apply(this,arguments),this.pX=null,this.pY=null}function ca(){aa.apply(this,arguments)}function da(){Y.apply(this,arguments),this._timer=null,this._input=null}function ea(){aa.apply(this,arguments)}function fa(){aa.apply(this,arguments)}function ga(){Y.apply(this,arguments),this.pTime=!1,this.pCenter=!1,this._timer=null,this._input=null,this.count=0}function ha(a,b){return b=b||{},b.recognizers=l(b.recognizers,ha.defaults.preset),new ia(a,b)}function ia(a,b){this.options=la({},ha.defaults,b||{}),this.options.inputTarget=this.options.inputTarget||a,this.handlers={},this.session={},this.recognizers=[],this.oldCssProps={},this.element=a,this.input=y(this),this.touchAction=new V(this,this.options.touchAction),ja(this,!0),g(this.options.recognizers,function(a){var b=this.add(new a[0](a[1]));a[2]&&b.recognizeWith(a[2]),a[3]&&b.requireFailure(a[3])},this)}function ja(a,b){var c=a.element;if(c.style){var d;g(a.options.cssProps,function(e,f){d=u(c.style,f),b?(a.oldCssProps[d]=c.style[d],c.style[d]=e):c.style[d]=a.oldCssProps[d]||""}),b||(a.oldCssProps={})}}function ka(a,c){var d=b.createEvent("Event");d.initEvent(a,!0,!0),d.gesture=c,c.target.dispatchEvent(d)}var la,ma=["","webkit","Moz","MS","ms","o"],na=b.createElement("div"),oa="function",pa=Math.round,qa=Math.abs,ra=Date.now;la="function"!=typeof Object.assign?function(a){if(a===d||null===a)throw new TypeError("Cannot convert undefined or null to object");for(var b=Object(a),c=1;c<arguments.length;c++){var e=arguments[c];if(e!==d&&null!==e)for(var f in e)e.hasOwnProperty(f)&&(b[f]=e[f])}return b}:Object.assign;var sa=h(function(a,b,c){for(var e=Object.keys(b),f=0;f<e.length;)(!c||c&&a[e[f]]===d)&&(a[e[f]]=b[e[f]]),f++;return a},"extend","Use `assign`."),ta=h(function(a,b){return sa(a,b,!0)},"merge","Use `assign`."),ua=1,va=/mobile|tablet|ip(ad|hone|od)|android/i,wa="ontouchstart"in a,xa=u(a,"PointerEvent")!==d,ya=wa&&va.test(navigator.userAgent),za="touch",Aa="pen",Ba="mouse",Ca="kinect",Da=25,Ea=1,Fa=2,Ga=4,Ha=8,Ia=1,Ja=2,Ka=4,La=8,Ma=16,Na=Ja|Ka,Oa=La|Ma,Pa=Na|Oa,Qa=["x","y"],Ra=["clientX","clientY"];x.prototype={handler:function(){},init:function(){this.evEl&&m(this.element,this.evEl,this.domHandler),this.evTarget&&m(this.target,this.evTarget,this.domHandler),this.evWin&&m(w(this.element),this.evWin,this.domHandler)},destroy:function(){this.evEl&&n(this.element,this.evEl,this.domHandler),this.evTarget&&n(this.target,this.evTarget,this.domHandler),this.evWin&&n(w(this.element),this.evWin,this.domHandler)}};var Sa={mousedown:Ea,mousemove:Fa,mouseup:Ga},Ta="mousedown",Ua="mousemove mouseup";i(L,x,{handler:function(a){var b=Sa[a.type];b&Ea&&0===a.button&&(this.pressed=!0),b&Fa&&1!==a.which&&(b=Ga),this.pressed&&(b&Ga&&(this.pressed=!1),this.callback(this.manager,b,{pointers:[a],changedPointers:[a],pointerType:Ba,srcEvent:a}))}});var Va={pointerdown:Ea,pointermove:Fa,pointerup:Ga,pointercancel:Ha,pointerout:Ha},Wa={2:za,3:Aa,4:Ba,5:Ca},Xa="pointerdown",Ya="pointermove pointerup pointercancel";a.MSPointerEvent&&!a.PointerEvent&&(Xa="MSPointerDown",Ya="MSPointerMove MSPointerUp MSPointerCancel"),i(M,x,{handler:function(a){var b=this.store,c=!1,d=a.type.toLowerCase().replace("ms",""),e=Va[d],f=Wa[a.pointerType]||a.pointerType,g=f==za,h=r(b,a.pointerId,"pointerId");e&Ea&&(0===a.button||g)?0>h&&(b.push(a),h=b.length-1):e&(Ga|Ha)&&(c=!0),0>h||(b[h]=a,this.callback(this.manager,e,{pointers:b,changedPointers:[a],pointerType:f,srcEvent:a}),c&&b.splice(h,1))}});var Za={touchstart:Ea,touchmove:Fa,touchend:Ga,touchcancel:Ha},$a="touchstart",_a="touchstart touchmove touchend touchcancel";i(N,x,{handler:function(a){var b=Za[a.type];if(b===Ea&&(this.started=!0),this.started){var c=O.call(this,a,b);b&(Ga|Ha)&&c[0].length-c[1].length===0&&(this.started=!1),this.callback(this.manager,b,{pointers:c[0],changedPointers:c[1],pointerType:za,srcEvent:a})}}});var ab={touchstart:Ea,touchmove:Fa,touchend:Ga,touchcancel:Ha},bb="touchstart touchmove touchend touchcancel";i(P,x,{handler:function(a){var b=ab[a.type],c=Q.call(this,a,b);c&&this.callback(this.manager,b,{pointers:c[0],changedPointers:c[1],pointerType:za,srcEvent:a})}});var cb=2500,db=25;i(R,x,{handler:function(a,b,c){var d=c.pointerType==za,e=c.pointerType==Ba;if(!(e&&c.sourceCapabilities&&c.sourceCapabilities.firesTouchEvents)){if(d)S.call(this,b,c);else if(e&&U.call(this,c))return;this.callback(a,b,c)}},destroy:function(){this.touch.destroy(),this.mouse.destroy()}});var eb=u(na.style,"touchAction"),fb=eb!==d,gb="compute",hb="auto",ib="manipulation",jb="none",kb="pan-x",lb="pan-y",mb=X();V.prototype={set:function(a){a==gb&&(a=this.compute()),fb&&this.manager.element.style&&mb[a]&&(this.manager.element.style[eb]=a),this.actions=a.toLowerCase().trim()},update:function(){this.set(this.manager.options.touchAction)},compute:function(){var a=[];return g(this.manager.recognizers,function(b){k(b.options.enable,[b])&&(a=a.concat(b.getTouchAction()))}),W(a.join(" "))},preventDefaults:function(a){var b=a.srcEvent,c=a.offsetDirection;if(this.manager.session.prevented)return void b.preventDefault();var d=this.actions,e=p(d,jb)&&!mb[jb],f=p(d,lb)&&!mb[lb],g=p(d,kb)&&!mb[kb];if(e){var h=1===a.pointers.length,i=a.distance<2,j=a.deltaTime<250;if(h&&i&&j)return}return g&&f?void 0:e||f&&c&Na||g&&c&Oa?this.preventSrc(b):void 0},preventSrc:function(a){this.manager.session.prevented=!0,a.preventDefault()}};var nb=1,ob=2,pb=4,qb=8,rb=qb,sb=16,tb=32;Y.prototype={defaults:{},set:function(a){return la(this.options,a),this.manager&&this.manager.touchAction.update(),this},recognizeWith:function(a){if(f(a,"recognizeWith",this))return this;var b=this.simultaneous;return a=_(a,this),b[a.id]||(b[a.id]=a,a.recognizeWith(this)),this},dropRecognizeWith:function(a){return f(a,"dropRecognizeWith",this)?this:(a=_(a,this),delete this.simultaneous[a.id],this)},requireFailure:function(a){if(f(a,"requireFailure",this))return this;var b=this.requireFail;return a=_(a,this),-1===r(b,a)&&(b.push(a),a.requireFailure(this)),this},dropRequireFailure:function(a){if(f(a,"dropRequireFailure",this))return this;a=_(a,this);var b=r(this.requireFail,a);return b>-1&&this.requireFail.splice(b,1),this},hasRequireFailures:function(){return this.requireFail.length>0},canRecognizeWith:function(a){return!!this.simultaneous[a.id]},emit:function(a){function b(b){c.manager.emit(b,a)}var c=this,d=this.state;qb>d&&b(c.options.event+Z(d)),b(c.options.event),a.additionalEvent&&b(a.additionalEvent),d>=qb&&b(c.options.event+Z(d))},tryEmit:function(a){return this.canEmit()?this.emit(a):void(this.state=tb)},canEmit:function(){for(var a=0;a<this.requireFail.length;){if(!(this.requireFail[a].state&(tb|nb)))return!1;a++}return!0},recognize:function(a){var b=la({},a);return k(this.options.enable,[this,b])?(this.state&(rb|sb|tb)&&(this.state=nb),this.state=this.process(b),void(this.state&(ob|pb|qb|sb)&&this.tryEmit(b))):(this.reset(),void(this.state=tb))},process:function(a){},getTouchAction:function(){},reset:function(){}},i(aa,Y,{defaults:{pointers:1},attrTest:function(a){var b=this.options.pointers;return 0===b||a.pointers.length===b},process:function(a){var b=this.state,c=a.eventType,d=b&(ob|pb),e=this.attrTest(a);return d&&(c&Ha||!e)?b|sb:d||e?c&Ga?b|qb:b&ob?b|pb:ob:tb}}),i(ba,aa,{defaults:{event:"pan",threshold:10,pointers:1,direction:Pa},getTouchAction:function(){var a=this.options.direction,b=[];return a&Na&&b.push(lb),a&Oa&&b.push(kb),b},directionTest:function(a){var b=this.options,c=!0,d=a.distance,e=a.direction,f=a.deltaX,g=a.deltaY;return e&b.direction||(b.direction&Na?(e=0===f?Ia:0>f?Ja:Ka,c=f!=this.pX,d=Math.abs(a.deltaX)):(e=0===g?Ia:0>g?La:Ma,c=g!=this.pY,d=Math.abs(a.deltaY))),a.direction=e,c&&d>b.threshold&&e&b.direction},attrTest:function(a){return aa.prototype.attrTest.call(this,a)&&(this.state&ob||!(this.state&ob)&&this.directionTest(a))},emit:function(a){this.pX=a.deltaX,this.pY=a.deltaY;var b=$(a.direction);b&&(a.additionalEvent=this.options.event+b),this._super.emit.call(this,a)}}),i(ca,aa,{defaults:{event:"pinch",threshold:0,pointers:2},getTouchAction:function(){return[jb]},attrTest:function(a){return this._super.attrTest.call(this,a)&&(Math.abs(a.scale-1)>this.options.threshold||this.state&ob)},emit:function(a){if(1!==a.scale){var b=a.scale<1?"in":"out";a.additionalEvent=this.options.event+b}this._super.emit.call(this,a)}}),i(da,Y,{defaults:{event:"press",pointers:1,time:251,threshold:9},getTouchAction:function(){return[hb]},process:function(a){var b=this.options,c=a.pointers.length===b.pointers,d=a.distance<b.threshold,f=a.deltaTime>b.time;if(this._input=a,!d||!c||a.eventType&(Ga|Ha)&&!f)this.reset();else if(a.eventType&Ea)this.reset(),this._timer=e(function(){this.state=rb,this.tryEmit()},b.time,this);else if(a.eventType&Ga)return rb;return tb},reset:function(){clearTimeout(this._timer)},emit:function(a){this.state===rb&&(a&&a.eventType&Ga?this.manager.emit(this.options.event+"up",a):(this._input.timeStamp=ra(),this.manager.emit(this.options.event,this._input)))}}),i(ea,aa,{defaults:{event:"rotate",threshold:0,pointers:2},getTouchAction:function(){return[jb]},attrTest:function(a){return this._super.attrTest.call(this,a)&&(Math.abs(a.rotation)>this.options.threshold||this.state&ob)}}),i(fa,aa,{defaults:{event:"swipe",threshold:10,velocity:.3,direction:Na|Oa,pointers:1},getTouchAction:function(){return ba.prototype.getTouchAction.call(this)},attrTest:function(a){var b,c=this.options.direction;return c&(Na|Oa)?b=a.overallVelocity:c&Na?b=a.overallVelocityX:c&Oa&&(b=a.overallVelocityY),this._super.attrTest.call(this,a)&&c&a.offsetDirection&&a.distance>this.options.threshold&&a.maxPointers==this.options.pointers&&qa(b)>this.options.velocity&&a.eventType&Ga},emit:function(a){var b=$(a.offsetDirection);b&&this.manager.emit(this.options.event+b,a),this.manager.emit(this.options.event,a)}}),i(ga,Y,{defaults:{event:"tap",pointers:1,taps:1,interval:300,time:250,threshold:9,posThreshold:10},getTouchAction:function(){return[ib]},process:function(a){var b=this.options,c=a.pointers.length===b.pointers,d=a.distance<b.threshold,f=a.deltaTime<b.time;if(this.reset(),a.eventType&Ea&&0===this.count)return this.failTimeout();if(d&&f&&c){if(a.eventType!=Ga)return this.failTimeout();var g=this.pTime?a.timeStamp-this.pTime<b.interval:!0,h=!this.pCenter||H(this.pCenter,a.center)<b.posThreshold;this.pTime=a.timeStamp,this.pCenter=a.center,h&&g?this.count+=1:this.count=1,this._input=a;var i=this.count%b.taps;if(0===i)return this.hasRequireFailures()?(this._timer=e(function(){this.state=rb,this.tryEmit()},b.interval,this),ob):rb}return tb},failTimeout:function(){return this._timer=e(function(){this.state=tb},this.options.interval,this),tb},reset:function(){clearTimeout(this._timer)},emit:function(){this.state==rb&&(this._input.tapCount=this.count,this.manager.emit(this.options.event,this._input))}}),ha.VERSION="2.0.8",ha.defaults={domEvents:!1,touchAction:gb,enable:!0,inputTarget:null,inputClass:null,preset:[[ea,{enable:!1}],[ca,{enable:!1},["rotate"]],[fa,{direction:Na}],[ba,{direction:Na},["swipe"]],[ga],[ga,{event:"doubletap",taps:2},["tap"]],[da]],cssProps:{userSelect:"none",touchSelect:"none",touchCallout:"none",contentZooming:"none",userDrag:"none",tapHighlightColor:"rgba(0,0,0,0)"}};var ub=1,vb=2;ia.prototype={set:function(a){return la(this.options,a),a.touchAction&&this.touchAction.update(),a.inputTarget&&(this.input.destroy(),this.input.target=a.inputTarget,this.input.init()),this},stop:function(a){this.session.stopped=a?vb:ub},recognize:function(a){var b=this.session;if(!b.stopped){this.touchAction.preventDefaults(a);var c,d=this.recognizers,e=b.curRecognizer;(!e||e&&e.state&rb)&&(e=b.curRecognizer=null);for(var f=0;f<d.length;)c=d[f],b.stopped===vb||e&&c!=e&&!c.canRecognizeWith(e)?c.reset():c.recognize(a),!e&&c.state&(ob|pb|qb)&&(e=b.curRecognizer=c),f++}},get:function(a){if(a instanceof Y)return a;for(var b=this.recognizers,c=0;c<b.length;c++)if(b[c].options.event==a)return b[c];return null},add:function(a){if(f(a,"add",this))return this;var b=this.get(a.options.event);return b&&this.remove(b),this.recognizers.push(a),a.manager=this,this.touchAction.update(),a},remove:function(a){if(f(a,"remove",this))return this;if(a=this.get(a)){var b=this.recognizers,c=r(b,a);-1!==c&&(b.splice(c,1),this.touchAction.update())}return this},on:function(a,b){if(a!==d&&b!==d){var c=this.handlers;return g(q(a),function(a){c[a]=c[a]||[],c[a].push(b)}),this}},off:function(a,b){if(a!==d){var c=this.handlers;return g(q(a),function(a){b?c[a]&&c[a].splice(r(c[a],b),1):delete c[a]}),this}},emit:function(a,b){this.options.domEvents&&ka(a,b);var c=this.handlers[a]&&this.handlers[a].slice();if(c&&c.length){b.type=a,b.preventDefault=function(){b.srcEvent.preventDefault()};for(var d=0;d<c.length;)c[d](b),d++}},destroy:function(){this.element&&ja(this,!1),this.handlers={},this.session={},this.input.destroy(),this.element=null}},la(ha,{INPUT_START:Ea,INPUT_MOVE:Fa,INPUT_END:Ga,INPUT_CANCEL:Ha,STATE_POSSIBLE:nb,STATE_BEGAN:ob,STATE_CHANGED:pb,STATE_ENDED:qb,STATE_RECOGNIZED:rb,STATE_CANCELLED:sb,STATE_FAILED:tb,DIRECTION_NONE:Ia,DIRECTION_LEFT:Ja,DIRECTION_RIGHT:Ka,DIRECTION_UP:La,DIRECTION_DOWN:Ma,DIRECTION_HORIZONTAL:Na,DIRECTION_VERTICAL:Oa,DIRECTION_ALL:Pa,Manager:ia,Input:x,TouchAction:V,TouchInput:P,MouseInput:L,PointerEventInput:M,TouchMouseInput:R,SingleTouchInput:N,Recognizer:Y,AttrRecognizer:aa,Tap:ga,Pan:ba,Swipe:fa,Pinch:ca,Rotate:ea,Press:da,on:m,off:n,each:g,merge:ta,extend:sa,assign:la,inherit:i,bindFn:j,prefixed:u});var wb="undefined"!=typeof a?a:"undefined"!=typeof self?self:{};wb.Hammer=ha,"function"==typeof define&&define.amd?define(function(){return ha}):"undefined"!=typeof module&&module.exports?module.exports=ha:a[c]=ha}(window,document,"Hammer");


/* Unison JS */
var Unison=function(){"use strict";var a,b=window,c=document,d=c.head,e={},f=!1,g={parseMQ:function(a){var c=b.getComputedStyle(a,null).getPropertyValue("font-family");return c.replace(/"/g,"").replace(/'/g,"")},debounce:function(a,b,c){var d;return function(){var e=this,f=arguments;clearTimeout(d),d=setTimeout(function(){d=null,c||a.apply(e,f)},b),c&&!d&&a.apply(e,f)}},isObject:function(a){return"object"==typeof a},isUndefined:function(a){return"undefined"==typeof a}},h={on:function(a,b){g.isObject(e[a])||(e[a]=[]),e[a].push(b)},emit:function(a,b){if(g.isObject(e[a]))for(var c=e[a].slice(),d=0;d<c.length;d++)c[d].call(this,b)}},i={all:function(){for(var a={},b=g.parseMQ(c.querySelector("title")).split(","),d=0;d<b.length;d++){var e=b[d].trim().split(" ");a[e[0]]=e[1]}return f?a:null},now:function(a){var b=g.parseMQ(d).split(" "),c={name:b[0],width:b[1]};return f?g.isUndefined(a)?c:a(c):null},update:function(){i.now(function(b){b.name!==a&&(h.emit(b.name),h.emit("change",b),a=b.name)})}};return b.onresize=g.debounce(i.update,100),c.addEventListener("DOMContentLoaded",function(){f="none"!==b.getComputedStyle(d,null).getPropertyValue("clear"),i.update()}),{fetch:{all:i.all,now:i.now},on:h.on,emit:h.emit,util:{debounce:g.debounce,isObject:g.isObject}}}();


/*!
 * jQuery blockUI plugin
 * Version 2.70.0-2014.11.23
 * Requires jQuery v1.7 or later
 *
 * Examples at: http://malsup.com/jquery/block/
 * Copyright (c) 2007-2013 M. Alsup
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Thanks to Amir-Hossein Sobhi for some excellent contributions!
 */

!function(){"use strict";function e(e){function t(t,n){var s,h,k=t==window,y=n&&void 0!==n.message?n.message:void 0;if(n=e.extend({},e.blockUI.defaults,n||{}),!n.ignoreIfBlocked||!e(t).data("blockUI.isBlocked")){if(n.overlayCSS=e.extend({},e.blockUI.defaults.overlayCSS,n.overlayCSS||{}),s=e.extend({},e.blockUI.defaults.css,n.css||{}),n.onOverlayClick&&(n.overlayCSS.cursor="pointer"),h=e.extend({},e.blockUI.defaults.themedCSS,n.themedCSS||{}),y=void 0===y?n.message:y,k&&p&&o(window,{fadeOut:0}),y&&"string"!=typeof y&&(y.parentNode||y.jquery)){var m=y.jquery?y[0]:y,v={};e(t).data("blockUI.history",v),v.el=m,v.parent=m.parentNode,v.display=m.style.display,v.position=m.style.position,v.parent&&v.parent.removeChild(m)}e(t).data("blockUI.onUnblock",n.onUnblock);var g,I,w,U,x=n.baseZ;g=e(r||n.forceIframe?'<iframe class="blockUI" style="z-index:'+x++ +';display:none;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="'+n.iframeSrc+'"></iframe>':'<div class="blockUI" style="display:none"></div>'),I=e(n.theme?'<div class="blockUI blockOverlay ui-widget-overlay" style="z-index:'+x++ +';display:none"></div>':'<div class="blockUI blockOverlay" style="z-index:'+x++ +';display:none;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>'),n.theme&&k?(U='<div class="blockUI '+n.blockMsgClass+' blockPage ui-dialog ui-widget ui-corner-all" style="z-index:'+(x+10)+';display:none;position:fixed">',n.title&&(U+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(n.title||"&nbsp;")+"</div>"),U+='<div class="ui-widget-content ui-dialog-content"></div>',U+="</div>"):n.theme?(U='<div class="blockUI '+n.blockMsgClass+' blockElement ui-dialog ui-widget ui-corner-all" style="z-index:'+(x+10)+';display:none;position:absolute">',n.title&&(U+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(n.title||"&nbsp;")+"</div>"),U+='<div class="ui-widget-content ui-dialog-content"></div>',U+="</div>"):U=k?'<div class="blockUI '+n.blockMsgClass+' blockPage" style="z-index:'+(x+10)+';display:none;position:fixed"></div>':'<div class="blockUI '+n.blockMsgClass+' blockElement" style="z-index:'+(x+10)+';display:none;position:absolute"></div>',w=e(U),y&&(n.theme?(w.css(h),w.addClass("ui-widget-content")):w.css(s)),n.theme||I.css(n.overlayCSS),I.css("position",k?"fixed":"absolute"),(r||n.forceIframe)&&g.css("opacity",0);var C=[g,I,w],S=e(k?"body":t);e.each(C,function(){this.appendTo(S)}),n.theme&&n.draggable&&e.fn.draggable&&w.draggable({handle:".ui-dialog-titlebar",cancel:"li"});var O=f&&(!e.support.boxModel||e("object,embed",k?null:t).length>0);if(u||O){if(k&&n.allowBodyStretch&&e.support.boxModel&&e("html,body").css("height","100%"),(u||!e.support.boxModel)&&!k)var E=d(t,"borderTopWidth"),T=d(t,"borderLeftWidth"),M=E?"(0 - "+E+")":0,B=T?"(0 - "+T+")":0;e.each(C,function(e,t){var o=t[0].style;if(o.position="absolute",2>e)k?o.setExpression("height","Math.max(document.body.scrollHeight, document.body.offsetHeight) - (jQuery.support.boxModel?0:"+n.quirksmodeOffsetHack+') + "px"'):o.setExpression("height",'this.parentNode.offsetHeight + "px"'),k?o.setExpression("width",'jQuery.support.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"'):o.setExpression("width",'this.parentNode.offsetWidth + "px"'),B&&o.setExpression("left",B),M&&o.setExpression("top",M);else if(n.centerY)k&&o.setExpression("top",'(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"'),o.marginTop=0;else if(!n.centerY&&k){var i=n.css&&n.css.top?parseInt(n.css.top,10):0,s="((document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "+i+') + "px"';o.setExpression("top",s)}})}if(y&&(n.theme?w.find(".ui-widget-content").append(y):w.append(y),(y.jquery||y.nodeType)&&e(y).show()),(r||n.forceIframe)&&n.showOverlay&&g.show(),n.fadeIn){var j=n.onBlock?n.onBlock:c,H=n.showOverlay&&!y?j:c,z=y?j:c;n.showOverlay&&I._fadeIn(n.fadeIn,H),y&&w._fadeIn(n.fadeIn,z)}else n.showOverlay&&I.show(),y&&w.show(),n.onBlock&&n.onBlock.bind(w)();if(i(1,t,n),k?(p=w[0],b=e(n.focusableElements,p),n.focusInput&&setTimeout(l,20)):a(w[0],n.centerX,n.centerY),n.timeout){var W=setTimeout(function(){k?e.unblockUI(n):e(t).unblock(n)},n.timeout);e(t).data("blockUI.timeout",W)}}}function o(t,o){var s,l=t==window,a=e(t),d=a.data("blockUI.history"),c=a.data("blockUI.timeout");c&&(clearTimeout(c),a.removeData("blockUI.timeout")),o=e.extend({},e.blockUI.defaults,o||{}),i(0,t,o),null===o.onUnblock&&(o.onUnblock=a.data("blockUI.onUnblock"),a.removeData("blockUI.onUnblock"));var r;r=l?e("body").children().filter(".blockUI").add("body > .blockUI"):a.find(">.blockUI"),o.cursorReset&&(r.length>1&&(r[1].style.cursor=o.cursorReset),r.length>2&&(r[2].style.cursor=o.cursorReset)),l&&(p=b=null),o.fadeOut?(s=r.length,r.stop().fadeOut(o.fadeOut,function(){0===--s&&n(r,d,o,t)})):n(r,d,o,t)}function n(t,o,n,i){var s=e(i);if(!s.data("blockUI.isBlocked")){t.each(function(e,t){this.parentNode&&this.parentNode.removeChild(this)}),o&&o.el&&(o.el.style.display=o.display,o.el.style.position=o.position,o.el.style.cursor="default",o.parent&&o.parent.appendChild(o.el),s.removeData("blockUI.history")),s.data("blockUI.static")&&s.css("position","static"),"function"==typeof n.onUnblock&&n.onUnblock(i,n);var l=e(document.body),a=l.width(),d=l[0].style.width;l.width(a-1).width(a),l[0].style.width=d}}function i(t,o,n){var i=o==window,l=e(o);if((t||(!i||p)&&(i||l.data("blockUI.isBlocked")))&&(l.data("blockUI.isBlocked",t),i&&n.bindEvents&&(!t||n.showOverlay))){var a="mousedown mouseup keydown keypress keyup touchstart touchend touchmove";t?e(document).bind(a,n,s):e(document).unbind(a,s)}}function s(t){if("keydown"===t.type&&t.keyCode&&9==t.keyCode&&p&&t.data.constrainTabKey){var o=b,n=!t.shiftKey&&t.target===o[o.length-1],i=t.shiftKey&&t.target===o[0];if(n||i)return setTimeout(function(){l(i)},10),!1}var s=t.data,a=e(t.target);return a.hasClass("blockOverlay")&&s.onOverlayClick&&s.onOverlayClick(t),a.parents("div."+s.blockMsgClass).length>0?!0:0===a.parents().children().filter("div.blockUI").length}function l(e){if(b){var t=b[e===!0?b.length-1:0];t&&t.focus()}}function a(e,t,o){var n=e.parentNode,i=e.style,s=(n.offsetWidth-e.offsetWidth)/2-d(n,"borderLeftWidth"),l=(n.offsetHeight-e.offsetHeight)/2-d(n,"borderTopWidth");t&&(i.left=s>0?s+"px":"0"),o&&(i.top=l>0?l+"px":"0")}function d(t,o){return parseInt(e.css(t,o),10)||0}e.fn._fadeIn=e.fn.fadeIn;var c=e.noop||function(){},r=/MSIE/.test(navigator.userAgent),u=/MSIE 6.0/.test(navigator.userAgent)&&!/MSIE 8.0/.test(navigator.userAgent),f=(document.documentMode||0,e.isFunction(document.createElement("div").style.setExpression));e.blockUI=function(e){t(window,e)},e.unblockUI=function(e){o(window,e)},e.growlUI=function(t,o,n,i){var s=e('<div class="growlUI"></div>');t&&s.append("<h1>"+t+"</h1>"),o&&s.append("<h2>"+o+"</h2>"),void 0===n&&(n=3e3);var l=function(t){t=t||{},e.blockUI({message:s,fadeIn:"undefined"!=typeof t.fadeIn?t.fadeIn:700,fadeOut:"undefined"!=typeof t.fadeOut?t.fadeOut:1e3,timeout:"undefined"!=typeof t.timeout?t.timeout:n,centerY:!1,showOverlay:!1,onUnblock:i,css:e.blockUI.defaults.growlCSS})};l();s.css("opacity");s.mouseover(function(){l({fadeIn:0,timeout:3e4});var t=e(".blockMsg");t.stop(),t.fadeTo(300,1)}).mouseout(function(){e(".blockMsg").fadeOut(1e3)})},e.fn.block=function(o){if(this[0]===window)return e.blockUI(o),this;var n=e.extend({},e.blockUI.defaults,o||{});return this.each(function(){var t=e(this);n.ignoreIfBlocked&&t.data("blockUI.isBlocked")||t.unblock({fadeOut:0})}),this.each(function(){"static"==e.css(this,"position")&&(this.style.position="relative",e(this).data("blockUI.static",!0)),this.style.zoom=1,t(this,o)})},e.fn.unblock=function(t){return this[0]===window?(e.unblockUI(t),this):this.each(function(){o(this,t)})},e.blockUI.version=2.7,e.blockUI.defaults={message:"<h1>Please wait...</h1>",title:null,draggable:!0,theme:!1,css:{padding:0,margin:0,width:"30%",top:"40%",left:"35%",textAlign:"center",color:"#000",border:"3px solid #aaa",backgroundColor:"#fff",cursor:"wait"},themedCSS:{width:"30%",top:"40%",left:"35%"},overlayCSS:{backgroundColor:"#000",opacity:.6,cursor:"wait"},cursorReset:"default",growlCSS:{width:"350px",top:"10px",left:"",right:"10px",border:"none",padding:"5px",opacity:.6,cursor:"default",color:"#fff",backgroundColor:"#000","-webkit-border-radius":"10px","-moz-border-radius":"10px","border-radius":"10px"},iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank",forceIframe:!1,baseZ:1e3,centerX:!0,centerY:!0,allowBodyStretch:!0,bindEvents:!0,constrainTabKey:!0,fadeIn:200,fadeOut:400,timeout:0,showOverlay:!0,focusInput:!0,focusableElements:":input:enabled:visible",onBlock:null,onUnblock:null,onOverlayClick:null,quirksmodeOffsetHack:4,blockMsgClass:"blockMsg",ignoreIfBlocked:!1};var p=null,b=[]}"function"==typeof define&&define.amd&&define.amd.jQuery?define(["jquery"],e):e(jQuery)}();

/*
* jquery-match-height 0.7.2 by @liabru
* http://brm.io/jquery-match-height/
* License MIT
*/
!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){var e=-1,o=-1,n=function(t){return parseFloat(t)||0},a=function(e){var o=1,a=t(e),i=null,r=[];return a.each(function(){var e=t(this),a=e.offset().top-n(e.css("margin-top")),s=r.length>0?r[r.length-1]:null;null===s?r.push(e):Math.floor(Math.abs(i-a))<=o?r[r.length-1]=s.add(e):r.push(e),i=a}),r},i=function(e){var o={
byRow:!0,property:"height",target:null,remove:!1};return"object"==typeof e?t.extend(o,e):("boolean"==typeof e?o.byRow=e:"remove"===e&&(o.remove=!0),o)},r=t.fn.matchHeight=function(e){var o=i(e);if(o.remove){var n=this;return this.css(o.property,""),t.each(r._groups,function(t,e){e.elements=e.elements.not(n)}),this}return this.length<=1&&!o.target?this:(r._groups.push({elements:this,options:o}),r._apply(this,o),this)};r.version="0.7.2",r._groups=[],r._throttle=80,r._maintainScroll=!1,r._beforeUpdate=null,
r._afterUpdate=null,r._rows=a,r._parse=n,r._parseOptions=i,r._apply=function(e,o){var s=i(o),h=t(e),l=[h],c=t(window).scrollTop(),p=t("html").outerHeight(!0),u=h.parents().filter(":hidden");return u.each(function(){var e=t(this);e.data("style-cache",e.attr("style"))}),u.css("display","block"),s.byRow&&!s.target&&(h.each(function(){var e=t(this),o=e.css("display");"inline-block"!==o&&"flex"!==o&&"inline-flex"!==o&&(o="block"),e.data("style-cache",e.attr("style")),e.css({display:o,"padding-top":"0",
"padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px",overflow:"hidden"})}),l=a(h),h.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||"")})),t.each(l,function(e,o){var a=t(o),i=0;if(s.target)i=s.target.outerHeight(!1);else{if(s.byRow&&a.length<=1)return void a.css(s.property,"");a.each(function(){var e=t(this),o=e.attr("style"),n=e.css("display");"inline-block"!==n&&"flex"!==n&&"inline-flex"!==n&&(n="block");var a={
display:n};a[s.property]="",e.css(a),e.outerHeight(!1)>i&&(i=e.outerHeight(!1)),o?e.attr("style",o):e.css("display","")})}a.each(function(){var e=t(this),o=0;s.target&&e.is(s.target)||("border-box"!==e.css("box-sizing")&&(o+=n(e.css("border-top-width"))+n(e.css("border-bottom-width")),o+=n(e.css("padding-top"))+n(e.css("padding-bottom"))),e.css(s.property,i-o+"px"))})}),u.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||null)}),r._maintainScroll&&t(window).scrollTop(c/p*t("html").outerHeight(!0)),
this},r._applyDataApi=function(){var e={};t("[data-match-height], [data-mh]").each(function(){var o=t(this),n=o.attr("data-mh")||o.attr("data-match-height");n in e?e[n]=e[n].add(o):e[n]=o}),t.each(e,function(){this.matchHeight(!0)})};var s=function(e){r._beforeUpdate&&r._beforeUpdate(e,r._groups),t.each(r._groups,function(){r._apply(this.elements,this.options)}),r._afterUpdate&&r._afterUpdate(e,r._groups)};r._update=function(n,a){if(a&&"resize"===a.type){var i=t(window).width();if(i===e)return;e=i;
}n?o===-1&&(o=setTimeout(function(){s(a),o=-1},r._throttle)):s(a)},t(r._applyDataApi);var h=t.fn.on?"on":"bind";t(window)[h]("load",function(t){r._update(!1,t)}),t(window)[h]("resize orientationchange",function(t){r._update(!0,t)})});
/*
 *	jQuery Sliding Menu Plugin
 *	Mobile app list-style navigation in the browser
 *
 *	Written by Ali Zahid
 *	http://designplox.com/jquery-sliding-menu
 */
!function(a){var e=[];a.fn.slidingMenu=function(t){function n(e){var t=a("ul",e),n=[];return a(t).each(function(e,t){var r=a(t),s=r.prev(),l=i();if(1==s.length&&(s.addClass("nav-has-children dropdown-item").attr("href","#menu-panel-"+l),s.append('<i class="ft-arrow-right children-in"></i>')),r.attr("id","menu-panel-"+l),0==e)r.addClass("menu-panel-root");else{r.addClass("menu-panel");var d=(a("<li></li>"),a("<a></a>").addClass("nav-has-parent back primary dropdown-item").attr("href","#menu-panel-back"));r.prepend(d)}n.push(t)}),n}function r(e,t){var n={id:"menu-panel-"+i(),children:[],root:t?!1:!0},s=[];return t&&n.children.push({styleClass:"back",href:"#"+t.id}),a(e).each(function(a,e){if(n.children.push(e),e.children){var t=r(e.children,n);e.href="#"+t[0].id,e.styleClass="nav",s=s.concat(t)}}),[n].concat(s)}function i(){var a;do a=Math.random().toString(36).substring(3,8);while(e.indexOf(a)>=0);return e.push(a),a}function s(){var e=a(".sliding-menu-wrapper"),t=a(".sliding-menu-wrapper ul");t.length&&setTimeout(function(){var n=a(l).width();e.width(t.length*n),t.each(function(e,t){var r=a(t);r.width(n)}),e.css("margin-left","")},300)}var l=this.selector,d=!1;"rtl"==a("html").data("textdirection")&&(d=!0);var h=a.extend({dataJSON:!1,backLabel:"Back"},t);return this.each(function(){var e,t=this,i=a(t);if(i.hasClass("sliding-menu"))return void s();var l=i.outerWidth();e=h.dataJSON?r(h.dataJSON):n(i),i.empty().addClass("sliding-menu");var p;h.dataJSON?a(e).each(function(e,t){var n=a("<ul></ul>");t.root&&(p="#"+t.id),n.attr("id",t.id),n.addClass("menu-panel"),n.width(l),a(t.children).each(function(e,t){var r=a("<a></a>");r.attr("class",t.styleClass),r.attr("href",t.href),r.text(t.label);var i=a("<li></li>");i.append(r),n.append(i)}),i.append(n)}):a(e).each(function(e,t){var n=a(t);n.hasClass("menu-panel-root")&&(p="#"+n.attr("id")),n.width(l),i.append(t)}),p=a(p),p.addClass("menu-panel-root");var c=p;i.height(p.height());var u=a("<div></div>").addClass("sliding-menu-wrapper").width(e.length*l);return i.wrapInner(u),u=a(".sliding-menu-wrapper",i),a("a",t).on("click",function(e){var t=a(this).attr("href"),n=a(this).text();if(u.is(":animated"))return void e.preventDefault();if("#"==t)e.preventDefault();else if(0==t.indexOf("#menu-panel")){var r,s,l=a(t),o=a(this).hasClass("back");d===!0?s=parseInt(u.css("margin-right")):r=parseInt(u.css("margin-left"));var f=i.width();a(this).closest("ul").hasClass("menu-panel-root")&&(c=p),o?("#menu-panel-back"==t&&(l=c.prev()),d===!0?properties={marginRight:s+f}:properties={marginLeft:r+f},u.stop(!0,!0).animate(properties,"fast")):(l.insertAfter(c),h.backLabel===!0?a(".back",l).html('<i class="fa fa-arrow-circle-o-left back-in"></i>'+n):a(".back",l).text(h.backLabel),d===!0?properties={marginRight:s-f}:properties={marginLeft:r-f},u.stop(!0,!0).animate(properties,"fast")),c=l,i.stop(!0,!0).animate({height:l.height()},"fast"),e.preventDefault()}}),this})}}(jQuery);

/*!
* screenfull
* v5.0.0 - 2019-09-09
* (c) Sindre Sorhus; MIT License
*/

import screenfull from 'screenfull';


/*! pace 1.0.2 */

(function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X=[].slice,Y={}.hasOwnProperty,Z=function(a,b){function c(){this.constructor=a}for(var d in b)Y.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a},$=[].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1};for(u={catchupTime:100,initialRate:.03,minTime:250,ghostTime:100,maxProgressPerFrame:20,easeFactor:1.25,startOnPageLoad:!0,restartOnPushState:!0,restartOnRequestAfter:500,target:"body",elements:{checkInterval:100,selectors:["body"]},eventLag:{minSamples:10,sampleCount:3,lagThreshold:3},ajax:{trackMethods:["GET"],trackWebSockets:!0,ignoreURLs:[]}},C=function(){var a;return null!=(a="undefined"!=typeof performance&&null!==performance&&"function"==typeof performance.now?performance.now():void 0)?a:+new Date},E=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame,t=window.cancelAnimationFrame||window.mozCancelAnimationFrame,null==E&&(E=function(a){return setTimeout(a,50)},t=function(a){return clearTimeout(a)}),G=function(a){var b,c;return b=C(),(c=function(){var d;return d=C()-b,d>=33?(b=C(),a(d,function(){return E(c)})):setTimeout(c,33-d)})()},F=function(){var a,b,c;return c=arguments[0],b=arguments[1],a=3<=arguments.length?X.call(arguments,2):[],"function"==typeof c[b]?c[b].apply(c,a):c[b]},v=function(){var a,b,c,d,e,f,g;for(b=arguments[0],d=2<=arguments.length?X.call(arguments,1):[],f=0,g=d.length;g>f;f++)if(c=d[f])for(a in c)Y.call(c,a)&&(e=c[a],null!=b[a]&&"object"==typeof b[a]&&null!=e&&"object"==typeof e?v(b[a],e):b[a]=e);return b},q=function(a){var b,c,d,e,f;for(c=b=0,e=0,f=a.length;f>e;e++)d=a[e],c+=Math.abs(d),b++;return c/b},x=function(a,b){var c,d,e;if(null==a&&(a="options"),null==b&&(b=!0),e=document.querySelector("[data-pace-"+a+"]")){if(c=e.getAttribute("data-pace-"+a),!b)return c;try{return JSON.parse(c)}catch(f){return d=f,"undefined"!=typeof console&&null!==console?console.error("Error parsing inline pace options",d):void 0}}},g=function(){function a(){}return a.prototype.on=function(a,b,c,d){var e;return null==d&&(d=!1),null==this.bindings&&(this.bindings={}),null==(e=this.bindings)[a]&&(e[a]=[]),this.bindings[a].push({handler:b,ctx:c,once:d})},a.prototype.once=function(a,b,c){return this.on(a,b,c,!0)},a.prototype.off=function(a,b){var c,d,e;if(null!=(null!=(d=this.bindings)?d[a]:void 0)){if(null==b)return delete this.bindings[a];for(c=0,e=[];c<this.bindings[a].length;)e.push(this.bindings[a][c].handler===b?this.bindings[a].splice(c,1):c++);return e}},a.prototype.trigger=function(){var a,b,c,d,e,f,g,h,i;if(c=arguments[0],a=2<=arguments.length?X.call(arguments,1):[],null!=(g=this.bindings)?g[c]:void 0){for(e=0,i=[];e<this.bindings[c].length;)h=this.bindings[c][e],d=h.handler,b=h.ctx,f=h.once,d.apply(null!=b?b:this,a),i.push(f?this.bindings[c].splice(e,1):e++);return i}},a}(),j=window.Pace||{},window.Pace=j,v(j,g.prototype),D=j.options=v({},u,window.paceOptions,x()),U=["ajax","document","eventLag","elements"],Q=0,S=U.length;S>Q;Q++)K=U[Q],D[K]===!0&&(D[K]=u[K]);i=function(a){function b(){return V=b.__super__.constructor.apply(this,arguments)}return Z(b,a),b}(Error),b=function(){function a(){this.progress=0}return a.prototype.getElement=function(){var a;if(null==this.el){if(a=document.querySelector(D.target),!a)throw new i;this.el=document.createElement("div"),this.el.className="pace pace-active",document.body.className=document.body.className.replace(/pace-done/g,""),document.body.className+=" pace-running",this.el.innerHTML='<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>',null!=a.firstChild?a.insertBefore(this.el,a.firstChild):a.appendChild(this.el)}return this.el},a.prototype.finish=function(){var a;return a=this.getElement(),a.className=a.className.replace("pace-active",""),a.className+=" pace-inactive",document.body.className=document.body.className.replace("pace-running",""),document.body.className+=" pace-done"},a.prototype.update=function(a){return this.progress=a,this.render()},a.prototype.destroy=function(){try{this.getElement().parentNode.removeChild(this.getElement())}catch(a){i=a}return this.el=void 0},a.prototype.render=function(){var a,b,c,d,e,f,g;if(null==document.querySelector(D.target))return!1;for(a=this.getElement(),d="translate3d("+this.progress+"%, 0, 0)",g=["webkitTransform","msTransform","transform"],e=0,f=g.length;f>e;e++)b=g[e],a.children[0].style[b]=d;return(!this.lastRenderedProgress||this.lastRenderedProgress|0!==this.progress|0)&&(a.children[0].setAttribute("data-progress-text",""+(0|this.progress)+"%"),this.progress>=100?c="99":(c=this.progress<10?"0":"",c+=0|this.progress),a.children[0].setAttribute("data-progress",""+c)),this.lastRenderedProgress=this.progress},a.prototype.done=function(){return this.progress>=100},a}(),h=function(){function a(){this.bindings={}}return a.prototype.trigger=function(a,b){var c,d,e,f,g;if(null!=this.bindings[a]){for(f=this.bindings[a],g=[],d=0,e=f.length;e>d;d++)c=f[d],g.push(c.call(this,b));return g}},a.prototype.on=function(a,b){var c;return null==(c=this.bindings)[a]&&(c[a]=[]),this.bindings[a].push(b)},a}(),P=window.XMLHttpRequest,O=window.XDomainRequest,N=window.WebSocket,w=function(a,b){var c,d,e;e=[];for(d in b.prototype)try{e.push(null==a[d]&&"function"!=typeof b[d]?"function"==typeof Object.defineProperty?Object.defineProperty(a,d,{get:function(){return b.prototype[d]},configurable:!0,enumerable:!0}):a[d]=b.prototype[d]:void 0)}catch(f){c=f}return e},A=[],j.ignore=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?X.call(arguments,1):[],A.unshift("ignore"),c=b.apply(null,a),A.shift(),c},j.track=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?X.call(arguments,1):[],A.unshift("track"),c=b.apply(null,a),A.shift(),c},J=function(a){var b;if(null==a&&(a="GET"),"track"===A[0])return"force";if(!A.length&&D.ajax){if("socket"===a&&D.ajax.trackWebSockets)return!0;if(b=a.toUpperCase(),$.call(D.ajax.trackMethods,b)>=0)return!0}return!1},k=function(a){function b(){var a,c=this;b.__super__.constructor.apply(this,arguments),a=function(a){var b;return b=a.open,a.open=function(d,e){return J(d)&&c.trigger("request",{type:d,url:e,request:a}),b.apply(a,arguments)}},window.XMLHttpRequest=function(b){var c;return c=new P(b),a(c),c};try{w(window.XMLHttpRequest,P)}catch(d){}if(null!=O){window.XDomainRequest=function(){var b;return b=new O,a(b),b};try{w(window.XDomainRequest,O)}catch(d){}}if(null!=N&&D.ajax.trackWebSockets){window.WebSocket=function(a,b){var d;return d=null!=b?new N(a,b):new N(a),J("socket")&&c.trigger("request",{type:"socket",url:a,protocols:b,request:d}),d};try{w(window.WebSocket,N)}catch(d){}}}return Z(b,a),b}(h),R=null,y=function(){return null==R&&(R=new k),R},I=function(a){var b,c,d,e;for(e=D.ajax.ignoreURLs,c=0,d=e.length;d>c;c++)if(b=e[c],"string"==typeof b){if(-1!==a.indexOf(b))return!0}else if(b.test(a))return!0;return!1},y().on("request",function(b){var c,d,e,f,g;return f=b.type,e=b.request,g=b.url,I(g)?void 0:j.running||D.restartOnRequestAfter===!1&&"force"!==J(f)?void 0:(d=arguments,c=D.restartOnRequestAfter||0,"boolean"==typeof c&&(c=0),setTimeout(function(){var b,c,g,h,i,k;if(b="socket"===f?e.readyState<2:0<(h=e.readyState)&&4>h){for(j.restart(),i=j.sources,k=[],c=0,g=i.length;g>c;c++){if(K=i[c],K instanceof a){K.watch.apply(K,d);break}k.push(void 0)}return k}},c))}),a=function(){function a(){var a=this;this.elements=[],y().on("request",function(){return a.watch.apply(a,arguments)})}return a.prototype.watch=function(a){var b,c,d,e;return d=a.type,b=a.request,e=a.url,I(e)?void 0:(c="socket"===d?new n(b):new o(b),this.elements.push(c))},a}(),o=function(){function a(a){var b,c,d,e,f,g,h=this;if(this.progress=0,null!=window.ProgressEvent)for(c=null,a.addEventListener("progress",function(a){return h.progress=a.lengthComputable?100*a.loaded/a.total:h.progress+(100-h.progress)/2},!1),g=["load","abort","timeout","error"],d=0,e=g.length;e>d;d++)b=g[d],a.addEventListener(b,function(){return h.progress=100},!1);else f=a.onreadystatechange,a.onreadystatechange=function(){var b;return 0===(b=a.readyState)||4===b?h.progress=100:3===a.readyState&&(h.progress=50),"function"==typeof f?f.apply(null,arguments):void 0}}return a}(),n=function(){function a(a){var b,c,d,e,f=this;for(this.progress=0,e=["error","open"],c=0,d=e.length;d>c;c++)b=e[c],a.addEventListener(b,function(){return f.progress=100},!1)}return a}(),d=function(){function a(a){var b,c,d,f;for(null==a&&(a={}),this.elements=[],null==a.selectors&&(a.selectors=[]),f=a.selectors,c=0,d=f.length;d>c;c++)b=f[c],this.elements.push(new e(b))}return a}(),e=function(){function a(a){this.selector=a,this.progress=0,this.check()}return a.prototype.check=function(){var a=this;return document.querySelector(this.selector)?this.done():setTimeout(function(){return a.check()},D.elements.checkInterval)},a.prototype.done=function(){return this.progress=100},a}(),c=function(){function a(){var a,b,c=this;this.progress=null!=(b=this.states[document.readyState])?b:100,a=document.onreadystatechange,document.onreadystatechange=function(){return null!=c.states[document.readyState]&&(c.progress=c.states[document.readyState]),"function"==typeof a?a.apply(null,arguments):void 0}}return a.prototype.states={loading:0,interactive:50,complete:100},a}(),f=function(){function a(){var a,b,c,d,e,f=this;this.progress=0,a=0,e=[],d=0,c=C(),b=setInterval(function(){var g;return g=C()-c-50,c=C(),e.push(g),e.length>D.eventLag.sampleCount&&e.shift(),a=q(e),++d>=D.eventLag.minSamples&&a<D.eventLag.lagThreshold?(f.progress=100,clearInterval(b)):f.progress=100*(3/(a+3))},50)}return a}(),m=function(){function a(a){this.source=a,this.last=this.sinceLastUpdate=0,this.rate=D.initialRate,this.catchup=0,this.progress=this.lastProgress=0,null!=this.source&&(this.progress=F(this.source,"progress"))}return a.prototype.tick=function(a,b){var c;return null==b&&(b=F(this.source,"progress")),b>=100&&(this.done=!0),b===this.last?this.sinceLastUpdate+=a:(this.sinceLastUpdate&&(this.rate=(b-this.last)/this.sinceLastUpdate),this.catchup=(b-this.progress)/D.catchupTime,this.sinceLastUpdate=0,this.last=b),b>this.progress&&(this.progress+=this.catchup*a),c=1-Math.pow(this.progress/100,D.easeFactor),this.progress+=c*this.rate*a,this.progress=Math.min(this.lastProgress+D.maxProgressPerFrame,this.progress),this.progress=Math.max(0,this.progress),this.progress=Math.min(100,this.progress),this.lastProgress=this.progress,this.progress},a}(),L=null,H=null,r=null,M=null,p=null,s=null,j.running=!1,z=function(){return D.restartOnPushState?j.restart():void 0},null!=window.history.pushState&&(T=window.history.pushState,window.history.pushState=function(){return z(),T.apply(window.history,arguments)}),null!=window.history.replaceState&&(W=window.history.replaceState,window.history.replaceState=function(){return z(),W.apply(window.history,arguments)}),l={ajax:a,elements:d,document:c,eventLag:f},(B=function(){var a,c,d,e,f,g,h,i;for(j.sources=L=[],g=["ajax","elements","document","eventLag"],c=0,e=g.length;e>c;c++)a=g[c],D[a]!==!1&&L.push(new l[a](D[a]));for(i=null!=(h=D.extraSources)?h:[],d=0,f=i.length;f>d;d++)K=i[d],L.push(new K(D));return j.bar=r=new b,H=[],M=new m})(),j.stop=function(){return j.trigger("stop"),j.running=!1,r.destroy(),s=!0,null!=p&&("function"==typeof t&&t(p),p=null),B()},j.restart=function(){return j.trigger("restart"),j.stop(),j.start()},j.go=function(){var a;return j.running=!0,r.render(),a=C(),s=!1,p=G(function(b,c){var d,e,f,g,h,i,k,l,n,o,p,q,t,u,v,w;for(l=100-r.progress,e=p=0,f=!0,i=q=0,u=L.length;u>q;i=++q)for(K=L[i],o=null!=H[i]?H[i]:H[i]=[],h=null!=(w=K.elements)?w:[K],k=t=0,v=h.length;v>t;k=++t)g=h[k],n=null!=o[k]?o[k]:o[k]=new m(g),f&=n.done,n.done||(e++,p+=n.tick(b));return d=p/e,r.update(M.tick(b,d)),r.done()||f||s?(r.update(100),j.trigger("done"),setTimeout(function(){return r.finish(),j.running=!1,j.trigger("hide")},Math.max(D.ghostTime,Math.max(D.minTime-(C()-a),0)))):c()})},j.start=function(a){v(D,a),j.running=!0;try{r.render()}catch(b){i=b}return document.querySelector(".pace")?(j.trigger("start"),j.go()):setTimeout(j.start,50)},"function"==typeof define&&define.amd?define(["pace"],function(){return j}):"object"==typeof exports?module.exports=j:D.startOnPageLoad&&j.start()}).call(this);


// Internationalization
import i18next from 'i18next';

// I18n XHR Backend

import i18nextXHRBackend from 'i18next-xhr-backend';

// Language detector i18n

import LanguageDetector from 'i18next-browser-languagedetector';

// I18n Jquery

import jqueryI18next from 'jquery-i18next';










//app-menu

! function (e, n, a) {
    "use strict";
    a.app = a.app || {};
    var t = a("body"),
        i = a(e),
        s = a('div[data-menu="menu-wrapper"]').html(),
        o = a('div[data-menu="menu-wrapper"]').attr("class");
    a.app.menu = {
        expanded: null,
        collapsed: null,
        hidden: null,
        container: null,
        horizontalMenu: !1,
        is_touch_device: function () {
            var a = " -webkit- -moz- -o- -ms- ".split(" ");
            return !!("ontouchstart" in e || e.DocumentTouch && n instanceof DocumentTouch) || function (n) {
                return e.matchMedia(n).matches
            }(["(", a.join("touch-enabled),("), "heartz", ")"].join(""))
        },
        manualScroller: {
            obj: null,
            init: function () {
                a.app.menu.is_touch_device() ? a(".main-menu").addClass("menu-native-scroll") : this.obj = new PerfectScrollbar(".main-menu-content", {
                    suppressScrollX: !0,
                    wheelPropagation: !1
                })
            },
            update: function () {
                if (this.obj) {
                    if (!0 === a(".main-menu").data("scroll-to-active")) {
                        var e, i, s;
                        if (e = n.querySelector(".main-menu-content li.active"), i = n.querySelector(".main-menu-content"), t.hasClass("menu-collapsed") && a(".main-menu-content li.menu-collapsed-open").length && (e = n.querySelector(".main-menu-content li.menu-collapsed-open")), e && (s = e.getBoundingClientRect().top + i.scrollTop), s > parseInt(2 * i.clientHeight / 3)) var o = s - i.scrollTop - parseInt(i.clientHeight / 2);
                        setTimeout((function () {
                            a.app.menu.container.stop().animate({
                                scrollTop: o
                            }, 300), a(".main-menu").data("scroll-to-active", "false")
                        }), 300)
                    }
                    this.obj.update()
                }
            },
            enable: function () {
                a(".main-menu-content").hasClass("ps") || this.init()
            },
            disable: function () {
                this.obj && this.obj.destroy()
            },
            updateHeight: function () {
                "vertical-menu" != t.data("menu") && "vertical-menu-modern" != t.data("menu") && "vertical-overlay-menu" != t.data("menu") || !a(".main-menu").hasClass("menu-fixed") || (a(".main-menu-content").css("height", a(e).height() - a(".header-navbar").height() - a(".main-menu-header").outerHeight()), this.update())
            }
        },
        init: function (e) {
            if (a(".main-menu-content").length > 0) {
                this.container = a(".main-menu-content");
                var n = "";
                !0 === e && (n = "collapsed"), this.change(n)
            }
            "collapsed" === n && this.collapse()
        },
        change: function (n) {
            var i = Unison.fetch.now();
            this.reset();
            var s = t.data("menu");
            if (i) switch (i.name) {
                case "xl":
                    "vertical-overlay-menu" === s ? this.hide() : "vertical-compact-menu" === s ? this.open() : "collapsed" === n ? this.collapse(n) : this.expand();
                    break;
                case "lg":
                    "vertical-overlay-menu" === s ? this.hide() : "vertical-compact-menu" === s ? this.open() : "horizontal-menu" === s ? this.hide() : "collapsed" === n ? this.collapse(n) : this.expand();
                    break;
                case "md":
                    "vertical-overlay-menu" === s || "vertical-menu-modern" === s ? this.hide() : "vertical-compact-menu" === s ? this.open() : "horizontal-menu" === s ? this.hide() : this.collapse();
                    break;
                case "sm":
                case "xs":
                    this.hide()
            }
            "vertical-menu" !== s && "vertical-compact-menu" !== s && "vertical-content-menu" !== s && "vertical-menu-modern" !== s || this.toOverlayMenu(i.name, s), t.is(".horizontal-layout") && !t.hasClass(".horizontal-menu-demo") && (this.changeMenu(i.name), a(".menu-toggle").removeClass("is-active")), "xl" == i.name && a('body[data-open="hover"] .dropdown').off("mouseenter").on("mouseenter", (function (e) {
                a(this).hasClass("show") ? a(this).removeClass("show") : a(this).addClass("show")
            })).off("mouseleave").on("mouseleave", (function (e) {
                a(this).removeClass("show")
            })), a(".header-navbar").hasClass("navbar-brand-center") && a(".header-navbar").attr("data-nav", "brand-center"), "sm" == i.name || "xs" == i.name ? a(".header-navbar[data-nav=brand-center]").removeClass("navbar-brand-center") : a(".header-navbar[data-nav=brand-center]").addClass("navbar-brand-center"), a("ul.dropdown-menu [data-toggle=dropdown]").on("click", (function (e) {
                a(this).siblings("ul.dropdown-menu").length > 0 && e.preventDefault(), e.stopPropagation(), a(this).parent().siblings().removeClass("show"), a(this).parent().toggleClass("show")
            })), "horizontal-menu" == s && (a("li.dropdown-submenu .dropdown-item").on("click", (function () {
                var n = a(this).parent().find(".dropdown-menu");
                if (n.length) {
                    var t = a(e).height(),
                        i = n.offset().top,
                        s = n.offset().left,
                        o = n.width();
                    if (t - i - n.height() - 28 < 1) {
                        var l = t - i - 25;
                        if ("click" === a("body").data("open")) {
                            a(this).parent().find(".dropdown-menu").css({
                                "max-height": l + "px",
                                "overflow-y": "auto",
                                "overflow-x": "hidden"
                            });
                            new PerfectScrollbar("li.dropdown-submenu.show .dropdown-menu", {
                                wheelPropagation: !1
                            })
                        }
                    }
                    "ltr" === a("html").data("textdirection") && s + o - (e.innerWidth - 16) >= 0 ? a(this).parent().find(".dropdown-menu").addClass("open-left") : "rtl" === a("html").data("textdirection") && s + o - (e.innerWidth - 1e3) <= 0 && a(this).parent().find(".dropdown-menu").addClass("open-left")
                }
            })), a("li.dropdown-submenu").on("mouseenter", (function () {
                var n = a(this).find(".dropdown-menu");
                if (n.length) {
                    var t = a(e).height(),
                        i = n.offset().top,
                        s = n.offset().left,
                        o = n.width();
                    if (t - i - n.height() - 28 < 1) {
                        var l = t - i - 25;
                        if ("hover" === a("body").data("open")) {
                            a(this).find(".dropdown-menu").css({
                                "max-height": l + "px",
                                "overflow-y": "auto",
                                "overflow-x": "hidden"
                            });
                            new PerfectScrollbar("li.dropdown-submenu.show .dropdown-menu", {
                                wheelPropagation: !1
                            })
                        }
                    }
                    "ltr" === a("html").data("textdirection") && s + o - (e.innerWidth - 16) >= 0 ? a(this).parent().find(".dropdown-menu").addClass("open-left") : "rtl" === a("html").data("textdirection") && s + o - (e.innerWidth - 1e3) <= 0 && a(this).parent().find(".dropdown-menu").addClass("open-left")
                }
            }))), "horizontal-menu" == s && ("xl" == i.name ? a(".navbar-fixed").length && a(".navbar-fixed").sticky() : a(".menu-fixed").length && a(".menu-fixed").unstick())
        },
        transit: function (e, n) {
            var i = this;
            t.addClass("changing-menu"), e.call(i), t.hasClass("vertical-layout") && (t.hasClass("menu-open") || t.hasClass("menu-expanded") ? (a(".menu-toggle").addClass("is-active"), "vertical-menu" !== t.data("menu") && "vertical-content-menu" !== t.data("menu") || a(".main-menu-header") && a(".main-menu-header").show()) : (a(".menu-toggle").removeClass("is-active"), "vertical-menu" !== t.data("menu") && "vertical-content-menu" !== t.data("menu") || a(".main-menu-header") && a(".main-menu-header").hide())), setTimeout((function () {
                n.call(i), t.removeClass("changing-menu"), i.update()
            }), 500)
        },
        open: function () {
            this.transit((function () {
                t.removeClass("menu-hide menu-collapsed").addClass("menu-open"), this.hidden = !1, this.expanded = !0, t.hasClass("vertical-overlay-menu") && (a(".sidenav-overlay").removeClass("d-none").addClass("d-block"), t.css("overflow", "hidden"))
            }), (function () {
                !a(".main-menu").hasClass("menu-native-scroll") && a(".main-menu").hasClass("menu-fixed") && (this.manualScroller.enable(), a(".main-menu-content").css("height", a(e).height() - a(".header-navbar").height() - a(".main-menu-header").outerHeight())), "vertical-compact-menu" != t.data("menu") || t.hasClass("vertical-overlay-menu") || (a(".sidenav-overlay").removeClass("d-block d-none"), a("body").css("overflow", "auto"))
            }))
        },
        hide: function () {
            this.transit((function () {
                t.removeClass("menu-open menu-expanded").addClass("menu-hide"), this.hidden = !0, this.expanded = !1, t.hasClass("vertical-overlay-menu") && (a(".sidenav-overlay").removeClass("d-block").addClass("d-none"), a("body").css("overflow", "auto"))
            }), (function () {
                !a(".main-menu").hasClass("menu-native-scroll") && a(".main-menu").hasClass("menu-fixed") && this.manualScroller.enable(), "vertical-compact-menu" != t.data("menu") || t.hasClass("vertical-overlay-menu") || (a(".sidenav-overlay").removeClass("d-block d-none"), a("body").css("overflow", "auto"))
            }))
        },
        expand: function () {
            !1 === this.expanded && ("vertical-menu-modern" == t.data("menu") && a(".modern-nav-toggle").find(".toggle-icon").removeClass("ft-toggle-left").addClass("ft-toggle-right"), this.transit((function () {
                t.removeClass("menu-collapsed").addClass("menu-expanded"), this.collapsed = !1, this.expanded = !0, a(".sidenav-overlay").removeClass("d-block d-none")
            }), (function () {
                a(".main-menu").hasClass("menu-native-scroll") || "horizontal-menu" == t.data("menu") ? this.manualScroller.disable() : a(".main-menu").hasClass("menu-fixed") && this.manualScroller.enable(), "vertical-menu" != t.data("menu") && "vertical-menu-modern" != t.data("menu") || !a(".main-menu").hasClass("menu-fixed") || a(".main-menu-content").css("height", a(e).height() - a(".header-navbar").height() - a(".main-menu-header").outerHeight())
            })))
        },
        collapse: function (n) {
            !1 === this.collapsed && ("vertical-menu-modern" == t.data("menu") && a(".modern-nav-toggle").find(".toggle-icon").removeClass("ft-toggle-right").addClass("ft-toggle-left"), this.transit((function () {
                t.removeClass("menu-expanded").addClass("menu-collapsed"), this.collapsed = !0, this.expanded = !1, a(".content-overlay").removeClass("d-block d-none")
            }), (function () {
                "vertical-content-menu" == t.data("menu") && this.manualScroller.disable(), "horizontal-menu" == t.data("menu") && t.hasClass("vertical-overlay-menu") && a(".main-menu").hasClass("menu-fixed") && this.manualScroller.enable(), "vertical-menu" != t.data("menu") && "vertical-menu-modern" != t.data("menu") || !a(".main-menu").hasClass("menu-fixed") || (a(".main-menu-content").css("height", a(e).height() - a(".header-navbar").height()), a(".main-menu-content").hasClass("ps") || this.manualScroller.enable())
            })))
        },
        toOverlayMenu: function (e, n) {
            var i = t.data("menu");
            "vertical-menu-modern" == n ? "md" == e || "sm" == e || "xs" == e ? t.hasClass(i) && t.removeClass(i).addClass("vertical-overlay-menu") : t.hasClass("vertical-overlay-menu") && t.removeClass("vertical-overlay-menu").addClass(i) : "sm" == e || "xs" == e ? (t.hasClass(i) && t.removeClass(i).addClass("vertical-overlay-menu"), "vertical-content-menu" == i && a(".main-menu").addClass("menu-fixed")) : (t.hasClass("vertical-overlay-menu") && t.removeClass("vertical-overlay-menu").addClass(i), "vertical-content-menu" == i && a(".main-menu").removeClass("menu-fixed"))
        },
        changeMenu: function (e) {
            a('div[data-menu="menu-wrapper"]').html(""), a('div[data-menu="menu-wrapper"]').html(s);
            var n = a('div[data-menu="menu-wrapper"]'),
                i = (a('div[data-menu="menu-container"]'), a('ul[data-menu="menu-navigation"]')),
                l = a('li[data-menu="megamenu"]'),
                r = a("li[data-mega-col]"),
                d = a('li[data-menu="dropdown"]'),
                m = a('li[data-menu="dropdown-submenu"]');
            "xl" === e ? (t.removeClass("vertical-layout vertical-overlay-menu fixed-navbar").addClass(t.data("menu")), a("nav.header-navbar").removeClass("fixed-top"), n.removeClass().addClass(o), a("a.dropdown-item.nav-has-children").on("click", (function () {
                event.preventDefault(), event.stopPropagation()
            })), a("a.dropdown-item.nav-has-parent").on("click", (function () {
                event.preventDefault(), event.stopPropagation()
            }))) : (t.removeClass(t.data("menu")).addClass("vertical-layout vertical-overlay-menu fixed-navbar"), a("nav.header-navbar").addClass("fixed-top"), n.removeClass().addClass("main-menu menu-light menu-fixed menu-shadow"), i.removeClass().addClass("navigation navigation-main"), l.removeClass("dropdown mega-dropdown").addClass("has-sub"), l.children("ul").removeClass(), r.each((function (e, n) {
                a(n).find(".mega-menu-sub").find("li").has("ul").addClass("has-sub");
                var t = a(n).children().first(),
                    i = "";
                t.is("h6") && (i = t.html(), t.remove(), a(n).prepend('<a href="#">' + i + "</a>").addClass("has-sub mega-menu-title"))
            })), l.find("a").removeClass("dropdown-toggle"), l.find("a").removeClass("dropdown-item"), d.removeClass("dropdown").addClass("has-sub"), d.find("a").removeClass("dropdown-toggle nav-link"), d.children("ul").find("a").removeClass("dropdown-item"), d.find("ul").removeClass("dropdown-menu"), m.removeClass().addClass("has-sub"), a.app.nav.init(), a("ul.dropdown-menu [data-toggle=dropdown]").on("click", (function (e) {
                e.preventDefault(), e.stopPropagation(), a(this).parent().siblings().removeClass("open"), a(this).parent().toggleClass("open")
            })))
        },
        toggle: function () {
            var e = Unison.fetch.now(),
                n = (this.collapsed, this.expanded),
                a = this.hidden,
                i = t.data("menu");
            switch (e.name) {
                case "xl":
                    !0 === n ? "vertical-compact-menu" == i || "vertical-overlay-menu" == i ? this.hide() : this.collapse() : "vertical-compact-menu" == i || "vertical-overlay-menu" == i ? this.open() : this.expand();
                    break;
                case "lg":
                    !0 === n ? "vertical-compact-menu" == i || "vertical-overlay-menu" == i || "horizontal-menu" == i ? this.hide() : this.collapse() : "vertical-compact-menu" == i || "vertical-overlay-menu" == i || "horizontal-menu" == i ? this.open() : this.expand();
                    break;
                case "md":
                    !0 === n ? "vertical-compact-menu" == i || "vertical-overlay-menu" == i || "vertical-menu-modern" == i || "horizontal-menu" == i ? this.hide() : this.collapse() : "vertical-compact-menu" == i || "vertical-overlay-menu" == i || "vertical-menu-modern" == i || "horizontal-menu" == i ? this.open() : this.expand();
                    break;
                case "sm":
                case "xs":
                    !0 === a ? this.open() : this.hide()
            }
        },
        update: function () {
            this.manualScroller.update()
        },
        reset: function () {
            this.expanded = !1, this.collapsed = !1, this.hidden = !1, t.removeClass("menu-hide menu-open menu-collapsed menu-expanded")
        }
    }, a.app.nav = {
        container: a(".navigation-main"),
        initialized: !1,
        navItem: a(".navigation-main").find("li").not(".navigation-category"),
        config: {
            speed: 300
        },
        init: function (e) {
            this.initialized = !0, a.extend(this.config, e), this.bind_events()
        },
        detectIE: function (n) {
            var a = e.navigator.userAgent,
                t = a.indexOf("MSIE ");
            if (t > 0) return parseInt(a.substring(t + 5, a.indexOf(".", t)), 10);
            if (a.indexOf("Trident/") > 0) {
                var i = a.indexOf("rv:");
                return parseInt(a.substring(i + 3, a.indexOf(".", i)), 10)
            }
            var s = a.indexOf("Edge/");
            return s > 0 && parseInt(a.substring(s + 5, a.indexOf(".", s)), 10)
        },
        bind_events: function () {
            var e = this;
            a(".navigation-main").on("mouseenter.app.menu", "li", (function () {
                var n = a(this);
                if (a(".hover", ".navigation-main").removeClass("hover"), t.hasClass("menu-collapsed") && "vertical-menu-modern" != t.data("menu") || "vertical-compact-menu" == t.data("menu") && !t.hasClass("vertical-overlay-menu")) {
                    a(".main-menu-content").children("span.menu-title").remove(), a(".main-menu-content").children("a.menu-title").remove(), a(".main-menu-content").children("ul.menu-content").remove();
                    var i, s, o, l = n.find("span.menu-title").clone();
                    if (n.hasClass("has-sub") || (i = n.find("span.menu-title").text(), s = n.children("a").attr("href"), "" !== i && ((l = a("<a>")).attr("href", s), l.attr("title", i), l.text(i), l.addClass("menu-title"))), o = n.css("border-top") ? n.position().top + parseInt(n.css("border-top"), 10) : n.position().top, t.hasClass("material-vertical-layout") && (o = a(".user-profile").height() + n.position().top), !1 !== e.detectIE() && t.hasClass("material-vertical-layout") && (o = a(".user-profile").height() + n.position().top + a(".header-navbar").height()), "vertical-compact-menu" !== t.data("menu") && l.appendTo(".main-menu-content").css({
                            position: "fixed",
                            top: o
                        }), n.hasClass("has-sub") && n.hasClass("nav-item")) {
                        n.children("ul:first");
                        "vertical-compact-menu" !== t.data("menu") ? e.adjustSubmenu(n) : e.fullSubmenu(n)
                    }
                }
                n.addClass("hover")
            })).on("mouseleave.app.menu", "li", (function () {})).on("active.app.menu", "li", (function (e) {
                a(this).addClass("active"), e.stopPropagation()
            })).on("deactive.app.menu", "li.active", (function (e) {
                a(this).removeClass("active"), e.stopPropagation()
            })).on("open.app.menu", "li", (function (n) {
                var t = a(this);
                if (t.addClass("open"), e.expand(t), a(".main-menu").hasClass("menu-collapsible")) return !1;
                t.siblings(".open").find("li.open").trigger("close.app.menu"), t.siblings(".open").trigger("close.app.menu"), n.stopPropagation()
            })).on("close.app.menu", "li.open", (function (n) {
                var t = a(this);
                t.removeClass("open"), e.collapse(t), n.stopPropagation()
            })).on("click.app.menu", "li", (function (e) {
                var n = a(this);
                n.is(".disabled") ? e.preventDefault() : t.hasClass("menu-collapsed") && "vertical-menu-modern" != t.data("menu") || "vertical-compact-menu" == t.data("menu") && n.is(".has-sub") && !t.hasClass("vertical-overlay-menu") ? e.preventDefault() : n.has("ul") ? n.is(".open") ? n.trigger("close.app.menu") : n.trigger("open.app.menu") : n.is(".active") || (n.siblings(".active").trigger("deactive.app.menu"), n.trigger("active.app.menu")), e.stopPropagation()
            })), a(".navbar-header, .main-menu").on("mouseenter", (function () {
                if ("vertical-menu-modern" == t.data("menu") && (a(".main-menu, .navbar-header").addClass("expanded"), t.hasClass("menu-collapsed"))) {
                    var e = a(".main-menu li.menu-collapsed-open");
                    e.children("ul").hide().slideDown(200, (function () {
                        a(this).css("display", "")
                    })), e.addClass("open").removeClass("menu-collapsed-open")
                }
            })).on("mouseleave", (function () {
                t.hasClass("menu-collapsed") && "vertical-menu-modern" == t.data("menu") && setTimeout((function () {
                    if (0 === a(".main-menu:hover").length && 0 === a(".navbar-header:hover").length && (a(".main-menu, .navbar-header").removeClass("expanded"), a(".user-profile .user-info .dropdown").hasClass("show") && (a(".user-profile .user-info .dropdown").removeClass("show"), a(".user-profile .user-info .dropdown .dropdown-menu").removeClass("show")), t.hasClass("menu-collapsed"))) {
                        var e = a(".main-menu li.open"),
                            n = e.children("ul");
                        e.addClass("menu-collapsed-open"), n.show().slideUp(200, (function () {
                            a(this).css("display", "")
                        })), e.removeClass("open")
                    }
                }), 1)
            })), a(".main-menu-content").on("mouseleave", (function () {
                (t.hasClass("menu-collapsed") || "vertical-compact-menu" == t.data("menu")) && (a(".main-menu-content").children("span.menu-title").remove(), a(".main-menu-content").children("a.menu-title").remove(), a(".main-menu-content").children("ul.menu-content").remove()), a(".hover", ".navigation-main").removeClass("hover")
            })), a(".navigation-main li.has-sub > a").on("click", (function (e) {
                e.preventDefault()
            })), a("ul.menu-content").on("click", "li", (function (n) {
                var t = a(this);
                if (t.is(".disabled")) n.preventDefault();
                else if (t.has("ul"))
                    if (t.is(".open")) t.removeClass("open"), e.collapse(t);
                    else {
                        if (t.addClass("open"), e.expand(t), a(".main-menu").hasClass("menu-collapsible")) return !1;
                        t.siblings(".open").find("li.open").trigger("close.app.menu"), t.siblings(".open").trigger("close.app.menu"), n.stopPropagation()
                    }
                else t.is(".active") || (t.siblings(".active").trigger("deactive.app.menu"), t.trigger("active.app.menu"));
                n.stopPropagation()
            }))
        },
        adjustSubmenu: function (e) {
            var n, s, o, l, r, d = e.children("ul:first"),
                m = d.clone(!0);
            if (a(".main-menu-header").height(), n = e.position().top, o = i.height() - a(".header-navbar").height(), r = 0, d.height(), parseInt(e.css("border-top"), 10) > 0 && (r = parseInt(e.css("border-top"), 10)), l = o - n - e.height() - 30, a(".main-menu").hasClass("menu-dark") ? "light" : "dark", "vertical-compact-menu" === t.data("menu") ? (s = n + r, l = o - n - 30) : "vertical-content-menu" === t.data("menu") ? (s = n + e.height() + r - 5, l = o - a(".content-header").height() - e.height() - n - 60, t.hasClass("material-vertical-layout") && (s = n + e.height() + a(".user-profile").height() + r)) : s = t.hasClass("material-vertical-layout") ? n + e.height() + a(".user-profile").height() + r : n + e.height() + r, !1 !== this.detectIE() && t.hasClass("material-vertical-layout") && (s = n + e.height() + a(".user-profile").height() + r + a(".header-navbar").height()), "vertical-content-menu" == t.data("menu")) m.addClass("menu-popout").appendTo(".main-menu-content").css({
                top: s,
                position: "fixed"
            });
            else {
                m.addClass("menu-popout").appendTo(".main-menu-content").css({
                    top: s,
                    position: "fixed",
                    "max-height": l
                });
                new PerfectScrollbar(".main-menu-content > ul.menu-content")
            }
        },
        fullSubmenu: function (e) {
            e.children("ul:first").clone(!0).addClass("menu-popout").appendTo(".main-menu-content").css({
                top: 0,
                position: "fixed",
                height: "100%"
            });
            new PerfectScrollbar(".main-menu-content > ul.menu-content")
        },
        collapse: function (e, n) {
            e.children("ul").show().slideUp(a.app.nav.config.speed, (function () {
                a(this).css("display", ""), a(this).find("> li").removeClass("is-shown"), n && n(), a.app.nav.container.trigger("collapsed.app.menu")
            }))
        },
        expand: function (e, n) {
            var t = e.children("ul"),
                i = t.children("li").addClass("is-hidden");
            t.hide().slideDown(a.app.nav.config.speed, (function () {
                a(this).css("display", ""), n && n(), a.app.nav.container.trigger("expanded.app.menu")
            })), setTimeout((function () {
                i.addClass("is-shown"), i.removeClass("is-hidden")
            }), 0)
        },
        refresh: function () {
            a.app.nav.container.find(".open").removeClass("open")
        }
    }
}(window, document, jQuery);


















//app-min



! function (e, n, a) {
    "use strict";
    var t = a("html"),
        s = a("body");
    if (a(e).on("load", (function () {
            var i = !1;
            s.hasClass("menu-collapsed") && (i = !0), a("html").data("textdirection"), setTimeout((function () {
                t.removeClass("loading").addClass("loaded")
            }), 1200), a.app.menu.init(i);
            !1 === a.app.nav.initialized && a.app.nav.init({
                speed: 300
            }), Unison.on("change", (function (e) {
                a.app.menu.change()
            })), a('[data-toggle="tooltip"]').tooltip({
                container: "body"
            }), a(".navbar-hide-on-scroll").length > 0 && (a(".navbar-hide-on-scroll.fixed-top").headroom({
                offset: 205,
                tolerance: 5,
                classes: {
                    initial: "headroom",
                    pinned: "headroom--pinned-top",
                    unpinned: "headroom--unpinned-top"
                }
            }), a(".navbar-hide-on-scroll.fixed-bottom").headroom({
                offset: 205,
                tolerance: 5,
                classes: {
                    initial: "headroom",
                    pinned: "headroom--pinned-bottom",
                    unpinned: "headroom--unpinned-bottom"
                }
            })), setTimeout((function () {
                var e;
                a("body").hasClass("vertical-content-menu") && (e = a(".main-menu").height(), a(".content-body").height() < e && a(".content-body").css("height", e))
            }), 500), a('a[data-action="collapse"]').on("click", (function (e) {
                e.preventDefault(), a(this).closest(".card").children(".card-content").collapse("toggle"), a(this).closest(".card").find('[data-action="collapse"] i').toggleClass("ft-plus ft-minus")
            })), a('a[data-action="expand"]').on("click", (function (e) {
                e.preventDefault(), a(this).closest(".card").find('[data-action="expand"] i').toggleClass("ft-maximize ft-minimize"), a(this).closest(".card").toggleClass("card-fullscreen")
            })), a(".scrollable-container").length > 0 && a(".scrollable-container").each((function () {
                new PerfectScrollbar(a(this)[0], {
                    wheelPropagation: !1
                })
            })), a('a[data-action="reload"]').on("click", (function () {
                a(this).closest(".card").block({
                    message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
                    timeout: 2e3,
                    overlayCSS: {
                        backgroundColor: "#FFF",
                        cursor: "wait"
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: "none"
                    }
                })
            })), a('a[data-action="close"]').on("click", (function () {
                a(this).closest(".card").removeClass().slideUp("fast")
            })), setTimeout((function () {
                a(".row.match-height").each((function () {
                    a(this).find(".card").not(".card .card").matchHeight()
                }))
            }), 500), a('.card .heading-elements a[data-action="collapse"]').on("click", (function () {
                var e, n = a(this).closest(".card");
                parseInt(n[0].style.height, 10) > 0 ? (e = n.css("height"), n.css("height", "").attr("data-height", e)) : n.data("height") && (e = n.data("height"), n.css("height", e).attr("data-height", ""))
            })), a(".main-menu-content").find("li.active").parents("li").addClass("menu-collapsed-open");
            var o = s.data("menu");
            "vertical-compact-menu" != o && "horizontal-menu" != o && !1 === i && a(".main-menu-content").find("li.active").parents("li").addClass("open"), "vertical-compact-menu" != o && "horizontal-menu" != o || (a(".main-menu-content").find("li.active").parents("li:not(.nav-item)").addClass("open"), a(".main-menu-content").find("li.active").parents("li").addClass("active")), a(".heading-elements-toggle").on("click", (function () {
                a(this).parent().children(".heading-elements").toggleClass("visible")
            }));
            var l = a(".chartjs"),
                r = l.children("canvas").attr("height");
            l.css("height", r);
            var c = a(".search-input input").data("search");
            a(".nav-link-search").on("click", (function () {
                a(this);
                a(this).parent(".nav-search").find(".search-input").addClass("open"), setTimeout((function () {
                    a(".search-input.open .input").focus()
                }), 50), a(".search-input .search-list li").remove(), a(".search-input .search-list").addClass("show")
            })), a(".search-input-close i").on("click", (function () {
                a(this);
                var e = a(this).closest(".search-input");
                e.hasClass("open") && (e.removeClass("open"), a(".search-input input").val(""), a(".search-input input").blur(), a(".search-input .search-list").removeClass("show"), a(".app-content").hasClass("show-overlay") && a(".app-content").removeClass("show-overlay"))
            })), a(".app-content").on("click", (function () {
                var e = a(".search-input-close"),
                    n = a(e).parent(".search-input"),
                    t = a(".search-list");
                n.hasClass("open") && n.removeClass("open"), t.hasClass("show") && t.removeClass("show"), a(".app-content").hasClass("show-overlay") && a(".app-content").removeClass("show-overlay")
            })), a(".search-input .input").on("keyup", (function (e) {
                if (38 !== e.keyCode && 40 !== e.keyCode && 13 !== e.keyCode) {
                    27 == e.keyCode && (a(".search-input input").val(""), a(".search-input input").blur(), a(".search-input").removeClass("open"), a(".search-list").hasClass("show") && (a(this).removeClass("show"), a(".search-input").removeClass("show")));
                    var n = a(this).val().toLowerCase();
                    if (a("ul.search-list li").remove(), "" != n) {
                        a(".app-content").addClass("show-overlay");
                        var t = "",
                            s = "",
                            i = "",
                            o = 0;
                        a.getJSON("../../../theme/app-assets/data/" + c + ".json", (function (e) {
                            for (var l = 0; l < e.listItems.length; l++)(0 == e.listItems[l].name.toLowerCase().indexOf(n) && o < 10 || 0 != e.listItems[l].name.toLowerCase().indexOf(n) && e.listItems[l].name.toLowerCase().indexOf(n) > -1 && o < 10) && (t += '<li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer ' + (0 === o ? "current_item" : "") + '"><a class="d-flex align-items-center justify-content-between w-100" href=' + e.listItems[l].url + '><div class="d-flex justify-content-start"><span class="mr-75 ' + e.listItems[l].icon + '"></span><span>' + e.listItems[l].name + "</span></div>", o++);
                            "" == t && "" == s && (s = '<li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100"><div class="d-flex justify-content-start"><span class="mr-75"></span><span>No results found.</span></div></a></li>'), i = t.concat(s), a("ul.search-list").html(i)
                        }))
                    } else a(".app-content").hasClass("show-overlay") && a(".app-content").removeClass("show-overlay")
                }
            })), a(e).on("keydown", (function (n) {
                var t, s, i = a(".search-list li.current_item");
                if (40 === n.keyCode ? (t = i.next(), i.removeClass("current_item"), i = t.addClass("current_item")) : 38 === n.keyCode && (s = i.prev(), i.removeClass("current_item"), i = s.addClass("current_item")), 13 === n.keyCode && a(".search-list li.current_item").length > 0) {
                    var o = a(".search-list li.current_item a");
                    e.location = o.attr("href"), a(o).trigger("click")
                }
            })), a(n).on("mouseenter", ".search-list li", (function (e) {
                a(this).siblings().removeClass("current_item"), a(this).addClass("current_item")
            })), a(n).on("click", ".search-list li", (function (e) {
                e.stopPropagation()
            }))
        })), a(n).on("click", ".sidenav-overlay", (function (e) {
            return a.app.menu.hide(), !1
        })), "undefined" != typeof Hammer) {
        var i;
        "rtl" == a("html").data("textdirection") && (i = !0);
        var o = n.querySelector(".drag-target"),
            l = "panright",
            r = "panleft";
        if (!0 === i && (l = "panleft", r = "panright"), a(o).length > 0) new Hammer(o).on(l, (function (e) {
            if (s.hasClass("vertical-overlay-menu")) return a.app.menu.open(), !1
        }));
        setTimeout((function () {
            var e, t = n.querySelector(".main-menu");
            a(t).length > 0 && ((e = new Hammer(t)).get("pan").set({
                direction: Hammer.DIRECTION_ALL,
                threshold: 100
            }), e.on(r, (function (e) {
                if (s.hasClass("vertical-overlay-menu")) return a.app.menu.hide(), !1
            })))
        }), 300);
        var c = n.querySelector(".sidenav-overlay");
        if (a(c).length > 0) new Hammer(c).on(r, (function (e) {
            if (s.hasClass("vertical-overlay-menu")) return a.app.menu.hide(), !1
        }))
    }
    a(n).on("click", ".menu-toggle, .modern-nav-toggle", (function (n) {
        return n.preventDefault(), a(".user-profile .user-info .dropdown").hasClass("show") && (a(".user-profile .user-info .dropdown").removeClass("show"), a(".user-profile .user-info .dropdown .dropdown-menu").removeClass("show")), a.app.menu.toggle(), setTimeout((function () {
            a(e).trigger("resize")
        }), 200), a("#collapsed-sidebar").length > 0 && setTimeout((function () {
            s.hasClass("menu-expanded") || s.hasClass("menu-open") ? a("#collapsed-sidebar").prop("checked", !1) : a("#collapsed-sidebar").prop("checked", !0)
        }), 1e3), a(".vertical-overlay-menu .navbar-with-menu .navbar-container .navbar-collapse").hasClass("show") && a(".vertical-overlay-menu .navbar-with-menu .navbar-container .navbar-collapse").removeClass("show"), !1
    })), a(n).on("click", ".open-navbar-container", (function (e) {
        Unison.fetch.now()
    })), a(".navigation").find("li").has("ul").addClass("has-sub"), a(".carousel").carousel({
        interval: 2e3
    }), a(".nav-link-expand").on("click", (function (e) {
        "undefined" != typeof screenfull && screenfull.isEnabled && screenfull.toggle()
    })), "undefined" != typeof screenfull && screenfull.isEnabled && a(n).on(screenfull.raw.fullscreenchange, (function () {
        screenfull.isFullscreen ? a(".nav-link-expand").find("i").toggleClass("ft-minimize ft-maximize") : a(".nav-link-expand").find("i").toggleClass("ft-maximize ft-minimize")
    })), a(n).on("click", ".mega-dropdown-menu", (function (e) {
        e.stopPropagation()
    })), a(n).ready((function () {
        a(".step-icon").each((function () {
            var e = a(this);
            e.siblings("span.step").length > 0 && (e.siblings("span.step").empty(), a(this).appendTo(a(this).siblings("span.step")))
        }))
    })), a(e).resize((function () {
        a.app.menu.manualScroller.updateHeight(), a(e).width() > 768 && (a(".search-input input").val(""), a(".search-input input").blur(), a(".search-input").removeClass("open"), a(".header-navbar").find(".search-list.show") && a(".header-navbar").find(".search-list.show").removeClass("show"), a(".app-content").removeClass("show-overlay"))
    })), a("#sidebar-page-navigation").on("click", "a.nav-link", (function (e) {
        e.preventDefault(), e.stopPropagation();
        var n = a(this),
            t = n.attr("href"),
            s = a(t).offset().top - 80;
        a("html, body").animate({
            scrollTop: s
        }, 0), setTimeout((function () {
            n.parent(".nav-item").siblings(".nav-item").children(".nav-link").removeClass("active"), n.addClass("active")
        }), 100)
    })), i18next.use(e.i18nextXHRBackend).init({
        debug: true,
        fallbackLng: "en",
        backend: {
            loadPath: "../../../app-assets/data/locales/{{lng}}.json"
        },
        returnObjects: !0
    }, (function (e, n) {
        jqueryI18next.init(i18next, a)
    })), a(".dropdown-language .dropdown-item").on("click", (function () {
        var e = a(this);
        e.siblings(".selected").removeClass("selected"), e.addClass("selected");
        var n = e.text(),
            t = e.find(".flag-icon").attr("class");
        a("#dropdown-flag .selected-language").text(n), a("#dropdown-flag .flag-icon").removeClass().addClass(t);
        var s = e.data("language");
        i18next.changeLanguage(s, (function (e, n) {
            a(".main-menu , .navbar-horizontal").localize()
        }))
    }))
}(window, document, jQuery);
