(() => {
    "use strict";

    function e(e, t) {
        (null == t || t > e.length) && (t = e.length);
        for (var r = 0, i = new Array(t); r < t; r++) i[r] = e[r];
        return i
    }

    function t(t) {
        return function(t) {
            if (Array.isArray(t)) return e(t)
        }(t) || function(e) {
            if ("undefined" != typeof Symbol && null != e[Symbol.iterator] || null != e["@@iterator"]) return Array.from(e)
        }(t) || function(t, r) {
            if (t) {
                if ("string" == typeof t) return e(t, r);
                var i = Object.prototype.toString.call(t).slice(8, -1);
                return "Object" === i && t.constructor && (i = t.constructor.name), "Map" === i || "Set" === i ? Array.from(t) : "Arguments" === i || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i) ? e(t, r) : void 0
            }
        }(t) || function() {
            throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
        }()
    }
    var r = function e(t, r) {
        if (t === r) return !0;
        if (t && r && "object" == typeof t && "object" == typeof r) {
            if (t.constructor !== r.constructor) return !1;
            var i, s, l;
            if (Array.isArray(t)) {
                if ((i = t.length) != r.length) return !1;
                for (s = i; 0 != s--;)
                    if (!e(t[s], r[s])) return !1;
                return !0
            }
            if (t.constructor === RegExp) return t.source === r.source && t.flags === r.flags;
            if (t.valueOf !== Object.prototype.valueOf) return t.valueOf() === r.valueOf();
            if (t.toString !== Object.prototype.toString) return t.toString() === r.toString();
            if ((i = (l = Object.keys(t)).length) !== Object.keys(r).length) return !1;
            for (s = i; 0 != s--;)
                if (!Object.prototype.hasOwnProperty.call(r, l[s])) return !1;
            for (s = i; 0 != s--;) {
                var n = l[s];
                if (!e(t[n], r[n])) return !1
            }
            return !0
        }
        return t != t && r != r
    };
    const i = "__googleMapsScriptId";
    var s;
    ! function(e) {
        e[e.INITIALIZED = 0] = "INITIALIZED", e[e.LOADING = 1] = "LOADING", e[e.SUCCESS = 2] = "SUCCESS", e[e.FAILURE = 3] = "FAILURE"
    }(s || (s = {}));
    class l {
        constructor({
                        apiKey: e,
                        channel: t,
                        client: s,
                        id: n = i,
                        libraries: o = [],
                        language: a,
                        region: c,
                        version: h,
                        mapIds: f,
                        nonce: p,
                        retries: y = 3,
                        url: u = "https://maps.googleapis.com/maps/api/js"
                    }) {
            if (this.CALLBACK = "__googleMapsCallback", this.callbacks = [], this.done = !1, this.loading = !1, this.errors = [], this.version = h, this.apiKey = e, this.channel = t, this.client = s, this.id = n || i, this.libraries = o, this.language = a, this.region = c, this.mapIds = f, this.nonce = p, this.retries = y, this.url = u, l.instance) {
                if (!r(this.options, l.instance.options)) throw new Error(`Loader must not be called again with different options. ${JSON.stringify(this.options)} !== ${JSON.stringify(l.instance.options)}`);
                return l.instance
            }
            l.instance = this
        }
        get options() {
            return {
                version: this.version,
                apiKey: this.apiKey,
                channel: this.channel,
                client: this.client,
                id: this.id,
                libraries: this.libraries,
                language: this.language,
                region: this.region,
                mapIds: this.mapIds,
                nonce: this.nonce,
                url: this.url
            }
        }
        get status() {
            return this.errors.length ? s.FAILURE : this.done ? s.SUCCESS : this.loading ? s.LOADING : s.INITIALIZED
        }
        get failed() {
            return this.done && !this.loading && this.errors.length >= this.retries + 1
        }
        createUrl() {
            let e = this.url;
            return e += `?callback=${this.CALLBACK}`, this.apiKey && (e += `&key=${this.apiKey}`), this.channel && (e += `&channel=${this.channel}`), this.client && (e += `&client=${this.client}`), this.libraries.length > 0 && (e += `&libraries=${this.libraries.join(",")}`), this.language && (e += `&language=${this.language}`), this.region && (e += `&region=${this.region}`), this.version && (e += `&v=${this.version}`), this.mapIds && (e += `&map_ids=${this.mapIds.join(",")}`), e
        }
        deleteScript() {
            const e = document.getElementById(this.id);
            e && e.remove()
        }
        load() {
            return this.loadPromise()
        }
        loadPromise() {
            return new Promise(((e, t) => {
                this.loadCallback((r => {
                    r ? t(r.error) : e(window.google)
                }))
            }))
        }
        loadCallback(e) {
            this.callbacks.push(e), this.execute()
        }
        setScript() {
            if (document.getElementById(this.id)) return void this.callback();
            const e = this.createUrl(),
                t = document.createElement("script");
            t.id = this.id, t.type = "text/javascript", t.src = e, t.onerror = this.loadErrorCallback.bind(this), t.defer = !0, t.async = !0, this.nonce && (t.nonce = this.nonce), document.head.appendChild(t)
        }
        reset() {
            this.deleteScript(), this.done = !1, this.loading = !1, this.errors = [], this.onerrorEvent = null
        }
        resetIfRetryingFailed() {
            this.failed && this.reset()
        }
        loadErrorCallback(e) {
            if (this.errors.push(e), this.errors.length <= this.retries) {
                const e = this.errors.length * Math.pow(2, this.errors.length);
                console.log(`Failed to load Google Maps script, retrying in ${e} ms.`), setTimeout((() => {
                    this.deleteScript(), this.setScript()
                }), e)
            } else this.onerrorEvent = e, this.callback()
        }
        setCallback() {
            window.__googleMapsCallback = this.callback.bind(this)
        }
        callback() {
            this.done = !0, this.loading = !1, this.callbacks.forEach((e => {
                e(this.onerrorEvent)
            })), this.callbacks = []
        }
        execute() {
            if (this.resetIfRetryingFailed(), this.done) this.callback();
            else {
                if (window.google && window.google.maps && window.google.maps.version) return console.warn("Google Maps already loaded outside @googlemaps/js-api-loader.This may result in undesirable behavior as options and script parameters may not match."), void this.callback();
                this.loading || (this.loading = !0, this.setCallback(), this.setScript())
            }
        }
    }
    const n = [{
        featureType: "all",
        elementType: "geometry.fill",
        stylers: [{
            weight: "2.00"
        }]
    }, {
        featureType: "all",
        elementType: "geometry.stroke",
        stylers: [{
            color: "#9c9c9c"
        }]
    }, {
        featureType: "all",
        elementType: "labels.text",
        stylers: [{
            visibility: "on"
        }]
    }, {
        featureType: "landscape",
        elementType: "all",
        stylers: [{
            color: "#f2f2f2"
        }]
    }, {
        featureType: "landscape",
        elementType: "geometry.fill",
        stylers: [{
            color: "#ffffff"
        }]
    }, {
        featureType: "landscape.man_made",
        elementType: "geometry.fill",
        stylers: [{
            color: "#ffffff"
        }]
    }, {
        featureType: "poi",
        elementType: "all",
        stylers: [{
            visibility: "off"
        }]
    }, {
        featureType: "road",
        elementType: "all",
        stylers: [{
            saturation: -100
        }, {
            lightness: 45
        }]
    }, {
        featureType: "road",
        elementType: "geometry.fill",
        stylers: [{
            color: "#eeeeee"
        }]
    }, {
        featureType: "road",
        elementType: "labels.text.fill",
        stylers: [{
            color: "#7b7b7b"
        }]
    }, {
        featureType: "road",
        elementType: "labels.text.stroke",
        stylers: [{
            color: "#ffffff"
        }]
    }, {
        featureType: "road.highway",
        elementType: "all",
        stylers: [{
            visibility: "simplified"
        }]
    }, {
        featureType: "road.arterial",
        elementType: "labels.icon",
        stylers: [{
            visibility: "off"
        }]
    }, {
        featureType: "transit",
        elementType: "all",
        stylers: [{
            visibility: "off"
        }]
    }, {
        featureType: "water",
        elementType: "all",
        stylers: [{
            color: "#46bcec"
        }, {
            visibility: "on"
        }]
    }, {
        featureType: "water",
        elementType: "geometry.fill",
        stylers: [{
            color: "#c8d7d4"
        }]
    }, {
        featureType: "water",
        elementType: "labels.text.fill",
        stylers: [{
            color: "#070707"
        }]
    }, {
        featureType: "water",
        elementType: "labels.text.stroke",
        stylers: [{
            color: "#ffffff"
        }]
    }];
    const o = function() {
        var e = new l({
                apiKey: "AIzaSyCbnHNdVy3x7iISN8d4oGEFHhxGFg1LNdQ",
                version: "weekly"
            }),
            r = document.querySelector("#map"),
            i = {
                lat: 6.550727755657388,
                lng: 3.331793819268383
            };
        e.load().then((function() {
            var e = new google.maps.Map(r, {
                center: {
                    lat: 6.550727755657388,
                    lng: 3.331793819268383
                },
                zoom: 8,
                styles: t(n),
                disableDefaultUI: !0
            });
            new google.maps.Marker({
                position: i,
                map: e,
                icon: "/frontend/img/pin.svg"
            })
        }))
    };
    document.addEventListener("DOMContentLoaded", (function() {
        o()
    }))
})();
