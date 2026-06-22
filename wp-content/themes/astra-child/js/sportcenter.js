window.addEventListener("load", function() {
    // Создаём элемент
    const welcomeBox = document.createElement("div");
    welcomeBox.textContent = "Welcome to our Sport Center!";

    // Добавляем стили
    welcomeBox.style.position = "fixed";
    welcomeBox.style.bottom = "30px";
    welcomeBox.style.right = "30px";
    welcomeBox.style.padding = "15px 25px";
    welcomeBox.style.backgroundColor = "#1e88e5";
    welcomeBox.style.color = "white";
    welcomeBox.style.borderRadius = "12px";
    welcomeBox.style.boxShadow = "0 4px 10px rgba(0,0,0,0.2)";
    welcomeBox.style.fontFamily = "sans-serif";
    welcomeBox.style.fontSize = "16px";
    welcomeBox.style.zIndex = "9999";
    welcomeBox.style.transition = "opacity 1s ease-in-out";

    // Добавляем элемент на страницу
    document.body.appendChild(welcomeBox);

    // Убираем через 5 секунд
    setTimeout(() => {
        welcomeBox.style.opacity = "0";
        setTimeout(() => welcomeBox.remove(), 1000);
    }, 5000);
});

// Ждём полной загрузки DOM
document.addEventListener("DOMContentLoaded", function() {
    // Получаем все кнопки
    const toggleButtons = document.querySelectorAll(".toggle-tickets-btn");

    toggleButtons.forEach(button => {
        button.addEventListener("click", function() {
            // Находим следующий контейнер с товарами
            const ticketsContainer = button.nextElementSibling;

            if (ticketsContainer.style.display === "none" || ticketsContainer.style.display === "") {
                ticketsContainer.style.display = "block";
                ticketsContainer.style.opacity = 0;

                // Плавное появление
                let opacity = 0;
                const fadeIn = setInterval(() => {
                    opacity += 0.05;
                    ticketsContainer.style.opacity = opacity;
                    if (opacity >= 1) clearInterval(fadeIn);
                }, 20);

                button.textContent = "Hide Tickets";
            } else {
                // Плавное скрытие
                let opacity = 1;
                const fadeOut = setInterval(() => {
                    opacity -= 0.05;
                    ticketsContainer.style.opacity = opacity;
                    if (opacity <= 0) {
                        ticketsContainer.style.display = "none";
                        clearInterval(fadeOut);
                    }
                }, 20);

                button.textContent = "View Tickets";
            }
        });
    });
});


