<?php
namespace App\Http\ViewComposers;

use App\Employee;
use App\OptionModels\Machine;
use App\OptionModels\Option;
use App\OptionModels\Station;
use Illuminate\Contracts\View\View;

class FormOptionComposer {

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view) {

		$view->with('select_failure_mode', [
			'assembly',
			'environment',
			'machine',
			'man',
			'material',
			'method / process',
		]);

		$view->with('customers', Option::orderBy('customer')->select('customer')->get());
		$view->with('machines', Machine::orderBy('name')->select('name')->get());
		$view->with('stations', Station::orderBy('station')->select('station')->get());
		$view->with('employees', Employee::orderBy('name')->select('name')->get());

	}

}