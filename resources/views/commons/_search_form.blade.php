<div class="shop-top-bar">
    <div class="shop-tab-wrap">&nbsp;</div>
    <div class="shop-select">
        <form action="{{ route('courses.search') }}" method="GET">
            <input type="text" class="search_input" name="q" placeholder="Search courses" minlength="3" value="{{ request()->query('q') }}">
            <button class="search_button" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>