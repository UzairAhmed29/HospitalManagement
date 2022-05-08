jQuery(document).on("change", "input.cal-datepicker", function(e) {
    e.preventDefault();
    var locate = jQuery(this).val();

    document.getElementById(locate).scrollIntoView({
        behavior: "smooth",
        block: "nearest",
        inline: "start",
    });
    jQuery("#"+locate).css('border', '1px solid #a258ed');
    jQuery("#"+locate).css('box-shadow', 'rgba(17, 12, 46, 0.15) 0px 48px 100px 0px');
    setTimeout(function() {
        jQuery("#"+locate).css('border', '1px solid #ccc');
        jQuery("#"+locate).css('box-shadow', 'rgba(0, 0, 0, 0.16) 0px 1px 4px');
    }, 3000);
});

const slider = document.querySelector('.cal-blocks');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mousemove', (e) => {
    if(!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 3; //scroll-fast
    slider.scrollLeft = scrollLeft - walk;
});

var scroller = document.querySelector('.cal-blocks');
var leftArrow = document.getElementById('leftArrow');

var direction = 0;
var active = false;
var max = 10;
var Vx = 0;
var x = 0.0;
var prevTime = 0;
var f = 0.2;
var prevScroll = 0;

function physics(time) {
    // Measure how much time has passed
    var diffTime = time - prevTime;
    if (!active) {
    diffTime = 80;
    active = true;
    }
    prevTime = time;

    // Give power to the scrolling


    Vx = (direction * max * f + Vx * (1-f)) * (diffTime / 20);

    x += Vx;
    var thisScroll = scroller.scrollLeft;
    var nextScroll = Math.floor(thisScroll + Vx);

    if (Math.abs(Vx) > 0.5 && nextScroll !== prevScroll) {
    scroller.scrollLeft = nextScroll;
    requestAnimationFrame(physics);
    } else {
    Vx = 0;
    active = false;
    }
    prevScroll = nextScroll;
}

leftArrow.addEventListener('mousedown', function () {
    direction = -1;
    if (!active) {
    requestAnimationFrame(physics);
    }
});

leftArrow.addEventListener('mouseup', function () {
    direction = 0;
});

rightArrow.addEventListener('mousedown', function () {
    direction = 1;
    if (!active) {
    requestAnimationFrame(physics);
    }
});
rightArrow.addEventListener('mouseup', function(event){
    direction = 0;
});

jQuery(document).ready(function($) {
    $(".slot-init").on('click', function() {
        var $this = $(this);
        var day = $this.parent('.content-block').children('input[name="day_name"]').val();
        var datetime = $this.children('p.slot').data('time')
        var slot = $this.children('p.slot').data('slot');
        $("form[name='appointmen-form']").find('input[name="date"]').val(datetime);
        $("form[name='appointmen-form']").find('input[name="day"]').val(day);
        $("form[name='appointmen-form']").find('input[name="slot"]').val(slot);
        $("p.slot_title").children('span').text(datetime);

        jQuery("div.booking--model").css({
            'width': 'auto',
            'height': 'auto',
            'opacity': '1',
            '-webkit-transition': 'opacity 1s ease',
            'transition': 'opacity 1s ease',
     });
    });


    $(".modal-header a i").on('click', function() {
        $("form[name='appointmen-form']").find('input[name="date"]').val("");
        $("form[name='appointmen-form']").find('input[name="day"]').val("");
        $("p.slot_title").children('span').text("");
        $("div.booking--model").css({
            'width': '0',
            'height': '0',
            'opacity': '1',
            '-webkit-transition': 'opacity 1s ease',
            'transition': 'opacity 1s ease',
     });
    });
});
