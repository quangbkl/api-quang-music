<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include './database.php';

$id = $_POST['id'];
// $id = 'BKL';

$music_arr = array();
$music_arr['data'] = array();

$conn = connectToDatabase();

$sql = 'SELECT id_music, name_music, src_music, lyrics_music FROM list_music WHERE id_music = "'.$id.'"';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $music_arr['success'] = true;

    while($row = mysqli_fetch_assoc($result)) {
        $music_item = array(
            'id'=> $row['id_music'],
            'name'=> $row['name_music'],
            'src'=> $row['src_music'],
            'lyrics'=> getLyrics($row['lyrics_music'])
        );

        array_push($music_arr['data'], $music_item);
    }
} else {
    $music_arr['success'] = false;
    $music_arr['message'] = 'No item result.';
}

// echo file_get_contents('lyrics/lyrics.txt');

echo json_encode($music_arr);

mysqli_close($conn);

function getLyrics($src) {
    return json_decode(file_get_contents($src));
}
?>