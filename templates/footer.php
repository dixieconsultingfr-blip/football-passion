    </main>
    <footer class="bg-gray-900 border-t border-green-500 mt-16">
        <div class="max-w-6xl mx-auto px-4 py-10">

            <!-- Newsletter -->
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 mb-10 flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                <div class="flex-1 text-center sm:text-left">
                    <h3 class="text-white font-bold text-lg mb-1">📬 Ne ratez aucune actu</h3>
                    <p class="text-gray-400 text-sm">L1, L2, Champions League, Europa League, Équipe de France — directement par email.</p>
                </div>
                <form id="newsletter-form" class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true" />
                    <input type="email" name="email" required placeholder="votre@email.fr"
                           class="bg-gray-900 border border-gray-600 rounded px-4 py-2.5 text-sm text-white placeholder-gray-500 focus:outline-none focus:border-green-500 w-full sm:w-64" />
                    <button type="submit" class="bg-green-700 hover:bg-green-600 text-white text-sm font-semibold px-5 py-2.5 rounded transition-colors whitespace-nowrap">
                        S'abonner
                    </button>
                </form>
            </div>
            <p id="newsletter-msg" class="text-xs text-center -mt-6 mb-10 hidden"></p>
            <p class="text-gray-600 text-[11px] text-center -mt-8 mb-10">
                En vous inscrivant, vous acceptez notre <a href="/politique-confidentialite.php" class="hover:text-green-400 transition-colors underline">politique de confidentialité</a>. Désinscription possible à tout moment.
            </p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-green-400 font-bold mb-4 text-sm uppercase tracking-wider">Navigation</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/" class="hover:text-green-400 transition-colors">Accueil</a></li>
                        <li><a href="/calendrier.php" class="hover:text-green-400 transition-colors">Calendrier</a></li>
                        <li><a href="/archives.php" class="hover:text-green-400 transition-colors">Archives</a></li>
                        <li><a href="/blog" class="hover:text-green-400 transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-green-400 font-bold mb-4 text-sm uppercase tracking-wider">Compétitions</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/ligue-1.php" class="hover:text-green-400 transition-colors">Ligue 1</a></li>
                        <li><a href="/ligue-2.php" class="hover:text-green-400 transition-colors">Ligue 2</a></li>
                        <li><a href="/champions-league.php" class="hover:text-green-400 transition-colors">Champions League</a></li>
                        <li><a href="/europa-league.php" class="hover:text-green-400 transition-colors">Europa League</a></li>
                        <li><a href="/equipe-france.php" class="hover:text-green-400 transition-colors">Équipe de France</a></li>
                        <li><a href="/blog?cat=CDM" class="hover:text-green-400 transition-colors">Coupe du Monde</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-green-400 font-bold mb-4 text-sm uppercase tracking-wider">Réseaux</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="https://www.facebook.com/footballpassionfr/" target="_blank" rel="nofollow noopener noreferrer" class="hover:text-green-400 transition-colors">📘 Facebook</a></li>
                        <li><a href="https://www.instagram.com/cdm2026.info/" target="_blank" rel="nofollow noopener noreferrer" class="hover:text-green-400 transition-colors">📸 Instagram</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-green-400 font-bold mb-4 text-sm uppercase tracking-wider">À propos</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/a-propos.php" class="hover:text-green-400 transition-colors">À propos</a></li>
                        <li><a href="/mentions-legales.php" class="hover:text-green-400 transition-colors">Mentions légales</a></li>
                        <li><a href="/politique-confidentialite.php" class="hover:text-green-400 transition-colors">Politique de confidentialité</a></li>
                        <li><a href="/contact.php" class="hover:text-green-400 transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-500">&copy; 2026 Football Passion — <a href="https://www.dixie.consulting" target="_blank" rel="noopener noreferrer" class="hover:text-green-400 transition-colors">Dixie Consulting</a> · Jérôme Henry · Aubagne</p>
                <div class="flex gap-4 text-xs text-gray-600">
                    <a href="/mentions-legales.php" class="hover:text-gray-400 transition-colors">Mentions légales</a>
                    <span>·</span>
                    <a href="/politique-confidentialite.php" class="hover:text-gray-400 transition-colors">Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>
    <script>
    (function () {
        var form = document.getElementById('newsletter-form');
        var msg  = document.getElementById('newsletter-msg');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var btn = form.querySelector('button[type="submit"]');
            var originalLabel = btn.textContent;
            btn.disabled = true;
            btn.textContent = '...';

            fetch('/newsletter-subscribe.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(new FormData(form))
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                msg.classList.remove('hidden');
                if (data.ok) {
                    msg.textContent = 'Inscription réussie, merci !';
                    msg.className = 'text-xs text-center -mt-6 mb-10 text-green-400';
                    form.reset();
                } else {
                    msg.textContent = data.error || 'Une erreur est survenue.';
                    msg.className = 'text-xs text-center -mt-6 mb-10 text-red-400';
                }
            })
            .catch(function () {
                msg.classList.remove('hidden');
                msg.textContent = 'Une erreur est survenue, réessayez plus tard.';
                msg.className = 'text-xs text-center -mt-6 mb-10 text-red-400';
            })
            .finally(function () {
                btn.disabled = false;
                btn.textContent = originalLabel;
            });
        });
    })();
    </script>
</body>
</html>
