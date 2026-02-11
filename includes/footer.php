<?php
// includes/footer.php
?>
    <footer class="footer">
        <div class="container">
            <div class="footer-grid" style="grid-template-columns: 1.5fr 1fr 1fr 1.2fr;">
                <div class="footer-brand">
                    <div class="logo" style="margin-bottom: 2rem;">
                        <div class="logo-text">
                            <span class="logo-settat" style="color: var(--accent-orange); font-size: 0.9rem;">UNIQUE LEARN</span>
                        </div>
                    </div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.8; font-size: 1rem;">
                        L'excellence académique à votre portée. Nous formons les experts qui façonneront le monde de demain avec passion et innovation.
                    </p>
                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>

                <div class="footer-nav">
                    <h4 class="footer-title" style="font-size: 1.2rem; margin-bottom: 2rem; border-bottom: 2px solid var(--accent-orange); display: inline-block; padding-bottom: 5px;">Navigation</h4>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 10px; color: var(--accent-orange);"></i> Accueil</a></li>
                        <li><a href="formations.php"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 10px; color: var(--accent-orange);"></i> Nos Formations</a></li>
                        <li><a href="inscription.php"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 10px; color: var(--accent-orange);"></i> S'inscrire</a></li>
                    </ul>
                </div>

                <div class="footer-nav">
                    <h4 class="footer-title" style="font-size: 1.2rem; margin-bottom: 2rem; border-bottom: 2px solid var(--accent-orange); display: inline-block; padding-bottom: 5px;">Légal</h4>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 10px; color: var(--accent-orange);"></i> Confidentialité</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 10px; color: var(--accent-orange);"></i> Conditions</a></li>
                        <li><a href="login.php"><i class="fas fa-lock" style="font-size: 0.8rem; margin-right: 10px; color: var(--accent-orange);"></i> Admin</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4 class="footer-title" style="font-size: 1.2rem; margin-bottom: 2rem; border-bottom: 2px solid var(--accent-orange); display: inline-block; padding-bottom: 5px;">Contact</h4>
                    <div style="margin-bottom: 1rem; display: flex; align-items: flex-start; gap: 1rem;">
                        <i class="fas fa-location-dot" style="color: var(--accent-orange); margin-top: 5px;"></i>
                        <span style="color: rgba(255,255,255,0.7);">Campus Central, <br>Settat, Maroc</span>
                    </div>
                    <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-phone" style="color: var(--accent-orange);"></i>
                        <span style="color: rgba(255,255,255,0.7);">+212 5 23 40 12 34</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-envelope" style="color: var(--accent-orange);"></i>
                        <span style="color: rgba(255,255,255,0.7);">contact@uniquelearn.ma</span>
                    </div>
                </div>
            </div>

            <style>
                .social-icon {
                    width: 40px;
                    height: 40px;
                    background: rgba(255,255,255,0.1);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: var(--transition);
                }
                .social-icon:hover {
                    background: var(--accent-orange);
                    transform: translateY(-5px);
                }
            </style>

            <div class="footer-bottom" style="margin-top: 5rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); text-align: center;">
                <p style="color: rgba(255,255,255,0.5); font-weight: 500;">&copy; <?php echo date('Y'); ?> <span style="color: white; font-weight: 700;">UNIQUE LEARN</span>. Crafted with Excellence for Settat Visionaries.</p>
            </div>
        </div>
    </footer>
    <script src="js/validation.js"></script>
</body>
</html>
