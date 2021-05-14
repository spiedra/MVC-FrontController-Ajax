$(document).ready(function () {
    $("#searchByNameButton").click(function () {
        var inputMovieName = $('#inputMovieName').val();
        var selectMovie = $('#selectMovie');

        $.ajax({
            url: '?controller=Movie&action=getMoviesByAjax',
            type: 'post',
            data: {
                movieName: inputMovieName
            },
            dataType: 'json',
            success: function (response) {
                // alert(response.length);
                selectMovie.empty();
                selectMovie.append("<option value='0' selected>choose a movie to modify</option>");
                for (var i = 0; i < response.length; i++) {
                    selectMovie.append("<option value='" + response[i]['name'] + "'>" + response[i]['name'] + "</option>");
                }
            }
        });

    });
});