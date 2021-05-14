$(document).ready(function() {
    $("#selectGenres").change(function() {
       
        var genreSelected = $(this).val();
        var selectActors = $('#selectActors');

        $.ajax({
            url: '?controller=Movie&action=getActorByGenreAjax',
            type: 'post',
            data: {
                genre: genreSelected
            },
            dataType: 'json',
            success: function(response) {
                selectActors.empty();
                selectActors.append("<option value='0' selected>Choose any actor</option>");
                for (var i = 0; i < response.length; i++) {
                    selectActors.append("<option value='" + response[i]['name'] + ' ' + response[i]['last_name'] +
                        "'>" + response[i]['name'] + ' ' + response[i]['last_name'] + "</option>");
                }
            }
        });

    });
    $("#selectActors").change(function() {
        var actorSelected = $(this).val();
        var genreSelected = $('#selectGenres').val();
        var selectMovie = $('#selectMovie');

        $.ajax({
            url: '?controller=Movie&action=getMovieNameByAjax',
            type: 'post',
            data: {
                actorFullName: actorSelected,
                genre: genreSelected
            },
            dataType: 'json',
            success: function(response) {
                selectMovie.empty();
                selectMovie.append("<option value='0' selected>Choose any movie</option>");
                for (var i = 0; i < response.length; i++) {
                    selectMovie.append("<option value='" + response[i]['name'] + "'>" + response[i]['name'] + "</option>");
                }
            }
        });

    });
    $("#selectMovie").change(function() {
        var movieSelected = $(this).val();
        var genreSelected = $('#selectGenres').val();
        var actorSelected = $('#selectActors').val();
        var tableMovieData = $('#columnsMovieTable');
        var tableActor = $('#actorTable');
        var genreTable = $('#genreTable');

        $.ajax({
            url: '?controller=Movie&action=getMovieDataByAjax',
            type: 'post',
            data: {
                movieName: movieSelected,
            },
            dataType: 'json',
            success: function(response) {
                tableMovieData.empty();
                for (var i = 0; i < response.length; i++) {
                    tableMovieData.append("<td>"+response[i]['code']+"</td>");
                    tableMovieData.append("<td>"+response[i]['name']+"</td>");
                    tableMovieData.append("<td>"+response[i]['duration']+"</td>");
                    tableMovieData.append("<td>"+response[i]['language']+"</td>");
                    tableMovieData.append("<td>"+response[i]['synopsis']+"</td>");
                }
            }
        });

        $.ajax({
            url: '?controller=Movie&action=getActorByMovieNameAjax',
            type: 'post',
            data: {
                movieName: movieSelected,
            },
            dataType: 'json',
            success: function(response) {
                tableActor.empty();
                tableActor.append("<tr><th>Name</th><th>Last Name</th></tr>");
                    for (var i = 0; i < response.length; i++) {
                        (tableActor).append("<tr><td>"+response[i]['name']+"</td><td>"+response[i]['last_name']+"</td></tr>");
                }
    
            }
        });

        $.ajax({
            url: '?controller=Movie&action=getActorByMovieNameAjax',
            type: 'post',
            data: {
                movieName: movieSelected,
            },
            dataType: 'json',
            success: function(response) {
                tableActor.empty();
                tableActor.append(" <tr><th>Name</th><th>Last Name</th></tr>");
                    for (var i = 0; i < response.length; i++) {
                        tableActor.append("<tr><td>"+response[i]['name']+"</td><td>"+response[i]['last_name']+"</td></tr>");
                }
    
            }
        });

        $.ajax({
            url: '?controller=Movie&action=getGenresByMovieNameAjax',
            type: 'post',
            data: {
                movieName: movieSelected,
            },
            dataType: 'json',
            success: function(response) {
                genreTable.empty();
                genreTable.append("<tr><th>Name</th></tr>");
                    for (var i = 0; i < response.length; i++) {
                        genreTable.append("<tr><td>"+response[i]['genre_name']+"</td></tr>");
                }
    
            }
        });

    });
});