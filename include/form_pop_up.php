<?php

include $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';
?>

<div class="pop_container">
    <div class="pop-up__form">
        <div class="btn_close">✖</div>
        <form class="content__form">
            <p>Заказать звонок</p>
            <div class="form_inputs">
                <input type="hidden" name="WEB_FORM_ID" value="1">
                <input type="text" class="form_input" name="form_text_1" placeholder="Фамилия*">
                <input type="text" class="form_input" name="form_text_2" placeholder="Имя*">
                <input type="text" class="form_input" name="form_text_3" placeholder="Отчество*">
                <input type="tel" class="form_input phone" name="form_text_4" placeholder="Телефон*">
                <input type="email" class="form_input" name="form_email_5" placeholder="E-mail*">
            </div>
            <button type="submit" class="pop-up__submit_btn">Сохранить</button>
        </form>
        <div class="result"></div>
    </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
?>
