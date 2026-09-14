<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yato Tattoo Studio</title>
    
    <!-- LINK DO GOOGLE FONTS 100% CORRETO E FECHADO -->
        <!-- LINK DO GOOGLE FONTS 100% CORRETO E FECHADO -->
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link href="https://googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">


    <style>

        body { 
            background-color: #121212; 
            color: #ffffff; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            margin: 0; 
            padding: 0; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            min-height: 100vh; 
        }

        /* 👑 CABEÇALHO E MENU FIXO */
        header {
            width: 100%;
            background-color: rgba(18, 18, 18, 0.95);
            border-bottom: 1px solid #1a1a1a;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
        }
        .logo-text {
            color: #b30000; /* Vermelho Sangue */
            font-weight: bold;
            font-size: 1.6rem;
            letter-spacing: 2px;
            text-decoration: none;
                        font-family: 'New Rocker', system-ui;

            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        }

        .logo-text:hover {
            color: #bc0000; /* Fica dourado ao passar o mouse */
        }

        .menu-desktop {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        .menu-desktop a {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: 0.3s;
        }
        .menu-desktop a:hover {
            color: #bc0000;
        }
        .btn-dash {
            border: 1px solid #bc0000;;
            padding: 6px 15px;
            border-radius: 4px;
        }
        .btn-entrar {
            background-color: #bc0000;;
            color: #121212 !important;
            padding: 6px 15px;
            border-radius: 4px;
            font-weight: bold !important;
        }

        /* 📱 MENU HAMBÚRGUER (CELULAR) */
        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 5px;
        }
        .menu-toggle span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #bc0000;;
            border-radius: 2px;
            transition: 0.3s;
        }
        .menu-mobile {
            display: none;
            width: 100%;
            background-color: #161616;
            border-bottom: 1px solid #222;
            flex-direction: column;
            padding: 10px 0;
        }
        .menu-mobile a {
            color: #bc0000;
            text-decoration: none;
            padding: 12px 20px;
            font-size: 1.1rem;
            border-bottom: 1px solid #1f1f1f;
        }
        .menu-mobile a:last-child { border: none; }
        /* 🎯 SEÇÃO DO CARROSSEL & ESPAÇAMENTO TOP */
        .top-wrapper {
            width: 100%;
            max-width: 1200px;
            margin-top: 90px; /* Joga os blocos para baixo do menu fixo */
            padding: 0 20px;
            box-sizing: border-box;
        }

        /* 📸 CARROSSEL REFORMULADO */
        .carousel-container { 
            width: 100%; 
            height: 400px; 
            position: relative; 
            overflow: hidden; 
            border-radius: 8px; 
            border: 1px solid #1a1a1a; 
            margin-bottom: 25px;
        }
        .carousel-slide { 
            width: 100%; 
            height: 100%; 
            display: flex; 
            transition: transform 0.5s ease-in-out; 
        }
        .carousel-item { 
            min-width: 100%; 
            height: 100%; 
            position: relative; 
        }
        .carousel-item img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            filter: brightness(0.5); 
        }
        .carousel-caption { 
            position: absolute; 
            bottom: 40px; 
            left: 40px; 
        }
        .carousel-caption h2 { 
            color: #bc0000;; 
            font-size: 2.2rem; 
            margin: 0; 
            text-transform: uppercase; 
            letter-spacing: 1px;
        }

        /* 🔥 BLOCO DE PROMOÇÕES */
        .promo-section { 
            background: linear-gradient(135deg, #161616, #1f1f1f); 
            border: 1px dashed #bc0000;; 
            padding: 30px; 
            border-radius: 8px; 
            text-align: center; 
            margin-bottom: 30px;
        }
        .promo-badge { 
            background-color: #bc0000;; 
            color: #121212; 
            padding: 5px 15px; 
            font-weight: bold; 
            border-radius: 4px; 
            display: inline-block; 
            margin-bottom: 15px; 
            text-transform: uppercase; 
            font-size: 0.8rem;
            letter-spacing: 1px;
        }
        .cupom-box { 
            background-color: #121212; 
            border: 1px solid #333; 
            padding: 8px 25px; 
            display: inline-block; 
            border-radius: 4px; 
            font-family: monospace; 
            font-size: 1.3rem; 
            color: #bc0000;; 
            margin-top: 15px; 
            letter-spacing: 2px; 
        }

        /* Título Principal Yato Tattoo */
        .hero { 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center; 
            padding: 60px 20px;
            text-align: center; 
            box-sizing: border-box;
        }
        .h1 { 
            font-size: 5.5rem; /* Letra Grande e Imponente */
            letter-spacing: 4px; 
            color: #bc0000; /* Vermelho Sangue Intenso */
            margin: 0 0 10px 0; 
            font-family: 'New Rocker', system-ui;

            
            /* 💥 EFEITO DE BORDA PRETA REDOR DA LETRA PARA DESTACAR NO FUNDO */
            text-shadow: 3px 3px 0px #000, -1px -1px 0px #000, 1px -1px 0px #000, -1px 1px 0px #000, 1px 1px 0px #000;
        }

        .hero p { 
            font-size: 1.25rem; 
            color: #aaaaaa; 
            margin: 0 0 35px 0; 
        }
        .cta-btn { 
            background-color: #bc0000;; 
            color: #121212; 
            padding: 12px 30px; 
            text-decoration: none; 
            font-weight: bold; 
            border-radius: 5px; 
            transition: 0.3s; 
            display: inline-block;
        }
        .cta-btn:hover { 
            background-color: #ffffff; 
        }
        
        /* Seções de Conteúdo */
        .section-title { 
            text-align: center; 
            color: #bc0000;; 
            font-size: 2rem; 
            margin-bottom: 40px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }
        .container { 
            width: 100%; 
            max-width: 1200px; 
            padding: 80px 20px; 
            box-sizing: border-box; 
            border-bottom: 1px solid #1a1a1a; 
        }
        
        /* Portfólio */
        .grid-portfolio { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 25px; 
        }
        .card-tattoo { 
            background-color: #161616; 
            border: 1px solid #222; 
            border-radius: 8px; 
            overflow: hidden; 
            transition: 0.3s; 
        }
        .card-tattoo:hover { 
            transform: translateY(-5px); 
            border-color: #bc0000;; 
        }
        .card-tattoo img { 
            width: 100%; 
            height: 320px; 
            object-fit: cover; 
            display: block; 
        }
        .card-info { 
            padding: 15px; 
        }
        .card-info h3 { 
            margin: 0 0 5px 0; 
            font-size: 1.2rem; 
        }
        .card-info span { 
            color: #bc0000;; 
            font-size: 0.85rem; 
            font-weight: bold; 
            text-transform: uppercase; 
        }

        /* Blog */
        .grid-blog { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); 
            gap: 25px; 
        }
        .card-post { 
            background-color: #161616; 
            border-radius: 8px; 
            overflow: hidden; 
            border: 1px solid #222; 
        }
        .card-post img { 
            width: 100%; 
            height: 200px; 
            object-fit: cover; 
        }
        .card-post-content { 
            padding: 20px; 
        }
        .card-post-content h3 { 
            color: #ffffff; 
            margin: 0 0 10px 0; 
        }
        .card-post-content p { 
            color: #999; 
            font-size: 0.95rem; 
            line-height: 1.5; 
        }

        /* 📱 RESPONSIVIDADE (CELULAR) */
        @media (max-width: 768px) {
            .menu-desktop { display: none; }
            .menu-toggle { display: flex; }
            .menu-mobile.active { display: flex; }
            h1 { font-size: 2.6rem; }
            .top-wrapper { margin-top: 80px; padding: 0 10px; }
            .carousel-container { height: 260px; }
            .carousel-caption h2 { font-size: 1.4rem; left: 20px; bottom: 20px; }
        }
    </style>
