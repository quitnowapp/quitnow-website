
/*! GetDevicePixelRatio | Author: Tyson Matanich, 2012 | License: MIT */ (function(n){n.getDevicePixelRatio=function(){var t=1;return n.screen.systemXDPI!==undefined&&n.screen.logicalXDPI!==undefined&&n.screen.systemXDPI>n.screen.logicalXDPI?t=n.screen.systemXDPI/n.screen.logicalXDPI:n.devicePixelRatio!==undefined&&(t=n.devicePixelRatio),t}})(this);
var IOS = /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
var ANDROID = /android/gi.test(navigator.userAgent);

var SLIDES = {
	home: 1,
	chat: 2,
	achievments: 3,
	progress: 4,
	world: 5
}
var PREVENT_MOVE = false;


// Slider de los screenshots
function sliderScreenshots(elems){
	var self = this;
	var delay = 3000;

	this.position = elems.length * 200;
	this.elems = elems;
	this.timeout = null;

	this.next = function(n){
		var n = n ? n : 1;
		this.position += n;
		var p = this.position % this.elems.length;
		var ps = (this.position - 2) % this.elems.length;

		this.elems
			.removeClass("active")
			.eq(p)
			.addClass("active");

		if(p == 4){
			var i = -1;
			while(++i != 3)
				this.elems
					.parent()
					.append(this.elems.eq(i));
		}else if([0,1].indexOf(p) != -1){
			this.elems
				.parent()
				.append(this.elems.eq(ps));
		}

		this.nextTimeout();
	}
	this.prev = function(){
		this.next(-1);
	}

	this.nextTimeout = function(){
		clearTimeout(this.timeout);
		this.timeout = setTimeout(function(){
			self.next();
		}, delay);
	}

	$('.arrowL').click(function(){self.prev()});
	$('.arrowR').click(function(){self.next()});
	this.nextTimeout();
}


// Animar el chat a la entrada
function animateChat(){
	if($("#chatting li.noAnimate").length)
		return;
	$("#chatting li").eq(0)
		.addClass("firstAnimate")
		.addClass("noAnimate");
	setTimeout(function(){
		$("#chatting li").eq(0).removeClass("firstAnimate");
	}, 2200);
}


// Slider de logros
function initAchievements(elems, delay){
	var self = this;

	this.actual = 0;
	this.elems = elems;
	this.n = elems.length;
	this.nextTime;
	this.delay = delay;

	this.next = function(){
		clearTimeout(this.nextTime);
		this.elems
			.removeClass('visible')
			.eq(++this.actual % this.n)
			.addClass('visible');
		this.sleep();
	}
	this.sleep = function(){
		this.nextTime = setTimeout(function(){
			self.next();
		}, this.delay);
	}
	this.click = function(){
		if(480 > Math.min($(document).width(), $(document).height()))
			this.next();
	}

	this.elems.eq(0).parent()
		.click(function(){
			self.click();
		});
	this.sleep();
}

//Barra de progreso
function progressBar(initial){
	this.initial = initial;
	this.initialized = false;

	this.init = function(){
		if(this.initialized)
			return;
		this.initialized = true;
		var be = BezierEasing(0.4, 0.4, 0, 0.9);
		var fps = 30;
		var time = 6; // seconds
		var actualFrame = (time * this.initial / 100) * fps;
		var totalFrames = fps * time;

		$('#circle .number').text(this.initial);

		var nextFrame = function(){
			actualFrame++;

			var progress = ~~(100 * be(actualFrame / totalFrames));

			$('#circle').circleProgress({
				value: be(actualFrame / totalFrames)
			});

			$('#circle .number').text(progress);

			if(progress == 100){
				clearInterval(interval);
				$('.circleProgress').addClass("complete");
				$(document.body).addClass("progressComplete");
				$('#circle').circleProgress({
					value: 1
				});
			}
		};

		var interval = setInterval(nextFrame, 1000 / fps);
	}
}

