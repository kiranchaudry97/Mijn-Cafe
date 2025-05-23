<footer class="bg-gray-900 text-white mt-auto">
  <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-10 text-sm">
    
    <!-- Ons Adres -->
    <div>
      <h4 class="font-semibold uppercase mb-3 text-gray-300">Ons Adres</h4>
      <iframe
        class="w-full h-32 rounded"
        src="https://www.google.com/maps?q=Erasmus+Hogeschool+Quai+de+l'Industrie+170,+1070+Anderlecht&output=embed"
        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
      <p class="mt-3 leading-6">
        Erasmus Hogeschool<br>
        Quai de l'Industrie 170<br>
        1070 Anderlecht
      </p>
    </div>

    <!-- Contact -->
    <div>
      <h4 class="font-semibold uppercase mb-3 text-gray-300">Say Hello</h4>
      <p class="mb-2">Vragen of opmerkingen? Neem gerust contact op via e-mail.</p>
      <p class="font-semibold">
        <a href="mailto:info@mijncafe.nl" class="hover:underline text-blue-300">info@mijncafe.nl</a>
      </p>
    </div>

    <!-- Social + Nieuwsbrief -->
    <div>
      <h4 class="font-semibold uppercase mb-3 text-gray-300">Blijf op de hoogte</h4>
      <div class="flex space-x-4 text-lg mb-4">
        <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" class="hover:text-blue-500">FB</a>
        <a href="https://x.com/" target="_blank" rel="noopener noreferrer" class="hover:text-sky-400">X</a>
        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" class="hover:text-pink-500">IG</a>
      </div>
      <form class="flex flex-col sm:flex-row items-center gap-2">
        <input type="email" placeholder="Jouw e-mailadres" class="w-full px-4 py-2 rounded text-black" required>
        <button class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">Verstuur</button>
      </form>
    </div>

  </div>

  <div class="text-center text-xs text-gray-400 py-4 border-t border-gray-700">
    &copy; {{ date('Y') }} Mijn Café — Project Backend Chaud-ry Kiran. Alle rechten voorbehouden.
  </div>
</footer>