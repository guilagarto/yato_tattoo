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
            height: 60vh; 
            text-align: center; 
        }
        h1 { 
            font-size: 3.5rem; 
            letter-spacing: 2px; 
            color: #d4af37; 
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
        .section-title { 
            text-align: center; 
            color: #d4af37; 
            font-size: 2rem; 
            margin-bottom: 40px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
        }
        .container { 
            width: 100%; 
            max-width: 1200px; 
            padding: 60px 20px; 
            box-sizing: border-box; 
            border-bottom: 1px solid #222; 
        }
        
        /* Portfólio */
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
            color: #d4af37; 
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

        /* Formulário de Agenda */
        .agenda-form { 
            max-width: 600px; 
            margin: 0 auto; 
            background-color: #1a1a1a; 
            padding: 30px; 
            border-radius: 8px; 
            border: 1px solid #2a2a2a; 
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        .form-group label { 
            display: block; 
            margin-bottom: 8px; 
            font-size: 0.9rem; 
            color: #ccc; 
        }
        .form-group input, .form-group textarea { 
            width: 100%; 
            padding: 12px; 
            background-color: #121212; 
            border: 1px solid #333; 
            color: #fff; 
            border-radius: 4px; 
            box-sizing: border-box; 
        }
        .form-group input:focus, .form-group textarea:focus { 
            border-color: #d4af37; 
            outline: none; 
        }
        .submit-btn { 
            background-color: #d4af37; 
            color: #121212; 
            border: none; 
            width: 100%; 
            padding: 14px; 
            font-weight: bold; 
            border-radius: 4px; 
            cursor: pointer; 
            text-transform: uppercase; 
            font-size: 0.95rem; 
            transition: 0.3s; 
        }
        .submit-btn:hover { 
            background-color: #fff; 
        }
        .alert-success { 
            background-color: #1b4332; 
            border: 1px solid #2d6a4f; 
            color: #d8f3dc; 
            padding: 15px; 
            border-radius: 4px; 
            text-align: center; 
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>

     <div class="nav-links" style="position: absolute; top: 20px; width: calc(100% - 40px); display: flex; justify-content: space-between; max-width: 1200px; padding: 0 20px; box-sizing: border-box;">
        <!-- Links de Navegação das Páginas Públicas -->
        <div class="menu-publico">
            <a href="{{ url('/') }}" style="color: #d4af37; font-weight: bold; margin-right: 20px; text-decoration: none;">Home</a>
            <a href="{{ route('publico.agenda') }}" style="color: #fff; margin-right: 20px; text-decoration: none;">Agenda</a>
            <a href="{{ route('publico.portfolio') }}" style="color: #fff; margin-right: 20px; text-decoration: none;">Portfólio</a>
            <a href="{{ route('publico.blog') }}" style="color: #fff; text-decoration: none;">Blog</a>
        </div>

        <!-- Links Restritos / Login -->
        <div class="menu-auth">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" style="color: #fff; text-decoration: none; border: 1px solid #d4af37; padding: 5px 15px; border-radius: 4px;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" style="color: #fff; text-decoration: none; margin-right: 15px;">Entrar</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" style="color: #121212; background-color: #d4af37; padding: 5px 15px; text-decoration: none; font-weight: bold; border-radius: 4px;">Cadastrar-se</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>


    <!-- Seção de Destaque -->
    <div class="hero">
        <h1>YATO TATTOO</h1>
        <p>Arte na pele esculpida com precisão e exclusividade.</p>
        <div>
            <a href="#portfolio" class="cta-btn" style="margin-right: 10px;">Portfólio</a>
            <a href="#agenda" class="cta-btn" style="background-color: transparent; border: 2px solid #d4af37; color: #d4af37;">Marcar Horário</a>
        </div>
    </div>

    <!-- Seção do Portfólio Dinâmico -->
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
                <p class="empty-msg" style="text-align: center; color: #555; grid-column: 1/-1;">Nenhum trabalho adicionado ao portfólio ainda.</p>
            @endforelse
        </div>
    </div>

    <!-- Seção do Blog Dinâmico -->
    <div id="blog" class="container">
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
                        
                        <!-- Link dinâmico para a leitura completa do artigo -->
                        <a href="{{ route('publico.blog.show', $artigo->slug) }}" style="color: #d4af37; text-decoration: none; font-weight: bold; font-size: 0.9rem; display: inline-block; margin-top: 15px;">Ler Artigo Completo →</a>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #555; grid-column: 1/-1;">Nenhum artigo publicado no momento.</p>
            @endforelse
        </div>
    </div>

    <!-- Seção da Agenda Pública -->
    <div id="agenda" class="container" style="border: none;">
        <h2 class="section-title">Solicitar Agendamento</h2>
        
        @if(session('sucesso'))
            <div class="alert-success">{{ session('sucesso') }}</div>
        @endif

        <div class="agenda-form">
            <form method="POST" action="{{ route('publico.agendar') }}">
                @csrf
                <div class="form-group">
                    <label>Seu Nome Completo</label>
                    <input type="text" name="cliente_nome" required>
                </div>
                <div class="form-group">
                    <label>WhatsApp para Contato</label>
                    <input type="text" name="cliente_whatsapp" placeholder="(00) 00000-0000" required>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Data Pretendida</label>
                        <input type="date" name="data" required>
                    </div>
                    <div class="form-group">
                        <label>Horário</label>
                        <input type="time" name="hora" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ideia da Tattoo / Detalhes</label>
                    <textarea name="observacoes" rows="3" placeholder="Conte resumidamente o tamanho e o local do corpo..."></textarea>
                </div>
                <button type="submit" class="submit-btn">Enviar Solicitação</button>
            </form>
        </div>
    </div>

</body>
</html>
