<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <link href = "css/main.css" rel = "stylesheet">
    <!-- <script src="https://api-maps.yandex.ru/2.1/?apikey=ee24b962-3258-45ad-8d30-41dcd7fc2b43&lang=ru_RU" type="text/javascript"></script> -->
    <script src="https://api-maps.yandex.ru/2.1/?apikey=b495101b-0f61-4b6f-bd20-c0444f11e362&lang=ru_RU" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "vue.js"></script>
    <script src = "scripts/api/behavior.js"></script>
    <script src = "scripts/api/mapInit.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather api test</title>
</head>
<body>
    <div id = "app">
        <div id = "map-info">
            <div id = "map"></div>
            <div id = "weather-info">
                <div id = "weather-temp">Temperature: {{ temperature }} °C</div>
                <div id = "weather-condition-container">
                    <div id = "weather-condition">Condition: {{ condition }}</div>
                    <img v-bind:src = "urlSvg" width = "24" height = "24">
                </div>
                <div id = "weather-part-name">Time of day: {{ partName }}</div>
                
            </div>
        </div>
    </div>
    <script>
        const app = new Vue({
            el: "#app",
            data: {
                temperature: 0,
                condition: "Nothing",
                partName: "Nothing",
                urlSvg: ""
            },
            created: function(){
                ymaps.ready(mapInit);
            },
            methods:{
                createAjax: function(pos){
                    $.ajax({
                        type: "POST",
                        url: "scripts/request.php",
                        data: {'data': pos},
                        success: function(response){
                            const result = JSON.parse(response);
                            if (result.isSuccess == 'true'){
                                app.temperature = result.data.fact.temp;
                                // https://yastatic.net/weather/i/icons/blueye/color/svg/
                                app.urlSvg = "https://yastatic.net/weather/i/icons/blueye/color/svg/" + result.data.forecast.parts[0].icon + ".svg";
                                app.condition = result.data.forecast.parts[0].condition;
                                app.partName = result.data.forecast.parts[0].part_name;
                            }else{
                                console.log("Error: " + result.message)
                            }
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>