<h2>Créer un rendez-vous</h2>
<form method="post" action="router.php?action=creerRdv">

    <label for="examinateur">Examinateur :</label>
    <select name="examinateur" id="examinateur" required>
        <?php foreach ($examinateurs as $exam): ?>
            <option value="<?= $exam['id'] ?>"><?= $exam['prenom'] . ' ' . $exam['nom'] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="datetime">Date et heure :</label>
    <input type="datetime-local" name="datetime" id="datetime" required>

    <input type="submit" value="Valider le rendez-vous">
</form>
