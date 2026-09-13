<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artigo->titulo }} - Yato Tattoo</title>
    <style>
        body { background-color: #121212; color: #ffffff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; align-items: center; min-height: 100vh; }
        .nav-top { width: 100%; max-width: 800px; padding: 20px; box-sizing: border-box; }
        .back-link { color: #d4af37; text-decoration: none; font-weight: bold; font-size: 0.9rem; }
        .back-link:hover { color: #fff; }
        .article-container { width: 100%; max-width: 800px; padding: 20px; box-sizing: border-box; }
        .article-capa { width: 100%; height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 30px; border: 1px solid #222; }
        h1 { font-size: 2.8rem; color: #d4af37; margin: 0 0 10px 0; line-height: 1.2; }
        .date { color: #666; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 30px; display: block; }
        .content { color: #ccc; font-size: 1.15rem; line-height: 1.8; white-space: pre-line; }
    </style>
</head>
<body>

    <div class="nav-top">
        <a href="{{ url('/') }}" class="back-link">← Voltar para o Site</a>
    </div>

    <article class="article-container">
        @if($artigo->capa)
            <img src="{{ asset('storage/' . $artigo->capa) }}" alt="{{ $artigo->titulo }}" class="article-capa">
        @endif

        <h1>{{ $artigo->titulo }}</h1>
        <span class="date">Publicado em {{ $artigo->created_at->format('d/m/Y \à\s H:i') }}</span>

        <div class="content">
            {{ $artigo->conteudo }}
        </div>
    </article>

</body>
</html>
