<p>Inscrivez-vous : </p>
<?php
    if (isset($vars))
    {
        foreach ($vars as $msg)
        {
            echo "<p style='color:red;'>".$msg."</p>";
        }
    }
?>
<form action="" method="POST">    
    <p>
        Email: <input type="text" name="email" value="" />
    </p>
    <p>
        Mot de passe: <input type="password" name="password" value="" />
    </p>
    <p>
        Confirmer le mot de passe: <input type="password2" name="password2" value="" /> 
    </p>
    <input class="inscription-action" type="submit" name="inscription" value="inscription" />
    <input type="hidden" name="token-inscription" value="token@inscription" />
</form>