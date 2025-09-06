<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPTV Player - Netflix Style</title>
    <style>
        :root {
            --netflix-black: #141414;
            --netflix-red: #e50914;
            --netflix-dark-gray: #222222;
            --netflix-gray: #333333;
            --netflix-light-gray: #b3b3b3;
            --netflix-white: #ffffff;
            --netflix-hover: rgba(255, 255, 255, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--netflix-black);
            color: var(--netflix-white);
            overflow-x: hidden;
            line-height: 1.4;
        }

        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: linear-gradient(180deg, rgba(0,0,0,0.7) 10%, transparent);
            padding: 15px 4%;
            transition: var(--transition);
        }

        .header.scrolled {
            background: var(--netflix-black);
            box-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--netflix-red);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-links a {
            color: var(--netflix-white);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--netflix-light-gray);
        }

        .search-container {
            position: relative;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-input {
            background: rgba(0,0,0,0.7);
            border: 1px solid var(--netflix-gray);
            border-radius: 4px;
            padding: 8px 15px;
            color: var(--netflix-white);
            font-size: 0.9rem;
            width: 250px;
            transition: var(--transition);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--netflix-white);
            background: rgba(0,0,0,0.9);
        }

        .theme-toggle {
            background: none;
            border: 1px solid var(--netflix-gray);
            color: var(--netflix-white);
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition);
        }

        .theme-toggle:hover {
            border-color: var(--netflix-white);
            background: var(--netflix-hover);
        }

        /* Main Content */
        .main-content {
            margin-top: 70px;
            min-height: 100vh;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 80vh;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.7)), 
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23333" width="1200" height="600"/><text x="50%" y="50%" text-anchor="middle" dy=".3em" fill="%23666" font-size="48" font-family="Arial">Player de Vídeo</text></svg>');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding: 0 4%;
        }

        .hero-content {
            max-width: 500px;
            z-index: 2;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }

        .hero-description {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: var(--netflix-light-gray);
            text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--netflix-white);
            color: var(--netflix-black);
        }

        .btn-primary:hover {
            background: rgba(255,255,255,0.8);
        }

        .btn-secondary {
            background: rgba(109,109,110,0.7);
            color: var(--netflix-white);
        }

        .btn-secondary:hover {
            background: rgba(109,109,110,0.4);
        }

        /* URL Input Section */
        .url-section {
            padding: 30px 4%;
            background: var(--netflix-dark-gray);
            border-bottom: 1px solid var(--netflix-gray);
        }

        .url-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .url-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--netflix-white);
        }

        .url-form {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .url-input {
            flex: 1;
            min-width: 300px;
            padding: 15px 20px;
            background: var(--netflix-black);
            border: 1px solid var(--netflix-gray);
            border-radius: 4px;
            color: var(--netflix-white);
            font-size: 1rem;
        }

        .url-input:focus {
            outline: none;
            border-color: var(--netflix-red);
        }

        .load-btn {
            background: var(--netflix-red);
            color: var(--netflix-white);
            padding: 15px 30px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .load-btn:hover {
            background: #b8070f;
        }

        .load-btn:disabled {
            background: var(--netflix-gray);
            cursor: not-allowed;
        }

        /* Loading Indicator */
        .loading-container {
            display: none;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--netflix-gray);
            border-top: 3px solid var(--netflix-red);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Content Sections */
        .content-section {
            padding: 40px 4% 20px;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--netflix-white);
        }

        /* Channel Grid */
        .channels-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 40px;
        }

        .channel-card {
            background: var(--netflix-dark-gray);
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            aspect-ratio: 16/9;
        }

        .channel-card:hover {
            transform: scale(1.05);
            z-index: 10;
            box-shadow: 0 10px 30px rgba(0,0,0,0.6);
        }

        .channel-thumbnail {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--netflix-gray), var(--netflix-dark-gray));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .channel-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .channel-placeholder {
            font-size: 2rem;
            color: var(--netflix-light-gray);
        }

        .channel-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            padding: 15px;
            transform: translateY(100%);
            transition: var(--transition);
        }

        .channel-card:hover .channel-info {
            transform: translateY(0);
        }

        .channel-name {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .channel-group {
            font-size: 0.8rem;
            color: var(--netflix-light-gray);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0,0,0,0.7);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .channel-card:hover .play-overlay {
            opacity: 1;
        }

        .play-icon {
            color: var(--netflix-white);
            font-size: 1.5rem;
            margin-left: 3px;
        }

        /* Carousel */
        .carousel-container {
            position: relative;
            margin-bottom: 40px;
        }

        .carousel {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 10px 0;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .carousel::-webkit-scrollbar {
            display: none;
        }

        .carousel-item {
            flex: 0 0 200px;
            height: 112px;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.7);
            border: none;
            color: var(--netflix-white);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            transition: var(--transition);
            z-index: 5;
        }

        .carousel-nav:hover {
            background: rgba(0,0,0,0.9);
        }

        .carousel-nav.prev {
            left: -20px;
        }

        .carousel-nav.next {
            right: -20px;
        }

        /* Video Player Modal */
        .video-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .video-container {
            position: relative;
            width: 90%;
            max-width: 1200px;
            aspect-ratio: 16/9;
            background: #000;
            border-radius: 8px;
            overflow: hidden;
        }

        .video-player {
            width: 100%;
            height: 100%;
        }

        .close-btn {
            position: absolute;
            top: -50px;
            right: 0;
            background: none;
            border: none;
            color: var(--netflix-white);
            font-size: 2rem;
            cursor: pointer;
            padding: 10px;
        }

        .video-info {
            position: absolute;
            bottom: -80px;
            left: 0;
            right: 0;
            color: var(--netflix-white);
        }

        .video-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .video-description {
            color: var(--netflix-light-gray);
            line-height: 1.5;
        }

        /* Filters */
        .filters-container {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-select {
            background: var(--netflix-dark-gray);
            border: 1px solid var(--netflix-gray);
            color: var(--netflix-white);
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--netflix-red);
        }

        /* WhatsApp Section */
        .whatsapp-section {
            background: var(--netflix-dark-gray);
            border: 1px solid #25d366;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 4%;
        }

        .whatsapp-title {
            color: #25d366;
            font-size: 1.2rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .whatsapp-message {
            width: 100%;
            background: var(--netflix-black);
            border: 1px solid var(--netflix-gray);
            color: var(--netflix-white);
            padding: 12px 15px;
            border-radius: 4px;
            resize: vertical;
            min-height: 80px;
            margin-bottom: 15px;
            font-family: inherit;
        }

        .whatsapp-btn {
            background: #25d366;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .whatsapp-btn:hover {
            background: #128c7e;
        }

        /* Templates */
        .templates-section {
            padding: 40px 4%;
            background: var(--netflix-dark-gray);
        }

        .templates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .template-card {
            background: var(--netflix-black);
            border: 1px solid var(--netflix-gray);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .template-card:hover {
            border-color: var(--netflix-red);
            transform: translateY(-5px);
        }

        .template-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .template-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .template-description {
            color: var(--netflix-light-gray);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .search-input {
                width: 200px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .channels-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 10px;
            }

            .carousel-item {
                flex: 0 0 150px;
                height: 84px;
            }

            .url-form {
                flex-direction: column;
            }

            .url-input {
                min-width: 100%;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--netflix-red);
            color: var(--netflix-white);
            padding: 15px 20px;
            border-radius: 4px;
            z-index: 3000;
            transform: translateX(100%);
            transition: var(--transition);
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background: #00b894;
        }

        .notification.error {
            background: #ee5a24;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--netflix-light-gray);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .empty-state-description {
            font-size: 1rem;
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header" id="header">
        <nav class="nav">
            <a href="#" class="logo">IPTV Player</a>
            <ul class="nav-links">
                <li><a href="#" class="active">Início</a></li>
                <li><a href="#channels">Canais</a></li>
                <li><a href="#favorites">Favoritos</a></li>
                <li><a href="#history">Histórico</a></li>
            </ul>
            <div class="search-container">
                <input type="text" class="search-input" id="globalSearch" placeholder="Buscar canais...">
                <button class="theme-toggle" id="themeToggle">🌙</button>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">Seu Player IPTV</h1>
                <p class="hero-description">Assista seus canais favoritos com qualidade e estilo Netflix. Carregue sua lista M3U e desfrute da melhor experiência.</p>
                <div class="hero-buttons">
                    <button class="btn btn-primary" onclick="scrollToUrlSection()">
                        ▶️ Começar Agora
                    </button>
                    <button class="btn btn-secondary" onclick="showInfo()">
                        ℹ️ Mais Informações
                    </button>
                </div>
            </div>
        </section>

        <!-- URL Input Section -->
        <section class="url-section" id="urlSection">
            <div class="url-container">
                <h2 class="url-title">Carregar Lista M3U ou Stream</h2>
                <div class="url-form">
                    <input type="text" class="url-input" id="urlInput" 
                           placeholder="Cole aqui a URL da sua lista M3U ou stream direto (.ts, .mp4, etc.)">
                    <button class="load-btn" id="loadBtn" onclick="loadContent()">Carregar</button>
                </div>
                <div class="loading-container" id="loadingContainer">
                    <div class="loading-spinner"></div>
                    <span style="margin-left: 15px;">Carregando...</span>
                </div>
            </div>
        </section>

        <!-- Continue Watching -->
        <section class="content-section" id="continueWatching" style="display: none;">
            <h2 class="section-title">Continue Assistindo</h2>
            <div class="carousel-container">
                <div class="carousel" id="continueCarousel"></div>
                <button class="carousel-nav prev" onclick="scrollCarousel('continueCarousel', -1)">‹</button>
                <button class="carousel-nav next" onclick="scrollCarousel('continueCarousel', 1)">›</button>
            </div>
        </section>

        <!-- Channels Section -->
        <section class="content-section" id="channelsSection" style="display: none;">
            <div class="filters-container">
                <select class="filter-select" id="groupFilter">
                    <option value="">Todas as Categorias</option>
                </select>
                <select class="filter-select" id="sortFilter">
                    <option value="name">Ordenar por Nome</option>
                    <option value="group">Ordenar por Categoria</option>
                    <option value="recent">Mais Recentes</option>
                </select>
                <span id="channelCount" style="color: var(--netflix-light-gray); margin-left: auto;"></span>
            </div>
            
            <h2 class="section-title" id="channelsTitle">Todos os Canais</h2>
            <div class="channels-grid" id="channelsGrid"></div>
            
            <!-- Load More Button -->
            <div style="text-align: center; margin-top: 30px;">
                <button class="btn btn-secondary" id="loadMoreBtn" onclick="loadMoreChannels()" style="display: none;">
                    Carregar Mais Canais
                </button>
            </div>
        </section>

        <!-- Popular Channels -->
        <section class="content-section" id="popularSection" style="display: none;">
            <h2 class="section-title">Canais Populares</h2>
            <div class="carousel-container">
                <div class="carousel" id="popularCarousel"></div>
                <button class="carousel-nav prev" onclick="scrollCarousel('popularCarousel', -1)">‹</button>
                <button class="carousel-nav next" onclick="scrollCarousel('popularCarousel', 1)">›</button>
            </div>
        </section>

        <!-- Empty State -->
        <section class="empty-state" id="emptyState">
            <div class="empty-state-icon">📺</div>
            <h3 class="empty-state-title">Nenhum conteúdo carregado</h3>
            <p class="empty-state-description">
                Cole a URL da sua lista M3U ou stream direto no campo acima para começar a assistir seus canais favoritos.
            </p>
        </section>
    </main>

    <!-- WhatsApp Section -->
    <section class="whatsapp-section">
        <h3 class="whatsapp-title">
            📱 Compartilhar no WhatsApp
        </h3>
        <textarea class="whatsapp-message" id="whatsappMessage" 
                  placeholder="Digite sua mensagem personalizada...">🎬 Confira este incrível player IPTV! Assista seus canais favoritos com qualidade Netflix. 

🔗 Link: [URL será inserida automaticamente]

#IPTV #Streaming #Entretenimento</textarea>
        <button class="whatsapp-btn" onclick="shareWhatsApp()">
            📱 Compartilhar no WhatsApp
        </button>
    </section>

    <!-- Templates Section -->
    <section class="templates-section">
        <h2 class="section-title" style="text-align: center; margin-bottom: 30px;">Templates Disponíveis</h2>
        <div class="templates-grid">
            <div class="template-card" onclick="loadTemplate('sports')">
                <div class="template-icon">⚽</div>
                <h3 class="template-title">Template Esportes</h3>
                <p class="template-description">Lista otimizada para canais de esportes com categorização automática</p>
            </div>
            <div class="template-card" onclick="loadTemplate('movies')">
                <div class="template-icon">🎬</div>
                <h3 class="template-title">Template Filmes</h3>
                <p class="template-description">Interface focada em canais de filmes e séries com preview automático</p>
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div class="video-modal" id="videoModal">
        <div class="video-container">
            <button class="close-btn" onclick="closeVideo()">×</button>
            <video class="video-player" id="videoPlayer" controls autoplay>
                Seu navegador não suporta o elemento de vídeo.
            </video>
            <div class="video-info">
                <h3 class="video-title" id="videoTitle"></h3>
                <p class="video-description" id="videoDescription"></p>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div class="notification" id="notification"></div>

    <script>
        class IPTVPlayer {
            constructor() {
                this.channels = [];
                this.filteredChannels = [];
                this.currentChannel = null;
                this.favorites = JSON.parse(localStorage.getItem('iptv_favorites') || '[]');
                this.history = JSON.parse(localStorage.getItem('iptv_history') || '[]');
                this.urlHistory = JSON.parse(localStorage.getItem('iptv_url_history') || '[]');
                this.channelsPerPage = 50;
                this.currentPage = 0;
                this.isLoading = false;
                this.cache = new Map();
                
                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupScrollHeader();
                this.loadFromCache();
                this.updateUI();
            }

            setupEventListeners() {
                // Global search
                document.getElementById('globalSearch').addEventListener('input', (e) => {
                    this.searchChannels(e.target.value);
                });

                // Filters
                document.getElementById('groupFilter').addEventListener('change', (e) => {
                    this.filterByGroup(e.target.value);
                });

                document.getElementById('sortFilter').addEventListener('change', (e) => {
                    this.sortChannels(e.target.value);
                });

                // URL input enter key
                document.getElementById('urlInput').addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.loadContent();
                    }
                });

                // Theme toggle
                document.getElementById('themeToggle').addEventListener('click', () => {
                    this.toggleTheme();
                });

                // Escape key to close video
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeVideo();
                    }
                });
            }

            setupScrollHeader() {
                let lastScrollY = window.scrollY;
                
                window.addEventListener('scroll', () => {
                    const header = document.getElementById('header');
                    const currentScrollY = window.scrollY;
                    
                    if (currentScrollY > 100) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                    
                    lastScrollY = currentScrollY;
                });
            }

            async loadContent() {
                const url = document.getElementById('urlInput').value.trim();
                if (!url) {
                    this.showNotification('Por favor, insira uma URL válida', 'error');
                    return;
                }

                this.showLoading(true);
                this.saveUrlToHistory(url);

                try {
                    // Check cache first
                    if (this.cache.has(url)) {
                        const cachedData = this.cache.get(url);
                        this.channels = cachedData.channels;
                        this.processChannels();
                        this.showNotification('Lista carregada do cache!', 'success');
                        return;
                    }

                    // Determine if it's M3U or direct stream
                    if (this.isM3UUrl(url)) {
                        await this.loadM3UList(url);
                    } else {
                        await this.loadDirectStream(url);
                    }

                } catch (error) {
                    console.error('Erro ao carregar conteúdo:', error);
                    this.showNotification('Erro ao carregar conteúdo: ' + error.message, 'error');
                } finally {
                    this.showLoading(false);
                }
            }

            isM3UUrl(url) {
                return url.toLowerCase().includes('.m3u') || 
                       url.toLowerCase().includes('get.php') ||
                       url.toLowerCase().includes('playlist');
            }

            async loadM3UList(url) {
                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                    }
                    
                    const content = await response.text();
                    
                    // Use Web Worker for parsing large M3U files
                    if (content.length > 100000) { // 100KB threshold
                        this.channels = await this.parseM3UWithWorker(content);
                    } else {
                        this.channels = this.parseM3UContent(content);
                    }
                    
                    if (this.channels.length === 0) {
                        throw new Error('Nenhum canal encontrado na lista M3U');
                    }
                    
                    // Cache the result
                    this.cache.set(url, { channels: this.channels, timestamp: Date.now() });
                    
                    // Log to backend
                    this.logUrlToBackend(url, `Lista M3U - ${this.channels.length} canais`, true, this.channels.length);
                    
                    this.processChannels();
                    this.showNotification(`${this.channels.length} canais carregados com sucesso!`, 'success');
                    
                } catch (error) {
                    throw new Error('Erro ao carregar lista M3U: ' + error.message);
                }
            }

            async parseM3UWithWorker(content) {
                return new Promise((resolve, reject) => {
                    // Fallback to regular parsing if Web Workers not supported
                    if (!window.Worker) {
                        resolve(this.parseM3UContent(content));
                        return;
                    }

                    const workerCode = `
                        self.onmessage = function(e) {
                            const content = e.data;
                            const channels = [];
                            const lines = content.split('\\n');
                            let currentChannel = null;
                            
                            for (let i = 0; i < lines.length; i++) {
                                const line = lines[i].trim();
                                
                                if (line.startsWith('#EXTINF:')) {
                                    currentChannel = {
                                        id: channels.length + 1,
                                        name: '',
                                        group: 'Geral',
                                        logo: '',
                                        url: ''
                                    };
                                    
                                    // Extract channel name
                                    const nameMatch = line.match(/,(.+)$/);
                                    if (nameMatch) {
                                        currentChannel.name = nameMatch[1].trim();
                                    }
                                    
                                    // Extract group
                                    const groupMatch = line.match(/group-title="([^"]+)"/i);
                                    if (groupMatch) {
                                        currentChannel.group = groupMatch[1];
                                    }
                                    
                                    // Extract logo
                                    const logoMatch = line.match(/tvg-logo="([^"]+)"/i);
                                    if (logoMatch) {
                                        currentChannel.logo = logoMatch[1];
                                    }
                                    
                                } else if (line && !line.startsWith('#') && currentChannel) {
                                    currentChannel.url = line;
                                    if (currentChannel.name && currentChannel.url) {
                                        channels.push(currentChannel);
                                    }
                                    currentChannel = null;
                                }
                            }
                            
                            self.postMessage(channels);
                        };
                    `;

                    const blob = new Blob([workerCode], { type: 'application/javascript' });
                    const worker = new Worker(URL.createObjectURL(blob));
                    
                    worker.onmessage = (e) => {
                        worker.terminate();
                        URL.revokeObjectURL(blob);
                        resolve(e.data);
                    };
                    
                    worker.onerror = (error) => {
                        worker.terminate();
                        URL.revokeObjectURL(blob);
                        reject(error);
                    };
                    
                    worker.postMessage(content);
                });
            }

            parseM3UContent(content) {
                const channels = [];
                const lines = content.split('\n');
                let currentChannel = null;
                
                for (let i = 0; i < lines.length; i++) {
                    const line = lines[i].trim();
                    
                    if (line.startsWith('#EXTINF:')) {
                        currentChannel = {
                            id: channels.length + 1,
                            name: '',
                            group: 'Geral',
                            logo: '',
                            url: ''
                        };
                        
                        // Extract channel name
                        const nameMatch = line.match(/,(.+)$/);
                        if (nameMatch) {
                            currentChannel.name = nameMatch[1].trim();
                        }
                        
                        // Extract group
                        const groupMatch = line.match(/group-title="([^"]+)"/i);
                        if (groupMatch) {
                            currentChannel.group = groupMatch[1];
                        }
                        
                        // Extract logo
                        const logoMatch = line.match(/tvg-logo="([^"]+)"/i);
                        if (logoMatch) {
                            currentChannel.logo = logoMatch[1];
                        }
                        
                    } else if (line && !line.startsWith('#') && currentChannel) {
                        currentChannel.url = line;
                        if (currentChannel.name && currentChannel.url) {
                            channels.push(currentChannel);
                        }
                        currentChannel = null;
                    }
                }
                
                return channels;
            }

            async loadDirectStream(url) {
                // Create a single channel for direct stream
                this.channels = [{
                    id: 1,
                    name: 'Stream Direto',
                    group: 'Streams',
                    logo: '',
                    url: url
                }];
                
                // Log to backend
                this.logUrlToBackend(url, 'Stream Direto', false, 1);
                
                this.processChannels();
                this.showNotification('Stream carregado com sucesso!', 'success');
            }

            processChannels() {
                this.filteredChannels = [...this.channels];
                this.currentPage = 0;
                this.updateGroupFilter();
                this.renderChannels();
                this.updateUI();
                this.scrollToChannels();
            }

            updateGroupFilter() {
                const groups = [...new Set(this.channels.map(ch => ch.group))].sort();
                const groupFilter = document.getElementById('groupFilter');
                
                groupFilter.innerHTML = '<option value="">Todas as Categorias</option>';
                groups.forEach(group => {
                    const option = document.createElement('option');
                    option.value = group;
                    option.textContent = group;
                    groupFilter.appendChild(option);
                });
            }

            renderChannels() {
                const grid = document.getElementById('channelsGrid');
                const startIndex = this.currentPage * this.channelsPerPage;
                const endIndex = startIndex + this.channelsPerPage;
                const channelsToShow = this.filteredChannels.slice(0, endIndex);
                
                if (this.currentPage === 0) {
                    grid.innerHTML = '';
                }
                
                const newChannels = this.filteredChannels.slice(startIndex, endIndex);
                
                newChannels.forEach(channel => {
                    const channelCard = this.createChannelCard(channel);
                    grid.appendChild(channelCard);
                });
                
                // Update load more button
                const loadMoreBtn = document.getElementById('loadMoreBtn');
                if (endIndex < this.filteredChannels.length) {
                    loadMoreBtn.style.display = 'block';
                } else {
                    loadMoreBtn.style.display = 'none';
                }
                
                // Update channel count
                document.getElementById('channelCount').textContent = 
                    `${channelsToShow.length} de ${this.filteredChannels.length} canais`;
            }

            createChannelCard(channel) {
                const card = document.createElement('div');
                card.className = 'channel-card fade-in';
                card.onclick = () => this.playChannel(channel);
                
                const isFavorite = this.favorites.includes(channel.id);
                
                card.innerHTML = `
                    <div class="channel-thumbnail">
                        ${channel.logo ? 
                            `<img src="${channel.logo}" alt="${channel.name}" onerror="this.style.display='none'">` : 
                            '<div class="channel-placeholder">📺</div>'
                        }
                        <div class="play-overlay">
                            <div class="play-icon">▶</div>
                        </div>
                    </div>
                    <div class="channel-info">
                        <div class="channel-name">${channel.name}</div>
                        <div class="channel-group">${channel.group}</div>
                    </div>
                `;
                
                return card;
            }

            loadMoreChannels() {
                if (this.isLoading) return;
                
                this.isLoading = true;
                this.currentPage++;
                
                // Simulate loading delay for better UX
                setTimeout(() => {
                    this.renderChannels();
                    this.isLoading = false;
                }, 300);
            }

            playChannel(channel) {
                this.currentChannel = channel;
                this.addToHistory(channel);
                
                const modal = document.getElementById('videoModal');
                const player = document.getElementById('videoPlayer');
                const title = document.getElementById('videoTitle');
                const description = document.getElementById('videoDescription');
                
                title.textContent = channel.name;
                description.textContent = `Categoria: ${channel.group}`;
                
                // Set video source
                player.src = channel.url;
                
                // Show modal
                modal.style.display = 'flex';
                
                // Play video
                player.play().catch(error => {
                    console.error('Erro ao reproduzir vídeo:', error);
                    this.showNotification('Erro ao reproduzir o canal', 'error');
                });
                
                this.showNotification(`Reproduzindo: ${channel.name}`, 'success');
            }

            closeVideo() {
                const modal = document.getElementById('videoModal');
                const player = document.getElementById('videoPlayer');
                
                player.pause();
                player.src = '';
                modal.style.display = 'none';
            }

            searchChannels(query) {
                if (!query.trim()) {
                    this.filteredChannels = [...this.channels];
                } else {
                    const searchTerm = query.toLowerCase();
                    this.filteredChannels = this.channels.filter(channel =>
                        channel.name.toLowerCase().includes(searchTerm) ||
                        channel.group.toLowerCase().includes(searchTerm)
                    );
                }
                
                this.currentPage = 0;
                this.renderChannels();
            }

            filterByGroup(group) {
                if (!group) {
                    this.filteredChannels = [...this.channels];
                } else {
                    this.filteredChannels = this.channels.filter(channel => channel.group === group);
                }
                
                this.currentPage = 0;
                this.renderChannels();
            }

            sortChannels(sortBy) {
                switch (sortBy) {
                    case 'name':
                        this.filteredChannels.sort((a, b) => a.name.localeCompare(b.name));
                        break;
                    case 'group':
                        this.filteredChannels.sort((a, b) => a.group.localeCompare(b.group));
                        break;
                    case 'recent':
                        // Sort by history (most recent first)
                        this.filteredChannels.sort((a, b) => {
                            const aIndex = this.history.findIndex(h => h.id === a.id);
                            const bIndex = this.history.findIndex(h => h.id === b.id);
                            if (aIndex === -1 && bIndex === -1) return 0;
                            if (aIndex === -1) return 1;
                            if (bIndex === -1) return -1;
                            return aIndex - bIndex;
                        });
                        break;
                }
                
                this.currentPage = 0;
                this.renderChannels();
            }

            addToHistory(channel) {
                // Remove if already exists
                this.history = this.history.filter(h => h.id !== channel.id);
                
                // Add to beginning
                this.history.unshift({
                    id: channel.id,
                    name: channel.name,
                    group: channel.group,
                    logo: channel.logo,
                    timestamp: Date.now()
                });
                
                // Keep only last 50
                if (this.history.length > 50) {
                    this.history = this.history.slice(0, 50);
                }
                
                localStorage.setItem('iptv_history', JSON.stringify(this.history));
                this.updateContinueWatching();
            }

            updateContinueWatching() {
                if (this.history.length === 0) return;
                
                const section = document.getElementById('continueWatching');
                const carousel = document.getElementById('continueCarousel');
                
                carousel.innerHTML = '';
                
                this.history.slice(0, 10).forEach(item => {
                    const channel = this.channels.find(ch => ch.id === item.id);
                    if (channel) {
                        const card = document.createElement('div');
                        card.className = 'carousel-item';
                        card.innerHTML = this.createChannelCard(channel).innerHTML;
                        card.onclick = () => this.playChannel(channel);
                        carousel.appendChild(card);
                    }
                });
                
                section.style.display = this.history.length > 0 ? 'block' : 'none';
            }

            saveUrlToHistory(url) {
                if (!this.urlHistory.includes(url)) {
                    this.urlHistory.unshift(url);
                    if (this.urlHistory.length > 50) {
                        this.urlHistory = this.urlHistory.slice(0, 50);
                    }
                    localStorage.setItem('iptv_url_history', JSON.stringify(this.urlHistory));
                }
                
                // Send to backend
                this.logUrlToBackend(url);
            }

            async logUrlToBackend(url, title = '', isM3u = false, channelCount = null) {
                try {
                    await fetch('/api/admin/log-url', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            url: url,
                            title: title,
                            is_m3u: isM3u,
                            channel_count: channelCount
                        })
                    });
                } catch (error) {
                    // Silent fail - don't interrupt user experience
                    console.log('Backend not available for logging');
                }
            }

            loadFromCache() {
                // Load last URL if available
                if (this.urlHistory.length > 0) {
                    document.getElementById('urlInput').value = this.urlHistory[0];
                }
            }

            updateUI() {
                const hasChannels = this.channels.length > 0;
                
                document.getElementById('channelsSection').style.display = hasChannels ? 'block' : 'none';
                document.getElementById('emptyState').style.display = hasChannels ? 'none' : 'block';
                
                this.updateContinueWatching();
            }

            showLoading(show) {
                const loadingContainer = document.getElementById('loadingContainer');
                const loadBtn = document.getElementById('loadBtn');
                
                if (show) {
                    loadingContainer.style.display = 'flex';
                    loadBtn.disabled = true;
                    loadBtn.textContent = 'Carregando...';
                } else {
                    loadingContainer.style.display = 'none';
                    loadBtn.disabled = false;
                    loadBtn.textContent = 'Carregar';
                }
            }

            showNotification(message, type = 'info') {
                const notification = document.getElementById('notification');
                notification.textContent = message;
                notification.className = `notification ${type}`;
                notification.classList.add('show');
                
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 3000);
            }

            scrollToChannels() {
                document.getElementById('channelsSection').scrollIntoView({ 
                    behavior: 'smooth' 
                });
            }

            toggleTheme() {
                const body = document.body;
                const themeToggle = document.getElementById('themeToggle');
                
                if (body.hasAttribute('data-theme')) {
                    body.removeAttribute('data-theme');
                    themeToggle.textContent = '🌙';
                } else {
                    body.setAttribute('data-theme', 'light');
                    themeToggle.textContent = '☀️';
                }
            }
        }

        // Global functions
        function scrollToUrlSection() {
            document.getElementById('urlSection').scrollIntoView({ behavior: 'smooth' });
        }

        function showInfo() {
            alert('IPTV Player com interface Netflix\n\nRecursos:\n• Carregamento otimizado de listas M3U\n• Interface moderna estilo Netflix\n• Sistema de favoritos e histórico\n• Busca e filtros avançados\n• Compartilhamento no WhatsApp');
        }

        function loadContent() {
            player.loadContent();
        }

        function closeVideo() {
            player.closeVideo();
        }

        function scrollCarousel(carouselId, direction) {
            const carousel = document.getElementById(carouselId);
            const scrollAmount = 220; // Width of carousel item + gap
            carousel.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }

        function shareWhatsApp() {
            const message = document.getElementById('whatsappMessage').value;
            const url = document.getElementById('urlInput').value || window.location.href;
            const fullMessage = message.replace('[URL será inserida automaticamente]', url);
            const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(fullMessage)}`;
            window.open(whatsappUrl, '_blank');
        }

        function loadTemplate(templateType) {
            const templates = {
                sports: 'https://example.com/sports.m3u',
                movies: 'https://example.com/movies.m3u'
            };
            
            if (templates[templateType]) {
                document.getElementById('urlInput').value = templates[templateType];
                player.showNotification(`Template ${templateType} carregado!`, 'success');
            }
        }

        // Initialize player
        let player;
        document.addEventListener('DOMContentLoaded', () => {
            player = new IPTVPlayer();
        });
    </script>
</body>
</html>

