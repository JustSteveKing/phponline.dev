<button
    type="button"
    @if($verified)
        disabled
    @else
        wire:click.prevent="checkVerification"
    @endif
    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500 {{ $verified ? 'cursor-not-allowed opacity-50' : '' }}"
>
    {{ $verified ? 'Already Verified' : 'Requires Verification' }}
</button>