<x-admin-layout>
    @auth
        <h1 class="text-xl font-bold mb-4">Bienvenido, {{ auth()->user()->name }}!</h1>

        @if(auth()->user()->hasRole('admin'))
            <p>Este es el panel administrador con permisos completos.</p>
            {{-- Aquí puedes mostrar contenido exclusivo para admins --}}
        @elseif(auth()->user()->hasRole('reclutador'))
            <p>Este es el panel para reclutadores, con permisos limitados.</p>
            {{-- Contenido para reclutadores --}}
        @else
            <p>Bienvenido usuario candidato.</p>
            {{-- Contenido para usuarios normales --}}
        @endif
    @else
        <p>Por favor, inicia sesión para ver el panel.</p>
    @endauth
</x-admin-layout>