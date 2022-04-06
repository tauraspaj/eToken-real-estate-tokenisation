<?php
$activePage = 'contact';
include_once './header.php';
?>

<!-- Call/Email/Visit -->
<section class="container mx-auto py-12 md:py-16">
    <div class="flex flex-col md:flex-row md:justify-evenly space-y-16 md:space-y-0">
        <div class="flex flex-col justify-center items-center">
            <i class="fas fa-phone-alt text-4xl text-gray-600"></i>
            <h1 class="text-xl tracking-wide text-gray-800 font-bold mt-4 md:mt-6">Call us</h1>
            <p class="text-gray-700 text-sm mt-1">Work days from 9:00 to 20:00</p>
            <h2 class="text-orange-600 font-semibold mt-4">+44 7716 494122</h2>
        </div>
        <div class="flex flex-col justify-center items-center">
            <i class="fas fa-envelope text-4xl text-gray-600"></i>
            <h1 class="text-xl tracking-wide text-gray-800 font-bold mt-4 md:mt-6">Email us</h1>
            <p class="text-gray-700 text-sm mt-1">Answers to all your questions</p>
            <h2 class="text-orange-600 font-semibold mt-4">info@mytoken.com</h2>
        </div>
        <div class="flex flex-col justify-center items-center">
            <i class="fas fa-map-marker-alt text-4xl text-gray-600"></i>
            <h1 class="text-xl tracking-wide text-gray-800 font-bold mt-4 md:mt-6">Visit</h1>
            <p class="text-gray-700 text-sm mt-1">Let us know before visiting!</p>
            <h2 class="text-orange-600 font-semibold mt-4">24 Meadow Road, GU2 7TP</h2>
        </div>
    </div>
</section>

<!-- Contact form -->
<section class="bg-gray-100 border-t py-12 md:py-16 px-4">
    <div class="container mx-auto">
        <h1 class="text-2xl text-gray-800 font-bold">Contact form</h1>
        <div class="title-underline"></div>
        
        <form method="POST" class="space-y-4 mt-8">
            <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-8">
                <div class="flex-1 flex flex-col">
                    <label for="name" class="text-xs uppercase font-semibold text-gray-500 p-1">Name</label>
                    <input type="text" id="form_name" name="form_name" class="h-10 text-sm p-2 border focus:border-opacity-0 placeholder-gray-400 text-gray-800 rounded outline-none focus:outline-none transition font-medium focus:ring-1 ring-gray-400" required placeholder="Please enter your name">
                </div>
                <div class="flex-1 flex flex-col">
                    <label for="email" class="text-xs uppercase font-semibold text-gray-500 p-1">Email</label>
                    <input type="text" id="form_email" name="form_email" class="h-10 text-sm p-2 border focus:border-opacity-0 placeholder-gray-400 text-gray-800 rounded outline-none focus:outline-none transition font-medium focus:ring-1 ring-gray-400" placeholder="Please enter your email">
                </div>
                <div class="flex-1 flex flex-col">
                    <label for="phoneNumber" class="text-xs uppercase font-semibold text-gray-500 p-1">Phone number</label>
                    <input type="text" id="form_phoneNumber" name="form_phoneNumber" class="h-10 text-sm p-2 border focus:border-opacity-0 placeholder-gray-400 text-gray-800 rounded outline-none focus:outline-none transition font-medium focus:ring-1 ring-gray-400" placeholder="Where can we call you?">
                </div>
            </div>
            <div class="flex-1 flex flex-col">
                <label for="message" class="text-xs uppercase font-semibold text-gray-500 p-1">Message</label>
                <textarea name="form_message" id="form_message" rows="7" class="text-sm p-2 border focus:border-opacity-0 placeholder-gray-400 text-gray-800 rounded outline-none focus:outline-none transition font-medium focus:ring-1 ring-gray-400" required placeholder="What would you like to know?"></textarea>
            </div>
            <div class="justify-center items-center flex mt-2">
                <button id="submitForm" class="flex text-orange-600 space-x-4 font-semibold border-2 border-orange-600 px-6 py-2 transition hover:text-white hover:bg-orange-600 hover:border-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <p>Send message</p>
                </button>
            </div>
        </form> 
    </div>
</section>


<?php 
include_once './footer.php';
?>