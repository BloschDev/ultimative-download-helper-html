<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Downloader</title>
    <script>
        function startDownload() {
            var url = document.getElementById("url").value;
            var iframe = document.getElementById("console");
            iframe.src = "download-yt.php?url=" + encodeURIComponent(url);
        }

        function stopDownload() {
            fetch("stop-yt.php")
                .then(response => response.text())
                .then(data => alert(data));
        }
    </script>
</head>
<body>
    <h1>YouTube Downloader</h1>
    <form action="javascript:void(0);" method="post" onsubmit="startDownload()">
        <label for="url">YouTube URL:</label>
        <input type="text" id="url" name="url" required>
        <button type="submit">Download</button>
        <button type="button" onclick="stopDownload()">Stop</button>
    </form>
    <iframe id="console" style="width: 100%; height: 400px;"></iframe>
</body>
</html>
