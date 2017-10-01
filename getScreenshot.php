<html>
<head>

<style type="text/css">
body {background-color:azure;}
h1{color:orange;text-align:center;}
p {color:blue;}
</style>

<title> php_screenshot </title>
</head>
<body>

<?php
if(!empty($_POST['website'])){
    //website url
    $siteURL = $_POST['website'];

    if(filter_var($siteURL, FILTER_VALIDATE_URL)){
        //call Google PageSpeed Insights API
        $googlePagespeedData = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$siteURL&screenshot=true");

        //decode json data
        $googlePagespeedData = json_decode($googlePagespeedData, true);

        //screenshot data
        $screenshot = $googlePagespeedData['screenshot']['data'];
        $screenshot = str_replace(array('_','-'),array('/','+'),$screenshot);

        //display screenshot image
        echo "<h1><img src=\"data:image/jpeg;base64,".$screenshot."\" </h1>/>";
    }else{
        echo "Please enter a valid URL.";
    }
}
?>



</body>
</html>