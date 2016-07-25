<?php namespace App\Http\Controllers;

use Activity;
use App\Models\Closure;
use App\Models\Info;
use App\repo\API\QdnCountAndData;
use App\repo\HomeRepository;
use App\repo\Traits\DateTime;
use Auth;
use Illuminate\Http\Request;
use JavaScript;
use Str;

class HomeController extends Controller
{
    use DateTime;

    private $home;
    protected $user;

    public function __construct(HomeRepository $home)
    {
        $this->home = $home;
        $this->user = Auth::user();
    }

    public function index()
    {
//        return $this->user ? redirect('/home') : view('welcome');
        return $this->user ? redirect('/home') : view('index');
    }

    public function home(QdnCountAndData $qdn)
    {
        JavaScript::put([
            'yearNow' => $this->year(),
            'link' => [
                'status' => '/status',
                'ajax' => '/ajax',
                'qdn_data' => '/qdn_data'
            ],
            'qdn' => $qdn->getStatus()
        ]);
        return $this->user ? view('home') : redirect('/');
    }

    protected function arrayCollection($collection)
    {
        return $this->home->collection($collection);
    }

    public function ajax(Request $request)
    {
        return $this->home->highChartData($request);
    }

    public function qdnData(Request $request)
    {
        return view('home.qdnData')
            ->with('tbl', Info::issuedFrom($request->setDate));
    }

    public function getQdnLinkAndData(Request $request)
    {
        return Closure::status($request->status)
        ->map(function($item) {
            return array_add($item, 'url', static::link(Str::lower($item->status)));
        });
    }

    public static function link($status)
    {
        return collect([
            'p.e. verification' => 'link_for_pe_verification',
            'incomplete fill-up' => 'ForIncompleteFillUp',
            'incomplete approval' => 'approval',
            'q.a. verification' => 'qa_verification',
            'closed' => 'pdf'
        ])->get($status);
    }

    public function counter()
    {
        return $this->home->counter();
    }
}