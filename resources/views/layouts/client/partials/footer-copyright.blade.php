<div class="bg-slate-700 ps-3 pe-3 pt-3 pb-3" id="site-copyright">
    <p class="text-center text-sm text-gray-200 mb-0">
        {{__('all rights of this site is reserved by :name',['name'=>__(config('app.name'))])}}
        (<span>{{dateAdapter(\Carbon\Carbon::parse('2006-01-01') ,'Y')}}</span> - <span>{{dateAdapter(\Carbon\Carbon::now() ,'Y')}}</span>)
    </p>
</div>
