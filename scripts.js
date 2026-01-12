function refresh(){
    cityName = document.getElementById("city").value;
    window.location = "http://localhost/GitHub/afp1-weather/backend.php?city=" + cityName;
}