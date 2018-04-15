<div class="menu-filter">
    <ul id="menu-filter">
        <li class="main_filter">
            <a href="{{ route('task') }}" style="padding-left: 0px;">Все ({{ getCountAllTask() }})</a>
        </li>
        <li class="main_filter">
            <a href="#">Лучшие</a>
        </li>
        <li class="main_filter">
            <a href="{{ url('task/filter/high_price') }}">Высокая оплата</a>
        </li>
        <li class="main_filter">
            <a href="#">Креативные</a>
        </li>
        <li class="main_filter">
            <a href="{{ url('task/filter/types') }}">По типам</a>
        </li>
        <li class="main_filter">
            <a href="{{ url('task/filter/partners') }}">По партнерам</a>
        </li>
        <li class="main_filter">
            <a href="{{ url('task/filter/top_users') }}">ТОП исполнителей</a>
        </li>
    </ul>
    <!-- /.nav -->
</div>