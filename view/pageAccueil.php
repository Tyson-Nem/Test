<?php $title = 'Accueil'; ?>
<?php $css = 'assets/css/accueil.css'; ?>

<?php ob_start(); ?>

<div id="bann">
    <h1>"<?= $citation[$rand_keys]; ?>"</h1>
    <p><?= $poetes[$p_rand_keys]; ?></p>
</div>

<form method="POST">
    <input type="text" name="name" />
    <button type="submit" name="submit">Ajouter un Loosh</button>
</form>

<div id="loosh">
    <p>Mes Loosh</p>
    <hr />
</div>

<section>

    <?php
    if (!$tables->rowCount()) { ?>
    <p>Vous n'avez pas de tableau actif</p>
    <?php
    } else {
        while ($bool) { ?>
    <div class="dossprojet">
        <?php
                for ($i = 0; $i < 3; $i++) {
                    $data = $tables->fetch();
                    if (!$data) {
                        $bool = false;
                        break;
                    } ?>
        <div>
            <div class="projet"></div>
            <p><?= htmlspecialchars($data['nom_tableau']); ?></p>
        </div>
        <?php } ?>
    </div><?php
                }
            } ?>

</section>

<?php

$tables->closeCursor();
$content = ob_get_clean();
require('view/template.php');

?>