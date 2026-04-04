function refresh(){
    const cityName = document.getElementById("city").value;
    const url = new URL(window.location.href);
    url.searchParams.set('city', cityName);
    window.location.href = url.toString();
}