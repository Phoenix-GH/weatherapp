<?php

namespace App\Widgets;

use App\AccountType;
use Arrilot\Widgets\AbstractWidget;

class AccountTypeDropdown extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $types = AccountType::all();

        return view('widgets.account_type_dropdown', [
            'config' => $this->config,
            'types' => $types,
        ]);
    }
}