// Control del tamaño de los puntos del mapa y la animación de las banderas
function worldControl(){
	var self = this;
	this.worldPattern = $('#worldPattern');
	this.flags = $('.worldFlags .flag');


	this.setPatternSize = function(){
		var ww = $(document.body).width();
		var wh = $(document.body).height();
		var size = Math.round((15 - (ww / 100)) * (ww > 800 ? 1 : 0.5));
		if(size < 4)
			size = 4;
		if(wh <= 440 || ww <=440)
			size = 8;
		this.worldPattern
			.attr("width", size)
			.attr("height", size);
	}
	this.showFlag = function(){
		var flags = $('.worldFlags .flag.hidden')
		var n = Math.floor(flags.length * Math.random());
		flags
			.eq(n)
			.removeClass("hidden");
		if(!flags.length){
			this.flags
				.removeClass("fadeIn");
			this.moveRandomFlag();
			return;
		}
		setTimeout(function(){
			self.showFlag();
		}, 500);
	}
	this.moveRandomFlag = function(){
		var flags = $('.worldFlags .flag')
		var n = Math.floor(flags.length * Math.random());
		flags
			.eq(n)
			.addClass("flagSwift");
		setTimeout(function(){
			$(".flagSwift")
				.removeClass("flagSwift");
		}, 1000);
		setTimeout(function(){
			self.moveRandomFlag();
		}, 1000 + (Math.random() * 4000));
	}

	this.init = function(){
		setTimeout(function(){
			self.showFlag();
		}, 500);
	}

	this.setPatternSize();
	$(window).resize(function() {
		self.setPatternSize();
	});
}


$(document).ready(function() {
	var inicialCircleValue = 12;
	var achievementsDelay = 4000;

	var progressBarObj = null;
	var worldControlObj = null;

	$('#fullpage').fullpage({
		anchors: ['QuitNow', 'Chat', 'Achievements', 'Health', 'Downloads'],
		sectionsColor: ['#3d91e6', '#eac850', '#6aad5d', '#d55c3f', '#3a5269', '#EAE1C0'],
		slidesNavigation: true,
		navigation: true,
		navigationPosition: 'right',
        scrollOverflow: false,
        css3: true,
		//navigationTooltips: ['First', 'Second', 'Third'],
		afterLoad: function(anchorLink, index){
			switch(index){
				case SLIDES.home: $('.home').removeClass('hideScreenshots'); break;
			}
		},
		onLeave: function(index, nextIndex, direction){
			$("#section4").scrollTop(0);
			switch(nextIndex){
				case SLIDES.chat: animateChat(); break;
				case SLIDES.progress: progressBarObj.init(); break;
				case SLIDES.world: worldControlObj.init(); break;
			}
		}
	});

	var pixelRatio = window.getDevicePixelRatio();

	$('#circle').circleProgress({
		value: inicialCircleValue / 100,
		startAngle: -Math.PI / 2,
		size: 320 * pixelRatio,
		emptyFill: "#792f1d",
		thickness: 20 * pixelRatio,
		animation: false,
		fill: {
			color: "#fff"
		}
	});

	if(IOS)
		$(document.body).addClass("appleDevice");

	$(".screen")
		.parent().hide();
	if(IOS){
		new sliderScreenshots($(".screen.apple"));
		$(".screen.apple")
			.parent().show();
	}else if(ANDROID){
		new sliderScreenshots($(".screen.android"));
		$(".screen.android")
			.parent().show();
	}else{
		new sliderScreenshots($(".screen.desktop"));
		$(".screen.desktop")
			.parent().show();
	}

	progressBarObj = new progressBar(inicialCircleValue);
	worldControlObj =  new worldControl();
	new initAchievements($("#achiev div"), achievementsDelay);
	new ElastiStack( $("#chatting").get(0), {
		distDragBack : 100, 
		distDragMax : 200
	});
});