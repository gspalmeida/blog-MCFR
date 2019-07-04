//## countdown ##//
function getTimeRemaining( endtime ) {
    var t = Date.parse( endtime ) - Date.parse( new Date() );
    var seconds = Math.floor( ( t / 1000 ) % 60 );
    var minutes = Math.floor( ( t / 1000 / 60 ) % 60 );
    var hours = Math.floor( ( t / ( 1000 * 60 * 60 ) ) % 24 );
    var days = Math.floor( t / ( 1000 * 60 * 60 * 24 ) );
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

function initializeClock( id, endtime ) {
    var clock = document.getElementById( id );
    var daysSpan = clock.querySelector( '.days' );
    var hoursSpan = clock.querySelector( '.hours' );
    var minutesSpan = clock.querySelector( '.minutes' );
    var secondsSpan = clock.querySelector( '.seconds' );

    function updateClock() {
        var t = getTimeRemaining( endtime );

        daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ( '0' + t.hours ).slice( -2 );
        minutesSpan.innerHTML = ( '0' + t.minutes ).slice( -2 );
        secondsSpan.innerHTML = ( '0' + t.seconds ).slice( -2 );

        if ( t.total <= 0 ) {
            clearInterval( timeinterval );
        }
    }

    updateClock();
    var timeinterval = setInterval( updateClock, 1000 );
}
;

// $(document).ready(function(){
//   var n=0;
//   setInterval(increment,1000);
//   function increment(){
//     n++;
//     setCounter(n);
//   }
//   function setCounter(v){
//     var counter=$(".counter");
//     var old=counter.children(".counter-value");
//     var oldContent=old.children(".counter-value-mask");

//     var t=0.4;
//     var d=t*0.0;
//     var d2=t*0.3;
//     var padding=55;
//     var offset=5;
//     var w=old.data("w");
//     w+=padding;
//     TweenMax.to(old,t,{delay:d,x:w,ease:Quad.easeIn});
//     TweenMax.to(oldContent,t,{delay:d,x:-(w-offset),ease:Quad.easeIn});
//     setTimeout(function(){old.remove()},t*1000);

//     var neu=$("<div/>").addClass("counter-value").appendTo(counter);
//     var neuContent=$("<div/>").addClass("counter-value-mask").appendTo(neu).text(v);

//     w=neuContent.width();
//     neu.data("w",w);
//     neu.css({
//       width:w
//     })
//     w+=padding;
//     TweenMax.from(neu,t,{delay:d2,x:-w});
//     TweenMax.from(neuContent,t,{delay:d2,x:w-offset});



//   }
// })