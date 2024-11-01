dojo.declare("zencarousel", null, {
	constructor: function(opts){
		this.opts = {
			rootID: "zencarousel",
			linksClass: "zc_links",
			overlayClass: "zc_overlay",
			numbersClass: "zc_numbers",
			slowDur: 1500,
			quickDur: 500,
			waitDur: 7000,
			raisedZ: 10,
			loweredZ: 5,
			hiddenZ: 0,
			height: "800px",
			width: "300px",
			navWidth: "30px",
			navHeight: "30px",
			navSpacing: "4px",
			navOffsetX: "6px",
			navOffsetY: "6px"
		};
		dojo.mixin(this.opts, opts);
		if (typeof(this.opts.width)=="number"){ this.opts.width = this.opts.width+"px";}
		if (typeof(this.opts.height)=="number"){ this.opts.height = this.opts.height+"px";}
		this.root_element = dojo.byId(this.opts.rootID);
		this.overlay = dojo.query("." + this.opts.overlayClass, this.root_element);
		this.overlay = this.overlay[0];
		dojo.style(this.overlay, { width: this.opts.width, height: this.opts.height });
		this.entries = [];
		this.buttons = [];
		this.prev = null;
		this.curr = null;
		this.move = null;
		this.timeout = null;
		this.numbers = dojo.create("div", {class:this.opts.numbersClass}, this.root_element);
		dojo.style(this.numbers,
			{
				"left": this.opts.navOffsetX,
				"bottom": this.opts.navOffsetY
			});
		this.makeEntries();
		this.jumpTo(0);
		this.fadeTo(0);
	},
	hide: function(e){
		dojo.style(e, {"zIndex": this.opts.hiddenZ});
		this.setOff(e);
	},
	lower: function(e){
		dojo.style(e, {"zIndex": this.opts.loweredZ});
	},
	raise: function(e){
		dojo.style(e, {"zIndex": this.opts.raisedZ});
	},
	setOff: function(e){
		dojo.removeClass(e, "on");
	},
	setOn: function(e){
		dojo.addClass(e, "on");
	},
	setFull: function(e){
		dojo.style(e, "opacity", "1.0");
	},
	setClear: function(e){
		dojo.style(e, "opacity", "0.0");
	},
	jumpTo: function(i){
		if (this.curr != null){
			this.lower(this.entries[this.curr]);
		}
		this.curr = i;
		this.prev = null;
		this.move = null;
		this.setOn(this.entries[i]);
		this.raise(this.entries[i]);
		this.setFull(this.entries[i]);
		for (j in this.entries){
			if(j != i){
				this.setClear(this.entries[j]);
				this.setOff(this.entries[j]);
				this.hide(this.entries[j]);
				this.setOff(this.buttons[j]);
			}else{
				this.setOn(this.buttons[j]);
			}
		};
		this.lower(this.entries[i]);
	},
	fadeTo: function(i, dur){
		this.prev = this.curr;
		this.move = i;
		this.clearTimer();
		this.setClear(this.entries[i]);
		this.lower(this.entries[this.curr]);
		this.setOn(this.entries[i]);
		this.raise(this.entries[i]);
		//this.setFull(this.entries[this.curr]);
		var _this = this;
		dojo.fadeIn(
			{
				node:this.entries[i],
				duration: dur,
				onEnd: dojo.hitch(_this, "setTimer", i)
			}
		).play();
	},
	clearTimer: function(){
		if (this.timeout != null){
			clearTimeout(this.timeout);
		}
	},
	setTimer: function(i){
		this.curr = i;
		this.clearTimer();
		this.jumpTo(this.curr);
		var _this = this;
		this.timeout = setTimeout(dojo.hitch(_this, "goNext"), this.opts.waitDur);
	},
	goNext: function(){
		i = this.curr + 1;
		if (i >= this.entries.length){
			i = 0;
		}
		this.fadeTo(i, this.opts.slowDur);
	},
	browseTo: function(e){
		if (e == this.move || e == this.curr){
			return;
		}
		this.fadeTo(e, this.opts.quickDur);
	},
	makeEntries: function(){
		var e = dojo.query("." + this.opts.linksClass + " a", this.root_element);
		var u = dojo.create("ul", {}, this.numbers);
		e.forEach(
			function(entry, i){
				var c = dojo.create( "div", { id:"zc_image_"+i }, this.overlay );
				var a = dojo.create( "a", { href: dojo.attr(entry, "href"), alt: dojo.attr(entry, "title") }, c );
				var img = dojo.create( "img", {	src: entry.innerHTML,	alt: dojo.attr(entry, "title") }, a );
				this.entries.push(c);
				var n = dojo.create( "li", {}, u );
				dojo.style(n,
					{
						"width": this.opts.navWidth,
						"height": this.opts.navHeight,
						"marginRight": this.opts.navSpacing,
					});
				var _this = this;
				dojo.connect(n, "onclick", dojo.hitch(_this, "browseTo", i));
				this.buttons.push(n);
			}, this
		);
	}
});