</head>
<body>

    <!-- 👑 CABEÇALHO FIXO COM MENU UNIFICADO -->
    <header>
        <div class="nav-container">
            <a href="{{ url('/') }}" class="logo-text">YATO TATTOO</a>
            
            <!-- Menu para Computador -->
            <div class="menu-desktop">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ route('publico.agenda') }}">Agenda</a>
                <a href="{{ route('publico.portfolio') }}">Portfólio</a>
                <a href="{{ route('publico.blog') }}">Blog</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-dash">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-entrar">Entrar</a>
                    @endauth
                @endif
            </div>

            <!-- Botão Hambúrguer para Celular -->
            <button class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Menu Oculto (Gaveta Mobile) -->
        <div class="menu-mobile" id="menuMobile">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('publico.agenda') }}">Agenda</a>
            <a href="{{ route('publico.portfolio') }}">Portfólio</a>
            <a href="{{ route('publico.blog') }}">Blog</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Entrar</a>
                @endauth
            @endif
        </div>
    </header>

    <!-- 🎯 ENVELOPE DE TOPO: CARROSSEL E PROMOÇÕES ACIMA DE TUDO -->
    <div class="top-wrapper">
        
        <!-- Carrossel Dinâmico -->
        @if(isset($banners) && $banners->count() > 0)
        <div class="carousel-container">
            <div class="carousel-slide" id="carouselSlide">
                @foreach($banners as $banner)
                    <div class="carousel-item">
                        <img src="{{ asset('storage/' . $banner->imagem) }}" alt="Banner Yato Tattoo">
                        @if($banner->titulo)
                            <div class="carousel-caption">
                                <h2>{{ $banner->titulo }}</h2>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Promoções Dinâmicas -->
        @if(isset($promocoes) && $promocoes->count() > 0)
        <div class="promo-section">
            <span class="promo-badge">🔥 Promoção Ativa</span>
            @foreach($promocoes as $promo)
                <h3 style="color: #fff; font-size: 1.8rem; margin: 0 0 10px 0;">{{ $promo->titulo }}</h3>
                <p style="color: #aaa; margin: 0 0 10px 0;">{{ $promo->descricao }}</p>
                @if($promo->cupom)
                    <div>Use o cupom no estúdio: <span class="cupom-box">{{ $promo->cupom }}</span></div>
                @endif
            @endforeach
        </div>
        @endif

    </div> <!-- Fecha o top-wrapper -->
    <!-- 🎯 SEÇÃO PRINCIPAL (HERO) -->
    <div class="hero">
        <h1>YATO TATTOO</h1>
        <p>Arte na pele esculpida com precisão e exclusividade.</p>
        <div>
            <a href="#portfolio" class="cta-btn" style="margin-right: 15px;">Portfólio</a>
            <a href="{{ route('publico.agenda') }}" class="cta-btn" style="background-color: transparent; border: 2px solid #d4af37; color: #d4af37;">Marcar Horário</a>
        </div>
    </div>

    <!-- 📸 SEÇÃO DO PORTFÓLIO DINÂMICO -->
    <div id="portfolio" class="container">
        <h2 class="section-title">Últimos Trabalhos</h2>
        <div class="grid-portfolio">
            @forelse($trabalhos as $trabalho)
                <div class="card-tattoo">
                    <img src="{{ asset('storage/' . $trabalho->imagem) }}" alt="{{ $trabalho->titulo }}">
                    <div class="card-info">
                        <h3>{{ $trabalho->titulo }}</h3>
                        <span>{{ $trabalho->estilo ?? 'Estilo Livre' }}</span>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #555; grid-column: 1/-1;">Nenhum trabalho adicionado ao portfólio ainda.</p>
            @endforelse
        </div>
    </div>

    <!-- 🗒️ SEÇÃO DO BLOG DINÂMICO -->
    <div id="blog" class="container" style="border: none;">
        <h2 class="section-title">Dicas e Cuidados</h2>
        <div class="grid-blog">
            @forelse($artigos as $artigo)
                <div class="card-post">
                    @if($artigo->capa)
                        <img src="{{ asset('storage/' . $artigo->capa) }}" alt="{{ $artigo->titulo }}">
                    @endif
                    <div class="card-post-content">
                        <h3>{{ $artigo->titulo }}</h3>
                        <p>{{ Str::limit($artigo->conteudo, 150) }}</p>
                        <a href="{{ route('publico.blog.show', $artigo->slug) }}" style="color: #d4af37; text-decoration: none; font-weight: bold; font-size: 0.9rem; display: inline-block; margin-top: 15px;">Ler Artigo Completo →</a>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #555; grid-column: 1/-1;">Nenhum artigo publicado no momento.</p>
            @endforelse
        </div>
    </div>

    <!-- 🛠️ SCRIPTS DE INTERAÇÃO -->
    <script>
        // Menu de Celular (Três Tracinhos)
        const menuToggle = document.getElementById('menuToggle');
        const menuMobile = document.getElementById('menuMobile');
        menuToggle.addEventListener('click', () => {
            menuMobile.classList.toggle('active');
        });

        // Carrossel de Imagens Automático
        const slide = document.getElementById('carouselSlide');
        if (slide) {
            let index = 0;
            const items = document.querySelectorAll('.carousel-item');
            if(items.length > 1) {
                setInterval(() => {
                    index = (index + 1) % items.length;
                    slide.style.transform = `translateX(-${index * 100}%)`;
                }, 4000);
            }
        }
    </script>

</body>
</html>
