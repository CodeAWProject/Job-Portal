<x-layout>
    @foreach ($jobs as $job)
    {{-- Custom class only for this component --}}
        <x-card class="mb-4">
            {{ $job->title }}
        </x-card>
        <div>Test</div>
    @endforeach
</x-layout>