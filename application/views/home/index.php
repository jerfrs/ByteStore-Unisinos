<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $titulo;?></title>
    </head>
    <body>
        <h1><?php echo $titulo;?></h1>
        <?php echo $this->pagination->create_links();?>
        <?php echo "$table_produtos";?>
        <?php echo $this->pagination->create_links();?>
    </body>
</html>
