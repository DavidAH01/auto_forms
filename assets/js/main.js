var searchVisible = 0;
var transparent = true;

var transparentDemo = true;
var fixedTop = false;

var navbar_initialized = false;

function init_tinymce_small(){
    tinymce.init({
        selector: 'textarea.tinymce-small',
        height: 300,
        theme: 'modern',
        language : $('html').attr('lang'),
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code imageupload sh4tinymce'
          ],
        toolbar: 'insertfile undo redo | bullist numlist outdent indent | imageupload | sh4tinymce',
        image_advtab: true,
        relative_urls: false,
        imageupload_url: $('#base_url').val()+'upload_tinymce',
    });
}
    
$(document).ready(function(){
    
    $('[data-toggle="tooltip"]').tooltip(); 

    window_width = $(window).width();
    
    // check if there is an image set for the sidebar's background
    lbd.checkSidebarImage();
    
    // Init navigation toggle for small screens   
    if(window_width <= 991){
        lbd.initRightMenu();   
    }
     
    // Activate the tooltips   
    $('[rel="tooltip"]').tooltip();

    // Activate the switches with icons 
    if($('.switch').length != 0){
        $('.switch')['bootstrapSwitch']();
    }  
    //      Activate regular switches
    if($("[data-toggle='switch']").length != 0){
         $("[data-toggle='switch']").wrap('<div class="switch" />').parent().bootstrapSwitch();     
    }

    // Activate links
    var url = window.location.href;
    $('a[href="'+window.location.href+'"]').parent('li').addClass('active');
    $('a[href="'+window.location.href.replace('create','view')+'"]').parent('li').addClass('active');
    $('a[href^="'+window.location.href.replace('edit','view').replace('?record=','').replace(/\d+/g, '')+'"]').parent('li').addClass('active');

     
    $('.form-control').on("focus", function(){
        $(this).parent('.input-group').addClass("input-group-focus");
    }).on("blur", function(){
        $(this).parent(".input-group").removeClass("input-group-focus");
    });

    $('.multiselect').multiselect();

    $('table tfoot th').each( function () {
        var title = $(this).text();
        if (title != "") {
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }
    });
    
    var table = $('.data-table').DataTable({
        "language": {
            "url": $('#base_url').val()+'assets/js/datatables/langs/'+$('html').attr('lang')+'.json'
        },
        "iDisplayLength": 100,
        "dom": 'T<"clear">lfrtip',
        tableTools: {
            "aButtons": [
                "copy",
                "xls",
                "csv",
                "pdf",
                "print"
            ]
        }
    });
    

    if ( $('.administrable-data-table').length > 0)
       $('.administrable-data-table').rowReordering({ sURL:$('#base_url').val()+'administrable_tables/order_records', sRequestType: "POST"});
    
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    $('.data-table tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');

        if (table.rows('.selected').data().length > 0){
            $('#remove-all').fadeIn(0);
            $('#remove-all-administrable-tables').fadeIn(0);
        }else{
            $('#remove-all').fadeOut(0);
            $('#remove-all-administrable-tables').fadeOut(0);
        }
    });

    tinymce.init({
        selector: 'textarea.tinymce',
        height: 300,
        theme: 'modern',
        language : $('html').attr('lang'),
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools imageupload sh4tinymce'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | imageupload',
        toolbar2: 'print preview media | forecolor backcolor emoticons | sh4tinymce',
        image_advtab: true,
        relative_urls: false,
        imageupload_url: $('#base_url').val()+'upload_tinymce',
    });

    init_tinymce_small();
});

// activate collapse right menu when the windows is resized 
$(window).resize(function(){
    if($(window).width() <= 991){
        lbd.initRightMenu();   
    }
});
    
lbd = {
    misc:{
        navbar_menu_visible: 0
    },
    
    checkSidebarImage: function(){
        $sidebar = $('.sidebar');
        image_src = $sidebar.data('image');
        
        if(image_src !== undefined){
            sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>'
            $sidebar.append(sidebar_container);
        }  
    },
    initRightMenu: function(){  
         if(!navbar_initialized){
            $navbar = $('nav').find('.navbar-collapse').first().clone(true);
            
            $sidebar = $('.sidebar');
            sidebar_color = $sidebar.data('color');
            
            var logo_content = '';
            if($('.logo').length){
                $logo = $sidebar.find('.logo').first();
                logo_content = $logo[0].outerHTML;
            } 
                    
            ul_content = '';
             
            $navbar.attr('data-color',sidebar_color);
             
            // add the content from the sidebar to the right menu
            content_buff = $sidebar.find('.nav').html();
            ul_content = ul_content + content_buff;
            
            //add the content from the regular header to the right menu
            $navbar.children('ul').each(function(){
                content_buff = $(this).html();
                ul_content = ul_content + content_buff;   
            });
             
            ul_content = '<ul class="nav navbar-nav">' + ul_content + '</ul>';
            
            navbar_content = logo_content + ul_content;
            
            $navbar.html(navbar_content);
             
            $('body').append($navbar);
             
            background_image = $sidebar.data('image');
            if(background_image != undefined){
                $navbar.css('background',"url('" + background_image + "')")
                       .removeAttr('data-nav-image')
                       .addClass('has-image');                
            }
             
             
             $toggle = $('.navbar-toggle');
             
             $navbar.find('a').removeClass('btn btn-round btn-default');
             $navbar.find('button').removeClass('btn-round btn-fill btn-info btn-primary btn-success btn-danger btn-warning btn-neutral');
             $navbar.find('button').addClass('btn-simple btn-block');
            
             $toggle.click(function (){    
                if(lbd.misc.navbar_menu_visible == 1) {
                    $('html').removeClass('nav-open'); 
                    lbd.misc.navbar_menu_visible = 0;
                    $('#bodyClick').remove();
                     setTimeout(function(){
                        $toggle.removeClass('toggled');
                     }, 400);
                
                } else {
                    setTimeout(function(){
                        $toggle.addClass('toggled');
                    }, 430);
                    
                    div = '<div id="bodyClick"></div>';
                    $(div).appendTo("body").click(function() {
                        $('html').removeClass('nav-open');
                        lbd.misc.navbar_menu_visible = 0;
                        $('#bodyClick').remove();
                         setTimeout(function(){
                            $toggle.removeClass('toggled');
                         }, 400);
                    });
                   
                    $('html').addClass('nav-open');
                    lbd.misc.navbar_menu_visible = 1;
                    
                }
            });
            navbar_initialized = true;
        }
   
    }
}


// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
};
