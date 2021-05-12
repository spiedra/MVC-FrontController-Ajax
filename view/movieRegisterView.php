<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link rel="icon" type="image/svg+xml" href="public/images/main_icon.svg" sizes="16" />
        <link rel="stylesheet" type="text/css" href="public/css/style.css" />
        <title>Movie Store Online</title>
    </head>

    <body>
        <?php
        include_once 'header.php';
        ?>

        <main class="main">
            <section class="registration-section">
                <div class="registration-section__container">
                    <h1 class="registration-section__tittle">Register Movie</h1>
                </div>
                <article class="registration-section__form-article">
                    <form class="registration-form" method="get" action="index.php">
                        <input type="hidden" name="controller" value="Movie" />
                        <input type="hidden" name="action" value="registerMovie" />
                        <div class="container-registration__form">
                            <label class="form__label--registration" >Code:</label>
                            <input class="form__input--registration" name="movieCode" />
                        </div>
                        <div class="container-registration__form">
                            <label class="form__label--registration">Name:</label>
                            <input class="form__input--registration" name="movieName" />
                        </div>
                        <div class="container-registration__form">
                            <label class="form__label--registration">Duration:</label>
                            <input class="form__input--registration" name="movieDuration" />
                        </div>
                        <div class="container-registration__form">
                            <label class="form__label--registration">Language:</label>
                            <input class="form__input--registration" name="movieLanguage" />
                        </div>
                        <div class="container-registration__form">
                            <label class="form__label--registration--cmbox">Genres | Select one or more
                                options with <b>Crtl</b></label>
                            <select class="form__select  select-css" name="genreSelected[]" multiple>
                                <?php
                                foreach ($vars['mainArray'] as $item) {
                                    foreach ($item['genreArray'] as $data) {
                                        ?>
                                        <option class="select_opcion" value="<?php echo $data[0] ?>"><?php echo $data[0] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="container-registration__form">
                            <label class="form__label--registration--cmbox">Actors | Select one or more
                                options with <b>Crtl</b></label>
                            <select class="form__select  select-css" name="actorselected[]" multiple>
                                <?php
                                foreach ($vars['mainArray'] as $item) {
                                    foreach ($item['actorArray'] as $data) {
                                        ?>
                                        <option class="select_opcion" value="<?php echo $data[1] . ' ' . $data[2] ?>"><?php echo $data[1] . ' ' . $data[2] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="container-registration__form">
                            <label class="form__label--registration" for="movieSynopsis">Synopsis:</label>
                            <textarea class="form__input--registration--txta" name="movieSynopsis"></textarea>
                        </div>
                        <div class="container-registration__form">
                            <input class="form__input-button--registration" type="submit">
                        </div>
                    </form>
                </article>
            </section>
        </main>
    </body>

</html>