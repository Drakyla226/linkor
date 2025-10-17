<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$iBlockSection = CIBlockSection::GetList(
    [],
    [
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'ID' => $arResult['ID'],
    ],
    false,
    ['UF_*']
);

if ($arSection = $iBlockSection->GetNext()) {
    $arResult['UF_FIELDS']['UF_CUSTOM_TEXT'] = $arSection['UF_CUSTOM_TEXT'];
    $arResult['UF_FIELDS']['UF_CUSTOM_MORE_TEXT'] = $arSection['UF_CUSTOM_MORE_TEXT'];
    $arResult['UF_FIELDS']['UF_PHOTO'] = CFile::GetPath($arSection['UF_PHOTO']);
    if (!empty($arSection['UF_MORE_PHOTO'])) {
        foreach ($arSection['UF_MORE_PHOTO'] as $photoId) {
            $arResult['UF_FIELDS']['UF_MORE_PHOTO'][] = CFile::GetPath($photoId);
        }
    }
}