<div class="space-y-3">
    @if (! $batchId)
        <button
            type="button"
            wire:click.prevent="verify"
            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500 {{ $verified ? 'cursor-not-allowed opacity-50' : '' }}"
        >
            {{ $verified ? 'Already Verified' : 'Requires Verification' }}
        </button>
    @endif
    @if (isset($batchId) && ! $batchFinished)
        <div wire:poll="updateBatchProgress" class="relative pt-1">
            <div class="overflow-hidden w-96 h-4 flex rounded bg-green-100">
                <div style="width: {{ $batchProgress }}%;" class="bg-green-500 transition-all"></div>
            </div>
            {{ $batchProgress }}
        </div>
    @endif
    @if ($batchCanceled)
        <p class="mt-4 text-white">
            Something went wrong, please try again
        </p>
    @elseif ($batchFinished)
        <p class="mt-4 text-white">
            Verified
        </p>
    @endif
</div>
