<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title;?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

<?php if($keywords):?>
	<meta name="keywords" content="<?php echo $keywords;?>" />
<?php endif;?>
<?php if($description):?>
	<meta name="description" content="<?php echo $description; ?>" />
<?php endif;?>

<?php foreach($styles as $style):?>
	<link type="text/css" href="<?php echo $style['href']; ?>" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php endforeach;?>

<script src="/resources/public/resources/mobile/lib/jquery-2.1.4.js"></script> 
<script src="/resources/public/resources/default/js/jquery.validate/jquery.validate.js"></script>

<?php foreach($scripts as $script):?>
	<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php endforeach; ?>

<!--link rel="stylesheet" href="resources/public/resources/mobile/lib/weui.min.css">
<link rel="stylesheet" href="resources/public/resources/mobile/css/jquery-weui.css">
<link rel="stylesheet" href="resources/public/resources/mobile/css/style.css"-->
</head>

<body ontouchstart>
