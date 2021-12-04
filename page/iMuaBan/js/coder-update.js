// custom js here
(function($) {
    //function add or update param url
    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }
    //paginate blog
    $page = 1;
    // $pageCurrent = $('#page').val();
    var url = new URL(window.location.href);
    $pageCurrent = url.searchParams.get("page");
    if($pageCurrent == null){
        $pageCurrent = 1;
    }
    $pageCurrent = parseInt($pageCurrent);
    $pageTotal = $('.paginate-hd .page-number').length;
    $('.paginate-hd li').on("click", function() {
            if ($(this).hasClass('prev')) {
                if($pageCurrent > 1 && $pageTotal >=2){
                    $page = $pageCurrent - 1;
                }else {
                    $page = $pageCurrent;
                }
            } else if ($(this).hasClass('next')) {
                if($pageCurrent < $pageTotal ){
                    $page = $pageCurrent + 1;
                }else {
                    $page = $pageCurrent;
                }
            } else {
                $page = $(this).find('a').text();
            }
       if($page != 0 && $page != $pageCurrent){
           $hrefCurrent = window.location.href;
           window.location.href = updateQueryStringParameter($hrefCurrent,'page',$page);
           $('#page').val($page);
       }
    });
    //Tìm kiếm blog
    $('#search-blog').on("keydown keypress keyup", function (evt) {
        $key = $(this).val();
        if($key.trim().length > 2 && $key.trim().length < 50){
            autoSearch($key);
        }
    });
    //Gọi url blog search
    function autoSearch($key) {
        $hrefBlog = '/blogs'
        window.location.href = updateQueryStringParameter($hrefBlog,'search',$key);
    }

    //language
    var langArray = [];
    $('.langOption option').each(function(){
        var img = $(this).attr("data-thumbnail");
        var text = this.innerText;
        var value = $(this).val();
        var item = '<li><img src="'+ img +'" alt="" value="'+value+'"/><span>'+ text +'</span></li>';
        langArray.push(item);
    })

    $('#langlg').html(langArray);

    //Set the button value to the first el of the array
    $('.btn-select').html(langArray[0]);
    $('.btn-select').attr('value', 'en');

    //change button stuff on click
    $('#langlg li').click(function(){
        var img = $(this).find('img').attr("src");
        var value = $(this).find('img').attr('value');
        var text = this.innerText;
        var item = '<li><img src="'+ img +'" alt="" /><span>'+ text +'</span></li>';
        $('.btn-select').html(item);
        $('.btn-select').attr('value', value);
        $(".boxlang").toggle();
        if(value == 'en'){
            $.ajax({
                url: "/assets/ajaxs/Lang.php",
                method: "POST",
                data: {
                type: 'ChangeLanguage',
                    lang: 'en'
            },
            success: function(response) {
                setTimeout(function() {
                    location.href = ""
                }, 0);
            }
        });
        }
        if(value == 'vn'){
            $.ajax({
                url: "/assets/ajaxs/Lang.php",
                method: "POST",
                data: {
                type: 'ChangeLanguage',
                    lang: 'vn'
            },
            success: function(response) {
                setTimeout(function() {
                    location.href = ""
                }, 0);
            }
        });
        }
    });

    $(".btn-select").click(function(){
        $(".boxlang").toggle();
    });



})(window.jQuery);