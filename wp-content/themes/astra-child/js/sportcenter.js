window.addEventListener("load", function() {

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
    
    document.body.appendChild(welcomeBox);

    setTimeout(() => {
        welcomeBox.style.opacity = "0";
        setTimeout(() => welcomeBox.remove(), 1000);
    }, 5000);
});


