@inject('userOptionService', 'App\Services\UserOptionService')

<x-app-layout>
    <div class="py-6 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:absolute flex lg:flex-col justify-between items-start">
            <h2 class="inline-block px-4 py-1 font-bold text-2xl sm:text-3xl bg-gray-200 text-gray-600 text-center">{{ $questions->currentPage() }}</h2>
            <p class="lg:mt-8 font-bold"><x-icon.clock class="inline-block lg:block md:w-6 lg:w-10 md:h-6 lg:h-10 text-gray-300"/><span class="text-gray-600">22:00<span></p>
        </div>
        <div class="sm:max-w-xl lg:max-w-3xl mx-auto lg:px-8">
            <section class="my-4 lg:mt-0 leading-snug sm:leading-tight sm:text-lg">
                @isset($questions[0]->context)
                <p class="mb-4">{{ $questions[0]->context }}</p>
                @endisset
                <p>{{ $questions[0]->body }}</p>
            </section>
            <section class="my-4 leading-snug sm:leading-tight sm:text-lg">
                <form action="{{ route('quiz_sessions.answer', $quizSession->id) }}" method="post">
                    @csrf
                    @method('patch')

                    @php
                    $userOption = $userOptionService->getByForeigns($quizSession->result->id, $questions[0]->id);
                    @endphp

                    <input type="hidden" name="userOptionId" value="{{ $userOption->id }}">

                    @foreach($questions[0]->options as $option)
                    <div class="flex my-2 gap-2">
                        <input type="radio" name="optionId" id="{{ 'option-' . $option->id }}" value="{{ $option->id }}" class="mt-1"
                            @if($userOption->option_id === $option->id)
                            checked
                            @endif
                        >
                        <label for="{{ 'option-' . $option->id }}">{{ $option->body }}</label>  
                    </div>
                    @endforeach

                    <button type="submit" class="hidden" id="submitBtn"></button>
                </form>
            </section>
            <div class="mt-12 flex flex-col sm:flex-row-reverse sm:justify-between gap-4">
                @if($questions->onLastPage())
                <form action="{{ route('quiz_sessions.complete', $quizSession->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <x-button.primary class="w-full">{{ __('Complete') }}</x-button.primary>
                </form>
                @else
                <a href="{{ $questions->nextPageUrl() }}">
                    <x-button.primary type="button" class="w-full">{{ __('Next') }}</x-button.primary>
                </a>
                @endif
                
                @if(!$questions->onFirstPage())
                <a href="{{ $questions->previousPageUrl() }}">
                    <x-button.secondary type="button" class="w-full">{{ __('Previous') }}</x-button.secondary>
                </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const answerRadios = document.querySelectorAll('input[type="radio"][name="optionId"]');
    const submitBtn = document.querySelector('#submitBtn');

    answerRadios.forEach(function(radio) {
        radio.addEventListener('click', function() {
            submitBtn.click();
        });
    });
</script>