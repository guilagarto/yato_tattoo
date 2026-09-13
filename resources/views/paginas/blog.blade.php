<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog e Dicas - Yato Tattoo</title>
    <style>
        body { background-color: #121212; color: #ffffff; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 40px 20px; display: flex; flex-direction: column; align-items: center; }
        .nav-back { width: 100%; max-width: 1200px; margin-bottom: 30px; }
        .nav-back a { color: #d4af37; text-decoration: none; font-weight: bold; }
        h1 { color: #d4af37; text-transform: uppercase; margin-bottom: 40px; }
        .grid-blog { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; width: 100%; max-width: 1200px; }
        .card-post { background-color: #161616; border-radius: 8px; overflow: hidden; border: 1px solid #222; }
        .card-post img { width: 100%; height: 200px; object-fit: cover; }
        .card-post-content { padding: 20px; }
        .card-post-content h3 { color: #ffffff; margin: 0 0 10px 0; }
        .card-post-content p { color: #999; font-size: 0.95rem; line-height: 1.5; }
        .paginacao { margin-top: 40px; }
    </style>
</head>
<body>
    <div class="nav-back"><a href="{{ url('/') }}">← Voltar para a Home</a></div>
    <h1>Blog de Cuidados e Dicas</h1>
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
            <p style="color: #666; text-align: center; grid-column: 1/-1;">Nenhum artigo publicado no momento.</p>
        @endforelse
    </div>
    <div class="paginacao">{{ $artigos->links() }}</div>
</body>
</html>
