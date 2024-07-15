<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Downloader</title>
    <script>
        let xhrGalleryDl;
        let xhrYtDlp;
        let xhrDeploy;
        let pollingGalleryDl;
        let pollingYtDlp;
        let pollingDeploy;

        function startDownloadGalleryDl() {
            const url = document.getElementById('url-gallery-dl').value;
            if (!url) {
                alert("Bitte eine URL eingeben.");
                return;
            }

            xhrGalleryDl = new XMLHttpRequest();
            xhrGalleryDl.open('POST', 'start_download_gallery_dl.php', true);
            xhrGalleryDl.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhrGalleryDl.onreadystatechange = function() {
                if (xhrGalleryDl.readyState == 4 && xhrGalleryDl.status == 200) {
                    document.getElementById('output-gallery-dl').contentDocument.body.innerHTML = "Download gestartet...<br>";
                    startPollingGalleryDl();
                }
            };

            xhrGalleryDl.send('url=' + encodeURIComponent(url));
        }

        function startDownloadYtDlp() {
            const url = document.getElementById('url-yt-dlp').value;
            if (!url) {
                alert("Bitte eine URL eingeben.");
                return;
            }

            xhrYtDlp = new XMLHttpRequest();
            xhrYtDlp.open('POST', 'start_download_yt_dlp.php', true);
            xhrYtDlp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhrYtDlp.onreadystatechange = function() {
                if (xhrYtDlp.readyState == 4 && xhrYtDlp.status == 200) {
                    document.getElementById('output-yt-dlp').contentDocument.body.innerHTML = "Download gestartet...<br>";
                    startPollingYtDlp();
                }
            };

            xhrYtDlp.send('url=' + encodeURIComponent(url));
        }

        function startPollingGalleryDl() {
            pollingGalleryDl = setInterval(() => {
                fetch('get_output_gallery_dl.php')
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim().length > 0) {
                            const outputIframe = document.getElementById('output-gallery-dl');
                            outputIframe.contentDocument.body.innerHTML += data;
                            outputIframe.contentWindow.scrollTo(0, outputIframe.contentDocument.body.scrollHeight);
                        }
                    });
            }, 1000);
        }

        function startPollingYtDlp() {
            pollingYtDlp = setInterval(() => {
                fetch('get_output_yt_dlp.php')
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim().length > 0) {
                            const outputIframe = document.getElementById('output-yt-dlp');
                            outputIframe.contentDocument.body.innerHTML += data;
                            outputIframe.contentWindow.scrollTo(0, outputIframe.contentDocument.body.scrollHeight);
                        }
                    });
            }, 1000);
        }

        function startDeploy() {
            xhrDeploy = new XMLHttpRequest();
            xhrDeploy.open('POST', 'deploy.php', true);
            xhrDeploy.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhrDeploy.onreadystatechange = function() {
                if (xhrDeploy.readyState == 4 && xhrDeploy.status == 200) {
                    document.getElementById('output-deploy').contentDocument.body.innerHTML = "Deploy gestartet...<br>";
                    startPollingDeploy();
                }
            };

            xhrDeploy.send();
        }

        function startPollingDeploy() {
            pollingDeploy = setInterval(() => {
                fetch('get_output_deploy.php')
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim().length > 0) {
                            const outputIframe = document.getElementById('output-deploy');
                            outputIframe.contentDocument.body.innerHTML += data;
                            outputIframe.contentWindow.scrollTo(0, outputIframe.contentDocument.body.scrollHeight);
                        }
                    });
            }, 1000);
        }

        function stopPolling(polling) {
            clearInterval(polling);
        }
    </script>
</head>
<body>
    <h1>Downloader</h1>
    <div>
        <h2>Gallery DL Downloader</h2>
        <form onsubmit="event.preventDefault(); startDownloadGalleryDl();">
            <label for="url-gallery-dl">URL eingeben:</label>
            <input type="text" id="url-gallery-dl" name="url-gallery-dl" required>
            <button type="submit">Download</button>
        </form>
        <iframe id="output-gallery-dl" style="width:100%; height:300px; border:1px solid black;"></iframe>
    </div>

    <div>
        <h2>YoutubeDL</h2>
        <form onsubmit="event.preventDefault(); startDownloadYtDlp();">
            <label for="url-yt-dlp">URL eingeben:</label>
            <input type="text" id="url-yt-dlp" name="url-yt-dlp" required>
            <button type="submit">Download</button>
        </form>
        <iframe id="output-yt-dlp" style="width:100%; height:300px; border:1px solid black;"></iframe>
    </div>

    <div>
        <h2>Deploy</h2>
        <button onclick="startDeploy()">Deploy</button>
        <iframe id="output-deploy" style="width:100%; height:300px; border:1px solid black;"></iframe>
    </div>
</body>
</html>
