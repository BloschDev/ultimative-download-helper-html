<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>UDH by Blosch</title>
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
    </script>
</head>
<body>	
	<style>
body {font-family: "Lato", sans-serif;}

.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}

.tablink:hover {
  background-color: #777;
}

/* Style the tab content */
.tabcontent {
  color: white;
  display: none;
  padding: 50px;
  text-align: center;
}

#London {background-color:red;}
#Paris {background-color:green;}
#Tokyo {background-color:blue;}
#Oslo {background-color:orange;}
</style>
</head>
<body>
<center>Rev. 0.0.3a</center>
<div id="downloader" class="tabcontent">
  <h1>Downloader for Any</h1>
  <p>Gallery-DL </p>
  <h1>Ultimative Download Helper</h1>
    <form onsubmit="event.preventDefault(); startDownload();">
        <label for="url">Enter a URL:</label>
        <input type="text" id="url" name="url" required>
        <button type="submit">Download</button>
    </form>
    <button onclick="stopDownload()">Stop</button>
    <button onclick="updateRepo()">Update</button>
    <iframe id="output" style="width:100%; height:300px; border:1px solid black;"></iframe><br>
	
</div>

<div id="youtube" class="tabcontent">
  <h1>Youtube-DL</h1>
  <p>Downloader for Youtube</p> 
</div>

<div id="updates" class="tabcontent">
  <h1>Updates</h1>
  <p>What is new?</p>
</div>


<button class="tablink" onclick="openCity('downloader', this, 'red')" id="defaultOpen">Main Downloader</button>
<button class="tablink" onclick="openCity('youtube', this, 'red')">YT-Downloader</button>
<button class="tablink" onclick="openCity('updates', this, 'blue')">Updates</button>

<script>
function openCity(cityName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(cityName).style.display = "block";
  elmnt.style.backgroundColor = color;

}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
	
	
</body>
</html>
