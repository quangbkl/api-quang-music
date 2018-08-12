<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include './database.php';

$music_arr = array();
$music_arr['data'] = array();

$conn = connectToDatabase();

$sql = "SELECT id_music, name_music FROM list_music";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$music_arr['success'] = true;

    while($row = mysqli_fetch_assoc($result)) {
        $music_item = array(
        	'id'=> $row['id_music'],
        	'name'=> $row['name_music']
        );

        array_push($music_arr['data'], $music_item);
    }
} else {
    $music_arr['success'] = false;
    $music_arr['message'] = 'No item result.';
}

echo json_encode($music_arr);

mysqli_close($conn);
?>