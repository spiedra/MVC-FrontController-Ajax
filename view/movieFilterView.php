<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="icon" type="image/svg+xml" href="public/images/main_icon.svg" sizes="16" />
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <title>Movie Store Online</title>
    <script type="text/javascript" src="public/js/jquery.js"></script>
    <script type="text/javascript" src="public/js/dynamicDropdownList.js"></script>
</head>

<body>

    <?php
    include_once 'header.php';
    ?>

    <main class="main">
        <section class="registration-section">
            <div class="registration-section__container">
                <h1 class="registration-section__tittle">Filter Movie</h1>
            </div>
            <article class="registration-section__form-article">
                <form class="registration-form" method="get" action="controller=Movie&action=exceuteQueryAccordingToButtonFilter">
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">Genres:</label>

                        <select id="selectGenres" class="form__select  select-css" name="genreSelected">
                            <option class="select_opcion" value="" selected>Choose any genre</option>
                            <?php
                            foreach ($vars['genreArray'] as $data) {
                            ?>
                                <option class="select_opcion" value="<?php echo $data[0] ?>"><?php echo $data[0] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">Actors:</label>
                        <select id="selectActors" class="form__select  select-css lolxd">
                            <option value="0" selected>Choose any actor</option>
                        </select>
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">Movies:</label>
                        <select id="selectMovie" class="form__select  select-css">
                            <option value="0" selected>Choose any movie</option>
                        </select>
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">Movie Information:</label>
                        <table class="form__table">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Language</th>
                                <th>Synopsis</th>
                            </tr>

                            <tr id="columnsMovieTable">
                            
                            </tr>
                        </table>
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">List actors by Movie:</label>
                        <table id="actorTable" class="form__table">

                        </table>
                    </div>

                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">List genres by Movie:</label>
                        <table id="genreTable" class="form__table">

                        </table>
                    </div>
                </form>
            </article>
        </section>
    </main>
</body>

</html>