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
                selectMovie.empty();
                selectMovie.append("<option value='0' selected>choose a movie to modify</option>");
                for (var i = 0; i < response.length; i++) {
                    selectMovie.append("<option value='" + response[i]['name'] + "'>" + response[i]['name'] + "</option>");
                }
            }
        });

    });
    $("#modifyNameButton").click(function () {
        var inputNewName = $('#newMovieName').val()
        var movieCodeSelected = $('#movieTable').find("td").eq(0).html();
        $.ajax({
            url: '?controller=Movie&action=modifyNameAjax',
            type: 'post',
            data: {
                movieCode: movieCodeSelected,
                newMovieName: inputNewName
            },
            dataType: 'json',
            success: function (response) {
                fillTable($('#movieTable'), response);
            }
        });
    });
    $("#modifyDurationButton").click(function () {
        var inputMovieName = $('#movieTable').find("td").eq(1).html();
        var newDuration = $('#newDuration').val();
        var movieCodeSelected = $('#movieTable').find("td").eq(0).html();

        $.ajax({
            url: '?controller=Movie&action=modifyDurationAjax',
            type: 'post',
            data: {
                movieCode: movieCodeSelected,
                movieName: inputMovieName,
                newDuration: newDuration
            },
            dataType: 'json',
            success: function (response) {
                fillTable($('#movieTable'), response);
            }
        });
    });

    $("#modifyLanguageButton").click(function () {
        var inputMovieName = $('#movieTable').find("td").eq(1).html();
        var newLanguage = $('#newLenguage').val();
        var movieCodeSelected = $('#movieTable').find("td").eq(0).html();

        $.ajax({
            url: '?controller=Movie&action=modifyLanguageAjax',
            type: 'post',
            data: {
                movieCode: movieCodeSelected,
                movieName: inputMovieName,
                newLanguage: newLanguage
            },
            dataType: 'json',
            success: function (response) {
                fillTable($('#movieTable'), response);
            }
        });
    });
    $("#modifySynopsisButton").click(function () {
        var inputMovieName = $('#movieTable').find("td").eq(1).html();
        var newSynopsis = $('#newSynopsis').val();
        var movieCodeSelected = $('#movieTable').find("td").eq(0).html();

        $.ajax({
            url: '?controller=Movie&action=modifySynopsisAjax',
            type: 'post',
            data: {
                movieCode: movieCodeSelected,
                movieName: inputMovieName,
                newSynopsis: newSynopsis
            },
            dataType: 'json',
            success: function (response) {
                fillTable($('#movieTable'), response);
            }
        });
    });

    $("#selectMovie").change(function () {
        var movieSelected = $(this).val();
        $.ajax({
            url: '?controller=Movie&action=getMovieDataByAjax',
            type: 'post',
            data: {
                movieName: movieSelected,
            },
            dataType: 'json',
            success: function (response) {
                fillTable($('#movieTable'), response);
            }
        });
    });
});

function fillTable(tableId, response) {
    tableId.empty();
    tableId.append("<tr><th>Code</th><th>Name</th><th>Duration</th><th>Language</th><th>Synopsis</th></tr>");
    for (var i = 0; i < response.length; i++) {
        tableId.append($('<tr>')
            .append($('<td>').append(response[i]['code']))
            .append($('<td>').append(response[i]['name']))
            .append($('<td>').append(response[i]['duration']))
            .append($('<td>').append(response[i]['language']))
            .append($('<td>').append(response[i]['synopsis']))
        )
    }
}