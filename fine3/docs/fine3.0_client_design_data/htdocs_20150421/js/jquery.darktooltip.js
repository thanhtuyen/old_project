// JavaScript Document
(function(e) {
    function t(e, t) {
        this.bearer = e;
        this.options = t;
        this.hideEvent;
        this.mouseOverMode = this.options.trigger == "hover" || this.options.trigger == "mouseover" || this.options.trigger == "onmouseover"
    }
    t.prototype = {
        show: function() {
            var e = this;
            if (this.options.modal) {
                this.modalLayer.css("display", "block")
            }
            this.tooltip.css("display", "block");
            if (e.mouseOverMode) {
                this.tooltip.mouseover(function() {
                    clearTimeout(e.hideEvent)
                });
                this.tooltip.mouseout(function() {
                    clearTimeout(e.hideEvent);
                    e.hide()
                })
            }
        },
        hide: function() {
            var e = this;
            this.hideEvent = setTimeout(function() {
                e.tooltip.hide()
            }, 100);
            if (e.options.modal) {
                e.modalLayer.hide()
            }
            this.options.onClose()
        },
        toggle: function() {
            if (this.tooltip.is(":visible")) {
                this.hide()
            } else {
                this.show()
            }
        },
        addAnimation: function() {
            switch (this.options.animation) {
                case "none":
                    break;
                case "fadeIn":
                    this.tooltip.addClass("animated");
                    this.tooltip.addClass("fadeIn");
                    break;
                case "flipIn":
                    this.tooltip.addClass("animated");
                    this.tooltip.addClass("flipIn");
                    break
            }
        },
        setContent: function() {
            e(this.bearer).css("cursor", "pointer");
            if (this.options.content) {
                this.content = this.options.content
            } else if (this.bearer.attr("data-tooltip")) {
                this.content = this.bearer.attr("data-tooltip")
            } else {
                return
            }
            if (this.content.charAt(0) == "#") {
                if (this.options.delete_content) {
                    var t = e(this.content).html();
                    e(this.content).html("");
                    this.content = t;
                    delete t
                } else {
                    e(this.content).hide();
                    this.content = e(this.content).html()
                }
                this.contentType = "html"
            } else {
                this.contentType = "text"
            }
            tooltipId = "";
            if (this.bearer.attr("id") != "") {
                tooltipId = "id='darktooltip-" + this.bearer.attr("id") + "'"
            }
            this.modalLayer = e("<ins class='darktooltip-modal-layer'></ins>");
            this.tooltip = e("<ins " + tooltipId + " class = 'dark-tooltip " + this.options.theme + " " + this.options.size + " " + this.options.gravity + "'><div>" + this.content + "</div><div class = 'tip'></div></ins>");
            this.tip = this.tooltip.find(".tip");
            e("body").append(this.modalLayer);
            e("body").append(this.tooltip);
            if (this.contentType == "html") {
                this.tooltip.css("max-width", "none")
            }
            this.tooltip.css("opacity", this.options.opacity);
            this.addAnimation();
            if (this.options.confirm) {
                this.addConfirm()
            }
        },
        setPositions: function() {
            var e = this.bearer.offset().left;
            var t = this.bearer.offset().top;
            switch (this.options.gravity) {
                case "south":
                    e += this.bearer.outerWidth() / 2 - this.tooltip.outerWidth() / 2;
                    t += -this.tooltip.outerHeight() - this.tip.outerHeight() / 2;
                    break;
                case "west":
                    e += this.bearer.outerWidth() + this.tip.outerWidth() / 2;
                    t += this.bearer.outerHeight() / 2 - this.tooltip.outerHeight() / 2;
                    break;
                case "north":
                    e += this.bearer.outerWidth() / 2 - this.tooltip.outerWidth() / 2;
                    t += this.bearer.outerHeight() + this.tip.outerHeight() / 2;
                    break;
                case "east":
                    e += -this.tooltip.outerWidth() - this.tip.outerWidth() / 2;
                    t += this.bearer.outerHeight() / 2 - this.tooltip.outerHeight() / 2;
                    break
            }
            if (this.options.autoLeft) {
                this.tooltip.css("left", e)
            }
            if (this.options.autoTop) {
                this.tooltip.css("top", t)
            }
        },
        setEvents: function() {
            var t = this;
            var n = t.options.hoverDelay;
            var r;
            if (t.mouseOverMode) {
                this.bearer.mouseenter(function() {
                    r = setTimeout(function() {
                        t.setPositions();
                        t.show()
                    }, n)
                }).mouseleave(function() {
                    clearTimeout(r);
                    t.hide()
                })
            } else if (this.options.trigger == "click" || this.options.trigger == "onclik") {
                this.tooltip.click(function(e) {
                    e.stopPropagation()
                });
                this.bearer.click(function(e) {
                    e.preventDefault();
                    t.setPositions();
                    t.toggle();
                    e.stopPropagation()
                });
                e("html").click(function() {
                    t.hide()
                })
            }
        },
        activate: function() {
            this.setContent();
            if (this.content) {
                this.setEvents()
            }
        },
        addConfirm: function() {
            this.tooltip.append("<ul class = 'confirm'><li class = 'darktooltip-yes'>" + this.options.yes + "</li><li class = 'darktooltip-no'>" + this.options.no + "</li></ul>");
            this.setConfirmEvents()
        },
        setConfirmEvents: function() {
            var e = this;
            this.tooltip.find("li.darktooltip-yes").click(function(t) {
                e.onYes();
                t.stopPropagation()
            });
            this.tooltip.find("li.darktooltip-no").click(function(t) {
                e.onNo();
                t.stopPropagation()
            })
        },
        finalMessage: function() {
            if (this.options.finalMessage) {
                var e = this;
                e.tooltip.find("div:first").html(this.options.finalMessage);
                e.tooltip.find("ul").remove();
                e.setPositions();
                setTimeout(function() {
                    e.hide();
                    e.setContent()
                }, e.options.finalMessageDuration)
            } else {
                this.hide()
            }
        },
        onYes: function() {
            this.options.onYes(this.bearer);
            this.finalMessage()
        },
        onNo: function() {
            this.options.onNo(this.bearer);
            this.hide()
        }
    };
    e.fn.darkTooltip = function(n) {
        return this.each(function() {
            n = e.extend({}, e.fn.darkTooltip.defaults, n);
            var r = new t(e(this), n);
            r.activate()
        })
    };
    e.fn.darkTooltip.defaults = {
        animation: "none",
        confirm: false,
        content: "",
        finalMessage: "",
        finalMessageDuration: 1e3,
        gravity: "south",
        hoverDelay: 0,
        modal: false,
        no: "No",
        onNo: function() {},
        onYes: function() {},
        opacity: .9,
        size: "medium",
        theme: "dark",
        trigger: "hover",
        yes: "Yes",
        autoTop: true,
        autoLeft: true,
        onClose: function() {}
    }
})(jQuery)