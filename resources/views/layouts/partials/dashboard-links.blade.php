<aside class="col-lg-3">
    <div class="widget">
        <div class="widget-title first">
            <h4>Mein Bereich</h4>
        </div>
        <ul class="cats">
            <li><a href="{{ route('client.dashboard') }}">Startseite</a></li>
            <li><a href="#">StampCard<span>(21)</span></a></li>
            <li><a href="#">Meine Bestellungen<span>(21)</span></a></li>
            <li><a href="#">Coupons<span>(44)</span></a></li>
        </ul>
    </div>
    <!-- /widget -->
    <div class="widget">
        <div class="widget-title">
            <h4>@autotranslate('Einstellungen', app()->getLocale())</h4>
        </div>
        <ul class="cats">
            <li><a href="{{ route('client.profile') }}">@autotranslate('Mein Profil', app()->getLocale())</a></li>
            <li><a href="{{ route('client.notifications') }}">@autotranslate('Notifications', app()->getLocale())</a></li>
            <li><a href="{{ route('client.security') }}">@autotranslate('Security', app()->getLocale())</a></li>
        </ul>
    </div>
    <!-- /widget -->
</aside>
<!-- /aside -->
