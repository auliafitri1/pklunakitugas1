$(document).ready(function(){
    var $body = $('#table-body');
    if (!$body.length) return;

    var $box = $body.closest('.overflow-y-auto');
    var url = $body.data('load-more-url');
    var page = 2;
    var loading = false;
    var hasMore = true;

    $box.on('scroll', function (){
        if (loading || !hasMore) return;

        var $el = $box[0];
        
        if ($el.scrollTop + $el.clientHeight >= $el.scrollHeight - 100) {
            loading = true;
            $('#loading-indicator').show();

            $.get(url, {page: page }, function (res) {
                setTimeout(function(){
                    $('#loading-indicator').hide();

                    res.data.forEach(function (item){
                        $body.append(window.renderLazyRow(item));
                    });
                    var now = parseInt($('#data-count').text())|| 0;
                    $('#data-count').text(now + res.data.length);

                    page = res.nextPage;
                    hasMore = res.hasMore;
                    loading = false;

                    if (!hasMore) $('#end-of-data').show();
                },400);
            });
        }

    });
});