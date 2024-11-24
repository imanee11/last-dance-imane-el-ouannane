<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div
            class="shadow-md shadow-black/40 bg-[#1C1C1C] border-[#2e2e2e] border-[1px] rounded-2xl w-full max-w-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-[#fff] mb-2">Upgrade to Premium</h1>
                <p class="text-[#929292] ">Create unlimited teams and unlock all features</p>
            </div>

            <div class="space-y-6">
                <div class="bg-[#272727] rounded-xl p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xl font-semibold text-[#fff]">Premium Plan</span>
                        <span class="text-2xl font-bold text-[#dd4a79]">$9.99</span>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex gap-3 items-center text-[#929292]">
                            <i class="fa-solid fa-check text-[#6dc489]"></i>
                            Create unlimited teams
                        </li>
                        <li class="flex gap-3 items-center text-[#929292]">
                            <i class="fa-solid fa-check text-[#6dc489]"></i>
                            Priority support
                        </li>
                        <li class="flex gap-3 items-center text-[#929292]">
                            <i class="fa-solid fa-check text-[#6dc489]"></i>
                            Advanced team analytics
                        </li>
                    </ul>
                </div>

                <button id="checkout-button"
                    class="w-full bg-[#6737f5] border-[2px] border-[#6737f5] text-white py-3 px-6 rounded-md font-semibold hover:bg-transparent hover:border-[2px] hover:border-[#fff] transition duration-200 flex items-center justify-center">
                    Upgrade Now
                </button>

                <p class="text-center text-sm text-gray-500">
                    Secure payment powered by Stripe
                </p>
            </div>
        </div>
    </div>

    <script>
        const button = document.getElementById('checkout-button');
        button.addEventListener('click', async () => {
            button.disabled = true;
            button.textContent = 'Loading...';

            try {
                const response = await fetch('{{ route('subscription.checkout') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.url) {
                    window.location.href = data.url;
                } else {
                    throw new Error('Failed to create checkout session');
                }
            } catch (error) {
                console.error('Error:', error);
                button.textContent = 'Error occurred';
            }
        });
    </script>
</x-app-layout>
