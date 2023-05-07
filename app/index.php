<html>
<body>
		<h3>Available Images</h3>
		<div>
        <?php
        $iterator = new FilesystemIterator(STORAGE_IMAGES);
        foreach ($iterator as $file) {
            $fileName = $file->getFilename();
            $currentUrl = (empty($_SERVER['HTTPS']) ? 'http' : 'https')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            echo '
                <img src="'.$file->getPath().'/'.$fileName.'" style="max-width:200px">
								<br/>
								<p>Image Name : '.$fileName.'</p>
								<p>Demo Resize Request : '.$currentUrl.'resize?fileName='.$fileName.'&width=100&height=100</p>
								<p>Demo Crop Request : '.$currentUrl.'crop?fileName='.$fileName.'&width=100&height=100</p>
						';
        }
        ?>

		</div>

</body>
</html>
