<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контактная форма</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        input, button { display: block; margin-bottom: 1rem; padding: 0.5rem; width: 300px; }
        #message { margin-top: 1rem; color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<h1>Контактная форма</h1>

<form id="contactForm">
    <input type="text" name="name" placeholder="Имя" required>
    <input type="text" name="phone" placeholder="Телефон" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Отправить</button>
</form>

<div id="message"></div>

<script>
    const form = document.getElementById('contactForm');
    const message = document.getElementById('message');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        message.innerHTML = '';

        const formData = new FormData(form);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (!response.ok) {
                const errorData = await response.json();
                if (errorData.errors) {
                    for (let key in errorData.errors) {
                        message.innerHTML += `<div class="error">${errorData.errors[key]}</div>`;
                    }
                } else {
                    message.innerHTML = '<div class="error">Произошла ошибка</div>';
                }
                return;
            }

            const data = await response.json();
            message.innerHTML = data.message;
            form.reset();
        } catch (error) {
            message.innerHTML = '<div class="error">Ошибка при отправке</div>';
            console.error(error);
        }
    });
</script>

</body>
</html>
