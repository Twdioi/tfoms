<!DOCTYPE html>

<?php 
include("pages/header.php");
header('Content-Type:text/html; charset=utf-8');
 ?>

<head>
    <meta charset="UTF-8">
	<title>ТФОМС Забайкальского края</title>
</head>

<body>
<h1 class="headline1">ТФОМС Забайкальского края</h1>

<!--div class=ex5><h3>ТФОМС Забайкальского края</h3></div-->
    <div id="wrapper">
        <div id="box">
          
			<form action="#" method="POST">
			  <div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" type="text"  name="FIO" id="FIO" pattern="^[А-ЯЁа-яё]+(-[А-ЯЁа-яё]+)? [А-ЯЁа-яё]+( [А-ЯЁа-яё]+)?$">
				<label class="mdl-textfield__label" for="sample1">ФИО*</label>
				<span class="mdl-textfield__error">* - Формат неверный. Повторите попытку</span>
			  </div>
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" type="date" name="date" id="date">
			 </div>
			 <div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input" type="text" name="policy" id="policy" pattern="[0-9]*" maxlength="16" >
				<label class="mdl-textfield__label" for="policy">Либо номер полиса*</label>
				<span class="mdl-textfield__error">* - Формат неверный. Повторите попытку</span>
			 </div>
			 <label>
			  <input type="submit" class="superbutton" name="submit" value="Поиск">
		
          </form>
        </div>
        <?php
        include 'pages/search.php';
        ?>
    </div>
</body>

