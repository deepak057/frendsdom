!function(t,e){"use strict";"function"==typeof define&&define.amd?define([],function(){return e.apply(t)}):"object"==typeof exports?module.exports=e.call(t):t.Waves=e.call(t)}("object"==typeof global?global:this,function(){"use strict";function t(t){return null!==t&&t===t.window}function e(e){return t(e)?e:9===e.nodeType&&e.defaultView}function n(t){var e=typeof t;return"function"===e||"object"===e&&!!t}function o(t){return n(t)&&t.nodeType>0}function a(t){var e=f.call(t);return"[object String]"===e?d(t):n(t)&&/^\[object (HTMLCollection|NodeList|Object)\]$/.test(e)&&t.hasOwnProperty("length")?t:o(t)?[t]:[]}function i(t){var n,o,a={top:0,left:0},i=t&&t.ownerDocument;return n=i.documentElement,"undefined"!=typeof t.getBoundingClientRect&&(a=t.getBoundingClientRect()),o=e(i),{top:a.top+o.pageYOffset-n.clientTop,left:a.left+o.pageXOffset-n.clientLeft}}function r(t){var e="";for(var n in t)t.hasOwnProperty(n)&&(e+=n+":"+t[n]+";");return e}function s(t,e,n){if(n){n.classList.remove("waves-rippling");var o=n.getAttribute("data-x"),a=n.getAttribute("data-y"),i=n.getAttribute("data-scale"),s=n.getAttribute("data-translate"),u=Date.now()-Number(n.getAttribute("data-hold")),l=350-u;0>l&&(l=0),"mousemove"===t.type&&(l=150);var c="mousemove"===t.type?2500:m.duration;setTimeout(function(){var t={top:a+"px",left:o+"px",opacity:"0","-webkit-transition-duration":c+"ms","-moz-transition-duration":c+"ms","-o-transition-duration":c+"ms","transition-duration":c+"ms","-webkit-transform":i+" "+s,"-moz-transform":i+" "+s,"-ms-transform":i+" "+s,"-o-transform":i+" "+s,transform:i+" "+s};n.setAttribute("style",r(t)),setTimeout(function(){try{e.removeChild(n)}catch(t){return!1}},c)},l)}}function u(t){if(v.allowEvent(t)===!1)return null;for(var e=null,n=t.target||t.srcElement;null!==n.parentElement;){if(n.classList.contains("waves-effect")&&!(n instanceof SVGElement)){e=n;break}n=n.parentElement}return e}function l(t){v.registerEvent(t);var e=u(t);if(null!==e)if("touchstart"===t.type&&m.delay){var n=!1,o=setTimeout(function(){o=null,m.show(t,e)},m.delay),a=function(a){o&&(clearTimeout(o),o=null,m.show(t,e)),n||(n=!0,m.hide(a,e))},i=function(t){o&&(clearTimeout(o),o=null),a(t)};e.addEventListener("touchmove",i,!1),e.addEventListener("touchend",a,!1),e.addEventListener("touchcancel",a,!1)}else m.show(t,e),p&&(e.addEventListener("touchend",m.hide,!1),e.addEventListener("touchcancel",m.hide,!1)),e.addEventListener("mouseup",m.hide,!1),e.addEventListener("mouseleave",m.hide,!1)}var c=c||{},d=document.querySelectorAll.bind(document),f=Object.prototype.toString,p="ontouchstart"in window,m={duration:750,delay:200,show:function(t,e,n){if(2===t.button)return!1;e=e||this;var o=document.createElement("div");o.className="waves-ripple waves-rippling",e.appendChild(o);var a=i(e),s=t.pageY-a.top,u=t.pageX-a.left,l="scale("+e.clientWidth/100*3+")",c="translate(0,0)";n&&(c="translate("+n.x+"px, "+n.y+"px)"),"touches"in t&&t.touches.length&&(s=t.touches[0].pageY-a.top,u=t.touches[0].pageX-a.left),o.setAttribute("data-hold",Date.now()),o.setAttribute("data-x",u),o.setAttribute("data-y",s),o.setAttribute("data-scale",l),o.setAttribute("data-translate",c);var d={top:s+"px",left:u+"px"};o.classList.add("waves-notransition"),o.setAttribute("style",r(d)),o.classList.remove("waves-notransition"),d["-webkit-transform"]=l+" "+c,d["-moz-transform"]=l+" "+c,d["-ms-transform"]=l+" "+c,d["-o-transform"]=l+" "+c,d.transform=l+" "+c,d.opacity="1";var f="mousemove"===t.type?2500:m.duration;d["-webkit-transition-duration"]=f+"ms",d["-moz-transition-duration"]=f+"ms",d["-o-transition-duration"]=f+"ms",d["transition-duration"]=f+"ms",o.setAttribute("style",r(d))},hide:function(t,e){e=e||this;for(var n=e.getElementsByClassName("waves-rippling"),o=0,a=n.length;a>o;o++)s(t,e,n[o])},wrapInput:function(t){for(var e=0,n=t.length;n>e;e++){var o=t[e];if("input"===o.tagName.toLowerCase()){var a=o.parentNode;if("i"===a.tagName.toLowerCase()&&a.classList.contains("waves-effect"))continue;var i=document.createElement("i");i.className=o.className+" waves-input-wrapper",o.className="waves-button-input",a.replaceChild(i,o),i.appendChild(o);var r=window.getComputedStyle(o,null),s=r.color,u=r.backgroundColor;i.setAttribute("style","color:"+s+";background:"+u),o.setAttribute("style","background-color:rgba(0,0,0,0);")}}}},v={touches:0,allowEvent:function(t){var e=!0;return/^(mousedown|mousemove)$/.test(t.type)&&v.touches&&(e=!1),e},registerEvent:function(t){var e=t.type;"touchstart"===e?v.touches+=1:/^(touchend|touchcancel)$/.test(e)&&setTimeout(function(){v.touches&&(v.touches-=1)},500)}};return c.init=function(t){var e=document.body;t=t||{},"duration"in t&&(m.duration=t.duration),"delay"in t&&(m.delay=t.delay),m.wrapInput(d(".waves-effect")),p&&(e.addEventListener("touchstart",l,!1),e.addEventListener("touchcancel",v.registerEvent,!1),e.addEventListener("touchend",v.registerEvent,!1)),e.addEventListener("mousedown",l,!1)},c.attach=function(t,e){t=a(t),"[object Array]"===f.call(e)&&(e=e.join(" ")),e=e?" "+e:"";for(var n,o=0,i=t.length;i>o;o++)n=t[o],"input"===n.tagName.toLowerCase()&&(m.wrapInput([n]),n=n.parentElement),n.className+=" waves-effect"+e},c.ripple=function(t,e){t=a(t);var n=t.length;if(e=e||{},e.wait=e.wait||0,e.position=e.position||null,n)for(var o,r,s,u={},l=0,c={type:"mousedown",button:1},d=function(t,e){return function(){m.hide(t,e)}};n>l;l++)if(o=t[l],r=e.position||{x:o.clientWidth/2,y:o.clientHeight/2},s=i(o),u.x=s.left+r.x,u.y=s.top+r.y,c.pageX=u.x,c.pageY=u.y,m.show(c,o),e.wait>=0&&null!==e.wait){var f={type:"mouseup",button:1};setTimeout(d(f,o),e.wait)}},c.calm=function(t){t=a(t);for(var e={type:"mouseup",button:1},n=0,o=t.length;o>n;n++)m.hide(e,t[n])},c.displayEffect=function(t){console.error("Waves.displayEffect() has been deprecated and will be removed in future version. Please use Waves.init() to initialize Waves effect"),c.init(t)},c});