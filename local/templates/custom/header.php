<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$isIndex = $APPLICATION->GetCurPage();
?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title><?php $APPLICATION->ShowTitle(); ?></title>
        <?php $APPLICATION->ShowHead(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/include/css/styles.css", true);
        ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <?php
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/include/js/script.js"); ?>

    </head>
<body>
    <div class="overlap"></div>
<?php
$APPLICATION->ShowPanel(); ?>
    <header class="header">
        <?php
        include_once($_SERVER["DOCUMENT_ROOT"] . '/local/templates/custom/include/_header.php'); ?>
    </header>

<div class="main">
<?php
if ($isIndex == '/'): ?>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . '/local/templates/custom/include/_index.php');
    ?>
<?php
endif; ?>