<?php


$pkgName = 'modSociety';

$pkgLowerName = strtolower($pkgName);

if ($object->xpdo) {
    $modx =& $object->xpdo;
    $modelPath = $modx->getOption($pkgLowerName.'.core_path',null,$modx->getOption('core_path').'components/'.$pkgLowerName.'/').'model/';

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            if ($modx instanceof modX) {
                
                $modx->addExtensionPackage($pkgName, '[[++core_path]]components/'.$pkgLowerName.'/model/');
                $modx->log(xPDO::LOG_LEVEL_INFO, 'Adding ext package');
                
            } 
            break; 
    }
}
return true;