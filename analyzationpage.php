<html>
    <head> 
        <title> Spotify Playlist Analyzer</title>
    </head> 

    <style>

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
	        text-align: center;
        }

        table{
            width: 100%;
        } 

        body {
        background-image: linear-gradient(rgb(23, 202, 23), black);
        height: 90;
        color: white; 
        text-align: center; 
    } 

    .dropdown{ 
        position: relative; 
        display: inline-block;
        
        
    } 

    .dropdown-content{ 
        display: none; 
        position: absolute; 
        background-color: transparent; 
        min-width: 160px; 
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); 
        padding: 4px 8px; 
         
    } 

    .dropdown:hover .dropdown-content{
        display: block;
    }
    
    </style>

    <script> 

        var xmlhttp = new XMLHttpRequest(); 
        var url = "https://api.spotify.com/v1/me/playlists"; 
        xmlhttp.open("GET", url, true);
        xmlhttp.setRequestHeader("Accept", "application/json");
        xmlhttp.setRequestHeader("Content-Type", "application/json");
        xmlhttp.setRequestHeader("Authorization", "Bearer BQBdmIziQkwwZ2rDpNa2O7Dhdpdlt-bxggKtDbZbPhzHRRwp9RM7c7JgOL2WV3STmNe2RandW70wRPgfp649uASg2AQJ27LncMbYiMvIeCQ2sHAQNE74koIfzQj3MfLkzJ_0ptTHRCMjz8aQ");



        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myArr = JSON.parse(this.responseText);
                console.log(this.responseText);
                myFunction(myArr);
            }
        }; 
        
        xmlhttp.send();

        function myFunction(arr) {
            var out = "";
            var i;
            for(i = 0; i < arr.length; i++) {
                out += '<a href="' + arr[i].url + '">' +
                arr[i].display + '</a><br>';
            }
            document.getElementById("id01").innerHTML = out;
        }

        /* function getPlaylists(){ 
            GET "https://api.spotify.com/v1/me/playlists"; 
        } */

    </script>

    <body> 
        <h1> Spotify Playlist Analyzer </h1> 
        <div class="dropdown" onclick="getPlaylists()"> 
            <span> Select your desired playlist</span> 
            <div class="dropdown-content" > 
                <p> test select</p> <!-- this is where the playlists will be inputed through spotify -->
            </div> 
        </div>
    
        <div id="id01"> </div> 

    <br>
    <br> 
    <br>
    <br> 
    <br>

    <?php /* beginning of php code */
    //data base information and login
    $servername = "localhost"; 
    $username = "root";  
    $password = "";
    $dbname = "spotifyplaylistanalyzer"; 

    $conn = new mysqli($servername, $username, $password, $dbname); //initiates connection

    if ($conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }
    
    if(isset($_GET["Playlist"])){ 
        $Playlist = $_GET['Playlist'];

        $sql = "INSERT INTO spotifyplaylistanalyzer (Playlist, Song Title, Artist, Duartion, Genre, Album, Amount Skipped, Amount Rewound)
        Values ('$Playlist' Now(), Null)";

        if ($conn->query($sql)){
            echo "<p> New record created successfully</p>"; 
               
        } 

        else { 
        echo "Error: " . $sql . "<br>" . $conn->error; 
        } 
        
    } 

    //output 

    $sql = "SELECT * FROM  spotifyplaylistanalyzer"; 
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {
        echo "<table><tr><th>Playlist</th><th>Song Title</th><th>Artist</th><th>Duration<th>Genre</th><th>Album</th> 
        <th>Amount Skipped</th><th>Amount Rewound</th>"; //sets the headings of the table
        while ($row = $result->fetch_assoc()){
            echo "<tr><td>" . $row["Playlist"] . "</td><td>" . $row["Song Title"] . "</td><td>" . $row["Artist"] . "</td><td>" . $row["Duration"] . 
            "</td><td>" . $row["Genre"] . "</td><td>" . $row["Album"] . "</td><td>" . $row["Amount Skipped"] . "</td><td>" . $row["Amount Rewound"] . "</td></tr>";
        } //sets the headings of the table
        echo "</table>";
    } 
    else { 
        echo "0 results";
    } 
    $conn->close();  
    ?>     <!-- End of php code -->

    </body>
</html>

