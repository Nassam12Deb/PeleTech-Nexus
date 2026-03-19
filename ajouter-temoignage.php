<?php include 'header.php'; ?>

<style>
    .testimonial-form {
        max-width: 700px;
        margin: 0 auto;
        padding: 2rem;
        background: rgba(18, 23, 42, 0.8);
        border-radius: var(--radius-xl);
        border: 1px solid var(--border);
    }
    .testimonial-form .form-group {
        margin-bottom: 1.5rem;
    }
    .testimonial-form label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--light);
        font-weight: 500;
    }
    .testimonial-form input,
    .testimonial-form textarea,
    .testimonial-form select {
        width: 100%;
        padding: 0.75rem 1rem;
        background: rgba(11, 16, 32, 0.6);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        color: var(--light);
        font-size: 1rem;
        transition: var(--transition);
    }
    .testimonial-form input:focus,
    .testimonial-form textarea:focus,
    .testimonial-form select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(138, 111, 232, 0.15);
    }
    .testimonial-form .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 0.5rem;
    }
    .testimonial-form .rating input {
        display: none;
    }
    .testimonial-form .rating label {
        font-size: 2rem;
        color: var(--gray);
        cursor: pointer;
        transition: color 0.2s;
    }
    .testimonial-form .rating input:checked ~ label,
    .testimonial-form .rating label:hover,
    .testimonial-form .rating label:hover ~ label {
        color: var(--primary);
    }
    .testimonial-form .btn {
        width: 100%;
        padding: 1rem;
    }
    .message {
        padding: 1rem;
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .message.success {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #10b981;
    }
    .message.error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }
</style>

<section class="container" style="padding: 4rem 2rem;">
    <h1 class="section-title"><?php echo $t['submit_testimonial_title']; ?></h1>
    <p class="section-subtitle"><?php echo $t['submit_testimonial_subtitle']; ?></p>

    <?php
    $message = '';
    $messageType = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $auteur   = trim($_POST['auteur'] ?? '');
        $fonction = trim($_POST['fonction'] ?? '');
        $texte    = trim($_POST['texte'] ?? '');
        $note     = (int)($_POST['note'] ?? 5);
        $erreurs = [];

        // Validation
        if (strlen($auteur) < 2) {
            $erreurs[] = "Le nom doit contenir au moins 2 caractères.";
        }
        if (strlen($texte) < 10) {
            $erreurs[] = "Le témoignage doit contenir au moins 10 caractères.";
        }
        if ($note < 1 || $note > 5) {
            $note = 5;
        }

        // Upload photo (optionnel)
        $photo = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileType = $_FILES['photo']['type'];
            if (in_array($fileType, $allowed)) {
                $uploadDir = __DIR__ . '/assets/img/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $fileName = 'testimonial_' . uniqid() . '.' . $extension;
                $uploadFile = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                    $photo = 'assets/img/uploads/' . $fileName;
                } else {
                    $erreurs[] = "Erreur lors de l'upload de la photo.";
                }
            } else {
                $erreurs[] = "Format de photo non autorisé (JPEG, PNG, GIF, WEBP uniquement).";
            }
        }

        if (empty($erreurs)) {
            // Insertion en base avec statut 'en_attente'
            $stmt = $pdo->prepare("INSERT INTO temoignages (auteur, fonction, photo, texte, note, statut, ordre) VALUES (?, ?, ?, ?, ?, 'en_attente', 0)");
            if ($stmt->execute([$auteur, $fonction, $photo, $texte, $note])) {
                $message = "Merci pour votre témoignage ! Il sera publié après validation par nos équipes.";
                $messageType = 'success';
            } else {
                $message = "Une erreur est survenue. Veuillez réessayer.";
                $messageType = 'error';
            }
        } else {
            $message = implode('<br>', $erreurs);
            $messageType = 'error';
        }
    }
    ?>

    <?php if ($message): ?>
        <div class="message <?php echo $messageType; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="testimonial-form">
        <div class="form-group">
            <label for="auteur"><?php echo $t['your_name']; ?></label>
            <input type="text" id="auteur" name="auteur" required value="<?php echo htmlspecialchars($_POST['auteur'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="fonction"><?php echo $t['your_function']; ?></label>
            <input type="text" id="fonction" name="fonction" value="<?php echo htmlspecialchars($_POST['fonction'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="photo"><?php echo $t['your_photo']; ?></label>
            <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/gif,image/webp">
        </div>

        <div class="form-group">
            <label for="texte"><?php echo $t['your_testimonial']; ?></label>
            <textarea id="texte" name="texte" rows="5" required><?php echo htmlspecialchars($_POST['texte'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label><?php echo $t['your_rating']; ?></label>
            <div class="rating">
                <input type="radio" name="note" value="5" id="star5" <?php echo (($_POST['note'] ?? 5) == 5) ? 'checked' : ''; ?>><label for="star5">★</label>
                <input type="radio" name="note" value="4" id="star4" <?php echo (($_POST['note'] ?? 5) == 4) ? 'checked' : ''; ?>><label for="star4">★</label>
                <input type="radio" name="note" value="3" id="star3" <?php echo (($_POST['note'] ?? 5) == 3) ? 'checked' : ''; ?>><label for="star3">★</label>
                <input type="radio" name="note" value="2" id="star2" <?php echo (($_POST['note'] ?? 5) == 2) ? 'checked' : ''; ?>><label for="star2">★</label>
                <input type="radio" name="note" value="1" id="star1" <?php echo (($_POST['note'] ?? 5) == 1) ? 'checked' : ''; ?>><label for="star1">★</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><?php echo $t['submit']; ?></button>
    </form>
</section>

<?php include 'footer.php'; ?>