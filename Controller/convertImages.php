<?php 
require './connection.php';

$query = "SELECT id, dev_id FROM _f_device WHERE file IS NOT NULL AND file != ''";
$result = $conn->query($query);
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$fileQuery = "SELECT file FROM _f_device WHERE id = ".$row["id"];
		$fileResult = $conn->query($fileQuery);
		$fileRow = $fileResult->fetch_assoc();
		$output_file = "./../upload/images/".$row["dev_id"].".jpeg";
		$base_file = "./../upload/base64img/".$row["dev_id"].".txt";
		$convertFile = base64_to_jpeg($fileRow["file"], $output_file, $base_file);
		$updateData = "UPDATE _f_device SET file = '".$row["dev_id"].".jpeg' WHERE id = ".$row["id"];
		$updateRes = $conn->query($updateData);
		echo $convertFile;
	}
}

function base64_to_jpeg($base64_string, $output_file, $base_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $base64_string ) );
    // clean up the file resource
    fclose( $ifp );

    $bfp = fopen($base_file, 'wb');
    fwrite($bfp, $base64_string);
    fclose($bfp); 

    return $output_file; 
}
?>
