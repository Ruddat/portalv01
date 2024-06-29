        {{--**********************************
            Footer start
        ***********************************--}}
        <div class="footer">
            <div class="copyright border-top">
                <p>&copy; @autotranslate('Designed by Ingo Ruddat - Version', app()->getLocale()) {{ config('app.version', '1.0') }} - {{ \Carbon\Carbon::createFromDate(2024, 1, 12)->format('d m Y') }} -- {{ now()->format('d m Y') }}</p>
            </div>
        </div>
        {{--**********************************
            Footer end
        ***********************************--}}
