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


})(window.jQuery);