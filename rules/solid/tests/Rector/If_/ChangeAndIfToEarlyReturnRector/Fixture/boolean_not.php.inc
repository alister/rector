<?php

namespace Rector\SOLID\Tests\Rector\If_\ChangeAndIfToEarlyReturnRector\Fixture;

class BooleanNotClass
{
    public function canDrive(Car $car)
    {
        if (!$car->hasWheels && !$car->hasFuel) {
            $this->canDrive = true;
        }

        return;
    }
}

?>
-----
<?php

namespace Rector\SOLID\Tests\Rector\If_\ChangeAndIfToEarlyReturnRector\Fixture;

class BooleanNotClass
{
    public function canDrive(Car $car)
    {
        if ($car->hasWheels) {
            return;
        }
        if ($car->hasFuel) {
            return;
        }
        $this->canDrive = true;
    }
}

?>
