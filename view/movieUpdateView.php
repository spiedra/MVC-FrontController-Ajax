<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="icon" type="image/svg+xml" href="public/images/main_icon.svg" sizes="16" />
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <script type="text/javascript" src="public/js/jquery.js"></script>
    <script type="text/javascript" src="public/js/ajaxModificationMovie.js"></script>
    <title>Movie Store Online</title>
</head>

<body>
    <?php
    include_once 'header.php';
    ?>

    <main class="main">
        <section class="registration-section">
            <div class="registration-section__container">
                <h1 class="registration-section__tittle">Update Movie</h1>
            </div>
            <article class="registration-section__form-article">
                <form class="registration-form" method="post">
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">Modified movie information:</label>
                        <table id="movieTable" class="form__table">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Language</th>
                                <th>Synopsis</th>
                            </tr>
                        </table>
                    </div>
                    <div class="container-registration__form container-registration__form--delete">
                        <label class="form__label--registration" for="genreName">Movie Name:</label>
                        <input id="inputMovieName" class="form__input--registration form__input--delete" name="movieName" />
                        <input id="searchByNameButton" class="form__input-button--registration" type="button" value="Search by name" name="buttonSearchByName">
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">Movies:</label>
                        <select id="selectMovie" class="form__select  select-css">
                            <option value="0" selected>choose a movie to modify</option>
                        </select>
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration">Name:</label>
                        <input id="newMovieName" class="form__input--registration" name="movieName" />
                        <input id="modifyNameButton" class="form__input-button--registration" type="button" value="Modify name" name="modifyMovieName">
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration">Duration:</label>
                        <input id="newDuration" class="form__input--registration" name="movieDuration" />
                        <input id="modifyDurationButton" class="form__input-button--registration" type="button" value="Modify duration" name="buttonSearchByName">
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration">Language:</label>
                        <input id="newLenguage" class="form__input--registration" name="movieLanguage" />
                        <input id="modifyLanguageButton" class="form__input-button--registration" type="button" value="Modify language" name="buttonSearchByName">
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration" for="movieSynopsis">Synopsis:</label>
                        <textarea id="newSynopsis" class="form__input--registration--txta" name="movieSynopsis"></textarea>
                        <input id="modifySynopsisButton" class="form__input-button--registration" type="button" value="Modify Synopsis" name="buttonSearchByName">
                    </div>
            </article>
        </section>
    </main>
</body>

</html>