const form = document.getElementById("loginForm");

form.addEventListener('submit', function(e){
    e.preventDefault();

    const username = form.username.value;
    const password = form.password.value;

    if (username === "admin" && password === "admin"){
        document.cookie = "role=admin; path=/; max-age=99999";

        window.location.href = "index.php";
    } else {
        alert("Hibás felhasználónév vagy jelszó!");
    }
});