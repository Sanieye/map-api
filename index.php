<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Hello, world!</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&libraries=&v=weekly&channel=2"
        async></script>

</head>


<body>
    <div class="container mt-5 col-4" style="background-color: burlywood;padding-bottom: 20px;" >
        <h2 style="text-align: center ; padding-top: 30px;"><b> พยากรณ์อากาศในพื้นที่</b> <span><img
                    src="https://cdn.pixabay.com/photo/2016/03/18/15/06/starkbewolkt-1265202_960_720.png "
                    style="width: 60px; height: 60px;"></span></h2> <br />
        <form class="container text-center">
            <div class="from-group mb-3 mx-5 " style="padding-top: 15px;">
                <span class="from-group-text">Latitude :</span>
                <input type="text" class="control-label " placeholder="ละติจูด " aria-label="Latitude"
                    aria-describedby="Latitude" id="Latitude">
            </div>

            <div class="container mx-">
                <div class="from-group mb-3 mx-4">
                    <span class="from-group-text">Longitude :</span>
                    <input type="text" class="control-label" placeholder=" ลองจิจูด" aria-label="Longitude"
                        aria-describedby="Longitude" id="Longitude">
                </div>
                <div class="container-fluid mt-4 d-flex justify-content-center">
                    <button type="button" class="btn btn-primary" id="btnSearch">search</button>
                </div>
            </div>
            <br />
            <div class="card text-center">
                <div class="container  mt-5 d-flex justify-content-center">
                    <div class="card" id="cardWeather" style="width: 30rem; ">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    function setmap() {
        var urlmap = "https://api.openweathermap.org/data/2.5/weather?lat=8.500609&lon=99.9279646&appid=5027d32a6595c47215bce1fef98e1b2b";
        $.getJSON(urlmap)
            .done((data) => {
                var place = (data.name);
                var temp = ((data.main["temp"] - 273).toFixed(0) + " °C");
                var humid = (data.main["humidity"] + "%");
                var datetime = convertHMS(data.dt);
                var sunrise = convertHMS(data.sys["sunrise"]);
                var sunset = convertHMS(data.sys["sunset"]);
                var windSpeed = (data.wind["speed"]);
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);
                    }
                })
                var line = "<div id='dataWeather'>";
                line += "<img src='https://www.dol.go.th/nakhonsithammarat/PublishingImages/16936856642_4fd5244401_b.jpg' class='card-img-top' >"
                line += "<h5 class='card-title my-3 '>" + place + "</h5>";
                line += "<p class='card-text'>อุณหภูมิ : " + temp + "</p>";
                line += "<p class='card-text'>ความชื้นสัมพัทธ์ : " + humid + "</p>";
                line += "<p class='card-text'>อาทิตย์ขึ้นเวลา : " + sunrise + "</p>";
                line += "<p class='card-text'>อาทิตย์ตกเวลา : " + sunset + "</p>";
                line += "<p class='card-text'>ณ เวลา: " + datetime + "</p>";
                line += "</div>"
                $("#cardWeather").append(line);
            }).fail((xhr, status, error) => { })
    }
    function LoadForcast() {
        var lat = $("#Latitude").val();
        var long = $("#Longitude").val();
        var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + long + "&appid=5027d32a6595c47215bce1fef98e1b2b"
        $.getJSON(url)
            .done((data) => {
                var datetime = convertHMS(data.dt);
                var sunrise = convertHMS(data.sys["sunrise"]);
                var sunset = convertHMS(data.sys["sunset"]);
                var place = (data.name);
                var windSpeed = (data.wind["speed"]);
                var temp = ((data.main["temp"] - 273).toFixed(0) + " °C");
                var humid = (data.main["humidity"] + "%");
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);
                    }
                })
                var line = "<div id='dataWeather'>";
                line += "<img src='https://f.ptcdn.info/956/054/000/p0aptc4qcArP51VCQh5-s.jpg' class='card-img-top' ><div class='card-body'>"
                line += "<h5 class='card-title my-3'> " + place + "</h5>";
                line += "<p class='card-text'>อุณหภูมิ : " + temp + "</p>";
                line += "<p class='card-text'>ความชื้นสัมพัทธ์ : " + humid + "</p>";
                line += "<p class='card-text'>อาทิตย์ขึ้นเวลา : " + sunrise + "</p>";
                line += "<p class='card-text'>อาทิตย์ตกเวลา : " + sunset + "</p>";
                line += "<p class='card-text'>ณ เวลา: " + datetime + "</p>";
                line += "</div>"
                $("#cardWeather").append(line);
            }).fail((xhr, status, error) => { })
    }

    function convertHMS(value) {
        let time = value;
        var convert = new Date(time * 1000);
        var hours = convert.getHours();
        var minutes = "0" + convert.getMinutes();
        var seconds = "0" + convert.getSeconds();
        return (hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2));

    }



    $(() => {
        setmap();
        $("#btnSearch").click(() => {
            LoadForcast();
            $("#dataWeather").hide();

        });
    });
</script>

</html>
