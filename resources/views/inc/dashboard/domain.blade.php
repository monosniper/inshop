<div class="domain">
    <div class="domain__left">
        <a href="{{ "https://" . $name }}" target="_blank" class="domain__name">
            {{ $name }}
            <img src="{{ asset('assets/img/icons/link.png') }}" alt="Domain link">
        </a>
    </div>
    <div class="domain__right">
        <span class="domain__status domain__status_active">Активен</span>
        <div class="dropdown">
            <button class="domain__menu dropdown__toggler">
                <img src="{{ asset('assets/img/icons/menu.png') }}" alt="Dropdown domain menu">
            </button>
            <div class="dropdown__list">
                <form action="{{ route('domains.destroy', $id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button>Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
