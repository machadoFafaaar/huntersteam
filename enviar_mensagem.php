<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $assunto = htmlspecialchars(trim($_POST["assunto"]));
    $mensagem = htmlspecialchars(trim($_POST["mensagem"]));

    // Para onde o email será enviado
    $para = "huntersfc99@gmail.com";

    // Assunto do email
    $assunto_email = "Contato do site - " . $assunto;

    // Corpo do email
    $conteudo = "
    Você recebeu uma nova mensagem pelo formulário de contato do site Hunters:

    Nome: $nome
    E-mail: $email
    Assunto: $assunto

    Mensagem:
    $mensagem
    ";

    // Cabeçalhos do e-mail
    $headers = "From: $nome <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Envia o email
    if (mail($para, $assunto_email, $conteudo, $headers)) {
        echo "
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Mensagem Enviada</title>
            <style>
                body { font-family: Arial, sans-serif; background: #000; color: white; text-align: center; padding: 50px; }
                .box { background: #111; padding: 30px; border-radius: 10px; display: inline-block; }
                a { color: #f00; text-decoration: none; font-weight: bold; }
            </style>
        </head>
        <body>
            <div class='box'>
                <h1>Mensagem enviada com sucesso!</h1>
                <p>Obrigado por entrar em contato, $nome. Nossa equipe responderá em breve.</p>
                <p><a href='index.html'>Voltar para a página inicial</a></p>
            </div>
        </body>
        </html>
        ";
    } else {
        echo "Erro ao enviar sua mensagem. Tente novamente mais tarde.";
    }
}
?>
