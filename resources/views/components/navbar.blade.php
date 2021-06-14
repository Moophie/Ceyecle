
<div id="nav">
<nav>
    <a href="/social" style="position: relative;"><img src="{{ asset('/images/icons/connect_1-8.png') }}" alt="Social icon" height="50px">@if($requests or $chats[0])<span style="position: absolute; z-index: 5; right: 0px;  font-size: 12px; background-color: #3C7A84; padding: 1px 5px; border-radius: 5px; color: white;">{{ count($requests) + count($chats[0]) }}</span>@endif</a>
    <a href="/"><img src="{{ asset('/images/icons/Home_2-8.png') }}" alt="Home icon" height="50px"></a>
    <a href="/profile"><img src="{{ asset('/images/icons/Profiel_2-8.png') }}" alt="Profile icon" height="50px"></a>
</nav>
</div>
