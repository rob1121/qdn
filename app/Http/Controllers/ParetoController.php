<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Auth;
use Carbon;
use DB;
use Illuminate\Http\Request;
use JavaScript;

class ParetoController extends Controller {
	public $dateTime;

	public function __construct() {
		$this->middleware('auth');
		$this->dateTime = Carbon::now('Asia/Manila');
	}

	public function pareto(Request $request) {
		if (Auth::user()) {
			$month                 = Carbon::parse($request->input('month'))->format('m');
			$year                  = $request->input('year');
			$SelectedYear          = $request->input('year') ? $request->input('year') : $this->dateTime->format('Y');
			$FailureModes          = Info::select('failure_mode')->groupBy('failure_mode')->get();
			$DiscrepancyCategories = Info::select('discrepancy_category')->groupBy('discrepancy_category')->get();
			$discrepancy           = $request->input('discrepancy');
			$category              = $request->input('category');

			if ('total' == $category) {

				$table = Info::with(['involvePerson'])->where(DB::raw('YEAR(created_at)'), $year)
					->where(DB::raw('MONTH(created_at)'), $month)
					->show(0, 10)
					->get();

			} elseif ('failureMode' == $category || 'fmTotal' == $category) {

				$table = Info::with(['involvePerson'])->where(DB::raw('YEAR(created_at)'), $year)
					->where(DB::raw('MONTH(created_at)'), $month)
					->where('failure_mode', $discrepancy)
					->show(0, 10)
					->get();

			} elseif (('pod' == $category)) {

				$table = Info::with(['involvePerson'])->where(DB::raw('YEAR(created_at)'), $year)
					->where('discrepancy_category', $discrepancy)
					->show(0, 10)
					->get();

			} elseif ('today' == $category) {

				$table = Info::with(['involvePerson'])->where(
					DB::raw('DATE_FORMAT(created_at, "%m-%d-%Y")'),
					"=",
					$this->dateTime->format('m-d-Y')
				)
					->show(0, 10)
					->get();

			} elseif ('week' == $category) {

				$table = Info::with(['involvePerson'])->where(
					DB::raw('WEEK(created_at)'),
					"=",
					$this->dateTime->weekOfYear
				)
					->show(0, 10)
					->get();

			} elseif ('month' == $category) {

				$table = Info::with(['involvePerson'])->where(
					DB::raw('MONTH(created_at)'),
					"=",
					$this->dateTime->month
				)
					->where(
						DB::raw('YEAR(created_at)'),
						"=",
						$this->dateTime->year
					)
					->show(0, 10)
					->get();

			} elseif ('year' == $category) {
				$table = Info::with(['involvePerson'])->where(
					DB::raw('YEAR(created_at)'),
					"=",
					$this->dateTime->year
				)
					->show(0, 10)
					->get();

			} else {

				$table = Info::with(['involvePerson'])->where(DB::raw('YEAR(created_at)'), $year)
					->where(DB::raw('MONTH(created_at)'), $month)
					->where('discrepancy_category', $discrepancy)
					->show(0, 10)
					->get();

			}
			JavaScript::put('discrepancy', $discrepancy);
			JavaScript::put('category', $category);
			return view('home.pareto', compact('table', 'SelectedYear', 'FailureModes', 'DiscrepancyCategories', 'receiver_name'));
		}
	}

	public function paretoAjax(Request $request) {
		$start       = $request->input('start');
		$end         = $request->input('end');
		$year        = $request->input('year');
		$month       = $request->input('month');
		$column      = $request->input('column');
		$sort        = $request->input('sort');
		$discrepancy = $request->input('discrepancy');
		$FailureMode = $request->input('FailureMode');
		$text        = $request->input('text');

		if ('' != $text) {

			$tbl = info::orderBy($column, $sort)
				->where(DB::raw('YEAR(created_at)'), 'LIKE', "%" . $year . "%")
				->search($text)
				->show($request->input('start'), $request->input('end'))
				->get();

		} else {

			$condition = '' == $month ? 'LIKE' : '=';
			$month     = '' == $month ? '%' . $month . '%' : $month;

			$tbl = info::orderBy($column, $sort)
				->where(DB::raw('YEAR(created_at)'), 'LIKE', '%' . $year . '%')
				->where(DB::raw('MONTH(created_at)'), $condition, $month)
				->where('discrepancy_category', 'LIKE', '%' . $discrepancy . '%')
				->where('failure_mode', 'LIKE', '%' . $FailureMode)
				->show($request->input('start'), $request->input('end'))
				->get();

		}

		return view('home.pareto-ajax', compact('tbl', 'option', 'sort', 'column'));

	}
}