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
                    <h1 class="registration-section__tittle">Register Movie Gender</h1>
                </div>
                <article class="registration-section__form-article">
                    <form class="registration-form" method="post" action="?controller=Genre&action=registerGenre">
                        <div class="container-registration__form">
                            <label class="form__label--registration" for="genreName">Genre Name:</label>
                            <input class="form__input--registration" name="genreName" />
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