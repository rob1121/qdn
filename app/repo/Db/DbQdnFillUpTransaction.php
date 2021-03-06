<?php namespace App\repo\Db;

use App\Models\Info;
use App\repo\Event\ApprovalEvent;
use App\repo\Event\DraftEvent;
use App\repo\Event\EventInterface;
use App\repo\File\ca;
use App\repo\File\cna;
use App\repo\File\cod;
use App\repo\File\ObjectiveEvidenceInterface;
use App\repo\File\pa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DbQdnFillUpTransaction {

    protected $qdn;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function saveAsDraft(Info $qdn)
    {
        $this->qdn = $qdn;
        
        $this->save()
            ->deleteCache()
            ->event(new DraftEvent);
    }
    
    public function saveAndProceed(Info $qdn)
    {
        $this->qdn = $qdn;

        $this->save()
            ->updateStatus()
            ->deleteCache()
            ->event(new ApprovalEvent);
        
    }
    
    public function save()
    {
        
        collect([new ca, new cod, new cna, new pa])->map(function($class){
            $this->update($class);
        });
        
        return $this;
    }

    public function updateStatus()
    {
        $this->qdn->closure()->update(['status' => 'incomplete approval']);
        
        return $this;
    }

    public function deleteCache()
    {
        Cache::forget($this->qdn->slug);

        return $this;
    }
    
    public function event(EventInterface $event)
    {
        $event->fire($this->qdn);
    }

    private function update(ObjectiveEvidenceInterface $class)
    {
        $class->set($this->qdn, $this->request)
            ->upload()
            ->save();
    }
}