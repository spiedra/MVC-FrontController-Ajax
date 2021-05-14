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
                    <h1 class="registration-section__tittle">Delete Movie</h1>
                </div>
                <article class="registration-section__form-article">
                    <form class="registration-form" method="post" action="index.php">
                        <input type="hidden" name="controller" value="Movie" />
                        <input type="hidden" name="action" value="exceuteQueryAccordingToButtonDelete" />
                        <div class="container-registration__form container-registration__form--delete">
                            <label class="form__label--registration" for="genreName">Movie Name:</label>
                            <input class="form__input--registration form__input--delete" name="movieName" />
                            <input class="form__input-button--registration" type="submit" value="Search" name="buttonSearch">
                        </div>
                        <div class="container-registration__form">
                            <label class="form__label--registration--cmbox">Select the movie to delete</label>
                            <select class="form__select  select-css" name="movieToDelete[]" multiple>
                                <?php
                                foreach ($vars['movieArray'] as $item) {
                                    ?>
                                    <option class="select_opcion" value="<?php echo $item[1] ?>"><?php echo $item[1] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            </select>
                        </div>
                        <div class="container-registration__form">
                            <input class="form__input-button--registration" type="submit" value="Delete" name="buttonDelete">
                        </div>
                    </form>
                </article>
            </section>
        </main>
    </body>

</html>