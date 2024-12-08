@push('footerScripts')
    <script>
        window.onload = function(){
            let now = new Date();
            let h = now.getHours(), m = now.getMinutes(), s = now.getSeconds();
            let curr = h * 60 * 60 + m * 60 + s;
            svg.setCurrentTime(curr);
        };
    </script>
@endpush
<svg id="svg" width="100%" height="100%" viewBox="-400 -150 800 500" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <path id="sec" d="M0,-140A140,140 0 0,1 0,140A140,140 0 0,1 0,-140"
              stroke-dasharray="880" stroke-dashoffset="-880.1" fill="none">
            <animate id="second" attributeName="stroke-dashoffset"
                     dur="1s" repeatCount="60"
                     begin="0s;second.end" additive="sum" accumulate="sum"
                     calcMode="spline" values="0;-14.66" keyTimes="0;1"
                     keySplines="0.42 0.0 0.58 1.0"/>
        </path>
        <path id="min" d="M0,-130A130,130 0 0,1 0,130A130,130 0 0,1 0,-130"
              stroke-dasharray="817" stroke-dashoffset="-817.1" fill="none">
            <animate id="minute" attributeName="stroke-dashoffset"
                     dur="60s" repeatCount="60"
                     begin="0s;minute.end" additive="sum" accumulate="sum"
                     calcMode="spline" values="0;0;-13.613" keyTimes="0;0.9833;1"
                     keySplines="0,0,1,1;0.42 0.0 0.58 1.0"/>
        </path>
        <path id="hr" d="M0,-120A120,120 0 0,1 0,120A120,120 0 0,1 0,-120"
              stroke-dasharray="754" stroke-dashoffset="-754.1" fill="none">
            <animate id="hour" attributeName="stroke-dashoffset"
                     dur="3600s" repeatCount="12"
                     begin="0s;hour.end" additive="sum" accumulate="sum"
                     calcMode="spline" values="0;0;-62.83" keyTimes="0;0.9997222;1"
                     keySplines="0,0,1,1;0.42 0.0 0.58 1.0"/>
        </path>
        <mask id="mask" maskUnits="userSpaceOnUse" x="-150" y="-150" width="300" height="300">
            <g stroke-width="10" stroke-linecap="round" stroke="white">
                <use xlink:href="#sec" x="0" y="0"/>
                <use xlink:href="#min" x="0" y="0"/>
                <use xlink:href="#hr" x="0" y="0"/>
            </g>
        </mask>
    </defs>
    <rect x="-150" y="-150" width="100%" height="100%" fill='transparent'/>
    <g stroke-width="7" stroke-linecap="round" mask="url(#mask)">
        <g stroke="hsla(0, 95%, 25%, 1)" >
            <use xlink:href="#sec"/>
        </g>
        <g stroke="hsla(188, 15%, 35%, 1)">
            <use xlink:href="#min"/>
        </g>
        <g stroke="hsla(218, 5%, 15%, 1)">
            <use xlink:href="#hr"/>
        </g>
    </g>
</svg>
