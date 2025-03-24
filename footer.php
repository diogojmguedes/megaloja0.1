<footer class="footer-custom">
    <div class="container footer-container">
        <div class="row footer-row">
            <!-- 📍 Mapa Interativo -->
            <div class="col-md-3 footer-location">
                <h5 class="footer-title">Localização</h5>
                <iframe 
                    class="footer-map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093724!2d-122.41941548468127!3d37.77492977975813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085809c2f2f2f2f%3A0x6f2cdecccd!2sMega%20Loja%20Borja%20Reis!5e0!3m2!1spt-PT!2spt!4v1679293722992"
                    width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>

            <!-- 📞 Contactos -->
            <div class="col-md-3 footer-contact">
                <h5 class="footer-title">Contactos</h5>
                <p class="footer-text"><strong>Telefone:</strong> +351 295 628 792</p>
                <p class="footer-text"><strong>Email:</strong> <a href="mailto:megaloja@borjareis.com" class="footer-link">megaloja@borjareis.com</a></p>
                <p class="footer-text"><strong>Endereço:</strong> Zona Industrial de Angra do Heroísmo, Lote 4 Dir, 9700-135 Angra do Heroísmo</p>
            </div>

            <!-- 🕒 Horários de Funcionamento -->
            <div class="col-md-3 footer-hours">
                <h5 class="footer-title">Horário de Funcionamento</h5>
                <ul class="list-unstyled footer-hours-list">
                    <p class="footer-text">🗓 Segunda a Sábado: 08:30 - 19:00</p>
                    <p class="footer-text">🗓 Domingos e Feriados: 14:00 - 19:00</p>
                </ul>
            </div>

            <!-- 📩 Newsletter -->
            <div class="col-md-3 footer-newsletter">
                <h5 class="footer-title">Newsletter</h5>
                <form id="newsletter-form" class="footer-form">
                    <input type="email" id="newsletter-email" class="form-control footer-input" placeholder="Digite o seu email..." required>
                    <button type="submit" class="btn btn-light w-100 footer-btn">Fique a par das nossas novidades</button>
                    <p id="newsletter-msg" class="mt-2 text-success d-none footer-success-msg">✅ Subscreveu com sucesso!</p>
                </form>
            </div>
        </div>

        <!-- 🔗 Links das Redes Sociais -->
        <div class="row mt-3 footer-social-row">
            <div class="col text-center footer-social">
                <a href="https://www.facebook.com/megaloja.pt" class="social-link footer-social-link" target="_blank" aria-label="Facebook">
                    <i class="fab fa-facebook fa-2x footer-social-icon"></i>
                </a>
                <a href="https://www.instagram.com/megalojaborjareis/" class="social-link footer-social-link" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram fa-2x footer-social-icon"></i>
                </a>
                <a href="https://wa.me/351912345678" class="social-link footer-social-link" target="_blank" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp fa-2x footer-social-icon"></i>
                </a>
            </div>
        </div>

        <p class="mt-3 text-center footer-copyright">&copy; 2025 Mega Loja Borja Reis - Todos os direitos reservados.</p>
    </div>

    <!-- Botão do Messenger -->
    <div class="messenger-button footer-messenger">
        <a href="https://m.me/MegaLojaBorjaReis" target="_blank" class="footer-messenger-link">
            <img src="imagens/messenger.jpg" alt="Abrir chat no Messenger" class="footer-messenger-img">
        </a>
    </div>
</footer>

<!-- 📩 Script para Newsletter -->
<script>
    document.getElementById('newsletter-form').addEventListener('submit', function(event) {
        event.preventDefault();
        document.getElementById('newsletter-msg').classList.remove('d-none');
        setTimeout(() => {
            document.getElementById('newsletter-msg').classList.add('d-none');
        }, 3000);
    });
</script>