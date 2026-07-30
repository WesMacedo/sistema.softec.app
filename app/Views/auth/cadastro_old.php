<h2>Cadastro</h2>

<form method="post" action="<?= base_url('auth/registrar') ?>">
    <input type="text" name="nome" placeholder="Nome" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="senha" placeholder="Senha" required><br>
    <button type="submit">Cadastrar</button>
</form>

<a href="<?= base_url('login') ?>">Já tem conta? Login</a>
