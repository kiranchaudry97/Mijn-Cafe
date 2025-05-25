<nav class="bg-gray-900 text-gray-200 shadow p-4">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
    <h1 class="text-2xl font-bold text-white">☕ Mijn Café</h1>

    <ul class="flex flex-wrap justify-center md:justify-end space-x-6 text-sm font-semibold">
      <li><a href="{{ route('home') }}" class="hover:text-white hover:underline decoration-white">Home</a></li>
      <li><a href="{{ route('menu') }}" class="hover:text-white hover:underline decoration-white">Menu</a></li>
      <li><a href="{{ route('faq.index') }}" class="hover:text-white hover:underline decoration-white">FAQ</a></li>
      <li><a href="{{ route('contact') }}" class="hover:text-white hover:underline decoration-white">Contact</a></li>
      <li><a href="{{ route('users.index') }}" class="hover:text-white hover:underline decoration-white">Gebruikers</a></li>

      @auth
        @if(Auth::user()->is_admin)
          <li><a href="{{ route('admin.dashboard') }}" class="hover:text-white hover:underline decoration-white">Admin</a></li>
        @endif

        <li><a href="{{ route('profile.edit') }}" class="hover:text-white hover:underline decoration-white">Profiel bewerken</a></li>
        <li><a href="{{ route('orders.index') }}" class="hover:text-white hover:underline decoration-white">Bestellingen </a></li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="hover:text-red-400 hover:underline decoration-white">Uitloggen</button>
          </form>
        </li>
      @else
        <li class="relative group">
          <button
            class="flex items-center space-x-1 hover:text-white hover:underline decoration-white focus:outline-none"
          >
            <span>Inloggen</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <ul class="absolute left-0 mt-2 w-36 bg-gray-800 border border-gray-700 rounded shadow-lg opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity z-10">
            <li>
              <a href="{{ route('login') }}"
                 class="block px-4 py-2 text-gray-200 hover:bg-gray-700 hover:text-white hover:underline decoration-white">
                Gebruiker
              </a>
            </li>
            <li>
              <a href="{{ route('login', ['admin' => 1]) }}"
                 class="block px-4 py-2 text-gray-200 hover:bg-gray-700 hover:text-white hover:underline decoration-white">
                Admin
              </a>
            </li>
          </ul>
        </li>
      @endauth
    </ul>
  </div>
</nav>