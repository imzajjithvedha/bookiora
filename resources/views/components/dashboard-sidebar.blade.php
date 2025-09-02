@if(auth()->user()->role == 'admin')
    <div class="sidebar active">
        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('admin.dashboard') }}" class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-ui-checks-grid"></i>
                        Dashboard
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('admin.users.index') }}" class="{{ Request::segment(2) == 'users' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-people"></i>
                        Users
                        <p class="new-count">{{ App\Models\User::where('is_new', 1)->count() != 0 ? App\Models\User::where('is_new', 1)->count() : '' }}</p>
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('admin.messages.index', 'all') }}" class="{{ Request::segment(2) == 'messages' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-chat-dots"></i>
                        Messages

                        @php
                            $messages = App\Models\Message::where('admin_view', 1)->get();
                            $message_replies = App\Models\MessageReply::where('admin_view', 1)->get();

                            $message_ids = $messages->pluck('id')->toArray();

                            $filtered_replies = $message_replies->reject(function ($reply) use ($message_ids) {
                                return in_array($reply->message_id, $message_ids);
                            });

                            $unique_reply_message_ids = $filtered_replies->pluck('message_id')->unique()->count();

                            $total_new_messages = $messages->count() + $unique_reply_message_ids;
                        @endphp

                        <p class="new-count">{{ $total_new_messages != 0 ? $total_new_messages : ''; }}</p>
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('admin.supports.index') }}" class="{{ Request::segment(2) == 'supports' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-question-square"></i>
                        Supports
                        <p class="new-count">{{ App\Models\Support::where('is_new', 1)->count() != 0 ? App\Models\Support::where('is_new', 1)->count() : ''; }}</p>
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('admin.subscriptions.index') }}" class="{{ Request::segment(2) == 'subscriptions' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-card-text"></i>
                        Subscriptions
                        <p class="new-count">{{ App\Models\Subscription::where('is_new', 1)->count() != 0 ? App\Models\Subscription::where('is_new', 1)->count() : ''; }}</p>
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('admin.reports.index') }}" class="{{ Request::segment(2) == 'reports' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-flag"></i>
                        Reports
                        <p class="new-count">{{ App\Models\Report::where('is_new', 1)->count() != 0 ? App\Models\Report::where('is_new', 1)->count() : ''; }}</p>
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('admin.stays.index') }}" class="{{ Request::segment(2) == 'stays' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-houses"></i>
                        Stays
                        <p class="new-count">{{ App\Models\Stay::where('is_new', 1)->count() != 0 ? App\Models\Stay::where('is_new', 1)->count() : '' }}</p>
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('admin.stays.bookings.index') }}" class="{{ Request::segment(2) == 'bookings' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-ui-checks"></i>
                        Bookings
                        <p class="new-count">{{ App\Models\Booking::where('is_admin_new', 1)->count() != 0 ? App\Models\Booking::where('is_admin_new', 1)->count() : ''; }}</p>
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('admin.surf-camps.index') }}" class="{{ Request::segment(2) == 'surf-camps' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-houses"></i>
                        Surf Camps
                        <p class="new-count">{{ App\Models\Stay::where('is_new', 1)->count() != 0 ? App\Models\Stay::where('is_new', 1)->count() : '' }}</p>
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('admin.surf-camps.bookings.index') }}" class="{{ Request::segment(2) == 'bookings' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-ui-checks"></i>
                        Bookings
                        <p class="new-count">{{ App\Models\Booking::where('is_admin_new', 1)->count() != 0 ? App\Models\Booking::where('is_admin_new', 1)->count() : ''; }}</p>
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('admin.vehicle-rentals.index') }}" class="{{ Request::segment(2) == 'vehicle-rentals' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-houses"></i>
                        Vehicle Rentals
                        <p class="new-count">{{ App\Models\Stay::where('is_new', 1)->count() != 0 ? App\Models\Stay::where('is_new', 1)->count() : '' }}</p>
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('admin.vehicle-rentals.bookings.index') }}" class="{{ Request::segment(2) == 'bookings' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-ui-checks"></i>
                        Bookings
                        <p class="new-count">{{ App\Models\Booking::where('is_admin_new', 1)->count() != 0 ? App\Models\Booking::where('is_admin_new', 1)->count() : ''; }}</p>
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('admin.articles.index') }}" class="{{ Request::segment(2) == 'articles' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-newspaper"></i>
                        Articles
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('admin.reviews.index') }}" class="{{ Request::segment(2) == 'reviews' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-calendar2-week"></i>
                        Reviews
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('admin.settings.index') }}" class="{{ Request::segment(2) == 'settings' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-gear"></i>
                        Settings
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="#">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-power"></i>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="log-out">Log Out</button>
                        </form>
                    </div>
                </a>
            </li>
        </ul>
    </div>
@elseif(auth()->user()->role == 'partner')
    <div class="sidebar active">
        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('landlord.dashboard') }}" class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-ui-checks-grid"></i>
                        Dashboard
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('landlord.warehouses.index') }}" class="{{ Request::segment(2) == 'warehouses' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-houses"></i>
                        Stays
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('landlord.bookings.index') }}" class="{{ Request::segment(2) == 'bookings' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-ui-checks"></i>
                        Bookings
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('landlord.messages.index', 'all') }}" class="{{ Request::segment(2) == 'messages' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-chat-dots"></i>
                        Messages

                        @php
                            $messages = App\Models\Message::where('user_id', auth()->user()->id)->get();
                            $message_ids = $messages->pluck('id')->toArray();

                            $unseen_messages = $messages->where('user_view', 1);
                            $unseen_message_ids = $unseen_messages->pluck('id')->toArray();

                            $message_replies = App\Models\MessageReply::whereIn('message_id', $message_ids)->where('user_view', 1)->get();

                            $filtered_replies = $message_replies->reject(function ($reply) use ($unseen_message_ids) {
                                return in_array($reply->message_id, $unseen_message_ids);
                            });

                            $unique_reply_message_ids = $filtered_replies->pluck('message_id')->unique()->count();

                            $total_new_messages = $unseen_messages->count() + $unique_reply_message_ids;
                        @endphp

                        <p class="new-count">{{ $total_new_messages != 0 ? $total_new_messages : ''; }}</p>
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('landlord.settings.index') }}" class="{{ Request::segment(2) == 'settings' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-gear"></i>
                        Settings
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="#">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-power"></i>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="log-out">Log Out</button>
                        </form>
                    </div>
                </a>
            </li>
        </ul>
    </div>
@else
    <div class="sidebar active">
        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('tenant.dashboard') }}" class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-ui-checks-grid"></i>
                        Dashboard
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('tenant.bookings.index') }}" class="{{ Request::segment(2) == 'bookings' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-ui-checks"></i>
                        Bookings
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="{{ route('tenant.messages.index', 'all') }}" class="{{ Request::segment(2) == 'messages' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-chat-dots"></i>
                        Messages

                        @php
                            $messages = App\Models\Message::where('user_id', auth()->user()->id)->get();
                            $message_ids = $messages->pluck('id')->toArray();

                            $unseen_messages = $messages->where('user_view', 1);
                            $unseen_message_ids = $unseen_messages->pluck('id')->toArray();

                            $message_replies = App\Models\MessageReply::whereIn('message_id', $message_ids)->where('user_view', 1)->get();

                            $filtered_replies = $message_replies->reject(function ($reply) use ($unseen_message_ids) {
                                return in_array($reply->message_id, $unseen_message_ids);
                            });

                            $unique_reply_message_ids = $filtered_replies->pluck('message_id')->unique()->count();

                            $total_new_messages = $unseen_messages->count() + $unique_reply_message_ids;
                        @endphp

                        <p class="new-count">{{ $total_new_messages != 0 ? $total_new_messages : ''; }}</p>
                    </div>
                </a>
            </li>
        </ul>

        <hr>

        <ul class="main-menu">
            <li class="link">
                <a href="{{ route('tenant.settings.index') }}" class="{{ Request::segment(2) == 'settings' ? 'active' : '' }}">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-gear"></i>
                        Settings
                    </div>
                </a>
            </li>

            <li class="link">
                <a href="#">
                    <div class="box"></div>
                    <div class="actual-link">
                        <i class="bi bi-power"></i>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="log-out">Log Out</button>
                        </form>
                    </div>
                </a>
            </li>
        </ul>
    </div>
@endif