jQuery(function() {
    jQuery('.share-post').click(function(e){ e.preventDefault(); });

    jQuery('#searchform input[type="text"]').val('Search...');

    jQuery('#searchform input[type="text"]').focus(function(){
    	if(jQuery(this).val() == "Search..."){
    		jQuery(this).val('')
    	}
    })
    jQuery('#searchform input[type="text"]').blur(function(){
    	if(jQuery(this).val() == ""){
    		jQuery(this).val('Search...')
    	}
    });

    jQuery('.searchform a').click(function(e){ 
      e.preventDefault(); 
      jQuery('.bl_search input').toggle();
      jQuery('.bl_search input').focus();
      jQuery('.bl_search_overlay').toggle();
      // jQuery('.bl_search input').toggleClass('focus'));
    });
    jQuery('.bl_search_overlay').click(function(e){ 
      jQuery('.bl_search input').toggle();
      jQuery('.bl_search_overlay').toggle();
    });
    var oldTop;
    jQuery('.entry-video > iframe').mouseover(function(){
      // oldTop = jQuery(this).closest('article').find('.post-format-badge').css('top');
      jQuery(this).closest('article').find('.post-format-badge').stop();
      jQuery(this).closest('article').find('.post-format-badge').animate({ opacity:'0' }, 500, 'swing');
    });
    jQuery('.entry-video > iframe').mouseout(function(){
      jQuery(this).closest('article').find('.post-format-badge').stop();
      jQuery(this).closest('article').find('.post-format-badge').animate({ opacity:'1' }, 500, 'swing');
    });

    jQuery('time.timeago').timeago();

    jQuery('.tips').tooltip();

    jQuery('.bl_popover').popover();

    jQuery('.lightbox').magnificPopup({type:'image'});

    suffixjpg = '.jpg';
    suffixjpeg = '.jpeg';
    suffixpng = '.png';

    // Lightbox Gallery
    if( jQuery( '.gallery').length > 0 ){
      if( jQuery( '.gallery-item a' ).eq(0).attr( 'href' ).indexOf(suffixjpg, jQuery( '.gallery-item a' ).eq(0).length - suffixjpg.length) !== -1 || jQuery( '.gallery-item a' ).eq(0).attr( 'href' ).indexOf(suffixjpeg, jQuery( '.gallery-item a' ).eq(0).length - suffixjpeg.length) !== -1 || jQuery( '.gallery-item a' ).eq(0).attr( 'href' ).indexOf(suffixpng, jQuery( '.gallery-item a' ).eq(0).length - suffixpng.length) !== -1){
        jQuery( '.gallery' ).magnificPopup({
            delegate: '.gallery-item a', // the container for each your gallery items
            type: 'image',
            gallery:{ enabled:true }
        });
      }
    }
    
    jQuery("pre.html").snippet("html",{style:"emacs"});
    jQuery("pre.css").snippet("css",{style:"emacs"});
    jQuery("pre.php").snippet("php",{style:"emacs"});
    jQuery("pre.js").snippet("javascript",{style:"emacs"});

    jQuery('.page #content article .the-content').animate({
      opacity: 1
    }, 1000);

	// 滚动
	jQuery('.scroll_t').click(function(){jQuery('html,body').animate({scrollTop: '0px'}, 800);});
	jQuery('.scroll_c').click(function(){jQuery('html,body').animate({scrollTop:jQuery('.comments-area').offset().top}, 800);});
	jQuery('.scroll_b').click(function(){jQuery('html,body').animate({scrollTop:jQuery('.site-footer').offset().top}, 800);});

	jQuery("ul.scroll li").hover(function() {
	jQuery(this).find("div").stop()
	.animate({right: "0", opacity:1}, "fast")
	.css("display","block")
	}, function() {
	jQuery(this).find("div").stop()
	.animate({right: "0", opacity: 0}, "fast")
	});
});
// jQuery(window).load(function() {
//     jQuery('.nivo-slider').nivoSlider({
//         effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
//         slices: 15, // For slice animations
//         boxCols: 8, // For box animations
//         boxRows: 4, // For box animations
//         animSpeed: 350, // Slide transition speed
//         pauseTime: 8000, // How long each slide will show
//         startSlide: 0, // Set starting Slide (0 index)
//         directionNav: true, // Next & Prev navigation
//         controlNav: false, // 1,2,3... navigation
//         controlNavThumbs: false, // Use thumbnails for Control Nav
//         pauseOnHover: true, // Stop animation while hovering
//         manualAdvance: true, // Force manual transitions
//         randomStart: false, // Start on a random slide
//         prevText: '<i class="icon-left-open-1"></i>', // Prev directionNav text
//         nextText: '<i class="icon-right-open-1"></i>', // Next directionNav text
//         beforeChange: function(){}, // Triggers before a slide transition
//         afterChange: function(){}, // Triggers after a slide transition
//         slideshowEnd: function(){}, // Triggers after all slides have been shown
//         lastSlide: function(){}, // Triggers when last slide is shown
//         afterLoad: function(){} // Triggers when slider has loaded
//     });
    
//     jQuery('video,audio').mediaelementplayer();

//     var $allVideos = jQuery(".entry-video iframe, .entry-video object");
//     // The element that is fluid width
//     if(jQuery("#content").hasClass('twocolumn')){
//       var $fluidEl = jQuery("#content .span6");
//     }else{
//       var $fluidEl = jQuery("#content");
//     }
      
//       // Figure out and save aspect ratio for each video
//       $allVideos.each(function() {
//           var height = (this.height === '') ? 473 : this.height;
//           var width = (this.width === '') ? 840 : this.width;
//         jQuery(this)
//           // and remove the hard coded width/height
//           .attr('data-aspectRatio', height / width)
//           .removeAttr('height')
//           .removeAttr('width');
//       });
//       // When the window is resized
//       jQuery(window).resize(function() {
//         var newWidth = $fluidEl.width();
//         // Resize all videos according to their own aspect ratio
//         $allVideos.each(function() {
//           var $el = jQuery(this);
//           $el.width(newWidth).height(newWidth * $el.attr('data-aspectRatio'));
//         });
//       // Kick off one resize to fix all videos on page load
//       }).resize();


// });
function social_share(data) {
    window.open( data, "fbshare", "height=450,width=760,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
}
