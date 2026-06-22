<!DOCTYPE html>
<html class="dark" lang="pt-BR">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Cadastro | Style Barber</title>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Hanken+Grotesk:wght@100..900&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<style>
  body { background-color: #131315; color: #e4e2e4; font-family: 'Hanken Grotesk', sans-serif; }
</style>
</head>
<body class="antialiased min-h-screen flex flex-col items-center justify-center px-6">

<div class="w-full max-w-md space-y-8">

  <div class="text-center space-y-2">
    <h1 style="font-family: Newsreader; font-size:40px; font-weight:500; color:#e4e2e4;">Criar conta</h1>
    <p style="color:#c5c6cd; font-size:16px;">Preencha seus dados para acessar o sistema.</p>
  </div>

  @if($errors->has('erro'))
    <div style="background:#93000a22; border:1px solid #ffb4ab55; color:#ffb4ab; padding:12px 16px; border-radius:8px; font-size:14px;">
      {{ $errors->first('erro') }}
    </div>
  @endif

  @if(session('sucesso'))
    <div style="background:#00390722; border:1px solid #6dd58c55; color:#6dd58c; padding:12px 16px; border-radius:8px; font-size:14px;">
      {{ session('sucesso') }} —
      <a href="/login.php" style="text-decoration:underline; color:#6dd58c;">Fazer login agora</a>
    </div>
  @endif

  <form method="POST" action="/cadastro.php" style="display:flex; flex-direction:column; gap:24px;">
    @csrf

    <div style="border-bottom:1px solid #44474d; padding-bottom:12px;">
      <label style="display:block; font-size:12px; letter-spacing:0.05em; color:#c5c6cd; text-transform:uppercase; margin-bottom:8px;">Nome completo</label>
      <input name="nome" type="text" placeholder="Seu nome completo"
        style="width:100%; background:transparent; border:none; outline:none; color:#e4e2e4; font-size:16px; padding-bottom:4px;"
        value="{{ old('nome') }}"/>
    </div>

    <div style="border-bottom:1px solid #44474d; padding-bottom:12px;">
      <label style="display:block; font-size:12px; letter-spacing:0.05em; color:#c5c6cd; text-transform:uppercase; margin-bottom:8px;">E-mail</label>
      <input name="email" type="email" placeholder="nome@exemplo.com"
        style="width:100%; background:transparent; border:none; outline:none; color:#e4e2e4; font-size:16px; padding-bottom:4px;"
        value="{{ old('email') }}"/>
    </div>

    <div style="border-bottom:1px solid #44474d; padding-bottom:12px;">
      <label style="display:block; font-size:12px; letter-spacing:0.05em; color:#c5c6cd; text-transform:uppercase; margin-bottom:8px;">Senha</label>
      <input name="senha" type="password" placeholder="Mínimo 6 caracteres"
        style="width:100%; background:transparent; border:none; outline:none; color:#e4e2e4; font-size:16px; padding-bottom:4px;"/>
    </div>

    <div style="border-bottom:1px solid #44474d; padding-bottom:12px;">
      <label style="display:block; font-size:12px; letter-spacing:0.05em; color:#c5c6cd; text-transform:uppercase; margin-bottom:8px;">Confirmar senha</label>
      <input name="confirma" type="password" placeholder="Repita a senha"
        style="width:100%; background:transparent; border:none; outline:none; color:#e4e2e4; font-size:16px; padding-bottom:4px;"/>
    </div>

    <button type="submit"
      style="width:100%; height:56px; background:#c1c7cf; color:#2b3137; font-size:14px; font-weight:600; letter-spacing:0.05em; text-transform:uppercase; border:none; cursor:pointer; transition:background 0.2s;">
      Criar Conta
    </button>

  </form>

  <div style="text-align:center; padding-top:16px; border-top:1px solid #44474d22;">
    <p style="color:#c5c6cd; font-size:14px; margin-bottom:8px;">Já tem uma conta?</p>
    <a href="/login.php" style="color:#c1c7cf; font-size:12px; letter-spacing:0.05em; text-transform:uppercase; text-decoration:underline;">
      Fazer login
    </a>
  </div>

</div>
</body>
</html>
