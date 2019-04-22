<?php
  if (isset($_POST['createButton'])) {
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

  if (isset($_POST['openButton'])) {
    $vmId = $_POST['vmSelect'];

    writeToFile($vmSelect, "vmURL");
    //todo: add the tr -d line to this script when I get home later
    shell_exec('./getRemoteConsole.sh');

    $url = shell_exec('./parseVMurl.sh');
    header('Location: '
        . 'http://' . $_SERVER['HTTP_HOST'] . ':'.$url);
    exit;
  }

  //due to a lack of time to make a login page, these two lines get authentication tokens immediately upon page load.
  shell_exec('./getAuthToken.sh');
  shell_exec('./getProjectToken.sh');

  $vmList=json_decode(shell_exec('./getInstances.sh'), true);
  $imageList=json_decode(shell_exec('./getImages.sh'), true);
  $flavorList=json_decode(shell_exec('./getFlavors.sh'), true);

  function writeToFile($info, $fileName) {
    $file = '/var/www/html/tmp/'.$fileName;
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
                <h2>Create New Virtual Machine</h2>
                <label for="nameInput">VM Name: 
                <input type="text" name="nameInput" value=""></label>
                <div id="imageMenu">
                    <label for="imageSelect">Image: 
                    <select name="imageSelect">
		        	<?php foreach ($imageList["images"] as $image): ?>
                       <option value="<?=$image["id"]; ?>"><?=$image["name"]; ?></option>
                    <?php endforeach; ?>
                    </select></label>
	        	</div>
                <div id="flavorMenu">
                    <label for="flavorSelect">Flavor: 
                    <select name="flavorSelect">
                    <?php foreach ($flavorList["flavors"] as $flavor): ?>
                       <option value="<?=$flavor["id"]; ?>"><?=$flavor["name"]; ?></option> 
                    <?php endforeach; ?>
                    </select></label>
                    <br><input type="submit" name="createButton" value="Create Virtual Machine">
                </div>

                <div id="createVMDiv">
                    <h2>Open Existing Virtual Machine</h2>
                    <label for="vmSelect">Name: 
                    <select name="vmSelect">
                    <?php foreach ($vmList["servers"] as $vm): ?>
                       <option value="<?=$vm["id"]; ?>"><?=$vm["name"]; ?></option> 
                    <?php endforeach; ?>
                    </select></label>
                    <br><input type="submit" name="openButton" value="Open Virtual Machine">
                </div>
            </form>
        </div>
    </body>
</html>
