fetch("http://127.0.0.1:8000/api/user/info").then(
        response => {
            response.json().then(
                data => {
                    console.log(data);
                    if (data.length > 0) {
                        var getData = "";
                        data.forEach((object) => {
                            getData += "<tr>";
                            getData += "<td>" + object.id + "</td>";
                            getData += "<td>" + object.name + "</td>";
                            getData += "<td>" + object.email + "</td>";
                            getData += "<td>" + object.phone + "</td>";
                            getData += "<td>" + object.address + "</td></td>";
                        })
                        document.getElementById("loadData").innerHTML = getData;
                    }
                }
            )
        }
    )