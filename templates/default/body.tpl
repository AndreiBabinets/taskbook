<body>

 <?php loadTemplate('default','body_header'); ?>
 <?php loadTemplate('default','body_content', $arg); ?>
 <?php loadTemplate('default','body_page_nav', $arg); ?>
 
 <?php loadTemplate('dialogis','dialog_login'); ?>
 <?php loadTemplate('dialogis','dialog_add_task'); ?>
 <?php loadTemplate('dialogis','dialog_edit_task'); ?>
 
</body>
</html>