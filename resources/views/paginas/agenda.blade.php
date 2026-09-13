<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento de Horários - Yato Tattoo</title>
    <style>
        body { background-color: #121212; color: #ffffff; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 40px 20px; display: flex; flex-direction: column; align-items: center; }
        .nav-back { width: 100%; max-width: 1200px; margin-bottom: 30px; }
        .nav-back a { color: #d4af37; text-decoration: none; font-weight: bold; }
        h1 { color: #d4af37; text-transform: uppercase; margin-bottom: 20px; }
        .container { width: 100%; max-width: 600px; background-color: #1a1a1a; padding: 30px; border-radius: 8px; border: 1px solid #2a2a2a; margin-top: 20px; box-sizing: border-box; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 0.9rem; color: #ccc; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px; background-color: #121212; border: 1px solid #333; color: #fff; border-radius: 4px; box-sizing: border-box; }
        .submit-btn { background-color: #d4af37; color: #121212; border: none; width: 100%; padding: 14px; font-weight: bold; border-radius: 4px; cursor: pointer; text-transform: uppercase; transition: 0.3s; }
        .submit-btn:hover { background-color: #fff; }
        .alert-success { background-color: #1b4332; border: 1px solid #2d6a4f; color: #d8f3dc; padding: 15px; border-radius: 4px; text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="nav-back"><a href="{{ url('/') }}">← Voltar para a Home</a></div>
    <h1>Agende seu Horário</h1>
    <p style="color: #aaa; text-align: center;">Faça uma pré-reserva do seu atendimento.</p>
    
    <div class="container">
        @if(session('sucesso'))
            <div class="alert-success">{{ session('sucesso') }}</div>
        @endif

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
                <textarea name="observacoes" rows="3" placeholder="Conte resumidamente o tamanho e local do corpo..."></textarea>
            </div>
            <button type="submit" class="submit-btn">Enviar Solicitação</button>
        </form>
    </div>
</body>
</html>
