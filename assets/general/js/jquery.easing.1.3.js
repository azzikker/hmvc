/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */
 
 
 
 
 
 
 /*LAVALAMP */
 
 
 
 
 
 /**
 * jquery.LavaLamp v1.3.5 - light up your menus with fluid, jQuery powered animations.
 *
 * Requires jQuery v1.2.3 or better from http://jquery.com
 * Tested on jQuery 1.4.4, 1.3.2 and 1.2.6
 *
 * http://nixbox.com/projects/jquery-lavalamp/
 *
 * Copyright (c) 2008, 2009, 2010 Jolyon Terwilliger, jolyon@nixbox.com
 * Source code Copyright (c) 2008, 2009, 2010
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * credits to Guillermo Rauch and Ganeshji Marwaha (gmarwaha.com) for previous editions
 *
 * Version: 1.0 - adapted for jQuery 1.2.x series
 * Version: 1.1 - added linum parameter
 * Version: 1.2 - modified to support vertical resizing of elements
 * Version: 1.3 - enhanced automatic <li> item hi-lighting - will attempt to
 *                    lock onto li > a element with href closest to selected
 *                    window.location
 *                 - click always returns 'true' by default, for standard link follow through.
 *
 * Version: 1.3.1 - verified for use with jQuery 1.3 - should still work with 1.2.x series
 *                - changed linum parameter to startItem for clarity
 *                - improved slide-in accuracy for .back elements with borders
 *                - changed .current class to .selectedLava for clarity and improved
 *                    support
 *                - appended 'Lava' to all internal class names to avoid conflicts
 *                - fixed bug applying selectedLava class to elements with matching
 *                    location.hash
 *                - now supports jquery.compat plugin for cross-library support
 *                - performance improvements
 *                - added new options:
 *                autoReturn: true - if set to false, hover will not return to last selected
 *                                    item upon list mouseout.
 *                returnDelay: 0 - if set, will delay auto-return feature specified # of
 *                                    milliseconds.
 *                setOnClick: true - if set to false, hover will return to default element
 *                                    regardless of click event.
 *                homeLeft: 0, homeTop: 0 - if either set to non zero value, absolute
 *                                    positioned li element with class .homeLava is 
 *                                    prepended to list for homing feature.
 *                homeWidth: 0, homeHeight: 0 - if set, are used for creation of li.homeLava
 *                                    element.
 *                returnHome: false - if set along with homeLeft or homeTop, lavalamp hover
 *                                    will always return to li.home after click.
 *
 * Version: 1.3.2 - fixed: stray $ references inside the plugin to work with
 *                    jQuery.noConflict() properly - thanks Colin.
 *
 * Version: 1.3.3 - fixed: added closure with null passed argument for move() command in
 *                     returnDelay to fix errors some were seeing - thanks to Michel and 
 *                    Richard for noticing this.
 *
 *                    fixed: changed mouseover/out events to mouseenter/leave to fix jerky
 *                    animation problem when using excessive margins instead of padding.  
 *                    Thanks to Thomas for the solution and Chris for demonstrating the problem.
 *                    * requires jQuery 1.3 or better
 *
 *                    enhanced: added 'noLava' class detection to prevent LavaLamp effect
 *                    application to LI elements with this class. This feature allows you to
 *                    create submenus - for details, see examples at
 *                    http://nixboxdesigns.com/demos/jquery-lavalamp-demos.html
 *
 *                    enhanced: modified to better automatically find default location for 
 *                    relative links. Thanks to Harold for testing and finding this bug.
 *
 * Version: 1.3.4 - major overhaul on practically everything:
 *                    enhanced: added autoResize option; see examples below.
 *                    enhanced: better automatic default item selection and URI resolution,
 *                    better support for returnHome and returnDelay, refined internal variable
 *                    usage and test to be as lean as possible
 *                    fixed: backLava hover element now exactly covers the destination LI dimensions.
 *                    fixed: changed use of mouseleave/mouseenter to bind events so will work with
 *                            jQuery 1.2.2 onward.
 *                    fixed: proper closure on instance - should finally play nice with other libraries
 *                    fixed: proper quotes around all object element labels.
 *                    enhanced: behaves more like a plugin should and now automatically adds proper
 *                             position and display CSS tags to the backLava element and parent container
 *                            if absent.
 *
 * Version: 1.3.5 - new options:
 *                         target: 'li' - plain element to target to receive hover events.
 *                        container: '' - plain element to create for the hover .backLava and .homeLava
 *                            elements. If left blank (default) same value as target option is used.
 *                        includeMargins: false - set to true to expand the hover element dimensions to 
 *                            include the margins of the target element.
 *                    changed: the backLava hover element now has all margins and padding manually set to 
 *                            zero to allow proper resizing of hover when used with custom target, container  
 *                             and includeMargins options. While this workaround has no effect with the site
 *                            demos, it potentially may affect your current implementation. If you do 
 *                            experience problems try re-adjusting the CSS padding and margins for 
 *                            your target elements.
 *
 *
 * Examples and usage:
 *
 * The HTML markup used to build the menu can be as simple as...
 *
 *       <ul class="lavaLamp">
 *           <li><a href="#">Phone Home</a></li>
 *           <li><a href="#">Make Contact</a></li>
 *           <li><a href="#">Board Ship</a></li>
 *           <li><a href="#">Fly to Venus</a></li>
 *       </ul>
 *
 * Additional Styles must be added to make the LavaLamp perform properly, to wit:
 *
 * <style>
 * ul.lavaLamp {
 *   padding:5px;  // use some minimal padding to account for sloppy mouse movements
 * }
 * ul.lavaLamp li.backLava {
 *   z-index:3;   // must be less than z-index of A tags within the LI elements
 * }
 * ul.lavaLamp li a {
 *  display:block;  // helps with positioning the link within the LI element
 *  z-index:10;     // or must be higher than li.backLava z-index
 * }
 * </style>
 *
 * Once you have included the basic styles above, you will need to include 
 * the jQuery library, easing plugin (optional) and the this LavaLamp plugin.
 *
 * jQuery Easing Library 1.3 available here:  http://plugins.jquery.com/project/Easing
 * 
 * Example LavaLamp initializing statement:
 * $(function() { $("ul.lavaLamp").lavaLamp({ fx: "easeOutBack", speed: 700}) });
 * finds all UL elements in the document with the class of 'lavaLamp' and attaches the 
 * LavaLamp plugin using an easing library fx of OutBack and an animate speed of 
 * 700 milliseconds or 7/10ths of a second.
 *
 *
 * List of Parameters
 *
 * @param target - default: 'li' 
 * valid selector for target elements to receive hover effect.
 *
 * Example:
 * jQuery("div#article").lavaLamp({ target:'p' });
 * assigns all p elements under div#article to receive lavaLamp hover events.
 *
 * @param container - default: '' (empty string) 
 * DOM element to create for the hover element. If container is empty, LavaLamp
 * will assume it is the same as the target option.
 *
 * Example:
 * jQuery("div#article").lavaLamp({ container:'p' });
 * creates a p element under div#article to act as the animated hover container, and optionally the
 * home container, if homing options are enabled
 * use in combination with 'target' option for best results (see above)
 *
 * @param fx - default: 'swing'
 * selects the easing formula for the animation - requires the jQuery Easing library 
 * to be loaded for additional effects
 * 
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ fx: "easeOutElastic" });
 * animates the backLava element using the OutElastic formula
 * 
 * @param speed - default: 500
 * sets animation speed in milliseconds
 * 
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ speed: 1000 });
 * sets the animation speed to one second.
 * 
 * @param click - default: function() { return true; }
 * Callback to be executed when the menu item is clicked. The 'event' object and source target
 * DOM element will be passed in as arguments so you can use them in your function.
 * 
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ click: function(event, menuItem) {
 *        alert(event+el);
 *        return false;
 * } });
 *
 * causes the browser to display an alert message of the variables passed and 
 * return false aborts any other click events on child items, including not 
 * following any links contained within the target
 *
 * @param startItem - default: 'no'
 * specifies the number target element as default, starting with 0 for the first element
 * Used to manually set the default lavaLamp hi-light on load.
 *
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ startItem: 2 });
 * selects the third element in the list as default location for backLava
 *
 * @param includeMargins - default: false
 * expands the hover .backLava element to include the margins of the target element.
 * Best used in combination with the target and container options.
 *
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ includeMargins: true });
 * expands the hover .backLava element dimentions to include the margins of all
 * target elements inside ul.lavaLamp.
 *
 * @param autoReturn - default: true
 * defines whether the backLava hover should return to the last selectedLava element
 * upon mouseleave.
 *
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ autoReturn: false });
 * turns off the autoReturn feature - backLava element will stay on the last element
 * that you hovered over.
 *
 * @param returnDelay - default: 0
 * how many milliseconds to wait before returning the backLava element to the last
 * selected element.  Only works if autoReturn is set to true (default setting)
 *
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ returnDelay: 1000 });
 * waits one second after mouseleave event before returning to the last selected
 * element.
 *
 * @param setOnClick - default: true
 * defines whether a clicked element should receive the selectLava class and become the
 * most recently selected element
 *
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ setOnClick:false });
 * disables selecting of elements once clicked - after you leave the parent list element
 * the backLava will return to the original default element the page was loaded with.
 *
 * @param homeTop - default: 0
 * @param homeLeft - default: 0
 * @param homeHeight - default: 0
 * @param homeWidth - default: 0
 * allows you to define an independent 'home' element where the backLava defaults to or can
 * be sent to. This can be used to define a unique starting and/or resting place for the 
 * backLava upon leaving the parent element.
 *
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ homeTop:-100, homeLeft:0, homeHeight:20, homeWidth:600 });
 * creates a home element 100 pixels above the parent container with a height of 20px and
 * width of 600px.  If the parent element has CSS of overflow:hidden, this can provide
 * an interesting fly-in effect
 *
 * @param returnHome - default:false
 * adjusts behavior of the backLava element when the mouse leaves the parent container. 
 * the default behavior of 'false' causes the backLava element to stay on the active menu 
 * items after it is first triggered. this feature respects the returnDelay parameter, if set.
 * this feature overrides the autoReturn parameter.
 *
 * Example:
 * jQuery("ul.lavaLamp").lavaLamp({ returnHome:true });
 * causes the backLava element to always return to the homeLava position after 
 * mouse leaves the parent container.  this can be manually triggered by running 
 * the command jQuery("ul.lavaLamp").mouseover();
 *
 * @param autoResize - default:false
 * triggers the selectedLava mouseenter event when the window is resized 
 * setting autoResize to true causes the backLava element to reposition and change dimensions
 * if the resizing the screen changes the shape of the lavaLamp. Default is false for efficiency 
 * as this feature is new and seldom needed for stock installs.
 *
 * Example:
 * jQuery('div#articles').lavaLamp({target:'p',autoSize:true});
 * causes the backLava element to resize and reposition to the p.selectedLava position 
 * and dimensions when the window resizes.
 *
 */

