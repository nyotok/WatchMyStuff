<!DOCTYPE html>
<html lang="ro-RO">
    <head>
        <title>WMS</title>
    </head>
    <body>

    <center>
        <form action="" method="post">
            <input type="hidden" name="url" value="<?php echo $_POST['url']?>" />
            <input type="hidden" name="tag" value="<?php echo $_POST['tag']?>" />
            <input type="hidden" name="title" value="<?php echo $_POST['title']?>" />
            <input type="hidden" name="text" value="<?php echo $_POST['text']?>" />
            
            <input type="hidden" name="action" value="authentification" />
            
            <table cellpadding="5">
                <tr>
                    <td align="left" colspan="2">
                        <h3>Te rugam sa te autentifici: </h3>
                        <p>Daca nu ai cont, te rugam sa-ti creezi unul <a href="#">aici</a></p>
                </tr>
                <tr>
                    <td align="left">Email</td>
                    <td align="left">
                        <input type="text" name="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : '')?>" />
                    </td>
                </tr>
                <tr>
                    <td align="left">Descriere (optional)</td>
                    <td align="left">
                        <input type="password" name="password" value="<?php echo (isset($_POST['password']) ? $_POST['password'] : '')?>" />
                    </td>
                </tr>
                <tr>
                    <td align="left"></td>
                    <td align="left">
                        <input type="submit" name="submit" value="Salveaza" />
                    </td>
                </tr>
            </table>
            
            
        </form>
    </center>
</html>