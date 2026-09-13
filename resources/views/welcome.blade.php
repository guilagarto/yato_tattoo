<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yato Tattoo Studio</title>
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
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 70vh;
            text-align: center;
        }
        h1 {
            font-size: 3.5rem;
            letter-spacing: 2px;
            color: #d4af37; /* Dourado */
            margin-bottom: 10px;
        }
        .hero p {
            font-size: 1.2rem;
            color: #aaaaaa;
            margin-bottom: 30px;
        }
        .cta-btn {
            background-color: #d4af37;
            color: #121212;
            padding: 12px 30px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }
        .cta-btn:hover {
            background-color: #ffffff;
        }
        .nav-links {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .nav-links a {
            color: #ffffff;
            margin-left: 15px;
            text-decoration: none;
            font-size: 0.9rem;
        }
        /* Estilos da Galeria do Portfólio */
        .portfolio-section {
            width: 100%;
            max-width: 1200px;
            padding: 50px 20px;
            box-sizing: border-box;
        }
        .portfolio-section h2 {
            text-align: center;
            color: #d4af37;
            font-size: 2rem;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .grid-portfolio {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }
        .card-tattoo {
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            overflow: hidden;
            transition: 0.3s;
        }
        .card-tattoo:hover {
            transform: translateY(-5px);
            border-color: #d4af37;
        }
        .card-tattoo img {
            width: 100%;
            height: 350px;
            object-cover: cover;
            display: block;
        }
        .card-info {
            padding: 15px;
        }
        .card-info h3 {
            margin: 0 0 5px 0;
            font-size: 1.2rem;
            color: #ffffff;
        }
        .card-info span {
            color: #d4af37;
            font-size: 0.85rem;
            font-weight: bold;
            text-transform: uppercase;
        }
        .card-info p {
            margin: 10px 0 0 0;
            color: #888888;
            font-size: 0.9rem;
        }
        .empty-msg {
            text-align: center;
            color: #666666;
            grid-column: 1 / -1;
        }
    </style>
</head>
<body>

    <div class="nav-links">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Entrar</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Cadastrar-se</a>
                @endif
            @endauth
        @endif
    </div>

    <!-- Seção de Destaque -->
    <div class="hero">
        <h1>YATO TATTOO</h1>
        <p>Arte na pele esculpida com precisão e exclusividade.</p>
        <a href="#portfolio" class="cta-btn">Ver Nosso Portfólio</a>
    </div>

    <!-- Seção do Portfólio Dinâmico -->
    <div id="portfolio" class="portfolio-section">
        <h2>Últimos Trabalhos</h2>
        
        <div class="grid-portfolio">
            @forelse($trabalhos as $trabalho)
                <div class="card-tattoo">
                    <!-- Busca o arquivo salvo no storage -->
                    <img src="{{ asset('storage/' . $trabalho->imagem) }}" alt="{{ $trabalho->titulo }}">
                    <div class="card-info">
                        <h3>{{ $trabalho->titulo }}</h3>
                        <span>{{ $trabalho->estilo ?? 'Estilo Livre' }}</span>
                        @if($trabalho->descricao)
                            <p>{{ $trabalho->descricao }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="empty-msg">Nenhum trabalho adicionado ao portfólio ainda.</p>
            @endforelse
        </div>
    </div>

</body>
</html>
