jQuery(document).ready(function(){
    var grid = jQuery('.dimg-contents').imagesLoaded( function() {
        grid.masonry({
          itemSelector: '.dimg-col-card',
          percentPosition: true,
        }); 
    });
    
    var is_finish = false;

    jQuery(window).resize(function(){
        //모바일 메뉴를 닫은 뒤 윈도우 사이즈가 모바일 보다 커지게 되면 메뉴가 안 보이는 버그가 생겨서 메뉴 표시해줌
        if(jQuery(window).width() > 767 && (jQuery(".dimg-menu-wrapper-inner").css("display") == "none" || jQuery(".dimg-menu-wrapper").css("display") == "none")) {
            console.log(jQuery(".dimg-menu-wrapper-inner").css("display"));
            jQuery(".dimg-menu-wrapper-inner").show();
            jQuery(".dimg-menu-wrapper").show();
        }
    });

    jQuery(".dimg-mobile-menu-btn, .dimg-mobile-close-btn").on("click", function(){
        //width를 변경하며 in or out 되기 때문에 텍스트가 여러줄로 줄바꿈 되는 것을 보여주지 않기 위해 숨김 처리.
        if(jQuery(".dimg-menu-wrapper").hasClass("open")){
            jQuery(".dimg-menu-wrapper").removeClass("open");
            setTimeout(function(){
                jQuery(".dimg-menu-wrapper-inner").toggle();
            },100);
        } else {
            jQuery(".dimg-menu-wrapper").addClass("open");
            setTimeout(function(){
                jQuery(".dimg-menu-wrapper-inner").toggle();
            },300);
        }
        
        jQuery(".dimg-menu-wrapper").animate({
            width:"toggle"
        });
    });

    jQuery(".dimg-loading-btn").on("click", function(){
        jQuery.ajax({
            url: '/wp-content/themes/doubleimg/dimg-ajax.php',
            dataType: 'json',
            type: 'post',
            data: {
                'mode': "LOAD_MORE_POST"
                ,'item_cnt': jQuery(".dimg-col-card").length
            }, beforeSend: function(xhr) {
                jQuery(".dimg-loading-btn").text("Loading...");
                jQuery(".dimg-loading-btn").addClass("dimg-loding");
                jQuery(".dimg-loading-btn").attr("disabled","disabled");
            }, success: function(response) {
                if(response.result == "success") {
                    var localEl = jQuery(response.data);
                    jQuery('.dimg-contents').append(localEl).masonry('appended', localEl, true);
                    setTimeout(function() {jQuery('.dimg-contents').masonry();}, 100);
                } else if(response.result == "finished") {
                    is_finish = true;
                    jQuery(".dimg-loading-btn").addClass("dimg-disabled");
                    jQuery(".dimg-loading-btn").attr("disabled","disabled");
                } else {
                    alert("포스트를 불러오는데 실패했습니다.");
                }
            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
            }
        }).done(function(){
            if(!is_finish){
                jQuery(".dimg-loading-btn").attr("disabled",null);
            }
            jQuery(".dimg-loading-btn").text("Load more posts");
            jQuery(".dimg-loading-btn").removeClass("dimg-loding");
        });
    });
    
    jQuery(".dimg-loading-btn-cate").on("click", function(){
        jQuery.ajax({
            url: '/wp-content/themes/doubleimg/dimg-ajax.php',
            dataType: 'json',
            type: 'post',
            data: {
                'mode': "LOAD_MORE_POST_CATEGORY"
                ,'item_cnt': jQuery(".dimg-col-card").length
                ,'category': category
            }, beforeSend: function(xhr) {
                jQuery(".dimg-loading-btn-cate").text("Loading");
                jQuery(".dimg-loading-btn-cate").addClass("dimg-loading");
                jQuery(".dimg-loading-btn-cate").attr("disabled","disabled");
            }, success: function(response) {
                if(response.result == "success") {
                    var localEl = jQuery(response.data);
                    jQuery('.dimg-contents').append(localEl).masonry('appended', localEl, true);
                    setTimeout(function() {jQuery('.dimg-contents').masonry();}, 100);
                } else if(response.result == "finished") {
                    is_finish = true;
                    jQuery(".dimg-loading-btn-cate").addClass("dimg-disabled");
                    jQuery(".dimg-loading-btn-cate").attr("disabled","disabled");
                } else {
                    alert("포스트를 불러오는데 실패했습니다.");
                }
            }, error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.responseText);
            }
        }).done(function(){
            if(!is_finish){
                jQuery(".dimg-loading-btn-cate").attr("disabled",null);
            }
            jQuery(".dimg-loading-btn-cate").text("Load more posts");
            jQuery(".dimg-loading-btn-cate").removeClass("dimg-loading");
        });
    });

    setTimeout(() => {
        jQuery('.dimg-contents').masonry();
    }, 3000);
});