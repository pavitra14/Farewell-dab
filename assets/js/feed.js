    function getresult(url) {
        $.ajax({
            url: url,
            type: "GET",
            data:  {rowcount:$(".rowcount").val()},
            beforeSend: function(){
                $('#loader-icon').show();
                console.log("beforeSend()");
            },
            complete: function(){
                $('#loader-icon').hide();
            },
            success: function(data){
                if(data == 'No new posts!') {
                    $("#scroll-end").show();
                } else {
                    $("#feedContent").append(data);
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    }
    $(window).scroll(function(){
        console.log("scroll")
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100){
            console.log('Almost end');
            if($(".pagenum:last").val() <= $(".total-page").val()) {
                var pagenum = parseInt($(".pagenum:last").val()) + 1;
                getresult('includes/feedContent.html?page='+pagenum);
                console.log($('.rowcount').val());
            }
        }
    });
