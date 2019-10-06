<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require 'header.php';
        ?>
        <?php
        if(isset($_GET['login'])){
            echo '<p class="text-success">Log in Successful!</p>';
        }
        ?>
    </body>
</html>
