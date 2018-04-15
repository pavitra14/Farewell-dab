/**
 * Function to handle likes and actions
 * @param id
 * @param action
 */
function addLikes(id,action) {
    var likes = parseInt($('#likes-'+id+'').text());
    $.ajax({
        url: "includes/feedContent.html?like=1",
        data:'p_id='+id+'&action='+action,
        type: "POST",
        success: function(data){
            switch(action) {
                case "like":
                    $('#trigger-'+id+'').html('Unlike');
                    likes = likes+1;
                    $('#likes-'+id).html(likes);
                    break;
                case "unlike":
                    $('#trigger-'+id+'').html('Like');
                    likes = likes-1;
                    $('#likes-'+id).html(likes);
                    break;
            }
        }
    });
}

function likePost(p_id) {
    var link = $('#trigger-'+p_id).text();
    if(link == 'Like') {
        //post is not liked yet, like it
        addLikes(p_id, 'like');
    } else {
        addLikes(p_id, 'unlike');
    }
}

function reportPost(p_id) {
    alert("Will be available soon!");
}

function deletePost(p_id){
    if(confirm("Are you sure you want to delete this post?")) {
        $.ajax({
            url: "includes/feedContent.html?delete=1",
            data:'p_id='+p_id,
            type: "POST",
            success: function(data){
                alert("Post deleted.");
                location.reload();
            }
        });
    }
}