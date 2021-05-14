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
                <h1 class="registration-section__tittle">Search Movie</h1>
            </div>
            <article class="registration-section__form-article">
                <form class="registration-form" method="post" action="?controller=Movie&action=exceuteQueryAccordingToButtonSearch">
                    <input type="hidden" name="controller" value="Movie" />
                    <input type="hidden" name="action" value="exceuteQueryAccordingToButtonSearch" />
                    <div class="container-registration__form container-registration__form--delete">
                        <label class="form__label--registration" for="genreName">Movie Name:</label>
                        <input class="form__input--registration form__input--delete" name="movieName" />
                    </div>
                    <div class="container-registration__form">
                        <input class="form__input-button--registration" type="submit" value="Search by name" name="buttonSearchByName">
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">Genres:</label>

                        <select class="form__select  select-css" name="genreSelected">
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
                        <input class="form__input-button--registration" type="submit" value="Search by genre" name="buttonSearchByGenre">
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">List Movies:</label>
                        <table class="form__table">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Language</th>
                                <th>Synopsis</th>
                            </tr>

                            <?php
                            foreach ($vars['mainArray'] as $item) {
                                if (isset($item['movieArray'])) {
                                    foreach ($item['movieArray'] as $data) {
                            ?>
                                        <tr>
                                            <td><?php echo $data[0]; ?></td>
                                            <td><?php echo $data[1]; ?></td>
                                            <td><?php echo $data[2]; ?></td>
                                            <td><?php echo $data[3]; ?></td>
                                            <td><?php echo $data[4]; ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">List of genres by movie:</label>
                        <table class="form__table">
                            <tr>
                                <th>Genre</th>
                            </tr>

                            <?php
                            foreach ($vars['mainArray'] as $item) {
                                if (isset($item['genresByMovieArray'])) {
                                    foreach ($item['genresByMovieArray'] as $data) {
                            ?>
                                        <tr>
                                            <td><?php echo $data[0]; ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <div class="container-registration__form">
                        <label class="form__label--registration--cmbox">List of actors by movie:</label>
                        <table class="form__table">
                            <tr>
                                <th>Name</th>
                                <th>Last Name</th>
                            </tr>

                            <?php
                            foreach ($vars['mainArray'] as $item) {
                                if (isset($item['actorsByMovieArray'])) {
                                    foreach ($item['actorsByMovieArray'] as $data) {
                            ?>
                                        <tr>
                                            <td><?php echo $data[0]; ?></td>
                                            <td><?php echo $data[1]; ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </table>
                    </div>
                </form>
            </article>
        </section>
    </main>
</body>

</html>