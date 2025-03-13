<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['surname'])) die('Bot detected!');
    
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $comment = htmlspecialchars(trim($_POST['comment'] ?? ''));

    if (!preg_match('/^\+7\s?\d{3}\s?\d{3}\s?\d{2}\s?\d{2}$/', $phone)) die('Invalid phone');

    $to = 'ваш@email.com'; // ЗАМЕНИТЕ НА ВАШ EMAIL
    $subject = 'Новая заявка с сайта';
    $headers = "From: no-reply@ваш-домен.ру\r\nContent-Type: text/html; charset=UTF-8";

    $message = "<div style='font-family: Arial; max-width: 600px; margin: 0 auto;'>
        <h2 style='color: #e67e22;'>Новая заявка</h2>
        <p><strong>Имя:</strong> $name</p>
        <p><strong>Телефон:</strong> $phone</p>
        <p><strong>Комментарий:</strong><br>" . nl2br($comment) . "</p>
    </div>";

    if (mail($to, $subject, $message, $headers)) {
        echo '<script>
            alert("Заявка успешно отправлена!");
            document.querySelector(".modal").classList.remove("active");
            document.querySelector(".modal-overlay").classList.remove("active");
        </script>';
    } else {
        echo '<script>alert("Ошибка отправки!")</script>';
    }
}
?>