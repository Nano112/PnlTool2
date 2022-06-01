<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Isin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-3 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @if (\App\Models\Isin::count() > 0)
                    <livewire:repos-table />
                @else
                    <h3 class="text-lg font-semibold leading-6 text-gray-900">
                        {{ __('No repos found') }}
                    </h3>
                @endif
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-3 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <h3 class="text-lg font-semibold leading-6 text-gray-900">
                    {{ __('Import new repos') }}
                </h3>
                {{-- form to upload new isins --}}
                <form action="{{ route('repos-import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="sm:col-span-4 ">
                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col w-full h-32 border-4 border-dashed cursor-pointer hover:bg-gray-100 hover:border-gray-300">
                                <div class="flex flex-col items-center justify-center pt-7">
                                    <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                        Select a spreadsheet</p>
                                </div>
                                <input name="file" type="file" class="cursor-pointer hidden-file-button focus:outline-none" />
                            </label>
                        </div>
                    </div>
                    <div class="m-2 text-center">
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700">
                            {{ __('Import') }}
                        </button>
                        {{-- errors --}}
                        @if ($errors->any())
                            <div class="mt-2 text-sm text-red-600">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-app-layout>
