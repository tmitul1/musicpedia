<?php 
require 'header.php'; 
include_once 'connect.php';
?>

      <div class="search-container">
         <form class="search-form">
               <input class="search-input" type="text" placeholder="Search..." name="search" method="get">
               <button class="search-btn" type="submit" name="Search">Search</button>
         </form>
      </div>


      <div class="results">
      
         <table class="results-table">
            <thead>
            <tr>
               <th class="sName">Song Name</th>
               <th class="artName">Artist</th>
               <th class="alName">Album</th>
               <th class="dur">Duration</th>
            </tr>	
            </thead>     
      <?php
      /*
       * Queries for songs, arists, and albums
       */
      //---- song ----//
      $song_query = "SELECT
                           *
                     FROM
                           songs
                     LEFT JOIN albums
                     ON songs.album_id = albums.album_id
                     LEFT JOIN artists
                     ON songs.artist_id = artists.artist_id";
      //---- artist ----//
      $artist_query = "SELECT DISTINCT
                           artists.artist_id, artists.artist_name
                     FROM
                           songs
                     LEFT JOIN albums
                     ON songs.album_id = albums.album_id
                     LEFT JOIN artists
                     ON songs.artist_id = artists.artist_id";
      //---- album ----//
      $album_query = "SELECT DISTINCT
                           albums.album_id, albums.album_name, albums.album_duration
                     FROM
                           songs
                     LEFT JOIN albums
                     ON songs.album_id = albums.album_id
                     LEFT JOIN artists
                     ON songs.artist_id = artists.artist_id";


      /*
       * Filter using search bar
       */
      if(!empty($_GET['search']) && !is_null($_GET['search'])){
         $searchval = $_GET['search'];

         echo "<br> Searching for \"".$searchval."\" <a class='clear_btn' href=\"index.php?search=\">Clear</a>";
        // echo "<a class='clear_btn' href=\"index.php?search=\">Clear</a>";
         $join = "
         SELECT * FROM songs
         LEFT JOIN albums
         ON songs.album_id = albums.album_id
         LEFT JOIN artists
         ON songs.artist_id = artists.artist_id";
         $clause = "WHERE song_name LIKE '%".$searchval."%'
         OR artists.artist_name LIKE '%".$searchval."%'
         OR albums.album_name LIKE '%".$searchval."%'";

      //---- song ----//
         $song_query = $song_query.
                  " WHERE song_name LIKE '%".$searchval."%'
                  OR artists.artist_name LIKE '%".$searchval."%'
                  OR albums.album_name LIKE '%".$searchval."%'
                  ORDER BY albums.album_name";
      //---- artist ----//
         $artist_query = $artist_query.
                  " WHERE song_name LIKE '%".$searchval."%'
                  OR artists.artist_name LIKE '%".$searchval."%'
                  OR albums.album_name LIKE '%".$searchval."%'
                  ORDER BY albums.album_name";
      //---- album ----//
         $album_query = $album_query.
                  " WHERE song_name LIKE '%".$searchval."%'
                  OR artists.artist_name LIKE '%".$searchval."%'
                  OR albums.album_name LIKE '%".$searchval."%'
                  ORDER BY albums.album_name";

      } else {
      }

      // ========= SONGS ========= //
      echo "<h3>Songs</h3>";

      /*
      * Get all songs using search filter
      */
      $songs_result = $conn->query($song_query);//song_query

      /*
      * Fetch song results
      */
      if($songs_result && $songs_result->num_rows > 0){
         while($row = $songs_result->fetch_assoc()){

            // song artist cols
            // song_id | album_id | artist_id | genre_id | song_name | song_duration

            //get all the info for songs searched
            $song1_query = $conn->query("SELECT * FROM songs WHERE song_id=".$row['song_id']);
            $song_result = $song1_query->fetch_row();


            $songartist_query = $conn->query("SELECT artist_name FROM artists WHERE artist_id=".$row['artist_id']);
				$songalbum_query = $conn->query("SELECT album_name FROM albums WHERE album_id=".$row['album_id']);

				$songartist_result = $songartist_query->fetch_row();
				$songalbum_result = $songalbum_query->fetch_row();

            // Check if artist is null
            if(!is_null($songartist_result)){
               $artist_name = $songartist_result[0]; 
            }

            // Print song and artist
           // echo $row['song_name']." - ".$artist_name." [<a href=\"displaypage.php?id=".$row['song_id']."&table=songs\">view</a>]<br>";

            echo "<tr>";
               echo "<td>".$song_result[4]."</td>";
               echo "<td>".$songartist_result[0]."</td>";
               echo "<td>".$songalbum_result[0]."</td>";
               echo "<td>".gmdate("i:s", $song_result[5])."</td>"; //only mins and sec for songs
            echo "</tr>";

         }
         echo "</table>";
      } else {
         echo "<tr> 
                  <td colspan='5' style='font-weight: bold; font-size: 20px;'> No results </td>
               </tr>";
         echo "</table>";
      }

// ========= Artists ========= //
      echo "<h3>Artists</h3>";
      echo "<ul class='main_artistCard'>";
   
      $artist_result = $conn->query($artist_query); //artist query

      /*
       * Fetch artists results
       */
      if(($artist_result && $artist_result->num_rows > 0)){
         while($row = $artist_result->fetch_assoc()){
            //echo $row['artist_name']." [<a href=\"displaypage.php?id=".$row['artist_id']."&table=artists\">view</a>]<br>";
            echo "<li> <a href=\"displaypage.php?id=".$row['artist_id']."&table=artists\">".$row['artist_name']."<br></a> </li>";
         }
         echo "</ul>";
      } else {
         echo "No results<br>";
      }

// ========= Albums ========= //
      echo "<h3>Albums</h3>";
      echo "<ul class='main_albumCard'>";
      $album_result = $conn->query($album_query);//album_query

      /*
       * Fetch album results
       */
      if($album_result && $album_result->num_rows > 0){
         while($row = $album_result->fetch_assoc()){
            echo "<li>  <a href=\"displaypage.php?id=".$row['album_id']."&table=albums\">".$row['album_name']." <br>".gmdate("H:i:s", $row['album_duration']). "<br></a> </li>";
         }
         echo "</ul>";
      } else {
         echo "No results<br>";
      }
   

      // Close connection
      $conn->close();
      ?>

      <!-- Hidden form used to send values to display page -->
      <form method="get" action="displaypage.php">
         <input type="hidden" name="id" value="">
         <input type="hidden" name="table" value="">
      </form> 
      </div> <!-- results -->
   </div>
   </div>
</body>
</html>