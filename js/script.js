var imgi = 2;



//-- IMAGES CHANGING --

$('#firstPage').css('background-image', 'url(images/mags/1.jpg)');

setInterval(function () {
    var src = "images/mags/" + imgi + ".jpg";

    $('#firstPage').css('background-image', 'url(' + src + ')');

    imgi++;
    if (imgi == 5)
        imgi = 1;
}, 2000);





//-- SMOOTH SCROLLING --

$(function () {
    $('a[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});



//-- DROP DOWN MENU --

var $container = $('.dropdown-menu'),
    $list = $('.dropdown-menu ul'),
    listItem = $list.find('li'),
    category = '';

$(".dropdown .title").click(function () {
    if ($container.height() > 0) {
        closeMenu(this);
    } else {
        openMenu(this);
    }
});

$(".dropdown-menu li").click(function () {
    closeMenu(this);
});

function closeMenu(el) {
    category = $(el).attr('id');
    updateVal(category);
    
    $(el).closest('.dropdown').toggleClass("closed").find(".title").text($(el).text());
    $container.css("height", 0);
    $list.css("top", 0);
}

function openMenu(el) {
    $(el).parent().toggleClass("closed");

    $container.css({
            height: 200
        })
        .mousemove(function (e) {
            var heightDiff = $list.height() / $container.height(),
                offset = $container.offset(),
                relativeY = (e.pageY - offset.top),
                top = relativeY * heightDiff > $list.height() - $container.height() ?
                $list.height() - $container.height() : relativeY * heightDiff;

            $list.css("top", -top);
        });
}

function updateVal(category) {
    $('#category-chosen').val(category);
    console.log('chose category '+ category);
}





$(document).ready(function () {
    // Test for placeholder support
    $.support.placeholder = (function () {
        var i = document.createElement('input');
        return 'placeholder' in i;
    })();

    // Hide labels by default if placeholders are supported
    if ($.support.placeholder) {
        $('.form-label').each(function () {
            $(this).addClass('js-hide-label');
        });

        // Code for adding/removing classes here
        $('.form-group').find('input, textarea').on('keyup blur focus', function (e) {

            // Cache our selectors
            var $this = $(this),
                $parent = $this.parent().find("label");

            if (e.type == 'keyup') {
                if ($this.val() == '') {
                    $parent.addClass('js-hide-label');
                } else {
                    $parent.removeClass('js-hide-label');
                }
            } else if (e.type == 'blur') {
                if ($this.val() == '') {
                    $parent.addClass('js-hide-label');
                } else {
                    $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
                }
            } else if (e.type == 'focus') {
                if ($this.val() !== '') {
                    $parent.removeClass('js-unhighlight-label');
                }
            }
        });
    }
});




//SAVE THE ID OF THE MAGAZINE CHOSEN

$(".post").on("click", function () {
    var magId = $(this).attr('id');
    document.cookie = "mag_chosen=" + magId;
});



//SHOW POP UP WINDOW
$('#add-button').on("click", function () {
    $('#popup').css('display', 'block');
});

$('#popup-btn').on("click", function () {
    $('#popup').css('display', 'none');
});

$('#x').on("click", function () {
    console.log("clique certo");
    $('#popup').css('display', 'none');
});
