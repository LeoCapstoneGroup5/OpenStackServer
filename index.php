<?php
  if (isset($_POST['createButton'])) {
    //shell_exec('./getAuthToken.sh');
    $name = $_POST['nameInput'];
    $imageSelect = $_POST['imageSelect'];
    $flavorSelect = $_POST['flavorSelect'];

    writeToFile($name, "vmName");
    writeToFile($imageSelect, "vmImage");
    writeToFile($flavorSelect, "vmFlavor");

    shell_exec('./createVM.sh'); 
    shell_exec('./getRemoteConsole.sh');
    
    $url = shell_exec('./parseVMurl.sh');
    header('Location: '
        . 'http://' . $_SERVER['HTTP_HOST'] . ':'.$url);
    exit;
  }

  //due to a lack of time to make a login page, these two lines get authentication tokens immediately upon page load.
  shell_exec('./getAuthToken.sh');
  shell_exec('./getProjectToken.sh');

  $imageList=json_decode(shell_exec('./getImages.sh'), true);
  $flavorList=json_decode(shell_exec('./getFlavors.sh'), true);

  function writeToFile($info, $fileName) {
    $file = '/tmp/'.$fileName;
    $content = json_encode($info);
    file_put_contents($file, $content);
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>OpenStack</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <div id="createVMDiv">
            <h1>OpenStack</h1>
             <form  method="POST">
                <label for="nameInput">Virtual Machine Name:<br>
                <input type="text" name="nameInput" value=""></label>
                <div id="imageMenu">
                    <select name="imageSelect">
		        	<?php foreach ($imageList["images"] as $image): ?>
                       <option value="<?=$image["id"]; ?>"><?=$image["name"]; ?></option>
                    <?php endforeach; ?>
                    </select>
	        	</div>
                <div id="flavorMenu">
                    <select name="flavorSelect">
                    <?php foreach ($flavorList["flavors"] as $flavor): ?>
                       <option value="<?=$flavor["id"]; ?>"><?=$flavor["name"]; ?></option> 
                    <?php endforeach; ?>
                    </select>
                </div>
	         	<div id="submitDiv">
                    <input type="submit" name="createButton" value="Create Virtual Machine">
                </div>
            </form>
        </div>
    </body>
</html>
