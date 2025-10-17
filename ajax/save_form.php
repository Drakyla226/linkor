<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" || $_POST['WEB_FORM_ID'] > 0) {
    CModule::IncludeModule("form");

    $webFormID = $_POST['WEB_FORM_ID'];

    $formErrors = CForm::Check($webFormID, $_POST, false, "Y", "Y");

    if (count($formErrors)) {
        echo json_encode(['success' => false, 'errors' => $formErrors]);
    } elseif (CFormResult::Add($webFormID, $_POST)) {
        echo json_encode(['success' => true, 'errors' => []]);
    } else {
        echo json_encode(['success' => false, 'errors' => [$GLOBALS["strError"]]]);
    }
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
