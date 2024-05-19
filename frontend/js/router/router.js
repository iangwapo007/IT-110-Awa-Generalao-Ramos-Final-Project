function setRouter() {
    switch (window.location.pathname) {
        case "/":
        case "/login.html":
        case "/register.html":
        case "/about.html":
            if (localStorage.getItem("token")) {
                window.location.pathname = '/index.html';
            }
            break;
        case "/index.html":
        case "/slides.html":
        case "/presentation.html":
            if (!localStorage.getItem("token")) {
                window.location.pathname = '/about.html';
            }
            break;
        
        default:
            break;
    }
}

export { setRouter };