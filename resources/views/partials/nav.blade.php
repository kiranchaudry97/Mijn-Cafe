<nav class="bg-white shadow p-4">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
    <h1 class="text-2xl font-bold text-gray-800">☕ Mijn Café</h1>
    <ul class="flex flex-wrap justify-center md:justify-end space-x-6 text-sm font-semibold">
      <li><a href="{{ route('home') }}" class="text-gray-800 hover:text-gray-500">Home</a></li>
      <li><a href="{{ route('menu') }}" class="text-gray-800 hover:text-gray-500">Menu</a></li>
      <li><a href="{{ route('contact') }}" class="text-gray-800 hover:text-gray-500">Contact</a></li>

      @auth
        <li><a href="{{ route('orders.index') }}" class="text-gray-800 hover:text-gray-500">Winkelmand</a></li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-gray-800 hover:text-red-500">Uitloggen</button>
          </form>
        </li>
      @else
        <li class="relative group">
          <button
            class="flex items-center space-x-1 text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none"
          >
            <span>Inloggen</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <ul
            class="absolute left-0 mt-2 w-36 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 transition-opacity"
          >
            <li>
              <a href="{{ route('login') }}"
                 class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-gray-500"
              >
                Gebruiker
              </a>
            </li>
            <li>
              <a href="{{ route('login', ['admin' => 1]) }}"
                 class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-gray-500"
              >
                Admin
              </a>
            </li>
          </ul>
        </li>
      @endauth
    </ul>
  </div>
</nav>
