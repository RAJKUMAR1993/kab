<?php 
error_reporting(0);

/*// Enter the name of directory 
$pathdir = "vendor/"; 

// Enter the name to creating zipped directory 
$zipcreated = "out.zip"; 

// Create new zip class 
$zip = new ZipArchive; 

if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) { 
	
	// Store the path into the variable 
	$dir = opendir($pathdir); 
	
	while($file = readdir($dir)) { 
		if(is_file($pathdir.$file)) { 
			$zip -> addFile($pathdir.$file, $file); 
		} elseif (is_dir($filePath)) { 
          // Add sub-directory. 
          $zipFile->addEmptyDir($localPath); 
          self::folderToZip($filePath, $zipFile, $exclusiveLength); 
        }  
	} 
	$zip ->close(); 
}*/ 

?> 
<?php
/*function folderToZip($folder, &$zipFile, $subfolder = null) {
    if ($zipFile == null) {
        // no resource given, exit
        return false;
    }
    // we check if $folder has a slash at its end, if not, we append one
    $folder .= end(str_split($folder)) == "/" ? "" : "/";
    $subfolder .= end(str_split($subfolder)) == "/" ? "" : "/";
    // we start by going through all files in $folder
    $handle = opendir($folder);
    while ($f = readdir($handle)) {
        if ($f != "." && $f != "..") {
            if (is_file($folder . $f)) {
                // if we find a file, store it
                // if we have a subfolder, store it there
                if ($subfolder != null)
                    $zipFile->addFile($folder . $f, $subfolder . $f);
                else
                    $zipFile->addFile($folder . $f);
            } elseif (is_dir($folder . $f)) {
                // if we find a folder, create a folder in the zip 
                $zipFile->addEmptyDir($f);
                // and call the function again
                folderToZip($folder . $f, $zipFile, $f);
            }
        }
    }
}*/

/*echo '<pre>';


function Zip( $source, $destination , $excludes=[]) {
	
	$root = $source."/".str_replace("\\","/",__DIR__)."/";
	
	if ( is_string( $source ) )$source_arr = array( $source ); // convert it to array

	if ( !extension_loaded( 'zip' ) ) {
		return false;
	}

	$zip = new ZipArchive();
	if ( !$zip->open( $destination, ZIPARCHIVE::CREATE ) ) {
		return false;
	}
//	if()
		$zip->addEmptyDir($source);

	foreach ( $source_arr as $source ) {
		if ( !file_exists( $source ) ) continue;
		
		$asource = $source;
		$source = str_replace( '\\', '/', realpath( $source ) );

		if ( is_dir( $source ) === true ) {
			$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $source ), RecursiveIteratorIterator::SELF_FIRST );
			foreach ( $files as $file ) {
				$file = str_replace( '\\', '/', realpath( $file ) );
				
				if ( is_dir( $file ) === true ) {
				
					$dfile = str_replace( $source . '/', '', $file . '/' );
					$dfile = $asource."/".$dfile;
//					echo "Dir - ".$dfile."<br>";		
					
					if($dfile != $root)
						$zip->addEmptyDir($dfile);
					
				} else if (is_file( $file ) === true) {
					
					$ffile = str_replace( $source . '/', '', $file );
					$ffile = $asource."/".$ffile;
//					echo "File- ".$ffile."<br>";
					$dname = pathinfo($ffile, PATHINFO_DIRNAME);
					
					
					if(($asource != "uploads") && (!in_array($dname,$excludes))){
//						echo $asource." ".$ffile."<br>";
						$zip->addFromString($ffile, file_get_contents( $ffile ) );
					}
				}
			}
		} else if ( is_file( $source ) === true ) {
			$zip->addFromString( basename( $source ), file_get_contents( $source ) );
		}

	}

	return $zip->close();

}*/
?>
<?php

/*$outputfile_name = "test.zip";

Zip("application",$outputfile_name,["application/logs"]);
Zip("uploads",$outputfile_name,["uploads"]);
Zip("services",$outputfile_name);
Zip("system",$outputfile_name);
Zip("tests",$outputfile_name);
Zip("vendor",$outputfile_name);
Zip("assets",$outputfile_name,["assets/advertise","assets/auditorium","assets/auditorium/images","assets/categories","assets/clients","assets/experts","assets/images/blog","assets/images/brochure","assets/images/cards","assets/images/front","assets/images/gallery","assets/images/guests","assets/images/homepage","assets/images/image-gallery","assets/images/partners","assets/images/lg","assets/images/picsadd","assets/images/professors","assets/images/testimonials","assets/images/webinars","assets/institutes","assets/institutes/studentplacement","assets/news","assets/placements","assets/questions","assets/speakers","assets/videos","assets/zoomvideos"]);

Zip(".htaccess",$outputfile_name);
Zip(".user.ini",$outputfile_name);
Zip("composer.json",$outputfile_name);
Zip("composer.lock",$outputfile_name);
Zip("index.php",$outputfile_name);*/

?>



<?php

define("MAX_EXECUTION_TIME", 100); // seconds

$timeline = time() + MAX_EXECUTION_TIME;

EXPORT_TABLES('localhost', 'root', '', 'vfair',false,"vfair_database.sql",["countries","states","tbl_admin_menu","tbl_countries","tbl_footer_menu","tbl_footer_menu","tbl_footer_submenu","tbl_menu_header","	tbl_states","tbl_types"]);

function EXPORT_TABLES($host, $user, $pass, $name, $tables = false, $backup_name = false,$rtables)
{
    $mysqli = new mysqli($host, $user, $pass, $name);
    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");
    $queryTables = $mysqli->query('SHOW TABLES');
    while ($row = $queryTables->fetch_row())
    {
        $target_tables[] = $row[0];
    }
    if ($tables !== false)
    {
        $target_tables = array_intersect($target_tables, $tables);
    }
	
	echo '<pre>';
	
    try
    {
        foreach ($target_tables as $table)
        {
            $result = $mysqli->query('SELECT * FROM ' . $table);
            $fields_amount = $result->field_count;
            $rows_num = $mysqli->affected_rows;
            $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
            $TableMLine = $res->fetch_row();
			
            $content = (!isset($content) ? '' : $content) . "\n\n" . $TableMLine[1] . ";\n\n";
            for ($i = 0, $st_counter = 0; $i < $fields_amount; $i ++, $st_counter = 0)
            {
				
				if(in_array($table,$rtables)){
				
					while ($row = $result->fetch_row())
					{ //when started (and every after 100 command cycle):
						print_r($row);
						if ($st_counter % 100 == 0 || $st_counter == 0)
						{
							$content .= "\nINSERT INTO " . $table . " VALUES";
						}
						$content .= "\n(";
						for ($j = 0; $j < $fields_amount; $j ++)
						{
							$row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
							if (isset($row[$j]))
							{
								$content .= '"' . $row[$j] . '"';
							} else
							{
								$content .= '""';
							}
							if ($j < ($fields_amount - 1))
							{
								$content .= ',';
							}
						}
						$content .= ")";
						//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
						if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num)
						{
							$content .= ";";
						} else
						{
							$content .= ",";
						}
						$st_counter = $st_counter + 1;
					}
				}
			}
			
			$content .= "\n\n\n";
        }
    } catch (Exception $e)
    {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    $backup_name = $backup_name ? $backup_name : $name . "___(" . date('H-i-s') . "_" . date('d-m-Y') . ")__rand" . rand(1, 11111111) . ".sql";
    /*header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
 	header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
    echo $content;*/
    exit;
}

?>


