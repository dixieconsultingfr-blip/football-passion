<?php
// Clé publique Turnstile (safe à exposer en HTML)
// Créer sur https://dash.cloudflare.com/turnstile → domaine football-passion.fr
const TURNSTILE_SITE_KEY = '0x4AAAAAAEDqZ19uLzGwdbhT';

$page_title = 'Contact — Football Passion';
$meta_desc  = 'Contactez Football Passion pour toute question, correction ou demande relative à vos données personnelles.';

$status      = $_GET['status'] ?? '';
$sujetDefaut = $_GET['sujet']  ?? '';

include __DIR__ . '/templates/header.php';
?>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-8 flex items-center gap-2">
    <a href="/" class="hover:text-green-400 transition-colors">Accueil</a>
    <span>›</span>
    <span class="text-gray-400">Contact</span>
</nav>

<div class="max-w-xl mx-auto">

    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Contact</h1>
        <p class="text-gray-400 text-sm">Une question, une correction ou une demande RGPD ? On vous répond sous 48h.</p>
    </div>

    <!-- Alertes statut -->
    <?php if ($status === 'ok'): ?>
    <div class="mb-6 bg-green-900/40 border border-green-700 rounded-xl px-5 py-4 flex items-start gap-3">
        <span class="text-green-400 text-xl">✅</span>
        <div>
            <div class="text-green-400 font-semibold text-sm">Message envoyé !</div>
            <div class="text-gray-400 text-xs mt-1">Nous vous répondrons dans les meilleurs délais.</div>
        </div>
    </div>
    <?php elseif ($status === 'captcha'): ?>
    <div class="mb-6 bg-yellow-900/30 border border-yellow-700 rounded-xl px-5 py-4 flex items-start gap-3">
        <span class="text-yellow-400 text-xl">⚠️</span>
        <div>
            <div class="text-yellow-400 font-semibold text-sm">Vérification anti-robot échouée</div>
            <div class="text-gray-400 text-xs mt-1">Veuillez compléter le test de vérification et réessayer.</div>
        </div>
    </div>
    <?php elseif ($status === 'error'): ?>
    <div class="mb-6 bg-red-900/30 border border-red-700 rounded-xl px-5 py-4 flex items-start gap-3">
        <span class="text-red-400 text-xl">❌</span>
        <div>
            <div class="text-red-400 font-semibold text-sm">Formulaire invalide</div>
            <div class="text-gray-400 text-xs mt-1">Veuillez remplir tous les champs correctement.</div>
        </div>
    </div>
    <?php elseif ($status === 'flood'): ?>
    <div class="mb-6 bg-yellow-900/30 border border-yellow-700 rounded-xl px-5 py-4 flex items-start gap-3">
        <span class="text-yellow-400 text-xl">⏳</span>
        <div>
            <div class="text-yellow-400 font-semibold text-sm">Envoi trop fréquent</div>
            <div class="text-gray-400 text-xs mt-1">Merci de patienter 1 minute avant de renvoyer un message.</div>
        </div>
    </div>
    <?php elseif ($status === 'fail'): ?>
    <div class="mb-6 bg-red-900/30 border border-red-700 rounded-xl px-5 py-4 flex items-start gap-3">
        <span class="text-red-400 text-xl">❌</span>
        <div>
            <div class="text-red-400 font-semibold text-sm">Erreur d'envoi</div>
            <div class="text-gray-400 text-xs mt-1">L'envoi a échoué côté serveur. Réessayez dans quelques instants.</div>
        </div>
    </div>
    <?php endif; ?>

    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
        <div class="p-8">
            <?php if ($status !== 'ok'): ?>
            <form action="/contact-send.php" method="POST" novalidate>

                <!-- Honeypot -->
                <div style="display:none;" aria-hidden="true">
                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <!-- Nom -->
                <div class="mb-5">
                    <label for="nom" class="block text-gray-400 text-xs font-semibold uppercase tracking-wider mb-2">
                        Nom <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nom" name="nom"
                        required minlength="2" maxlength="80"
                        placeholder="Votre nom"
                        value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
                        class="w-full bg-gray-900 border border-gray-600 focus:border-green-500 rounded-lg px-4 py-3 text-white placeholder-gray-600 text-sm outline-none transition-colors">
                </div>

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block text-gray-400 text-xs font-semibold uppercase tracking-wider mb-2">
                        Votre e-mail <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email"
                        required maxlength="120"
                        placeholder="vous@exemple.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        class="w-full bg-gray-900 border border-gray-600 focus:border-green-500 rounded-lg px-4 py-3 text-white placeholder-gray-600 text-sm outline-none transition-colors">
                </div>

                <!-- Sujet -->
                <div class="mb-5">
                    <label for="sujet" class="block text-gray-400 text-xs font-semibold uppercase tracking-wider mb-2">
                        Sujet <span class="text-red-500">*</span>
                    </label>
                    <select id="sujet" name="sujet" required
                        class="w-full bg-gray-900 border border-gray-600 focus:border-green-500 rounded-lg px-4 py-3 text-white text-sm outline-none transition-colors appearance-none cursor-pointer">
                        <option value="" disabled <?= empty($sujetDefaut) ? 'selected' : '' ?>>Sélectionner un sujet…</option>
                        <?php foreach (['Question', 'Correction', 'Partenariat', 'Données personnelles', 'Autre'] as $s): ?>
                        <option value="<?= $s ?>" <?= ($sujetDefaut === $s) ? 'selected' : '' ?>><?= $s ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Message -->
                <div class="mb-6">
                    <label for="message" class="block text-gray-400 text-xs font-semibold uppercase tracking-wider mb-2">
                        Message <span class="text-red-500">*</span>
                    </label>
                    <textarea id="message" name="message"
                        required minlength="10" maxlength="2000"
                        rows="6"
                        placeholder="Votre message…"
                        class="w-full bg-gray-900 border border-gray-600 focus:border-green-500 rounded-lg px-4 py-3 text-white placeholder-gray-600 text-sm outline-none transition-colors resize-y"
                    ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    <div class="text-right text-gray-600 text-xs mt-1">2 000 caractères max</div>
                </div>

                <!-- Turnstile -->
                <div class="mb-6">
                    <div class="cf-turnstile"
                        data-sitekey="<?= htmlspecialchars(TURNSTILE_SITE_KEY) ?>"
                        data-theme="dark"
                        data-language="fr">
                    </div>
                    <p class="text-gray-600 text-xs mt-2">
                        🔒 Anti-robot par <a href="https://www.cloudflare.com/products/turnstile/" target="_blank" rel="nofollow noopener noreferrer" class="underline hover:text-gray-400 transition-colors">Cloudflare Turnstile</a> — respecte votre vie privée.
                    </p>
                </div>

                <!-- RGPD -->
                <div class="mb-6 bg-gray-900 rounded-lg border border-gray-700 px-4 py-3">
                    <p class="text-gray-500 text-xs leading-relaxed">
                        🔐 Vos données (nom, e-mail, message) sont utilisées uniquement pour répondre à votre demande.
                        Elles ne sont jamais cédées à des tiers.
                        <a href="/politique-confidentialite.php" class="text-green-500 hover:text-green-400 underline transition-colors">Politique de confidentialité →</a>
                    </p>
                </div>

                <!-- Bouton -->
                <button type="submit"
                    class="w-full bg-green-700 hover:bg-green-600 text-white font-bold uppercase tracking-wider px-6 py-3.5 rounded-lg transition-colors text-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Envoyer le message
                </button>

            </form>
            <?php else: ?>
            <div class="text-center py-8">
                <div class="text-5xl mb-4">✅</div>
                <h2 class="text-xl font-bold text-white mb-2">Merci pour votre message !</h2>
                <p class="text-gray-400 text-sm mb-6">Nous vous répondrons dans les meilleurs délais.</p>
                <a href="/" class="border border-green-700 text-green-400 hover:bg-green-700 hover:text-white px-6 py-2.5 text-sm font-semibold rounded transition-colors inline-block">
                    ← Retour à l'accueil
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php include __DIR__ . '/templates/footer.php'; ?>
