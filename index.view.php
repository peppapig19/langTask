<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <title>Language Detector</title>
</head>

<body>
    <p class="h1 text-center m-3">Language Detector</p>
    <div class="container">
        <div class="row">
            <form>
                <div class="form-group">
                    <label>Строка:</label>
                    <div contenteditable class="form-control" id="string"><?= $colored_string ?></div>
                    <div class="form-group text-center m-3">
                        <button class="btn btn-primary" type="button">Проверить</button>
                    </div>
                    <div class="alert alert-success" style="display:none;" id="bootstrap-alert"></div>
            </form>
        </div>

        <div class="row">
            <table class="table table-striped">
                <?php foreach ($model as $item) : ?>
                    <tr>
                        <td style="width: 75%"><?= $item['markup'] ?></td>
                        <td><?= $item['time_checked'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>

<script language="javascript" type="text/javascript">
    var textbox = document.getElementById("string");
    if (textbox.innerText) textbox.addEventListener("blur", autoCheck);

    document.querySelector("button").addEventListener("click", check);

    function check() {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "index.php");
        xhttp.setRequestHeader("Content-Type", "application/json");

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) document.querySelector("form").submit();
        };

        var data = {
            "string": textbox.innerText
        };
        xhttp.send(JSON.stringify(data));
    }

    function autoCheck() {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "index.php");
        xhttp.setRequestHeader("Content-Type", "application/json");

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                textbox.innerHTML = data["string"];

                var bs_alert = document.getElementById("bootstrap-alert");

                if ("message" in data) {
                    bs_alert.innerText = data["message"];
                    bs_alert.style.display = "block";
                } else bs_alert.style.display = "none";
            }
        };

        var data = {
            "auto_string": textbox.innerText
        };
        xhttp.send(JSON.stringify(data));
    }
</script>