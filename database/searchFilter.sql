SELECT
    *
FROM
    songs
LEFT JOIN albums
ON songs.album_id = albums.album_id
LEFT JOIN artists
ON songs.artist_id = artists.artist_id
WHERE song_name LIKE '%kendrick%'
OR artists.artist_name LIKE '%kendrick%'
OR albums.album_name LIKE '%kendrick%'
ORDER BY albums.album_name;




SELECT  *
FROM
    songs
LEFT JOIN albums
ON songs.album_id = albums.album_id
LEFT JOIN artists
ON songs.artist_id = artists.artist_id
WHERE song_name LIKE '%%'
OR artists.artist_name LIKE '%%'
OR albums.album_name LIKE '%%'
ORDER BY albums.album_name;


SELECT * FROM songs LEFT JOIN albums ON songs.album_id = albums.album_id WHERE songs.artist_id=141414 ORDER BY album_name;