<x-master >
    <div class="content-wrapper">

    
    <section class="content">
            <h1>User</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>

    </section>
</div>
</x-master>
