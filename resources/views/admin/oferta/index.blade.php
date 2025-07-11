<x-admin-layout>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Ofertas</a>
                </div>
            </li>
        </ol>
    </nav>






    <div class="py-4 flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Ofertas</h1>
        @if ($user->hasRole('reclutador'))
            <a href="{{ route('admin.oferta.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <i class="fas fa-plus"></i>
                Nueva Oferta
            </a>
        @endif
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cargo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Inicio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Fin
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Modalidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Salario
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Área
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ofertas as $oferta)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $oferta->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $oferta->cargo }}
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $oferta->estado === 'A' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $oferta->estado === 'A' ? 'Activa' : 'Inactiva' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($oferta->fecha_inicio)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($oferta->fecha_fin)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $oferta->modalidad === 'P' ? 'Presencial' : ($oferta->modalidad === 'R' ? 'Remoto' : 'Híbrido') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ number_format($oferta->salario_minimo, 2) }} -
                            {{ number_format($oferta->salario_maximo, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $oferta->area->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->hasRole('reclutador'))
                                <a href="{{ route('admin.oferta.edit', $oferta->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline me-3">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                            @endif
                            <a data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                data-id="{{ $oferta->id }}"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline me-3">
                                <i class="fas fa-trash-alt fa-lg"></i>
                            </a>
                            <a href="{{ route('admin.oferta.candidatos', $oferta->id) }}"
                                class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                <i class="fas fa-users fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white dark:bg-gray-900 border-b dark:border-gray-700 border-gray-200">
                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                            No hay ofertas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Deseas eliminar esta oferta?
                    </h3>

                    <a id="confirmarEliminar" data-modal-hide="popup-modal" href="#"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Sí, Estoy seguro
                    </a>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                        cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let idEliminar = null;

            document.querySelectorAll("[data-modal-target='popup-modal']").forEach(button => {
                button.addEventListener("click", function() {
                    idEliminar = this.getAttribute("data-id");
                });
            });

            document.getElementById("confirmarEliminar").addEventListener("click", function(e) {
                e.preventDefault();

                if (idEliminar) {
                    let form = document.getElementById("deleteForm");
                    form.action = `{{ route('admin.oferta.destroy', '') }}/${idEliminar}`;
                    form.submit();
                }
            });
        });
    </script>

</x-admin-layout>
