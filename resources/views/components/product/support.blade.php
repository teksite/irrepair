<section class="iq-features">
    @php
        $supports=[
        [
                    'title'=>'تیکت',
                    'body'=>'امکان ثبت تیکت در سامانه پشتیبانی',
                    'icon'=>'comment'
        ], [
                    'title'=>'تلفن',
                    'body'=>'پشتیبانی از طریق تلفن و داخلی مخصوص پشتیبان',
                    'icon'=>'phone'
        ], [
                    'title'=>'تلگرام',
                    'body'=>'ارتباط از طریق تلگرام با پشتیبان ویژه دوره',
                    'icon'=>'telegram'
        ], [
                    'title'=>'حضوری',
                    'body'=>'ملاقات حضوری با هماهنگی قبلی در دفتر ایزایران با پشتیبان دوره (جلسات نیم ساعته و یک ساعته)',
                    'icon'=>'user'
        ], [
                    'title'=>'واتساپ',
                    'body'=>'ارتباط از طریق واتساپ با پشتیبان ویژه دوره',
                    'icon'=>'whatsapp'
        ],[
                    'title'=>'ریموت',
                    'body'=>'اتصال به کامپیوتر دانشجو و بررسی مشکل',
                    'icon'=>'monitor-shared'
        ],
        ];
    @endphp
    <div class="container">
            <div class="">
                <div class="holderCircle">
                    <div class="round"></div>
                    <div class="dotCircle">
                        @foreach($supports as $support)
                            <span
                                class="itemDot {{'itemDot'.$loop->iteration}} {{$loop->iteration == 1 ? 'active text-gray-200':'text-secondary-950'}}"
                                data-tab="{{$loop->iteration}}">
                            <i class="tkicon fill-none stroke-current" data-icon="{{$support['icon']}}"></i>
                           <span class="forActive"></span>
                           </span>
                        @endforeach
                    </div>
                    <div class="contentCircle">
                        @foreach($supports as $support)
                            <div
                                class="CirItem title-box {{'CirItem'.$loop->iteration}} {{$loop->iteration === 1 ? 'active' :''}}">
                                <h3 class="title text-secondary-700"><span>{{$support['title']}}</span></h3>
                                <p class="text-center">{{$support['body']}}</p>
                                <i class="tkicon fill-none stroke-primary-700" data-icon="{{$support['icon']}}"></i>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
</section>