//console.log();
(function($) {
jQuery.fn.lavaLamp = function(o) {
    o = $.extend({
                'target': 'li',
                'container': '',
                'fx': 'swing',
                'speed': 500, 
                'click': function(){return true}, 
                'startItem': '',
                'includeMargins': false,
                'autoReturn': true,
                'returnDelay': 0,
                'setOnClick': true,
                'homeTop':0,
                'homeLeft':0,
                'homeWidth':0,
                'homeHeight':0,
                'returnHome':false,
                'autoResize':false
                }, 
            o || {});

    // parseInt for easy mathing
    function getInt(arg) {
        var myint = parseInt(arg);
        return (isNaN(myint)? 0: myint);
    }

    if (o.container == '')
        o.container = o.target;

    if (o.autoResize)
        $(window).resize(function(){
            $(o.target+'.selectedLava').trigger('mouseenter');
        });

    return this.each(function() {
        // ensures parent UL or OL element has some positioning
        if ($(this).css('position')=='static')
            $(this).css('position','relative');

        // create homeLava element if origin dimensions set
        if (o.homeTop || o.homeLeft) { 
            var $home = $('<'+o.container+' class="homeLava"></'+o.container+'>').css({ 'left':o.homeLeft, 'top':o.homeTop, 'width':o.homeWidth, 'height':o.homeHeight, 'position':'absolute','display':'block' });
            $(this).prepend($home);
        }

        var path = location.pathname + location.search + location.hash, $selected, $back, $lt = $(o.target+'[class!=noLava]', this), delayTimer, bx=0, by=0, mh=0, mw=0, ml=0, mt=0;

        // start $selected default with CSS class 'selectedLava'
        $selected = $(o.target+'.selectedLava', this);
        
        // override $selected if startItem is set
        if (o.startItem != '')
            $selected = $lt.eq(o.startItem);

        // default to $home element
        if ((o.homeTop || o.homeLeft) && $selected.length<1)
            $selected = $home;

        // loop through all the target element a href tags and
        // the longest href to match the location path is deemed the most 
        // accurate and selected as default
        if ($selected.length<1) {
            var pathmatch_len=0, $pathel;
    
            $lt.each(function(){ 
                var thishref = $('a:first',this).attr('href');
                //console.log(thishref+' size:'+thishref.length);
                if (path.indexOf(thishref)>-1 && thishref.length > pathmatch_len )
                {
                    $pathel = $(this);
                    pathmatch_len = thishref.length;
                }
    
            });
            if (pathmatch_len>0) {
                //console.log('found match:'+$('a:first',$pathel).attr('href'));
                $selected = $pathel;
            }
            //else 
                //console.log('no match!');
        }
    
        // if still no matches, default to the first element
        if ( $selected.length<1 )
            $selected = $lt.eq(0);

        // make sure we only have one element as $selected and apply selectedLava class
        $selected = $($selected.eq(0).addClass('selectedLava'));
            
        // add mouseover event for every sub element
        $lt.bind('mouseenter', function() {
            //console.log('mouseenter');
            // help backLava behave if returnDelay is set
            if(delayTimer) {clearTimeout(delayTimer);delayTimer=null;}
            move($(this));
        }).click(function(e) {
            if (o.setOnClick) {
                $selected.removeClass('selectedLava');
                $selected = $(this).addClass('selectedLava');
            }
            return o.click.apply(this, [e, this]);
        });
        
        // creates and adds to the container a backLava element with absolute positioning
        $back = $('<'+o.container+' class="backLava"><div class="leftLava"></div><div class="bottomLava"></div><div class="cornerLava"></div></'+o.container+'>').css({'position':'absolute','display':'block','margin':0,'padding':0}).prependTo(this);

        // setting css height and width actually sets the innerHeight and innerWidth, so
        // compute border and padding differences on styled backLava element to fit them in also.
        if (o.includeMargins) {
            mh = getInt($selected.css('marginTop')) + getInt($selected.css('marginBottom'));
            mw = getInt($selected.css('marginLeft')) + getInt($selected.css('marginRight'));
        }
        bx = getInt($back.css('borderLeftWidth'))+getInt($back.css('borderRightWidth'))+getInt($back.css('paddingLeft'))+getInt($back.css('paddingRight'))-mw;
        by = getInt($back.css('borderTopWidth'))+getInt($back.css('borderBottomWidth'))+getInt($back.css('paddingTop'))+getInt($back.css('paddingBottom'))-mh;

        // set the starting position for the lavalamp hover element: .back
        if (o.homeTop || o.homeLeft)
            $back.css({ 'left':o.homeLeft, 'top':o.homeTop, 'width':o.homeWidth, 'height':o.homeHeight });
        else
        {
            if (!o.includeMargins) {
                ml = (getInt($selected.css('marginLeft')));
                mt = (getInt($selected.css('marginTop')));
            }
            $back.css({ 'left': $selected.position().left+ml, 'top': $selected.position().top+mt, 'width': $selected.outerWidth()-bx, 'height': $selected.outerHeight()-by }); 
        }

        // after we leave the container element, move back to default/last clicked element
        $(this).bind('mouseleave', function() {
            //console.log('mouseleave');
            var $returnEl = null;
            if (o.returnHome)
                $returnEl = $home;
            else if (!o.autoReturn)
                return true;
        
            if (o.returnDelay) {
                if(delayTimer) clearTimeout(delayTimer);
                delayTimer = setTimeout(function(){move($returnEl);},o.returnDelay);
            }
            else {
                move($returnEl);
            }
            return true;
        });

        function move($el) {
            if (!$el) $el = $selected;

            if (!o.includeMargins) {
                ml = (getInt($el.css('marginLeft')));
                mt = (getInt($el.css('marginTop')));
            }
            var dims = {
                'left': $el.position().left+ml,
                'top': $el.position().top+mt,
                'width': $el.outerWidth()-bx,
                'height': $el.outerHeight()-by
            };
            
            $back.stop().animate(dims, o.speed, o.fx);
        };
    });
    
};
})(jQuery);
