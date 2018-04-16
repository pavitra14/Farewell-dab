var onSelect = function(event) {
    // console.log("Selected: " + event.target.value);
    var fullname = event.target.value;
    $.ajax({
        url: 'includes/feedContent.html',
        type: "GET",
        data:  {'full_name':fullname},
        success: function(data){
            location.href = data;
        },
        error: function(error){
            console.log(error);
        }
    });
};

$(document).ready(function(){
    $('input#navbar-search-input').typeahead({
        name: 'typeahead',
        remote:'includes/feedContent.html?search_key=%QUERY',
        limit : 10
    });
    $('input#navbar-search-input').on('typeahead:selected', onSelect);
    $('input#searchSubmit').on('click', onSelect);
});
