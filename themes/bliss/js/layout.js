/**
 * Created by nihuan on 14-11-18.
 */
if(jQuery(window).width()>768){var didScroll=false;jQuery(window).scroll(function(){didScroll=true;});var y;setInterval(function(){if(didScroll){didScroll=false;y=jQuery(window).scrollTop();if(y>70){jQuery('#masthead .bluth-navigation').addClass('fixed');}else{jQuery('#masthead .bluth-navigation').removeClass('fixed');}
    if(y>170){jQuery('#masthead .bluth-navigation').addClass('shrunk');}else{jQuery('#masthead .bluth-navigation').removeClass('shrunk');}}},50);}
jQuery(function(){jQuery('.dropdown-toggle').parent().mouseover(function(){jQuery(this).addClass('open');});jQuery('.dropdown-toggle').parent().mouseout(function(){jQuery(this).removeClass('open');});resetNavLine(250);jQuery('#masthead .nav li').mouseover(function(){jQuery('.nav-line').stop();jQuery('.nav-line').animate({left:jQuery(this).offset().left-jQuery('.bluth-navigation .container .navbar').offset().left,width:jQuery(this).width()},250);});jQuery('#masthead .nav li').mouseout(function(){resetNavLine(250);});});function resetNavLine(time){jQuery('.nav-line').stop();if(jQuery('.nav').children('li').hasClass('current-menu-item')){jQuery('.nav-line').animate({left:jQuery('.current-menu-item').offset().left-jQuery('.bluth-navigation .container .navbar').offset().left,width:jQuery('.current-menu-item').width()},time);}else if(jQuery('.nav').children('li').hasClass('current-menu-ancestor')){jQuery('.nav-line').animate({left:jQuery('.current-menu-ancestor').offset().left-jQuery('.bluth-navigation .container .navbar').offset().left,width:jQuery('.current-menu-ancestor').width()},time);}else{jQuery('.nav-line').animate({width:0});}}