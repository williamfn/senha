<?php
if (isset($_POST) && !empty($_POST)){
    $senhaGerada = substr(base64_encode($_POST['service'].$_POST['passphrase']), 0, $_POST['size']);
}
?>

<html>
<title>Gerador de senhas seguras</title>
<head>
</head>
<body>
<form method="post">
    <table>
        <tr>
            <td colspan="2"><h1>Gerador de senha</h1></td>
        </tr>
        <tr>
            <td>Nome do serviço (minúsculo)</td>
            <td><input type="text" id="service" name="service" value="<?=$_POST['service']?>" /></td>
        </tr>
        <tr>
            <td>Contra-senha</td>
            <td><input type="password" id="passphrase" name="passphrase" /></td>
        </tr>

        <tr>
            <td>Número de caracteres</td>
            <td>
                <select name="size" id="size">
                    <?php
                    for ($i=12; $i<=20; $i++) { ?>
                        <option value="<?=$i?>"
                            <?php
                            if (isset($_POST['size']) && $_POST['size'] == $i)
                                echo 'selected';
                            else if (!isset($_POST['size']) && $i == 10)
                                echo 'selected';
                            ?>>
                            <?=$i?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <button>Gerar senha</button>
            </td>
        </tr>
    </table>
</form>

<label for="senha">Senha gerada</label>
<input type="text" id="senha" value="<?=$senhaGerada?>" readonly />
<button id="copy" data-clipboard-target="#senha">
    Copiar senha
</button>
<span id="copy_box" style="display: none">Senha copiada!</span>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.8/clipboard.min.js"></script>
<script language="JavaScript">
    var clipboard = new Clipboard('#copy');
    clipboard.on('success', function(e) {
        $('#copy_box').fadeIn();
        setTimeout(function() {
            $('#copy_box').fadeOut();
        }, 2000);
        e.clearSelection();
    });
</script>
</html>