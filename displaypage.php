<?php 
require 'header.php'; 
include_once 'connect.php';
?>
<?php 
	if(is_null($_GET['id']) || empty($_GET['id'])){
		header("Location: index.php");
	}	
?>
<?php
	// The ID and type of data we are displaying (song, album, or artist);
	$id = $_GET['id']; 
	$table = $_GET['table'];
	
	// Select everything from the specified database
	$query = "";

	if(strcmp($table, "songs") == 0){
	$query = "SELECT * FROM songs WHERE song_id=".$id;
	} else if(strcmp($table, "artists") == 0){
	$query = "SELECT * FROM artists WHERE artist_id=".$id;
	} else if(strcmp($table, "albums") == 0){
	$query = "SELECT * FROM albums WHERE album_id=".$id;
	}

	$result = $conn->query($query);

	/*
	* Get results based on table value
	* The outer while loop will always result in O(1) since ID is unique in every table
	*/

	?>
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
	if($result && $result->num_rows > 0){
		while($row = $result->fetch_assoc()){

			// If value is from songs table 
			// might make it so it doesn't come from songs list, only artist or album
			if(strcmp($table, "songs") == 0){

				//echo "Displaying info for \"".$row['song_name']."\" [<a href=\"index.php\">back</a>]<br><br>";
				echo "<a class='back_btn' href=\"index.php\">back</a>";

				// Get album, genre, and artist associated with song
				$songartist_query = $conn->query("SELECT artist_name, artist_id FROM artists WHERE artist_id=".$row['artist_id']);
				$songalbum_query = $conn->query("SELECT album_name, album_id FROM albums WHERE album_id=".$row['album_id']);
				$songgenre_query = $conn->query("SELECT genre_name, genre_id FROM genres WHERE genre_id=".$row['genre_id']);

				$songartist_result = $songartist_query->fetch_row();
				$songalbum_result = $songalbum_query->fetch_row();
				$songgenre_result = $songgenre_query->fetch_row();

				//Display data
				//name
				echo "<tr>";
					echo "<td>".$row['song_name']."</td>";
					echo "<td>".$songartist_result[0]."</td>";
					echo "<td>".$songalbum_result[0]."</td>";
					echo "<td>".gmdate("i:s", $row['song_duration'])."</td>"; //only mins and sec for songs
				echo "<tr>";

				//echo "Duration: ".gmdate("H:i:s", $row['song_duration'])."<br>";
				//echo "ID: ".$row['song_id']."<br>";
				/*
				echo "Name: ".$row['song_name']."<br>";
				echo "Artist: ".$songartist_result[0]." (Artist ID: ".$songartist_result[1].")<br>";
				echo "Album: ".$songalbum_result[0]." (Album ID: ".$songalbum_result[1].")<br>";
				echo "Genre: ".$songgenre_result[0]." (Genre ID: ".$songgenre_result[1].")<br>";
				echo "Duration: ".gmdate("H:i:s", $row['song_duration'])."<br>";
				*/
			} 

			
			// If value is from artists table
			if(strcmp($table, "artists") == 0){

				//echo "Displaying info for \"".$row['artist_name']."\" [<a href=\"index.php\">back</a>]<br><br>";
				echo "<a class='back_btn' href=\"index.php\">back</a>";
				// Get songs and albums associated with artists
				$artist_songs_query = $conn->query("SELECT * FROM songs LEFT JOIN albums ON songs.album_id = albums.album_id WHERE songs.artist_id=".$row['artist_id']." ORDER BY album_name");
				$artist_album_query1 = $conn->query("SELECT album_name, album_duration, album_id FROM albums WHERE artist_id=".$row['artist_id']);

				// Display data === put artist info here
				echo "<div class='artistHead'>";
				echo "<h2>".$row['artist_name']."</h2>";
				echo "</div>";

				echo "<h3>Songs</h3>";

				// List songs
				while($artist_songs_result = $artist_songs_query->fetch_assoc()){

				// $songartist_query = $conn->query("SELECT artist_name FROM artists WHERE artist_id=".$row['artist_id']);
				$artist_album_query = $conn->query("SELECT album_name FROM albums WHERE album_id=".$artist_songs_result['album_id']);

				// $songartist_result = $songartist_query->fetch_row();
				$artist_album_result = $artist_album_query->fetch_row();

					echo "<tr>";
						echo "<td>".$artist_songs_result['song_name']."</td>";
						echo "<td>".$row['artist_name']."</td>";
						echo "<td>".$artist_album_result[0]."</td>";
						echo "<td>".gmdate("i:s", $artist_songs_result['song_duration'])."</td>"; //only mins and sec for songs
					echo "</tr>";

					//echo $artistsongs_result['song_name']." (Song ID: ".$artistsongs_result['song_id'].")<br>";
				}
				echo "</table>";

				// List albums
				echo "<h3>Albums</h3>";

				echo "<ul class='albumCard'>";
	

				while($artist_album_result1 = $artist_album_query1->fetch_assoc()){
					//echo "<li>".$artist_album_result1['album_name']." <br>".gmdate("H:i:s", $artist_album_result1['album_duration']). "</li>";
					echo "<li>  <a href=\"displaypage.php?id=".$artist_album_result1['album_id']."&table=albums\">".$artist_album_result1['album_name']." <br>".gmdate("H:i:s", $artist_album_result1['album_duration']). "<br></a> </li>";
				}
			}


			// If value is from albums table
			if(strcmp($table, "albums") == 0){

				//echo "Displaying info for \"".$row['album_name']."\" [<a href=\"index.php\">back</a>]<br><br>";

				echo "<a class='back_btn' href=\"index.php\">back</a>";
				// Get songs from album
				$album_songs_query = $conn->query("SELECT * FROM songs WHERE album_id=".$row['album_id']);

				// Display data
				echo "<div class='albumHead'>";
					echo "<div class='album_image'>";
						echo "<img src='images/".$row['album_cover'].".png' alt='album cover'> ";
					echo "</div>";
					echo "<div class='album_info'>";
						echo "<h2>".$row['album_name']."</h2>";
						echo $row['year']."<br>";
						echo gmdate("H:i:s",$row['album_duration'])."<br>";
					echo "</div>";
				echo "</div>";

				echo "<h3>Songs</h3>";

				// List songs
				while($album_songs_result = $album_songs_query->fetch_assoc()){
					$album_artist_query = $conn->query("SELECT artist_name FROM artists WHERE artist_id=".$row['artist_id']);
					$album_query = $conn->query("SELECT album_name FROM albums WHERE album_id=".$album_songs_result['album_id']);

					$album_artist_result = $album_artist_query->fetch_row();
					$album_result = $album_artist_query->fetch_row();
	
						echo "<tr>";
							echo "<td>".$album_songs_result['song_name']."</td>";
							echo "<td>".$album_artist_result[0]."</td>";
							echo "<td>".$row['album_name']."</td>";
							echo "<td>".gmdate("i:s", $album_songs_result['song_duration'])."</td>"; //only mins and sec for songs
						echo "</tr>";
	

					//echo $albumsongs_result['song_name']." (Song ID: ".$albumsongs_result['song_id'].")<br>";
				}
				echo "</table>";
			}


		}	
	} else {
		echo "Could not display info. Please try again later<br>";
	}

$conn->close();
?>

</div>
</body>


</html>