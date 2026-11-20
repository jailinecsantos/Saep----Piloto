<?php
session_start();
require_once __DIR__ . '/conexao.php';

$erro = "";
$sucesso = "";
$nome = "";
$tipo = "OPERADOR";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome  = trim($_POST["nome"] ?? "");
    $tipo  = $_POST["tipo"] ?? "OPERADOR";


    } elseif (!in_array($tipo, ["OPERADOR", "ADMINISTRADOR"], true)) {
        $erro = "Tipo de usuário inválido!";
    } else {
        $st = $pdo->prepare("INSERT INTO `user` (nome, tipo) VALUES (?, ?)");
        $st->execute([$nome, $tipo]);
        $sucesso = "Usuário cadastrado com sucesso!";
        $nome = "";
    }


require_once __DIR__ . '/includes/menu.php';
?>
    <main class="flex-1 flex flex-col">
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <h1 class="text-xl font-extrabold text-gray-800">Cadastro de Usuário</h1>
            <p class="text-sm text-gray-500">Registro de usuários com definição de tipo </p>
        </div>
        
            <div class="bg-white rounded-xl shadow-sm p-6">
                <form method="post">
                    <div class="mb-4">
                        <label class="form-label">Nome *</label>
                        <input type="text" name="nome" class="form-input" required value="<?= htmlspecialchars($nome) ?>">
                    </div>
                    <div class="mb-6">
                        <label class="form-label">Tipo *</label>
                        <select name="tipo" class="form-input" required>
                            <option value="OPERADOR" <?= $tipo === "OPERADOR" ? "selected" : "" ?>>Oper</option>
                            <option value="ADMINISTRADOR" <?= $tipo === "ADMINISTRADOR" ? "selected" : "" ?>>Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-senai-blue text-white font-bold px-5 py-2.5 rounded-lg text-sm">Salvar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
