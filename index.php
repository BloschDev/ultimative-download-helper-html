<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Gallery DL</title>
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
    <h1>Gallery DL Downloader</h1>
    <form onsubmit="event.preventDefault(); startDownload();">
        <label for="url">URL eingeben:</label>
        <input type="text" id="url" name="url" required>
        <button type="submit">Download</button>
    </form>
    <button onclick="stopDownload()">Stop</button>
    <button onclick="updateRepo()">Update</button>
    <iframe id="output" style="width:100%; height:300px; border:1px solid black;"></iframe>
</body>
</html>
