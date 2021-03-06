<?php
// Copyright 1999-2018. Plesk International GmbH.

class Modules_DomainConnect_EventListener implements EventListener
{
    public function filterActions()
    {
        return [
            'domain_create',
            'site_create',
        ];
    }

    public function handleEvent($objectType, $objectId, $action, $oldValues, $newValues)
    {
        switch ($action) {
            case 'domain_create':
            case 'site_create':
                $domainConnect = new \PleskExt\DomainConnect\DomainConnect(\pm_Domain::getByDomainId($objectId));
                $domainConnect->enable();
        }
    }
}

// Workaround for bug PPP-33009
pm_Context::init('domain-connect');

return new Modules_DomainConnect_EventListener();
