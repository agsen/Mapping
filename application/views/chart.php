<html>
    <head>
        <title>The jQuery Example</title>
        <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript" src=" /mapping/assets/script/jquery.canvasjs.min.js"></script>
        <script type = "text/javascript" language = "javascript">

            var listData = [];

            $.ajax({
                async: false,
                type: 'GET',
                url: "/mapping/index.php/api/ambil_semua_data",
                dataType: 'json',
                success: function (jd) {
                    for (i = 0; i < jd.length; i++) {
                        nilai_y = Number(jd[i].konsentrasi_gas);
                        nilai_x = i + 1;

                        node = {x: nilai_x, y: nilai_y};

                        console.log(nilai_x);
                        listData.push(node);

                        console.log(listData[i].y);
                    }
                }

            });

            var listTes = [];

            tes = {x: 1, y: Number("1000")}
            tes2 = {x: 10, y: 800}
            listTes.push(tes);
            listTes.push(tes2);

            console.log(listTes[0].y);
            console.log(listData[0].y);

            $(function () {
                //Better to construct options first and then pass it as a parameter
                console.log(tes);

                var options = {
                    title: {
                        text: "Grafik data node"
                    },
                    animationEnabled: true,
                    data: [
                        {
                            type: "spline", //change it to line, area, column, pie, etc
                            dataPoints: listData
                        }
                    ]
                };

                $("#chartContainer").CanvasJSChart(options);

            });
            $(function () {
                setInterval(function () {
                    $("#chartContainer").load("/mapping/index.php/api/tampil_grafik")
                }, 10000);
            });
        </script>
    </head>

    <body>

        <div id="chartContainer" style="height: 300px; width: 70%;"></div>

    </body>

</html>