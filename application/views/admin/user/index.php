<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $titulo;?></title>
    </head>
    <body>
        <h1><?php echo $titulo;?></h1>
        <?php echo $this->pagination->create_links();?>
        <table border="1" cellpadding="3" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Login</th>
                <th>Senha</th>
                <th>Email</th>
                <th>Nivel</th>
                <th>&nbsp;</th>
            </tr>
        <?php 
        foreach ($users as $users) {
            echo "<tr>";
            echo "<td>".anchor('user/view/'.$user->id,$user->group_id)."</td>";
            echo "<td>$user->ip_address</td>";
            echo "<td>$user->username</td>";
            echo "<td>$user->password</td>";
            echo "<td>$user->salt</td>";
            echo "<td>$user->email</td>";
            echo "<td>$user->activation_code</td>";
            echo "<td>$user->forgotten_password_code</td>";
            echo "<td>$user->remember_code</td>";
            echo "<td>$user->created_on</td>";
            echo "<td>$user->last_login</td>";
            echo "<td>$user->active</td>";
            echo "<td>Excluir</td>";
            echo "</tr>";
        }
        ?>
        </table>
        <?php echo $this->pagination->create_links();?>
                
    </body>
</html>
