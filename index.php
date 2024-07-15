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



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>UDH by Blosch</title>
<style>
* {box-sizing: border-box}

/* Set height of body and the document to 100% */
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial;
}

/* Style tab links */
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

/* Style the tab content (and add height:100% for full page content) */
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
}

#Home {background-color: red;}
#News {background-color: green;}
#Contact {background-color: blue;}
#About {background-color: orange;}
</style>
</head>
<body>

<button class="tablink" onclick="openPage('Home', this, 'green')">Home</button>
<button class="tablink" onclick="openPage('News', this, 'blue')" id="defaultOpen">News</button>
<button class="tablink" onclick="openPage('Contact', this, 'red')">Contact</button>

<div id="Home" class="tabcontent">
  <h3>Main Downloader</h3>
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



<div id="Contact" class="tabcontent">
  <h3>YT-Downloader</h3>
  <p>WIP - Another Update</p>
</div>
<div id="News" class="tabcontent">
  <h3>Updates</h3>
  <p>Some news this fine day!</p> 
</div>


<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
	
	
</body>
</html>
