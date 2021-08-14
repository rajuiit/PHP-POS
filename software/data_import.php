<?php
//define a maxim size for the uploaded images in Kb
define ("MAX_SIZE","30720");
//This function reads the extension of the file. It is used to determine if the file is an image by checking the extension.
function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}
//This variable is used as a flag. The value is initialized with 0 (meaning no error found) and it will be changed to 1 if an errro occures. If the error occures the file will not be uploaded.
$errors=0;
//checks if the form has been submitted
if(isset($_POST['Submit']))
{
//reads the name of the file the user submitted for uploading
$image=$_FILES['image']['name'];
//if it is not empty
if ($image)
{
//get the original name of the file from the clients machine
$filename = stripslashes($_FILES['image']['name']);
//get the extension of the file in a lower case format
$extension = getExtension($filename);
$extension = strtolower($extension);
//if it is not a known extension, we will suppose it is an error and will not upload the file, otherwize we will do more tests
if (($extension != "sql"))
{
//print error message
echo '<h1>Unknown extension!</h1>';
$errors=1;
}
else
{
//get the size of the image in bytes
//$_FILES['image']['tmp_name'] is the temporary filename of the file in which the uploaded file was stored on the server
$size=filesize($_FILES['image']['tmp_name']);
//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
{
echo '<h1>You have exceeded the size limit!</h1>';
$errors=1;
}
else{
	//$image_name=time().'.'.$extension;
	$image_name="computer_shop".'.'.$extension;

//the new name will be containing the full path where will be stored (images folder)
$newname=$image_name;
//we verify if the image has been uploaded, and print error instead

$copied = copy($_FILES['image']['tmp_name'], $newname);

if (!$copied)
{
echo '<h1>Failed to upload CV!</h1>';
$errors=1;
}
}
//we will give an unique name, for example the time in unix time format


}}}



//If no errors registred, print the success message
if(isset($_POST['Submit']) && !$errors)
{
echo "<h1>File Uploaded Successfully!</h1>";

mysql_connect('localhost', 'tcentric_onlinet','QJ+i=wkPQyaV');

mysql_select_db(tcentric_onlinetest);

$res = mysql_query("SHOW TABLES");

$tables = array();

while($row = mysql_fetch_array($res, MYSQL_NUM)) {
    $tables[] = "$row[0]";
}

$length = count($tables);

for ($i = 0; $i < $length; $i++) {
    $res = "DROP TABLE $tables[$i]";
    mysql_query($res);
    echo $res."<br>";
}// all table delete





// sql data import
//ENTER THE RELEVANT INFO BELOW
$mysqlDatabaseName ='tcentric_onlinetest';
$mysqlUserName ='tcentric_onlinet';
$mysqlPassword ='QJ+i=wkPQyaV';
$mysqlHostName ='localhost';
$mysqlImportFilename ='computer_shop.sql';
//DONT EDIT BELOW THIS LINE
//Export the database and output the status to the page
$command='mysql -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < ' .$mysqlImportFilename;
$output=array();
exec($command,$output,$worked);
switch($worked){
    case 0:
        echo 'Import file <b>' .$mysqlImportFilename .'</b> successfully imported to database <b>' .$mysqlDatabaseName .'</b>';
        break;
    case 1:
        echo 'There was an error during import.';
        break;
}






}










?>






<form name="newad" method="post" enctype="multipart/form-data" action="">
<table>
<tr><td><input type="file" name="image"></td></tr>
<tr><td><input name="Submit" type="submit" value="Upload image"></td></tr>
</table>
</form>


