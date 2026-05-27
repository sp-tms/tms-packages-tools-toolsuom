<?php

namespace Apps\Tms\Packages\Tools\Uom;

use Apps\Tms\Packages\Tools\Uom\Model\AppsTmsToolsUom;
use System\Base\BasePackage;

class ToolsUom extends BasePackage
{
    protected $modelToUse = AppsTmsToolsUom::class;

    protected $packageName = 'toolsuom';

    public $toolsuom;

    public function init()
    {
        parent::init();

        return $this;
    }

    public function getUomByName($uomName)
    {
        if ($this->config->databasetype === 'db') {
            $params =
                [
                    'conditions'    => 'name = :name:',
                    'bind'          =>
                        [
                            'name'          => $uomName,
                        ]
                ];
        } else {
            $params = ['conditions' => ['name', '=', $uomName]];
        }

        $uomArr = $this->getByParams($params);

        if ($uomArr && count($uomArr) > 0) {
            return $uomArr[0];
        }

        return false;
    }

    public function addUom($data)
    {
        if ($this->add($data)) {
            $this->addResponse('Unit of measurement added');

            return true;
        }

        $this->addResponse('Error Adding unit of measurement', 1);
    }

    public function updateUom($data)
    {
        if ($this->update($data)) {
            $this->addResponse('Unit of measurement updated');

            return true;
        }

        $this->addResponse('Error Updating unit of measurement', 1);
    }

    public function removeUom($data)
    {
        if ($this->remove($data['id'])) {
            $this->addResponse('Unit of measurement removed');

            return true;
        }

        $this->addResponse('Error removing unit of measurement', 1);

        return false;
    }
}