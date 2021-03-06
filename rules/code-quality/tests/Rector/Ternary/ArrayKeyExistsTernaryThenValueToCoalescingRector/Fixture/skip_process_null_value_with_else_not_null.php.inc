<?php

namespace Rector\CodeQuality\Tests\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector\Fixture;

class SkipProcessNullValue
{
    public function run()
    {
        $v = ['value' => 'whatever'];
        return array_key_exists('value', $v) ? $v['value'] : 'whatever';
    }
}
