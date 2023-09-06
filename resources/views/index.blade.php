<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Project Solutions ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div
                class=" dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg d-flex justify-between align-items-center">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <x-primary-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-project-modal')">{{ __('New project') }}</x-primary-button>
                </div>
                @if ($errors->any())
                    <div class="alert mb-0  alert-danger alert-seconds">
                    Fill in the required fields!
                    </div>
                @endif

            </div>
        </div>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">



                <div class="p-6 text-gray-900 dark:text-gray-100">



                    <div class="py-12 ">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div
                                    class="p-6 d-flex d-flex justify-center flex-column text-gray-900 dark:text-gray-100">



                                    <x-modal name="create-project-modal" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                        <form action="{{ route('project.store') }}" method="POST"
                                            enctype="multipart/form-data" class="p-6 gap-2 d-flex flex-column">
                                            @csrf

                                            <x-input-label for="client_name" :value="__('Client name')" />
                                            <x-text-input id="client_name" class="block mt-1 w-full" type="text"
                                                name="client_name" :value="old('client_name')" autofocus />
                                            <x-input-error :messages="$errors->get('client_name')" class="mt-2" />

                                            <x-input-label for="title" :value="__('Project Title')" />
                                            <x-text-input id="title" class="block mt-1 w-full" type="text"
                                                name="title" :value="old('title')" />
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />

                                            <x-input-label for="description" :value="__('Description')" />
                                            <x-text-input id="description" class="block mt-1 w-full" type="text"
                                                name="description" :value="old('description')" />
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />


                                            <x-input-label for="observation" :value="__('Observations')" />
                                            <x-text-input id="observation" class="block mt-1 w-full" type="text"
                                                name="observation" :value="old('observation')" />
                                            <x-input-error :messages="$errors->get('observation')" class="mt-2" />



                                            <x-input-label for="project_link" :value="__('Project link')" />
                                            <x-text-input id="project_link" class="block mt-1 w-full" type="text"
                                                name="project_link" :value="old('project_link')" />
                                            <x-input-error :messages="$errors->get('project_link')" class="mt-2" />



                                            <div class="mt-4">
                                                <x-input-label for="pdf_file" :value="__('PDF file')" />
                                                <x-text-input class="form-control" id="pdf_file" type="file"
                                                    name="pdf_file" accept=".pdf" />
                                                <x-input-error :messages="$errors->get('pdf_file')" class="mt-2" />
                                            </div>

                                            <!-- Galeria de fotos do projeto -->
                                            <div class="mt-4">
                                                <x-input-label for="photos" :value="__('Project photo gallery')" />
                                                <x-text-input class="form-control" id="photos" type="file"
                                                    name="photo_file[]" accept="image/*" multiple />
                                                <x-input-error :messages="$errors->get('photo_file')" class="mt-2" />
                                            </div>

                                            <div class="mt-6 flex justify-start">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Close') }}
                                                </x-secondary-button>

                                                <x-primary-button class="ml-3">
                                                    {{ __('Create') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>

                                    <x-success-status class="mb-4 alert alert-success" :status="session('success')" />
                                    <x-success-status class="mb-4 alert alert-warning" :status="session('delete_success')" />
                                    <x-error-status class="mb-4 alert alert-danger" :status="session('error')" />


                                    <div >
                                        @if ($projects->total() > 0)
                                            Show {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of
                                            {{ $projects->total() }} results.
                                        @else
                                            <span class="text-center w-100">none results found!</span>
                                        @endif
                                    </div>

                                    @if ($projects->total() > 0)

                                        <table class="min-w-full text-left text-sm font-light">
                                            <thead class="border-b font-medium dark:border-neutral-500">
                                                <tr>
                                                    <th scope="col" class="px-6 py-4">#</th>
                                                    <th scope="col" class="px-6 py-4">Client name</th>
                                                    <th scope="col" class="px-6 py-4">title</th>
                                                    <th scope="col" class="px-6 py-4">Description</th>
                                                    <th scope="col" class="px-6 py-4">Observations</th>
                                                    <th scope="col" class="px-6 py-4">Project link</th>
                                                    <th scope="col" class="px-6 py-4">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($projects as $index => $project)
                                                    <tr class="border-b dark:border-neutral-500">
                                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                            {{ $index + 1 }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                            {{ $project->client_name }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                            {{ $project->limited_title }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                            {{ $project->limited_description }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                            {{ $project->limited_observation }}</td>
                                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                            {{ $project->project_link }}</td>
                                                        <td class="whitespace-nowrap gap-2 d-flex px-6 py-4 font-medium">
                                                            <a href="{{ route('project.view', $project->id) }}"
                                                                class="btn btn-light">

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                  </svg>

                                                            </a>
                                                            <a href="{{ route('project.edit', $project->id) }}"
                                                                class="btn btn-primary">

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                                </svg>

                                                            </a>
                                                            <form action="{{ route('project.delete', $project->id) }}"
                                                                method="POST" style="display: inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                                      </svg>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                               
                                                @endforelse

                                            </tbody>
                                            <tfoot>
                                                {{ $projects->links() }}
                                            </tfoot>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
