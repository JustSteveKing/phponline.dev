<?php

namespace App\Http\Livewire\Feeds;

use Throwable;
use App\Models\Feed;
use Livewire\Component;
use Illuminate\Bus\Batch;
use App\Jobs\Feeds\FetchMetaData;
use Illuminate\Support\Facades\Bus;
use App\Jobs\Feeds\CheckVerification;

class CheckMetaButton extends Component
{
    public Feed $feed;
    public bool $verified;

    public $batchId;
    public $batchProgress = 0;
    public $batchCanceled = false;
    public $batchFinished = false;

    public function verify()
    {
        $batch = Bus::batch([
            new FetchMetaData(
                feedId: $this->feed->id,
            ),
            new CheckVerification(
                feedId: $this->feed->id,
            )
        ])->catch(function (Batch $batch, Throwable $e) {
            $this->emit(
                'notify',
                $e->getMessage(),
                'warning',
            );
        })->finally(function (Batch $batch) {
            $this->batchId = null;
            $this->batchFinished = true;
            $this->emit(
                'notify',
                'Your Feed has been verified',
                'success'
            );
        })->allowFailures(
            allowFailures: false,
        )->dispatch();

        $this->batchId = $batch->id;
    }

    public function getImportBatchProperty()
    {
        if (! $this->batchId) {
            return null;
        }

        return Bus::findBatch(
            batchId: $this->batchId,
        );
    }

    public function updateBatchProgress()
    {
        $this->batchProgress = $this->importBatch->progress();
        $this->batchCanceled = $this->importBatch->canceled();
        $this->batchFinished = $this->importBatch->finished();
    }

    public function mount(Feed $feed)
    {
        $this->feed = $feed;
        $this->verified = $feed->verified;
    }

    public function render()
    {
        return view('livewire.feeds.check-meta-button');
    }
}
