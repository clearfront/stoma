<?php

// Setup page
require_once 'inc/medoo.min.php';
$database = new medoo();
$id = $_GET['id'];

session_start();
 
// If the test isn't being updated display next test
$xy = $database->get("stoma", ["x", "y"], [
	"AND" => [
		"user_id" => $id,
		"taken" => "no"
	]
]);


$thistest = $database->get("test", ["test_id", "stoma_id"], [
		"AND" => [
			"user_id" => $id,
			"taken" => "no"
		]
	]);
 
// Number of active stoma questions 
$stomacount = $database->count("stoma", [
		"active" => "true"
]);
 
 
// Check to see if the test is being updated 
if ($_GET['test']) { 

	$test = $_GET['test'];
	
	$database->update("test", [
	 "taken"=>"yes",
	 "position"=>""
	  ],
	  [
	"test_id"=>$test
	]);
	
	$_SESSION['count'] ++;
	
	header( 'Location: questions.php?id='.$id.'' );

} else {

	// If the test isn't being updated display next test
	$nexttest = $database->get("test", ["test_id", "stoma_id"], [
		"AND" => [
			"user_id" => $id,
			"taken" => "no"
		]
	]);

	// If the tests have finished 
	if (!isset($nexttest["test_id"]) || empty($nexttest["test_id"])) {
	header( 'Location: results.php?id='.$id.'' );
	}
	
	$testdetails = $database->select("stoma", "*", [
		"AND" => [
			"stoma_id" => $nexttest["stoma_id"]
		]
	]);
	
	foreach($testdetails as $data)
	{
		$type = $data["type"];
		$position = $data["position"];
		$info = $data["info"];
		$image = $data["image"];
		$x = $data["x"];
		$y = $data["y"];
	}

} 

?>
<?php include ("inc/header.php");?>
<?php include ("inc/details-page-image.php");?>
<div class="target"><img src="images/svg/target.svg" height="100px"/></div>
<?php include ("inc/admin-details-page-info.php");?>
<?php include ("inc/footer.php");?>
<script>
$( document ).ready(function() {
	// Pass values to Jquery
	window.xposition = "<?php echo $x; ?>";
	window.yposition = "<?php echo $y; ?>";
	window.globalTestData = <?php echo $thistest['test_id']; ?>;
});
</script>
<script src="js/min/xandy-min.js"></script>