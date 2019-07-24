<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link href = "css/main.css" rel = "stylesheet">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=YOUR_API_KEY&lang=ru_RU" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "scripts/vue.js"></script>
    <script src = "scripts/api/weatherBehavior.js"></script>
    <script src = "scripts/api/mapInit.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather yandex api</title>
</head>
<body>
    <div id = "app">
        <div class = "map-container" id = "map-weather-info">
            <div id = "map-weather" class = "map"></div>
            <div class = "more-info" id = "weather-info">
                <div id = "weather-temp">Temperature: {{ temperature }} °C</div>
                <div id = "weather-condition-container">
                    <div id = "weather-condition">Condition: {{ condition }}</div>
                    <img v-show = "urlSvg != ''" v-bind:src = "urlSvg">
                </div>
                <div id = "weather-part-name">Time of day: {{ partName }}</div>    
            </div>
        </div>
    </div>
    <script>
        // VUE CODE

        const app = new Vue({
            el: "#app",
            data: {
                temperature: 0,
                condition: "Nothing",
                partName: "Nothing",
                urlSvg: ""
            },
            created: function(){
                if (window.location.pathname == "/index.php") window.location.pathname = "/"; // changing url
                ymaps.ready(mapWeatherInit); // starting yandex maps
            },
            methods:{
                createAjax: function(pos){
                    // AJAX request to .php file, then it does request to yandex server
                    $.ajax({
                        type: "POST",
                        url: "scripts/request.php",
                        data: {'data': pos},
                        success: function(response){
                            const result = JSON.parse(response);
                            if (result.isSuccess) {
                                // showing data
                                app.temperature = result.data.fact.temp;
                                app.urlSvg = "https://yastatic.net/weather/i/icons/blueye/color/svg/" + result.data.forecast.parts[0].icon + ".svg";
                                app.condition = result.data.forecast.parts[0].condition.replace(/-/g, " ");
                                app.partName = result.data.forecast.parts[0].part_name;
                            } else console.log("Error: " + result.message); // if we have error, show it into console
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>