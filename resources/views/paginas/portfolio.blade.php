<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfólio Completo - Yato Tattoo</title>
    <style>
        body { background-color: #121212; color: #ffffff; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 40px 20px; display: flex; flex-direction: column; align-items: center; }
        .nav-back { width: 100%; max-width: 1200px; margin-bottom: 30px; }
        .nav-back a { color: #d4af37; text-decoration: none; font-weight: bold; }
        h1 { color: #d4af37; text-transform: uppercase; margin-bottom: 40px; }
        .grid-portfolio { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; width: 100%; max-width: 1200px; }
        .card-tattoo { background-color: #1a1a1a; border: 1px solid #2a2a2a; border-radius: 8px; overflow: hidden; }
        .card-tattoo img { width: 100%; height: 320px; object-fit: cover; display: block; }
        .card-info { padding: 15px; }
        .card-info h3 { margin: 0 0 5px 0; font-size: 1.2rem; }
        .card-info span { color: #d4af37; font-size: 0.85rem; font-weight: bold; text-transform: uppercase; }
        .paginacao { margin-top: 40px; }
    </style>
</head>
<body>
    <div class="nav-back"><a href="{{ url('/') }}">← Voltar para a Home</a></div>
    <h1>Nosso Portfólio</h1>
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
            <p style="color: #666; text-align: center; grid-column: 1/-1;">Nenhuma tatuagem publicada ainda.</p>
        @endforelse
    </div>
    <div class="paginacao">{{ $trabalhos->links() }}</div>
</body>
</html>
