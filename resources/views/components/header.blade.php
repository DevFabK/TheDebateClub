<header class="header">
    <div class="header-titulo">
        <a href="{{ route('home') }}">
            THE DEBATE CLUB
        </a>
    </div>
    <div class="menu">

        <!-- Comprobamos el rol del usuario -->
        @php
            $rolNombre = 'Visitante';

            if (Auth::check()) {
                $rolNombre = Auth::user()->rol->nombre;
            }
        @endphp

        @if ($rolNombre === 'Usuario')
            <!-- Iconos para Usuario -->
            <a href="{{ route('perfil') }}"> <!-- Perfil -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </a>
            <a href="{{ route('crear') }}"> <!-- Post -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 24 24" fill="none"
                    id="Note-Text-Plus-Line--Streamline-Majesticons">
                    <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M20.125 14.375V4.791666666666667a1.9166666666666667 1.9166666666666667 0 0 0 -1.9166666666666667 -1.9166666666666667h-6.708333333333334m8.625 11.5v0.16483333333333333a1.9166666666666667 1.9166666666666667 0 0 1 -0.5615833333333333 1.3550833333333334l-3.6685 3.6685a1.9166666666666667 1.9166666666666667 0 0 1 -1.3550833333333334 0.5615833333333333H14.375m5.75 -5.75h-3.8333333333333335a1.9166666666666667 1.9166666666666667 0 0 0 -1.9166666666666667 1.9166666666666667v3.8333333333333335m0 0H4.791666666666667a1.9166666666666667 1.9166666666666667 0 0 1 -1.9166666666666667 -1.9166666666666667v-6.708333333333334m9.583333333333334 -4.791666666666667h3.8333333333333335m-6.708333333333334 3.8333333333333335h6.708333333333334M6.708333333333334 14.375h3.8333333333333335M5.75 2.875v2.875m0 2.875V5.75m0 0h2.875M5.75 5.75H2.875">
                    </path>
                </svg>
            </a>
        @elseif ($rolNombre === 'Moderador')
            <!-- Iconos para Moderador -->
            <a href="{{ route('perfil') }}"> <!-- Perfil -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </a>
            <a href="{{ route('crear') }}"> <!-- Post -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 24 24" fill="none"
                    id="Note-Text-Plus-Line--Streamline-Majesticons">
                    <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M20.125 14.375V4.791666666666667a1.9166666666666667 1.9166666666666667 0 0 0 -1.9166666666666667 -1.9166666666666667h-6.708333333333334m8.625 11.5v0.16483333333333333a1.9166666666666667 1.9166666666666667 0 0 1 -0.5615833333333333 1.3550833333333334l-3.6685 3.6685a1.9166666666666667 1.9166666666666667 0 0 1 -1.3550833333333334 0.5615833333333333H14.375m5.75 -5.75h-3.8333333333333335a1.9166666666666667 1.9166666666666667 0 0 0 -1.9166666666666667 1.9166666666666667v3.8333333333333335m0 0H4.791666666666667a1.9166666666666667 1.9166666666666667 0 0 1 -1.9166666666666667 -1.9166666666666667v-6.708333333333334m9.583333333333334 -4.791666666666667h3.8333333333333335m-6.708333333333334 3.8333333333333335h6.708333333333334M6.708333333333334 14.375h3.8333333333333335M5.75 2.875v2.875m0 2.875V5.75m0 0h2.875M5.75 5.75H2.875">
                    </path>
                </svg>
            </a>
        @elseif ($rolNombre === 'Admin')
            <!-- Iconos para Admin -->
            <a href="{{ route('perfil') }}"> <!-- Perfil -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </a>
            <a href="{{ route('crear') }}"> <!-- Post -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 24 24" fill="none"
                    id="Note-Text-Plus-Line--Streamline-Majesticons">
                    <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M20.125 14.375V4.791666666666667a1.9166666666666667 1.9166666666666667 0 0 0 -1.9166666666666667 -1.9166666666666667h-6.708333333333334m8.625 11.5v0.16483333333333333a1.9166666666666667 1.9166666666666667 0 0 1 -0.5615833333333333 1.3550833333333334l-3.6685 3.6685a1.9166666666666667 1.9166666666666667 0 0 1 -1.3550833333333334 0.5615833333333333H14.375m5.75 -5.75h-3.8333333333333335a1.9166666666666667 1.9166666666666667 0 0 0 -1.9166666666666667 1.9166666666666667v3.8333333333333335m0 0H4.791666666666667a1.9166666666666667 1.9166666666666667 0 0 1 -1.9166666666666667 -1.9166666666666667v-6.708333333333334m9.583333333333334 -4.791666666666667h3.8333333333333335m-6.708333333333334 3.8333333333333335h6.708333333333334M6.708333333333334 14.375h3.8333333333333335M5.75 2.875v2.875m0 2.875V5.75m0 0h2.875M5.75 5.75H2.875">
                    </path>
                </svg>
            </a>

            <a href="{{ route('panel') }}"> <!-- Panel Admin -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                </svg>

            </a>
        @else
            <!-- Para Visitante -->
            <a href="{{ route('registro') }}"> <!-- Registro -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </a>
        @endif

        <!-- Logout -->
        <a href="{{ route('logout') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
            </svg>
        </a>

    </div>
</header>
