function refresh(){
    if (!window.location.href.includes("?city=")){
        cityName = document.getElementById("city").value;
        window.location=window.location + "?city=" + cityName;
    } else {
        window.location=window.location.href.split("=") + "=" + cityName;
    }
}