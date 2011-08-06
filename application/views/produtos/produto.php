<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
    </head>
    <body>
        <h1><?php echo $produto['nome'];?></h1>
        <p><?php echo $produto['descricao'];?></p>
        <p><?php echo $categoria['categoria'];?></p>
        <p><?php echo anchor('produtos/edit/'.$produto['id'], 'Editar');?></p>
    </body>
</html>
