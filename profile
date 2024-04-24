kod???
</div>
        <div class="profile-info-img">
        <div class="profile-info">
        <span id="name">
            <?php echo $name." ".$surename; ?>
        </span>
        <img src="<?php echo $profilePhotoUrl; ?>" 
            alt="" id="profilePhoto">
        <p id="profileDescription">
            <?php echo $description; ?>
        </p>
        <?php
if(isset($_GET['profileID'])) {
    
    $id = $_GET['profileID'];
} else {
    
    $id = 1;
}


$sql = "SELECT * FROM profil 
        LEFT JOIN photo ON profil.profilePhotoID = photo.ID
        WHERE profil.ID=? 
        LIMIT 1";

$db = new mysqli('localhost', 'root', '', 'inst');

$query = $db->prepare($sql);


$query->bind_param('i', $id);

$query->execute();

$result = $query->get_result()->fetch_assoc();

print_r($result);

$name = $result['name'];
$surename = $result['surename'];
$description = $result['description'];
$profilePhotoUrl = $result['url'];
?>