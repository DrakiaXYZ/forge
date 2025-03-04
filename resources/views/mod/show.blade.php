<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mod Details') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 max-w-7xl mx-auto pb-6 px-4 gap-6 sm:px-6 lg:px-8">
        <div class="lg:col-span-2 flex flex-col gap-6">
            <div class="p-4 sm:p-6 text-center sm:text-left bg-white dark:bg-gray-950 rounded-xl shadow-md dark:shadow-gray-950 drop-shadow-2xl">
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                    <div class="grow-0 shrink-0 flex justify-center items-center">
                        @if(empty($mod->thumbnail))
                            <img src="https://placehold.co/144x144/EEE/31343C?font=source-sans-pro&text={{ $mod->name }}" alt="{{ $mod->name }}" class="block dark:hidden w-36 rounded-lg">
                            <img src="https://placehold.co/144x144/31343C/EEE?font=source-sans-pro&text={{ $mod->name }}" alt="{{ $mod->name }}" class="hidden dark:block w-36 rounded-lg">
                        @else
                            <img src="{{ Storage::url($mod->thumbnail) }}" alt="{{ $mod->name }}" class="w-36 rounded-lg">
                        @endif
                    </div>
                    <div class="grow flex flex-col justify-center items-center sm:items-start text-gray-800 dark:text-gray-200">
                        <h2 class="pb-1 sm:p-0 text-3xl font-bold text-gray-900 dark:text-white">
                            {{ $mod->name }}
                            <span class="font-light text-nowrap text-gray-700 dark:text-gray-400">
                                {{ $mod->latestSptVersion->version }}
                            </span>
                        </h2>
                        <p>{{ __('Created by') }} {{ $mod->user->name }}</p>
                        <p>{{ $mod->latestSptVersion->sptVersion->version }} {{ __('Compatible') }}</p>
                        <p>{{ $mod->total_downloads }} {{ __('Downloads') }}</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="sm:hidden">
                    <label for="tabs" class="sr-only">Select a tab</label>
                    {{-- Use an "onChange" listener to redirect the user to the selected tab URL. --}}
                    <select id="tabs" name="tabs" class="block w-full rounded-md dark:text-white bg-gray-100 dark:bg-gray-950 border-gray-300 dark:border-gray-700 focus:border-grey-500 dark:focus:border-grey-600 focus:ring-grey-500 dark:focus:ring-grey-600">
                        <option selected>Description</option>
                        <option>Versions</option>
                        <option>Comments</option>
                    </select>
                </div>
                <div class="hidden sm:block">
                    <nav class="isolate flex divide-x divide-gray-200 dark:divide-gray-800 rounded-xl shadow-md dark:shadow-gray-950 drop-shadow-2xl" aria-label="Tabs">
                        <a href="#description" class="tab rounded-l-xl group relative min-w-0 flex-1 overflow-hidden py-4 px-4 text-center text-sm font-medium text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-black dark:hover:text-white focus:z-10" aria-current="page">
                            <span>Description</span>
                            <span aria-hidden="true" class="bg-gray-500 absolute inset-x-0 bottom-0 h-0.5"></span> </a>
                        <a href="#versions" class="tab group relative min-w-0 flex-1 overflow-hidden py-4 px-4 text-center text-sm font-medium text-gray-900 dark:text-white bg-white dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-black dark:hover:text-white focus:z-10">
                            <span>Versions</span>
                            <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                        </a>
                        <a href="#comments" class="tab rounded-r-xl group relative min-w-0 flex-1 overflow-hidden py-4 px-4 text-center text-sm font-medium text-gray-900 dark:text-white bg-white dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-black dark:hover:text-white focus:z-10">
                            <span>Comments</span>
                            <span aria-hidden="true" class="bg-transparent absolute inset-x-0 bottom-0 h-0.5"></span>
                        </a>
                    </nav>
                </div>
            </div>

            <div id="description" class="user-markdown p-4 sm:p-6 bg-white dark:bg-gray-950 rounded-xl shadow-md dark:shadow-gray-950 drop-shadow-2xl">
                {{-- The description below is safe to write directly because it has been run though HTMLPurifier during the import process. --}}
                <p>{!! Str::markdown($mod->description) !!}</p>
            </div>
        </div>

        <div class="col-span-1 flex flex-col gap-6">
            <a href="{{ $mod->latestSptVersion->link }}" class="block">
                <button type="button" class="w-full">{{ __('Download Latest Version') }} ({{ $mod->latestSptVersion->version }})</button>
            </a>

            <div class="p-4 sm:p-6 bg-white dark:bg-gray-950 rounded-xl shadow-md dark:shadow-gray-950 drop-shadow-2xl">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ __('Details') }}</h2>
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-800 text-gray-900 dark:text-gray-100">
                    @if($mod->license)
                        <li class="px-4 py-4 sm:px-0">
                            <h3>{{ __('License') }}</h3>
                            <p class="truncate">
                                <a href="{{ $mod->license->link }}" title="{{ $mod->license->name }}" target="_blank">
                                    {{ $mod->license->name }}
                                </a>
                            </p>
                        </li>
                    @endif
                    @if($mod->source_code_link)
                        <li class="px-4 py-4 sm:px-0">
                            <h3>{{ __('Source Code') }}</h3>
                            <p class="truncate">
                                <a href="{{ $mod->source_code_link }}" title="{{ $mod->source_code_link }}" target="_blank">
                                    {{ $mod->source_code_link }}
                                </a>
                            </p>
                        </li>
                    @endif
                    @if($mod->latestSptVersion->virus_total_link)
                        <li class="px-4 py-4 sm:px-0">
                            <h3>{{ __('Latest VirusTotal Result') }}</h3>
                            <p class="truncate">
                                <a href="{{ $mod->latestSptVersion->virus_total_link }}" title="{{ $mod->latestSptVersion->virus_total_link }}" target="_blank">
                                    {{ $mod->latestSptVersion->virus_total_link }}
                                </a>
                            </p>
                        </li>
                    @endif
                    @if($mod->contains_ads)
                        <li class="px-4 py-4 sm:px-0 flex flex-row gap-2 items-center">
                            <svg class="grow-0 w-[16px] h-[16px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="grow">
                                {{ __('Includes Advertising') }}
                            </h3>
                        </li>
                    @endif
                    @if($mod->contains_ai_content)
                        <li class="px-4 py-4 sm:px-0 flex flex-row gap-2 items-center">
                            <svg class="grow-0 w-[16px] h-[16px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="grow">
                                {{ __('Includes AI Generated Content') }}
                            </h3>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

</x-app-layout>
