<?php $title = 'Connexion'; ?>
<?php $css = 'assets/css/connect.css'; ?>

<?php ob_start(); ?>
<!--Formulaire-->
<section>
    <h1>TRELOOSH</h1>

    <section id="sec">
        <div class="form">
            <h2>Déjà membre ?</h2>

            <form method="POST" id="formun">
                <div>
                    <label for="mail"></label>
                    <input type="email" placeholder="Adresse e-mail" name="mail" />
                </div>

                <div>
                    <label for="password"></label>
                    <input type="password" name="password" placeholder="Mot de passe" />
                </div>

                <label for="connect"></label>
                <button type="submit" value="Se connecter" name="connect">
                    Se connecter
                </button>
            </form>

            <a href="https://www.perdu.com">Mot de passe oublié ?</a>
        </div>

        <div class="form">
            <h2>Créer son compte</h2>

            <form method="POST">
                <label for="name"></label>
                <input type="text" name="name" placeholder="Nom" />

                <label for="firstname"></label>
                <input type="text" name="firstname" placeholder="Prénom" />

                <label for="mail"></label>
                <input type="email" placeholder="Adresse e-mail" name="mail" />

                <label for="password"></label>
                <input type="password" name="password" placeholder="Mot de passe" />

                <label for="repassword"></label>
                <input type="password" name="repassword" placeholder="Confirmer le mot de passe" />

                <button type="submit" value="Créer un compte" name="create">
                    Créer un compte
                </button>
            </form>
        </div>
    </section>

    <!--Image-->
    <div>
        <img src="assets/images/logo.png" alt="logo Treloosh" />
    </div>
</section>


<?php

$content = ob_get_clean();
require('view/template.php');

?>