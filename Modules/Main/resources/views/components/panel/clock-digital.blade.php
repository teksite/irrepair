@push('footerScripts')
    <script>
        function WhatTimeIsIt(){
            //FOR TIME
            let clock = new Date();
            let hour= clock.getHours();
            if(hour <10){ hour = "0"+hour}
            let mn = clock.getMinutes();
            if(mn <10){ mn = "0"+mn}
            let sec = clock.getSeconds();
            if(sec <10){ sec = "0"+sec}
            document.getElementById("time").innerText = hour + " : " + mn + " : " + sec;
        }
        setInterval(WhatTimeIsIt,1000);
    </script>
@endpush
<div id="screen">
    <div id="timeZone">
        <span id="time" class="font-bold text-center block p" dir="ltr"> Check your watch</span>
    </div>
</div>
