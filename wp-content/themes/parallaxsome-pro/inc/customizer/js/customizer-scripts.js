jQuery(document).ready(function($) {	
    
     //Re-Order home section
    $('#tm-sections-reorder').sortable({
        cursor: 'move',
        update: function(event, ui) {
            var section_ids = '';
            section_ids = $('#tm-sections-reorder li').css('cursor','default').map(
                function() {
                    return $(this).attr( 'data-section-name' );
                }
            ).get().join( ',' );
            $('#shortui-order').val(section_ids);
            $('#shortui-order').trigger('change');
        }
    });

    //Re-Order home section
    $('#tm-sections-reorder-menu').sortable({
        cursor: 'move',
        update: function(event, ui) {
            var section_ids = '';
            section_ids = $('#tm-sections-reorder-menu li').css('cursor','default').map(
                function() {
                    return $(this).attr( 'data-section-name' );
                }
            ).get().join( ',' );
            $('#shortui-order-menu').val(section_ids);
            $('#shortui-order-menu').trigger('change');
        }
    });
	/**
     * Script for switch option
     */
    $('.switch_options').each(function() {
        //This object
        var obj = $(this);

        var switchPart = obj.children('.switch_part').attr('data-switch');
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value

        obj.children('.switch_part.'+input_val).addClass('selected');
        obj.children('.switch_part').on('click', function(){
            var switchVal = $(this).attr('data-switch');
            obj.children('.switch_part').removeClass('selected');
            $(this).addClass('selected');
            $(input).val(switchVal).change(); //Finally change the value to 1
        });

    });

    /**
     * Script for Customizer icons
     */ 
    $(document).on('click', '.ap-customize-icons li', function() {
        $(this).parents('.ap-customize-icons').find('li').removeClass();
        $(this).addClass('selected');
        var iconVal = $(this).parents('.icons-list-wrapper').find('li.selected').children('i').attr('class');
        var inpiconVal = iconVal.split(' ');
        $(this).parents( '.ap-customize-icons' ).find('.ap-icon-value').val(inpiconVal[1]);
        $(this).parents( '.ap-customize-icons' ).find('.selected-icon-preview').html('<i class="' + iconVal + '"></i>');
        $('.ap-icon-value').trigger('change');
    });

    /**
     * Radio Image control in customizer
     */
    // Use buttonset() for radio images.
    $( '.customize-control-radio-image .buttonset' ).buttonset();

    // Handles setting the new value in the customizer.
    $( '.customize-control-radio-image input:radio' ).change(
        function() {

            // Get the name of the setting.
            var setting = $( this ).attr( 'data-customize-setting-link' );

            // Get the value of the currently-checked radio input.
            var image = $( this ).val();

            // Set the new value.
            wp.customize( setting, function( obj ) {

                obj.set( image );
            } );
        }
    );

    /**
     * Multiple checkboxes
     */
    /* === Checkbox Multiple Control === */

    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {
        checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
            function() {
                return this.value;
            }
        ).get().join( ',' );

        $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
    });

    /**
     * Text editor on customizer
     */
    (function($) {
        wp.customizerCtrlEditor = {

            init: function() {

                $(window).load(function() {

                    $('textarea.wp-editor-area').each(function() {
                        var tArea = $(this),
                            id = tArea.attr('id'),
                            input = $('input[data-customize-setting-link="' + id + '"]'),
                            editor = tinyMCE.get(id),
                            setChange,
                            content;

                        if (editor) {
                            editor.on('change', function(e) {
                                editor.save();
                                content = editor.getContent();
                                clearTimeout(setChange);
                                setChange = setTimeout(function() {
                                    input.val(content).trigger('change');
                                }, 500);
                            });
                        }

                        tArea.css({
                            visibility: 'visible'
                        }).on('keyup', function() {
                            content = tArea.val();
                            clearTimeout(setChange);
                            setChange = setTimeout(function() {
                                input.val(content).trigger('change');
                            }, 500);
                        });
                    });
                });
            }
        };
        wp.customizerCtrlEditor.init();
    })(jQuery);
    function parallaxsome_refresh_repeater_values(){
        $(".parallaxsome-repeater-field-control-wrap").each(function(){
            
            var values = []; 
            var $this = $(this);
            
            $this.find(".parallaxsome-repeater-field-control").each(function(){
            var valueToPush = {};   

            $(this).find('[data-name]').each(function(){
                var dataName = $(this).attr('data-name');
                var dataValue = $(this).val();
                valueToPush[dataName] = dataValue;
            });

            values.push(valueToPush);
            });

            $this.next('.parallaxsome-repeater-collector').val(JSON.stringify(values)).trigger('change');
        });
    }
     /**
     * Script for Customizer icons
    */ 
    $(document).on('click', '.ap-customize-icons li', function() {
        $(this).parents('.ap-customize-icons').find('li').removeClass();
        $(this).addClass('selected');
        var iconVal = $(this).parents('.icons-list-wrapper').find('li.selected').children('i').attr('class');
        var inpiconVal = iconVal.split(' ');
        $(this).parents( '.ap-customize-icons' ).find('.ap-icon-value').val(inpiconVal[1]);
        $(this).parents( '.ap-customize-icons' ).find('.selected-icon-preview').html('<i class="' + iconVal + '"></i>');
        $('.ap-icon-value').trigger('change');
    });
    $(document).on('click','.removeimage',function() {
        $(this).parent().html("");
        $("#parallaxsome_bread_bg_image").val('');
    });
    $("body").on("click",'.parallaxsome-add-control-field', function(){

        var $this = $(this).parent();
        if(typeof $this != 'undefined') {

            var field = $this.find(".parallaxsome-repeater-field-control:first").clone();
            if(typeof field != 'undefined'){
                
                field.find("input[type='text'][data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("textarea[data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find("select[data-name]").each(function(){
                    var defaultValue = $(this).attr('data-default');
                    $(this).val(defaultValue);
                });

                field.find(".radio-labels input[type='radio']").each(function(){
                    var defaultValue = $(this).closest('.radio-labels').next('input[data-name]').attr('data-default');
                    $(this).closest('.radio-labels').next('input[data-name]').val(defaultValue);
                    
                    if($(this).val() == defaultValue){
                        $(this).prop('checked',true);
                    }else{
                        $(this).prop('checked',false);
                    }
                });

                field.find(".selector-labels label").each(function(){
                    var defaultValue = $(this).closest('.selector-labels').next('input[data-name]').attr('data-default');
                    var dataVal = $(this).attr('data-val');
                    $(this).closest('.selector-labels').next('input[data-name]').val(defaultValue);

                    if(defaultValue == dataVal){
                        $(this).addClass('selector-selected');
                    }else{
                        $(this).removeClass('selector-selected');
                    }
                });

                field.find('.range-input').each(function(){
                    var $dis = $(this);
                    $dis.removeClass('ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all').empty();
                    var defaultValue = parseFloat($dis.attr('data-defaultvalue'));
                    $dis.siblings(".range-input-selector").val(defaultValue);
                    $dis.slider({
                        range: "min",
                        value: parseFloat($dis.attr('data-defaultvalue')),
                        min: parseFloat($dis.attr('data-min')),
                        max: parseFloat($dis.attr('data-max')),
                        step: parseFloat($dis.attr('data-step')),
                        slide: function( event, ui ) {
                            $dis.siblings(".range-input-selector").val(ui.value );
                            parallaxsome_refresh_repeater_values();
                        }
                    });
                });

                field.find('.onoffswitch').each(function(){
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    if(defaultValue == 'on'){
                        $(this).addClass('switch-on');
                    }else{
                        $(this).removeClass('switch-on');
                    }
                });

                field.find('.parallaxsome-color-picker').each(function(){
                    $(this).wpColorPicker({
                        change: function(event, ui){
                            setTimeout(function(){
                            parallaxsome_refresh_repeater_values();
                            }, 100);
                        }
                    }).parents('.parallaxsome-type-colorpicker').find('.wp-color-result').first().remove();
                });

                field.find(".attachment-media-view").each(function(){
                    var defaultValue = $(this).find('input[data-name]').attr('data-default');
                    $(this).find('input[data-name]').val(defaultValue);
                    if(defaultValue){
                        $(this).find(".thumbnail-image").html('<img src="'+defaultValue+'"/>').prev('.placeholder').addClass('hidden');
                    }else{
                        $(this).find(".thumbnail-image").html('').prev('.placeholder').removeClass('hidden');   
                    }
                });
                
                field.find(".parallaxsome-icon-list").each(function(){
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    $(this).prev('.parallaxsome-selected-icon').children('i').attr('class','').addClass(defaultValue);
                    
                    $(this).find('li').each(function(){
                        var icon_class = $(this).find('i').attr('class');
                        if(defaultValue == icon_class ){
                            $(this).addClass('icon-active');
                        }else{
                            $(this).removeClass('icon-active');
                        }
                    });
                });

                field.find(".parallaxsome-multi-category-list").each(function(){
                    var defaultValue = $(this).next('input[data-name]').attr('data-default');
                    $(this).next('input[data-name]').val(defaultValue);
                    
                    $(this).find('input[type="checkbox"]').each(function(){
                        if($(this).val() == defaultValue){
                            $(this).prop('checked',true);
                        }else{
                            $(this).prop('checked',false);
                        }
                    });
                });
                
                field.find('.parallaxsome-fields').show();

                $this.find('.parallaxsome-repeater-field-control-wrap').append(field);

                field.addClass('expanded').find('.parallaxsome-repeater-fields').show(); 
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                parallaxsome_refresh_repeater_values();
            }

        }
        return false;
    });
    $('body').on('click', '.parallaxsome-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.parallaxsome-icon-list').prev('.parallaxsome-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.parallaxsome-icon-list').next('input').val(icon_class).trigger('change');
        parallaxsome_refresh_repeater_values();
    });
    //MultiCheck box Control JS
    $( 'body' ).on( 'change', '.parallaxsome-type-multicategory input[type="checkbox"]' , function() {
        var checkbox_values = $( this ).parents( '.parallaxsome-type-multicategory' ).find( 'input[type="checkbox"]:checked' ).map(function(){
            return $( this ).val();
        }).get().join( ',' );
        $( this ).parents( '.parallaxsome-type-multicategory' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        parallaxsome_refresh_repeater_values();
    });

    $('body').on('click', '.parallaxsome-selected-icon', function(){
        $(this).next().slideToggle();
    });
    $("#customize-theme-controls").on("click", ".parallaxsome-repeater-field-remove",function(){
        if( typeof  $(this).parent() != 'undefined'){
            $(this).closest('.parallaxsome-repeater-field-control').slideUp('normal', function(){
                $(this).remove();
                parallaxsome_refresh_repeater_values();
            });
            
        }
        return false;
    });
    $('#customize-theme-controls').on('click', '.parallaxsome-repeater-field-close', function(){
        $(this).closest('.parallaxsome-repeater-fields').slideUp();;
        $(this).closest('.parallaxsome-repeater-field-control').toggleClass('expanded');
    });
    $('#customize-theme-controls').on('click','.parallaxsome-repeater-field-title',function(){
        $(this).next().slideToggle();
        $(this).closest('.parallaxsome-repeater-field-control').toggleClass('expanded');
    });
    /*Drag and drop to change order*/
    $(".parallaxsome-repeater-field-control-wrap").sortable({
        orientation: "vertical",
        update: function( event, ui ) {
            parallaxsome_refresh_repeater_values();
        }
    });
    $("#customize-theme-controls").on('keyup change', '[data-name]',function(){
         parallaxsome_refresh_repeater_values();
         return false;
    });

    $("#customize-theme-controls").on('change', 'input[type="checkbox"][data-name]',function(){
        if($(this).is(":checked")){
            $(this).val('yes');
        }else{
            $(this).val('no');
        }
        parallaxsome_refresh_repeater_values();
        return false;
    });
    // ADD IMAGE LINK
    $('.customize-control-repeater').on( 'click', '.parallaxsome-upload-button', function( event ){
    event.preventDefault();

    var imgContainer = $(this).closest('.parallaxsome-fields-wrap').find( '.thumbnail-image'),
    placeholder = $(this).closest('.parallaxsome-fields-wrap').find( '.placeholder'),
    imgIdInput = $(this).siblings('.upload-id');

    // Create a new media frame
    frame = wp.media({
        title: 'Select or Upload Image',
        button: {
        text: 'Use Image'
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected in the media frame...
    frame.on( 'select', function() {

    // Get media attachment details from the frame state
    var attachment = frame.state().get('selection').first().toJSON();

    // Send the attachment URL to our custom image input field.
    imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
    placeholder.addClass('hidden');

    // Send the attachment id to our hidden input
    imgIdInput.val( attachment.url ).trigger('change');

    });

    // Finally, open the modal on click
    frame.open();
    });
    // DELETE IMAGE LINK
    $('.customize-control-repeater').on( 'click', '.parallaxsome-delete-button', function( event ){

    event.preventDefault();
    var imgContainer = $(this).closest('.parallaxsome-fields-wrap').find( '.thumbnail-image'),
    placeholder = $(this).closest('.parallaxsome-fields-wrap').find( '.placeholder'),
    imgIdInput = $(this).siblings('.upload-id');

    // Clear out the preview image
    imgContainer.find('img').remove();
    placeholder.removeClass('hidden');

    // Delete the image id from the hidden input
    imgIdInput.val( '' ).trigger('change');

    });
    
    
    // Pre Loader 
    $(".pre-icon-container span").click(function (){
        
        var ploader = $(this).attr('ploader');
        
        $(this).parent('.pre-icon-container').children().removeClass('active');
        
        $(this).parent('.pre_loader_image').children().removeClass('active');
        $(this).addClass('active');
        
        $(this).parent('.pre-icon-container').next('input').val(ploader);
        $(this).parent('.pre-icon-container').next('input').change();
        var imgsrc = $(this).find('img').attr('src');
        //alert(imgsrc);
        $('img.pre_loader_image_preview').attr('src',imgsrc);
    });
});