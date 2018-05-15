jQuery(document).ready(function($) {
	'use strict';

	/**
     * Radio Image control in customizer
     */
    // Use buttonset() for radio images.
    $( '.ps-meta-options-wrap .buttonset' ).buttonset();
    
    // Media Gallery Home
     $(document).on('click','.docopy-post_image', function(e) {
      var counter_gallery = $('#post_image_count').val();
       var send_attachment_bkp = wp.media.editor.send.attachment;
       var custom_media = true;
       wp.media.editor.send.attachment = function(props, attachment){
         if ( custom_media ) {
           console.log(attachment.url);
           var img = attachment.url;
           $('.post_image_section').append('<div class="gal-img-block"><div class="gal-img"><img src="'+img+'"  width="100px"/><span class="fig-remove">Remove</span></div><input type="hidden" name="post_images['+counter_gallery+']" class="hidden-media-gallery" value="'+attachment.url+'" /></div>');
           counter_gallery++;
           $('#post_image_count').val(counter_gallery);                
         } else {
           return _orig_send_attachment.apply( this, [props, attachment] );
         };
       }
       
       wp.media.editor.open($(this));
       return false;
     });
     
     // Remove Media Gallery Image
     $(document).on('click','.fig-remove',function() {   
       $(this).parent().parent().remove();
     });

    /**
     * Meta tabs and its content
     */
    $('.ps-meta-menu-wrapper li').click(function() {
        var tabIdRaw = $(this).attr('id');
        var tabId = tabIdRaw.split('-');
        $('.ps-single-meta').hide();
        $('#ps-'+tabId[1]+'-content').fadeIn();
    });
});