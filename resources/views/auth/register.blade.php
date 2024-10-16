<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="birth_date" value="{{ __('Fecha de nacimiento') }}" />
                <x-jet-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" required
                    autocomplete="new-birth-date" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <label class="flex items-center">
                    <input type="checkbox" id="terms" name="terms" class="form-checkbox" required>
                    <span class="ml-2 text-sm text-gray-600">
                        Acepto todos los
                        <a href="#" id="termsLink" class="underline text-blue-600 hover:text-blue-900">
                            Terminos y condiciones
                        </a>
                    </span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>

    <div id="termsModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="px-4 py-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Terminos y condiciones</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            1. Aceptación de los Términos <br>
                            Al utilizar el software web y móvil de Inmoviva, aceptas los siguientes términos y
                            condiciones en su totalidad. Si no estás de acuerdo con alguno de estos términos, te
                            recomendamos no utilizar este sistema.
                        </p>
                        <p class="text-sm text-gray-500">
                            2. Descripción del Servicio <br>
                            Inmoviva proporciona una plataforma centralizada para la gestión de propiedades
                            inmobiliarias, que incluye la administración de ventas, alquileres y anticréticos. El
                            sistema está diseñado tanto para agentes inmobiliarios como para clientes, permitiendo la
                            gestión de transacciones inmobiliarias a través de interfaces web y móviles.</p>

                        <p class="text-sm text-gray-500">
                            3. Responsabilidades del Usuario <br>
                            Al utilizar este sistema, los usuarios aceptan:
                            Proporcionar información precisa y actualizada sobre las propiedades y sus transacciones.
                            Mantener la confidencialidad de sus credenciales de acceso.
                            No utilizar el sistema para actividades ilícitas, incluyendo fraude, reventa no autorizada
                            de propiedades, u otras acciones que violen las leyes locales.</p>
                        <p class="text-sm text-gray-500">
                            4. Seguridad y Protección de Datos <br>
                            Inmoviva se compromete a proteger la privacidad y la seguridad de los datos personales y de
                            las transacciones de sus usuarios.
                            Toda la información sensible será tratada conforme a las normativas vigentes de protección
                            de datos y mejores prácticas de seguridad.
                        </p>
                        <p class="text-sm text-gray-500">
                            5. Limitación de Responsabilidad <br>
                            Inmoviva no será responsable de:
                            
                            Errores cometidos por los usuarios durante la gestión de sus propiedades.
                            Pérdida de información derivada de fallos en el sistema que no puedan ser razonablemente previstos o evitados.
                            Retrasos o interrupciones en el servicio debido a causas fuera de nuestro control, como problemas de conectividad o ataques de seguridad externos.
                        </p>

                    </div>
                </div>
                <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="closeModal"
                        class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
    document.getElementById('termsLink').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        document.getElementById('termsModal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('termsModal').classList.add('hidden');
    });
</script>
