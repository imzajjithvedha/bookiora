@props([
    'all_count',
    'general_count',
    'partner_count',
    'customer_count',
    'starred_count',
    'bin_count'
])

<div class="message-sidebar">
    <p class="title raleway">My Messages</p>

    <ul class="menu">
        <li class="link">
            <a href="{{ route('admin.messages.index', 'all') }}" class="actual-link {{ Request::segment(2) == 'messages' && Request::segment(3) == 'all' ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-envelope"></i>
                    All Messages
                </div>

                <p class="number">{{ $all_count }}</p>
            </a>
        </li>

        <li class="link">
            <a href="{{ route('admin.messages.index', 'general') }}" class="actual-link {{ Request::segment(2) == 'messages' && Request::segment(3) == 'general' ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-layout-text-window-reverse"></i>
                    General Inquiry
                </div>

                <p class="number">{{ $general_count }}</p>
            </a>
        </li>

        <li class="link">
            <a href="{{ route('admin.messages.index', 'partner') }}" class="actual-link {{ Request::segment(2) == 'messages' && Request::segment(3) == 'partner' ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-house-lock"></i>
                    Partner Inquiry
                </div>

                <p class="number">{{ $partner_count }}</p>
            </a>
        </li>

        <li class="link">
            <a href="{{ route('admin.messages.index', 'customer') }}" class="actual-link {{ Request::segment(2) == 'messages' && Request::segment(3) == 'customer' ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-key"></i>
                    Customer Inquiry
                </div>

                <p class="number">{{ $customer_count }}</p>
            </a>
        </li>

        <li class="link">
            <a href="{{ route('admin.messages.index', 'starred') }}" class="actual-link {{ Request::segment(2) == 'messages' && Request::segment(3) == 'starred' ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-star"></i>
                    Starred
                </div>

                <p class="number">{{ $starred_count }}</p>
            </a>
        </li>

        <li class="link">
            <a href="{{ route('admin.messages.index', 'bin') }}" class="actual-link {{ Request::segment(2) == 'messages' && Request::segment(3) == 'bin' ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                    <i class="bi bi-trash"></i>
                    Bin
                </div>

                <p class="number">{{ $bin_count }}</p>
            </a>
        </li>
    </ul>
</div>