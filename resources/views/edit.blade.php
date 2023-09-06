<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mt-3">
                            <x-input-label for="client_name" :value="__('Client name')" />
                            <x-text-input id="client_name" class="block mt-1 w-full" type="text" name="client_name" :value="$project->client_name" autofocus/>
                            <x-input-error :messages="$errors->get('client_name')" class="mt-2" />
                        </div>

                        <div class="mt-3">
                            <x-input-label for="title" :value="__('Project title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$project->title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mt-3">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$project->description" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mt-3">
                            <x-input-label for="observation" :value="__('Observations')" />
                            <x-text-input id="observation" class="block mt-1 w-full" type="text" name="observation" :value="$project->observation"/>
                            <x-input-error :messages="$errors->get('observation')" class="mt-2" />
                        </div>

                        <div class="mt-3">
                            <x-input-label for="project_link" :value="__('Project link')" />
                            <x-text-input id="project_link" class="block mt-1 w-full" type="text" name="project_link" :value="$project->project_link"/>
                            <x-input-error :messages="$errors->get('project_link')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="pdf_file" :value="__('PDF file')" />
                            <x-text-input class="form-control" id="pdf_file" type="file" name="pdf_file" accept=".pdf"/>
                            <x-input-error :messages="$errors->get('pdf_file')" class="mt-2" />
                            <div class="d-flex gap-4 mt-2">
                                <p>Current file: {{ $project->pdf_file }}</p>
                                <div>
                                    <a href="{{ route('download.pdf', ['filename' => $project->pdf_file]) }}" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
                                            <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="photos" :value="__('Project photo gallery')" />
                            <x-text-input class="form-control" id="photos" type="file" name="photo_file[]" accept="image/*" multiple />
                            <x-input-error :messages="$errors->get('photo_file')" class="mt-2" />
                        </div>
                        <p class="mt-3">Current photos:</p>
                        @if (!empty($project->photo_file))
                            @foreach (json_decode($project->photo_file) as $photoName)
                            <span class="photo_project_item_edit">
                                <img src="{{ asset('images/' . $photoName) }}" alt="Foto do Projeto">
                            </span>
                            @endforeach
                        @else
                            <span class="photo_project_item">No photo available for this project.</span>
                        @endif

                        <div class="mt-3">
                            <x-primary-button class="mt-3">{{ __('To update') }}</x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
