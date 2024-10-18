CREATE TABLE IF NOT EXISTS music_artist(
  id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) COLLATE latin1_general_ci NOT NULL,
  email VARCHAR(100) COLLATE latin1_general_ci NOT NULL,
  age TINYINT UNSIGNED NOT NULL,
  image_path VARCHAR(250),
  song_write VARCHAR(200) COLLATE latin1_general_ci NOT NULL
);