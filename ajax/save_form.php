<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" || $_POST['WEB_FORM_ID'] > 0) {
    CModule::IncludeModule("form");

    $webFormID = $_POST['WEB_FORM_ID'];
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/ajax/debug.txt', "Form Check Errors: ".print_r($_POST, true)."\n", FILE_APPEND);

    $formErrors = CForm::Check($webFormID, $_POST, false, "Y", "Y");

    if (count($formErrors)) {
        echo json_encode(['success' => false, 'errors' => $formErrors]);
    } elseif ($RESULT_ID = CFormResult::Add($webFormID, $_POST)) {
        CFormResult::Update($webFormID, $_POST);
        CFormCRM::onResultAdded($webFormID, $RESULT_ID);
        CFormResult::SetEvent($RESULT_ID);
        CFormResult::Mail($RESULT_ID);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/ajax/debug.txt', "Form Check Errors: ".print_r($formErrors, true)."\n", FILE_APPEND);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/ajax/debug.txt', "Form Check Errors: ".print_r($RESULT_ID, true)."\n", FILE_APPEND);
        echo json_encode(['success' => true, 'errors' => []]);
    } else {
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/ajax/debug.txt', "Form Check Errors: ".print_r($formErrors, true)."\n", FILE_APPEND);
        echo json_encode(['success' => false, 'errors' => [$GLOBALS["strError"]]]);
    }
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php';
