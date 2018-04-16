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
                $("#feedContent").append(data);
                console.log(data);
            },
            error: function(error){
                console.log(error);
            }
        });
    }
    $(window).scroll(function(){
        console.log("scroll")
        if ($(window).scrollTop() == $(document).height() - $(window).height()){
            if($(".pagenum:last").val() <= $(".rowcount").val()) {
                var pagenum = parseInt($(".pagenum:last").val()) + 1;
                getresult('includes/feedContent.html?page='+pagenum);
            }
        }
    });
