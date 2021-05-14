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
                    <h1 class="registration-section__tittle">Update Movie</h1>
                </div>
                <article class="registration-section__form-article">
                    <form class="registration-form" method="post" action="?controller=Movie&action=modifyMovie">
                        <input type="hidden" name="controller" value="Movie" />
                        <input type="hidden" name="action" value="modifyMovie" />
                        <div class="container-registration__form">
                            <label class="form__label--registration" >Movie code update:</label>
                            <input class="form__input--registration" name="movieCode" />
                        </div>
                        <h2 class="registration-section__tittle">To be modify</h2>
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
                            <label class="form__label--registration" for="movieSynopsis">Synopsis:</label>
                            <textarea class="form__input--registration--txta" name="movieSynopsis"></textarea>
                        </div>
                        <div class="container-registration__form">
                            <input class="form__input-button--registration" type="submit" value="Modify">
                        </div>
                    </form>
                </article>
            </section>
        </main>
    </body>

</html>