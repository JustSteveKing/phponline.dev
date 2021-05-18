<?php

namespace App\Http\Livewire\Feeds;

use Throwable;
use App\Models\Feed;
use Livewire\Component;
use shweshi\OpenGraph\OpenGraph;
use App\Jobs\Feeds\FetchMetaData;
use Illuminate\Support\Facades\Bus;
use App\Jobs\Feeds\CheckVerification;
use Illuminate\Bus\Batch;

class CheckMetaButton extends Component
{
    public Feed $feed;
    public string $url;
    public string $key;
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

    public function checkVerification()
    {
        try {
            $data = (new OpenGraph())->fetch(
                url: $this->url,
                allMeta: true,
            );
        } catch (Throwable $e) {
            $this->emit(
                'notify',
                $e->getMessage(),
                'error'
            );
        }

        if (array_key_exists($this->key, $data)) {
            dump($data[$this->key]);
            dump($this->feed->verification_token);
            if ($data[$this->key] === $this->feed->verification_token) {
                $this->feed->update([
                    'verified' => true,
                ]);
                $this->verified = true;
                $this->emit(
                    'notify',
                    "Your feed for {$this->url} has been verified",
                    'success'
                );

                return;
            } else {
                dd('keys do not match');
            }
        } else {
            dd('key does not exist');
        }

        // if (array_key_exists($this->key, $data)) {
        //     if ($data[$this->key] === $this->feed->verification_token) {

        //         $this->feed->update([
        //             'verified' => true,
        //         ]);
    
        //         $this->verified = true;
    
        //         $this->emit(
        //             'notify',
        //             "Your feed for {$this->url} has been verified",
        //             'success'
        //         );
        //     } else {
        //         $this->emit(
        //             'notify',
        //             "The Verification meta key was incorrect, you used {$data[$this->key]} instead of {$this->feed->verification_token}",
        //             'warning'
        //         );
        //     }
        // } else {
        //     $this->emit(
        //         'notify',
        //         "We are currently unable to verify your feed. Please ensure the meta tag has been added",
        //         'warning'
        //     );
        // }
    }

    public function mount(Feed $feed)
    {
        $this->feed = $feed;
        $this->url = $feed->url;
        $this->verified = $feed->verified;
        $this->key = config('phponline.verification.feeds.key');
    }

    public function render()
    {
        return view('livewire.feeds.check-meta-button');
    }
}
