<x-public-layout mainClasses="flex flex-col lg:flex-row p-0 overflow-y-auto hide-scroll">
    <!-- Content Left: Form Section -->
    <div class="flex-1 flex flex-col justify-center items-center p-8 lg:p-16 xl:p-24 relative z-10">
        <div class="w-full max-w-lg flex flex-col gap-10">
            <!-- Header -->
            <div class="flex flex-col gap-2">
                <h2 class="font-display text-4xl md:text-5xl font-light text-white leading-tight">
                    Let's create something <br /><span class="font-bold text-primary italic">beautiful</span> together.
                </h2>
                <p class="font-display text-gray-400 text-lg font-light mt-2">
                    Available for freelance projects and collaborations worldwide.
                </p>
            </div>

            <!-- Form -->
            <form class="flex flex-col gap-6" action="#" method="POST">
                @csrf
                <!-- Name -->
                <div class="flex flex-col gap-2">
                    <label
                        class="font-display text-sm uppercase tracking-widest text-gray-400 font-semibold"
                        for="name">Your Name</label>
                    <input
                        class="w-full bg-transparent border-0 border-b-2 border-gray-700 focus:border-primary focus:ring-0 px-0 py-3 text-lg text-white placeholder-gray-500 font-display transition-colors duration-300"
                        id="name" placeholder="Jane Doe" type="text" name="name" required />
                </div>
                <!-- Email -->
                <div class="flex flex-col gap-2">
                    <label
                        class="font-display text-sm uppercase tracking-widest text-gray-400 font-semibold"
                        for="email">Email Address</label>
                    <input
                        class="w-full bg-transparent border-0 border-b-2 border-gray-700 focus:border-primary focus:ring-0 px-0 py-3 text-lg text-white placeholder-gray-500 font-display transition-colors duration-300"
                        id="email" placeholder="jane@example.com" type="email" name="email" required />
                </div>
                <!-- Message -->
                <div class="flex flex-col gap-2">
                    <label
                        class="font-display text-sm uppercase tracking-widest text-gray-400 font-semibold"
                        for="message">Message</label>
                    <textarea
                        class="w-full bg-transparent border-0 border-b-2 border-gray-700 focus:border-primary focus:ring-0 px-0 py-3 text-lg text-white placeholder-gray-500 font-display resize-none transition-colors duration-300"
                        id="message" placeholder="Tell me about your project..." rows="4" name="message"
                        required></textarea>
                </div>
                <!-- Submit -->
                <button
                    class="mt-4 self-start bg-white text-black hover:bg-primary hover:text-white transition-all duration-300 px-8 py-3 rounded-full font-display font-bold uppercase tracking-widest text-sm shadow-lg hover:shadow-xl hover:scale-105 transform"
                    type="submit">
                    Send Message
                </button>
            </form>

            <!-- Contact Direct -->
            <div class="flex flex-col sm:flex-row gap-8 pt-6 border-t border-white/10">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-gray-400">mail</span>
                    <a class="font-display text-gray-300 hover:text-primary transition-colors"
                        href="mailto:hello@portfolio.com">hello@portfolio.com</a>
                </div>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-gray-400">location_on</span>
                    <span class="font-display text-gray-300">Lisbon, Portugal</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Right: Image Section -->
    <div class="hidden lg:flex w-1/3 xl:w-5/12 bg-gray-100 relative justify-center items-center p-6">
        <!-- Image Placeholder - reusing one from home for now or specific -->
        <div class="relative w-full h-[80%] rounded-2xl overflow-hidden shadow-2xl group">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAhC221pg__6dpJZx3JvJsSP7fvayUl_9kCkVe8_3kT-4YQsetlf4tvYz7qB17cVvTuzIQKl8M12c7PIBBLxF99xxocdwlc4-GL7y2E37oyvt-Jw1zTugz19S-Lyejnsc6Hpsfjrf3t4T_FsnzJDwtsDJi5CmrYdepij1LIyaJlrsxxiBb-dbZqYlr628PZ_ycqK5ryc0HjfkWm7hf7o_z1qXorOHrWsCqCTPJ6zR3UjOqQj4yRj7rgAXtC0VI5x1xYA73EUI5DHPE');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60">
            </div>
            <div class="absolute bottom-8 left-8 text-white">
                <p class="font-display text-sm uppercase tracking-[0.2em] mb-1 opacity-80">Current Mood</p>
                <h3 class="font-display text-3xl font-light">Morning Haze</h3>
            </div>
        </div>
    </div>
</x-public-layout>