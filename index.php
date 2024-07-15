<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Gallery DL</title>
	<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
    <script>
        let xhr;
        let polling;

        function startDownload() {
            const url = document.getElementById('url').value;
            if (!url) {
                alert("Bitte eine URL eingeben.");
                return;
            }

            // Start the download process
            xhr = new XMLHttpRequest();
            xhr.open('POST', 'start_download.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('output').contentDocument.body.innerHTML = "Download gestartet...<br>";
                    startPolling();
                }
            };

            xhr.send('url=' + encodeURIComponent(url));
        }

        function stopDownload() {
            if (xhr) {
                xhr.abort();
                stopPolling();
                document.getElementById('output').contentDocument.body.innerHTML += "Download gestoppt.<br>";
                fetch('stop.php', { method: 'POST' });
            }
        }

        function startPolling() {
            polling = setInterval(() => {
                fetch('get_output.php')
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim().length > 0) {
                            const outputIframe = document.getElementById('output');
                            outputIframe.contentDocument.body.innerHTML += data;
                            outputIframe.contentWindow.scrollTo(0, outputIframe.contentDocument.body.scrollHeight);
                        }
                    });
            }, 1000);
        }

        function stopPolling() {
            clearInterval(polling);
        }

        function updateRepo() {
            fetch('update_repo.php', { method: 'POST' })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('output').contentDocument.body.innerHTML += data + "<br>";
                    document.getElementById('output').contentWindow.scrollTo(0, document.getElementById('output').contentDocument.body.scrollHeight);
                });
        }
		
		function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

        function startDownload2() {
            var url = document.getElementById("url").value;
            var iframe = document.getElementById("console");
            iframe.src = "download-yt.php?url=" + encodeURIComponent(url);
        }

        function stopDownload2() {
            fetch("stop-yt.php")
                .then(response => response.text())
                .then(data => alert(data));
        }

    </script>
</head>

<body>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Main')">Main</button>
  <button class="tablinks" onclick="openCity(event, 'YT')">Youtube</button>
  <button class="tablinks" onclick="openCity(event, 'UPDATES')">News</button>
</div>

<div id="Main" class="tabcontent">
  <h3>Main Downloader</h3>
  <p>Based on Gallery-DL</p>
    <form onsubmit="event.preventDefault(); startDownload();">
        <label for="url">URL eingeben:</label>
        <input type="text" id="url" name="url" required>
        <button type="submit">Download</button>
    </form>
    <button onclick="stopDownload()">Stop</button>
    <button onclick="updateRepo()">Update</button>
    <iframe id="output" style="width:100%; height:300px; border:1px solid black;"></iframe>
</div>

<div id="YT" class="tabcontent">
   <h1>YouTube Downloader</h1>
    <form action="javascript:void(0);" method="post" onsubmit="startDownload2()">
        <label for="url">YouTube URL:</label>
        <input type="text" id="url" name="url" required>
        <button type="submit">Download</button>
        <button type="button" onclick="stopDownload2()">Stop</button>
    </form>
    <iframe id="console" style="width: 100%; height: 400px;"></iframe>
</div>

<div id="UPDATES" class="tabcontent">
  <h3>Updates</h3>
  <p>What is new?</p>
  <br>
  <br>
  <p> <b> Rev. 0.0.3a</b>
  <p> This is the Alpha Version of my awesome Download GUI.
  <p>Yes, why a download helper? I'm tired of entering everything via the console, and there are no good interfaces or web GUIs for YT-DL or Gallery-DL anymore, or they are no longer being developed. That's why I created this project as an all-in-one package.
</div>


</body>
</html>
